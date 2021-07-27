$(document).ready(function() {
var uguid=$('#uguid1').val();
// console.log(uguid);

$('#userprofile').on('click', function() {
  $("#head_profile").html("Edit Profile");
  $("#update_form").show();
  $("#update_password").hide();
  $("#success").hide();
  $("#error").hide();
  $('#userprofile').css('border','2px solid black');
  $('#upassword').css('border','none');

});
$('#upassword').on('click', function() {
    //console.log("alert3");
  $("#head_profile").html("Change Password");
  $("#update_password").show();
  $("#update_form").hide();
  $("#success").hide();
  $("#error").hide();
  $('#upassword').css('border','2px solid black');
  $('#userprofile').css('border','none');

});
var type="44";
$.ajax({
  url:"updatetask1.php",
  type:"POST",
  data:{
    type:type,
    uguid:uguid
  },
  cache: false,
  success: function(dataResult){
    // console.log(dataResult);
    var dataResult= JSON.parse(dataResult);
    // console.log(dataResult);
    $('#uname').val(dataResult['uname']);
    $('#shortname').val(dataResult['shortname']);
    $('#employeeid').val(dataResult['employeeid']);
    $('#contact').val(dataResult['contact']);
    $('#e_emailid').val(dataResult['e_emailid']);
    $('#p_emailid').val(dataResult['p_emailid']);
  }
});

$('#update').on('click',function(){
// console.log("Hello");

var uname=$('#uname').val();
var shortname=$('#shortname').val();
var employeeid=$('#employeeid').val();
var e_emailid=$("#e_emailid").val();
var p_emailid=$('#p_emailid').val();
var contact=$('#contact').val();
var password=$('#password').val();

// console.log(uguid+" "+uname+" "+shortname+" "+employeeid+" "+ e_emailid+" "+p_emailid+" "+contact+" "+password);
var type="45";
$.ajax({
  url:"updatetask1.php",
  type:"POST",
  data:{
    type:type,
    uguid:uguid,
    uname:uname,
    shortname:shortname,
    employeeid:employeeid,
    e_emailid:e_emailid,
    p_emailid:p_emailid,
    contact:contact,
    password:password

  },
  cache:false,
  success: function(dataResult){
    // console.log(dataResult);
    var dataResult=JSON.parse(dataResult);
    console.log(dataResult);
    if(dataResult.statuscode=="s"){
      $("#success").show();
      $("#error").hide();
      $("#success").html(dataResult.description);
    }
    else{
      $("#success").hide();
      $("#error").show();
      $("#error").html(dataResult.description);
    }


  }
});

});

$('#u_password').on('click',function(){
// console.log("Hello");
var opassword= $('#opassword').val();
var npassword= $('#npassword').val();
var ncpassword= $('#ncpassword').val();
var type="46";
// console.log(opassword+" "+npassword+" "+ncpassword+" "+uguid);
$.ajax({
  url:"updatetask1.php",
  type:"POST",
  data:{
    type:type,
    uguid:uguid,
    opassword:opassword,
    npassword:npassword,
    ncpassword:ncpassword
  },
  success: function(dataResult){
    // console.log(dataResult);
    var dataResult= JSON.parse(dataResult);
    // console.log(dataResult);
    if(dataResult.statuscode=="s"){
      $("#success").show();
      $("#error").hide();
      $("#success").html(dataResult.description);
    }
    else{
      $("#success").hide();
      $("#error").show();
      $("#error").html(dataResult.description);
    }

  },
  error: function(e){

    console.log(e);
    console.log("Error");
  }

});

});


});
