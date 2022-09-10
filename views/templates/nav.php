<nav class="navbar navbar-dark bg-dark rounded-top navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none m-0 p-0">
    <ul class="navbar-nav nav-justified w-100 align-items-end m-0 p-0">
        <li class="nav-item m-0 p-0">
            <a href="<?= route('dashboard') ?>" class="nav-link pb-1 <?= routeIs('dashboard', 'active') ?> text-center">
                <i class="fas fa-home"></i>
                <span class="d-block" style="font-size: 10px;">Home</span>
            </a>
        </li>
        <li class="nav-item m-0 p-0">
            <a class="nav-link pb-1 <?= routeIs('list', 'active') ?> text-center" href="<?= route('list') ?>">
                <i class="fa-solid fa-list"></i>
                <span class="d-block" style="font-size: 10px;">List</span>
            </a>
        </li>

        <li class="nav-item m-0 p-0">
            <a class="btn btn-warning fw-semibold pb-0 pt-0 mb-1 mt-1 text-center" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
                <i class="fas fa-plus"></i>
                <span class="d-block" style="font-size: 10px;">Baru</span>
            </a>
        </li>

        <li class="nav-item m-0 p-0">
            <a class="nav-link pb-1 <?= routeIs('statistik', 'active') ?> text-center" href="<?= route('statistik') ?>">
                <i class="fa-solid fa-chart-column"></i>
                <span class="d-block" style="font-size: 10px;">Statistik</span>
            </a>
        </li>
        <li class="nav-item m-0 p-0">
            <a class="nav-link pb-1 <?= routeIs('profile', 'active') ?> text-center" href="<?= route('profile') ?>">
                <i class="fa-solid fa-address-card"></i>
                <span class="d-block" style="font-size: 10px;">Profil</span>
            </a>
        </li>
    </ul>
</nav>