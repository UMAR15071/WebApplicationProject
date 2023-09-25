<?php
include 'dbase.inc.php';
date_default_timezone_set('utc');

// accessing enrollment table to set the id
$sql = "SELECT * FROM Enrollment ORDER BY Enrollment_ID DESC LIMIT 1";
$result = mysqli_query($con, $sql);

if (!$result) {
    echo "An error occurred in SQL query " . mysqli_error($con);
    exit;
}

$row = mysqli_fetch_array($result);

if (mysqli_num_rows($result) == 0) {
    $newId = 1;
} else {
    $newId = $row['Enrollment_ID'] + 1;
}

$clientid = $_POST['cid'];
$courseid = $_POST['courseid'];
$damount = $_POST['deposit'];
$edate = $_POST['ddate'];

// accessing courses table
$sql1 = "SELECT * FROM Courses WHERE Course_ID='$courseid'";
$result1 = mysqli_query($con, $sql1);

if (!$result1) {
    echo "An error occurred in SQL query " . mysqli_error($con);
    exit;
}

$row1 = mysqli_fetch_array($result1);

if ($row1['Seats_Remaining'] > 0) {
    $remainingSeats = $row1['Seats_Remaining'] - 1;
    $sql2 = "UPDATE Courses SET Seats_Remaining='$remainingSeats' WHERE Course_ID='$courseid'";

    if (!mysqli_query($con, $sql2)) {
        echo "An error occurred in SQL query " . mysqli_error($con);
        exit;
    }

    // inserting into Enrollment table
    $sql3 = "INSERT INTO Enrollment (Enrollment_ID, Client_ID, Course_ID, Deposit_Amount, Date_of_Enrolment)
            VALUES ('$newId','$clientid','$courseid','$damount','$edate')";

    if (!mysqli_query($con, $sql3)) {
        echo "An error occurred in SQL query " . mysqli_error($con);
        exit;
    }

    echo "The following record has been added:<br>";
    echo "Enrollment ID: " . $newId . "<br>";
    echo "Client ID: " . $clientid . "<br>";
    echo "Course ID: " . $courseid . "<br>";
    echo "Deposit Amount: " . $damount . "<br>";
    echo "Enrollment Date: " . $edate . "<br>";

    // accessing clients table
    $sql4 = "SELECT * FROM Clients WHERE Client_ID='$clientid'";
    $result4 = mysqli_query($con, $sql4);

    if (!$result4) {
        echo "An error occurred in SQL query " . mysqli_error($con);
        exit;
    }

    $row4 = mysqli_fetch_array($result4);
    $numCourses = $row4['Number_of_Courses_Assigned'] + 1;

    $sql5 = "UPDATE Clients SET Number_of_Courses_Assigned='$numCourses' WHERE Client_ID='$clientid'";

    if (!mysqli_query($con, $sql5)) {
        echo "An error occurred in SQL query " . mysqli_error($con);
        exit;
    }

    echo "Number of courses updated <br>";
} else {
    echo "There are no more available seats.";
}

mysqli_close($con);
?>

<form action="Enrollment.html.php">
    <button type="submit">Return</button>
</form>
