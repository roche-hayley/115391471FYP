<html>
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
                <a class="navbar-brand" href="lecturerindex.php">Tutorize</a>
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
                            <a href="lecturerindex.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                        </li>
                        <li>
                            <a href="confirm.php"><i class="fa fa-pencil fa-fw"></i>Confirm Hours</a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
     <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Wage Calculator - hayley-roche
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>StudentID</th>
                                            <th>Student Name</th>
                                            <th>Total Hours</th>
                                            <th>Wage</th>
                                            <th>Total Due (€)</th>
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
                                $sql = "SELECT STUDENT_ID, STUDENT_NAME, SUM(TOTAL_HOURS), WAGE, SUM(TOTAL_HOURS)*WAGE FROM LOGGED_HOURS WHERE LECTURER=1 AND STUDENT_ID=115391471";
                                $result = $conn-> query($sql);
                                
                                if ($result-> num_rows > 0) {
                                    while ($row = $result-> fetch_assoc()) {
                                        echo "<tr><td>".$row["STUDENT_ID"]."</td><td>".$row["STUDENT_NAME"]."</td><td>".$row["SUM(TOTAL_HOURS)"]."</td><td>".$row["WAGE"]."</td><td>".$row["SUM(TOTAL_HOURS)*WAGE"]."</td></tr>";
                                       }
                                } 
                                else {
                                    echo "0 result";
                                }
                                
                                $conn-> close();
                                ?>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        
                        <!-- https://stripe.com/docs/checkout#integration-simple -->
                        <form action="your-server-side-code" method="POST">
                        <script
                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="pk_test_NedYO6UmQgV6vlcxEyMrQ4Yn"
                          data-amount="4200"
                          data-name="hayley-roche-fyp"
                          data-description="Widget"
                          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                          data-locale="auto"
                          data-currency="eur">
                        </script>
                      </form>
                        <button type="button" class="btn btn-danger">Clear Hours</button>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Wage Calculator
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>StudentID</th>
                                            <th>Student Name</th>
                                            <th>Total Hours</th>
                                            <th>Wage</th>
                                            <th>Total Due (€)</th>
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
                                $sql = "SELECT STUDENT_ID, STUDENT_NAME, SUM(TOTAL_HOURS), WAGE, SUM(TOTAL_HOURS)*WAGE FROM LOGGED_HOURS WHERE LECTURER=1 AND STUDENT_ID=115321791";
                                $result = $conn-> query($sql);
                                
                                if ($result-> num_rows > 0) {
                                    while ($row = $result-> fetch_assoc()) {
                                        echo "<tr><td>".$row["STUDENT_ID"]."</td><td>".$row["STUDENT_NAME"]."</td><td>".$row["SUM(TOTAL_HOURS)"]."</td><td>".$row["WAGE"]."</td><td>".$row["SUM(TOTAL_HOURS)*WAGE"]."</td></tr>";
                                       }
                                } 
                                else {
                                    echo "0 result";
                                }
                                
                                $conn-> close();
                                ?>
                                </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                        <!-- https://stripe.com/docs/checkout#integration-simple -->
                        <form action="your-server-side-code" method="POST">
                        <script
                          src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="pk_test_NedYO6UmQgV6vlcxEyMrQ4Yn"
                          data-amount="3150"
                          data-name="hayley-roche-fyp"
                          data-description="Widget"
                          data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                          data-locale="auto"
                          data-currency="eur">
                        </script>
                      </form>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
    <!-- jQuery -->
    <script src="FinalYearProjectBootstrap/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="FinalYearProjectBootstrap/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="FinalYearProjectBootstrap/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="FinalYearProjectBootstrap/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="FinalYearProjectBootstrap/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="FinalYearProjectBootstrap/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="FinalYearProjectBootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>
    </html>