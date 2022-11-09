<?php

namespace App\Providers;

use Core\Facades\Provider;
use Repository\LinkRepository;
use Repository\RepositoryContract;

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
