<?= extend('templates/top', ['title' => 'Dashboard']) ?>

<h4 class="mb-3">
    <i class="fas fa-users"></i>
    Users
</h4>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Tanggal Daftar</th>
                <th scope="col">Jumlah Link</th>
                <th scope="col">Jumlah Pengunjung</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($users as $idx => $user) : ?>
                <tr>
                    <th><?= $idx + 1 ?></th>
                    <td><?= e($user->nama) ?></td>
                    <td><?= e($user->email) ?></td>
                    <td><?= date("d M Y, H:i", strtotime(($user->created_at))) ?></td>
                    <td><?= $user->jumlah_link ?></td>
                    <td><?= $user->jumlah_pengunjung ?></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-success detail" data-id="<?= $user->id ?>" data-nama="<?= e($user->nama) ?>">
                                <li class="fas fa-info-circle mx-1"></li> <span class="d-none d-md-inline">Detail</span>
                            </button>
                            <button class="btn btn-outline-danger hapus" data-nama="<?= e($user->nama) ?>" data-url="<?= route('delete.users', $user->id) ?>">
                                <li class="fas fa-trash mx-1"></li> <span class="d-none d-md-inline">Hapus</span>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus User ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 id="nama"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                <form id="formhapus" action="" method="post">
                    <?= csrf() ?>
                    <?= method('delete') ?>
                    <button type="submit" class="btn btn-danger">
                        <li class="fas fa-trash"></li> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detaillinkmodal" tabindex="-1" aria-labelledby="detaillinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-xxl-down">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaillinkLabel"></h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-md-9">
                            <canvas class="img-fluid" id="myChart"></canvas>
                        </div>
                        <div class="col-md-3">
                            <ul class="list-group mt-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Jumlah Link</div>
                                        <small>Dibuat hingga saat ini</small>
                                    </div>
                                    <h5 class="m-0 text-center"><span class="badge text-bg-primary mx-1" id="jumlahlink"></span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Total Pengunjung</div>
                                        <small>Jumlah hint semua link</small>
                                    </div>
                                    <h5 class="m-0 text-center"><span class="badge text-bg-primary mx-1" id="totalpengunjung"></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-9">
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
                        <div class="col-md-3 ms-auto">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fas fa-check"></i> Oke</button>
            </div>
        </div>
    </div>
</div>

<?php if ($pesan = flash('berhasil')) : ?>
    <script>
        Swal.fire({
            title: `<?= $pesan ?>`,
            icon: 'success',
            confirmButtonText: '<i class="fas fa-check"></i> Oke',
        });
    </script>
<?php endif ?>

<script defer>
    const HAPUS = document.querySelectorAll('.hapus');
    const DETAIL = document.querySelectorAll('.detail');

    const detail = async (id, nama) => {
        const AGENT = document.getElementById('user-agent');
        const IP = document.getElementById('ip-address');
        const TITLE = document.getElementById('detaillinkLabel');
        const ctx = document.getElementById('myChart').getContext('2d');

        AGENT.innerHTML = '<span class="spinner-border"></span> Loading..';
        IP.innerHTML = '<span class="spinner-border"></span> Loading..';
        TITLE.innerHTML = `<i class="fa-solid fa-chart-column"></i> ${nama}`;

        if (window.myChart instanceof Chart) {
            window.myChart.destroy();
        }

        const myModal = new bootstrap.Modal(document.getElementById('detaillinkmodal'));
        myModal.show();

        await fetch(`${window.location.origin}/users/${id}/detail`)
            .then((res) => res.json())
            .then((res) => {
                // chart
                let labels = [];
                let values = [];
                let colors = [
                    'rgba(75, 192, 192, 0.3)',
                    'rgba(54, 162, 235, 0.3)',
                    'rgba(153, 102, 255, 0.3)',
                    'rgba(255, 206, 86, 0.3)',
                    'rgba(255, 159, 64, 0.3)',
                    'rgba(255, 99, 132, 0.3)'
                ];
                let border = [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)'
                ];

                const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'
                ];
                res.last_month.forEach((key) => {
                    labels.push(monthNames[(new Date(key.tgl + '-01').getMonth())] + ' ' + (new Date(key.tgl + '-01').getFullYear()));
                    values.push(key.hint);
                });

                // sorting warna
                let valueLen = values.length;
                let valueFloor = valueLen != 1 ? Math.min(...values) : 0;
                let valueRange = Math.max(...values) - valueFloor;
                let maxColorIdx = colors.length - 1;
                let fillColor = [];
                let borderColor = [];
                for (let i = 0; i < valueLen; i++) {
                    let normalizedValue = (values[i] - valueFloor) / valueRange;
                    let colorIdx = Math.floor(normalizedValue * maxColorIdx);
                    colorIdx = Number.isNaN(colorIdx) ? 5 : colorIdx;
                    fillColor.push(colors[colorIdx]);
                    borderColor.push(border[colorIdx]);
                }

                let chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: fillColor,
                            borderColor: borderColor,
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // jumlah link
                document.getElementById('jumlahlink').innerText = res.jumlah_link;

                // total pengunjung
                document.getElementById('totalpengunjung').innerText = res.total_pengunjung;

                // user-agen
                AGENT.innerHTML = null;
                res.user_agent.forEach((data) => AGENT.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${data.user_agent}</td></tr>`);

                // ip
                IP.innerHTML = null;
                res.ip_address.forEach((data) => IP.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${data.ip_address}</td></tr>`);
            })
            .catch((err) => showModal(err, 'error'));
    }

    for (let i = 0; i < HAPUS.length; i++) {
        HAPUS[i].addEventListener('click', () => {
            let nama = HAPUS[i].getAttribute('data-nama');
            document.getElementById('nama').innerText = `Ingin hapus "${nama}" ?`;

            let url = HAPUS[i].getAttribute('data-url');
            document.getElementById('formhapus').action = url;

            const myModal = new bootstrap.Modal(document.getElementById('hapusModal'));
            myModal.show();
        });

        DETAIL[i].addEventListener('click', () => {
            let id = DETAIL[i].getAttribute('data-id');
            let nama = HAPUS[i].getAttribute('data-nama');
            detail(id, nama);
        });
    }
</script>

<?= extend('templates/down') ?>