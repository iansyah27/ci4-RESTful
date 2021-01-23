<?= $this->extend('template/main') ?>

<?php $this->setVar('title', 'Login') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <form id="login">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Login</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" placeholder="Masukkan Username" autocomplete="off" name="username">
                        </div>
                        <div class="form-group">
                        <label>Password</label>
                            <input type="password" class="form-control" placeholder="Masukkan Password" autocomplete="off" name="password">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {

    document.querySelector('form#login').addEventListener('submit', function(e) {
        e.preventDefault();
        axios.post(base_url + 'api/auth/login', querystring({
            username: document.querySelector('form#login [name=username]').value,
            password: document.querySelector('form#login [name=password]').value
        })).then(response => {
            res = response.data;
            if (res.error) {
                notif(res.message, 'error', true);
            } else {
                notif(res.message, 'success').then(swal => {
                    window.location = base_url + 'auth/cek/' + res.data.id;
                });
            }
        });
    })

})
</script>
<?= $this->endSection() ?>