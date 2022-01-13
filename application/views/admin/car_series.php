<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Car type</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <button class="btn btn-sm btn-primary mb-2" id="addButton"> + Add Series </button>
                                <table class="table table-bordered" id="typeTable">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Type Name</th>
                                            <th>Series Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="typeRow"></tbody>
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
<div class="modal fade" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">+ Add Series</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formAdd">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="type">Example multiple select</label>
                        <select class="form-control" id="type" name="type">
                            <option>-- Select --</option>
                            <?php
                            $q = $this->db->get('car_type')->result();
                            foreach ($q as $op) :
                            ?>
                                <option value="<?= $op->id ?>"><?= $op->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="series">Series Name</label>
                        <input type="text" class="form-control" id="series" placeholder="Series Name e.g : Avanza, etc." name="series">
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
    $(document).ready(function() {
        showData(); // Call showData function when web fully loaded
    })
    // function show data by ajax
    function showData() {
        $.ajax({
            type: "POST",
            url: "<?= base_url('car/getDataSeries') ?>", // Url to controller
            dataType: "JSON",
            success: function(data) {
                $("#typeRow").html(data.list) // Fetch data into tbody table                
            },
            error: function() {
                console.log('error'); // If you see this error in browser console, there must be error in your script
            }
        });
    }

    // Function to open Modal add type
    $("#addButton").click(function() {
        $(".modal").modal('show'); // open form modal
        $("#formAdd").submit(function(e) {
            e.preventDefault() // to prevent web refresh
            $.ajax({
                type: "POST",
                url: "<?= base_url('car/save/2') ?>", // Url to controller
                dataType: "JSON",
                data: $("#formAdd").serialize(), //get data from form input                
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Your data has been saved!',
                    })
                    showData(); // call this function again to refresh table
                    $(".modal").modal('hide'); // close form modal
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
                    url: "<?= base_url('car/delete/2') ?>",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        Swal.fire('Success!', '', 'success')
                        showData()
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