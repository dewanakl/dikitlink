<?php parents('layout/guest', ['title' => 'Register', 'img' => 'register.svg']) ?>

<?php section('guest') ?>

<div class="row">
    <div class="col-auto mx-auto">
        <img src="<?= asset('register.svg') ?>" style="width: 65%;" width="150" class="d-block d-md-none img-fluid mx-auto">
    </div>
    <div class="col-md-9 col-lg-8 mx-auto">
        <div class="d-flex justify-content-start">
            <h1 class="fw-bold mt-3 mb-4">
                Register
            </h1>
        </div>
        <form method="POST" onsubmit="register()" autocomplete="on">
            <?= csrf() ?>
            <div class="form-floating mb-3">
                <input type="text" name="nama" class="form-control <?= error('nama', 'is-invalid') ?>" id="floatingNama" placeholder="Nama" value="<?= old('nama') ?>">
                <label for="floatingNama"><i class="fa-solid fa-user mx-1"></i>Nama</label>
                <?php if (error('nama')) : ?>
                    <div class="invalid-feedback">
                        <?= error('nama') ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control <?= error('email', 'is-invalid') ?>" id="floatingEmail" placeholder="Email" value="<?= old('email') ?>">
                <label for="floatingEmail"><i class="fa-solid fa-envelope mx-1"></i>Email</label>
                <?php if (error('email')) : ?>
                    <div class="invalid-feedback">
                        <?= error('email') ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="form-floating mb-4">
                <input type="password" name="password" class="form-control <?= error('password', 'is-invalid') ?>" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword"><i class="fa-solid fa-lock mx-1"></i>Kata sandi</label>
                <?php if (error('password')) : ?>
                    <div class="invalid-feedback">
                        <?= error('password') ?>
                    </div>
                <?php endif ?>
            </div>
            <small class="text-dark">Dengan mendaftar, Anda setuju <a href="/" class="text-decoration-none text-primary">term & conditions</a> dan <a href="/" class="text-decoration-none text-primary">privacy policy</a> kami.</small>
            <div class="d-grid mt-3">
                <button class="btn btn-success  fw-bold mb-2" id="button-register" type="submit">Daftar</button>
            </div>
            <hr class="text-dark">
            <div class="d-flex justify-content-center">
                <p class="fw-semibold">Sudah punya akun?<a href="<?= route('login') ?>" class="hover mx-1 p-1 rounded text-decoration-none text-primary">Masuk</a></p>
            </div>
        </form>
    </div>
</div>

<script>
    const register = () => {
        let btn = document.getElementById('button-register');
        btn.disabled = true;
        btn.className = 'btn btn-success  active disabled fw-bold mb-2'
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>

<?php endsection('guest') ?>