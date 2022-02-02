<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIG BEN JAYA</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/template/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/template/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/template/adminlte/dist/css/adminlte.min.css">
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-logo">
                    <span><b>BIG BEN</b>JAYA</span>
                    <img src="<?= base_url() ?>assets/img/logo_bigbenjaya.jpg" class="rounded" width="20%" alt="logo">
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body">

                        <h5 class="login-box-msg">Form Pemesanan</h5>

                        <form id="formOrder" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="namaPemesan" class="form-control form-control-border border-width-2" id="namaPemesan" placeholder="Nama Pemesan">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="namaTamu" class="form-control form-control-border border-width-2" id="namaTamu" placeholder="Nama Tamu">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nomorHp" class="form-control form-control-border border-width-2" id="nomorHp" placeholder="Nomor Hp">
                                    </div>
                                    <div class="form-group">
                                        <select type="text" name="mobil" class="form-control form-control-border border-width-2" id="mobil">
                                            <option selected disabled>Mobil yang dipesan</option>
                                            <?php foreach ($this->db->get('car_type')->result() as $car) : ?>
                                                <option value="<?= $car->id ?>"><?= $car->type ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="alamatPenjemputan" class="form-control form-control-border border-width-2" rows="1" id="alamatPenjemputan" placeholder="Alamat Penjemputan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="alamatTujuan" class="form-control form-control-border border-width-2" rows="1" id="alamatTujuan" placeholder="Alamat Tujuan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="jamPenjemputan" class="form-control form-control-border border-width-2" id="jamPenjemputan" placeholder="Jam Penjemputan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalPengambilan">Tanggal Pengambilan</label>
                                        <input type="datetime-local" name="tanggalPengambilan" class="form-control form-control-border border-width-2" id="tanggalPengambilan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalPengembalian">Tanggal Pengembalian</label>
                                        <input type="datetime-local" name="tanggalPengembalian" class="form-control form-control-border border-width-2" id="tanggalPengembalian">
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3 text-center">
                                    <button type="submit" class="btn btn-secondary">&nbsp;&nbsp;&nbsp;Kirim&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/template/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/assets/template/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/assets/template/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        $('#formOrder').on('submit', function(e) {
            e.preventDefault()

            Swal.fire({
                title: 'Are you Going to Place an Order?',
                text: "Make sure your data is correct...",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() ?>/customer/pemesanan/order",
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: true,
                        data: new FormData(this),
                        dataType: "JSON",
                        success: function(data) {
                            $('#formOrder').trigger('reset')
                            Swal.fire(
                                'Success!',
                                'Your Order data has been send.',
                                'success'
                            )
                        },
                        error: function() {
                            console.log("error")
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>