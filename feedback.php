<?php
require_once 'assets/php/header.php';
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mt-3">
            <div class="card border-primary">
                    <div class="card-header lead text-center bg-primary text-white">Send Feedback to Admin!</div>
                    <div class="card-body">
                        <form action="#" method="post" class="px-4" id="feedback-form">
                            
                            <div class="form-group">
                                <input type="text" name="subject" placeholder="Write Your Subject" class="form-control-lg form-control rounded-0" required>
                            </div>

                            <div class="form-group">
                                <textarea name="feedback" class="form-control-lg form-control rounded-0" placeholder="Write Your Feedback here..." rows="8" required></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="feedbackBtn" id="feedbackBtn" value="Send Feedback" class="btn btn-primary btn-block btn-lg rounded-0">
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script type="text/javascript">
    $(document).ready(function(){
        //send Feedback to Admin Ajax Request
        $("#feedbackBtn").click(function(e){
            if($("#feedback-form")[0].checkValidity()){
                e.preventDefault();

                $(this).val('Please Wait');

                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: $("#feedback-form").serialize()+'&action=feedback',
                    success:function(response){
                        $("#feedback-form")[0].reset();
                        $("#feedbackBtn").val('Send Feedback');
                        swal.fire({
                            title: 'Feedback Successfully Sent To The Admin!',
                            type: 'success'
                        });
                    }

                });
            }
        });


        // Check Notification
        checkNotification();
            function checkNotification(){
                $.ajax({
                    url: 'assets/php/process.php',
                    method: 'post',
                    data: { action: 'checkNotification' },
                    success:function(response){
                        $("#checkNotification").html(response);
                    }

                });
            }

    });
</script>


</body>

</html>