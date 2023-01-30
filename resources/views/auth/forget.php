<?php parents('layout/guest', ['title' => 'Reset password', 'img' => 'forget.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold">Kelupaan ?</h1>
<h6 class="mb-3">Jangan panik, pastikan email kamu aktif aja..</h6>

<?= including('layout/alert') ?>

<form method="POST" onsubmit="forget()" id="submit-form">
    <?= csrf() ?>
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control shadow-sm <?= error('email', 'is-invalid') ?>" id="floatingInputforget" placeholder="Email" value="<?= old('email') ?>" autocomplete="on">
        <label for="floatingInputforget" class="form-label"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
        <?php if (error('email')) : ?>
            <div class="invalid-feedback"><?= error('email') ?></div>
        <?php endif ?>
    </div>
    <div class="d-grid">
        <button class="g-recaptcha btn btn-warning fw-bold shadow my-2" id="button-forget" type="submit" <?php if (env('CAPTCHA_WEB')) : ?> onclick="forget()" data-sitekey="<?= env('CAPTCHA_WEB') ?>" data-callback="onSubmit" data-action="forget" <?php endif ?>>Kirim</button>
    </div>
    <hr class="text-dark">
    <div class="d-flex justify-content-center">
        <p class="fw-semibold">Tiba tiba ingat lagi?<a href="<?= route('login') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Login</a></p>
    </div>
</form>

<script>
    const forget = () => {
        let btn = document.getElementById('button-forget');
        btn.disabled = true;
        btn.className = 'g-recaptcha btn btn-warning active disabled fw-bold shadow my-2'
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