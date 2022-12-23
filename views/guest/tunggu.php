<?php parents('layout/guest', ['title' => $opened ? 'Sabar yaa' : 'Maaf yaa', 'img' => 'time.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold"><?= $opened ? 'Sabar yaa' : 'Maaf yaa' ?></h1>
<h4 class="mt-2 mb-4"><span class="badge fw-normal text-bg-<?= $opened ? 'success' : 'danger' ?>" id="demo"></span></h4>
<h5>Link <strong>"<?= e($name) ?>"</strong> <?= $opened ? 'akan dibuka' : 'sudah di tutup' ?></h5>

<script defer>
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