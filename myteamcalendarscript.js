function membercalendar(member_uguid,member_name){
  console.log(member_uguid);
  sessionStorage.setItem("member_uguid", member_uguid);
  sessionStorage.setItem("member_name", member_name);
  location.href = "member_calendar.php";
}

$(document).ready(function() {

  $('.close2').on('click',function(){
	//window.location.reload();
  load();

	});
	$('.close1').on('click',function(){
	//window.location.reload();
  load();

	});


var nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function openModal(date) {
  clicked = date;

  const eventForDay = events.find(e => e.date === clicked);

  if (eventForDay) {
    document.getElementById('eventText').innerText = eventForDay.title;
    //deleteEventModal.style.display = 'block';
  } else {
    //newEventModal.style.display = 'block';
  }

  //backDrop.style.display = 'block';
}

function load() {
  const dt = new Date();

  if (nav !== 0) {
    dt.setMonth(new Date().getMonth() + nav);
  }

  const day = dt.getDate();
  const month = dt.getMonth();
  const year = dt.getFullYear();

  const firstDayOfMonth = new Date(year, month, 1);
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });
  const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);


  document.getElementById('monthDisplay').innerText =
    `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

  calendar.innerHTML = '';

  for(let i = 1; i <= paddingDays + daysInMonth; i++) {


    // const dayString4 = `${year}/${month2}/${day2}`;
    // const dayString3 = `${day2}-${month2}-${year}`;
    const daySquare = document.createElement('div');
    daySquare.classList.add('day');



    const dayString = `${month + 1}/${i - paddingDays}/${year}`;



    var day2=`${i - paddingDays}`;
    var month2=`${month + 1}`;


    if(parseInt(day2)<10 && parseInt(day2)>=0){
      day2= "0"+day2;
      //day2= `0${i - paddingDays}`;
    }
    if(parseInt(month2)<"10"){
      month2="0"+month2;
      //month2=`0${month + 1}`;
    }
    const dayString2 = `${year}-${month2}-${day2}`;

    //console.log(dayString2);
    if (i > paddingDays) {
      daySquare.innerText = i - paddingDays;

      var type= "11";

      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              date: dayString2
            },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
           // console.log("Result for "+ dayString2);
           // console.log(dataResult);
           // console.log("Result loaded");
          var reslength= dataResult[0].length;
          var safeprogress= dataResult[1].length;
          var alertprogress= dataResult[2].length;
          var dangerprogress= dataResult[3].length;
          var alltasks= dataResult[4].length;
          var vacations= dataResult[5].length;
          //var remarks= dataResult[6].length;
          //console.log("to do tasks: "+reslength);
          //console.log("safe tasks: "+safeprogress);
          //console.log("deadline approaching tasks: "+alertprogress);
          //console.log("danger tasks: "+dangerprogress);
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
                  $("#stage1list").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"+item.tstepdescription +"; <b>Assigned to:</b> "+item.assignto+ "</li>");

                });

            });
            eventDiv.classList.add('eventstage1');
            eventDiv.innerText = reslength;
            daySquare.appendChild(eventDiv);


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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +"; <b>Assigned to:</b> "+item.assignto+" )</li>");

                });

            });
            eventDiv1.classList.add('eventprogress');
            eventDiv1.innerText = safeprogress;
            daySquare.appendChild(eventDiv1);


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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +"; <b>Assigned to:</b> "+item.assignto+ " )</li>");

                });

            });
            eventDiv2.classList.add('alertprogress');
            //eventDiv1.className="eventprogress";
            eventDiv2.innerText = alertprogress;
            daySquare.appendChild(eventDiv2);


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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +"; <b>Assigned to:</b> "+item.assignto+ " )</li>");

                });

            });
            eventDiv3.classList.add('dangerprogress');
            //eventDiv1.className="eventprogress";
            eventDiv3.innerText = dangerprogress;
            daySquare.appendChild(eventDiv3);


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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +"; <b>Assigned to:</b> "+item.assignto+ " )</li>");

                });

            });
            eventDiv4.classList.add('alltasksstyle');
            //eventDiv1.className="eventprogress";
            eventDiv4.innerText = alltasks;
            daySquare.appendChild(eventDiv4);


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



                 $("#remarkstitle").append("Team Vacation Plan ("+ dayString2 +")");
                //
                //  $(dataResult[6]).each(function (index, item) {
                //    $("#remarkslist").append("<li class='list-group-item'>["+ item.updatedon +";&nbsp;&nbsp;"
                //   +item.updatedat +";&nbsp;&nbsp;vacation for: <b>"+item.createdfor+ "</b>;&nbsp;&nbsp;remark by: <b>"+item.updatedby+"</b>]&nbsp;&nbsp;"+item.vremark +"</li>");
                //
                //  });

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
                   newcell.innerHTML = item.createdfor_name;
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
             daySquare.appendChild(eventDiv5);


           }
          daySquare.addEventListener("click", function() {

              $('#vacationplanmodal').modal({backdrop: 'static', keyboard: false}) ;
              $("#vacationplantitle").html("");
              $("#vacationplantitle").append("Team Vacation Planner ");

               $("#vstart").val(dayString2);
               $("#vend").val(dayString2);
               $("#reason").val(0);
               $("#createdfor").val(0);
               $("#remark").val("");
               $("#errorooo").hide();
               $("#successooo").hide();


                $('#vstart').prop('disabled', false);
                $('#vend').prop('disabled', false);
                $('#reason').prop('disabled', false);
                $('#remark').prop('disabled', false);
                $('#createooo').show();
                $('#createooo').prop('disabled', false);






          });




        }
      });




      // const eventForDay = events.find(e => e.date === dayString);
      //
      if (i - paddingDays === day && nav === 0) {
        daySquare.id = 'currentDay';
      }
      //
      // if (eventForDay) {
      //   const eventDiv = document.createElement('div');
      //   eventDiv.classList.add('event');
      //   eventDiv.innerText = eventForDay.title;
      //   daySquare.appendChild(eventDiv);
      // }
      //
      //  daySquare.addEventListener('click', () => openModal(dayString));
    } else {
      daySquare.classList.add('padding');
    }

    calendar.appendChild(daySquare);
  }
}

function closeModal() {
  eventTitleInput.classList.remove('error');
  newEventModal.style.display = 'none';
  deleteEventModal.style.display = 'none';
  backDrop.style.display = 'none';
  eventTitleInput.value = '';
  clicked = null;
  load();
}

function saveEvent() {
  if (eventTitleInput.value) {
    eventTitleInput.classList.remove('error');

    events.push({
      date: clicked,
      title: eventTitleInput.value,
    });

    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
  } else {
    eventTitleInput.classList.add('error');
  }
}

function deleteEvent() {
  events = events.filter(e => e.date !== clicked);
  localStorage.setItem('events', JSON.stringify(events));
  closeModal();
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

  document.getElementById('saveButton').addEventListener('click', saveEvent);
  document.getElementById('cancelButton').addEventListener('click', closeModal);
  document.getElementById('deleteButton').addEventListener('click', deleteEvent);
  document.getElementById('closeButton').addEventListener('click', closeModal);
}
	$('.createooo1').on('click', function() {
    event.preventDefault();

    var vstart = $('#vstart').val();
    var vend = $('#vend').val();
    var vid = $('#reason').val();
    var vremark = $('#remark').val();
    var createdfor= $('#createdfor').val();
    var type= "12";
    // console.log("Vacation create function");
    // console.log(vstart+" "+vend+" "+vid+" "+vremark+" "+type+" "+createdfor);
    $.ajax({
      url: "updatetask1.php",
      type: "POST",

      data:    {
            type: type,
            vid: vid,
            vstart: vstart,
            vend: vend,
            createdfor: createdfor,
            vremark: vremark

          },
          cache: false,
          success: function(dataResult){

   var dataResult = JSON.parse(dataResult);
   //console.log(dataResult);
   // console.log("Vacation Result loaded");
 if(dataResult.statuscode=="s"){
   	console. log("display s message");
    $("#ooo_form")[0].reset();
    $('.createooo1').prop('disabled', true);
    $("#errorooo").hide();
    $("#successooo").show();
    $('#successooo').html(dataResult.description);
 }
 else{
   console. log("display e message");
   $('.createooo1').prop('disabled', true);
   $("#successooo").hide();
   $("#errorooo").show();
   $('#errorooo').html(dataResult.description);

 }

          }
        });



  });

	// $('.cancelooo').on('click', function() {
  // event.preventDefault();
  //
  // var vguid = $('#vguid').val();
  // var vremark = $('#vremark').val();
  // var type= "5";
  // console.log("Vacation cancellation function");
  //
  // $.ajax({
  //   url: "updatetask1.php",
  //   type: "POST",
  //
  //   data:    {
  //         type: type,
  //         vguid: vguid,
  //         vremark: vremark
  //
  //       },
  //       cache: false,
  //       success: function(dataResult){
  //         var dataResult = JSON.parse(dataResult);
  //         console.log(dataResult);
  //         console.log("Vacation Cacellation file loaded");
  //         if(dataResult.statuscode=="s"){
  //           	console. log("display s message");
  //             $("#cancel_form")[0].reset();
  //             $('.cancelooo').prop('disabled', true);
  //             $("#cerror").hide();
  //             $("#csuccess").show();
  //             $('#csuccess').html(dataResult.description);
  //
  //           }
  //         else{
  //             console. log("display e message");
  //             $("#csuccess").hide();
  //             $("#cerror").show();
  //             $('#cerror').html(dataResult.description);
  //
  //         }
  //
  //
  //       }
  //     });
  //
  //
  // });

initButtons();
load();
});
