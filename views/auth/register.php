<?= extend('auth/templates/top', ['title' => 'Register']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
            <div class="d-flex justify-content-center">
                <h1 class="d-block d-md-none fw-bold mb-4" style="font-size:40px;">
                    Dikit-Link
                </h1>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" onsubmit="register()">
                        <?= csrf() ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control <?= error('nama', 'is-invalid') ?>" id="floatingNama" placeholder="Nama" value="<?= old('nama') ?>">
                            <label for="floatingNama"><i class="fa-solid fa-user"></i> Nama</label>
                            <?php if (error('nama')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('nama') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingEmail" placeholder="Email" value="<?= old('email') ?>">
                            <label for="floatingEmail"><i class="fa-solid fa-envelope"></i> Email</label>
                            <?php if (error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?>" id="floatingPassword" placeholder="Password" autocomplete="off">
                            <label for="floatingPassword"><i class="fa-solid fa-lock"></i> Kata sandi</label>
                            <?php if (error('password')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('password') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-lg btn-success fw-bold mb-2" id="button-register" type="submit">Daftar</button>
                        </div>
                        <hr class="text-dark">
                        <div class="row d-flex justify-content-center">
                            <a href="<?= route('login') ?>" class="col-8 btn btn-primary fw-bold mb-2" type="button">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const register = () => {
        let btn = document.getElementById('button-register');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>