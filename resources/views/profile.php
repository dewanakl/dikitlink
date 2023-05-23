<?php parents('layout/home', ['title' => 'Profile']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold text-dark m-1"><i class="fa-solid fa-address-card mx-2"></i>Profil kamu</p>
</div>

<?php if (!auth()->user()->email_verify) : ?>
    <div class="alert alert-warning fade show px-3 py-2" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-envelope mx-1"></i>Email belum terverifikasi !
            <form action="<?= route('email') ?>" class="ms-auto" method="post" onsubmit="verif()">
                <?= csrf() ?>
                <button type="submit" class="btn btn-danger btn-sm" id="button-verif">Kirim !</button>
            </form>
        </div>
    </div>
    <script>
        const verif = () => {
            let btn = document.getElementById('button-verif');
            btn.disabled = true;
            btn.className = 'btn btn-danger btn-sm active';
            btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
        };
    </script>
<?php endif ?>

<div class="row align-items-center">
    <div class="col-3">
        <img src="<?= route('avatar') ?>" loading="eager" class="mx-auto d-block rounded-circle" style="width: 65%;">
    </div>
    <div class="col-9">
        <h4 class="fw-bold"><?= e(auth()->user()->nama) ?><?= auth()->user()->email_verify ? '<i class="fa-solid fa-circle-check text-success ms-2"></i>' : '' ?></h4>
        <p class="d-block m-0 p-0"><i class="fas fa-envelope me-1"></i><?= e(auth()->user()->email) ?></p>
        <small class="d-block"><i class="fas fa-user-clock me-1"></i><?= date('d M Y, H:i', strtotime((auth()->user()->created_at))) ?></small>
    </div>
</div>

<hr>
<h5>Pengaturan</h5>

<div class="form-check form-switch mb-2">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= !auth()->user()->statistics ?: 'checked' ?>>
    <div class="spinner-border spinner-border-sm" id="loading-switch" style="display: none;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <label class="form-check-label" for="flexSwitchCheckChecked">Simpan Semua Statistik</label>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckCheckedTheme" <?= !session()->get('dark') ?: 'checked' ?>>
    <div class="spinner-border spinner-border-sm" id="loading-switch-theme" style="display: none;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <label class="form-check-label" for="flexSwitchCheckCheckedTheme">Tampilan Gelap</label>
</div>

<button type="button" class="btn btn-outline-success btn-sm" onclick="riwayatlogin()"><i class="fa-solid fa-clock-rotate-left me-1"></i>Riwayat Login</button>
<div class="modal fade" id="riwayatloginModal" tabindex="-1" aria-labelledby="riwayatloginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="riwayatloginModalLabel">Riwayat Login</h1>
            </div>
            <div class="modal-body" id="riwayatid" style="overflow: overlay;"></div>
            <div class="modal-footer d-inline d-lg-flex">
                <div class="d-grid">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fas fa-check me-1"></i>Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<h5>Update profile</h5>

<div class="row">
    <div class="col-md-7">
        <form method="post" onsubmit="update()">
            <?= csrf() ?>
            <?= method('put') ?>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Nama" class="form-control <?= error('nama', 'is-invalid') ?>" name="nama" value="<?= e(auth()->user()->nama) ?>" required>
                <?php if (error('nama')) : ?>
                    <div class="invalid-feedback"><?= error('nama') ?></div>
                <?php endif ?>
            </div>

            <?php if (is_null(auth()->user()->email_verify)) : ?>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" placeholder="Email" class="form-control <?= error('email', 'is-invalid') ?>" name="email" value="<?= e(auth()->user()->email) ?>" required>
                    <?php if (error('email')) : ?>
                        <div class="invalid-feedback"><?= error('email') ?></div>
                    <?php endif ?>
                </div>
            <?php endif ?>

            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" placeholder="Password" class="form-control <?= error('password', 'is-invalid') ?>" name="password" autocomplete="off">
                        <?php if (error('password')) : ?>
                            <div class="invalid-feedback"><?= error('password') ?></div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-redo"></i></span>
                        <input type="password" placeholder="Repeat" class="form-control  <?= error('konfirmasi_password', 'is-invalid') ?>" name="konfirmasi_password" autocomplete="off">
                        <?php if (error('konfirmasi_password')) : ?>
                            <div class="invalid-feedback"><?= error('konfirmasi_password') ?></div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-inline d-md-flex">
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-sm" id="button-update">
                        <i class="fas fa-check me-1"></i>Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="d-grid d-block d-md-none">
    <hr>
    <h5>Logout</h5>
    <a href="javascript:void(0);" class="btn btn-danger btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt me-1"></i>Logout
    </a>
</div>

<hr>
<h5>Zona berbahaya</h5>
<div class="d-md-block d-grid">
    <button type="button" class="btn btn-outline-danger btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#hapusakun">
        <i class="fa-solid fa-triangle-exclamation me-1"></i>Hapus Akun
    </button>
</div>
<div class="modal fade" id="hapusakun" tabindex="-1" aria-labelledby="hapusakunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('hapus.profile') ?>" method="post" onsubmit="deleteakun()">
            <?= csrf() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusakunLabel">Hapus akun</h1>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-2">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" placeholder="Password" class="form-control" name="mypassword" autocomplete="off" required>
                    </div>
                    <small class="text-danger">Dengan menghapus akun bearti menghapus semua data pada database kami.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="button-deleteakun-batal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button type="submit" class="btn btn-danger" id="button-deleteakun"><i class="fa-solid fa-trash me-1"></i>Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php if ($pesan = flash('berhasil')) : ?>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= $pesan ?>`,
                icon: 'success',
                confirmButtonText: '<i class="fas fa-check me-1"></i>Oke',
            });
        });
    </script>
<?php endif ?>

<?php if ($pesan = flash('gagal')) : ?>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= $pesan ?>`,
                icon: 'error',
                confirmButtonText: '<i class="fas fa-check me-1"></i>Oke',
            });
        });
    </script>
<?php endif ?>

<?php if (error('mypassword')) : ?>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= error('mypassword') ?>`,
                icon: 'error',
                confirmButtonText: '<i class="fas fa-check me-1"></i>Oke',
            });
        });
    </script>
<?php endif ?>

<script defer>
    const renderCard = (data) => {
        const DIV = document.createElement('div');
        DIV.classList.add('mb-3');
        DIV.innerHTML = `
        <div class="card-body shadow p-3 rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-truncate m-0 p-0" style="max-width: 40%;">
                    <strong>${escapeHtml(data.ip_address)}</strong>
                </h6>
                <small class="text-dark rounded m-0" style="background-color: var(--bs-gray-200)">
                    <i class="fa-solid fa-clock ms-1"></i>
                    <span class="ms-0 me-1 my-0 p-0">${data.created_at}</span>
                </small>
            </div>
            <hr class="mb-2">
            <small class="mt-2 mb-1 mx-0 p-0">${escapeHtml(data.user_agent)}</small>
        </div>`;
        return DIV;
    };

    const riwayatlogin = async () => {
        const myModal = new bootstrap.Modal(document.getElementById('riwayatloginModal'));
        myModal.show();

        const RIWAYAT = document.getElementById('riwayatid');
        RIWAYAT.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>Loading...`;

        await fetch(`<?= route('log') ?>`)
            .then((data) => data.json())
            .then((data) => {
                RIWAYAT.innerHTML = null;
                data.forEach((data) => RIWAYAT.appendChild(renderCard(data)));
                if (data.length == 0) {
                    RIWAYAT.innerHTML = `<div class="h6 text-center">Tidak ada data</div>`;
                }
            })
            .catch((err) => showModal(err, 'error'));
    };

    const deleteakun = () => {
        let btnbatal = document.getElementById('button-deleteakun-batal');
        let btn = document.getElementById('button-deleteakun');
        btn.disabled = true;
        btnbatal.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    };

    const update = () => {
        let btn = document.getElementById('button-update');
        btn.disabled = true;
        btn.className = 'btn btn-primary btn-sm active';
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    };

    const checkbox = document.getElementById('flexSwitchCheckChecked');
    checkbox.addEventListener('change', async (event) => {
        checkbox.disabled = true;
        document.getElementById('loading-switch').style.display = 'inline-block';

        let check = false;
        if (event.currentTarget.checked) {
            check = true;
        }

        const REQ = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'token': TOKEN
            },
            body: JSON.stringify({
                check: check,
            })
        };

        await fetch(`<?= route('statistik.profile') ?>`, REQ)
            .then((res) => res.json())
            .then((res) => {
                if (res.status == 0) {
                    showModal('Server error', 'error');
                }
            })
            .catch((res) => {
                showModal(res, 'error');
            });

        checkbox.disabled = false;
        document.getElementById('loading-switch').style.display = 'none';
    });

    const checkboxtheme = document.getElementById('flexSwitchCheckCheckedTheme');
    checkboxtheme.addEventListener('change', async (event) => {
        checkboxtheme.disabled = true;
        document.getElementById('loading-switch-theme').style.display = 'inline-block';

        let check = 'light';
        if (event.currentTarget.checked) {
            check = 'dark';
        }

        window.location.href = window.location.href + '?' + check;
    });
</script>

<?php endsection('home') ?>