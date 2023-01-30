<?php parents('layout/guest', ['title' => 'Register', 'img' => 'register.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold mb-3">Register</h1>

<form method="POST" onsubmit="register()" id="submit-form">
    <?= csrf() ?>
    <div class="form-floating mb-3">
        <input type="text" name="nama" class="form-control shadow-sm <?= error('nama', 'is-invalid') ?>" id="floatingNama" placeholder="Nama" value="<?= old('nama') ?>" autocomplete="on">
        <label for="floatingNama"><i class="fa-solid fa-user mx-1"></i>Nama</label>
        <?php if (error('nama')) : ?>
            <div class="invalid-feedback"><?= error('nama') ?></div>
        <?php endif ?>
    </div>
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control shadow-sm <?= error('email', 'is-invalid') ?>" id="floatingEmail" placeholder="Email" value="<?= old('email') ?>" autocomplete="on">
        <label for="floatingEmail"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
        <?php if (error('email')) : ?>
            <div class="invalid-feedback"><?= error('email') ?></div>
        <?php endif ?>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control shadow-sm <?= error('password', 'is-invalid') ?>" id="floatingPassword" placeholder="Password" autocomplete="on">
        <label for="floatingPassword"><i class="fa-solid fa-lock mx-1"></i>Kata sandi</label>
        <?php if (error('password')) : ?>
            <div class="invalid-feedback"><?= error('password') ?></div>
        <?php endif ?>
    </div>
    <small class="text-dark">Dengan mendaftar, Anda setuju <a href="/" class="text-decoration-none text-primary">term & conditions</a> dan <a href="/" class="text-decoration-none text-primary">privacy policy</a> kami.</small>
    <div class="d-grid">
        <button class="g-recaptcha btn btn-success fw-bold shadow mt-3 mb-2" id="button-register" type="submit" <?php if (env('CAPTCHA_WEB')) : ?> onclick="register()" data-sitekey="<?= env('CAPTCHA_WEB') ?>" data-callback="onSubmit" data-action="register" <?php endif ?>>Daftar</button>
    </div>
    <hr class="text-dark">
    <div class="d-flex justify-content-center">
        <p class="fw-semibold">Sudah punya akun?<a href="<?= route('login') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Masuk</a></p>
    </div>
</form>

<script>
    const register = () => {
        let btn = document.getElementById('button-register');
        btn.disabled = true;
        btn.className = 'g-recaptcha btn btn-success active disabled fw-bold shadow mt-3 mb-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    }
</script>

<?php if (env('CAPTCHA_WEB')) : ?>
    <script>
        function onSubmit(token) {
            document.getElementById('submit-form').submit();
        }
    </script>
    <script src="https://google.com/recaptcha/api.js"></script>
<?php endif ?>

<?php endsection('guest') ?>