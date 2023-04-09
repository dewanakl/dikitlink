<?php parents('layout/app', ['title' => 'Dikit Link']) ?>

<?php section('main') ?>

<div class="container">
    <header class="pt-5 px-2 border-bottom">
        <img src="<?= asset('link.svg') ?>" alt="dikitlink" width="400" height="400" class="d-block d-lg-none mb-3 img-fluid mx-auto" style="width: 70%;" loading="lazy">
        <div class="row align-items-center justify-content-center">
            <div class="col">
                <div class="text-center text-lg-start">
                    <h1 class="fw-bold my-2" style="font-size: 2.3rem;">Dikit Link</h1>
                    <h2 class="mt-0 mb-3" style="font-size: 2rem;">Link tuh dikit nggak banyak !!</h2>
                    <p class="lead my-4 bg-light rounded-4 p-3" style="font-size: 1.2rem;">
                        Aplikasi pemendek url sederhana dengan fitur statistik yang sangat detail. Cobain dehhh, seriuss !!!
                    </p>
                    <div class="d-grid justify-content-xl-start my-4">
                        <a class="btn btn-primary btn-lg rounded-3 fw-bold shadow" href="<?= route('login') ?>">Coba Sekarang !</a>
                    </div>
                </div>
            </div>
            <div class="col d-none d-lg-block mt-auto text-center">
                <img src="<?= asset('link.svg') ?>" alt="dikitlink" width="400" height="400" class="img-fluid" style="width: 70%;" loading="lazy">
            </div>
        </div>
    </header>

    <main class="px-3 py-4 border-bottom">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-rotate"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">Tanpa Batas</div>
                        <p>Bikin link sampai ribuan juga boleh, intinya sampai kamu cape sendiri.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">Statistik</div>
                        <p>Kamu bisa langsung stalking. Kayak jumlah kliknya, pake device apa, dll.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">100% Gratis</div>
                        <p>Asli nggak bohong, coba dulu baru bilang.... tuhkan gratis tisss....</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">Mudah</div>
                        <p>Sat set sat set, hiyaaa.... mudah bangett kan bikin linknya ?.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">Aman</div>
                        <p>Yoiii, open source lagi, kalau ada apa apa bisa langsung dibenerin.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex w-100 align-items-start bg-light my-2 rounded-4 p-3">
                    <div class="d-inline-flex align-items-center justify-content-center fs-4 ms-1 me-2 mt-1">
                        <i class="fa-solid fa-bolt"></i>
                    </div>
                    <div class="mt-1 mb-0">
                        <div class="h5">Cepat</div>
                        <p>Perasaan baru klik ini tombol kok udah selesai ? Gile cepet bangettt.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="py-4">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <span class="text-dark">
                    Build with<i class="fa-solid fa-heart text-danger mx-1"></i>Kamu PHP Framework
                </span>
            </div>
            <div class="col-auto">
                <a class="link-dark hover p-1 rounded text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#staticPrivacy">Privacy</a>
                <span class="text-dark h5 mx-1">&middot;</span>
                <a class="link-dark hover p-1 rounded text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#staticTerms">Terms</a>
                <span class="text-dark h5 mx-1">&middot;</span>
                <a class="link-dark hover p-1 rounded text-decoration-none" target="_blank" rel="noopener noreferrer" href="https://dikit.my.id/github_Dikit-Link">Github</a>
            </div>
        </div>
    </footer>
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
                <div class="h6 fw-bold">Keamanan</div>
                <p>Kami mengambil tindakan pencegahan untuk melindungi informasi Anda. Ketika Anda mengirimkan informasi sensitif melalui situs web, informasi Anda dilindungi baik online maupun offline. Meskipun kami menggunakan enkripsi untuk melindungi informasi sensitif yang dikirimkan secara online, kami juga melindungi informasi Anda secara offline. Server tempat kami menyimpan informasi identitas pribadi disimpan dalam lingkungan yang aman.</p>
                <div class="h6 fw-bold">Link</div>
                <p>Situs web ini berisi tautan ke situs lain. Harap perhatikan bahwa kami tidak bertanggung jawab atas konten atau praktik privasi dari situs lain tersebut. Kami mendorong pengguna kami untuk berhati-hati ketika mereka meninggalkan situs kami dan membaca pernyataan privasi dari situs lain yang mengumpulkan informasi identitas pribadi.</p>
                <div class="h6 fw-bold">Perbaruan</div>
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

<?php endsection('main') ?>