<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main - <?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url() ?>/cdn/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/cdn/plugins/sweetalert2/sweetalert2.min.css">
</head>
<body>
    <?= $this->renderSection('content') ?>
    <script src="<?= base_url() ?>/cdn/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/cdn/axios/axios.min.js"></script>
    <script src="<?= base_url() ?>/cdn/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
    // setting base_url
    var base_url = '<?= base_url() ?>/';

    // convert json ke querystring
    function querystring(json) {
        return Object.keys(json).map(obj => {
            return obj + '=' + encodeURIComponent(json[obj]);
        }).join('&');
    }

    // notifikasi
    function notif(message, type, toast) {
        if (toast) {
            const Mixin = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });

            return Mixin.fire({
                title: message,
                type: type
            });
        } else {
            return Swal.fire({
                title: type[0].toUpperCase() + type.slice(1),
                text: message,
                type: type
            });
        }
    }
    </script>
    <?= $this->renderSection('script') ?>
</body>
</html>