<?= extend('auth/templates/top', ['title' => 'Login']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
            <div class="d-flex justify-content-center">
                <h1 class="d-block d-md-none fw-bold mb-4" style="font-size:40px;">
                    Dikit-Link
                </h1>
            </div>

            <?php if ($pesan = flash('berhasil')) : ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check mx-1 my-0"></i>
                    <strong class="mx-1 my-0"><?= $pesan ?></strong>
                </div>
            <?php endif ?>

            <?php if ($pesan = flash('gagal')) : ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation mx-1 my-0"></i>
                    <strong class="mx-1 my-0"><?= $pesan ?></strong>
                </div>
            <?php endif ?>

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" onsubmit="login()">
                        <?= csrf() ?>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingInputlogin" placeholder="Email" value="<?= old('email') ?>">
                            <label for="floatingInputlogin" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
                            <?php if (error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?>" id="floatingPasswordlogin" placeholder="Password" autocomplete="off">
                            <label for="floatingPasswordlogin" class="form-label"><i class="fa-solid fa-lock"></i> Kata sandi</label>
                            <?php if (error('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('password') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-flex justify-content-between align-items-top">
                            <a href="<?= route('forget') ?>">Reset password</a>
                            <button class="btn btn-primary fw-bold mb-2" id="button-login" type="submit">Masuk</button>
                        </div>
                        <hr class="text-dark">
                        <div class="row d-flex justify-content-center">
                            <a href="<?= route('register') ?>" class="col-8 btn btn-success fw-bold mb-2" type="button">Buat Akun Baru</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const login = () => {
        let btn = document.getElementById('button-login');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>