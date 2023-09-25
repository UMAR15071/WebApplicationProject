  // this function will confirm the user when he/she will hit submit

  function confirmation(event){
    document.preventDefault(event);
    var response = confirm('are you sure you want to add this training course to your database');
     if(response){
        document.getElementById('remainingSeats').disabled = false;
        document.trainingForm.submit();
     }
     
 }



 // this function will check if the user has entered today's date
 function dateCheck(){
     var inputDate = new Date(document.getElementById('StartDate').value);
     var todayDate = new Date();

     todayDate.setHours(0,0,0,0);

     if(inputDate.getTime() <= todayDate.getTime()){
         alert('You can not enter today date or any date before today');
         document.getElementById('StartDate').value = '';
         document.getElementById('StartDate').focus();
     }

 }
 // this function will check invalid time
 function timeDiff(){

     //new Date(dateString) syntax of date constructor

         var time = document.getElementById('startTime').value;
         var time2 = document.getElementById('endTime').value;
         var date = "Fri Mar 17 2023";

         var str = date +" "+ time;// As to create a date object we need string thatswhy we will contcatenate the variables to string.
         var a = new Date(str);
         console.log(a);
         var str2 = date +" "+ time2; // both a and b contain same date but different time
         var b = new Date(str2);
         if(b-a <= 0){// the difference between both times will be in milisecounds if end time is greater than or equal to start time the condition will be false
             alert("invalid time");
             document.getElementById('endTime').value = "";
             var time2 = document.getElementById('endTime').value;
         }
     }
function numCheck(){

var num = document.getElementById('fee').value;
if(num < 0){
    alert ("invalid amount");
    document.getElementById('fee').value = "";
}

}

function numcheck2(){
    var num = document.getElementById('numDays').value;
    if(num < 0){
        alert("invalid number");
        document.getElementById('numDays').value='';
    }
}
        
function seats(){
    var numSeats = document.getElementById('availableSeats').value;
    if(numSeats <= 0){
        alert ("invalid number");
        document.getElementById('availableSeats').value = '';
    }
    else{
        document.getElementById('remainingSeats').value = numSeats;
    }
}



