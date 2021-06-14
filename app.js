$(document).ready(function() {
	$('#login').on('click', function() {
		$("#login_form").show();
		$("#register_form").hide();
	});
	$('#register').on('click', function() {
		$("#register_form").show();
		$("#login_form").hide();
	});

	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var uname = $('#uname').val();
    var shortname = $('#shortname').val();
    var employeeid = $('#employeeid').val();
    var contact = $('#contact').val();
    var e_emailid = $('#e_emailid').val();
    var p_emailid = $('#p_emailid').val();
    var password = $('#password').val();
    var cpassword = $('#cpassword').val();
    var type=1;
    // {
    // 	type: 1,
    // 	uname: uname,
    // 	shortname: shortname,
    // 	employeeid: employeeid,
    // 	contact: contact,
    //   e_emailid: e_emailid,
    //   p_emailid: p_emailid,
    //   password: password,
    // 	cpassword: cpassword
    // },
    //$('#register_form').serialize() + "&type=" + type,


		if(uname!="" && shortname!="" && employeeid!="" && contact!="" && e_emailid!="" && p_emailid!="" && password!="" && cpassword!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
        //dataType: "json",
			  data:    {
            	type: 1,
            	uname: uname,
            	shortname: shortname,
            	employeeid: employeeid,
            	contact: contact,
              e_emailid: e_emailid,
              p_emailid: p_emailid,
              password: password,
            	cpassword: cpassword
            },

				cache: false,
				success: function(dataResult){

					var dataResult = JSON.parse(dataResult);
          console.log(dataResult);
					if(dataResult.statuscode=="s"){
						$("#butsave").removeAttr("disabled");
						$('#register_form').find('input:text').val('');
						$("#success").show();
						$('#success').html('Registration successful !');
					}
					else {
						$("#error").show();
						$('#error').html(dataResult.description);
					}

				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
	$('#butlogin').on('click', function() {
    //console.log("Hii outside");

		var userid = $('#userid').val();
		var password_log = $('#password_log').val();
		if(userid!="" && password_log!="" ){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					type:2,
					userid: userid,
					password_log: password_log
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
          console.log(dataResult);

					if(dataResult.statuscode=="s"){
						location.href = "welcome.php";
					}
					else {
						$("#error").show();
						$('#error').html('Invalid User ID or Password !');
					}

				}
			});
		}
		else{
      console.log("Hii inside");
			alert('Please fill all the field !');
		}
	});

		$('#f_password').on('click', function() {
			location.href = "fpindex.php";
		});
});
