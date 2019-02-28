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
                <a class="navbar-brand" href="index.html">UCC Tutor Hours</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>Hello <?php echo $user_check ?><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
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
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i>Home</a>
                        </li>
                        <li>
                            <a href="tutorProfile.php"><i class="fa fa-table fa-fw"></i>Profile</a>
                        </li>
                        <li>
                            <a href="loghours.php"><i class="fa fa-pencil fa-fw"></i>Log Your Hours</a>
                        </li>
                        <li>
                            <a href="tables.php"><i class="fa fa-check fa-fw"></i>Logged Hours</a>
                        </li>
                        <li>
                            <a href="https://stripe.com/ie"><i class="fa fa-plus-square fa-fw"></i>Stripe Account</a>
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
                    <h1 class="page-header">Enter Hours</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form action="loghours.php" method='post'>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Student Number:</label><br>
                                            <input class="form-control" placeholder="Student ID" name="studentid"> 
                                        </div>
                                        <div class="form-group">
                                            <label>Student Name:</label>
                                            <input class="form-control" placeholder="Student Name" name="studentname">                                             
                                        </div>
                                        <div class="form-group">
                                            <label>Week Commencing: YYYY-MM-DD</label>
                                            <input class="form-control" placeholder="Week Commencing" name="week">
                                        </div>
                                        <div class="form-group">
                                            <label>Date of Tutorial: YYYY-MM-DD</label>
                                            <input class="form-control" placeholder="Date of Tutorial" name="date">
                                        </div>
                                        <div class="form-group">
                                            <label>Course Code:</label>
                                            <input class="form-control" placeholder="Course Code" name="coursecode">
                                        </div>
                                        <div class="form-group">
                                            <label>Lecturer:</label><br>
                                            <?php
                                        // https://www.sitepoint.com/community/t/populate-dropdown-menu-from-mysql-database/6481/5
                                        $conn = new mysqli('localhost', 'root', 'albertroad', 'fypdatabase') 
                                        or die ('Cannot connect to db');

                                            $result = $conn->query("select LECTURER_ID, LECTURER_FIRSTNAME, LECTURER_LASTNAME from lecturers");

                                            echo "<html>";
                                            echo "<body>";
                                            echo "<select name='lecturer'>";

                                            while ($row = $result->fetch_assoc()) {

                                                          unset($lecturer_id, $firstname, $lastname);
                                                          $lecturer_id = $row['LECTURER_ID'];
                                                          $firstname = $row['LECTURER_FIRSTNAME'];
                                                          $lastname = $row['LECTURER_LASTNAME']; 
                                                          echo '<option value="'.$lecturer_id.'">'.$lastname.'</option>';

                                        }

                                            echo "</select>";
                                            echo "</body>";
                                            echo "</html>";
                                        ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Location:</label>
                                            <input class="form-control" placeholder="Location" name="location">
                                        </div>
                                        <div class="form-group">
                                            <label>Time of Tutorial:</label>
                                            <select class="form-control" name="timeoftutorial">
                                                <option>9-10am</option>
                                                <option>10-11am</option>
                                                <option>11-12pm</option>
                                                <option>12-1pm</option>
                                                <option>1-2pm</option>
                                                <option>2-3pm</option>
                                                <option>3-4pm</option>
                                                <option>4-5pm</option>
                                                <option>5-6pm</option>
                                                <option>6-7pm</option>
                                                <option>7-8pm</option>
                                                <option>8-9pm</option>
                                                <option>9-10pm</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Group:</label>
                                            <select class="form-control" name="groupletter">
                                                <option>A</option>
                                                <option>B</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Actual Hours Worked:</label>
                                            <select class="form-control" name="hoursworked">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-default" name="loghours">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
       
            </form>
<!-- https://www.w3schools.com/sql/sql_insert.asp -->            
   <?php
$servername = "localhost";
$username = "root";
$password = "albertroad";
$dbname = "fypdatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO logged_hours (STUDENT_ID, STUDENT_NAME, WEEK, DATE_OF_TUT, COURSE_CODE, LECTURER, LOCATION, TUT_TIME, GROUP_LETTER, TOTAL_HOURS)
VALUES ('$_POST[studentid]','$_POST[studentname]', '$_POST[week]', '$_POST[date]', '$_POST[coursecode]', '$_POST[lecturer]', '$_POST[location]', '$_POST[timeoftutorial]', '$_POST[groupletter]', '$_POST[hoursworked]');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
    </div>
    <!-- /#wrapper -->       
           

    </div>
    <!-- /#wrapper -->

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
