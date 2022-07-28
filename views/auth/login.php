<?= extend('auth/templates/top', ['title' => 'Login']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">

            <?php if ($pesan = flash('berhasil')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $pesan ?>
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
                        <div class="d-flex justify-content-center">
                            <a href="<?= route('register') ?>" style="text-decoration:none;">Lupa Kata Sandi?</a>
                        </div>
                        <hr class="text-dark">
                        <div class="d-flex justify-content-center">
                            <a href="<?= route('register') ?>" class="btn btn-success fw-bold mb-2" type="button">Buat Akun Baru</a>
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