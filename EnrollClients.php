<!DOCTYPE html>
<body>

<link rel='stylesheet' href='view1.css'>
    <h1>Cancel Enrollment</h1>

    <div class="container">

        <?php include 'menu.php'; ?>

    </div>

    <div class="container2">
        <form name="client" action="EnrolledCourses.php" method="post">
            <h3>Client Details</h3>
            <br>
            <br>
            <?php

                include 'dbase.inc.php';
                date_default_timezone_set('utc');

                

                $sql = "SELECT * FROM Clients WHERE Deleted_Client=0";

                if(!mysqli_query($con,$sql)){
                    echo "Connection error ".mysqli_error($con);
                }
                else{

                    echo "<select name='listbox' id='listbox' onclick='populate3()'>";

                    $result = mysqli_query($con,$sql);
                    
                    while($row = mysqli_fetch_array($result)){
                        $cid = $row['Client_ID'];
                        $name = $row['Client_Name'];
                        $dob = $row['DOB'];
                        $bdate = date_create($dob);
                        $bdate = date_format($bdate,"Y-m-d");
                        $cdate = date('Y-m-d');
                        $alltext2 = "$cid,$name,$bdate";
                        echo "<option value='$alltext2'> $name      $bdate </option>"; 
                    }  
                    echo "</select>";   
                }   
            ?>
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
            
            <button type="submit" onclick="confirm(event)">submit</button>
        
        </form>
    </div>
</body>


<script>

function populate3(){
        var sel = document.getElementById("listbox");
        var result;
        result = sel.options[sel.selectedIndex].value;
        var personDetails = result.split(',');
        document.getElementById("cid").value = personDetails[0];
        document.getElementById("cname").value = personDetails[1];
        document.getElementById("dob").value = personDetails[2]; 
        
    }
       
    function confirm(event){
       
            document.getElementById("cid").disabled = false;
            document.getElementById("cname").disabled = false;
            document.getElementById("dob").disabled = false; 
        
    }

</script>