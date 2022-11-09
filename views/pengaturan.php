<?php parents('layout/home', ['title' => 'Profile']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 shadow-sm mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold m-1"><i class="fa-solid fa-address-card mx-2"></i>Pengaturan</p>
</div>

<div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= !auth()->user()->statistics ?: 'checked' ?>>
    <label class="form-check-label" for="flexSwitchCheckChecked">Statitik</label>
</div>

<?php endsection('home') ?>