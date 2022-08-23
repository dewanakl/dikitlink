<script src="<?= asset('sw.js') ?>"></script>
<script>
    if (!navigator.serviceWorker.controller) {
        navigator.serviceWorker.register('sw.js').then(function(reg) {
            console.log('Service worker has been registered for scope: ' + reg.scope);
        });
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>