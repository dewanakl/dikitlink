const tambahModal = async () => {
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

    BATAL.disabled = true;
    TAMBAH.disabled = true;
    let tmp = TAMBAH.innerHTML;
    TAMBAH.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>Loading...`;

    await fetch(`${URI}/api/link`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
                bootstrap.Modal.getInstance(document.querySelector('#addlinkmodal')).hide();

                confirmCopy(name, 'Membuat');

                NAME.value = null;
                LINK.value = null;

                if (typeof reset === 'function' && typeof refreshTable === 'function') {
                    reset(false);
                    refreshTable();
                }
            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    BATAL.disabled = false;
    TAMBAH.disabled = false;
    TAMBAH.innerHTML = tmp;
}

const tambahMobile = async () => {
    const TAMBAH = document.getElementById('valueaddtambahmobile');
    const NAME = document.getElementById('valueaddnamemobile');
    const LINK = document.getElementById('valueaddlinkmobile');
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

    TAMBAH.disabled = true;
    let tmp = TAMBAH.innerHTML;
    TAMBAH.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span>Loading...`;

    await fetch(`${URI}/api/link`, REQ)
        .then((res) => res.json())
        .then((res) => {
            if (res.status) {
                bootstrap.Offcanvas.getInstance(document.querySelector('#offcanvasBottom')).hide();

                confirmCopy(name, 'Membuat');

                NAME.value = null;
                LINK.value = null;

                if (typeof reset === 'function' && typeof refreshTable === 'function') {
                    reset(false);
                    refreshTable();
                }
            } else if (res.error) {
                showModal(Object.values(res.error)[0], 'error');
            } else if (!res.token) {
                throw 'Token error, login ulang';
            }
        })
        .catch((err) => showModal(err, 'error'));

    TAMBAH.disabled = false;
    TAMBAH.innerHTML = tmp;
}

const logout = () => {
    let btnbatal = document.getElementById('button-logout-batal');
    let btn = document.getElementById('button-logout');
    btn.disabled = true;
    btnbatal.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span>Loading...';
}

document.getElementById('addlink').addEventListener('submit', (event) => {
    event.preventDefault();
    tambahModal();
});

document.getElementById('addlinkmobile').addEventListener('submit', (event) => {
    event.preventDefault();
    tambahMobile();
});