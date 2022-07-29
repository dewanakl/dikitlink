<?= extend('templates/head', ['title' => 'Profile']) ?>

<h4 class="mb-3">
    <i class="far fa-address-card"></i>
    Profile
</h4>

<div class="card border-dark">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h5 class="card-title"><i class="fas fa-user"></i> <?= e(auth()->user()->nama) ?></h5>
                <hr>
                <p class="card-text"><i class="fas fa-envelope"></i> <?= e(auth()->user()->email) ?></p>
                <p class="card-text"><i class="fas fa-user-clock"></i> <?= e(date("d M Y, H:i", strtotime((auth()->user()->created_at)))) ?></p>
                <p class="card-text"><i class="fas fa-history"></i> <?= e(date("d M Y, H:i", strtotime((auth()->user()->updated_at)))) ?></p>
                <hr>
            </div>
            <div class="col-sm-8">
                <form method="post" class="m-1">
                    <?= csrf() ?>
                    <?= method('put') ?>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" placeholder="Nama" class="form-control  <?= error('nama', 'is-invalid') ?>" name="nama" value="<?= e(auth()->user()->nama) ?>">

                        <?php if (error('nama')) : ?>
                            <div class="invalid-feedback">
                                <?= error('nama') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" placeholder="Email" class="form-control <?= error('email', 'is-invalid') ?>" name="email" value="<?= e(auth()->user()->email) ?>">

                        <?php if (error('email')) : ?>
                            <div class="invalid-feedback">
                                <?= error('email') ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" placeholder="Password" class="form-control <?= error('password', 'is-invalid') ?>" name="password">

                                <?php if (error('password')) : ?>
                                    <div class="invalid-feedback">
                                        <?= error('password') ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-sync"></i></span>
                                <input type="password" placeholder="Repeat" class="form-control  <?= error('konfirmasi_password', 'is-invalid') ?>" name="konfirmasi_password">

                                <?php if (error('konfirmasi_password')) : ?>
                                    <div class="invalid-feedback">
                                        <?= error('konfirmasi_password') ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-sm btn-primary">
                            <i class="fas fa-check"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($pesan = flash('berhasil')) : ?>
    <script>
        Swal.fire({
            title: `<?= $pesan ?>`,
            icon: 'success'
        });
    </script>
<?php endif ?>

<?= extend('templates/down') ?>