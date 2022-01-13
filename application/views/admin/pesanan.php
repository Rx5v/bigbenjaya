<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pesanan Masuk</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table_order">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Pesanan</th>
                                            <th>Nama Pemesan</th>
                                            <th>No Hp</th>
                                            <th>Tanggal Pengambilan</th>
                                            <th>Tanggal Pemesanan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {

        table = $('#table_order').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url() ?>/pesanan/getdata",
                "type": "POST",
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        });
    })
</script>