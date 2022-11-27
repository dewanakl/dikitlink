<?php parents('layout/guest', ['title' => 'Login', 'img' => 'login.svg']) ?>

<?php section('guest') ?>

<div class="container">
    <div class="row">
        <div class="col-auto mx-auto">
            <img src="<?= asset('login.svg') ?>" width="200" class="d-block d-md-none img-fluid ">
        </div>
        <div class="col-md-9 col-lg-8 mx-auto">
            <div class="d-flex justify-content-start">
                <h1 class="fw-bold mt-3 mb-4">
                    Login
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

            <form method="POST" onsubmit="login()">
                <?= csrf() ?>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?> shadow-sm" id="floatingInputlogin" placeholder="Email" value="<?= old('email') ?>">
                    <label for="floatingInputlogin" class="form-label"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
                    <?php if (error('email')) : ?>
                        <div class="invalid-feedback">
                            <?= error('email') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?> shadow-sm" id="floatingPasswordlogin" placeholder="Password" autocomplete="off">
                    <label for="floatingPasswordlogin" class="form-label"><i class="fa-solid fa-lock mx-1"></i>Kata sandi</label>
                    <?php if (error('password')) : ?>
                        <div class="invalid-feedback">
                            <?= error('password') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="fw-semibold my-2"><a href="<?= route('forget') ?>" class="hover p-1 rounded text-decoration-none text-primary">Lupa password?</a></p>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary fw-bold my-2 " id="button-login" type="submit">Masuk</button>
                </div>
                <hr class="text-dark">
                <div class="d-flex justify-content-center">
                    <p class="fw-semibold">Belum punya akun?<a href="<?= route('register') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const login = () => {
        let btn = document.getElementById('button-login');
        btn.disabled = true;
        btn.className = 'btn btn-primary active disabled fw-bold my-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?php endsection('guest') ?>