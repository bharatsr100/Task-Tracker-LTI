$(document).ready(function() {
  $('.close2').on('click',function(){
  load();
  });

  $('.close1').on('click',function(){
  load();
});
function isLeapYear(year) {
     return year % 400 === 0 || (year % 100 !== 0 && year % 4 === 0);
}
function days_of_a_year(year)
{

  return isLeapYear(year) ? 366 : 365;
}
var nav = 0;
const calendar = document.getElementById('calendar');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'];
function load() {
  // console.log("nav="+nav);
  const dt = new Date();
  // console.log(dt);
  if (nav !== 0) {
    dt.setFullYear(new Date().getFullYear() + nav);
  }
  const month = dt.getMonth();
  // console.log("month="+month);
  const year = dt.getFullYear();
  // console.log("year="+year);
  var no_of_days= days_of_a_year(year);
  // console.log("no_of_days="+no_of_days);
  const firstDayOfMonth = new Date(year, month, 1);

  const firstDayOfYear = new Date(year, 0, 1);
  // console.log(firstDayOfYear);



  const lastDayOfYear = new Date(year, 11, 31);
  // console.log(lastDayOfYear);

  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    month: 'long',
    year: 'numeric',

  });
  const firstdayweekday = firstDayOfYear.toLocaleDateString('en-us', {
    weekday: 'long',


  });
  const lastdayweekday = lastDayOfYear.toLocaleDateString('en-us', {
    weekday: 'long',


  });
  // console.log(firstdayweekday);
  // console.log(lastdayweekday);

  var days_week1= 7- weekdays.indexOf(firstdayweekday);
  var days_week2= weekdays.indexOf(lastdayweekday)+1;
  var remaining_days= no_of_days-days_week1-days_week2;
  var full_weeks= remaining_days/7;
  var total_weeks= full_weeks+2;

  // console.log(days_week1);
  // console.log(days_week2);
  // console.log(remaining_days);
  // console.log(full_weeks);
  // console.log(total_weeks);


  document.getElementById('yearDisplay').innerText =
    `${year}`;
    calendar.innerHTML = '';

    var currentdate= new Date();
    // console.log(currentdate);

    var startday= firstDayOfYear;
    startday.setDate(startday.getDate() -1);


    for(let i = 0; i < total_weeks; i++) {
      const monthSquare = document.createElement('div');
      monthSquare.classList.add('month');
      monthSquare.innerText = "Week "+(i+1);

      var number_of_day_inweek;
      if(i==0) number_of_day_inweek=days_week1;
      else if(i==total_weeks-1) number_of_day_inweek=days_week2;
      else number_of_day_inweek=7;
      var days=number_of_day_inweek;



      startday.setDate(startday.getDate() +1);
      var weekstart= new Date (startday);

      startday.setDate(startday.getDate() + (days-1));
      var weekend= new Date (startday);




      // console.log(weekstart);
      // console.log(weekend);

      var day1 = weekstart.getDate();
      var month1 = weekstart.getMonth();
      month1=`${month1 + 1}`;
      var year1 = weekstart.getFullYear();
      if(parseInt(day1)<10 && parseInt(day1)>=0){
        day1= "0"+day1;
      }
      if(parseInt(month1)<"10"){
        month1="0"+month1;
      }
      const weekstart_date = `${year1}-${month1}-${day1}`;

      var day2 = weekend.getDate();
      var month2 = weekend.getMonth();
      month2=`${month2 + 1}`;
      var year2 = weekend.getFullYear();

      if(parseInt(day2)<10 && parseInt(day2)>=0){
        day2= "0"+day2;
      }
      if(parseInt(month2)<"10"){
        month2="0"+month2;
      }
      const weekend_date = `${year2}-${month2}-${day2}`;

      // console.log("Week "+(i+1));
      // console.log(number_of_day_inweek);
      // console.log(weekstart_date);
      // console.log(weekend_date);



      if ((currentdate.getTime() >= weekstart.getTime()) &&(currentdate.getTime() <= weekend.getTime() )  ) {
        monthSquare.id = 'currentMonth';
      }
      var uguid=sessionStorage.getItem("member_uguid");
      var type= "22";
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              date: weekend_date,
              date2: weekstart_date,
              uguid:uguid

            },
        cache: false,
        success: function(dataResult){
          // console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          // console.log("Result for Week"+ (i+1) );
          // console.log(weekstart_date);
          // console.log(weekend_date);
          // console.log(dataResult);
           // console.log("Result loaded");
           var reslength= dataResult[0].length;
           var safeprogress= dataResult[1].length;
           var alertprogress= dataResult[2].length;
           var dangerprogress= dataResult[3].length;
           var alltasks= dataResult[4].length;
           var vacations= dataResult[5].length;

           if(reslength){
             var eventDiv = document.createElement('div');
             eventDiv.addEventListener("click", function() {
                 $('#showstage1tasks').modal('show');

                 event.stopPropagation();
                 $("#stage1title").html("");
                 $("#stage1list").html("");
                 $("#stage1title").append("To be Planned Tasks Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $(dataResult[0]).each(function (index, item) {
                   $("#stage1list").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"+item.tstepdescription +"</li>");

                 });

             });
             eventDiv.classList.add('eventstage1');
             eventDiv.innerText = reslength;
             monthSquare.appendChild(eventDiv);


           }
           if(safeprogress){
             var eventDiv1 = document.createElement('div');
             eventDiv1.addEventListener("click", function() {
                 $('#showssafetasks').modal('show');
                 event.stopPropagation();
                 $("#safetitle").html("");
                 $("#safelist").html("");
                 $("#safetitle").append("Tasks under control Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $(dataResult[1]).each(function (index, item) {
                   $("#safelist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv1.classList.add('eventprogress');

             eventDiv1.innerText = safeprogress;
             monthSquare.appendChild(eventDiv1);


           }
           if(alertprogress){
             var eventDiv2 = document.createElement('div');
             eventDiv2.addEventListener("click", function() {
                 $('#showsdeadlineapptasks').modal('show');
                 event.stopPropagation();
                 $("#deadlineapptitle").html("");
                 $("#deadlineapplist").html("");
                 $("#deadlineapptitle").append("Deadline Approaching Tasks Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $(dataResult[2]).each(function (index, item) {
                   $("#deadlineapplist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv2.classList.add('alertprogress');

             eventDiv2.innerText = alertprogress;
             monthSquare.appendChild(eventDiv2);


           }
           if(dangerprogress){
             var eventDiv3 = document.createElement('div');
             eventDiv3.addEventListener("click", function() {
                 $('#showsdeadlinepasstasks').modal('show');
                 event.stopPropagation();
                 $("#deadlinepasstitle").html("");
                 $("#deadlinepasslist").html("");
                 $("#deadlinepasstitle").append("Deadline Passed Tasks Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $(dataResult[3]).each(function (index, item) {
                   $("#deadlinepasslist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv3.classList.add('dangerprogress');

             eventDiv3.innerText = dangerprogress;
             monthSquare.appendChild(eventDiv3);


           }

           if(alltasks){
             var eventDiv4 = document.createElement('div');
             eventDiv4.addEventListener("click", function() {
                 $('#showalltasks').modal('show');
                 event.stopPropagation();
                 $("#alltaskstitle").html("");
                 $("#alltaskslist").html("");
                 $("#alltaskstitle").append("All Tasks Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $(dataResult[4]).each(function (index, item) {
                   $("#alltaskslist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv4.classList.add('alltasksstyle');

             eventDiv4.innerText = alltasks;
             monthSquare.appendChild(eventDiv4);


           }
           if(vacations){
             var eventDiv5 = document.createElement('div');
             eventDiv5.addEventListener("click", function() {
               $('#remarksmodal').modal({backdrop: 'static', keyboard: false}) ;
                 event.stopPropagation();
                $("#remarkstitle").html("");
                $("#remarkslist").html("");
                $("#cerror").hide();
                $("#csuccess").hide();



                 $("#remarkstitle").append(" Vacation Plan for Week "+(i+1)+" ("+ weekstart_date+" - "+weekend_date +")");

                 $("#tbody_team_vacation").empty();
                 var table2 = document.getElementById("tbody_team_vacation");
                 $(dataResult[5]).each(function (index, item) {
                   row2 = table2.insertRow(table2.rows.length);
                   row2.className = "row_vacation_table";

                   var i=0;
                   var newcell = row2.insertCell(i);
                   newcell.innerHTML =item.vguid;
                   newcell.className = "vguid_vacation_table";

                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.createdfor;
                   newcell.className = "createdfor_vacation_table";


                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.createdfor;


                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.vstart;


                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.vend;



                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.action;
                   });


            });
             eventDiv5.classList.add('vacationsstyle');
             eventDiv5.innerText = vacations;
             monthSquare.appendChild(eventDiv5);


           }






         }
         });





        calendar.appendChild(monthSquare);
    }

}
function initButtons() {
  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });
  document.getElementById('todayButton').addEventListener('click', () => {
    nav=0;
    load();
  });

  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });

}
initButtons();
load();
});
