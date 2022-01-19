<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Pesanan</h1>
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

<!-- Modal Edit -->
<div class="modal fade" id="modalInput" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formInput" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="pemesan" class="col-sm-2 col-form-label">Pemesan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pemesan" class="form-control" id="pemesan" placeholder="Pemesan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tamu" class="col-sm-2 col-form-label">Nama Tamu</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tamu" class="form-control" id="tamu" placeholder="Nama Tamu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobil" class="col-sm-2 col-form-label">Mobil</label>
                                <div class="col-sm-10">
                                    <select name="mobil" class="form-control" id="mobil">
                                        <option value="" selected disabled hidden>Mobil</option>
                                        <?php foreach ($this->db->get('car_type')->result() as $car) : ?>
                                            <option value="<?= $car->id ?>"><?= $car->type ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="noplat" class="col-sm-2 col-form-label">No. Pol</label>
                                <div class="col-sm-10">
                                    <select name="noplat" class="form-control" id="noplat"></select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pengemudi" class="col-sm-2 col-form-label">Nama Pengemudi</label>
                                <div class="col-sm-10">
                                    <select name="pengemudi" class="form-control" id="pengemudi">
                                        <option value="" selected disabled hidden>Nama Pengemudi</option>
                                        <?php foreach ($this->db->get('driver')->result() as $dv) : ?>
                                            <option value="<?= $dv->id ?>"><?= $dv->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamattujuan" class="col-sm-2 col-form-label">Alamat Tujuan</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="alamattujuan" class="form-control" id="alamattujuan" rows="2" placeholder="Alamat Tujuan"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamatjemput" class="col-sm-2 col-form-label">Alamat Jemput</label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="alamatjemput" class="form-control" id="alamatjemput" rows="2" placeholder="Alamat Jemput"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="waktujemput" class="col-sm-2 col-form-label">Waktu Penjemputan</label>
                                <div class="col-sm-10">
                                    <input type="date" name="waktujemput" class="form-control" id="waktujemput" placeholder="Waktu Penjemputan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pengembalian" class="col-sm-2 col-form-label">Rencana Pengembalian</label>
                                <div class="col-sm-10">
                                    <input type="date" name="pengembalian" class="form-control" id="pengembalian" placeholder="Rencana Pengembalian">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        table = $('#table_order').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url() ?>/pesanan/getdatalist",
                "type": "POST",
            },

            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
        })
    })

    $(document).on('click', '.btn-edit', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        $('#modalInput').modal('show')
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/pesanan/prosesOrder",
            async: true,
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#id').val(data[0].order_number)
                $('#pemesan').val(data[0].customer_name)
                $('#tamu').val(data[0].guest_name)
                $('#alamattujuan').val(data[0].destination)
                $('#alamatjemput').val(data[0].pickup)
                $('#waktujemput').val(data[0].pickup_date)
                $('#pengembalian').val(data[0].return_date)
                $('#pengemudi').val(data[0].driver_id)
                $('#mobil').val(data[0].car_type)
                getNoPlat(data[0].car_type)
                setTimeout(function() {
                    $('#noplat').val(data[0].car_id)
                }, 500)
            },
            error: function() {
                console.log("error")
            }
        })
    })

    $('#mobil').on('change', function(e) {
        e.preventDefault()
        let id = $('#mobil').val()
        getNoPlat(id)
    })

    function getNoPlat(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>/pesanan/dropdownNoPlat",
            async: true,
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                $('#noplat').html(data.list)
            },
            error: function() {
                console.log("error")
            }
        })
    }

    $('#formInput').on('submit', function(e) {
        e.preventDefault()
        if (confirm("Are you sure?") == true) {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/pesanan/editOrder",
                processData: false,
                contentType: false,
                cache: false,
                async: true,
                data: new FormData(this),
                dataType: "JSON",
                success: function(data) {
                    $('#formInput').trigger('reset')
                    $('#modalInput').modal('hide')
                },
                error: function() {
                    console.log("error")
                }
            })
        }
    })

    // Delete
    $(document).on('click', '.btn-cancel', function(e) {
        e.preventDefault()
        let id = $(this).data('id')
        if (confirm("Are you sure?") == true) {
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>/pesanan/cancelOrder",
                async: true,
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(data) {
                    alert('Sukses')
                },
                error: function() {
                    console.log("error")
                }
            })
        }
    })
</script>