<?php

include 'dbase.inc.php';
date_default_timezone_set('utc');

$sql = "SELECT * FROM Courses ORDER BY Course_ID DESC LIMIT 1";// video https://www.youtube.com/watch?v=ndF-b902UnA
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

if(mysqli_num_rows($result) == 0){

        $newId = 1;
}
else{
        $newId = $row['Course_ID']+1;
}

$courseName = $_POST['coursename'];
$courseProvider = $_POST['courseProvider'];
$description = $_POST['description'];
$fee = $_POST['fee'];
$numDays = $_POST['numDays'];
$availableSeats = $_POST['availableSeats'];
$sDate = $_POST['StartDate'];
$venue = $_POST['venue'];
$sTime = $_POST['startTime'];
$eTime = $_POST['endTime'];


echo "The information you added is: <br>";


echo "Course ID:                ".$newId."<br>";
echo "Course name:              ".$courseName."<br>";
echo "Course Provider:          ".$courseProvider."<br>";
echo "COurse Description:       ".$description."<br>";
echo "Available seats:          ".$availableSeats."<br>";
echo "Fee:                      ".$fee."<br>";
echo "Venue:                    ".$venue."<br>";
echo "Start Date                ".$sDate."<br>";
echo "Number of Days:           ".$numDays."<br>";
echo "Start Time                ".$sTime."<br>";
echo "End Time                  ".$eTime."<br>";

$sDate = date_create($_POST['StartDate']);
$sDate = date_format($sDate,"Y-m-d");

echo "Start date:       ".$sDate;
 $sql = "INSERT INTO Courses (Course_ID, Course_Name, Course_Provider,Course_Description, Total_Seats,Seats_Remaining,Course_fee, Venue, Commence_Date,Number_Of_Days,Start_Time,End_Time )
        VALUES ('$newId','$courseName', '$courseProvider','$description' ,'$availableSeats','$availableSeats', '$fee', '$venue', '$sDate', '$numDays','$sTime', '$eTime')";

if(!mysqli_query($con,$sql)){
        echo "An error occured in sql query ".mysqli_error($con);
}                

echo "Record is added";

mysqli_close($con);

?>

<form action="trainingForm.html">
        <button type="Submit"> return </button>
</form>