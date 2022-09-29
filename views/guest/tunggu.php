<?php parents('layout/guest', ['title' => $opened ? 'Sabar yaa' : 'Maaf yaa', 'img' => 'time.svg']) ?>

<?php section('guest') ?>

<div class="container">
    <div class="row">
        <div class="col-auto mx-auto">
            <img src="<?= asset('time.svg') ?>" width="200" class="d-block d-md-none img-fluid ">
        </div>
        <div class="col-md-9 col-lg-8 mx-auto">
            <h1 class="fw-bold mt-3 mb-1">
                <?= $opened ? 'Sabar yaa' : 'Maaf yaa' ?>
            </h1>
            <h5 class="fw-bold mb-4 mt-3">Link "<?= e($name) ?>" <span class="text-<?= $opened ? 'success' : 'danger' ?>"><?= $opened ? 'Akan dibuka' : 'Sudah di tutup' ?></span> dalam
                <span id="demo"></span> <?= $opened ? ' Lagi..' : 'yang lalu..' ?>
            </h5>
        </div>
    </div>
</div>

<script>
    let countDownDate = new Date("<?= $time ?>").getTime();

    const countDown = () => {
        let distance = countDownDate - (new Date().getTime());
        <?= $opened ? null : 'distance = Math.abs(distance);' ?>

        if (distance < 0) {
            clearInterval(time);
            setTimeout(() => window.location.reload(), 1000);
            return false;
        }

        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
        days = days == 0 ? '' : days + ' Hari';

        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        hours = hours == 0 ? '' : hours + ' Jam';

        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        minutes = minutes == 0 ? '' : minutes + ' Menit';

        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        seconds = seconds == 0 ? '' : seconds + ' Detik';

        document.getElementById('demo').innerHTML = days + ' ' + hours + ' ' + minutes + ' ' + seconds;
    }

    let time = setInterval(countDown, 1000);
    countDown();
</script>

<?php endsection('guest') ?>