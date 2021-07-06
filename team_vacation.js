function takeaction(vguid,createdfor,vstart,vend,vreason){
  console.log("Inside take action function");

  $('#approve_reject_modal').modal({backdrop: 'static', keyboard: false}) ;
  $('#vguid').val(vguid);
  $('#createdfor').val(createdfor);
  $('#vstart').val(vstart);
  $('#vend').val(vend);
  $('#vreason').val(vreason);
  $('#vremark_action').val("");
  $('.approve_vacation').prop('disabled', false);
  $('.reject_vacation').prop('disabled', false);

  $("#success_action").hide();
  $("#error_action").hide();
}

$(document).ready(function() {
  $('.close1').on('click',function(){
  // window.location.reload();
  loadtable();

  });

function loadtable()
{  var type="13";
  $.ajax({
  url: "updatetask1.php",
  type:"POST",
  data:{
  type:type


  },
  cache: false,
  success:function(dataResult){
    //console.log(dataResult);
    var dataResult = JSON.parse(dataResult);
    console.log(dataResult);
    $("#tbody_team_vacation").empty();
    $("#tbody_team_vacation_appr").empty();
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' +  dd  ;
    console.log("Today's date is: "+today);

    // teamvacation_table
    // teamvacation_appr_table
    var table1 = document.getElementById("tbody_team_vacation");
    var table2 = document.getElementById("tbody_team_vacation_appr");
    //table.className = "table table-hover";
      $(dataResult).each(function (index, item) {
        var d1 = Date.parse(today);
        var d2 = Date.parse(item.vend);

      if(item.action=="" )
      {
       var remark=item.vremark;
      row = table1.insertRow(table1.rows.length);
      row.className = "row_vacation_table";

      var i=0;
      var newcell = row.insertCell(i);
      newcell.innerHTML =item.vguid;
      newcell.className = "vguid_vacation_table";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.createdfor_id;
      newcell.className = "createdfor_vacation_table";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.createdfor;
      //newcell.className = "tseqid23";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.vstart;
      //newcell.className = "tseqid23";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.vend;
      //newcell.className = "tseqid23";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.vreason;
      //newcell.className = "tseqid23";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML="";
      var length_r= remark.length;

        $(remark).each(function (index, item1){
        newcell.innerHTML = newcell.innerHTML+"["+item1.updatedon+", "+item1.updatedat+", <b>"+item1.updatedby_name+"</b> ]"+"<br>"+
        item1.sub_vremark+"<br><br>";
      });
      newcell.className = "vremark_format";


      // i++;
      // newcell = row.insertCell(i);
      // newcell.innerHTML = item.action;

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = "<button class='btn btn-secondary' onclick='takeaction(\""+ item.vguid +"\",\"" + item.createdfor +"\",\"" + item.vstart +"\",\"" + item.vend +"\",\"" + item.vreason +"\")'>Take Action</button>";
      newcell.className = "action_button";
    }
    else{

if(d2>=d1){      var remark=item.vremark;
     row2 = table2.insertRow(table2.rows.length);
     row2.className = "row_vacation_table";

     var i=0;
     var newcell = row2.insertCell(i);
     newcell.innerHTML =item.vguid;
     newcell.className = "vguid_vacation_table";

     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.createdfor_id;
     newcell.className = "createdfor_vacation_table";


     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.createdfor;
     //newcell.className = "tseqid23";

     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.vstart;
     //newcell.className = "tseqid23";

     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.vend;
     //newcell.className = "tseqid23";

     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.vreason;
     //newcell.className = "tseqid23";

     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML="";
     var length_r= remark.length;

       $(remark).each(function (index, item1){
       newcell.innerHTML = newcell.innerHTML+"["+item1.updatedon+", "+item1.updatedat+", <b>"+item1.updatedby_name+"</b> ]"+"<br>"+
       item1.sub_vremark+"<br><br>";
     });
     newcell.className = "vremark_format";


     i++;
     newcell = row2.insertCell(i);
     newcell.innerHTML = item.action;}


    }


      });
  }
  });
}
loadtable();

  $('.approve_vacation').on('click',function(){
    event.preventDefault();
     var vguid = $('#vguid').val();
     var vremark_action = $('#vremark_action').val();
     var type= "14";


     $.ajax({
       url: "updatetask1.php",
       type: "POST",

       data:    {
             type: type,
             vguid: vguid,
             vremark_action: vremark_action

           },
       cache: false,
       success: function(dataResult){
         console.log(dataResult);
         var dataResult = JSON.parse(dataResult);
         console.log(dataResult);

         if(dataResult.statuscode=="s"){
            console. log("display s message");

            $('.approve_vacation').prop('disabled', true);
            $('.reject_vacation').prop('disabled', true);

            $("#error_action").hide();
            $("#success_action").show();
            $('#success_action').html(dataResult.description);

          }
          else {

            console. log("display e message");

            $('.approve_vacation').prop('disabled', true);
            $('.reject_vacation').prop('disabled', true);
            $("#success_action").hide();
            $("#error_action").show();
            $('#error_action').html(dataResult.description);

          }

       }

     });


  });
reject_vacation

$('.reject_vacation').on('click',function(){
  event.preventDefault();
   var vguid = $('#vguid').val();
   var type= "15";
   var vremark_action=$('#vremark_action').val();


   $.ajax({
     url: "updatetask1.php",
     type: "POST",


     data:    {
           type: type,
           vguid: vguid,
           vremark_action:vremark_action

         },
     cache: false,
     success: function(dataResult){
       console.log(dataResult);
       var dataResult = JSON.parse(dataResult);
       console.log(dataResult);

       if(dataResult.statuscode=="s"){
          console. log("display s message");

          $('.approve_vacation').prop('disabled', true);
          $('.reject_vacation').prop('disabled', true);

          $("#error_action").hide();
          $("#success_action").show();
          $('#success_action').html(dataResult.description);

        }
        else {

          console. log("display e message");

          $('.approve_vacation').prop('disabled', true);
          $('.reject_vacation').prop('disabled', true);
          $("#success_action").hide();
          $("#error_action").show();
          $('#error_action').html(dataResult.description);

        }

     }

   });


});


});
