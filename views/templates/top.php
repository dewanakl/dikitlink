<?= extend('templates/baseTop', compact('title')) ?>

<?= extend('templates/nav') ?>

<div class="container mt-3 mb-5">
    <div class="d-flex d-none d-sm-flex justify-content-between align-items-center mb-4 mt-4">
        <h4 class="d-none d-sm-block fw-bold mx-1">Dikit<i class="fa-solid fa-link mx-1"></i>Link</h4>
        <h4 class="text-truncate mx-1">Haii, <?= e(auth()->user()->nama) ?></h4>
    </div>

    <div class="row">
        <div class="col-md-3 pe-5 d-none d-md-inline">
            <div class="d-grid mb-3">
                <button class="btn btn-warning btn-lg fw-semibold" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
                    <i class="fas fa-plus mx-1"></i>
                    <span class="d-none d-md-inline">Tambah </span>Link
                </button>
            </div>
            <ul class="list-group">
                <li class="list-group-item list-menu <?= routeIs('dashboard', 'active disabled') ?> my-1 rounded-2 border border-0">
                    <a class="dropdown-item fw-semibold" href="<?= route('dashboard') ?>">
                        <i class="fas fa-home ms-2 me-1"></i>Home
                    </a>
                </li>
                <li class="list-group-item list-menu <?= routeIs('list', 'active disabled') ?> my-1 rounded-2 border border-0">
                    <a class="dropdown-item fw-semibold" href="<?= route('list') ?>">
                        <i class="fas fa-list ms-2 me-1"></i>List
                    </a>
                </li>
                <li class="list-group-item list-menu <?= routeIs('statistik', 'active disabled') ?> my-1 rounded-2 border border-0">
                    <a class="dropdown-item fw-semibold" href="<?= route('statistik') ?>">
                        <i class="fa-solid fa-chart-column ms-2 me-1"></i>Statistik
                    </a>
                </li>
                <li class="list-group-item list-menu <?= routeIs('profile', 'active disabled') ?> my-1 rounded-2 border border-0">
                    <a class="dropdown-item fw-semibold" href="<?= route('profile') ?>">
                        <i class="fa-solid fa-address-card ms-2 me-1"></i>Profil
                    </a>
                </li>
                <?php if (auth()->user()->role_id == 1) : ?>
                    <hr class="m-2">
                    <span class="badge text-bg-success fw-semibold mb-2">ADMIN</span>
                    <li class="list-group-item list-menu <?= routeIs('users', 'active disabled') ?> my-1 rounded-2 border border-0">
                        <a class="dropdown-item fw-semibold" href="<?= route('users') ?>">
                            <i class="fa-solid fa-users ms-2 me-1"></i>Users
                        </a>
                    </li>
                <?php endif ?>
                <hr class="m-2">
                <li class="list-group-item list-menu danger my-1 rounded-2 border border-0">
                    <a href="javascript:void(0);" class="dropdown-item fw-semibold" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt ms-2 me-1"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">