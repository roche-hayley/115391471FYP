<!-- http://codewithawa.com/posts/complete-user-registration-system-using-php-and-mysql-database -->
<?php

// initializing variables
$errors = array(); 
$LogID = "";
$StudentID = "";
$Name = "";
$WeekofTutorial = "";
$DateofTutorial = "";
$CourseCode = "";
$Lecturer = "";
$Location = "";
$TimeofTutorial = "";
$TotalHours = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', 'albertroad', 'fypdatabase');

// log the tutors hours
if (isset(POST['loghours'])) {
  // receive all input values from the form
  $LogID = mysqli_real_escape_int($db, POST['logid']);
  $StudentID = mysqli_real_escape_int($db, POST['studentid']);
  $Name = mysqli_real_escape_string($db, POST['studentname']);
  $WeekofTutorial = mysqli_real_escape_date($db, POST['week']);
  $DateofTutorial = mysqli_real_escape_string($db, POST['date']);
  $CourseCode = mysqli_real_escape_string($db, POST['course']);
  $Lecturer = mysqli_real_escape_string($db, POST['lecturer']);
  $Location = mysqli_real_escape_string($db, POST['location']);
  $TimeofTutorial = mysqli_real_escape_string($db, POST['timeoftutorial']);
  $TotalHours = mysqli_real_escape_string($db, POST['hoursworked']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($StudentID)) { array_push($errors, "ID is required"); }
  if (empty($Name)) { array_push($errors, "Name is required"); }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) === 0) {

  	$query = "INSERT INTO logged_hours (LOG_ID, STUDENT_ID, STUDENT_NAME, WEEK, DATE_OF_TUT, COURSE_CODE, LECTURER, LOCATION, TUT_TIME, GROUP_LETTER, TOTAL_HOURS) 
  			  VALUES('$LogID', '$StudentID', '$Name', '$WeekofTutorial','$DateofTutorial','$CourseCode','$Lecturer','$Location','$TimeofTutorial','$TotalHours')";
  	mysqli_query($db, $query);
  }
?>