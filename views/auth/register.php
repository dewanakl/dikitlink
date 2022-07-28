<?= extend('auth/templates/top', ['title' => 'Register']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
            <?php if ($pesan = flash('gagal')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $pesan ?>
                </div>
            <?php endif ?>
            <h2 class="text-dark">Register</h2>
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" onsubmit="register()">
                        <?= csrf() ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control <?= error('nama', 'is-invalid') ?>" id="floatingNama" placeholder="Nama" value="<?= old('nama') ?>">
                            <label for="floatingNama">Nama</label>
                            <?php if (error('nama')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('nama') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingEmail" placeholder="Email" value="<?= old('email') ?>">
                            <label for="floatingEmail">Email</label>
                            <?php if (error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?>" id="floatingPassword" placeholder="Password" autocomplete="off">
                            <label for="floatingPassword">Kata sandi</label>
                            <?php if (error('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('password') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-success btn-login fw-bold mb-2" id="button-register" type="submit">Daftar</button>
                        </div>
                        <hr class="text-dark">
                        <div class="row justify-content-center">
                            <a href="<?= route('login') ?>" class="col-8 btn btn-primary mb-2" type="button">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
            <small><?= getPageTime() ?></small>
        </div>
    </div>
</div>

<script>
    const register = () => {
        let btn = document.getElementById('button-register');
        btn.disabled = true;
        btn.innerText = 'Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>