<?php
include_once 'session.php';
// only admin has access
if ('admin' != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: error_message.php');
    exit;
}
else{
    if(isset($_POST['approve'])){
        /*
         * do something here
         * */

        header('Location: request_signup_list.php');
        exit;
    }
    if(isset($_POST['reject'])){
        /*
         * do something here
         * */

        header('Location: request_signup_list.php');
        exit;
    }
    if(isset($_POST['view'])){
        header('Location: request_detail.php?request_id='.$_POST['request_id']);
    }
}

?>
<head>
    <script src="../jquery.js"></script>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div style="margin: 80px;" class="container-fluid">
    <div class="row">
        <h2>Request sign up</h2>
        <table class="col-md-12 table table-condensed table-hover">
            <tr>
                <th>Id</th>
                <th>Shop name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>Address</th>
                <th>Request date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php
            $requestList =  RequestSignupController::getAllRequest();
            foreach($requestList as $request){
                echo('
                <tr>
                    <td>'.$request->getId().'</td>
                    <td>'.$request->getName().'</td>
                    <td>'.$request->getEmail().'</td>
                    <td>'.$request->getPhoneNumber().'</td>
                    <td><a href="" data-toggle="modal" onclick="showMap()" data-target=".bs-example-modal-lg">'.$request->getAddress().'</a>
                    <input type="hidden" class="address" value="'.$request->getAddress().'">
                    <input type="hidden" class="latitude" value="'.$request->getLatitude().'">
                    <input type="hidden" class="longitude" value="'.$request->getLongitude().'"></td>
                    <td>'.$request->getRequestDate().'</td>
                    <td>'.$request->getStatus().'</td>
                    <td>'.$request->getStatus().'</td>
                </tr>
                ');
            }

            ?>
        </table>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">40 Nimmarnhemin Rd., T.Suthep, A.Muang, Chiang Mai, 50200</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
    </div>
</div>

<script>
    function showMap(){
        $( ".address" )
            .keyup(function() {
                var value = $( this ).val();
                alert(value);
            }).keyup();
        var latitude = document.getElementsByClassName("latitude").val;
        var longitude = document.getElementsByClassName("longitude").val;
//        alert(address);
    }

</script>
</body>
</html>
