<ul class="navbar-nav nav-justified w-100 align-items-center m-0 p-0">
    <li class="nav-item">
        <a class="nav-link pb-2 <?= routeIs('dashboard', 'active') ?> text-center" href="<?= route('dashboard') ?>">
            <i class="fas fa-home"></i>
            <span class="d-block" style="font-size: 0.7rem;">Home</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-2 <?= routeIs('list', 'active') ?> text-center" href="<?= route('list') ?>">
            <i class="fa-solid fa-list"></i>
            <span class="d-block" style="font-size: 0.7rem;">List</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="btn btn-warning fw-semibold pb-0 pt-0 mb-1 mt-1 text-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
            <i class="fas fa-plus"></i>
            <span class="d-block" style="font-size: 0.7rem;">Baru</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-2 <?= routeIs('statistik', 'active') ?> text-center" href="<?= route('statistik') ?>">
            <i class="fa-solid fa-chart-column"></i>
            <span class="d-block" style="font-size: 0.7rem;">Statistik</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link pb-2 <?= routeIs('profile', 'active') ?> text-center" href="<?= route('profile') ?>">
            <i class="fa-solid fa-address-card"></i>
            <span class="d-block" style="font-size: 0.7rem;">Profil</span>
        </a>
    </li>
</ul>