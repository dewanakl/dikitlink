<?php parents('layout/guest', ['title' => 'Reset password', 'img' => 'forget.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold">Kelupaan ?</h1>
<h6 class="mb-3">Jangan panik, pastikan email kamu aktif aja..</h6>

<?= including('layout/alert') ?>

<form method="POST" onsubmit="forget()">
    <?= csrf() ?>
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingInputforget" placeholder="Email" value="<?= old('email') ?>" autocomplete="on" required>
        <label for="floatingInputforget" class="form-label"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
        <?php if (error('email')) : ?>
            <div class="invalid-feedback"><?= error('email') ?></div>
        <?php endif ?>
    </div>
    <div class="d-grid">
        <button class="btn btn-warning fw-bold my-2" id="button-forget" type="submit">Kirim</button>
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
        btn.className = 'btn btn-warning active disabled fw-bold my-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    }
</script>

<?php endsection('guest') ?>