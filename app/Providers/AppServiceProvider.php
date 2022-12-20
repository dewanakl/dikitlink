<?php

namespace App\Providers;

use Core\Facades\Provider;
use Repository\LinkRepository;
use Repository\RepositoryContract;
use Service\LinkService;
use Service\ServiceContract;

class AppServiceProvider extends Provider
{
    /**
     * Registrasi apa aja disini
     *
     * @return void
     */
    public function registrasi()
    {
        $this->app->bind(RepositoryContract::class, LinkRepository::class);
        $this->app->bind(ServiceContract::class, LinkService::class);
    }

    /**
     * Jalankan sewaktu aplikasi dinyalakan
     *
     * @return void
     */
    public function booting()
    {
        //
    }
}
