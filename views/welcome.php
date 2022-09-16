<?= extend('auth/templates/baseTop', ['title' => 'Dikit Link']) ?>

<div class="container">
    <div class="pt-5 border-bottom">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-1 text-center text-xl-start">
                    <h1 class="fw-bold  mt-0 mb-3" style="font-size: 40px;">Link tuh dikit nggak banyak !</h1>
                    <p class="lead" style="font-size: 24px;">
                        Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail, nggak percaya ?
                    </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg fw-bold" href="<?= route('login') ?>">Coba Sekarang !</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                <img class="img-fluid" width="400" loading="lazy" src="<?= asset('link.svg') ?>" alt="link" />
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
                    <p>Bikin link sampai ribuan juga boleh banget, intinya sampai kamu cape sendiri.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-chart-column"></i>
                </div>
                <div class="mt-0">
                    <h3>Statistik</h3>
                    <p>Kamu juga bisa langsung stalking. Seperti jumlah kliknya, pake device apa, dll.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
                <div class="mt-0">
                    <h3>100% Gratis</h3>
                    <p>Asli gk bohong, coba dulu baru bilang.... tuhkan gratis tanpa butuh apa apa.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-thumbs-up"></i>
                </div>
                <div class="mt-0">
                    <h3>Mudah</h3>
                    <p>Sat set sat set, hiyaaa.... mudah bangett kan bikin linknya ?.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-link"></i>
                </div>
                <div class="mt-0">
                    <h3>Bebas</h3>
                    <p>Yoiii, bebas dan terserah mau dikasih nama apa untuk alias linknya.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div class="d-inline-flex align-items-center justify-content-center fs-4 me-3 mt-2">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <div class="mt-0">
                    <h3>Cepat</h3>
                    <p>Perasaan baru klik ini tombol kok udah muncul selesai ? Gile cepet bangettt.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="p-4">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <span class="text-dark">
                    Build with<i class="fa-solid fa-heart text-danger mx-1"></i>Kamu PHP Framework
                </span>
            </div>
            <div class="col-auto">
                <a class="link-dark" href="#" data-bs-toggle="modal" data-bs-target="#staticPrivacy">Privacy</a>
                <span class="text-dark h5 mx-1">&middot;</span>
                <a class="link-dark" href="#" data-bs-toggle="modal" data-bs-target="#staticTerms">Terms</a>
                <span class="text-dark h5 mx-1">&middot;</span>
                <a class="link-dark" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Github</a>
            </div>
        </div>
    </footer>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sabar..</h5>
            </div>
            <div class="modal-body">
                <h5>Cuma <strong>kamu</strong>. Nggak laravel, CI, atau lainnya.</h5>
                <hr>
                <h6>Kalau udah stabil aku publish ko :)</h6>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticPrivacy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticPrivacyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticPrivacyLabel">Privacy Policy</h5>
            </div>
            <div class="modal-body">
                <p>Kebijakan privasi ini mengungkapkan privasi untuk dikit.my.id. Kebijakan privasi ini hanya berlaku untuk informasi yang dikumpulkan oleh situs web ini. Anda akan mengetahuinya setelah anda membaca semua list berikut :</p>
                <ol>
                    <li>Informasi pengenal pribadi apa yang dikumpulkan dari anda melalui situs web, bagaimana ia digunakan dan dengan siapa informasi itu dapat dibagikan.</li>
                    <li>Prosedur keamanan di tempat untuk melindungi penyalahgunaan informasi Anda.</li>
                    <li>Pengumpulan, Penggunaan, dan Berbagi Informasi</li>
                </ol>
                <p>Kami adalah pemilik tunggal dari informasi yang dikumpulkan di situs ini. Kami hanya memiliki akses informasi yang anda berikan secara sukarela kepada kami melalui email. Kami tidak akan menjual atau menyewakan informasi ini kepada siapa pun dan tidak akan membagikan informasi anda dengan pihak ketiga mana pun di luar organisasi kami.</p>
                <h5>Keamanan</h5>
                <p>Kami mengambil tindakan pencegahan untuk melindungi informasi Anda. Ketika Anda mengirimkan informasi sensitif melalui situs web, informasi Anda dilindungi baik online maupun offline.</p>
                <p>Meskipun kami menggunakan enkripsi untuk melindungi informasi sensitif yang dikirimkan secara online, kami juga melindungi informasi Anda secara offline. Server tempat kami menyimpan informasi identitas pribadi disimpan dalam lingkungan yang aman.</p>
                <h5>Link</h5>
                <p>Situs web ini berisi tautan ke situs lain. Harap perhatikan bahwa kami tidak bertanggung jawab atas konten atau praktik privasi dari situs lain tersebut. Kami mendorong pengguna kami untuk berhati-hati ketika mereka meninggalkan situs kami dan membaca pernyataan privasi dari situs lain yang mengumpulkan informasi identitas pribadi.</p>
                <h5>Perbaruan</h5>
                <p>Kebijakan Privasi kami dapat berubah dari waktu ke waktu dan semua pembaruan akan diposting di halaman ini.</p>
            </div>
            <div class="modal-footer d-inline d-sm-flex">
                <div class="d-grid">
                    <button type="button" class="btn btn-success fw-bold" data-bs-dismiss="modal">Paham</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticTerms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticTermsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticTermsLabel">Terms & Condition</h5>
            </div>
            <div class="modal-body">
                <p>Dengan mengakses situs web ini, anda telah membaca privacy policy dengan pernuh sadar. Tidak ada syarat apapun kecuali telah membaca privacy policy karena project ini bersifat open source. Terima kasih</p>
            </div>
            <div class="modal-footer d-inline d-sm-flex">
                <div class="d-grid">
                    <button type="button" class="btn btn-success fw-bold" data-bs-dismiss="modal">Setuju</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= extend('auth/templates/baseDown') ?>