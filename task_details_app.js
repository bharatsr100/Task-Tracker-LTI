function exporttasktopdf(){
// var doc = new jsPDF({unit: 'mm', format: [600,300], orientation: 'landscape'});
// var elementHTML = $('#task_details_admin').html();
// var specialElementHandlers = {
//     '#task_details_admin': function (element, renderer) {
//         return true;
//     }
// };
// doc.fromHTML(elementHTML, 15, 15, {
//     // 'width': 170,
//     'elementHandlers': specialElementHandlers
// });
//
// doc.save('task_details.pdf');


//for screenshot of screen
// var w = window.innerWidth;
// var h = window.innerHeight;
//
html2pdf($('#task_details_admin').get(0), {
   margin:       1,
   filename:     'task_report.pdf',
   image:        { type: 'jpeg', quality: 1 },
   // html2canvas:  { dpi: 200, letterRendering: true },
   html2canvas:  { scale:3 },
   jsPDF:        { unit: 'mm', format: [340,350], orientation: 'portrait' }
   // jsPDF:        { unit: 'mm', format: [280,300], orientation: 'landscape' }
});



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
          // console.log(task);
          var pstart= task.pstart;
          var pend= task.pend;
          var astart= task.astart;
          var aend= task.aend;
          var peffort= (task.peffort/480).toFixed(2);
          var aeffort= (task.aeffort/480).toFixed(2);

          if(pstart=="0000-00-00") pstart="";
          if(pend=="0000-00-00") pend="";
          if(astart=="0000-00-00") astart="";
          if(aend=="0000-00-00") aend="";
          if(peffort==0) peffort="";
          if(aeffort==0) aeffort="";

          $("#tbody_tstep_table").empty();
          $("#tstep_table").show();

          // $("#headone").html("Task Details: "+task.tid);
          $('#tid').html(task.tid);
          $('#tstepdescription').html(task.tstepdescription);
          $('#pstart').html(pstart);
          $('#pend').html(pend);
          $('#peffort').html(peffort);
          $('#astart').html(astart);
          $('#aend').html(aend);
          $('#aeffort').html(aeffort);

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
