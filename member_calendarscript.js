$(document).ready(function() {
  $('.close2').on('click',function(){
  load();
  });

  $('.close1').on('click',function(){
  load();
});


var nav = 0;
let clicked = null;
const calendar = document.getElementById('calendar');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function load() {
const dt = new Date();

if (nav !== 0) {
  dt.setMonth(new Date().getMonth() + nav);
}
const day = dt.getDate();
const month = dt.getMonth();
const year = dt.getFullYear();

const firstDayOfMonth = new Date(year, month, 1);
// console.log("firstDayOfMonth= "+firstDayOfMonth);
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
    const daySquare = document.createElement('div');
    daySquare.classList.add('day');
    const dayString = `${month + 1}/${i - paddingDays}/${year}`;
    var day2=`${i - paddingDays}`;
    var month2=`${month + 1}`;

    if(parseInt(day2)<10 && parseInt(day2)>=0){
      day2= "0"+day2;
    }
    if(parseInt(month2)<"10"){
      month2="0"+month2;
    }
    const dayString2 = `${year}-${month2}-${day2}`;

    if (i > paddingDays) {
      daySquare.innerText = i - paddingDays;

      var type= "20";
      var uguid=sessionStorage.getItem("member_uguid");
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              date: dayString2,
              uguid:uguid
            },
        cache: false,
        success: function(dataResult){
          // console.log(dataResult);
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
                  $("#stage1list").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"+item.tstepdescription +"</li>");

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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

                });

            });
            eventDiv1.classList.add('eventprogress');
            //eventDiv1.className="eventprogress";
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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

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
                  +item.tstepdescription +"&nbsp;&nbsp;(<b>Deadline:</b> "+item.pend +" )</li>");

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
                $('#cancelooo').prop('disabled', false);

                $("#vguid").val(dataResult[5][0].vguid);

                $("#remarkstitle").append("Vacation Remarks History & Action ("+ dayString2 +")");

                 $(dataResult[6]).each(function (index, item) {
                   $("#remarkslist").append("<li class='list-group-item'>["+ item.updatedon +";&nbsp;&nbsp;"
                  +item.updatedat +";&nbsp;&nbsp;"+item.updatedby+ "]&nbsp;&nbsp;"+item.vremark +"</li>");

                 });

            });
             eventDiv5.classList.add('vacationsstyle');

             eventDiv5.innerText = "V";
             daySquare.appendChild(eventDiv5);


           }
          daySquare.addEventListener("click", function() {

              if(!vacations){
              $('#vacationplanmodal').modal({backdrop: 'static', keyboard: false}) ;
              $("#vacationplantitle").html("");
              $("#vacationplantitle").append("Out of Office/Vacation Planner ");

               $("#vstart").val(dayString2);
               $("#vend").val(dayString2);
               $("#reason").val(0);
               $("#remark").val("");
               $("#errorooo").hide();
               $("#successooo").hide();




                $('#vstart').prop('disabled', false);
                $('#vend').prop('disabled', false);
                $('#reason').prop('disabled', false);
                $('#remark').prop('disabled', false);
                $('#createooo').prop('disabled', false);
                $('#createooo').show();

             }
               else{
                 $('#vacationplanmodal').modal('show');
                 $(dataResult[5]).each(function (index, item) {
                   $("#vstart").val(item.vstart);
                   $("#vend").val(item.vend);
                   $("#reason").val(item.vid);
                   $("#remark").val(item.vremark);
                   //$("#errorooo").hide();

                 });

                 $('#vstart').prop('disabled', true);
                 $('#vend').prop('disabled', true);
                 $('#reason').prop('disabled', true);
                 $('#remark').prop('disabled', true);
                 $('#createooo').hide();
                 $("#successooo").hide();
                 $("#errorooo").show();
                 $('#errorooo').html("Vacation already Planned");

               }




          });




        }
      });




      if (i - paddingDays === day && nav === 0) {
        daySquare.id = 'currentDay';
      }
    } else {
      daySquare.classList.add('padding');
    }

    calendar.appendChild(daySquare);
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
$('.createooo1').on('click', function() {
  event.preventDefault();

  var createdfor = sessionStorage.getItem("member_uguid");
  var vstart = $('#vstart').val();
  var vend = $('#vend').val();
  var vid = $('#reason').val();
  var vremark = $('#remark').val();
  var type= "21";
  console.log("Vacation create function");
  //console.log(vstart+" "+vend+" "+vid+" "+vremark+" "+type);
  $.ajax({
    url: "updatetask1.php",
    type: "POST",

    data:    {
          type: type,
          vid: vid,
          vstart: vstart,
          vend: vend,
          vremark: vremark,
          createdfor: createdfor

        },
        cache: false,
        success: function(dataResult){
    console.log(dataResult);
    var dataResult = JSON.parse(dataResult);
   console.log(dataResult);
   console.log("Vacation Result loaded");
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

      $('.cancelooo').on('click', function() {
      event.preventDefault();

      var vguid = $('#vguid').val();
      var vremark = $('#vremark').val();
      var type= "5";
      console.log("Vacation cancellation function");

      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              vguid: vguid,
              vremark: vremark

            },
            cache: false,
            success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              console.log(dataResult);
              console.log("Vacation Cacellation file loaded");
              if(dataResult.statuscode=="s"){
                  console. log("display s message");
                  $("#cancel_form")[0].reset();
                  $('.cancelooo').prop('disabled', true);
                  $("#cerror").hide();
                  $("#csuccess").show();
                  $('#csuccess').html(dataResult.description);

                }
              else{
                  console. log("display e message");
                  //$('.cancelooo').prop('disabled', true);
                  $("#csuccess").hide();
                  $("#cerror").show();
                  $('#cerror').html(dataResult.description);

              }


            }
          });


      });
initButtons();
load();

});
