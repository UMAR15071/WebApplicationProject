
<?php

include 'dbase.inc.php';
date_default_timezone_set('utc');

$sql = "SELECT Course_ID, Course_Name, Course_Provider,Seats_Available, Seats_Remaining, Fee, Venue, Commence_Date, End_Date FROM Courses";
$result = mysqli_query($con, $sql);

if(!mysqli_query($con, $sql)){
    echo "Connection error ".mysqli_error($con);
}
echo "<div class='container'>";
echo "<h2>View training courses</h2>";
echo "<input type ='search' name='search' id='search' onkeyup='match()' placeholder='search'>";
echo "<ul id='list' >";
while($row = mysqli_fetch_array($result)){
    $courseid = $row['Course_ID'];
    $coursename = $row['Course_Name'];
    $provider = $row['Course_Provider'];
    $availableSeats = $row['Seats_Available'];
    $remainingSeats = $row['Seats_Remaining'];
    $fee = $row['Fee'];
    $venue = $row['Venue'];
    $startDate = $row['Commence_Date'];
    $sdate = date_create($startDate);
    $sdate = date_format($sdate, "Y/m/d");
    $endDate = $row['End_Date'];
    $edate = date_create($endDate);
    $edate = date_format($edate, "Y/m/d");
    $allText = "'$courseid, $coursename, $provider, $availableSeats, $remainingSeats, $fee, $venue, $sdate, $edate'";
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
	</head>
	
	<div class="container2">
        <form action="save.php" method="post">
            <h1>Ammend View Details</h1>
            <br>
            <br>
			<input type = "button" id="editBtn" value="Edit Details" onclick="toggleLock()">
			<br>
			<br>
            <label for="coursename">Course ID</label>
            <input type = "text" id="courseid" name="courseid" required disabled>
			<br>
			<br>
            <label for="coursename">Course Name</label>
            <input type="text" name="coursename" id="coursename" required disabled>
            <br>
            
            <label for="courseProvider">Course Provider</label>
            <input type="text" name="courseProvider" id="courseProvider" required disabled>
            <br>
            
            <label for="avalaibleSeats">Total seats</label>
            <input type="text" name="availableSeats" id="availableSeats" onblur="check()"  required disabled>
            <br>
			
			<br>
            
            <label for="ramianingSeats">Remaining Seats</label>
            <input type="text" name="remainingSeats" id="remainingSeats"  required disabled>
            <br>
            
            <label for="fee">Course Fee</label>
            <input type="text" name="fee" id="fee" step="0.01" min="0" placeholder="In euro" required disabled>
            <br>
            
            <label for="venue">Venue</label>
            <input type="text" name="venue" id="venue"  required disabled>
            <br>
        
            <label for="StartDate">Starting Date</label>
            <input type="text" name="StartDate" id="StartDate" required disabled>
            <br>
            
            <label for="EndDate">End Date</label>
            <input type="text" name="EndDate" id="EndDate" required disabled>
            <br>
            
            <button type="Submit" onclick="confirmation()">Submit!</button>

        </form>
    </div>    

</html>

<script>

   
    
	
    var list = document.getElementById('list');
	var li = list.getElementsByTagName('li');

	for (var i = 0; i < li.length; i++) {
    	li[i].addEventListener('click', function() {
        	var sel = this.getAttribute('value').split(',');
            document.getElementById('courseid').value = sel[0];
        	document.getElementById('coursename').value = sel[1];
            document.getElementById('courseProvider').value = sel[2];
            document.getElementById('availableSeats').value = sel[3];
            document.getElementById('remainingSeats').value = sel[4];
            document.getElementById('fee').value = sel[5];
            document.getElementById('venue').value = sel[6];
            document.getElementById('StartDate').value = sel[7];
            document.getElementById('EndDate').value = sel[8];
            document.getElementById('editBtn').disabled = false;
    });
}



        function match() {
            var inword = document.getElementById('search').value.toUpperCase();
            var ul = document.getElementById('list');
			console.log(ul);
            var li = ul.getElementsByTagName('li');

            for (var i = 0; i < li.length; i++) {
                var liword = li[i].textContent.toUpperCase();

                if (liword.indexOf(inword) > -1) {
                    li[i].style.display = '';
                } else {
                    li[i].style.display = 'none';
                }

            }
        }

        
		
        function toggleLock(){

            if(document.getElementById("editBtn").value == "Edit Details"){
               
                document.getElementById("coursename").disabled = false;
                document.getElementById("courseProvider").disabled = false;
                document.getElementById("availableSeats").disabled = false;
                document.getElementById("remainingSeats").disabled = false;
                document.getElementById("fee").disabled = false;
                document.getElementById("venue").disabled = false;
                document.getElementById("StartDate").disabled = false;
                document.getElementById("EndDate").disabled = false;
                document.getElementById("editBtn").value = "View Details";
				
				num1 = parseInt(document.getElementById("availableSeats").value); 
                
            }
            else{
                
                document.getElementById("coursename").disabled = true;
                document.getElementById("courseProvider").disabled = true;
                document.getElementById("availableSeats").disabled = true;
                document.getElementById("remainingSeats").disabled = true;
                document.getElementById("fee").disabled = true;
                document.getElementById("venue").disabled = true;
                document.getElementById("StartDate").disabled = true;
                document.getElementById("EndDate").disabled = true;
                document.getElementById('editBtn').value = "Edit Details";

                
            }

        }
	
	

        function confirmation(){
           var response = confirm('are you sure you want to add this training course to your database');

            if(response){

                document.getElementById("courseid").disabled = false;
                document.getElementById("coursename").disabled = false;
                document.getElementById("courseProvider").disabled = false;
                document.getElementById("availableSeats").disabled = false;
                document.getElementById("remainingSeats").disabled = false;
                document.getElementById("fee").disabled = false;
                document.getElementById("venue").disabled = false;
                document.getElementById("StartDate").disabled = false;
                document.getElementById("EndDate").disabled = false;

                
            }
            else{
                populate();
                toggleLock();
            }
            
        }

        function check(){
			var num2 = parseInt(document.getElementById("availableSeats").value);
            var num3 = parseInt(document.getElementById("remainingSeats").value);
            var result = num2 - num1;
			console.log(result);
            if(result > 0){
                var result2 = num3 + result;
                document.getElementById("remainingSeats").value = result2;
            }
        }
	
		var num1 = parseInt(document.getElementById("availableSeats").value); 
		
</script>