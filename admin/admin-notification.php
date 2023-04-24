<?php

require_once 'assets/php/admin-header.php';

?>
<div class="row justify-content-center my-2">
    <div class="col-lg-6 mt-4" id="showNotification">

    </div>
</div>

<!-- Footer Area -->
</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        //Fetch Notification Ajax Request  
        fetchNotification();

        function fetchNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'fetchNotification'
                },
                success: function(response) {
                    $("#showNotification").html(response);
                }
            });
        }

        // cehck Notification
        checkNotification();

        function checkNotification() {
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: {
                    action: 'checkNotification'
                },
                success:function(response) {
                    $("#checkNotification").html(response);
                }
            });
        }

        //remove notification ajax request
        $("body").on("click", ".close", function(e){
            e.preventDefault();
            notification_id = $(this).attr('id');
            $.ajax({
                url: 'assets/php/admin-action.php',
                method: 'post',
                data: { notification_id : notification_id },
                success:function(response){
                    fetchNotification();
                    checkNotification();   
                }
            });

        });

    });
</script>
</body>

</html>