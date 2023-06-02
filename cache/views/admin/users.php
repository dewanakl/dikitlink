<?php parents('layout/home', ['title' => 'Users']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold text-dark m-1"><i class="fa-solid fa-users mx-2"></i>Daftar user di platform ini</p>
</div>

<div class="table-responsive">
    <table class="table table-sm table-hover" style="font-size: 0.9rem;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Daftar</th>
                <th scope="col">Aktif</th>
                <th scope="col">Link</th>
                <th scope="col">Pengunjung</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php foreach ($users as $idx => $user) : ?>
                <tr <?= $user->email_verify ? 'class="table-success"' : '' ?>>
                    <th><?= $idx + 1 ?></th>
                    <td><?= e($user->nama) ?></td>
                    <td><?= e($user->email) ?></td>
                    <td><?= $user->created_at ? date('d M Y, H:i', strtotime(($user->created_at))) : '-' ?></td>
                    <td><?= $user->last_active ? date('d M Y, H:i', strtotime(($user->last_active))) : '-' ?></td>
                    <td><?= $user->jumlah_link ?></td>
                    <td><?= $user->jumlah_pengunjung ?></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-success btn-sm detail" data-id="<?= $user->id ?>" data-nama="<?= e($user->nama) ?>">
                                <div class="d-flex justify-content-center align-items-center">
                                    <li class="fas fa-info-circle mx-1 my-0"></li><span class="d-none d-md-inline m-0">Detail</span>
                                </div>
                            </button>
                            <button class="btn btn-outline-danger btn-sm hapus" data-nama="<?= e($user->nama) ?>" data-url="<?= route('delete.users', $user->id) ?>">
                                <div class="d-flex justify-content-center align-items-center">
                                    <li class="fas fa-trash mx-1 my-0"></li><span class="d-none d-md-inline m-0">Hapus</span>
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
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaillinkLabel"></h5>
            </div>
            <div class="modal-body" style="overflow: overlay;">
                <div class="row mb-3 p-0">
                    <div class="col-lg-8">
                        <h6 class="ms-1"><i class="fa-solid fa-chart-column me-1"></i>Grafik pengguna</h6>
                        <canvas id="myChart" class="w-full shadow p-3 rounded-3 border border-opacity-25"></canvas>
                    </div>
                    <div class="col-lg-4 mt-1">
                        <div class="card-body rounded-3 shadow p-2 mt-4 mb-3" style="background: #EC9E69;">
                            <div class="row align-items-center text-light">
                                <div class="col">
                                    <h6 class="fw-bold">Jumlah link</h6>
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="jumlahlink"></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-link fa-2x me-2"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body rounded-3 shadow p-2 mb-3" style="background: #D56073;">
                            <div class="row align-items-center text-light">
                                <div class="col">
                                    <h6 class="fw-bold">Pengunjung unik</h6>
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="linkunik"></div>
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
                                    <div class="h6 mb-0 mt-2 fw-semibold" id="totalpengunjung"></div>
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
    let myChart = null;

    const hapus = () => {
        let btnbatal = document.getElementById('button-hapus-batal');
        let btn = document.getElementById('button-hapus');
        btnbatal.disabled = true;
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
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

        await fetch(`${window.location.origin}/admin/users/${id}/detail`)
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

                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                res.last_month.forEach((key) => {
                    labels.push(monthNames[(new Date(key.tgl + '-01').getMonth())] + ' ' + ((new Date(key.tgl + '-01')).getFullYear().toString().substring(2, 4)));
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
                res.user_agent.forEach((data) => AGENT.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${escapeHtml(data.user_agent)}</td></tr>`);

                // ip
                IP.innerHTML = null;
                res.ip_address.forEach((data) => IP.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${escapeHtml(data.ip_address)}</td></tr>`);
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

<?php endsection('home') ?>