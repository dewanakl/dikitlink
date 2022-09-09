<?= extend('auth/templates/top', ['title' => 'Sebentar', 'img' => 'password.svg']) ?>

<div class="container">
    <div class="row">
        <div class="col-auto mx-auto">
            <img src="<?= asset('password.svg') ?>" width="200" class="d-block d-md-none img-fluid ">
        </div>
        <div class="col-md-9 col-lg-8 mx-auto">
            <h1 class="fw-bold mt-3 mb-1">
                Sebentar
            </h1>
            <h6 class="mb-4 mt-3">Link "<?= e($name) ?>" diproteksi oleh password untuk membukanya !</h6>

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

            <form method="POST" action="<?= route('click', $name) ?>" onsubmit="passwordd()">
                <?= csrf() ?>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?> shadow-sm" id="floatingInputpassword" placeholder="Password">
                    <label for="floatingInputpassword" class="form-label"><i class="fa-solid fa-lock mx-1"></i>Password</label>
                    <?php if (error('password')) : ?>
                        <div class="invalid-feedback">
                            <?= error('password') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="d-grid">
                    <button class="btn btn-success fw-bold mb-2" id="button-passwordd" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const passwordd = () => {
        let btn = document.getElementById('button-passwordd');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>