$(document).ready(function() {

	$('.stpbtn').on('click',function(){




	  $tr= $(this).closest('tr');
	  var data=$tr.children("td").map(function(){
	  return $(this).text();
	  }).get();

		console.log(data[0]);

	  $('#tguid2').val(data[0]);
	  $('#stepmodal').modal('show');
	//console.log(data[0]);
		var tguidstep= data[0];
		//console.log(tguidstep);
	        $.ajax({
	      url: "tasksteps.php",
	      type:"POST",
	      data:{
	        tguidstep:tguidstep


	      },
	      cache: false,
	      success:function(dataResult){
	      var dataResult = JSON.parse(dataResult);
	      //console.log(dataResult);
				$("#tbodystep").empty();
				$(dataResult).each(function (index, item) {
                    console.log(item);
                    //console.log(receipts[index]);

                    $('#tsteps tbody').append(
                        '<tr><td >' + item.tguid +
												'</td><td >' + item.tsequenceid +
                        '</td><td>' + item.tstepdescription +
                        '</td><td>' + item.pstart +
                        '</td><td>' + item.pend +
												'</td><td>' + item.peffort +
												'</td><td>' + item.astart +
												'</td><td>' + item.aend +
												'</td><td>' + item.aeffort +
												'</td><td>' + item.tstage +
                        '</td></tr>'
                    )

                });



	      }
	      });

	});

	  $('[data-toggle="tooltip"]').tooltip();

		$('.editbtn').on('click',function(){
			$tr= $(this).closest('tr');
			var data=$tr.children("td").map(function(){
			return $(this).text();
			}).get();



			if(data[4]!=""){

			alert("Task is already planned please contact your admin");
			 }

			 else{
				 $('#editmodal').modal('show');

				 $('#tid1').val(data[1]);
				 $('#tguid1').val(data[0]);

				 $('#tdescription1').val(data[2]);
				 $('#ttype1').val(data[3]);

			 }

		});

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
