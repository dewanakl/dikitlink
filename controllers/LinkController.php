<?php

namespace Controllers;

use Core\Auth\Auth;
use Core\Database\DB;
use Core\Http\Request;
use Core\Routing\Controller;
use Core\Valid\Validator;
use Models\Link;
use Repository\RepositoryContract;
use Service\ServiceContract;

class LinkController extends Controller
{
    private $id;

    function __construct(Auth $auth)
    {
        $this->id = $auth->user()->id;
    }

    public function show(Request $request)
    {
        $valid = $this->validate($request, [
            'nama' => ['str', 'trim', 'slug', 'max:25'],
            'init' => ['max:3', 'int'],
            'end' => ['required', 'max:3', 'int']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        return json(
            DB::table('links')
                ->leftJoin('stats', 'links.id', 'stats.link_id')
                ->where('links.user_id', $this->id)
                ->where('links.name', '%' . $valid->nama . '%', 'LIKE')
                ->groupBy('links.id')
                ->orderBy('links.id', 'DESC')
                ->limit($valid->end)
                ->offset($valid->init ?? 0)
                ->select([
                    'links.name',
                    'links.link',
                    'links.created_at',
                    'links.link_password',
                    'links.waktu_buka',
                    'links.waktu_tutup',
                    'links.record_statistics as stats',
                    'count(stats.id) as hint',
                ])
                ->get()
        );
    }

    public function detail(Request $request, RepositoryContract $repository)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        return json([
            'last_week' => $repository->lastWeek($this->id, $valid->name),
            'user_agent' => $repository->getStats($this->id, $valid->name, 5)('user_agent'),
            'ip_address' => $repository->getStats($this->id, $valid->name, 5)('ip_address'),
            'unique' => $repository->countUnique($this->id, $valid->name),
            'last_click' => $repository->lastClick($this->id, $valid->name)
        ]);
    }

    public function create(ServiceContract $service)
    {
        return json([
            'status' => boolval(Link::create($service->create($this->id)))
        ]);
    }

    public function update(ServiceContract $service)
    {
        return json([
            'status' => $service->update($this->id)
        ]);
    }

    public function delete(Request $request)
    {
        $valid = Validator::make($request->only(['name']), [
            'name' => ['required', 'str', 'trim', 'slug', 'min:3', 'max:25']
        ]);

        if ($valid->fails()) {
            return json([
                'error' => $valid->failed()
            ], 400);
        }

        $result = Link::where('name', $valid->name)
            ->where('user_id', $this->id)
            ->delete();

        return json([
            'status' => $result
        ]);
    }
}
