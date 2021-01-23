<?= $this->extend('template/main') ?>

<?php $this->setVar('title', 'Data') ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <div class="card-title">Data User</div>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary float-end" type="button" data-bs-toggle="modal" data-bs-target="#create">
                        <i class="fa fa-plus"></i>
                        Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataUser">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create">
                <div class="modal-header">
                    <div class="modal-title">Tambah User</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Masukkan Username" name="username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Password (Konfirmasi)</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password (Konfirmasi)" name="password_konfirmasi">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email" name="email" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="edit">
                <input type="hidden" class="id">
                <div class="modal-header">
                    <div class="modal-title">Edit User</div>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Masukkan Username" name="username" autocomplete="off">
                    </div>
                    <!-- <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Password (Konfirmasi)</label>
                        <input type="password" class="form-control" placeholder="Masukkan Password (Konfirmasi)" name="password_konfirmasi">
                    </div> -->
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="Masukkan Email" name="email" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="remove">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="remove">
                <input type="hidden" class="id">
                <div class="modal-header">
                    <div class="modal-title">Hapus User</div>
                </div>
                <div class="modal-body">
                    <p>Anda yakin menghapus user <strong class="nama">-</strong> ?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" type="button" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<link rel="stylesheet" href="<?= base_url('cdn/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<script src="<?= base_url('cdn/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('cdn/plugins/datatables-bs4/js/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('cdn/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // tampilkan user
        const show = () => {
            $('#dataUser').DataTable().destroy();
            $('#dataUser').DataTable({
                "deferRender": true,
                "ajax": {
                    "url": base_url + "api/user",
                    "method": "GET",
                    "dataSrc": "data"
                },
                "columns": [
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "nama"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: null,
                        render: (data) => {
                            return `
                            <div class="text-center">
                                <button class="btn btn-edit btn-sm btn-info" type="button" data-bs-toggle="modal" data-bs-target="#edit" data-id="${data.id}" data-username="${data.username}" data-nama="${data.nama}" data-email="${data.email}" data-jenis_kelamin="${data.jenis_kelamin}">
                                    Edit
                                </button>
                                <button class="btn btn-remove btn-sm btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#remove" data-id="${data.id}" data-nama="${data.nama}">
                                    Hapus
                                </button>
                            </div>
                            `;
                        }
                    }
                ],
                "language": {
                    "zeroRecords": "user tidak tersedia"
                },
                "initComplete": setting => {
                    // klik button edit
                    document.querySelectorAll('button.btn-edit').forEach(element => {
                        element.addEventListener('click', function() {
                            document.querySelector('form#edit .id').value = this.dataset.id;
                            document.querySelector('form#edit [name=username]').value = this.dataset.username;
                            // document.querySelector('form#edit [name=password]').value = 'some password';
                            document.querySelector('form#edit [name=nama]').value = this.dataset.nama;
                            document.querySelector('form#edit [name=email]').value = this.dataset.email;
                            document.querySelector('form#edit [name=jenis_kelamin]').value = this.dataset.jenis_kelamin;
                        })
                    });

                    // klik button hapus
                    document.querySelectorAll('button.btn-remove').forEach(element => {
                        element.addEventListener('click', function() {
                            document.querySelector('form#remove .id').value = this.dataset.id;
                            document.querySelector('form#remove .nama').innerHTML = this.dataset.nama;
                        })
                    })
                }
            });
        }

        show();

        // tambah user
        document.querySelector('form#create').addEventListener('submit', function(e) {
            e.preventDefault();
            if (document.querySelector('form#create [name=password]').value == document.querySelector('form#create [name=password_konfirmasi]').value) {
                axios.post(base_url + 'api/user/create', querystring({
                    username: document.querySelector('form#create [name=username]').value,
                    password: document.querySelector('form#create [name=password]').value,
                    nama: document.querySelector('form#create [name=nama]').value,
                    jenis_kelamin: document.querySelector('form#create [name=jenis_kelamin]').value,
                    email: document.querySelector('form#create [name=email]').value
                }), {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                }).then(res => {
                    res = res.data;
                    if (res.error) {
                        notif(res.message, 'error', true);
                    } else {
                        notif(res.message, 'success');
                        document.querySelector('form#create [name]').value = '';
                        bootstrap.Modal.getInstance(document.querySelector('div#create')).hide();
                        show();
                    }
                })   
            } else {
                notif("password konfirmasi harus sama", 'error', true);
            }
        });

        // edit user
        document.querySelector('form#edit').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.querySelector('form#edit .id').value;
            axios.post(base_url + 'api/user/edit/' + id, querystring({
                username: document.querySelector('form#edit [name=username]').value,
                // password: document.querySelector('form#edit [name=password]').value,
                nama: document.querySelector('form#edit [name=nama]').value,
                jenis_kelamin: document.querySelector('form#edit [name=jenis_kelamin]').value,
                email: document.querySelector('form#edit [name=email]').value
            }), {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then(res => {
                res = res.data;
                if (res.error) {
                    notif(res.message, 'error', true);
                } else {
                    notif(res.message, 'success');
                    document.querySelector('form#edit [name]').value = '';
                    bootstrap.Modal.getInstance(document.querySelector('div#edit')).hide();
                    show();
                }
            })
        });

        document.querySelector('form#remove').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.querySelector('form#remove .id').value;
            axios.get(base_url + 'api/user/remove/' + id).then(res => {
                res = res.data;
                if (res.error) {
                    notif(res.message, 'error', true);
                } else {
                    notif(res.message, 'success');
                    bootstrap.Modal.getInstance(document.querySelector('div#remove')).hide();
                    show();
                }
            })
        })

    })
</script>
<?= $this->endSection() ?>