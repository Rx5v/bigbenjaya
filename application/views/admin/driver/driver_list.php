<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Driver</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-sm btn-primary mb-3 float-right" id="addButton">+ Add Driver</button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="driverTable">
                            <thead>
                                <th>No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" tabindex="-1" id="updateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="updateForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="uName">Name</label>
                                <input type="text" class="form-control" id="uName" placeholder="Driver Name" name="uName">
                            </div>
                            <div class="form-group">
                                <label for="uPhone">Phone</label>
                                <input type="number" class="form-control" id="uPhone" placeholder="08xxxxx" name="uPhone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group ">
                                        <label for="uFile">Driver Picture</label>
                                        <input type="file" name="uPict" class="uFile" id="uPict" style="visibility: hidden;position: absolute;">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload File" id="uFile">
                                            <div class="input-group-append">
                                                <button type="button" class="uBrowse btn btn-info" id="uBrowse">Browse...</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="uId" id="uId">
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="oldPict" id="oldPict">
                                    <img id="uPreview" class="img-thumbnail" alt="" width="200">

                                </div>
                            </div>
                        </div>
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

<div class="modal fade" tabindex="-1" id="addModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Drivers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="addForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Driver Name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="number" class="form-control" id="phone" placeholder="08xxxxx" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group ">
                                        <label for="file">Driver Picture</label>
                                        <input type="file" name="pict" class="file" style="visibility: hidden;position: absolute;">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-info">Browse...</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <img id="preview" class="img-thumbnail" alt="" width="200">

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
    /*
      note: Swal is function to initialize Sweetalert, open https://sweetalert2.github.io/ to see documentation
    */

    $(document).ready(function() {
        showData();
        $('[data-toggle="tooltip"]').tooltip()
    })

    function showData() {
        $('#driverTable').DataTable({
            "responsive": true,
            "destroy": true,
            "processing": false, // hide proceessing notification
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url('driver/getDriver') ?>",
                "type": "POST"
            },

            // make selected column unOrderable
            "columnDefs": [{
                "targets": [0, 2, 4],
                "orderable": false,

            }]

        });

    }
    // to open input file
    $(".browse").on("click", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    // to show selected picture name 
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    //remove data. this function is called by delete button (see the button has onclick propperty )
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
                    url: "<?= base_url('driver/delete') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        Swal.fire('Success!', '', 'success')
                        $('#driverTable').DataTable().ajax.reload()
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

    // Show add Modal
    $('#addButton').click(function() {
        $("#addModal").modal('show')
    })

    //Save
    $("#addForm").submit(function(e) { // When form that have id 'addForm' submited
        e.preventDefault() // to prevent page reload
        // save by ajax
        $.ajax({
            type: "POST",
            url: "<?= base_url('driver/save') ?>",
            dataType: "JSON",
            data: new FormData($("#addForm")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                Swal.fire('Success', '', 'success')
                $("#addModal").modal('hide') // hide modal
                $("#addForm").trigger('reset') // to reset form value
                $('input[type="file"]').val('');
                $('#driverTable').DataTable().ajax.reload() // reload table data (table only)

            },
            error: function() {
                console.log('error');
            }
        });
    })

    function edit(id) {
        $("#updateModal").modal('show')

        $.ajax({
            type: "POST",
            url: "<?= base_url('driver/edit') ?>",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(data) {

                $("#uName").val(data.name)
                $("#uPreview").attr('src', '<?= base_url("uploads/driver/") ?>' + data.pict)
                $("#uPhone").val(data.phone)
                $("#uId").val(data.id)
                $("#oldPict").val(data.pict)
            },
            error: function() {
                console.log('error');
            }
        });
    }

    $("#updateForm").submit(function(e) {
        e.preventDefault()
        Swal.fire({
            title: 'Do you want to update this data?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Update',
            denyButtonText: `cancel`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('driver/update') ?>",
                    dataType: "JSON",
                    data: new FormData($("#updateForm")[0]),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire('Success', '', 'success')
                        $("#updateModal").modal('hide') // hide modal
                        $("#updateForm").trigger('reset') // to reset form value
                        $('input[type="file"]').val('');
                        $('#driverTable').DataTable().ajax.reload() // reload table data (table only)

                    },
                    error: function() {
                        console.log('error');
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        })

    })

    $("#uBrowse").on("click", function() {
        var file = $(this).parents().find(".uFile");
        file.trigger("click");
    });
    // to show selected picture name 
    $('#uPict').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#uFile").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("uPreview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>