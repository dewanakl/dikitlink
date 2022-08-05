<?= extend('auth/templates/baseTop', ['title' => 'Dikit-Link']) ?>

<div class="container">
    <div class="px-4 py-5 border-bottom">
        <div class="row flex-lg-row-reverse align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                <img src="<?= asset('link.svg') ?>" class="d-lg-block d-none mx-auto img-fluid" alt="link" width="400" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-2 fw-bold lh-1 mb-4">Dikit-Link</h1>
                <p class="lead" style="font-size: 24px;">
                    Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, tunggu apa lagi ?
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a type="button" class="btn btn-primary btn-lg fw-bold" href="<?= route('login') ?>">Buat Sekarang !</a>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 border-bottom">
        <div class="row g-4 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-rotate"></i>
                </div>
                <div class="mt-0">
                    <h3>Tanpa Batas</h3>
                    <p>Bikin link sampai ribuan juga boleh banget, intinya sampai kamu cape sendiri bikin linknya.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-chart-column"></i>
                </div>
                <div class="mt-0">
                    <h3>Statistik</h3>
                    <p>Kamu juga bisa langsung stalking. Seperti jumlah kliknya ada berapa dan pake device apa.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div class="mt-0">
                    <h3>100% Gratis</h3>
                    <p>Asli nggak bohong, coba dulu baru bilang... tuhkan gratis tanpa butuh apa apa.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-thumbs-up"></i>
                </div>
                <div class="mt-0">
                    <h3>Mudah</h3>
                    <p>Sat set sat set, hiyaaa... mudah bangett kan tambah linknya ?.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div class="mt-0">
                    <h3>Bebas</h3>
                    <p>Yoii, bebas dan terserah mau dikasih nama apa untuk alias linknya.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="mt-0">
                    <h3>Cepat</h3>
                    <p>Perasaan baru klik ini tombol kok udah muncul selesai ? Gile cepet bangett.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="px-4 py-4 d-flex justify-content-between align-items-center">
        <a href="/" class="text-dark text-decoration-none">
            © dikitlink.herokuapp.com
        </a>
        <a class="text-dark text-decoration-none" href="https://github.com/dewanakl/DikitLink">
            <svg class="bi" width="2em" height="2em" viewBox="0 0 496 512">
                <path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z" />
            </svg>
        </a>
    </footer>
</div>

<?= extend('auth/templates/baseDown') ?>