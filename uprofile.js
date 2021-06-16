$(document).ready(function() {

//console.log("alert1");
$('#userprofile').on('click', function() {
    //console.log("alert2");
  $("#update_form").show();
  $("#update_password").hide();
});
$('#upassword').on('click', function() {
    //console.log("alert3");
  $("#update_password").show();
  $("#update_form").hide();

});
});
