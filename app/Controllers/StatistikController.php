<?php

namespace App\Controllers;

use Core\Auth\Auth;
use Core\Database\DB;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Valid\Validator;
use App\Models\Link;
use App\Models\Stat;
use App\Repositories\RepositoryContract;

class StatistikController extends Controller
{
    public function index(RepositoryContract $link)
    {
        $id = Auth::id();

        return $this->view('statistik', [
            'last_month' => $link->lastMonth($id),
            'user_agent' => $link->getStats($id)('user_agent'),
            'ip_address' => $link->getStats($id)('ip_address')
        ]);
    }

    public function download()
    {
        $hasil = DB::table('links')
            ->join('stats', 'links.id', 'stats.link_id')
            ->where('links.user_id', Auth::id())
            ->select([
                'stats.created_at',
                'links.name',
                'stats.user_agent',
                'stats.ip_address'
            ])
            ->get()
            ->toArray();

        header('Content-Type: application/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="statistik_' . now('Y-m-d_H-i-s') . '.csv";');

        $handle = fopen('php://output', 'w');

        fputcsv($handle, ['time', 'name', 'user_agent', 'ip_address']);
        foreach ($hasil as $value) {
            fputcsv($handle, array_values($value));
        }

        fclose($handle);
    }

    private function unsafeLink(string $data): bool
    {
        if (!env('SAFE_BROWSING')) {
            return false;
        }

        $url = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . env('SAFE_BROWSING');
        $context  = stream_context_create([
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode([
                    'client' => [
                        'clientId' => 'safe-browse-url-lookup-' . env('APP_NAME'),
                        'clientVersion' => '1.0.0'
                    ],
                    'threatInfo' => [
                        'threatTypes' => [
                            'MALWARE',
                            'SOCIAL_ENGINEERING',
                            'UNWANTED_SOFTWARE',
                            'MALICIOUS_BINARY',
                            'POTENTIALLY_HARMFUL_APPLICATION',
                            'THREAT_TYPE_UNSPECIFIED'
                        ],
                        'platformTypes' => ['ANY_PLATFORM'],
                        'threatEntryTypes' => ['URL'],
                        'threatEntries' => [
                            [
                                'url' => $data
                            ]
                        ]
                    ]
                ])
            ]
        ]);

        $res = json_decode(file_get_contents($url, false, $context));
        return !empty($res->matches);
    }

    public function click(Request $request, $id)
    {
        $valid = Validator::make(
            [
                'id' => $id,
                'password' => $request->password,
                'user' => $request->server('HTTP_USER_AGENT'),
                'ip' => $request->ip()
            ],
            [
                'id' => ['str', 'trim', 'slug', 'min:3', 'max:25'],
                'password' => ['str', 'trim'],
                'user' => ['str', 'trim'],
                'ip' => ['str', 'trim', 'max:50']
            ]
        );

        if ($valid->fails()) {
            return $this->view('guest/hilang');
        }

        $link = Link::join('users', 'links.user_id', 'users.id')
            ->where('links.name', $valid->id)
            ->select(['links.*', 'users.statistics'])
            ->first();

        if (empty($link->id)) {
            return $this->view('guest/hilang');
        }

        if (!empty($link->unsafe)) {
            return $this->view('guest/unsafe');
        }

        if ($this->unsafeLink($link->link)) {
            Link::where('id', $link->id)->update([
                'unsafe' => true
            ]);

            return $this->view('guest/unsafe');
        }

        if (!empty($link->waktu_tutup)) {
            if (time() >= strtotime($link->waktu_tutup)) {
                return $this->view('guest/tunggu', [
                    'opened' => false,
                    'name' => $id,
                    'time' => $link->waktu_tutup
                ]);
            }
        }

        if (!empty($link->waktu_buka)) {
            if (time() <= strtotime($link->waktu_buka)) {
                return $this->view('guest/tunggu', [
                    'opened' => true,
                    'name' => $id,
                    'time' => $link->waktu_buka
                ]);
            }
        }

        if (!empty($link->link_password)) {
            if ($request->method() == 'GET') {
                return $this->view('guest/password', [
                    'name' => $valid->id
                ]);
            }

            $request->validate([
                'password' => ['required', 'str', 'trim', 'max:25']
            ]);

            if (!hash_equals($link->link_password, $valid->password)) {
                return $this->back()->with('gagal', 'Password salah !');
            }
        }

        if (!empty($link->statistics)) {
            if (!empty($link->record_statistics)) {
                Stat::create([
                    'link_id' => $link->id,
                    'user_agent' => $valid->user,
                    'ip_address' => $valid->ip
                ]);
            }
        }

        if (!empty($link->query_param)) {
            if (!empty($request->except([session()->getName()]))) {
                $link->link .= parse_url($link->link, PHP_URL_QUERY) ? '&' : '?';
                $link->link .= http_build_query($request->except([session()->getName()]));
            }
        }

        header('Last-Modified: ' . gmdate('D, d M Y H:i:s', 0) . ' GMT');
        header('Expires: ' . gmdate('D, d M Y H:i:s', 0) . ' GMT');
        header('Cache-Control: no-store');
        header('Age: 0');

        http_response_code(301);
        header('HTTP/1.1 301 Moved Permanently', true, 301);
        header('Location: ' . trim($link->link), true, 301);
    }
}
