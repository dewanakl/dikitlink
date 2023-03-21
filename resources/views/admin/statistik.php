<?php parents('layout/home', ['title' => 'Stats']) ?>

<?php section('home') ?>

<div class="card-body rounded-3 p-2 mb-3" style="background-color: var(--bs-gray-200)">
    <p class="fw-semibold text-dark m-1"><i class="fa-solid fa-square-poll-vertical mx-2"></i>Statistik semua penggunaan</p>
</div>

<h6 class="ms-1"><i class="fa-solid fa-chart-column me-1"></i>Grafik 1 tahun terakhir keseluruhan</h6>
<canvas style="height:inherit; width:inherit;" id="myChart" class="p-3 rounded-3 shadow border border-opacity-25 mb-4"></canvas>

<div class="row mb-3">
    <div class="col-lg-9">
        <h6><i class="fa-solid fa-mobile-screen me-1"></i>Top 10 User Agent</h6>
        <div class="table-responsive mb-3 shadow-sm border border-opacity-25 p-2 rounded">
            <table class="table table-sm table-hover" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th scope="col">Hint</th>
                        <th scope="col">User Agent</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($user_agent as $ag) : ?>
                        <tr>
                            <th><?= $ag->hint ?></th>
                            <td><?= e($ag->user_agent) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-3">
        <h6><i class="fa-solid fa-location-dot me-1"></i>Top 10 IP Address</h6>
        <div class="table-responsive mb-3 shadow-sm border border-opacity-25 p-2 rounded">
            <table class="table table-sm table-hover" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th scope="col">Hint</th>
                        <th scope="col">IP Address</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($ip_address as $ip) : ?>
                        <tr>
                            <th><?= $ip->hint ?></th>
                            <td><?= e($ip->ip_address) ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script defer>
    <?= 'const DATA = ' . json_encode($last_month) . ';' ?>

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

    DATA.forEach((key) => {
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

    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('myChart').getContext('2d');
        let myChart = new Chart(ctx, {
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
    });
</script>

<?php endsection('home') ?>