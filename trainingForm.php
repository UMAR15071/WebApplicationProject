<!DOCTYPE html>
<head>
    <title>Add a training Course</title>
    
    <link rel="stylesheet" href="view1.css">

    <Script src="script.js"></Script>
    
</head>

<body>
    <div class="container">
        <br>
        <?php include 'menu.php';?>
        <br>
    </div>
    <form class="container2" action="insertcourse.php" method="POST" name="trainingForm">
        <h1>Add a Training Course</h1>
        <br>
        <br>
        <label for="coursename">Course Name</label>
        <input type="text" name="coursename" id="coursename" required autocomplete="off">
        <br>
        <br>
        <label for="courseProvider">Course Provider</label>
        <input type="text" name="courseProvider" id="courseProvider" required autocomplete="off">
        <br>
        <br>
        <label for="description">Course description</label>
        <textarea type="text" rows = "3" cols="85" name="description" id="description" required autocomplete="off"></textarea>
        <br>
        <br>
        <label for="avalaibleSeats">Total seats</label>
        <input type="number" name="availableSeats" id="availableSeats" onblur="seats()" required autocomplete="off">
        <br>
        <br>
        <label for="remainingSeats">Remaining seats</label>
        <input type="number" name="remainingSeats" id="remainingSeats"  required autocomplete="off" disabled>
        <br>
        <br>
        <label for="fee">Course Fee</label>
        <input type="number" name="fee" id="fee" step="0.01" min="0" placeholder="In euro" onblur="numCheck()" required autocomplete="off">
        <br>
        <br>
        <label for="venue">Venue</label>
        <input type="text" name="venue" id="venue"  required autocomplete="off">
        <br>
        <br>
        <label for="StartDate">Starting Date</label>
        <input type="date" name="StartDate" id="StartDate" onblur="dateCheck()" required autocomplete="off">
        <br>
        <br>
        <label for="numDays">Number of Days</label>
        <input type="number" name="numDays" id="numDays" onblur="numcheck2()" required autocomplete="off">
        <br>
        <br>
        <label for="startTime">Start Time</label>
        <input type="time" name="startTime" id="startTime"  required autocomplete="off">
        <br>
        <br>
        <label for="endTime">End Time</label>
        <input type="Time" name="endTime" id="endTime" onblur="timeDiff()" required autocomplete="off">
        <br>
        <br>
        <button type="Submit" onclick="confirmation(event)">Submit!</button>

    </form>
</body>