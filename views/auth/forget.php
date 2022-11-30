<?php parents('layout/guest', ['title' => 'Reset password', 'img' => 'forget.svg']) ?>

<?php section('guest') ?>

<div class="row">
    <div class="col-auto mx-auto">
        <img src="<?= asset('forget.svg') ?>" style="width: 65%;" class="d-block d-md-none img-fluid mx-auto">
    </div>

    <div class="col-md-9 col-lg-8 mx-auto">
        <h1 class="fw-bold mt-3 mb-2">
            Kelupaan ?
        </h1>

        <h6 class="mb-4">Jangan panik, pastikan email kamu aktif aja..</h6>

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

        <form method="POST" onsubmit="forget()">
            <?= csrf() ?>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingInputforget" placeholder="Email" value="<?= old('email') ?>">
                <label for="floatingInputforget" class="form-label"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
                <?php if (error('email')) : ?>
                    <div class="invalid-feedback">
                        <?= error('email') ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="d-grid">
                <button class="btn btn-warning fw-bold mb-2" id="button-forget" type="submit">Kirim</button>
            </div>
            <hr class="text-dark">
            <div class="d-flex justify-content-center">
                <p class="fw-semibold">Tiba tiba ingat lagi?<a href="<?= route('login') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Login</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    const forget = () => {
        let btn = document.getElementById('button-forget');
        btn.disabled = true;
        btn.className = 'btn btn-warning  active disabled fw-bold mb-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?php endsection('guest') ?>