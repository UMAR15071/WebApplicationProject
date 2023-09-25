<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div class="container2">
        <form name="course" action="deleteEnrollment.php" method="post">
            <?php
                include 'dbase.inc.php';
                date_default_timezone_set('utc');

                $cid = $_POST['cid'];

                $sql2 = "SELECT * FROM Enrollment WHERE Client_ID='$cid'";
                $result2 = mysqli_query($con, $sql2);

                if(!$result2){
                    echo "Connection error ".mysqli_error($con);
                }
                else{

                    echo "<select name='coursebox' id='coursebox' onclick='populate4()'>";

                    while($row = mysqli_fetch_array($result2)){
                        $courseid = $row['Course_ID'];
                       	$sql3 = "SELECT Course_Name, Course_Provider, Course_Description FROM Courses WHERE Course_ID = '$courseid'";
						$result3 = mysqli_query($con, $sql3);

                        $row3 = mysqli_fetch_array($result3);

                        $coursename = $row3['Course_Name'];
                        $provider = $row3['Course_Provider'];
                        $description = $row3['Course_Description'];
                        $allText2 = "$courseid,$coursename,$provider,$description,$cid";
                        echo "<option value='$allText2'> $coursename by $provider </option>";
                    }
                    echo "</select>";
                }

            ?>
            <br>
            <br>
            <label for="courseid">Course ID</label>
            <input type="text" name="clientid" id="clientid" required disabled>
            <br>
            <br>
            <label for="courseid">Course ID</label>
            <input type="text" name="courseid" id="courseid" required disabled>
            <br>
            <br>
            <label for="coursename">Course Name</label>
            <input type="text" name="coursename" id="coursename" required disabled>
            <br>
            <br>
            <label for="provider">provider Name</label>
            <input type="text" name="provider" id="provider" required disabled>
            <br>
            <br>
            <label for="description">Description</label>
            <textarea rows="3" cols="85" name="description" id="description" required disabled></textarea>
            <br>
            <br>
            
            <button type="submit">Delete</button>
        </form>
    </div>
</body>

<script>
    function populate4(){
    var sel = document.getElementById("coursebox");
    var result = sel.options[sel.selectedIndex].value;
    var clientDetails = result.split(',');
    console.log(result);
    document.getElementById("courseid").value = clientDetails[0];
    document.getElementById("coursename").value = clientDetails[1];
    document.getElementById("provider").value = clientDetails[2];
    document.getElementById("description").value = clientDetails[3];
    document.getElementById("clientid").value = clientDetails[4];
}

function confirm(event){
    event.preventDefault();
    var response = confirm('Are you sure you want to delete this record');
    if(response){
        document.getElementById("courseid").disabled = false;
        document.getElementById("coursename").disabled = false;
        document.getElementById("provider").disabled = false;
        document.getElementById("description").disabled = false;
        document.getElementById("clientid").disabled = false; 
        document.course.submit();
    }
    else{
        populate4();
    }
}

</script>

</html>
