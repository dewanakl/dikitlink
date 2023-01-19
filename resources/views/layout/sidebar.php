<div class="d-grid mb-3">
    <button class="btn btn-warning btn-lg fw-semibold" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
        <i class="fas fa-plus me-2"></i><span class="d-none d-lg-inline">Tambah </span>Link
    </button>
</div>

<ul class="list-group">
    <a class="list-group-item list-menu <?= routeIs('dashboard', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('dashboard') ?>">
        <i class="fas fa-home mx-2"></i>Home
    </a>

    <a class="list-group-item list-menu <?= routeIs('list', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('list') ?>">
        <i class="fas fa-list mx-2"></i>List
    </a>

    <a class="list-group-item list-menu <?= routeIs('statistik', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('statistik') ?>">
        <i class="fa-solid fa-chart-column mx-2"></i>Statistik
    </a>

    <a class="list-group-item list-menu <?= routeIs('profile', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('profile') ?>">
        <i class="fa-solid fa-address-card mx-2"></i>Profil
    </a>

    <?php if (auth()->user()->role_id == 1) : ?>
        <hr class="my-2">

        <a class="list-group-item list-menu <?= routeIs('users', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('users') ?>">
            <i class="fa-solid fa-users mx-2"></i>Users
        </a>

        <a class="list-group-item list-menu <?= routeIs('stats', 'active disabled') ?> dropdown-item fw-semibold my-1 rounded-3 border-0" href="<?= route('stats') ?>">
            <i class="fa-solid fa-square-poll-vertical mx-2"></i>Stats
        </a>
    <?php endif ?>

    <hr class="my-2">

    <a class="list-group-item list-menu danger dropdown-item fw-semibold my-1 rounded-3 border-0" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="fas fa-sign-out-alt mx-2"></i>Logout
    </a>
</ul>