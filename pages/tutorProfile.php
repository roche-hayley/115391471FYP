<!DOCTYPE html>
<html lang="en">
<?php 
include ('session.php');
// https://stackoverflow.com/questions/1987579/remove-warning-messages-in-phpS
ini_set( "display_errors", 0);
error_reporting(0);
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutorize</title>

   <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- below is the relevent bootsrap for elements for my tutor page that i 
    have found on https://bootsnipp.com/snippets/4Mm5R 
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Tutorize</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>Hello <?php echo $user_check ?>
                    </a>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/pages/index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                        </li>
                        <li>
                            <a href="/pages/tutorProfile.php"><i class="fa fa-table fa-fw"></i>Profile</a>
                        </li>
                        <li>
                            <a href="/pages/loghours.php"><i class="fa fa-pencil fa-fw"></i>Log Your Hours</a>
                        </li>
                        <li>
                            <a href="/pages/tables.php"><i class="fa fa-check fa-fw"></i>Logged Hours</a>
                        </li>
                        <li>
                            <a href="https://dashboard.stripe.com/test/dashboard"><i class="fa fa-plus-square fa-fw"></i>Stripe Account</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="text-center">
        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
        <h6>Upload a different photo...</h6>
        <input type="file" class="text-center center-block file-upload">
      </div></hr><br>

          <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>StudentID</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>D.O.B.</th>
                                        <th>Module</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- https://www.youtube.com/watch?v=bHFoobciCTM -->
                                <?php
                                $conn = mysqli_connect("localhost", "root", "albertroad", "fypdatabase");
                                if ($conn-> connect_error) {
                                    die("Connection failed:". $conn-> connect_error);
                                }
                                // https://stackoverflow.com/questions/20828182/retrieving-data-from-mysql-database-using-session-username 
                                $sql = "SELECT STUDENT_ID, STUDENT_USERNAME, STUDENT_FN, STUDENT_LN, STUDENT_DOB, MODULE FROM TUTOR_PROFILE WHERE STUDENT_USERNAME = '".$_SESSION['login_user']."'";
                                $result = $conn-> query($sql);
                                
                                if ($result-> num_rows > 0) {
                                    while ($row = $result-> fetch_assoc()) {
                                        echo "<tr><td>".$row["STUDENT_ID"]."</td><td>".$row["STUDENT_USERNAME"]."</td><td>".$row["STUDENT_FN"]."</td><td>".$row["STUDENT_LN"]."</td><td>".$row["STUDENT_DOB"]."</td><td>".$row["MODULE"]."</td></tr>";
                                    }
                                    echo "table";
                                } 
                                else {
                                    echo "0 result";
                                }
                                
                                $conn-> close();
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
      <script>
          <!-- https://bootsnipp.com/snippets/4Mm5R -->
      $(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="FinalYearProjectBootstrap/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="FinalYearProjectBootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="FinalYearProjectBootstrap/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="FinalYearProjectBootstrap/dist/js/sb-admin-2.js"></script>

</body>

</html>
