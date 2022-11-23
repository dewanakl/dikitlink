<div class="col-md-3 pe-5 d-none d-md-inline">
    <div class="d-grid mb-3">
        <button class="btn btn-warning btn-lg fw-semibold" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
            <i class="fas fa-plus mx-1"></i>
            <span class="d-none d-md-inline">Tambah </span>Link
        </button>
    </div>
    <ul class="list-group">
        <a class="list-group-item list-menu <?= routeIs('dashboard', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('dashboard') ?>">
            <i class="fas fa-home ms-2 me-1"></i>Home
        </a>

        <a class="list-group-item list-menu <?= routeIs('list', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('list') ?>">
            <i class="fas fa-list ms-2 me-1"></i>List
        </a>

        <a class="list-group-item list-menu <?= routeIs('/statistik', 'active disabled', true) ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('statistik') ?>">
            <i class="fa-solid fa-chart-column ms-2 me-1"></i>Statistik
        </a>

        <a class="list-group-item list-menu <?= routeIs('profile', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('profile') ?>">
            <i class="fa-solid fa-address-card ms-2 me-1"></i>Profil
        </a>

        <?php if (auth()->user()->role_id == 1) : ?>
            <hr class="m-2">

            <span class="badge text-bg-success fw-semibold mb-2">ADMIN</span>

            <a class="list-group-item list-menu <?= routeIs('users', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('users') ?>">
                <i class="fa-solid fa-users ms-2 me-1"></i>Users
            </a>

            <a class="list-group-item list-menu <?= routeIs('admin/statistik', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-2 border border-0" href="<?= route('statistik.admin') ?>">
                <i class="fa-solid fa-square-poll-vertical ms-2 me-1"></i>Statistik
            </a>
        <?php endif ?>

        <hr class="m-2">

        <a class="list-group-item list-menu danger dropdown-item fw-semibold my-1 rounded-2 border border-0" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="fas fa-sign-out-alt ms-2 me-1"></i>Logout
        </a>
    </ul>
</div>