$(document).ready(function() {
var ttype = sessionStorage.getItem("ttype");
var ttype_desc = sessionStorage.getItem("ttype_desc");
$("#head_tsteps").html("Mapped Task Steps: <b>"+ttype_desc+"</b> ("+ttype+")");
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
            console. log(dataResult);

          },
          error: function(e){

           console.log(e);
           console.log("Error");
        }
        });


}
load_tsteps(ttype);
});
