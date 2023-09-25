<?php
include 'dbase.inc.php';
date_default_timezone_set('utc');

$id = $_POST['courseid'];
$fee = $_POST['fee'];
$venue = $_POST['venue'];
$numDays = $_POST['numDays'];
$sDate = date_create($_POST['StartDate']);
$sDate = date_format($sDate,"Y-m-d");
$sTime = $_POST['startTime'];
$eTime = $_POST['endTime'];

$sql = "UPDATE Courses SET Course_fee = '$fee', Venue='$venue', Commence_Date = '$sDate', Number_Of_Days = '$numDays', Start_Time = '$sTime', End_Time = '$eTime' WHERE Course_ID = '$id'";
echo "$sql";
if(!mysqli_query($con,$sql)){
    echo "connection error " . mysqli_error($con);
}
else{
    echo "Table updated";
}
mysqli_close($con);

?>

<br>
<form action='ViewCourses.php'>
<input type='submit' value='back to previous page'>
</form>
