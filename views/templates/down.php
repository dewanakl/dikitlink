</div>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Apakah anda ingin Logout ?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="button-logout-batal"><i class="fas fa-times"></i> Batal</button>
                <form action="<?= route('logout') ?>" method="post" onsubmit="logout()">
                    <?= csrf() ?>
                    <?= method('delete') ?>
                    <button type="submit" class="btn btn-danger" id="button-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (routeIs('dashboard')) : ?>
    <script src="<?= asset('js/dashboard.js') ?>" defer></script>
<?php endif ?>
<script>
    const logout = () => {
        let btnbatal = document.getElementById('button-logout-batal');
        let btn = document.getElementById('button-logout');
        btn.disabled = true;
        btnbatal.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';
    }
</script>
<?= extend('templates/baseDown') ?>