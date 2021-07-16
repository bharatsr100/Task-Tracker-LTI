var task_head=["ttype","ttype_desc"];
function select_all(){

  		$('.selectcolumn input').prop('checked', true);

      if(!$('#selectcolumn1 input').prop("checked")) {
      		$('.selectcolumn input').prop('checked', false);
      }
  }

function select_row(id) {
  var cellid="#check"+id+"id input";

  		if(!$(cellid).prop("checked")) {
          $('#selectcolumn1 input').prop('checked', false);
      } else {
      	 if ($('.selectcolumn input:checked').length === $('.selectcolumn input').length) {
             $('#selectcolumn1 input').prop('checked', true);
         }
      }
}

$(document).ready(function() {
  $('.close1').on('click', function() {
      loadtask_step_tables();
      // window.location.reload();
    });

  $('.createbtn').on('click', function() {
    $('#createtasktypemodal').modal({
      backdrop: 'static',
      keyboard: false
    });
    $("#task_type_form")[0].reset();
    $("#errortask").hide();
    $("#successtask").hide();
  });


    $('#createtasktype').on('click', function() {
      event.preventDefault();
      var ttype = $('#ttype').val();
      var ttytpe_desc = $('#ttytpe_desc').val();
      var type = "34";
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data: {
          type: type,
          ttype: ttype,
          ttytpe_desc: ttytpe_desc
        },
        cache: false,
        success: function(dataResult) {

          // console. log(dataResult);
          var dataResult = JSON.parse(dataResult);
          // console. log(dataResult);

          if (dataResult.statuscode == "s") {
            // $(".createtaskstep").prop('disabled', true);
            $("#task_type_form")[0].reset();

            $("#errortask").hide();
            $("#successtask").show();
            $('#successtask').html(dataResult.description);

          } else {
            // $(".createtaskstep").prop('disabled', false);
            $("#successtask").hide();
            $("#errortask").show();
            $('#errortask').html(dataResult.description);
          }

    },
      error: function(e){

       console.log(e);
       console.log("Error");
    }


    });


    });

    function loadtask_step_tables(){
      // event.preventDefault();
      var type="35";
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data: {
          type: type
        },
        cache: false,
        success: function(dataResult) {

          // console. log(dataResult);
          var dataResult = JSON.parse(dataResult);
          // console. log(dataResult);

          $("#task_step_table_tbody").empty();
          var table = document.getElementById("task_step_table_tbody");
          var j=0;
           $(dataResult).each(function (index, item) {
             j++;
             var ttype=item.ttype;
             var ttype_desc= item.ttype_desc;

             var tr = document.createElement('tr');
             table.appendChild(tr);

             var newcell = document.createElement('td');
             newcell.innerHTML = "<input type='checkbox' onclick='select_row(\""+j+"\")'/>&nbsp;";
             newcell.className="selectcolumn";
             newcell.id= "check"+j+"id";
             tr.appendChild(newcell);

             var newcell = document.createElement('td');
             newcell.innerHTML =ttype;
             tr.appendChild(newcell);

             var newcell = document.createElement('td');
             newcell.innerHTML =ttype_desc;
             tr.appendChild(newcell);

             var newcell = document.createElement('td');
             newcell.innerHTML ="";
             newcell.id= "remark"+j;
             newcell.className= "remarkcolumn";
             tr.appendChild(newcell);

           });


    },
      error: function(e){

       console.log(e);
       console.log("Error");
    }


    });


    }
    loadtask_step_tables();

    $('#deletebtn').on('click', function() {
      $("#success_deleteorcheck").hide();
      $("#error_deleteorcheck").hide();
      $("#deletebtn").prop('disabled', true);
      // console.log("hello delete function");
      var selected_tasks= new Array();
      var size= task_head.length;
      $(".task_step_table tbody input[type=checkbox]:checked").each(function () {

          var task_details = {};
          var row = $(this).closest("tr")[0];
          console.log(size);
          var i;
          for(i=0;i<size;i++){

              var header= task_head[i];
              task_details[header] = row.cells[i+1].innerHTML;
          }
          task_details["remark_id"] = "#"+row.cells[i+1].id;
          selected_tasks.push(task_details);

      });

    console.log(selected_tasks);
    var length=selected_tasks.length;
    if(length){
      var type="36";
      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data: {
          type: type,
          type:type,
          alltasksteps:selected_tasks
        },
        cache: false,
        success: function(dataResult) {

          // console. log(dataResult);
          var dataResult = JSON.parse(dataResult);
          // console. log(dataResult);
          $(dataResult).each(function (index, item) {
            var cell_id=item.remark_id;
            $(cell_id).html((item.statuscode).charAt(0).toUpperCase() +": "+ item.description);
            var status=item.statuscode;

            if(status=="s"){
               $(cell_id).css('color', 'green');
            }
            else{
              $(cell_id).css('color', 'red');
            }
          });


    },
      error: function(e){

       console.log(e);
       console.log("Error");
    }
    });

    }
    else{
      $("#error_deleteorcheck").show();
      $("#error_deleteorcheck").html("Select at least one task to delete it");
    }


    });

});
