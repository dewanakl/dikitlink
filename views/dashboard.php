<?php parents('layout/home', ['title' => 'Dashboard']) ?>

<?php section('home') ?>

<div class="d-block d-sm-none card-body rounded-3 p-2 shadow-sm mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold m-1"><i class="fa-solid fa-home mx-2"></i>Halaman utama</p>
</div>

<div class="card-body rounded-3 p-4 shadow-sm mb-4" style="background-color: var(--bs-gray-200)">
    <h1 class="text-truncate fw-bold"><?= $salam ?>, <?= e(auth()->user()->nama) ?></h1>
    <p class="fw-semibold mb-0">Selamat datang di halaman utama dikit link, ayok bikin link yang banyak !</p>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border border-success border-2 shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="fw-bold mb-1">
                            Link saat ini
                        </h6>
                        <div class="h5 mb-0 fw-bold"><?= $jumlah_link ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-link fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border border-warning border-2 shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="fw-bold mb-1">
                            Pengunjung unik
                        </h6>
                        <div class="h5 mb-0 fw-bold"><?= $unique_pengunjung ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-fingerprint fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border border-danger border-2 shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="fw-bold mb-1">
                            Klik semua link
                        </h6>
                        <div class="h5 mb-0 fw-bold"><?= $total_pengunjung ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-computer-mouse fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endsection('home') ?>