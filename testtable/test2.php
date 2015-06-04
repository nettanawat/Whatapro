<?php
include_once '../View/session.php';
include_once '../controller/AdminController.php';
include_once '../Library/Adaptor.php';
// only admin has access
if (0 != $user_type) {
    $_SESSION['error_message'] = "You do not have sufficient permissions to access this page";
    $_SESSION['redirect'] = "<meta http-equiv='refresh' content='3;url=home.php'>";
    header('Location: error_message.php');
    exit;
}

?>
<head>
    <link href="../tableStyle.css" rel="stylesheet" type="text/css"/>
    <link href="../style.css" rel="stylesheet" type="text/css">
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="container">
    <div class="jumbotron col-md-12">
        <div class="col-md-10"></div>
        <div class="col-md-12">
            <label class="titleFontSize">Requests</label>
        </div>
        <div class="col-md-12">
            <div class="caption">Request List</div>
            <div class="col-md-12" id="table">
                <div class="header-row row container">
                    <span class="cell">Id</span>
                    <span class="cell">Shop Name</span>
                    <span class="cell">Email</span>
                    <span class="cell">Phone Number</span>
                    <span class="cell">Description</span>
                    <span class="cell">Request Date</span>
                    <span class="cell">Status</span>
                    <span class="cell">Action</span>

                </div>
                <?php
                /**
                 * Admin
                 */
                if(0 == $user_type) {
                $adminController = new AdminController();
                $adaptor = new Adaptor();
                foreach ($adminController->getAllRequestSignup() as $request) {
                    $adaptor->setStatus($request->getStatus());
                    echo '<div class="row">
                <input type="radio" name="expand">
                <span class="cell" data-label="Vehicle">' . $request->getId() . '</span>
                <span class="cell" data-label="Exterior">' . $request->getName() . '</span>
                <span class="cell" data-label="Interior">' . $request->getEmail() . '</span>
                <span class="cell" data-label="Engine">' . $request->getPhoneNumber() . '</span>
                <span class="cell" data-label="Engine">' . $request->getDescription() . '</span>
                <span class="cell" data-label="Engine">' . $request->getRequestDate() . '</span>
                <span class="cell" data-label="Trans">' . $adaptor->getStatus() . '</span>';
                if(0 == $request->getStatus()){
                    echo '<form name=deleteuser action=""method="post">
                            <input type=hidden value='. $request->getId().' name="userId" >
                            <span class="cell" data-label="Trans"><button type=submit class="btn btn-info btn-xs">View</button></span>
                            <span class="cell" data-label="Trans"><button type=submit class="btn btn-success btn-xs">Approve</button></span>
                            <span class="cell" data-label="Trans"><button type=submit name="delete" class="btn btn-danger btn-xs">Reject</button></span>
                        </form>';
                } else{
                    echo '<form name=deleteuser action=""method="post">
                            <input type=hidden value='. $request->getId().' name="userId" >
                            <span class="cell" data-label="Trans"><button type=submit class="btn btn-info btn-xs">View</button></span>
                            <span class="cell" data-label="Trans"><button type=submit disabled class="btn btn-success btn-xs">Approve</button></span>
                            <span class="cell" data-label="Trans"><button type=submit disabled name="delete" class="btn btn-danger btn-xs">Reject</button></span>
                        </form>';
                }
            echo '</div>';
                }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
