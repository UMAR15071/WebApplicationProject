<?php

echo '<link rel="stylesheet" href="view.css">';



include 'dbase.inc.php';
date_default_timezone_set('utc');

$sql = "SELECT Course_ID, Course_Name, Course_Provider,Course_Description, Course_fee, Venue, Commence_Date, Number_Of_Days, Start_Time, End_Time FROM Courses WHERE Deleted_Course = 0 AND Seats_Remaining < Total_Seats AND Seats_Remaining != 0";
$result = mysqli_query($con, $sql);

if(!mysqli_query($con, $sql)){
    echo "Connection error ".mysqli_error($con);
}
echo "<div class='container'>";
echo "<h2>View training courses</h2>";
echo "<input type ='search' name='search' id='search' onkeyup='match()' placeholder='search'>";
echo "<ul id='list' >";
while($row = mysqli_fetch_array($result)){
    $id = $row['Course_ID'];
    $coursename = $row['Course_Name'];
    $provider = $row['Course_Provider'];
    $description = $row['Course_Description'];
    $fee = $row['Course_fee'];
    $venue = $row['Venue'];
    $startDate = $row['Commence_Date'];
    $numDays = $row['Number_Of_Days'];
    $sTime = $row['Start_Time'];
    $eTime = $row['End_Time'];
    $sdate = date_create($startDate);
    $sdate = date_format($sdate,"Y-m-d");
    
    $allText = "'$id,$coursename,$provider,$description,$fee,$venue,$sdate,$numDays,$sTime,$eTime'";
    echo "<li value = $allText'> $coursename by  $provider </li>";
}
echo "</ul>";
echo "</div>";

mysqli_close($con);



?>