<?php

include 'dbase.inc.php';
date_default_timezone_set('utc');

$courseid = $_POST['courseid'];
$clientid = $_POST['clientid'];
$date = date('Y/m/d');

$sql = "UPDATE Enrollment SET Cancelled_Enrollment=1 AND Date_of_Cancellation = '$date' WHERE Course_ID='$courseid' AND Client_ID='$clientid'";
$result = mysqli_query($con,$sql);
if(!$result){
    echo "connection error ".mysqli_error($con);
}
else{
    echo "Your Enrollment has been cancelled: <br>";
    echo "Cancelation date:     ".$date."<br>";
}

$sql2 = "SELECT Seats_Remaining FROM Courses";
$result2 = mysqli_query($con,$query2);
if(!$result2){
    echo "connection error ".mysqli_error($con);
}
else{

    $rseats = $result + 1;

    $sql3 = "UPDATE Courses SET Seats_Remaining= $rseats WHERE Course_ID=$courseid";

    echo "Courses table Updated: <br>";
    echo "Remaining Seats:     ".$rseats."<br>";
}

$sql4 = "SELECT Number_of_Courses_Assigned FROM Clients WHERE Client_ID=$clientid";
$result3 = mysqli_query($con,$sql4);
if(!$result3){
    echo "Connection error ".mysqli_error($con,$sql4);
}
else{
    $noOfCourses = $result4-1;

    $sql5 = "UPDATE Clients SET Number_of_Courses_Assigned WHERE Client_ID=$clientid";
}

?>