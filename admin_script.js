function edittask(assignto,tguid,tid,tsequenceid,tstepdescription,ttype,pstart,pend,peffort,astart,aend,aeffort,tstage)
{
  console.log("Test click function");
  $('#edit_task_modal').modal({
    backdrop: 'static',
    keyboard: false
  });

  var peffort1=parseFloat(peffort).toFixed(2);
  var aeffort1=parseFloat(aeffort).toFixed(2);
  // console.log("assign to:"+assignto+" tguid:"+tguid+ " tid:"+tid+" tsequenceid:"+tsequenceid+" tstepdescription:"+tstepdescription+" ttype:"+ttype+" pstart:"+
  // pstart+" pend:"+pend+" peffortm:"+peffortm+" astart:"+
  // astart+" aend:"+aend+" aeffortm:"+aeffortm+" tstage:"+tstage);
  $('#assignto1').val(assignto);
  $('#tguid1').val(tguid);
  $('#tid1').val(tid);
  $('#tsequenceid1').val(tsequenceid);
  $('#tdescription1').val(tstepdescription);
  $('#ttype1').val(ttype);
  $('#pstart1').val(pstart);
  $('#pend1').val(pend);
  $('#peffort1').val(peffort1);
  $('#astart1').val(astart);
  $('#aend1').val(aend);
  $('#aeffort1').val(aeffort1);
  $('#tstatus1').val(tstage);

if(tsequenceid!=0){
  $('#tsequenceid1').prop('readonly', true);
  $('#tdescription1').prop('readonly', true);
  $('#tid1').prop('readonly', true);
}
else{
  $('#tsequenceid1').prop('readonly', false);
  $('#tdescription1').prop('readonly', false);
  $('#tid1').prop('readonly', false);
}
  $("#successedittask").hide();
  $("#erroredittask").hide();
  $('.edittaskbtn').prop('disabled', false);


}
function taskdetails(tguid){
  console.log(tguid);
  sessionStorage.setItem("tguid", tguid);
  location.href = "task_details.php";
}
function exporttable1toexcel()
{

//    $("#admin_search_table").table2excel({
//      exclude: ".noExl",
//      filename: "tasks",
//      fileext: ".xls",
//      columns : [0,1,4,5,6,7,8,9,10,11,12,13]
// });
var table2excel = new Table2Excel();
table2excel.export(document.querySelectorAll("#admin_search_table"),"tasks");

}

function exporttable2toexcel()
{

//    $("#admin_search_table").table2excel({
//      exclude: ".noExl",
//      filename: "task_steps",
//      fileext: ".xls",
//      columns : [0,1,4,5,6,7,8,9,10,11,12,13]
//
//
// });
var table2excel = new Table2Excel();
table2excel.export(document.querySelectorAll("#admin_search_step_table"),"task_steps");
}
function exporttable1topdf(){

var pdf = new jsPDF('l', 'pt', 'a4');

// var tablaDatos = $('#admin_search_table');
// var data = pdf.autoTableHtmlToJson(tablaDatos[0]);

pdf.autoTable({
html: '#admin_search_table',
styles: {overflow: 'linebreak',
        fontSize: 6},
margin: {
  left: 20,
  top: 20,
  right:20
},
// tableWidth: 800,
theme: 'grid'
 });
pdf.save('task_table.pdf');
}
function exporttable2topdf(){
  var pdf = new jsPDF('l', 'pt', 'a4');


  pdf.autoTable({
  html: '#admin_search_step_table',
  styles: {overflow: 'linebreak',
          fontSize: 6},
  margin: {
    left: 20,
    top: 20,
    right:20
  },
  // tableWidth: 800,
  theme: 'grid'
   });
  pdf.save('task_steps_table.pdf');
}


$(document).ready(function() {

let dropdown = $('#userslist');
dropdown.empty();
dropdown.append('<option selected="true" value="0">--Choose User Name--</option>');
dropdown.prop('selectedIndex', 0);

const url = 'employeelist.json';

$.getJSON(url, function(data) {
  $.each(data, function(key, entry) {
    dropdown.append($('<option></option>').attr('value', entry.uguid).text(entry.uname + "---" + entry.e_emailid));
  })
});

let dropdown2 = $('#assignto1');
dropdown2.empty();
dropdown2.append('<option selected="true" value="0">--Choose User Name--</option>');
dropdown2.prop('selectedIndex', 0);

const url2 = 'employeelist.json';

$.getJSON(url2, function(data) {
  $.each(data, function(key, entry) {
    dropdown2.append($('<option></option>').attr('value', entry.uguid).text(entry.uname + "---" + entry.e_emailid));
  })
});
// apply color code to Task ID
function applycolor(pend,date_today,cellid,tid,tstage){
  var color_cell= 'green';
  var diff= (Date.parse(pend) - Date.parse(date_today)) / 86400000; //1000*60*60*24=86400000 (number of milliseconds in a day)
  // console.log("cell_id:"+cellid+" tid:"+tid+" t_stage:"+tstage+" p_end:"+pend+" date_today:"+date_today+" diff:"+diff);

  if(tstage==1) color_cell='#BEBFCC';
  else if(tstage=="2" || tstage==3) {
  if(diff>=2) color_cell="#5FDB39";
  else if(diff<2 && diff>=0) color_cell="#F39536";
  else color_cell="#EC4819";
  }
  else if(tstage=="4") color_cell="#4BF1F6";
  else if(tstage=="5") {
    if(diff>=2) color_cell="#EDE310";
    else if(diff<2 && diff>=0) color_cell="#8C1BE0";
    else color_cell="#2227E3";
  }
  else if(tstage=="6"){
    if(diff>=2) color_cell="#F2EC82";
    else if(diff<2 && diff>=0) color_cell="#C28BEA";
    else color_cell="#878AE0";
  }

  // $(cellid).css('background-color', color_cell);
  $(cellid).css({'background-color': color_cell,'color':'black','font-weight':700});
}
$('#search_admin').on('click',function(){

});
$('#reset1').on('click',function(){

$("#task_search")[0].reset();
// $("#admin_search_div").hide();
$("#tbody_admin_search").empty();
$("#tbody_admin_step_search").empty();


$("#success_find").hide();
$("#error_find").hide();

});

// admin search functionality
function loadtask_tables(){
  $("#admin_search_div").show();
  event.preventDefault();
  var tid= $('#tid').val();
  var createdon_from=$('#createdon').val();
  var createdon_to=$('#createdon_to').val();
  var pstart_from=$('#pstart_from').val();
  var pstart_to=$('#pstart_to').val();
  var pend_from=$('#pend_from').val();
  var pend_to=$('#pend_to').val();
  var astart_from=$('#astart_from').val();
  var astart_to=$('#astart_to').val();
  var aend_to=$('#aend_to').val();
  var aend_from=$('#aend_from').val();
  var peffort_from=$('#peffort_from').val();
  var peffort_to=$('#peffort_to').val();
  var aeffort_from=$('#aeffort_from').val();
  var aeffort_to=$('#aeffort_to').val();
  var tstatus=$('#tstatus').val();
  var userslist=$('#userslist').val();
  var userinfo=$('#userinfo').val();
  var type="17";

// console.log(tid+" "+createdon_from+" "+createdon_to+" "+tstatus+" "+userslist+" "+userinfo);
     $.ajax({
       url: "updatetask1.php",
       type: "POST",
       data:    {
             type: type,
             tid: tid,
             createdon_from:createdon_from,
             createdon_to:createdon_to,
             pstart_from:pstart_from,
             pstart_to:pstart_to,
             pend_from:pend_from,
             pend_to:pend_to,
             peffort_from:peffort_from,
             peffort_to:peffort_to,
             aeffort_from:aeffort_from,
             aeffort_to:aeffort_to,
             astart_from:astart_from,
             astart_to:astart_to,
             aend_from:aend_from,
             aend_to:aend_to,
             tstatus:tstatus,
             userslist:userslist,
             userinfo:userinfo


           },
       cache: false,
       success: function(dataResult){
         // console.log(dataResult);
         var dataResult = JSON.parse(dataResult);
         // console.log(dataResult);

//display an error message if length of arrat dataresult is 0
         $("#tbody_admin_search").empty();
         $("#tbody_admin_step_search").empty();

         var table1 = document.getElementById("tbody_admin_search");
         var table2 = document.getElementById("tbody_admin_step_search");
         var j=0;

         $(dataResult).each(function (index, item) {
           var assignto=item.assignto_id;
           var tguid= item.tguid;
           var tstepdescription= item.tstepdescription;
           var ttype= item.ttype;
           var pstart= item.pstart;
           var pend= item.pend;
           var peffort= item.peffort/480;
           var peffortm= item.peffort;
           var astart= item.astart;
           var aend= item.aend;
           var aeffortm= item.aeffort;
           var aeffort= item.aeffort/480;
           var date_today= item.date_today;
           var tid= item.tid;
           var tstage=item.tstage;
           var tsequenceid=item.tsequenceid;
           j++;
           if(item.tsequenceid==0)
           {
             var tr = document.createElement('tr');
             table1.appendChild(tr);

           if(pstart=="0000-00-00") pstart="";
           if(pend=="0000-00-00") pend="";
           if(astart=="0000-00-00") astart="";
           if(aend=="0000-00-00") aend="";

           var i=0;
           var newcell = document.createElement('TD');
           newcell.innerHTML =item.createdon;
           tr.appendChild(newcell);
           // newcell.className = "vguid_vacation_table";

           i++;
           var newcell = document.createElement('td');
           newcell.innerHTML = item.assignto;
           tr.appendChild(newcell);


           i++;
           var newcell = document.createElement('td');
           newcell.innerHTML = item.assignto_id;
           // newcell.className = "hidden_cells";
           newcell.style.display = "none";
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('td');
           newcell.innerHTML = item.tguid;
           newcell.style.display = "none";
           // newcell.className = "hidden_cells";
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = '<button type="button" onclick="edittask(\''+ assignto +'\',\''+ tguid +'\',\''+ tid +'\',\''+ tsequenceid +'\',\''+ tstepdescription +'\',\''+ ttype +'\',\''+ pstart +'\',\''+ pend +'\',\''+ peffort +'\',\''+ astart +'\',\''+ aend +'\',\''+ aeffort +'\',\''+ tstage +'\')" class="btn btn-primary tid_button">'+item.tid+'</button>';
           newcell.className="tid_div";
           newcell.id="tid_b"+j+"_id";
           var cellid="#tid_b"+j+"_id button";
           tr.appendChild(newcell);

           applycolor(pend,date_today,cellid,tid,tstage)

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = '<button type="button" onclick="taskdetails(\''+ tguid +'\')" class="btn btn-link t_descr_button">'+tstepdescription+'</button>';
           newcell.className="t_descr_div";
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = item.ttype;
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = pstart;
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = pend;
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           if(peffort!=0) newcell.innerHTML = peffort.toFixed(2);
           else newcell.innerHTML="";
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = astart;
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = aend;
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           if(aeffort!=0) newcell.innerHTML = aeffort.toFixed(2);
           else newcell.innerHTML = "";
           tr.appendChild(newcell);

           i++;
           var newcell = document.createElement('TD');
           newcell.innerHTML = item.tstatus;
           tr.appendChild(newcell);
         }
         else{
           row = table2.insertRow(table2.rows.length);
           row.className = "row_task_table1";

           var pstart= item.pstart;
           var pend= item.pend;
           var astart= item.astart;
           var aend= item.aend;
           var aeffort= item.aeffort/480;
           var date_today= item.date_today;
           var tid= item.tid;
           var tstage=item.tstage;

           if(pstart=="0000-00-00") pstart="";
           if(pend=="0000-00-00") pend="";
           if(astart=="0000-00-00") astart="";
           if(aend=="0000-00-00") aend="";

           var i=0;
           var newcell = row.insertCell(i);
           newcell.innerHTML =item.createdon;
           // newcell.className = "vguid_vacation_table";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.assignto;


           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.assignto_id;
           newcell.style.display = "none";
           // newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tguid;
           newcell.style.display = "none";
           // newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = '<button type="button" onclick="edittask(\''+ assignto +'\',\''+ tguid +'\',\''+ tid +'\',\''+ tsequenceid +'\',\''+ tstepdescription +'\',\''+ ttype +'\',\''+ pstart +'\',\''+ pend +'\',\''+ peffort +'\',\''+ astart +'\',\''+ aend +'\',\''+ aeffort +'\',\''+ tstage +'\')" class="btn btn-primary tid_button">'+item.tid+'</button>';
           newcell.className="tid_div";
           newcell.id="tid_b"+j+"_id";
           var cellid="#tid_b"+j+"_id button";

           applycolor(pend,date_today,cellid,tid,tstage)

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tstepdescription;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.ttype;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = pstart;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = pend;

           i++;
           newcell = row.insertCell(i);
           if(peffort!=0) newcell.innerHTML = peffort.toFixed(2);
           else newcell.innerHTML ="";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = astart;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = aend;

           i++;
           newcell = row.insertCell(i);
           if(aeffort!=0) newcell.innerHTML = aeffort.toFixed(2);
           else newcell.html="";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tstatus;

         }





         });

       }

     });

}
$('.search_admin').on('click',function(){

loadtask_tables();
$(".expbtn").show();

});
$('.close1').on('click',function(){
loadtask_tables();

});

$('.edittaskbtn').on('click',function(){
  console.log("Inside task edit function");
  var assignto = $('#assignto1').val();
  var tguid = $('#tguid1').val();
  var tid = $('#tid1').val();
  var tsequenceid = $('#tsequenceid1').val();
  var tdescription = $('#tdescription1').val();
  var ttype = $('#ttype1').val();
  var pstart = $('#pstart1').val();
  var pend = $('#pend1').val();
  var peffort = $('#peffort1').val();
  var astart = $('#astart1').val();
  var aend = $('#aend1').val();
  var aeffort = $('#aeffort1').val();
  var tstatus = $('#tstatus1').val();
  var type="18";

// console.log(tid+" "+createdon_from+" "+createdon_to+" "+tstatus+" "+userslist+" "+userinfo);
     $.ajax({
       url: "updatetask1.php",
       type: "POST",


       data:    {
             type: type,
             assignto: assignto,
             tguid: tguid,
             tid: tid,
             tsequenceid: tsequenceid,
             tdescription: tdescription,
             ttype: ttype,
             pstart: pstart,
             pend: pend,
             peffort: peffort,
             astart: astart,
             aend: aend,
             aeffort: aeffort,
             tstatus: tstatus




           },
       cache: false,
       success: function(dataResult){
         console.log(dataResult);
         var dataResult = JSON.parse(dataResult);
         console.log(dataResult);

         if(dataResult.statuscode=="s"){
            console. log("display s message");
            //$("#task_form")[0].reset();
            $('.edittaskbtn').prop('disabled', true);
            $("#erroredittask").hide();
            $("#successedittask").show();
            $('#successedittask').html(dataResult.description);

          }
          else {

            console. log("display e message");
            $('.edittaskbtn').prop('disabled', true);
            $("#successedittask").hide();
            $("#erroredittask").show();
            $('#erroredittask').html(dataResult.description);

          }

       }
     });



});


});
