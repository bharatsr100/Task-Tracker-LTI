function taskstep_mapdetails(ttype,ttype_desc){
console.log(ttype);
sessionStorage.setItem("ttype", ttype);
sessionStorage.setItem("ttype_desc", ttype_desc);
location.href = "tsteps_mapped.php";
}



$(document).ready(function() {
function loadtask_map_tables(){

  var type="37";
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

      $("#task_map_table_tbody").empty();
      var table = document.getElementById("task_map_table_tbody");
      var j=0;
      $(dataResult).each(function (index, item) {
        j++;
        var ttype=item.ttype;
        var ttype_desc= item.ttype_desc;

        var tr = document.createElement('tr');
        table.appendChild(tr);

        var newcell = document.createElement('td');
        newcell.innerHTML =ttype;
        tr.appendChild(newcell);

        var newcell = document.createElement('td');
        newcell.innerHTML ='<button type="button" onclick="taskstep_mapdetails(\''+ ttype +'\',\''+ ttype_desc +'\')" class="btn btn-link t_descr_button">'+ttype_desc+'</button>';;
        tr.appendChild(newcell);


      });
    },
    error: function(e){

     console.log(e);
     console.log("Error");
  }

      });
}
loadtask_map_tables();

});
