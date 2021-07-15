var alltasks;
var task_head;
var table1;


  function upload_data(){

    $("#success_uploadorcheck").hide();
    $("#error_uploadorcheck").hide();
  var selected_tasks= new Array();
  // var size=$(".mass_task_table").find("tr:first td").length-1;
  var size= task_head.length-1;
  $(".mass_task_table tbody input[type=checkbox]:checked").each(function () {

      var task_details = {};
      var row = $(this).closest("tr")[0];
      console.log(size);
      var i;
      for(i=1;i<=size;i++){

          var header= task_head[i-1];
          task_details[header] = row.cells[i].innerHTML;
      }
      var header= task_head[i-1];

      var tid=task_details.tid;
      // console.log(tguid);

      var result = alltasks.filter(obj => {
      return obj.tid === tid
    })
    // console.log(result);

      task_details[header] = result[0].remark_id;
      selected_tasks.push(task_details);

  });

// console.log(selected_tasks);
var length=selected_tasks.length;

if(length){     var type="27";

     $.ajax({
        type: "POST",
        // dataType: "json",
        url: "updatetask1.php",
        data: {
          type:type,
          alltasks:selected_tasks
        },
        // contentType: "application/json; charset=utf-8",
        success: function(dataResult){

          // console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
          // $('#successedittask').html(dataResult.description);
          $(dataResult).each(function (index, item) {
            var cell_id="#"+item.remark_id;
            $(cell_id).html(item.description);
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
  $("#error_uploadorcheck").show();
  $("#error_uploadorcheck").html("Select at least one task to save it");
}



  }


  function check_data(){
    $("#success_uploadorcheck").hide();
    $("#error_uploadorcheck").hide();
  var selected_tasks= new Array();
  var size= task_head.length-1;
  $(".mass_task_table tbody input[type=checkbox]:checked").each(function () {
      var task_details = {};
      var row = $(this).closest("tr")[0];
      console.log(size);
      var i;
      for(i=1;i<=size;i++){
          var header= task_head[i-1];
          task_details[header] = row.cells[i].innerHTML;
      }
      var header= task_head[i-1];

      var tid=task_details.tid;
      var result = alltasks.filter(obj => {
      return obj.tid === tid
    })

      task_details[header] = result[0].remark_id;
      selected_tasks.push(task_details);

  });

console.log(selected_tasks);
var length=selected_tasks.length;


  if(length){     var type="28";

     $.ajax({
        type: "POST",
        url: "updatetask1.php",
        data: {
          type:type,
          alltasks:selected_tasks
        },
        success: function(dataResult){

          // console.log(dataResult);
          var dataResult = JSON.parse(dataResult);
          console.log(dataResult);

          $(dataResult).each(function (index, item) {
            var cell_id="#"+item.remark_id;
            $(cell_id).html(item.statuscode +": "+ item.description);
            var status=item.statuscode;
            if(status=="s"){
               $(cell_id).css('color', 'green');
            }
            else{
              $(cell_id).css('color', 'red');
            }

          });
          table1.destroy();
          table1=$('#mass_task_table1').DataTable({

              "paging": false,
              "ordering": true,
              "info": false,
              "columnDefs": [
                    {
                        orderable: false,
                        targets: [0]
                    }
                ],
              "order": [
                [2, "asc"]
              ]

            });

        },
           error: function(e){

          console.log(e);
          console.log("Error");
      }

});
}
else{
$("#error_uploadorcheck").show();
$("#error_uploadorcheck").html("Select at least one task to check it");
}



  }

function select_all(){

  		$('.selectcolumn input').prop('checked', true);

      if(!$('#selectcolumn1 input').prop("checked")) {
      		$('.selectcolumn input').prop('checked', false);
      }
  }

function select_row(id) {
  console.log("Hello2");
  console.log(id);
  var cellid="#check"+id+"id input";

  		if(!$(cellid).prop("checked")) {
          $('#selectcolumn1 input').prop('checked', false);
      } else {
      	 if ($('.selectcolumn input:checked').length === $('.selectcolumn input').length) {
             $('#selectcolumn1 input').prop('checked', true);
         }
      }
}
  $('#selectcolumn1').click(function(){
    console.log("Hello3");
  });
$(document).ready(function() {
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

  $('#uploadbtn').on('click',function(){

    $("#success_display").hide();
    $("#error_display").hide();


      var fileUpload = document.getElementById("upload_masstask");
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
      if (regex.test(fileUpload.value.toLowerCase())) {
          if (typeof (FileReader) != "undefined") {
              var reader = new FileReader();
              reader.onload = function (e) {
                var all_tasks = new Array();
                var rows = e.target.result.split("\r\n");
                var header_cells=new Array();
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].split(",");

                    if(i==0){
                        for (var j = 0; j < cells.length; j++) {
                            header_cells.push(cells[j]);
                        }

                        header_cells.push("remark_id");
                        task_head=header_cells;
                        console.log(header_cells);
                    }
                    else {

                        var task_details = {};

                        for (var j = 0; j < cells.length; j++) {
                            var header= header_cells[j];
                            task_details[header] = cells[j];
                        }
                        task_details["remark_id"] = "id"+i;
                        all_tasks.push(task_details);
                    }
                }
                console.log(all_tasks);
                var json_tasks = JSON.stringify(all_tasks);
                // sessionStorage.setItem("json_tasks", json_tasks);
                alltasks= all_tasks;
                // var length= customers.length;
                // console.log(length);
                var table = document.createElement("table");
                table.id="mass_task_table1";


                table.className = "table table-hover mass_task_table";
                var table_head=  table.createTHead();
                var row = table_head.insertRow(0);
                // var row = table.insertRow(0);

                // var select_all= document.createElement("input");
                // select_all.innerHTML = "<input type='checkbox' id='selectAll' onclick='select_all()'/>&nbsp;&nbsp;Select All ";
                // select_all.setAttribute('type',"checkbox");
                // select_all.setAttribute('id',"selectAll");

                var cell = row.insertCell(0);
                //
                // id='selectAll' onclick='select_all()'
                cell.innerHTML = "<th><b><input type='checkbox' onclick='select_all()'/>&nbsp;</b></th>";
                cell.id="selectcolumn1";
                // onclick='select_all()'
                  // $("#selectcolumn").css({'background-color': 'red','width':'300px'});
                // cell.innerHTML = "<td><input type='checkbox' name='name1' />&nbsp;</td>";
                // <td><input type="checkbox" name="name1" />&nbsp;</td>
                var j;
                 for ( j = 1; j <= header_cells.length-1; j++)
                {
                var cell = row.insertCell(j);
                cell.innerHTML = "<th><b>"+header_cells[j-1]+"</b></th>";

                }
                var cell = row.insertCell(j);
                cell.innerHTML ="<th><b>Remarks</b></th>";

                var tableBody = document.createElement('TBODY');
                table.appendChild(tableBody);

                var j= 0;
                $(all_tasks).each(function (index, item) {

                  var pstart= item.pstart;
                  if(pstart=="0000-00-00") pstart="";
                  var pend= item.pend;
                  if(pend=="0000-00-00") pend="";
                  var astart= item.astart;
                  if(astart=="0000-00-00") astart="";
                  var aend= item.aend;
                  if(aend=="0000-00-00") aend="";
                  var peffort= item.peffort;
                  if(peffort==0) peffort="";
                  var aeffort= item.aeffort;
                  if(aeffort==0) aeffort="";

                  j++;

                  // row = table.insertRow(j);
                  var tr = document.createElement('TR');
                  tableBody.appendChild(tr);

                  var i=0;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML = "<input type='checkbox' onclick='select_row(\""+j+"\")'/>&nbsp;";
                  newcell.className="selectcolumn";
                  newcell.id= "check"+j+"id";
                  tr.appendChild(newcell);


                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.tid;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.tdescription;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.ttype;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.createdon;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.createdat;
                  tr.appendChild(newcell);


                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.priority;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.tstage;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =item.assignto;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =pstart;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =pend;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =peffort;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =astart;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =aend;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML =aeffort;
                  tr.appendChild(newcell);

                  i++;
                  var newcell = document.createElement('TD');
                  newcell.innerHTML ="";
                  newcell.id= item.remark_id;
                  newcell.className= "remarkcolumn";
                  tr.appendChild(newcell);




                });

                $("#dvCSV").html('');
                // $("#dvCSV").append(JSON.stringify(customers));
                dvCSV.appendChild(table);


                table1=$('#mass_task_table1').DataTable({

                    "paging": false,
                    "ordering": true,
                    "info": false,
                    "columnDefs": [
                          {
                              orderable: false,
                              targets: [0]
                          }
                      ],
                    "order": [
                      [2, "asc"]
                    ]

                  });
                $("#action_buttons").show();
              }
              reader.readAsText(fileUpload.files[0]);
          } else {
            $("#error_display").show();
            $('#error_display').html("This browser does not support HTML5.");

          }
      } else {
          $("#error_display").show();
          $('#error_display').html("Please upload a valid CSV file.");
      }
  });




});
