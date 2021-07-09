function exporttasktopdf(){
  var doc = new jsPDF();
  var specialElementHandlers = {
      '#editor': function (element, renderer) {
          return true;
      }
  };
// var divid="task_details_admin";
doc.fromHTML($('#task_details_admin').html(), 15, 15, {
    'width': 1000,
        'elementHandlers': specialElementHandlers
});
doc.save('task_details.pdf');

}

$(document).ready(function() {
var tguid_admin1 = sessionStorage.getItem("tguid");
function load_task_details(tguid){
// console.log("Inside task details function "+tguid);
var type="19";
$.ajax({
  url: "updatetask1.php",
  type: "POST",
  data:    {
        type: type,
        tguid: tguid },
        cache: false,
        success: function(dataResult){
          // console.log(dataResult);
          var task = JSON.parse(dataResult);
          console.log(task);
          $("#tbody_tstep_table").empty();
          $("#tstep_table").show();

          $("#headone").html("Task Details: "+task.tid);
          $('#tid').html(task.tid);
          $('#tstepdescription').html(task.tstepdescription);
          $('#pstart').html(task.pstart);
          $('#pend').html(task.pend);
          $('#peffort').html((task.peffort/480).toFixed(2));

          var tasksteps= task.tsteps;
          var table1 = document.getElementById("tbody_tstep_table");
          $(tasksteps).each(function (index, item) {
              row = table1.insertRow(table1.rows.length);


              var i=0;
              var newcell = row.insertCell(i);
              newcell.innerHTML =item.assignto;

              i++;
              newcell = row.insertCell(i);
              newcell.innerHTML = item.tstepdescription;

              i++;
              newcell = row.insertCell(i);
              if(item.pstart!="0000-00-00") newcell.innerHTML = item.pstart;
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              if(item.pend!="0000-00-00") newcell.innerHTML = item.pend;
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              if(item.peffort!=0)newcell.innerHTML = (item.peffort/480).toFixed(2);
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              if(item.astart!="0000-00-00") newcell.innerHTML = item.astart;
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              if(item.aend!="0000-00-00") newcell.innerHTML = item.aend;
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              if(item.aeffort!=0) newcell.innerHTML = (item.aeffort/480).toFixed(2);
              else newcell.innerHTML="";

              i++;
              newcell = row.insertCell(i);
              newcell.innerHTML = item.tstatus;

          });

          var comments= task.comments;
          const allcomments = document.getElementById('allcomments_div');
          $(comments).each(function (index, item) {
            var comment_fulldiv= document.createElement('div');
            comment_fulldiv.classList.add('comments_full_div');



            var commentdiv1= document.createElement('div');

            var daydiv= document.createElement('div');
            daydiv.classList.add('date_div');
            daydiv.innerText = item.updatedon;
            comment_fulldiv.appendChild(daydiv);

            var userdiv= document.createElement('div');
            userdiv.classList.add('name_div');
            userdiv.innerText = item.updatedby;
            comment_fulldiv.appendChild(userdiv);


            commentdiv1.classList.add('comment_div');
            commentdiv1.innerText = item.comment;
            comment_fulldiv.appendChild(commentdiv1);

            allcomments.appendChild(comment_fulldiv);


          });




        }
        });

}
load_task_details(tguid_admin1);
});
