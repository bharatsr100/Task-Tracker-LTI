var alltasks;
var task_head;
var table1;
var task_head_user={};



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
          // console.log(dataResult);
          $(dataResult).each(function (index, item) {
            var cell_id="#"+item.remark_id;
            $(cell_id).html((item.statuscode).charAt(0).toUpperCase() +": "+ item.description);
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
                [1, "asc"]
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

// console.log(selected_tasks);
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
          // console.log(dataResult);

          $(dataResult).each(function (index, item) {
            var cell_id="#"+item.remark_id;
            $(cell_id).html((item.statuscode).charAt(0).toUpperCase() +": "+ item.description);
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
                [1, "asc"]
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
    // task_head_user
    task_head_user["tid"]="Task ID";
    task_head_user["s_no"]="S No.";
    task_head_user["tdescription"]="Task Description";
    task_head_user["ttype"]="Task Type";
    task_head_user["createdon"]="Created On";
    task_head_user["createdat"]="Created At";
    task_head_user["createdby"]="Created By";
    task_head_user["priority"]="Priority";
    task_head_user["tstage"]="Task Phase";
    task_head_user["assignto"]="Assigned To";
    task_head_user["pstart"]="Planned Start";
    task_head_user["pend"]="Planned End";
    task_head_user["peffort"]="Planned Effort";
    task_head_user["astart"]="Actual Start";
    task_head_user["aend"]="Actual End";
    task_head_user["aeffort"]="Actual Effort";
    task_head_user["tstepdescription"]="Task Step Description";

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
                            header_cells.push("s_no");
                        for (var j = 0; j < cells.length; j++) {
                            header_cells.push(cells[j]);
                        }

                        header_cells.push("remark_id");
                        task_head=header_cells;
                        // console.log(header_cells);
                    }
                    else {

                        var task_details = {};
                        task_details["s_no"] = i;
                      for (var j = 0; j < cells.length; j++) {
                            var header= header_cells[j+1];
                            task_details[header] = cells[j];
                        }
                        task_details["remark_id"] = "id"+i;
                        all_tasks.push(task_details);
                    }
                }
                // console.log(all_tasks);
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

                var cell = row.insertCell(0);
                cell.innerHTML = "<th><b><input type='checkbox' onclick='select_all()'/>&nbsp;</b></th>";
                cell.id="selectcolumn1";


                var j;
                 for ( j = 1; j <= header_cells.length-1; j++)
                {
                var cell = row.insertCell(j);
                var short_head=header_cells[j-1];
                var long_head= task_head_user[short_head];
                cell.innerHTML = "<th><b>"+long_head+"</b></th>";

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
                  newcell.innerHTML =item.s_no;
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
                      [1, "asc"]
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

  $('#downloadbtn').on('click',function(){
    // console.log("download demo file function");

    var head_demo= "tid,tdescription,ttype,createdon,createdat,priority,tstage,assignto,pstart,pend,peffort,astart,aend,aeffort";
    var sample_demo="T001,Sample Task C1,TC1,2021-07-01,01:01:01,5-Very Low,In Progress,PS789,2021-07-02,2021-07-13,12,0000-00-00,0000-00-00,0";
    var csv = '';
    csv += head_demo + '\r\n';
    csv += sample_demo;
    var reporttitle="Task";
    var fileName = "Demo_";
    fileName += reporttitle.replace(/ /g,"_");

    var uri = 'data:text/csv;charset=utf-8,' + escape(csv);
    var link = document.createElement("a");
   link.href = uri;
   link.style = "visibility:hidden";
   link.download = fileName + ".csv";
   document.body.appendChild(link);
   link.click();
   document.body.removeChild(link);
  });




});
