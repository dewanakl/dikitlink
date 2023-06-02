<?php parents('layout/guest', ['title' => 'Login', 'img' => 'login.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold mb-3">Login</h1>

<?= including('layout/alert') ?>

<form method="POST" onsubmit="login()" id="submit-form">
    <?= csrf() ?>
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control shadow-sm <?= error('email', 'is-invalid') ?>" id="floatingInputlogin" placeholder="Email" value="<?= old('email') ?>" autocomplete="on">
        <label for="floatingInputlogin" class="form-label"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
        <?php if (error('email')) : ?>
            <div class="invalid-feedback"><?= error('email') ?></div>
        <?php endif ?>
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control shadow-sm <?= error('password', 'is-invalid') ?>" id="floatingPasswordlogin" placeholder="Password" autocomplete="on">
        <label for="floatingPasswordlogin" class="form-label"><i class="fa-solid fa-lock mx-1"></i>Kata sandi</label>
        <?php if (error('password')) : ?>
            <div class="invalid-feedback"><?= error('password') ?></div>
        <?php endif ?>
    </div>
    <div class="d-flex justify-content-end">
        <p class="fw-semibold my-2"><a href="<?= route('forget') ?>" class="hover p-1 rounded text-decoration-none text-primary">Lupa kata sandi?</a></p>
    </div>
    <div class="d-grid">
        <button class="g-recaptcha btn btn-primary fw-bold shadow my-2" id="button-login" type="submit" <?php if (env('CAPTCHA_WEB')) : ?> onclick="login()" data-sitekey="<?= env('CAPTCHA_WEB') ?>" data-callback="onSubmit" data-action="login" <?php endif ?>>Masuk</button>
    </div>
    <hr class="text-dark">
    <div class="d-flex justify-content-center">
        <p class="fw-semibold">Belum punya akun?<a href="<?= route('register') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Register</a></p>
    </div>
</form>

<script>
    const login = () => {
        let btn = document.getElementById('button-login');
        btn.disabled = true;
        btn.className = 'g-recaptcha btn btn-primary active disabled fw-bold shadow my-2'
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