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
                    <svg class="flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <div>
                        <strong><?= $pesan ?></strong>
                    </div>
                </div>
            <?php endif ?>

            <?php if ($pesan = flash('gagal')) : ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <svg class="flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    <div>
                        <strong><?= $pesan ?></strong>
                    </div>
                </div>
            <?php endif ?>

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" onsubmit="login()">
                        <?= csrf() ?>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingInputlogin" placeholder="Email" value="<?= old('email') ?>">
                            <label for="floatingInputlogin" class="form-label">Email</label>
                            <?php if (error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?>" id="floatingPasswordlogin" placeholder="Password" autocomplete="off">
                            <label for="floatingPasswordlogin" class="form-label">Kata sandi</label>
                            <?php if (error('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('password') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-primary fw-bold mb-2" id="button-login" type="submit">Masuk</button>
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
        btn.innerText = 'Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>