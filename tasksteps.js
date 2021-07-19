
function deletetaskstep(tguid,tsequenceid,pstart){
  console.log("Inside deletemodalfunction");

  $tr= $(this).closest('tr');
  var data=$tr.children("td").map(function(){
  return $(this).text();
}).get();

  //$('#deletetaskmodal1').modal('show');
  $('#deletetaskmodal1').modal({backdrop: 'static', keyboard: false}) ;

  $('#tguidd').val(tguid);
  $('#tsequenceidd').val(tsequenceid);
  $('#tpstart').val(pstart);
  // console.log(tguid);
  // console.log(pstart);
  // console.log(tsequenceid);

}


function addtaskstep(tguid,tsequenceid,tstepdescription){

  console.log("Inside addmodalfunction");

  $tr= $(this).closest('tr');
  var data=$tr.children("td").map(function(){
  return $(this).text();
}).get();

  //$('#addtaskmodal1').modal('show');
  	$('#addtaskmodal1').modal({backdrop: 'static', keyboard: false}) ;
  $('#tguidd23').val(tguid);
  $('#tsequenceidd23').val(tsequenceid);
  $('#tstepdescription23').val(tstepdescription);
  }
// $('.deletestep2').on('click',function(){
//     console.log("Inside deletemodalfunction");
//     $('#deletetaskmodal1').modal('show');
//
// });

$(document).ready(function() {
  $('.close').on('click',function(){
  window.location.reload();
  //window.location.href = 'mytask.php';
  });
  $('.close1').on('click',function(){
  window.location.reload();
  //window.location.href = 'mytask.php';
  });



  function sortByKey(array, key) {
    return array.sort(function(a, b) {
    var x = parseInt(a[key]); var y = parseInt(b[key]);
    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
});
}


var tguidstep = sessionStorage.getItem("tguidstep23");
// console.log("External Script tguidstep");
// console.log(tguidstep);

var tasklist=[

  {	tguid:tguidstep,
    tsequenceid:"21",
    tstepdescription:"Kickoff"
    },
  {	tguid:tguidstep,
    tsequenceid:"31",
    tstepdescription:"Requirement Gathering"
    },
  {	tguid:tguidstep,
    tsequenceid:"41",
    tstepdescription:"Requirement Analysis"
    },
  {	tguid:tguidstep,
    tsequenceid:"51",
    tstepdescription:"Estimation"
    },
  {	tguid:tguidstep,
    tsequenceid:"61",
    tstepdescription:"Approval Step"
    },
  {	tguid:tguidstep,
    tsequenceid:"71",
    tstepdescription:"Functional Specification (FSR)"
    },
  {	tguid:tguidstep,
    tsequenceid:"81",
    tstepdescription:"Functional Design (FSD)"
    },
  {	tguid:tguidstep,
    tsequenceid:"91",
    tstepdescription:"Technical Design (TSD)"
    },
  {	tguid:tguidstep,
    tsequenceid:"101",
    tstepdescription:"Code"
    },
  {	tguid:tguidstep,
    tsequenceid:"111",
    tstepdescription:"Code Review"
    },
  {	tguid:tguidstep,
    tsequenceid:"121",
    tstepdescription:"Technical Testing"
    },
  {	tguid:tguidstep,
    tsequenceid:"131",
    tstepdescription:"Unit Testing (UT)"
    },

  {	tguid:tguidstep,
    tsequenceid:"141",
    tstepdescription:"Integration Testing (TIN)"
    },
  {	tguid:tguidstep,
    tsequenceid:"151",
    tstepdescription:"User Acceptance Testing (UAT)"
    },
  {	tguid:tguidstep,
    tsequenceid:"161",
    tstepdescription:"Non Regression Testing (NRT)"
    },
  {	tguid:tguidstep,
    tsequenceid:"171",
    tstepdescription:"Cut Over"
    },
  {	tguid:tguidstep,
    tsequenceid:"181",
    tstepdescription:"Go Live"
    },
  {	tguid:tguidstep,
    tsequenceid:"191",
    tstepdescription:"Hypercare"
  },
  {	tguid:tguidstep,
    tsequenceid:"201",
    tstepdescription:"Bug Fix"
    },
  {	tguid:tguidstep,
    tsequenceid:"211",
    tstepdescription:"Closure"}

 ]


//console.log(tguidstep);
      $.ajax({
    url: "tasksteps.php",
    type:"POST",
    data:{
      tguidstep:tguidstep


    },
    cache: false,
    success:function(dataResult){
    var dataResult = JSON.parse(dataResult);
    console.log(dataResult);
    var mapped_tsteps= dataResult.mapped_tsteps;
    var remaining_tsteps=dataResult.remaining_tsteps;

    mapped_stteps = sortByKey(mapped_tsteps, 'tsequenceid');
    // console.log(mapped_tsteps);

    $("#tbodystep23").empty();
    $("#tbodylist23").empty();
    var taskpresent=[];

    var len= mapped_tsteps.length;
    var table = document.getElementById("taskstep23");




    $(mapped_tsteps).each(function (index, item) {

      var task1={
                  tguid:item.tguid,
                  tsequenceid:item.tsequenceid,
                  tstepdescription:item.tstepdescription

                }
                taskpresent.push(task1);


                //console.log(item);
                //console.log(receipts[index]);
                  var peffort= item.peffort/480;
                  var aeffort= item.aeffort/480;
                  var pstartn="";
                  var pendn="";
                  var astartn="";
                  var aendn="";
                  var pstagen="";
                  if(item.pstart=="0000-00-00" || item.pstart=="NULL" || item.pstart=="null" || item.pstart==null) pstartn="";
                  else pstartn= item.pstart;
                  if(item.pend=="0000-00-00" || item.pend=="NULL" || item.pend=="null" || item.pend==null) pendn="";
                  else pendn= item.pend;
                  if(item.astart=="0000-00-00" || item.astart=="NULL" || item.astart=="null" || item.astart==null) astartn="";
                  else astartn= item.astart;
                  if(item.aend=="0000-00-00" || item.aend=="NULL" || item.aend=="null" || item.astart==null) aendn="";
                  else aendn= item.aend;
                  if(item.tstage=="1") pstagen="To be planned";
                  else if(item.tstage=="2" || item.stage==3) pstagen="In Progress";
                  else if(item.tstage=="4") pstagen="Completed";
                  else if(item.tstage=="5") pstagen="On Hold";
                  else pstagen="Awaiting";
                $('[data-toggle="tooltip"]').tooltip();

                row = table.insertRow(table.rows.length);

                var i=0;
                var newcell = row.insertCell(i);
                newcell.innerHTML =item.tguid;
                newcell.className = "taskid23";

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = item.tsequenceid;
                newcell.className = "tseqid23";

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = item.tstepdescription;

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = item.assigntoname;

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = pstartn;

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = pendn;

                i++;
                newcell = row.insertCell(i);
                if(peffort!=0) newcell.innerHTML = peffort.toFixed(2);
                else newcell.innerHTML="";

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = astartn;

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = aendn;

                i++;
                newcell = row.insertCell(i);
                if(aeffort!=0) newcell.innerHTML = aeffort.toFixed(2);
                else newcell.innerHTML = "";

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = pstagen;

                i++;
                newcell = row.insertCell(i);
                newcell.innerHTML = "<button onclick='deletetaskstep(\""+ item.tguid +"\",\"" + item.tsequenceid +"\",\"" + pstartn +"\")'><i data-toggle= 'tooltip' data-placement= 'right' title='Delete Task Step' class='fas fa-trash deletetstep' style='font-size:20px;' ></i></button>";
                newcell.className = 'deletestepbutton';

              });

            $(remaining_tsteps).each(function (index, item) {
                
                  $('[data-toggle="tooltip"]').tooltip();
                  $('#tasksteplist23 tbody').append(
                    '<tr><td style="display:none;">' + item.tguid +
                    '</td><td style="display:none;">' + item.tsequenceid +
                    '</td><td>' + item.tstepdescription +
                    '</td><td><button onclick="addtaskstep(\''+ item.tguid +'\',\'' + item.tsequenceid +'\',\'' + item.tstepdescription +'\')"><i data-toggle="tooltip" data-placement="right" title="Add Task Step" class="fas fa-plus" style="font-size:20px;" id="deletestep"></i></button>'+
                    '</td></tr>'

                  );
            });


    // $(tasklist).each(function (index, item) {
    //
    //   let toSearch = item.tsequenceid;
    //   let result = taskpresent.filter(o=> o.tsequenceid === toSearch);
    //   var res= result.length;
    //
    //   if(res==0){
    //     $('[data-toggle="tooltip"]').tooltip();
    //     $('#tasksteplist23 tbody').append(
    //       '<tr><td style="display:none;">' + item.tguid +
    //       '</td><td style="display:none;">' + item.tsequenceid +
    //       '</td><td>' + item.tstepdescription +
    //       '</td><td><button onclick="addtaskstep(\''+ item.tguid +'\',\'' + item.tsequenceid +'\',\'' + item.tstepdescription +'\')"><i data-toggle="tooltip" data-placement="right" title="Add Task Step" class="fas fa-plus" style="font-size:20px;" id="deletestep"></i></button>'+
    //       '</td></tr>'
    //
    //     )
    //
    //   }
    //
    //
    // });



    }
    });

$('.addtaskstp').on('click',function(){
event.preventDefault();
var tguid = $('#tguidd23').val();
var tsequenceid = $('#tsequenceidd23').val();
var tstepdescription = $('#tstepdescription23').val();
var type= "2";

$.ajax({
  url: "updatetask1.php",
  type: "POST",

  data:    {
        type: type,
        tguid: tguid,
        tsequenceid: tsequenceid,
        tstepdescription:tstepdescription

      },
  cache: false,
  success: function(dataResult){
    var dataResult = JSON.parse(dataResult);
    console.log(dataResult);
    if(dataResult.statuscode=="s"){
       console. log("display s message");
       //$("#task_form")[0].reset();
       $('.addtaskstp').prop('disabled', true);
       $("#errordelete").hide();
       $("#successdelete").show();
       $('#successdelete').html(dataResult.description);

     }
     else {

       console. log("display e message");
       $('.addtaskstp').prop('disabled', true);
       $("#successdelete").hide();
       $("#errordelete").show();
       $('#errordelete').html(dataResult.description);

     }

  }

});
});

$('.deletetaskstp').on('click',function(){
  event.preventDefault();
   var tguid = $('#tguidd').val();
   var tsequenceid = $('#tsequenceidd').val();
   var pstart = $('#tpstart').val();
   var type= "1";
   var resultarr=[];

   $.ajax({
     url: "updatetask1.php",
     type: "POST",

     data:    {
           type: type,
           tguid: tguid,
           tsequenceid: tsequenceid,
           pstart:pstart

         },
     cache: false,
     success: function(dataResult){
       var dataResult = JSON.parse(dataResult);
       resultarr.push(dataResult);
       //console.log(dataResult);
       console.log("inside ajax call");
       if(dataResult.statuscode=="s"){
          console. log("display s message");
          //$("#task_form")[0].reset();
          $('.deletetaskstp').prop('disabled', true);
          $("#erroradd").hide();
          $("#successadd").show();
          $('#successadd').html(dataResult.description);

        }
        else {

          console. log("display e message");
          $('.deletetaskstp').prop('disabled', true);
          $("#successadd").hide();
          $("#erroradd").show();
          $('#erroradd').html(dataResult.description);

        }

     }

   });


// console.log("resultarr before");
// console.log(resultarr);
// console.log("resultarr after");


});
// function loadtask_step_tables(){
//   // event.preventDefault();
//   var type="32";
//   $.ajax({
//     url: "updatetask1.php",
//     type: "POST",
//
//     data: {
//       type: type
//     },
//     cache: false,
//     success: function(dataResult) {
//
//       // console. log(dataResult);
//       var dataResult = JSON.parse(dataResult);
//       console. log(dataResult);
//
// },
//   error: function(e){
//
//    console.log(e);
//    console.log("Error");
// }
//
//
// });
//
//
// }
// loadtask_step_tables();

});
