<?php parents('layout/guest', ['title' => $opened ? 'Tunggu yaa' : 'Maaf yaa', 'img' => 'time.svg']) ?>

<?php section('guest') ?>

<h1 class="fw-bold"><?= $opened ? 'Tunggu yaa' : 'Maaf yaa' ?></h1>
<h4 class="my-3"><span class="badge fw-normal text-bg-<?= $opened ? 'success' : 'danger' ?>" id="times"></span></h4>
<h5>Link <strong>"<?= e($name) ?>"</strong> <?= $opened ? 'akan dibuka' : 'sudah di tutup' ?></h5>

<script defer>
    let countDownDate = (new Date("<?= $time ?>")).getTime();
    let time = null;

    const countDown = () => {
        let distance = countDownDate - (new Date()).getTime();
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
        seconds = seconds == 0 && minutes != '' ? '' : seconds + ' Detik';

        if (days != '') {
            minutes = '';
            seconds = '';
        }

        if (hours != '') {
            seconds = '';
        }

        document.getElementById('times').innerText = days + ' ' + hours + ' ' + minutes + ' ' + seconds;
    }

    time = setInterval(countDown, 1000);
    countDown();
</script>

<?php endsection('guest') ?>