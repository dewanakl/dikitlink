const URI = window.location.origin;
const TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const DATA = [];

const addLink = document.getElementById('addlink');
const editLink = document.getElementById('editlink');
const hapusLink = document.getElementById('hapuslink');

const LOAD = document.getElementById('loadmore');
const JudulInput = document.getElementById('nama');
const OrderInput = document.getElementById('order');

let myChart;
let init = 0;
let end = 6;
let each = 0;
let timeout = null;

const showModal = (msg, type, text = '') => Swal.fire({
    title: msg,
    icon: type,
    text: text,
    confirmButtonText: '<i class="fas fa-check"></i> Oke',
});

const escapeHtml = (text) => {
    return text
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

const clipboard = (url) => {
    let uri = URI + '/' + url;
    navigator.clipboard.writeText(uri);
    showModal('Menyalin', 'success', `"${uri}"`);
}

const copy = (id) => {
    clipboard(DATA[id][0]);
}

const confirmCopy = (name, action = 'Membuat') => {
    Swal.fire({
        title: `${action} link "${name}"`,
        icon: 'success',
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: '<i class="fas fa-copy"></i> Salin',
        cancelButtonText: '<i class="fas fa-check"></i> Oke',
    }).then((result) => {
        if (result.isConfirmed) {
            clipboard(name);
        }
    });
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

const renderCard = (data, key) => {
    const DIV = document.createElement('div');
    DIV.classList.add('col-12');
    DIV.classList.add('mb-3');
    DIV.innerHTML = `
    <div class="card shadow-sm border-secondary">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title my-1 mx-0">
                <strong class="mx-0">${data.name}</strong>
                </h5>
                <small class="text-dark text-opacity-75 border border-secondary border-2 rounded-3 px-1"><i class="fa-solid fa-computer-mouse"></i> ${data.hint}</small>
            </div>
            <p class="text-truncate my-1 mx-0">${escapeHtml(data.link)}</p>
            <hr class="mt-2 mb-3">
            <div class="d-flex justify-content-between align-items-center mx-0">
                <small class="text-dark text-opacity-75 m-0"><i class="fa-solid fa-clock"></i> ${(new Date(data.created_at)).toLocaleDateString('en-us', { year: 'numeric', month: 'short', day: 'numeric' })}</small>
                <div class="btn-group btn-group-sm m-0" role="group">
                    <a onclick="copy(${key})" class="btn btn-outline-secondary">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-copy mx-1 my-0"></i> <span class="d-none d-md-inline m-0">Salin</span>
                        </div>
                    </a>
                    <a onclick="detail(this, ${key})" class="btn btn-outline-success">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-info-circle mx-1 my-0"></i> <span class="d-none d-md-inline m-0">Detail</span>
                        </div>
                    </a>
                    <a onclick="edit(this, ${key})" class="btn btn-outline-warning">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-pen-to-square mx-1 my-0"></i> <span class="d-none d-md-inline m-0">Edit</span>
                        </div>
                    </a>
                    <a onclick="hapus(this, ${key})" class="btn btn-outline-danger">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-trash mx-1 my-0"></i> <span class="d-none d-md-inline m-0">Hapus</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>`;
    return DIV;
}

const refreshTable = async (nama = '', order = 'a') => {
    const TABELS = document.getElementById('tables');
    LOAD.disabled = true;
    LOAD.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';

    await fetch(`${URI}/api/link/show?order=${order}&nama=${nama}&init=${init}&end=${end}`)
        .then((res) => res.json())
        .then((res) => {
            if (res.length > 0) {
                res.forEach((data) => {
                    DATA.push([data.name, data.link]);
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

const tambah = async () => {
    const TAMBAH = document.getElementById('valueaddtambah');
    const BATAL = document.getElementById('valueaddbatal');
    const NAME = document.getElementById('valueaddname');
    const LINK = document.getElementById('valueaddlink');
    const PASSWORD = document.getElementById('valueaddpassword');
    const name = NAME.value ? NAME.value.replace(/[^\w-]/gi, '') : Math.random().toString(36).slice(2, 8);

    const REQ = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'token': TOKEN
        },
        body: JSON.stringify({
            name: name,
            link: LINK.value,
            password: PASSWORD.value
        })
    };

    BATAL.disabled = true
    TAMBAH.disabled = true;
    TAMBAH.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Loading...`;

    await fetch(`${URI}/api/link/create`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
                reset(false);
                refreshTable();
                bootstrap.Modal.getInstance(document.querySelector('#addlinkmodal')).hide();
                confirmCopy(name);

                NAME.value = null;
                LINK.value = null;
                PASSWORD.value = null;
            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    BATAL.disabled = false;
    TAMBAH.disabled = false;
    TAMBAH.innerHTML = '<i class="fas fa-plus"></i> Tambah';
}

const edit = async (button, id) => {
    button.disabled = true;

    let link = DATA[id][1];
    id = DATA[id][0];

    document.getElementById('valueeditid').value = id;
    document.getElementById('valueeditname').value = id;
    document.getElementById('valueeditlink').value = escapeHtml(link);

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
            link: LINK.value
        })
    };

    BATAL.disabled = true;
    EDIT.disabled = true;
    EDIT.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Loading...`;

    await fetch(`${URI}/api/link/update`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
                reset(false);
                refreshTable();
                bootstrap.Modal.getInstance(document.querySelector('#editlinkmodal')).hide();
                confirmCopy(name, 'Mengubah');

                OLD.value = null;
                NAME.value = null;
                LINK.value = null;

            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    BATAL.disabled = false;
    EDIT.disabled = false;
    EDIT.innerHTML = '<i class="fas fa-pen-to-square"></i> Edit';
}

const detail = async (button, id) => {
    const myModal = new bootstrap.Modal(document.getElementById('detaillinkmodal'));
    const AGENT = document.getElementById('user-agent');
    const IP = document.getElementById('ip-address');
    const TITLE = document.getElementById('detaillinkLabel');

    id = DATA[id][0];
    myModal.show();

    AGENT.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    IP.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    TITLE.innerText = `Detail ${id}`;
    button.disabled = true;

    refreshChart();

    await fetch(`${URI}/api/link/detail?name=${id}`)
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

            document.getElementById('unik').innerText = res.unique;
            document.getElementById('klik').innerText = res.jumlah;

            AGENT.innerHTML = null;
            res.user_agent.forEach((data) => AGENT.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${data.user_agent}</td></tr>`);

            IP.innerHTML = null;
            res.ip_address.forEach((data) => IP.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${data.ip_address}</td></tr>`);
        })
        .catch((err) => showModal(err, 'error'));

    button.disabled = false;
}

const hapus = async (button, id) => {
    button.disabled = true;

    id = DATA[id][0];
    document.getElementById('valuehapusname').innerText = `Ingin hapus "${id}" ?`;
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
    HAPUS.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Loading...`;

    await fetch(`${URI}/api/link/delete`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
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
    HAPUS.innerHTML = '<i class="fas fa-trash"></i> Hapus';
}

const reset = (show = true) => {
    init = 0;
    end = 6;
    each = 0;

    DATA.splice(0, DATA.length);
    document.getElementById('tables').innerHTML = null;
    if (show) {
        LOAD.disabled = true;
        LOAD.style.visibility = 'visible';
        LOAD.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    } else {
        LOAD.style.visibility = 'hidden';
    }
}

const cariNama = () => {
    reset();
    clearTimeout(timeout);
    timeout = setTimeout(() => refreshTable(JudulInput.value, OrderInput.value), 700);
}

const urutkan = () => {
    reset();
    clearTimeout(timeout);
    timeout = setTimeout(() => refreshTable(JudulInput.value, OrderInput.value), 350);
}

const loadMore = () => {
    init = init + end;
    refreshTable(JudulInput.value, OrderInput.value);
}

addLink.addEventListener('submit', event => {
    event.preventDefault();
    tambah();
});

editLink.addEventListener('submit', event => {
    event.preventDefault();
    update();
});

hapusLink.addEventListener('submit', event => {
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