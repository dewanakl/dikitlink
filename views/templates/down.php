</div>
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
                        <input type="url" class="form-control" id="valueaddlink" placeholder="https://www.google.com/" required>
                    </div>
                    <div class="d-grid">
                        <a class="btn btn-primary btn-sm" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Lebih lanjut
                        </a>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="mb-3">
                            <label for="valueaddpassword">Password</label>
                            <input type="text" class="form-control" id="valueaddpassword">
                        </div>
                        <!-- <input type="datetime-local" class="form-control" name="times" id="tgl-test" /> -->
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

<?php if (routeIs('list')) : ?>
    <script src="<?= asset('js/list.js') ?>" defer></script>
<?php endif ?>
<script>
    const logout = () => {
        let btnbatal = document.getElementById('button-logout-batal');
        let btn = document.getElementById('button-logout');
        btn.disabled = true;
        btnbatal.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>
<?= extend('templates/baseDown') ?>