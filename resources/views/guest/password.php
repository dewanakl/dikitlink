<?php parents('layout/guest', ['title' => 'Sebentar', 'img' => 'password.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold">Sebentar</h1>
<h6 class="my-3">Link "<?= e($name) ?>" diproteksi oleh password untuk membukanya !</h6>

<?= including('layout/alert') ?>

<form method="POST" action="<?= route('click', $name) ?>" onsubmit="passwordlink()">
    <?= csrf() ?>
    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control shadow-sm <?= error('password', 'is-invalid') ?>" id="floatingInputpassword" placeholder="Password" required>
        <label for="floatingInputpassword" class="form-label"><i class="fa-solid fa-lock mx-1"></i>Password</label>
        <?php if (error('password')) : ?>
            <div class="invalid-feedback"><?= error('password') ?></div>
        <?php endif ?>
    </div>
    <div class="d-grid">
        <button class="btn btn-success fw-bold shadow my-2" id="button-passwordlink" type="submit">Kirim</button>
    </div>
</form>

<script>
    const passwordlink = () => {
        let btn = document.getElementById('button-passwordlink');
        btn.disabled = true;
        btn.className = 'btn btn-success active disabled fw-bold shadow my-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    }
</script>

<?php endsection('guest') ?>