<?= extend('templates/top', ['title' => 'Dashboard']) ?>

<div class="card-body rounded-3 p-4 shadow-sm mb-4" style="background-color: var(--bs-gray-200)">
    <h1 class="text-truncate fw-bold"><?= $salam ?>, <?= e(auth()->user()->nama) ?></h1>
    <p class="fw-semibold mb-0">Selamat datang di halaman utama dikit link, ayok bikin link yang banyak !</p>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-success shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="fw-bold text-success mb-1">
                            Link saat ini
                        </h5>
                        <div class="h4 mb-0 fw-bold"><?= $jumlah_link ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-link fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-warning shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="fw-bold text-warning mb-1">
                            Pengunjung unik
                        </h5>
                        <div class="h4 mb-0 fw-bold"><?= $unique_pengunjung ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-fingerprint fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card border-danger shadow-sm p-0">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="fw-bold text-danger mb-1">
                            Klik semua link
                        </h5>
                        <div class="h4 mb-0 fw-bold"><?= $total_pengunjung ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-computer-mouse fa-2x text-black-50 mx-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= extend('templates/down') ?>