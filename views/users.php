<?= extend('templates/top', ['title' => 'Users']) ?>

<div class="card-body rounded-3 p-2 shadow-sm mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold m-1"><i class="fa-solid fa-users mx-2"></i>Daftar user di platform ini</p>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Daftar</th>
                <th scope="col">Link</th>
                <th scope="col">Pengunjung</th>
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
                                <div class="d-flex justify-content-center align-items-center">
                                    <li class="fas fa-info-circle mx-1 my-0"></li> <span class="d-none d-md-inline m-0">Detail</span>
                                </div>
                            </button>
                            <button class="btn btn-outline-danger hapus" data-nama="<?= e($user->nama) ?>" data-url="<?= route('delete.users', $user->id) ?>">
                                <div class="d-flex justify-content-center align-items-center">
                                    <li class="fas fa-trash mx-1 my-0"></li> <span class="d-none d-md-inline m-0">Hapus</span>
                                </div>
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
            </div>
            <div class="modal-body">
                <h4 id="namahapus"></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="button-hapus-batal"><i class="fas fa-times"></i> Batal</button>
                <form id="formhapus" action="" method="post" onsubmit="hapus()">
                    <?= csrf() ?>
                    <?= method('delete') ?>
                    <button type="submit" class="btn btn-danger" id="button-hapus">
                        <li class="fas fa-trash"></li> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detaillinkmodal" tabindex="-1" aria-labelledby="detaillinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaillinkLabel"></h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <canvas style="height:inherit; width:inherit;" id="myChart"></canvas>
                        </div>
                        <div class="col-md-3 ms-auto">
                            <ul class="list-group mt-4">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"><i class="fa-solid fa-link"></i> Link</div>
                                        <small>Jumlah link saat ini</small>
                                    </div>
                                    <h5 class="m-0 text-center"><span class="badge text-bg-primary mx-1" id="jumlahlink"></span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="ms-1 me-auto">
                                        <div class="fw-bold"><i class="fa-solid fa-fingerprint"></i> Unik</div>
                                        <small>Jumlah pengunjung unik</small>
                                    </div>
                                    <h5 class="m-0 text-center"><span class="badge text-bg-primary mx-1" id="linkunik"></span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold"><i class="fa-solid fa-computer-mouse"></i> Klik</div>
                                        <small>Jumlah klik semua link</small>
                                    </div>
                                    <h5 class="m-0 text-center"><span class="badge text-bg-primary mx-1" id="totalpengunjung"></span></h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
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
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: `<?= $pesan ?>`,
                icon: 'success',
                confirmButtonText: '<i class="fas fa-check"></i> Oke',
            });
        });
    </script>
<?php endif ?>

<script defer>
    const HAPUS = document.querySelectorAll('.hapus');
    const DETAIL = document.querySelectorAll('.detail');
    const UPDATE = document.querySelectorAll('.update');
    let myChart;

    const hapus = () => {
        let btnbatal = document.getElementById('button-hapus-batal');
        let btn = document.getElementById('button-hapus');
        btnbatal.disabled = true;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }

    const update = () => {
        let btnbatal = document.getElementById('button-update-batal');
        let btn = document.getElementById('button-update');
        btnbatal.disabled = true;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }

    const refreshChart = () => {
        myChart.data.labels = [];
        myChart.data.datasets = [{
            data: [],
            backgroundColor: [],
            borderColor: [],
            borderWidth: 2
        }];

        myChart.update();
    }

    const detail = async (id, nama) => {
        const myModal = new bootstrap.Modal(document.getElementById('detaillinkmodal'));
        const AGENT = document.getElementById('user-agent');
        const IP = document.getElementById('ip-address');
        const TITLE = document.getElementById('detaillinkLabel');

        myModal.show();

        AGENT.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
        IP.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
        TITLE.innerHTML = `<i class="fa-solid fa-chart-column"></i> ${nama}`;

        refreshChart();

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

                myChart.data.labels = labels;
                myChart.data.datasets = [{
                    data: values,
                    backgroundColor: fillColor,
                    borderColor: borderColor,
                    borderWidth: 2
                }];

                myChart.update();

                // jumlah link
                document.getElementById('jumlahlink').innerText = res.jumlah_link;

                // jumlah link
                document.getElementById('linkunik').innerText = res.unique_pengunjung;

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

    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('myChart').getContext('2d');
        for (let i = 0; i < HAPUS.length; i++) {
            HAPUS[i].addEventListener('click', () => {
                let nama = HAPUS[i].getAttribute('data-nama');
                let url = HAPUS[i].getAttribute('data-url');

                document.getElementById('namahapus').innerText = `Ingin hapus "${nama}" ?`;
                document.getElementById('formhapus').action = url;

                const myModal = new bootstrap.Modal(document.getElementById('hapusModal'));
                myModal.show();
            });

            DETAIL[i].addEventListener('click', () => {
                let id = DETAIL[i].getAttribute('data-id');
                let nama = HAPUS[i].getAttribute('data-nama');
                detail(id, nama);
            });

            UPDATE[i].addEventListener('click', () => {
                let nama = UPDATE[i].getAttribute('data-nama');
                let url = UPDATE[i].getAttribute('data-url');

                document.getElementById('namaupdate').innerText = `Ingin update "${nama}" ?`;
                document.getElementById('formupdate').action = url;

                const myModal = new bootstrap.Modal(document.getElementById('updateModal'));
                myModal.show();
            });
        }
        myChart = new Chart(ctx, {
            type: 'bar',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        refreshChart();
    });
</script>

<?= extend('templates/down') ?>