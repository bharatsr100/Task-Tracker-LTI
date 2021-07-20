var task_head=["tsequenceid","tstepdescription"];

function select_all(id1,id2){

      var headid="#"+id1;
      var cellclass="."+id2;

  		$(cellclass).prop('checked', true);

      if(!$(headid).prop("checked")) {
      		$(cellclass).prop('checked', false);
      }
  }

function select_row(id1,id2,id3) {

      var headid="#"+id1;
      var cellid="#"+id2;
      var cellclass="."+id3;
      var cellclass_checked="."+id3+":checked";

  		if(!$(cellid).prop("checked")) {
          $(headid).prop('checked', false);
      } else {
      	 if ( $(cellclass_checked).length === $(cellclass).length) {
             $(headid).prop('checked', true);
         }
      }
}

$(document).ready(function() {
var ttype = sessionStorage.getItem("ttype");
var ttype_desc = sessionStorage.getItem("ttype_desc");
$("#head_tsteps").html("Mapped Task Steps for: <b>"+ttype_desc+"</b>");
function load_tsteps(ttype){
  var type="38";
  $.ajax({
    url: "updatetask1.php",
    type: "POST",
    data:    {
          type: type,
          ttype: ttype },
          cache: false,
          success: function(dataResult){

            // console. log(dataResult);
            var dataResult = JSON.parse(dataResult);
            // console. log(dataResult);
            var mapped_tsteps= dataResult.mapped_tsteps;
            var remaining_tsteps=dataResult.remaining_tsteps;
            $("#task_step_table_tbody").empty();
            $("#task_step_table_tbody2").empty();
            var table = document.getElementById("task_step_table_tbody");
            var table2 = document.getElementById("task_step_table_tbody2");
            var j=0;

            $(mapped_tsteps).each(function (index, item) {
              j++;
              var tsequenceid=item.tsequenceid;
              var tstepdescription= item.tstepdescription;
              var peffort_per= parseFloat(item.peffort_per);

              var tr = document.createElement('tr');
              table.appendChild(tr);

              var newcell = document.createElement('td');

              var headid="selectcolumn1 input";
              var cellid="check"+j+"id input";
              var cellclass="selectcolumn input";

              newcell.innerHTML = "<input type='checkbox' onclick='select_row(\""+headid+"\",\""+cellid+"\",\""+cellclass+"\")'/>&nbsp;";
              newcell.className="selectcolumn";
              newcell.id= "check"+j+"id";
              tr.appendChild(newcell);

              var newcell = document.createElement('td');
              newcell.innerHTML =tsequenceid;
              tr.appendChild(newcell);

              var newcell = document.createElement('td');
              newcell.innerHTML =tstepdescription;
              tr.appendChild(newcell);

              var newcell = document.createElement('td');
              newcell.innerHTML ='<input type="number" class="form-control" style="width: 100%;" step="any" value='+peffort_per+'>';
              tr.appendChild(newcell);
              newcell.className="peffort_col";

              // var newcell = document.createElement('td');
              // newcell.innerHTML ="";
              // newcell.id= "remark"+j;
              // newcell.className= "remarkcolumn";
              // tr.appendChild(newcell);

            });

            var j=0;

            $(remaining_tsteps).each(function (index, item) {
              var tsequenceid=item.tsequenceid;
              var tstepdescription= item.tstepdescription;

              var tr = document.createElement('tr');
              table2.appendChild(tr);


              var headid="selectcolumn2 input";
              var cellid="check"+j+"id2 input";
              var cellclass="selectcolumn2 input";

              var newcell = document.createElement('td');
              newcell.innerHTML = "<input type='checkbox' onclick='select_row(\""+headid+"\",\""+cellid+"\",\""+cellclass+"\")'/>&nbsp;";
              newcell.className="selectcolumn2";
              newcell.id= "check"+j+"id2";
              tr.appendChild(newcell);

              var newcell = document.createElement('td');
              newcell.innerHTML =tsequenceid;
              tr.appendChild(newcell);

              var newcell = document.createElement('td');
              newcell.innerHTML =tstepdescription;
              tr.appendChild(newcell);


              // var newcell = document.createElement('td');
              // newcell.innerHTML ="";
              // newcell.id= "remark2"+j;
              // newcell.className= "remarkcolumn2";
              // tr.appendChild(newcell);

            });
          },
          error: function(e){

           console.log(e);
           console.log("Error");
        }
        });


}
load_tsteps(ttype);

$('#savebtn').on('click',function(){
// console.log("Hello");
var selected_tasks= new Array();
var size= task_head.length;
$(".task_step_table tbody input[type=number]").each(function () {
  var task_details = {};
  var row = $(this).closest("tr")[0];
  var i;

  for(i=0;i<size;i++){

      var header= task_head[i];
      task_details[header] = row.cells[i+1].innerHTML;
  }
  // parseFloat
  task_details["peffort_per"]=parseFloat(row.cells[i+1].children[0].value);
  selected_tasks.push(task_details);

});
var ttype1=ttype;
// console.log(selected_tasks);
var length=selected_tasks.length;
if(length){
  var type="41";

  $.ajax({
    url: "updatetask1.php",
    type: "POST",

    data: {
      type: type,
      ttype:ttype1,
      alltasksteps:selected_tasks
    },
    cache: false,
    success: function(dataResult) {

      // console.log(dataResult);
      var dataResult = JSON.parse(dataResult);
      var total_per=parseFloat(dataResult.total_per);
      console.log(total_per);
      // console. log(dataResult);
      if(total_per<=100)
{
      load_tsteps(ttype1);
      $("#error_delete").hide();
      $("#success_delete").show();
      $("#success_delete").html("Planed Effort % successfully updated");
    }
    else{
      $("#success_delete").hide();
      $("#error_delete").show();
      $("#error_delete").html("Commulative % can not be greater than 100");
    }


},
  error: function(e){

   console.log(e);
   console.log("Error");
}
});

}
else{
  $("#error_delete").show();
  $("#error_delete").html("No task steps present to be saved");
}

});

$('#deletebtn').on('click', function() {
  $("#success_delete").hide();
  $("#error_delete").hide();

  var selected_tasks= new Array();
  var size= task_head.length;
  $(".task_step_table tbody input[type=checkbox]:checked").each(function () {

      var task_details = {};
      var row = $(this).closest("tr")[0];
      // console.log(size);
      var i;
      for(i=0;i<size;i++){

          var header= task_head[i];
          task_details[header] = row.cells[i+1].innerHTML;
      }
      selected_tasks.push(task_details);

  });
var ttype1=ttype;
// console.log(selected_tasks);
// console.log(ttype1);
var length=selected_tasks.length;

if(length){
  var type="39";

  $.ajax({
    url: "updatetask1.php",
    type: "POST",

    data: {
      type: type,
      ttype:ttype1,
      alltasksteps:selected_tasks
    },
    cache: false,
    success: function(dataResult) {

      // console. log(dataResult);
      var dataResult = JSON.parse(dataResult);
      // console. log(dataResult);
      load_tsteps(ttype1);


},
  error: function(e){

   console.log(e);
   console.log("Error");
}
});

}
else{
  $("#error_delete").show();
  $("#error_delete").html("Select at least one task step to delete it");
}

});

$('#addbtn').on('click', function() {
  $("#success_add").hide();
  $("#error_add").hide();

  var selected_tasks= new Array();
  var size= task_head.length;
  $(".task_step_table2 tbody input[type=checkbox]:checked").each(function () {

      var task_details = {};
      var row = $(this).closest("tr")[0];
      // console.log(size);
      var i;
      for(i=0;i<size;i++){

          var header= task_head[i];
          task_details[header] = row.cells[i+1].innerHTML;
      }
      selected_tasks.push(task_details);

  });
var ttype1=ttype;
// console.log(selected_tasks);
// console.log(ttype1);
var length=selected_tasks.length;

if(length){
  var type="40";

  $.ajax({
    url: "updatetask1.php",
    type: "POST",

    data: {
      type: type,
      ttype:ttype1,
      alltasksteps:selected_tasks
    },
    cache: false,
    success: function(dataResult) {

      // console. log(dataResult);
      var dataResult = JSON.parse(dataResult);
      // console. log(dataResult);
      load_tsteps(ttype1);

},
  error: function(e){

   console.log(e);
   console.log("Error");
}
});

}
else{
  $("#error_add").show();
  $("#error_add").html("Select at least one task step to delete it");
}

});

});
