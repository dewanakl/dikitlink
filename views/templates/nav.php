<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= route('landing') ?>"><strong>Dikit-Link</strong></a>
        <div class="btn-group">
            <button type="button" class="btn btn-warning btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <?= e(auth()->user()->nama) ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end p-2 rounded-1 shadow">
                <li>
                    <a class="dropdown-item <?= routeIs('dashboard', 'active') ?> my-1 rounded-2" href="<?= route('dashboard') ?>">
                        <i class="fas fa-columns"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a class="dropdown-item <?= routeIs('statistik', 'active') ?> my-1 rounded-2" href="<?= route('statistik') ?>">
                        <i class="fas fa-chart-bar"></i> Statistik
                    </a>
                </li>
                <li>
                    <a class="dropdown-item <?= routeIs('profile', 'active') ?> my-1 rounded-2" href="<?= route('profile') ?>">
                        <i class="far fa-address-card"></i> Profil
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a href="#" class="dropdown-item my-1 rounded-2" onmouseout="this.style.color='#000'; this.style.backgroundColor='#fff'" onmouseover="this.style.color='#fff'; this.style.backgroundColor='var(--bs-red)'" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>