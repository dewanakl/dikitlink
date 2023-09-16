const DATA = [];
const LOAD = document.getElementById('loadmore');

let init = 0;
let end = 5;
let each = 0;
let myChart = null;
let timeout = null;

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

const renderCard = (data, key) => {
    const DIV = document.createElement('div');
    DIV.classList.add('col-12');
    DIV.classList.add('mb-3');
    DIV.innerHTML = `
    <div class="card-body shadow p-3 rounded-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="text-truncate m-0 p-0" style="max-width: 50%;">
                <strong>${data.name}</strong>
            </h4>
            <small class="text-dark rounded m-0 p-1" style="background-color: var(--bs-gray-200)">
                ${(data.stats) ? '' : '<i class="fa-solid fa-ban my-0 p-0 ms-1"></i>'}
                ${(data.query_param) ? '<i class="fa-solid fa-gear my-0 p-0 ms-1"></i>' : ''}
                ${(data.link_password) ? '<i class="fa-solid fa-lock my-0 p-0 ms-1"></i>' : ''}
                ${(data.waktu_buka) ? '<i class="fa-solid fa-calendar-check my-0 p-0 ms-1"></i>' : ''}
                ${(data.waktu_tutup) ? '<i class="fa-solid fa-calendar-xmark my-0 p-0 ms-1"></i>' : ''}
                <i class="fa-solid fa-chart-simple my-0 p-0 ms-1"></i>
                ${(data.unsafe) ? '<i class="fa-solid fa-triangle-exclamation ms-0 me-1 my-0 p-0"></i>' : `<span class="fw-bold ms-0 me-1 my-0 p-0">${data.hint}</span>`}
            </small>
        </div>
        <p class="text-truncate mt-2 mb-1 mx-0 p-0">${escapeHtml(data.link)}</p>
        <hr class="mt-2 mb-3">
        <div class="d-flex justify-content-between align-items-center m-0 p-0">
            <small class="text-opacity-75 m-0 p-0"><i class="fa-solid fa-clock ms-0 me-1"></i>${(new Date(data.created_at)).toLocaleDateString('id-ID', { year: 'numeric', month: 'short', day: 'numeric' })}</small>
            <div class="btn-group btn-group-sm m-0" role="group">
                <a onclick="copy(${key})" class="btn btn-outline-secondary ${(data.unsafe) ? 'disabled' : ''}">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-copy mx-1 my-0 p-0"></i><span class="d-none d-md-inline m-0 p-0">Salin</span>
                    </div>
                </a>
                <a onclick="detail(this, ${key})" class="btn btn-outline-success ${(data.unsafe) ? 'disabled' : ''}">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-info-circle mx-1 my-0 p-0"></i><span class="d-none d-md-inline m-0 p-0">Detail</span>
                    </div>
                </a>
                <a onclick="edit(this, ${key})" class="btn btn-outline-warning ${(data.unsafe) ? 'disabled' : ''}">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-pen-to-square mx-1 my-0 p-0"></i><span class="d-none d-md-inline m-0 p-0">Edit</span>
                    </div>
                </a>
                <a onclick="hapus(this, ${key})" class="btn btn-outline-danger ${(data.unsafe) ? 'disabled' : ''}">
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fas fa-trash mx-1 my-0 p-0"></i><span class="d-none d-md-inline m-0 p-0">Hapus</span>
                    </div>
                </a>
            </div>
        </div>
    </div>`;
    return DIV;
}

const refreshTable = async () => {
    const TABELS = document.getElementById('tables');
    let nama = document.getElementById('nama').value;
    LOAD.disabled = true;
    LOAD.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';

    await fetch(`${URI}/api/link?nama=${nama}&init=${init}&end=${end}`)
        .then((res) => res.json())
        .then((res) => {
            if (res.length > 0) {
                res.forEach((data) => {
                    let stats = data.stats;
                    if (typeof stats === 'string' || stats instanceof String) {
                        if (stats == '1') {
                            stats = true;
                        } else {
                            stats = false;
                        }
                    }
                    data.stats = stats;

                    let query = data.query_param;
                    if (typeof query === 'string' || query instanceof String) {
                        if (query == '1') {
                            query = true;
                        } else {
                            query = false;
                        }
                    }
                    data.query_param = query;

                    DATA.push([
                        data.name,
                        data.link,
                        data.hint,
                        data.link_password,
                        data.waktu_buka,
                        data.waktu_tutup,
                        data.stats,
                        data.query_param
                    ]);

                    TABELS.appendChild(renderCard(data, each));
                    each += 1;
                });

                LOAD.disabled = false;
                LOAD.innerText = 'Muat lebih banyak';
                LOAD.style.visibility = 'visible';
            } else {
                LOAD.disabled = true;
                LOAD.innerText = 'Tidak ada hasil lagi';
            }
        })
        .catch((err) => showModal(err, 'error'));
}

const edit = async (button, id) => {
    button.disabled = true;

    document.getElementById('editlinkLabel').innerText = 'Edit link ' + DATA[id][0];
    document.getElementById('valueeditid').value = DATA[id][0];
    document.getElementById('valueeditname').value = DATA[id][0];
    document.getElementById('valueeditlink').value = escapeHtml(DATA[id][1]);
    document.getElementById('valueeditpassword').value = DATA[id][3];
    document.getElementById('statistik').checked = DATA[id][6];
    document.getElementById('query').checked = DATA[id][7];

    let now = new Date(DATA[id][4] ?? '');
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

    document.getElementById('valueeditbuka').value = DATA[id][4] ? now.toISOString().slice(0, 16) : null;

    now = new Date(DATA[id][5] ?? '');
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

    document.getElementById('valueedittutup').value = DATA[id][5] ? now.toISOString().slice(0, 16) : null;

    const myModal = new bootstrap.Modal(document.getElementById('editlinkmodal'));
    myModal.show();

    button.disabled = false;
}

const update = async () => {
    const EDIT = document.getElementById('edit');
    const BATAL = document.getElementById('valueeditbatal');
    const OLD = document.getElementById('valueeditid');
    const NAME = document.getElementById('valueeditname');
    const LINK = document.getElementById('valueeditlink');

    const PASS = document.getElementById('valueeditpassword');
    const BUKA = document.getElementById('valueeditbuka');
    const TUTUP = document.getElementById('valueedittutup');
    const CHECK = document.getElementById('statistik').checked;
    const Query = document.getElementById('query').checked;

    const old = OLD.value ? OLD.value.replace(/[^\w-]/gi, '') : Math.random().toString(36).slice(2, 8);
    const name = NAME.value ? NAME.value.replace(/[^\w-]/gi, '') : Math.random().toString(36).slice(2, 8);

    const REQ = {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'token': TOKEN
        },
        body: JSON.stringify({
            old: old,
            name: name,
            link: LINK.value,
            password: PASS.value,
            buka: BUKA.value,
            tutup: TUTUP.value,
            stats: CHECK,
            query: Query
        })
    };

    BATAL.disabled = true;
    EDIT.disabled = true;
    let tmp = EDIT.innerHTML;
    EDIT.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>Loading...`;

    await fetch(`${URI}/api/link`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status == 1) {
                reset(false);
                refreshTable();
                bootstrap.Modal.getInstance(document.querySelector('#editlinkmodal')).hide();
                confirmCopy(name, 'Mengubah');

                OLD.value = null;
                NAME.value = null;
                LINK.value = null;

                PASS.value = null;
                BUKA.value = null;
                TUTUP.value = null;

            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    BATAL.disabled = false;
    EDIT.disabled = false;
    EDIT.innerHTML = tmp;
}

const detail = async (button, id) => {
    const myModal = new bootstrap.Modal(document.getElementById('detaillinkmodal'));
    const AGENT = document.getElementById('user-agent');
    const IP = document.getElementById('ip-address');
    const TITLE = document.getElementById('detaillinkLabel');

    button.disabled = true;

    document.getElementById('klik').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
    document.getElementById('unik').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
    document.getElementById('lastclick').innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

    AGENT.innerHTML = null;
    IP.innerHTML = null;
    TITLE.innerText = `Detail ${DATA[id][0]}`;

    myModal.show();
    refreshChart();

    await fetch(`${URI}/api/link/detail?name=${DATA[id][0]}`)
        .then((res) => res.json())
        .then((res) => {
            if (!res.hasOwnProperty('unique')) {
                throw Object.values(res.error)[0];
            }
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

            res.last_week.forEach((key) => {
                labels.push((new Date(key.tgl)).getDate() + ' ' + monthNames[(new Date(key.tgl)).getMonth()]);
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

            document.getElementById('klik').innerHTML = DATA[id][2];
            document.getElementById('unik').innerHTML = res.unique;
            document.getElementById('lastclick').innerHTML = res.last_click ?? 'Tidak Terlihat';

            res.user_agent.forEach((data) => AGENT.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${escapeHtml(data.user_agent)}</td></tr>`);
            res.ip_address.forEach((data) => IP.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${escapeHtml(data.ip_address)}</td></tr>`);
        })
        .catch((err) => showModal(err, 'error'));

    button.disabled = false;
}

const hapus = async (button, id) => {
    button.disabled = true;

    id = DATA[id][0];
    document.getElementById('valuehapusname').innerHTML = `Ingin hapus "<strong>${id}</strong>" ?`;
    document.getElementById('valuehapusid').value = id;

    const myModal = new bootstrap.Modal(document.getElementById('hapuslinkmodal'));
    myModal.show();

    button.disabled = false;
}

const destroy = async () => {
    const HAPUS = document.getElementById('hapus');
    const BATAL = document.getElementById('valuehapusbatal');
    const NAME = document.getElementById('valuehapusid');

    const REQ = {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'token': TOKEN
        },
        body: JSON.stringify({
            name: NAME.value
        })
    };

    BATAL.disabled = true;
    HAPUS.disabled = true;
    let tmp = HAPUS.innerHTML;
    HAPUS.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>Loading...`;

    await fetch(`${URI}/api/link`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status == 1) {
                reset(false);
                refreshTable();
                bootstrap.Modal.getInstance(document.querySelector('#hapuslinkmodal')).hide();
                showModal(`Menghapus "${NAME.value}"`, 'success');
                NAME.value = null;
            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    BATAL.disabled = false;
    HAPUS.disabled = false;
    HAPUS.innerHTML = tmp;
}

const reset = (show = true) => {
    init = 0;
    end = 5;
    each = 0;

    DATA.splice(0, DATA.length);
    document.getElementById('tables').innerHTML = null;
    if (show) {
        LOAD.disabled = true;
        LOAD.style.visibility = 'visible';
        LOAD.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
    } else {
        LOAD.style.visibility = 'hidden';
    }
}

const cariNama = () => {
    reset();
    clearTimeout(timeout);
    timeout = setTimeout(() => refreshTable(), 700);
}

const loadMore = () => {
    init = init + end;
    refreshTable();
}

document.getElementById('editlink').addEventListener('submit', (event) => {
    event.preventDefault();
    update();
});

document.getElementById('hapuslink').addEventListener('submit', (event) => {
    event.preventDefault();
    destroy();
});

document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('myChart').getContext('2d');
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
    refreshTable();
    refreshChart();
});
