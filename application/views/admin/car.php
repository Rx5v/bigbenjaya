<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cars</h1>
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
                                <button class="btn btn-sm btn-primary mb-2" id="addButton"> + Add Series </button>
                                <table class="table table-bordered" id="myTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Type Name</th>
                                            <th>Series Name</th>
                                            <th>Plate Number</th>
                                            <th>status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Modal -->
<div class="modal fade" tabindex="-1" id="addModal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">+ Add Cars</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formAdd">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Car Type</label>
                        <select class="form-control" id="type" name="type">
                            <option disabled selected hidden>-- Select --</option>
                            <?php
                            $q = $this->db->get('car_type')->result();
                            foreach ($q as $op) :
                            ?>
                                <option value="<?= $op->id ?>"><?= $op->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="series">Car Series</label>
                        <select class="form-control" id="series" name="series">
                            <option disabled selected hidden>-- Select --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="plat">Plat Number</label>
                        <input type="text" class="form-control" id="plat" name="plat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Modal -->
<div class="modal fade" tabindex="-1" id="formModal">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">+ Update Cars</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formAdd">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Car Type</label>
                        <select class="form-control" id="type" name="type">
                            <option disabled selected hidden>-- Select --</option>
                            <?php
                            $q = $this->db->get('car_type')->result();
                            foreach ($q as $op) :
                            ?>
                                <option value="<?= $op->id ?>"><?= $op->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="series">Car Series</label>
                        <select class="form-control" id="series" name="series">
                            <option disabled selected hidden>-- Select --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="plat">Plat Number</label>
                        <input type="text" class="form-control" id="plat" name="plat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // function show data by ajax with data table serverside   
    $(function() {
        $('#myTable').DataTable({
            "responsive": true,
            "destroy": true,
            "processing": false,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('car/getCarData') ?>",
                "type": "POST"
            },


            "columnDefs": [{
                "targets": [0, 5],
                "orderable": false,

            }]

        });
    })



    //chained dropdown
    $('#type').change(function(e) {
        e.preventDefault()
        $.ajax({
            type: "POST",
            url: "<?= base_url('car/getSeries') ?>",
            dataType: "JSON",
            data: {
                type: $('#type').val()
            },
            success: function(data) {
                $('#series').html(data.list)
            },
            error: function() {
                console.log('error');
            }
        });
    })

    // Function to open Modal add type
    $("#addButton").click(function() {
        $("#addModal").modal('show'); // open form modal
        $("#formAdd").submit(function() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('car/saveList') ?>", // Url to controller
                dataType: "JSON",
                data: $("#formAdd").serialize(), //get data from form input                
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your data has been saved!',
                    })
                    window.location.reload()
                },
                error: function() {
                    console.log('error');
                }
            });
        })

    })


    function remove(id) {
        Swal.fire({
            title: 'Do you want to delete this data?',
            text: 'you cant revert this action',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Delete',
            denyButtonText: `cancel`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('car/delete/3') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        Swal.fire('Success!', '', 'success')
                        $('#myTable').DataTable().ajax.reload()
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        })

    }
</script>