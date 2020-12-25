function startTime() {
    var date = new Date();

    var hours = date.getHours() > 12 ? date.getHours() - 12 : date.getHours();
    var am_pm = date.getHours() >= 12 ? "PM" : "AM";
    hours = hours < 10 ? "0" + hours : hours;

    var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();

    time = hours + ":" + minutes + ":" + seconds + " " + am_pm;

    var monthDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
    var month = (date.getMonth()+1) < 10 ? "0" + date.getMonth()+1 : date.getMonth()+1;
    var fullYear = date.getFullYear();

    formattedTime = month+"/"+monthDate+"/"+fullYear+" "+time;

    azanChecker(formattedTime);

    document.getElementById('txt').innerHTML = time;
    var t = setTimeout(startTime, 500);
}

function azanChecker(formattedTime){
    var flagTime = false;
    $($(".azan-checker").get().reverse()).each(function(){
         var azanTime = $(this).attr("data-time");
         var azanTitle = $(this).attr("data-azan");

         var currentDT = new Date(formattedTime);
         var azanDT = new Date(azanTime);
         if(currentDT.getTime()>=azanDT.getTime() && !flagTime){
            $(this).parent().addClass("vibrate-1");
            flagTime = true;
         }else{
            $(this).parent().removeClass("vibrate-1");

         }

    });
}
