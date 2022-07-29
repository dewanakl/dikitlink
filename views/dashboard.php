<?= extend('templates/head', ['title' => 'Dashboard']) ?>

<h4 class="mb-3">
    <i class="fas fa-columns"></i>
    Dashboard
</h4>

<button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#addlinkmodal">
    <i class="fas fa-link"></i>
    Tambah Link
</button>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Link</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody id="tables"></tbody>
    </table>
</div>

<div class="modal fade" id="addlinkmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addlinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <form id="addlink">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addlinkLabel">Tambah link</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="valueaddname">Nama</label>
                        <input type="text" class="form-control" id="valueaddname" placeholder="Name">
                        <small class="text-danger">*Hanya huruf dan angka, jika kosong, otomatis acak</small>
                    </div>
                    <div class="mb-3">
                        <label for="valueaddlink">Link</label>
                        <input type="url" class="form-control" id="valueaddlink" placeholder="https://www.google.com/" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="valueaddbatal" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success" id="tambah"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editpostmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editpostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <form id="editpost">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpostLabel">Edit postingan</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="" name="editid" id="editid">
                    <div class="mb-3">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="name">
                    </div>
                    <div class="mb-3">
                        <label for="link">Link</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="https://www.google.com/" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="batal2" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="simpan">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script defer>
    "use strict";
    const TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const addLink = document.getElementById('addlink');
    const editpost = document.getElementById('editpost');

    const showModal = (msg, type, text = '') => Swal.fire({
        title: msg,
        icon: type,
        text: text
    });

    // OK
    const escapeHtml = (text) => {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // OK
    const showTable = async () => {
        const TABELS = document.getElementById('tables');
        TABELS.innerHTML = null;

        const REQ = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'token': TOKEN
            }
        };

        await fetch('<?= route('show.link') ?>', REQ)
            .then((res) => res.json())
            .then((res) => res.forEach((data, key) => TABELS.insertRow(-1).innerHTML = `
                    <tr>
                        <th scope="row">${key + 1}</th>
                        <td>${data.name}</td>
                        <td>${escapeHtml(data.link)}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a onclick="detail(this, ${data.name})" class="d-flex align-items-center btn btn-outline-success btn-sm"><i class="fas fa-info-circle mx-1"></i> <span class="d-none d-md-block">Detail</span></a>
                                <a onclick="edit(this, ${data.name})" class="d-flex align-items-center btn btn-outline-warning btn-sm"><i class="fas fa-pen-square mx-1"></i> <span class="d-none d-md-block">Edit</span></a>
                                <a onclick="hapus(this, '${data.name}')" class="d-flex align-items-center btn btn-outline-danger btn-sm"><i class="fas fa-trash mx-1"></i> <span class="d-none d-md-block">Hapus</span></a>
                            </div>
                        </td>
                    </tr>
                `))
            .catch((err) => showModal(err, 'error'));
    }

    const tambah = async () => {
        const TAMBAH = document.getElementById('tambah');
        const BATAL = document.getElementById('valueaddbatal');
        const NAME = document.getElementById('valueaddname');
        const LINK = document.getElementById('valueaddlink');

        BATAL.disabled = true
        TAMBAH.disabled = true;
        TAMBAH.innerHTML = `<span class="spinner-border"></span>`;

        const REQ = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'token': TOKEN
            },
            body: JSON.stringify({
                name: NAME.value ? NAME.value : Math.random().toString(36).slice(2, 7),
                link: LINK.value
            })
        };

        await fetch('<?= route('create.link') ?>', REQ)
            .then((res) => res.json())
            .then((res) => {
                if (res.status) {
                    bootstrap.Modal.getInstance(document.querySelector('#addlinkmodal')).hide();
                    showModal('Berhasil menambahkan', 'success');
                    showTable();
                } else if (res.error) {
                    showModal(res.error.link, 'error');
                }
            })
            .catch((err) => showModal(err, 'error'));

        NAME.value = null;
        LINK.value = null;
        BATAL.disabled = false;
        TAMBAH.disabled = false;
        TAMBAH.innerHTML = 'Tambah';
    }

    const update = async (obj) => {
        obj.disabled = true;
        document.getElementById('batal2').disabled = true;
        obj.innerHTML = `<span class="spinner-border"></span>`;

        const id = document.getElementById('editid');
        const judul = document.getElementById('juduledit');
        const isi = CKEDITOR.instances['isiedit'].getData();
        const files = document.getElementById('imageedit');
        const form = new FormData();
        form.append('id', id.value);
        form.append('judul', judul.value);
        form.append('isi', isi);
        form.append('image', files.files[0]);
        const req = {
            method: 'POST',
            body: form
        };

        await fetch('api.php?act=update', req)
            .then((res) => res.json())
            .then((res) => {
                const modal = bootstrap.Modal.getInstance(document.querySelector('#editpostmodal'));
                modal.hide();
                if (res.status) {
                    showModal('Berhasil mengedit', 'success');
                    showTable();
                } else {
                    cekUser();
                    showModal('Ada kesalahan, login ulang !', 'error')
                }
            })
            .catch((err) => showModal(err, 'error'));

        id.value = null;
        files.value = null;
        judul.value = null;
        CKEDITOR.instances['isiedit'].setData('');
        document.getElementById('batal2').disabled = false;
        obj.disabled = false;
        obj.innerHTML = 'Simpan';
    }

    const hapus = async (button, id) => {
        button.disabled = true;

        Swal.fire({
            title: `Ingin menghapus "${id}" ?`,
            showDenyButton: true,
            focusConfirm: true,
            confirmButtonText: '<i class="fas fa-times"></i> Batal',
            denyButtonText: '<i class="fas fa-trash"></i> Hapus',
        }).then((result) => {
            if (result.isDenied) {
                cekHapus(id);
            }
        })

        button.disabled = false;
    }

    const cekHapus = async (id) => {
        const REQ = {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'token': TOKEN
            }
        };

        await fetch(`/link/${id}/delete`, REQ)
            .then((res) => res.json())
            .then((res) => {
                if (res.status) {
                    showModal('Berhasil menghapus', 'success');
                    showTable();
                } else if (res.error) {
                    showModal(res.error, 'error');
                }
            })
            .catch((err) => showModal(err, 'error'));
    }

    const edit = async (obj, id) => {
        // obj.disabled = true;
        // await getdataId(id)
        //     .then((res) => {
        //         CKEDITOR.instances['isiedit'].setData(res.post);
        //         document.getElementById('editid').value = res.id;

        //         let img = document.getElementById('preview');
        //         if (res.image) {
        //             img.style.display = "block";
        //             img.src = res.image;
        //         } else {
        //             img.style.display = "none";
        //         }
        //         document.getElementById('juduledit').value = escapeHtml(res.nama);

        //         const myModal = new bootstrap.Modal(document.getElementById('editpostmodal'));
        //         myModal.show();
        //     })
        //     .catch((err) => showModal(err, 'error'));
        // obj.disabled = false;

        console.log('asas');
    }

    addLink.addEventListener('submit', event => {
        event.preventDefault();
        tambah();
    });

    editpost.addEventListener('submit', event => {
        event.preventDefault();
        update(document.getElementById('simpan'));
    });

    showTable();
</script>

<?= extend('templates/down') ?>