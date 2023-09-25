
<!DOCTYPE html>
<html>
	<head>
        <?php include 'courselist.php'?>
		<link rel="stylesheet" href="view1.css">
		<script src="script.js"></script>
	</head>
<body>	
	<div class="container2">
		<h1>Amend/View Details</h1>
        <br>
        <br>
		<input type="button" value="Edit Details" id="editBtn" name="editBtn" onclick="toggleLock()" >
        <br>
        <br>
        <form name="editForm" action="save.php" method="post">
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
        <input type="date" name="StartDate" id="StartDate" onblur="dateCheck()" required disabled>
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
        <input type="time" name="endTime" id="endTime" onblur="timeDiff()" required disabled>
        <br>
        <br>
        <button type="Submit" onclick="confirmation2(event)">Submit!</button>

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
            document.getElementById('editBtn').disabled = false;
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

        		// when the user will press the Edit details button this function will enable all the editable fields for the user and change the button tag to View Details
        // when the user will press view details the the enabled fields will be disabled again
        function toggleLock(){

        if(document.getElementById("editBtn").value == "Edit Details"){
            document.getElementById("fee").disabled = false;
            document.getElementById("venue").disabled = false;
            document.getElementById("StartDate").disabled = false;
            document.getElementById('numDays').disabled = false;
            document.getElementById('startTime').disabled = false;
            document.getElementById('endTime').disabled = false;
            document.getElementById("editBtn").value = "View Details";
            
        }
        else{
            
            document.getElementById("fee").disabled = true;
            document.getElementById("venue").disabled = true;
            document.getElementById("StartDate").disabled = true;
            document.getElementById('numDays').disabled = true;
            document.getElementById('startTime').disabled = true;
            document.getElementById('endTime').disabled = true;
            document.getElementById('editBtn').value = "Edit Details";

            
        }

        }


        // this method will confirm the user when he or she will press the submit button and if the press yes the button will enable all the fields
        // which is important to run the query
        function confirmation2(event){
			
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
            document.editForm.submit();
            
        }
        else{
            toggleLock();
    }

}


</script>