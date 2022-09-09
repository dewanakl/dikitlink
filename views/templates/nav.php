<nav class="navbar navbar-dark bg-dark rounded navbar-expand fixed-bottom d-md-none d-lg-none d-xl-none m-0 p-0">
    <ul class="navbar-nav nav-justified w-100 align-items-center">
        <li class="nav-item">
            <a href="<?= route('dashboard') ?>" class="nav-link <?= routeIs('dashboard', 'active') ?> text-center">
                <i class="fas fa-home"></i>
                <span class="small d-block">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= routeIs('list', 'active') ?> text-center" href="<?= route('list') ?>">
                <i class="fa-solid fa-list"></i>
                <span class="small d-block">List</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="btn btn-warning fw-semibold py-0 px-2 text-center" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
                <i class="fas fa-plus"></i>
                <span class="small d-block">Baru</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= routeIs('statistik', 'active') ?> text-center" href="<?= route('statistik') ?>">
                <i class="fa-solid fa-chart-column"></i>
                <span class="small d-block">Statistik</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= routeIs('profile', 'active') ?> text-center" href="<?= route('profile') ?>">
                <i class="fa-solid fa-address-card"></i>
                <span class="small d-block">Profil</span>
            </a>
        </li>
    </ul>
</nav>