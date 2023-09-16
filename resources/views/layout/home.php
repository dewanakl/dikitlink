<?php parents('layout/app') ?>

<?php section('preload.alert') ?>
<link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js" integrity="sha256-Cci6HROOxRjlhukr+AVya7ZcZnNZkLzvB7ccH/5aDic=" as="script" crossorigin="anonymous">
<?php endsection('preload.alert') ?>

<?php section('preload.chart') ?>
<link rel="preload" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js" integrity="sha256-Mh46P6mNpKqpV9EL5Xy7UU3gmJ7tj51ya10FkCzQGQQ=" as="script" crossorigin="anonymous">
<?php endsection('preload.chart') ?>

<?php if (session()->get('dark')) : ?>
    <?php section('preload.alert.dark') ?>
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css" integrity="sha256-Dtn0fzAID6WRybYFj3UI5JDBy9kE2adX1xPUlW+B4XQ=" as="style" crossorigin="anonymous">
    <?php endsection('preload.alert.dark') ?>
<?php endif ?>

<?php section('utiltop') ?>
<script src="<?= asset('js/utiltop.js') ?>"></script>
<?php endsection('utiltop') ?>


<?php section('main') ?>

<nav class="navbar navbar-<?= session()->get('dark') ? 'dark' : 'light' ?> bg-<?= session()->get('dark') ? 'dark' : 'light' ?> navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none m-0 p-0">
    <?= including('layout/navbar') ?>
</nav>

<div class="container mt-3 mb-5">
    <div class="d-flex d-none d-sm-flex justify-content-between align-items-center mt-4 mb-5">
        <h3 class="d-none d-sm-block fw-bold m-0 p-0">Dikit<i class="fa-solid fa-link mx-2"></i>Link</h3>
        <h4 class="m-0 p-0 text-truncate">Haii, <?= e(auth()->user()->nama) ?></h4>
    </div>
    <div class="row">
        <div class="col-md-3 d-none d-md-block">
            <div class="pe-4">
                <?= including('layout/sidebar') ?>
            </div>
        </div>
        <div class="col-md-9">
            <?= content('home') ?>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom rounded-top-4" style="height: 50vh;" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Tambah Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pt-0">
        <form id="addlinkmobile">
            <div class="mb-3">
                <label for="valueaddnamemobile"><i class="fa-solid fa-quote-left me-1"></i>Nama</label>
                <input type="text" class="form-control" id="valueaddnamemobile" placeholder="Nama">
                <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
            </div>
            <div class="mb-3">
                <label for="valueaddlinkmobile"><i class="fa-solid fa-link me-1"></i>Link</label>
                <textarea class="form-control" id="valueaddlinkmobile" placeholder="https://google.com/" required></textarea>
            </div>
            <div class="d-grid text-center">
                <button type="submit" class="btn btn-success" id="valueaddtambahmobile"><i class="fas fa-plus me-1"></i>Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="addlinkmodal" tabindex="-1" aria-labelledby="addlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down modal-lg">
        <div class="modal-content">
            <form id="addlink">
                <div class="modal-header">
                    <h5 class="modal-title" id="addlinkLabel">Tambah link</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="valueaddname"><i class="fa-solid fa-quote-left me-1"></i>Nama</label>
                        <input type="text" class="form-control" id="valueaddname" placeholder="Name">
                        <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueaddlink"><i class="fa-solid fa-link me-1"></i>Link</label>
                        <textarea class="form-control" id="valueaddlink" placeholder="https://google.com/" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueaddbatal" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button type="submit" class="btn btn-success" id="valueaddtambah"><i class="fas fa-plus me-1"></i>Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout ?</h5>
            </div>
            <div class="modal-body">
                <h5>Apakah anda ingin Logout ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="button-logout-batal"><i class="fas fa-times me-1"></i>Batal</button>
                <form action="<?= route('logout') ?>" method="post" onsubmit="logout()">
                    <?= csrf() ?>
                    <?= method('delete') ?>
                    <button type="submit" class="btn btn-danger" id="button-logout"><i class="fas fa-sign-out-alt me-1"></i>Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js" integrity="sha256-Cci6HROOxRjlhukr+AVya7ZcZnNZkLzvB7ccH/5aDic=" crossorigin="anonymous"></script>
<?php if (session()->get('dark')) : ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@5.0.15/dark.min.css" integrity="sha256-Dtn0fzAID6WRybYFj3UI5JDBy9kE2adX1xPUlW+B4XQ=" crossorigin="anonymous">
<?php endif ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js" integrity="sha256-Mh46P6mNpKqpV9EL5Xy7UU3gmJ7tj51ya10FkCzQGQQ=" crossorigin="anonymous"></script>
<script src="<?= asset('js/utildown.js') ?>"></script>

<?php endsection('main') ?>