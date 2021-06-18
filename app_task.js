$(document).ready(function() {
  //console. log("1");
	$('#createtask').on('click', function() {
    //console. log("2");
    var tid = $('#tid').val();
    var tdescription = $('#tdescription').val();
    var ttype = $('#ttype').val();
    var assignto = $('#assignto').val();
    var pstart = $('#pstart').val();
    var pend = $('#pend').val();
    var peffort = $('#peffort').val();
    var astart = $('#astart').val();
    var aend = $('#aend').val();
    var aeffort = $('#aeffort').val();
    var comment = $('#comment').val();

    console. log("4");
    if((tid!="" && tdescription!="" && pstart!="" && pend!="" && peffort!="") || (tid!="" && tdescription!="" && pstart=="" && pend=="" && peffort=="")  ){
      console. log("3");

      $.ajax({
				url: "task.php",
				type: "POST",
        //dataType: "json",
			  data:    {
              type: 1,
            	tid: tid,
            	tdescription: tdescription,
            	ttype: ttype,
            	assignto: assignto,
              pstart: pstart,
              pend: pend,
              peffort: peffort,
              astart: astart,
              aend: aend,
              aeffort: aeffort,
            	comment: comment
            },

				cache: false,
				success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          console.log("Hello");
          console.log(dataResult);
					if(dataResult.statuscode=="s"){
						$("#createtask").removeAttr("disabled");
						$('#task_form').find('input:text').val('');

            alert(dataResult.description);
						// $("#success").show();
						// $('#success').html('Successfully created task!');

        }
        else {
          // $("#error").show();
          // $('#error').html('Task Creation Unsuccessful');
          alert(dataResult.description);
        }
      }
      });
    }
    else {
        alert('Please fill all the required field !');
        //console. log("4");
      }
  });
    //console. log("5");
});
