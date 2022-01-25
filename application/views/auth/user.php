<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BigBenJaya | Login</title>

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
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>BIG BEN</b>JAYA</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="form-login" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-7">
                        </div>
                        <!-- /.col -->
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block">Log In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-0">
                    <a href="<?= base_url() ?>auth/register" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/assets/template/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>/assets/template/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/assets/template/adminlte/dist/js/adminlte.min.js"></script>

    <script>
        // Display
        $('#form-login').on('change', function() {
            (!$('#email').val()) ? $('[name="email"]').removeClass('is-valid').addClass('is-invalid'): $('[name="email"]').removeClass('is-invalid').addClass('is-valid');
            (!$('#password').val()) ? $('[name="password"]').removeClass('is-valid').addClass('is-invalid'): $('[name="password"]').removeClass('is-invalid').addClass('is-valid');
        })

        // Submit
        $("#form-login").on('submit', function(e) {
            e.preventDefault()
            let checkemail = true
            let checkpass = true

            if (!$('#email').val()) {
                $('[name="email"]').removeClass('is-valid').addClass('is-invalid')
                checkemail = false;
            }
            if (!$('#password').val()) {
                $('[name="password"]').removeClass('is-valid').addClass('is-invalid')
                checkpass = false;
            }

            if (checkpass && checkemail) {
                $.ajax({
                    url: "<?= base_url() ?>auth/login",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    data: new FormData(this),
                    dataType: "JSON",
                    success: function(data) {
                        if (data.result == "admin") {
                            window.location = "<?= base_url() ?>admin";
                        } else if (data.result == "customer") {
                            window.location = "<?= base_url() ?>customer/pemesanan";
                        } else if (data.result == "not_active") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Your Account is Non Active',
                                text: 'Please ask to admin...',
                            })
                        } else if (data.result == "wrong_password") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Wrong Password',
                                text: 'Check your password and try again...',
                            })
                        } else if (data.result == "false") {
                            Swal.fire({
                                icon: 'error',
                                title: 'Email or Password Invalid',
                                text: 'Check your data and try again...',
                            })
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            icon: 'error',
                            title: 'System Error',
                            text: 'Please ask to admin...',
                        });
                    }
                });
            }
        })
    </script>
</body>

</html>