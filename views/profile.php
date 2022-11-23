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

<div class="card shadow-sm border-dark mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5 class="card-title"><?= e(auth()->user()->nama) ?> <?= auth()->user()->email_verify ? '<i class="fa-solid fa-circle-check text-primary"></i>' : '' ?></h5>
                <hr>
                <p class="card-text"><i class="fas fa-envelope"></i> <?= e(auth()->user()->email) ?></p>
                <p class="card-text"><i class="fas fa-user-clock"></i> <?= date("d M Y, H:i", strtotime((auth()->user()->created_at))) ?></p>
                <p class="card-text"><i class="fas fa-history"></i> <?= date("d M Y, H:i", strtotime((auth()->user()->updated_at))) ?></p>
                <hr class="mb-0">
            </div>
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
    </div>
</div>

<form action="<?= route('hapus.profile') ?>" method="post">
    <?= csrf() ?>
    <input type="text" name="mypassword" class="form-control" />
    <?php if (error('mypassword')) : ?>
        <?= error('mypassword') ?>
    <?php endif ?>
    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
</form>

<div class="d-grid d-block d-sm-none mb-4">
    <a href="javascript:void(0);" class="btn btn-danger  fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt ms-2 me-1"></i>Logout
    </a>
</div>

<?php if ($pesan = flash('berhasil')) : ?>
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= $pesan ?>`,
                icon: 'success',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
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
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            });
        });
    </script>
<?php endif ?>

<script>
    const update = () => {
        let btn = document.getElementById('button-update');
        btn.disabled = true;
        btn.className = 'btn btn-primary btn-sm  active';
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?php endsection('home') ?>