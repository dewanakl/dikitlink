<?php

namespace App\Providers;

use App\Repositories\LinkRepository;
use App\Repositories\RepositoryContract;
use App\Services\LinkService;
use App\Services\ServiceContract;
use Core\Facades\Provider;

class AppServiceProvider extends Provider
{
    /**
     * Registrasi apa aja disini.
     *
     * @return void
     */
    public function registrasi()
    {
        $this->app->bind(RepositoryContract::class, LinkRepository::class);
        $this->app->bind(ServiceContract::class, LinkService::class);
    }

    /**
     * Jalankan sewaktu aplikasi dinyalakan.
     *
     * @return void
     */
    public function booting()
    {
        //
    }
}
