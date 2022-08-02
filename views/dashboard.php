<?= extend('templates/top', ['title' => 'Dashboard']) ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="my-0">
        <i class="fas fa-columns"></i>
        Dashboard
    </h4>
    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
        <i class="fas fa-plus mx-1 my-0"></i>
        <span class="d-none d-md-inline">Tambah </span>Link
    </button>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Hint</th>
                <th scope="col">Link</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody class="table-group-divider" id="tables"></tbody>
    </table>
</div>

<div class="modal fade" id="addlinkmodal" tabindex="-1" aria-labelledby="addlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="addlink">
                <div class="modal-header">
                    <h5 class="modal-title" id="addlinkLabel">Tambah link</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="valueaddname">Nama</label>
                        <input type="text" class="form-control" id="valueaddname" placeholder="Name">
                        <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueaddlink">Link</label>
                        <input type="url" class="form-control" id="valueaddlink" placeholder="https://www.google.com/" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueaddbatal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success" id="valueaddtambah"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editlinkmodal" tabindex="-1" aria-labelledby="editlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editlink">
                <div class="modal-header">
                    <h5 class="modal-title" id="editlinkLabel">Edit Link</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="valueeditid">
                    <div class="mb-3">
                        <label for="valueeditname">Nama</label>
                        <input type="text" class="form-control" id="valueeditname" placeholder="name">
                        <small class="text-danger">*Acak jika kosong dan karakter ilegal dihapus</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueeditlink">Link</label>
                        <input type="url" class="form-control" id="valueeditlink" placeholder="https://www.google.com/" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueeditbatal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success" id="edit"><i class="fas fa-pen-to-square"></i> Edit</button>
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
                    <button type="button" class="btn btn-secondary" id="valuehapusbatal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger" id="hapus"><i class="fas fa-trash"></i> Hapus</button>
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
            <div class="modal-body">
                <canvas style="height:inherit; width:inherit;" id="myChart"></canvas>
                <hr class="text-dark">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
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
                    <div class="col-md-4 ms-auto">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fas fa-check"></i> Oke</button>
            </div>
        </div>
    </div>
</div>

<?= extend('templates/down') ?>