<?php
include 'dbase.inc.php';
date_default_timezone_set('utc');

$id = $_POST['courseid'];

$sql = "UPDATE Courses SET Deleted_Course=1, Booking_Status='cancelled' WHERE Course_ID = '$id'";

echo "$sql";
if(!mysqli_query($con,$sql)){
    echo "connection error " . mysqli_error($con);
}
else{
    echo "The course has been deleted";
}
mysqli_close($con);

?>

<br>
<form action='deletedCourses.html.php'>
<input type='submit' value='back to previous page'>
</form>
