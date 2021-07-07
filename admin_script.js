function edittask(assignto,tguid,tid,tsequenceid,tstepdescription,ttype,pstart,pend,peffortm,
astart,aend,aeffortm,tstage){
  console.log("Test click function");
  $('#edit_task_modal').modal({
    backdrop: 'static',
    keyboard: false
  });
  // console.log(assignto+" "+tguid+ " "+tid+" "+tstepdescription+" "+ttype+" "+
  // pstart+" "+pend+" "+peffortm+" "+
  // astart+" "+aend+" "+aeffortm+" "+tstage);
  $('#assignto1').val(assignto);
  $('#tguid1').val(tguid);
  $('#tid1').val(tid);
  $('#tsequenceid1').val(tsequenceid);
  $('#tdescription1').val(tstepdescription);
  $('#ttype1').val(ttype);
  $('#pstart1').val(pstart);
  $('#pend1').val(pend);
  $('#peffort1').val(peffortm);
  $('#astart1').val(astart);
  $('#aend1').val(aend);
  $('#aeffort1').val(aeffortm);
  $('#tstatus1').val(tstage);


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
             tstatus:tstatus,
             userslist:userslist,
             userinfo:userinfo


           },
       cache: false,
       success: function(dataResult){
         // console.log(dataResult);
         var dataResult = JSON.parse(dataResult);
         console.log(dataResult);

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
           row = table1.insertRow(table1.rows.length);
           row.className = "row_task_table1";

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
           newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tguid;
           newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = '<button type="button" onclick="edittask(\''+ assignto +'\',\''+ tguid +'\',\''+ tid +'\',\''+ tstepdescription +'\',\''+ ttype +'\',\''+ pstart +'\',\''+ pend +'\',\''+ peffortm +'\',\''+ astart +'\',\''+ aend +'\',\''+ aeffortm +'\',\''+ tstage +'\')" class="btn btn-primary tid_button">'+item.tid+'</button>';
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
           newcell.innerHTML = item.peffort;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = astart;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = aend;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.aeffort;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tstatus;
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
           newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.tguid;
           newcell.className = "hidden_cells";

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = '<button type="button" onclick="edittask(\''+ assignto +'\',\''+ tguid +'\',\''+ tid +'\',\''+ tsequenceid +'\',\''+ tstepdescription +'\',\''+ ttype +'\',\''+ pstart +'\',\''+ pend +'\',\''+ peffortm +'\',\''+ astart +'\',\''+ aend +'\',\''+ aeffortm +'\',\''+ tstage +'\')" class="btn btn-primary tid_button">'+item.tid+'</button>';
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
           newcell.innerHTML = item.peffort;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = astart;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = aend;

           i++;
           newcell = row.insertCell(i);
           newcell.innerHTML = item.aeffort;

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

});
$('.close1').on('click',function(){
loadtask_tables();

});

$('.edittaskbtn').on('click',function(){
  console.log("Inside task edit function");
});


});
