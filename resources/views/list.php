<?php parents('layout/home', ['title' => 'List']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold text-dark m-1"><i class="fa-solid fa-list mx-2"></i>Daftar link saat ini</p>
</div>

<div class="input-group mb-3 shadow-sm">
    <span class="input-group-text"><i class="fas fa-search"></i></span>
    <input type="text" class="form-control" onkeyup="cariNama()" id="nama" placeholder="Cari disini..">
</div>

<div class="row" id="tables"></div>
<div class="d-grid mb-2 mt-1">
    <button class="btn btn-primary btn-sm fw-bold mb-3" id="loadmore" onclick="loadMore()">Muat lebih banyak</button>
</div>

<div class="modal fade" id="editlinkmodal" tabindex="-1" aria-labelledby="editlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editlink">
                <div class="modal-header">
                    <h5 class="modal-title" id="editlinkLabel">Edit link</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="valueeditid">
                    <div class="mb-3">
                        <label for="valueeditname"><i class="fa-solid fa-quote-left me-1"></i>Nama</label>
                        <input type="text" class="form-control" id="valueeditname" placeholder="name">
                        <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueeditlink"><i class="fa-solid fa-link me-1"></i>Link</label>
                        <textarea class="form-control" id="valueeditlink" placeholder="https://www.google.com/" <?= is_null(auth()->user()->email_verify) ? 'disabled' : 'required' ?>></textarea>
                        <?php if (is_null(auth()->user()->email_verify)) : ?>
                            <small class="text-danger">*Verifikasi email untuk memperbaharui link tujuan</small>
                        <?php endif ?>
                    </div>
                    <hr>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" role="switch" id="statistik">
                        <label class="form-check-label" for="statistik"><i class="fa-solid fa-chart-simple me-1"></i>Simpan Statistik</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="query">
                        <label class="form-check-label" for="query"><i class="fa-solid fa-gear me-1"></i>Query Param</label>
                    </div>
                    <div class="mb-3">
                        <label for="valueeditpassword"><i class="fa-solid fa-lock me-1"></i>Password</label>
                        <input type="text" class="form-control" id="valueeditpassword" placeholder="Password">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label for="valueeditbuka"><i class="fa-regular fa-calendar-check me-1"></i>Waktu Buka</label>
                            <input type="datetime-local" class="form-control" id="valueeditbuka">
                        </div>
                        <div class="col-md-6 col-sm-12 mb-3">
                            <label for="valueedittutup"><i class="fa-regular fa-calendar-xmark me-1"></i>Waktu Tutup</label>
                            <input type="datetime-local" class="form-control" id="valueedittutup">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueeditbatal" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button type="submit" class="btn btn-success" id="edit"><i class="fas fa-pen-to-square me-1"></i>Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapuslinkmodal" tabindex="-1" aria-labelledby="hapuslinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="hapuslink">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapuslinkLabel">Hapus Link</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="valuehapusid">
                    <h4 id="valuehapusname"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valuehapusbatal" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i>Batal</button>
                    <button type="submit" class="btn btn-danger" id="hapus"><i class="fas fa-trash me-1"></i>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="detaillinkmodal" tabindex="-1" aria-labelledby="detaillinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaillinkLabel"></h5>
            </div>
            <div class="modal-body" style="overflow: overlay;">
                <div class="row mb-3 p-0">
                    <div class="col-lg-8">
                        <h6 class="ms-1"><i class="fa-solid fa-chart-column me-1"></i>Grafik 7 hari terakhir</h6>
                        <canvas style="height:inherit; width:inherit;" id="myChart" class="shadow p-3 rounded-3 border border-opacity-25"></canvas>
                    </div>
                    <div class="col-lg-4 mt-1">
                        <div class="card-body rounded-3 shadow p-2 mt-4 mb-3" style="background: #EC9E69;">
                            <div class="row align-items-center text-light">
                                <div class="col">
                                    <h6 class="fw-bold">Terakhir klik</h6>
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="lastclick"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-clock fa-2x me-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body rounded-3 shadow p-2 mb-3" style="background: #D56073;">
                            <div class="row align-items-center text-light">
                                <div class="col">
                                    <h6 class="fw-bold">Pengunjung unik</h6>
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="unik"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-fingerprint fa-2x me-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body rounded-3 shadow p-2" style="background: #7A4579;">
                            <div class="row align-items-center text-light">
                                <div class="col">
                                    <h6 class="fw-bold">Klik semua link</h6>
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="klik"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-chart-simple fa-2x me-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-0">
                    <div class="col-lg-8">
                        <h6 class="mt-2"><i class="fa-solid fa-mobile-screen me-1"></i>Top 5 User Agent</h6>
                        <div class="table-responsive mb-3 shadow-sm border border-opacity-25 p-2 rounded">
                            <table class="table table-sm table-hover" style="font-size: 0.85rem;">
                                <thead>
                                    <tr>
                                        <th scope="col">Hint</th>
                                        <th scope="col">User Agent</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="user-agent"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h6 class="mt-2"><i class="fa-solid fa-location-dot me-1"></i>Top 5 IP Address</h6>
                        <div class="table-responsive mb-3 shadow-sm border border-opacity-25 p-2 rounded">
                            <table class="table table-sm table-hover" style="font-size: 0.85rem;">
                                <thead>
                                    <tr>
                                        <th scope="col">Hint</th>
                                        <th scope="col">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="ip-address"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-inline d-lg-flex">
                <div class="d-grid">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fas fa-check me-1"></i>Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= asset('js/list.js') ?>" defer></script>

<?php endsection('home') ?>