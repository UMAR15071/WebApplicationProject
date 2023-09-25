/*  Name:       Syed Muhammad Umar
    Date:       15/03/2023
    Purpose:    */


<?php
// include the database connection file
include 'dbase.inc.php';
// set the timezone to UTC
date_default_timezone_set('utc');
// link to the CSS stylesheet for this view
echo "<link rel='stylesheet' href='view1.css'>";

// SQL query to select all clients that have not been deleted
$sql = "SELECT * FROM Clients WHERE Deleted_Client=0";

// check if the query was successful
if(!mysqli_query($con,$sql)){
    // if there was an error, display an error message
    echo "Connection error ".mysqli_error($con);
}
else{
    // if the query was successful, display a drop-down list of clients
    echo "<select name='listbox' id='listbox' onclick='populate2()'>";
    // execute the query and store the results in $result
    $result = mysqli_query($con,$sql);
    // loop through each row in $result
    while($row = mysqli_fetch_array($result)){
        // get the client's ID, name, date of birth, and the current date
        $cid = $row['Client_ID'];
        $name = $row['Client_Name'];
        $dob = $row['DOB'];
        $bdate = date_create($dob);
        $bdate = date_format($bdate,"Y-m-d");
        $cdate = date('Y-m-d');
        // combine the client's information into a single string for use as the option value
        $alltext2 = "$cid,$name,$bdate,$cdate";
        // display the client's name and date of birth as the option label, with the combined information as the option value
        echo "<option value='$alltext2'> $name      $bdate </option>"; 
    }  
    // close the select tag
    echo "</select>";   
}   
?>