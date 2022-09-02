<?= extend('auth/templates/top', ['title' => 'Reset password']) ?>

<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-8 mx-auto">
            <div class="d-flex justify-content-center">
                <h1 class="d-block d-md-none fw-bold mb-4" style="font-size:40px;">
                    Dikit-Link
                </h1>
            </div>

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

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" onsubmit="forget()">
                        <?= csrf() ?>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingInputforget" placeholder="Email" value="<?= old('email') ?>">
                            <label for="floatingInputforget" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
                            <?php if (error('email')) : ?>
                                <div class="invalid-feedback">
                                    <?= error('email') ?>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-warning fw-bold mb-2" id="button-forget" type="submit">Reset Password</button>
                        </div>
                    </form>
                    <a href="<?= route('register') ?>">Bikin akun ?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const forget = () => {
        let btn = document.getElementById('button-forget');
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?= extend('auth/templates/down') ?>