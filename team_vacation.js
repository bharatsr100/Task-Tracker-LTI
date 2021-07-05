$(document).ready(function() {

  var type="13";
  $.ajax({
  url: "updatetask1.php",
  type:"POST",
  data:{
  type:type


  },
  cache: false,
  success:function(dataResult){
    // console.log(dataResult);
    var dataResult = JSON.parse(dataResult);
    console.log(dataResult);
    $("#tbody_team_vacation").empty();

    var table = document.getElementById("teamvacation_table");
    //table.className = "table table-hover";
      $(dataResult).each(function (index, item) {
      var remark=item.vremark;

      row = table.insertRow(table.rows.length);
      row.className = "row_vacation_table";

      var i=0;
      var newcell = row.insertCell(i);
      newcell.innerHTML =item.vguid;

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.createdfor_id;
      //newcell.className = "tseqid23";

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



      //updatedby_name


      //newcell.innerHTML = remark[0].sub_vremark;
      //newcell.className = "tseqid23";

      i++;
      newcell = row.insertCell(i);
      newcell.innerHTML = item.action;
      //newcell.className = "tseqid23";

      });
  }
  });




});
