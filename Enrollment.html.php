<?php

include 'dbase.inc.php';
date_default_timezone_set('utc');

$sql = "SELECT Course_ID, Course_Name, Course_Provider,Course_Description, Course_fee, Venue, Commence_Date, Number_Of_Days, Start_Time, End_Time FROM Courses WHERE Deleted_Course = 0";
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

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="view1.css">
		<script src="script.js"></script>
	</head>
<body>	
		
	<div class="container2">
		<h1>Enroll on a Course</h1>
        <h3>Course details</h3>
		<br>
        <br>
        <form name="myform" action="Enrollment.php" method="post">
            <label for="courseid">Course ID</label>
            <input type="text" name="courseid" id="courseid" required disabled>
            <br>
            <br>
            <label for="coursename">Course Name</label>
            <input type="text" name="coursename" id="coursename" required disabled>
            <br>
            <br>
            <label for="courseProvider">Course Provider</label>
            <input type="text" name="courseProvider" id="courseProvider" required disabled>
            <br>
            <br>
            <label for="description">Course description</label>
            <textarea type="text" rows = "3" cols="85" name="description" id="description" required disabled></textarea>
            <br>
            <br>
            <label for="fee">Course Fee</label>
            <input type="text" name="fee" id="fee" step="0.01" min="0" placeholder="In euro" required disabled>
            <br>
            <br>
            <label for="venue">Venue</label>
            <input type="text" name="venue" id="venue"  required disabled>
            <br>
            <br>
            <label for="StartDate">Starting Date</label>
            <input type="date" name="StartDate" id="StartDate" required disabled>
            <br>
            <br>
            <label for="numDays">Number of Days</label>
            <input type="text" name="numDays" id="numDays" required disabled>
            <br>
            <br>
            <label for="startTime">Start Time</label>
            <input type="time" name="startTime" id="startTime"  required disabled>
            <br>
            <br>
            <label for="endTime">End Time</label>
            <input type="time" name="endTime" id="endTime" required disabled>
            <br>
            <br>
            <h3>Client Details</h3>
            <br>
            <br>
            <?php include 'clientList.php';?>
            <br>
            <br>
            <label for="cid">Clients ID</label>
            <input type="text" name="cid" id="cid" required disabled>
            <br>
            <br>
            <label for="cname">Clients Name</label>
            <input type="text" name="cname" id="cname"  required disabled>
            <br>
            <br>
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" required disabled>
            <br>
            <br>
            <label for="deposit">Fee Deposit</label>
            <input type="deposit" name="deposit" id="deposit" required disabled>
            <br>
            <br>
            <label for="ddate">Enrollment Date</label>
            <input type="date" name="ddate" id="ddate" value="" required disabled>
            <br>
            <br>
            <button type="submit" onclick="confirmation3(event)">Enroll Now</button>
        
        </form>
    </div>    
</body>

<script>
//accessing the parent and child tags
    var list = document.getElementById('list');
	var li = list.getElementsByTagName('li');
    //accessing each tag and placing an event listener with each tag
	for (var i = 0; i < li.length; i++) {
    	li[i].addEventListener('click',function() {
        	var sel = this.getAttribute('value').split(',');
            //populating each field with corresponding values
            document.getElementById('courseid').value = sel[0];
        	document.getElementById('coursename').value = sel[1];
            document.getElementById('courseProvider').value = sel[2];
            document.getElementById('description').value = sel[3];
            document.getElementById('fee').value = sel[4];
            document.getElementById('venue').value = sel[5];
            document.getElementById('StartDate').value = sel[6];
            document.getElementById('numDays').value = sel[7];   
            document.getElementById('startTime').value = sel[8];
            document.getElementById('endTime').value = sel[9];
    });
}


        // this function act as our search bar each time the user key in any word the method will trigger
        function match() {
            var inword = document.getElementById('search').value.toUpperCase();// it convert the users entered word to uppercase
            var ul = document.getElementById('list');//enters the parent tag
            var li = ul.getElementsByTagName('li');//access the child tag

            for (var i = 0; i < li.length; i++) {//take each li tag in the list
                var liword = li[i].textContent.toUpperCase();// convert the text content of the li to upper case

                if (liword.indexOf(inword) > -1) {// checks if the entered word present in the list
                    li[i].style.display = '';//display matching text
                } else {
                    li[i].style.display = 'none';
                }

            }
        }
        function populate2(){
        var sel = document.getElementById("listbox");
        var result;
        result = sel.options[sel.selectedIndex].value;
        var personDetails = result.split(',');
        document.getElementById("cid").value = personDetails[0];
        document.getElementById("cname").value = personDetails[1];
        document.getElementById("dob").value = personDetails[2]; 
        document.getElementById("ddate").value = personDetails[3]
        var fee = document.getElementById('fee').value;
        var deposit = (10.00/100.00)*fee;
        document.getElementById("deposit").value = deposit; 
    }
       


        // this method will confirm the user when he or she will press the submit button and if the press yes the button will enable all the fields
        // which is important to run the query
        function confirmation3(event){
			
		event.preventDefault();
        var response;
		response = confirm('are you sure you want to save all the changes');

        if(response){

            document.getElementById("courseid").disabled = false;
            document.getElementById("coursename").disabled = false;
            document.getElementById("courseProvider").disabled = false;
            document.getElementById('description').disabled = false;
            document.getElementById("fee").disabled = false;
            document.getElementById("venue").disabled = false;
            document.getElementById("StartDate").disabled = false;
            document.getElementById('numDays').disabled = false;
            document.getElementById('startTime').disabled = false;
            document.getElementById('endTime').disabled = false;
            document.getElementById("cid").disabled = false;
            document.getElementById("cname").disabled = false;
            document.getElementById("dob").disabled = false;
            document.getElementById("deposit").disabled = false; 
            document.getElementById("ddate").disabled = false; 
            document.myform.submit();
            
        }
        else{
          populate();
    }

}
</script>