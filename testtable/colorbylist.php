<?php
//include_once '../View/session.php';
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title></title>
    <link href="http://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="colorbylist.css" rel="stylesheet" type="text/css">

    <!--   CSS for 147 Colors   -->
    <link href="http://docs.justinav.info/cfbc.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="_assets/themes/yui/style.css" rel="stylesheet" type="text/css"/>
    <script src="../_assets/js/jquery-1.2.6.min.js" type="text/javascript"></script>
    <script src="../_assets/js/jquery.tablesorter-2.0.4.js" type="text/javascript"></script>
    <script src="../_assets/js/jquery.quicksearch.js" type="text/javascript"></script>
    <style type="text/css">
        div.quicksearch {
            padding-bottom: 10px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#tableOne").tablesorter({ sortList: [
                [0, 0]
            ], widgets: ['zebra'] });
            $("#tableOne tbody tr").quicksearch({
                labelText: 'Search: ',
                attached: '#tableOne',
                position: 'before',
                delay: 100,
                loaderText: 'Loading...',
                onAfter: function () {
                    if ($("#tableOne tbody tr:visible").length != 0) {
                        $("#tableOne").trigger("update");
                        $("#tableOne").trigger("appendCache");
                        $("#tableOne tfoot tr").hide();
                    }
                    else {
                        $("#tableOne tfoot tr").show();
                    }
                }
            });

        });
    </script>
</head>

<!--    color palettes       -->

<div class="container-fluid inner">
    <table id="tableOne" class="tableizer-table yui">
        <thead>
        <tr class="tableizer-firstrow">
            <th>Id</th>
            <th><a href="#" title="Click Header to Sort">User</a></th>
            <th><a href="#" title="Click Header to Sort">Title</a></th>
            <th><a href="#" title="Click Header to Sort">Action</a></th>
            <th><a href="#" title="Click Header to Sort">Action Detail</a></th>
            <th><a href="#" title="Click Header to Sort">Date</a></th>
        </tr>
        </thead>

        <?php
        include_once '../controller/AdminController.php';
        include_once '../entity/ActivitiesLogDAOImpl.php';
        $adminController = new AdminController();

        foreach (ActivitiesLogDAOImpl::getAllLogs() as $activity) {
            echo "
                    <tr>
                        <td>" . $activity->getId() . "</td>
                        <td>" . $activity->getTitle() . "</td>
                        <td>" . $adminController->getAccountById($activity->getAccountId())->getName() . "</td>
                        <td>" . $activity->getAction() . "</td>
                        <td>" . $activity->getActionDetail() . "</td>
                        <td>" . $activity->getDate() . "</td>
                    </tr>
            ";
        }
        ?>
</div>
  