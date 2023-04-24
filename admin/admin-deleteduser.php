<?php

require_once 'assets/php/admin-header.php';

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card my-2 border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="m-0">Total Delete User</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="showAllDeletedUsers">
                    <p class="text-center align-self-center lead">Please Wait..</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Area -->
</div>
</div>
</div>

<script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
    $(document).ready(function() {

        //Fetch All Deleted User Ajax Request
        fetchAllDeletedUsers();

        function fetchAllDeletedUsers() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchAllDeletedUsers'
                },
                success: function(response) {
                    $("#showAllDeletedUsers").html(response);
                    $("table").DataTable({
                        order: [0, 'desc']
                    });
                }
            });
        }

        // Delete An user Ajax Request
        $("body").on("click", ".restoreUserIcon", function(e) {
            e.preventDefault();
            res_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure want restore this User?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'assets/php/admin-action.php',
                        method: 'post',
                        data: {
                            res_id: res_id
                        },
                        success: function(response) {
                            Swal.fire(
                                'Restored!',
                                'User restored suceessfully!.',
                                'success'
                            )
                            fetchAllDeletedUsers();
                        }
                    });

                }
            });
        });

        checkNotification();

        function checkNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'checkNotification'
                },
                success: function(response) {
                    $("#checkNotification").html(response);
                }
            })
        }

    });
</script>
</body>

</html>