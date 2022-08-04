const URI = window.location.origin;
const TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const DATA = [];

const addLink = document.getElementById('addlink');
const editLink = document.getElementById('editlink');
const hapusLink = document.getElementById('hapuslink');

let myChart;

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

const refreshTable = async () => {
    const TABELS = document.getElementById('tables');
    TABELS.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';

    await fetch(`${URI}/api/link/show`)
        .then((res) => res.json())
        .then((res) => {
            TABELS.innerHTML = null;
            DATA.splice(0, DATA.length);

            res.forEach((data, key) => {
                DATA.push([data.name, data.link]);
                TABELS.insertRow(-1).innerHTML = `
                    <tr>
                        <th>${key + 1}</th>
                        <td>${data.name}</td>
                        <td>${data.hint}</td>
                        <td>${escapeHtml(data.link)}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
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
                        </td>
                    </tr>`;
            });
        })
        .catch((err) => showModal(err, 'error'));
}

const tambah = async () => {
    const TAMBAH = document.getElementById('valueaddtambah');
    const BATAL = document.getElementById('valueaddbatal');
    const NAME = document.getElementById('valueaddname');
    const LINK = document.getElementById('valueaddlink');
    const name = NAME.value ? NAME.value.replace(/[^\w-]/gi, '') : Math.random().toString(36).slice(2, 8);

    const REQ = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'token': TOKEN
        },
        body: JSON.stringify({
            name: name,
            link: LINK.value
        })
    };

    BATAL.disabled = true
    TAMBAH.disabled = true;
    TAMBAH.innerHTML = `<span class="spinner-border spinner-border-sm"></span> Loading...`;

    await fetch(`${URI}/api/link/create`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
                refreshTable();
                bootstrap.Modal.getInstance(document.querySelector('#addlinkmodal')).hide();
                confirmCopy(name);

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
                labels.push((new Date(key.tgl).getDate()) + ' ' + monthNames[(new Date(key.tgl).getMonth())]);
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

            // user-agen
            AGENT.innerHTML = null;
            res.user_agent.forEach((data) => AGENT.insertRow(-1).innerHTML = `<tr><th>${data.hint}</th><td>${data.user_agent}</td></tr>`);

            // ip
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