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