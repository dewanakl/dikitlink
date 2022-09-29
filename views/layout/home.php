<?php parents('layout/app') ?>

<?php section('preload.home') ?>
<link rel="preload" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.31/dist/sweetalert2.all.min.js" integrity="sha256-ggd5OAL5qzG/QNS7HMsiPFhPjD0GDS1Lej7cfgR4cv4=" crossorigin="anonymous" as="script" />
<link rel="preload" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous" as="script" />
<?php endsection('preload.home') ?>

<?php section('utiltop') ?>
<!-- Util.js -->
<script src="<?= asset('js/utiltop.js') ?>"></script>
<?php endsection('utiltop') ?>


<?php section('main') ?>
<?= including('layout/navbar') ?>

<div class="container mt-3 mb-5">
    <div class="d-flex d-none d-sm-flex justify-content-between align-items-center mb-4 mt-4">
        <h4 class="d-none d-sm-block fw-bold mx-1">Dikit<i class="fa-solid fa-link mx-1"></i>Link</h4>
        <h4 class="text-truncate mx-1">Haii, <?= e(auth()->user()->nama) ?></h4>
    </div>
    <div class="row">
        <?= including('layout/sidebar') ?>
        <div class="col-md-9">
            <?= content('home') ?>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom" style="height: 50vh;" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">Tambah Link</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pt-0">
        <form id="addlinkmobile">
            <div class="mb-3">
                <label for="valueaddnamemobile">Nama</label>
                <input type="text" class="form-control" id="valueaddnamemobile" placeholder="Nama">
                <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
            </div>
            <div class="mb-3">
                <label for="valueaddlinkmobile">Link</label>
                <textarea class="form-control" id="valueaddlinkmobile" placeholder="https://www.google.com/" required></textarea>
            </div>
            <div class="d-grid text-center mb-0">
                <button type="submit" class="btn btn-success" id="valueaddtambahmobile"><i class="fas fa-plus mx-1"></i>Tambah</button>
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
                        <label for="valueaddname">Nama</label>
                        <input type="text" class="form-control" id="valueaddname" placeholder="Name">
                        <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueaddlink">Link</label>
                        <textarea class="form-control" id="valueaddlink" placeholder="https://www.google.com/" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueaddbatal" data-bs-dismiss="modal"><i class="fas fa-times mx-1"></i>Batal</button>
                    <button type="submit" class="btn btn-success" id="valueaddtambah"><i class="fas fa-plus mx-1"></i>Tambah</button>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="button-logout-batal"><i class="fas fa-times mx-1"></i>Batal</button>
                <form action="<?= route('logout') ?>" method="post" onsubmit="logout()">
                    <?= csrf() ?>
                    <?= method('delete') ?>
                    <button type="submit" class="btn btn-danger" id="button-logout"><i class="fas fa-sign-out-alt mx-1"></i>Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.31/dist/sweetalert2.all.min.js" integrity="sha256-ggd5OAL5qzG/QNS7HMsiPFhPjD0GDS1Lej7cfgR4cv4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js" integrity="sha256-+8RZJua0aEWg+QVVKg4LEzEEm/8RFez5Tb4JBNiV5xA=" crossorigin="anonymous"></script>

<!-- Util.js -->
<script src="<?= asset('js/utildown.js') ?>"></script>

<?php endsection('main') ?>