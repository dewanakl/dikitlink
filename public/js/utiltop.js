const URI = window.location.origin;
const TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const showModal = (msg, type, text = '') => Swal.fire({
    title: msg,
    icon: type,
    text: text,
    confirmButtonText: '<i class="fas fa-check me-1"></i>Oke',
});

const clipboard = (url) => {
    let uri = URI + '/' + url;
    navigator.clipboard.writeText(uri);
    showModal('Menyalin', 'success', `"${uri}"`);
}

const copy = (id) => {
    clipboard(DATA[id][0]);
}

const confirmCopy = (name, action) => {
    Swal.fire({
        title: `${action} link "${name}"`,
        icon: 'success',
        showCancelButton: true,
        focusConfirm: true,
        confirmButtonText: '<i class="fas fa-copy me-1"></i>Salin',
        cancelButtonText: '<i class="fas fa-check me-1"></i>Oke',
    }).then((result) => {
        if (result.isConfirmed) {
            clipboard(name);
        }
    });
}

const escapeHtml = (text) => {
    return text
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}