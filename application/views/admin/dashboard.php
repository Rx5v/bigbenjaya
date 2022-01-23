<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cart-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Pesanan Masuk</span>
                            <span class="info-box-number">
                                <?= $this->db->from('order_head')->where('status', 1)->count_all_results() ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car-side"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Mobil</span>
                            <span class="info-box-number">
                                <?= $this->db->from('car')->count_all_results() ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tags"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Pesanan</span>
                            <span class="info-box-number">
                                <?= $this->db->from('order_head')->count_all_results() ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Pesanan Masuk</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>No.Pesanan</th>
                                            <th>Pemesan</th>
                                            <th>Tanggal Pemesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $data = $this->db->where('status', 1)->limit(10)->get('order_head')->result();
                                        if ($data) :
                                            foreach ($data as $om) : ?>
                                                <tr>
                                                    <td><span class="badge badge-primary"><?= $om->order_number ?></span></td>
                                                    <td><?= $om->customer_name ?></td>
                                                    <td><?= $om->created_at ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Belum ada pesanan...</td>
                                            </tr>
                                        <?php endif ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <a href="<?= base_url() ?>pesanan" class="btn btn-sm btn-secondary float-right">Lihat Detail</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    $(document).ready(function() {
        $('#sb-dashboard').addClass('active')
    })
</script>