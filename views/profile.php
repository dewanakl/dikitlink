<?php parents('layout/home', ['title' => 'Profile']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 shadow-sm mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold m-1"><i class="fa-solid fa-address-card mx-2"></i>Profil kamu</p>
</div>

<?php if (!auth()->user()->email_verify) : ?>
    <div class="alert alert-warning fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-envelope mx-1"></i>
            Email berlum terverifikasi !
            <form action="<?= route('email') ?>" class="ms-2" method="post">
                <?= csrf() ?>
                <button type="submit" class="btn btn-danger btn-sm">Kirim !</button>
            </form>
        </div>
    </div>
<?php endif ?>

<h2><?= e(auth()->user()->nama) ?> <?= auth()->user()->email_verify ? '<i class="fa-solid fa-circle-check text-primary"></i>' : '' ?></h2>
<hr>

<p><i class="fas fa-envelope me-1"></i><?= e(auth()->user()->email) ?></p>
<p><i class="fas fa-user-clock me-1"></i><?= date("d M Y, H:i", strtotime((auth()->user()->created_at))) ?></p>

<hr>
<h5>Pengaturan</h5>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= !auth()->user()->statistics ?: 'checked' ?>>
    <div class="spinner-border spinner-border-sm" id="loading-switch" style="display: none;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <label class="form-check-label" for="flexSwitchCheckChecked">Simpan Statistik</label>
</div>

<hr>
<h5>Update profile</h5>

<div class="row">
    <div class="col-md-8">
        <form method="post" class="mt-3 mx-1" onsubmit="update()">
            <?= csrf() ?>
            <?= method('put') ?>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input type="text" placeholder="Nama" class="form-control  <?= error('nama', 'is-invalid') ?>" name="nama" value="<?= e(auth()->user()->nama) ?>">

                <?php if (error('nama')) : ?>
                    <div class="invalid-feedback">
                        <?= error('nama') ?>
                    </div>
                <?php endif ?>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input type="email" placeholder="Email" class="form-control <?= error('email', 'is-invalid') ?>" name="email" value="<?= e(auth()->user()->email) ?>" <?= auth()->user()->email_verify ? 'disabled' : '' ?>>

                <?php if (error('email')) : ?>
                    <div class="invalid-feedback">
                        <?= error('email') ?>
                    </div>
                <?php endif ?>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" placeholder="Password" class="form-control <?= error('password', 'is-invalid') ?>" name="password" autocomplete="off">

                        <?php if (error('password')) : ?>
                            <div class="invalid-feedback">
                                <?= error('password') ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>

                <div class="col-md-6 ms-auto">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-redo"></i></span>
                        <input type="password" placeholder="Repeat" class="form-control  <?= error('konfirmasi_password', 'is-invalid') ?>" name="konfirmasi_password" autocomplete="off">

                        <?php if (error('konfirmasi_password')) : ?>
                            <div class="invalid-feedback">
                                <?= error('konfirmasi_password') ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-sm " id="button-update">
                    <i class="fas fa-check mx-1"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<div class="d-grid d-block d-sm-none">
    <hr>
    <a href="javascript:void(0);" class="btn btn-danger fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt ms-2 me-1"></i>Logout
    </a>
</div>

<hr>
<h5>Zona berbahaya</h5>
<div class="d-md-block d-grid">
    <button type="button" class="btn btn-outline-danger mb-4" data-bs-toggle="modal" data-bs-target="#hapusakun">
        <i class="fa-solid fa-triangle-exclamation me-1"></i>Hapus Akun
    </button>
</div>
<div class="modal fade" id="hapusakun" tabindex="-1" aria-labelledby="hapusakunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= route('hapus.profile') ?>" method="post">
            <?= csrf() ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusakunLabel">Hapus akun</h1>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" placeholder="Password" class="form-control <?= error('mypassword', 'is-invalid') ?>" name="mypassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash me-1"></i>Hapus</button>
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
    const update = () => {
        let btn = document.getElementById('button-update');
        btn.disabled = true;
        btn.className = 'btn btn-primary btn-sm  active';
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
            method: 'POST',
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
                if (!res.status) {
                    showModal('Server error', 'error');
                }
            })
            .catch((res) => {
                showModal(res, 'error');
            });

        checkbox.disabled = false;
        document.getElementById('loading-switch').style.display = 'none';
    });
</script>

<?php endsection('home') ?>