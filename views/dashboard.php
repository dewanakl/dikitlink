<?php parents('layout/home', ['title' => 'Dashboard']) ?>

<?php section('home') ?>

<div class="d-block d-sm-none card-body rounded-3 p-2 mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold m-1"><i class="fa-solid fa-home mx-2"></i>Halaman utama</p>
</div>

<div class="alert alert-info alert-dismissible fade show rounded-3" role="alert">
    <i class="fa-solid fa-circle-info"></i> Lakukan <strong>CTRL + F5</strong> untuk merefresh tampilan jika belum berubah.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<div class="card-body rounded-3 p-4 mb-4" style="background-color: var(--bs-gray-200)">
    <h2 class="text-truncate fw-bold"><?= $salam . ', ' . e(auth()->user()->nama) ?></h2>
    <p class="fw-semibold mb-0">Selamat datang di halaman utama dikit link, yukss bikin link yang banyak !</p>
</div>

<h5>Overview</h5>
<div class="row">
    <div class="col-lg-4 mb-3">
        <div class="card-body rounded-3 shadow p-3 border-0" style="background: #8D9EFF;">
            <div class="row align-items-center text-light">
                <div class="col">
                    <h6 class="fw-bold mb-1">
                        Link saat ini
                    </h6>
                    <div class="h5 mb-0 fw-bold"><?= $jumlah_link ?></div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-link fa-2x me-2"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card-body rounded-3 shadow p-3 border-0" style="background: #8D72E1;">
            <div class="row align-items-center text-light">
                <div class="col">
                    <h6 class="fw-bold mb-1">
                        Pengunjung unik
                    </h6>
                    <div class="h5 mb-0 fw-bold"><?= $unique_pengunjung ?></div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-fingerprint fa-2x me-2"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card-body rounded-3 shadow p-3 border-0" style="background: #6C4AB6;">
            <div class="row align-items-center text-light">
                <div class="col">
                    <h6 class="fw-bold mb-1">
                        Klik semua link
                    </h6>
                    <div class="h5 mb-0 fw-bold"><?= $total_pengunjung ?></div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-chart-simple fa-2x me-2"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endsection('home') ?>