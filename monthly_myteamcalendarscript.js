$(document).ready(function() {
  $('.close2').on('click',function(){
  load();
  });

  $('.close1').on('click',function(){
  load();
});
var nav = 0;
const calendar = document.getElementById('calendar');
const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'];
function load() {
  // console.log("nav="+nav);
  const dt = new Date();
  // console.log("dt="+dt);
  if (nav !== 0) {
    dt.setFullYear(new Date().getFullYear() + nav);
  }
  const month = dt.getMonth();
  // console.log("month="+month);
  const year = dt.getFullYear();
  // console.log("year="+year);

  const firstDayOfMonth = new Date(year, month, 1);
  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    month: 'long',
    year: 'numeric',

  });
  // console.log(dateString);
  // console.log(month);

  document.getElementById('yearDisplay').innerText =
    `${year}`;
    calendar.innerHTML = '';

    for(let i = 0; i < 12; i++) {
      const monthSquare = document.createElement('div');
      monthSquare.classList.add('month');
      monthSquare.innerText = months[i];
      // const dayString = `${1}/${i+1}/${year}`;
      // console.log(dayString);

      const daysInMonth = new Date(year, i + 1, 0).getDate();
      // console.log(months[i]);
      // console.log(daysInMonth);

      var day2= "01";
      var month2=`${i + 1}`;
      if(parseInt(month2)<"10"){
        month2="0"+month2;
      }
      const dayString2 = `${year}-${month2}-${day2}`;
      // console.log(dayString2);
      const dayString3 = `${year}-${month2}-${daysInMonth}`;
      // console.log(dayString3);

      if (i  === month && nav === 0) {
        monthSquare.id = 'currentMonth';
      }

      var type= "23";
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              date: dayString3,
              date2: dayString2

            },
        cache: false,
        success: function(dataResult){
          // console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
           //  console.log("Result for "+ months[i]);
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
                 //$('#showstage1tasks').modal({backdrop: 'static', keyboard: false}) ;
                 event.stopPropagation();
                 $("#stage1title").html("");
                 $("#stage1list").html("");
                 $("#stage1title").append("To be Planned Tasks ("+ dayString2 +")");

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
                 $("#safetitle").append("Tasks under control ("+ dayString2 +")");

                 $(dataResult[1]).each(function (index, item) {
                   $("#safelist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv1.classList.add('eventprogress');
             //eventDiv1.className="eventprogress";
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
                 $("#deadlineapptitle").append("Deadline Approaching Tasks ("+ dayString2 +")");

                 $(dataResult[2]).each(function (index, item) {
                   $("#deadlineapplist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv2.classList.add('alertprogress');
             //eventDiv1.className="eventprogress";
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
                 $("#deadlinepasstitle").append("Deadline Passed Tasks ("+ dayString2 +")");

                 $(dataResult[3]).each(function (index, item) {
                   $("#deadlinepasslist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv3.classList.add('dangerprogress');
             //eventDiv1.className="eventprogress";
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
                 $("#alltaskstitle").append("All Tasks ("+ dayString2 +")");

                 $(dataResult[4]).each(function (index, item) {
                   $("#alltaskslist").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"
                   +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                 });

             });
             eventDiv4.classList.add('alltasksstyle');
             //eventDiv1.className="eventprogress";
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



                 $("#remarkstitle").append(" Vacation Plan for ("+ months[i] +")");

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
                   //newcell.className = "tseqid23";

                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.vstart;
                   //newcell.className = "tseqid23";

                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.vend;
                   //newcell.className = "tseqid23";


                   i++;
                   newcell = row2.insertCell(i);
                   newcell.innerHTML = item.action;
                   });


            });
             eventDiv5.classList.add('vacationsstyle');
             eventDiv5.innerText = vacations;
             monthSquare.appendChild(eventDiv5);


           }
           // daySquare.addEventListener("click", function() {
           //
           //     if(!vacations){
           //     $('#vacationplanmodal').modal({backdrop: 'static', keyboard: false}) ;
           //     $("#vacationplantitle").html("");
           //     $("#vacationplantitle").append("Out of Office/Vacation Planner ");
           //
           //      $("#vstart").val(dayString2);
           //      $("#vend").val(dayString2);
           //      $("#reason").val(0);
           //      $("#remark").val("");
           //      $("#errorooo").hide();
           //      $("#successooo").hide();
           //
           //
           //
           //
           //       $('#vstart').prop('disabled', false);
           //       $('#vend').prop('disabled', false);
           //       $('#reason').prop('disabled', false);
           //       $('#remark').prop('disabled', false);
           //       $('#createooo').prop('disabled', false);
           //       $('#createooo').show();
           //
           //    }
           //      else{
           //        $('#vacationplanmodal').modal('show');
           //        $(dataResult[5]).each(function (index, item) {
           //          $("#vstart").val(item.vstart);
           //          $("#vend").val(item.vend);
           //          $("#reason").val(item.vid);
           //          $("#remark").val(item.vremark);
           //          //$("#errorooo").hide();
           //
           //        });
           //
           //        $('#vstart').prop('disabled', true);
           //        $('#vend').prop('disabled', true);
           //        $('#reason').prop('disabled', true);
           //        $('#remark').prop('disabled', true);
           //        $('#createooo').hide();
           //        $("#successooo").hide();
           //        $("#errorooo").show();
           //        $('#errorooo').html("Vacation already Planned");
           //
           //      }
           //
           //
           //
           //
           // });






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
