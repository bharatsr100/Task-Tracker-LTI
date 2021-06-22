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
											var pstartn="";
											var pendn="";
											var astartn="";
											var aendn="";
											if(item.pstart=="0000-00-00" || item.pstart=="NULL" || item.pend=="null") pstartn="";
											else pstartn= item.pstart;
											if(item.pend=="0000-00-00" || item.pend=="NULL" || item.pend=="null") pendn="";
											else pendn= item.pendn;
											if(item.astart=="0000-00-00" || item.astart=="NULL" || item.astart=="null") astartn="";
											else astartn= item.astart;
											if(item.aend=="0000-00-00" || item.aend=="NULL" || item.aend=="null") aendn="";
											else aendn= item.aend;
                    $('#tsteps tbody').append(
                        '<tr><td style="display:none;">' + item.tguid +
												'</td><td style="display:none;">' + item.tsequenceid +
                        '</td><td>' + item.tstepdescription +
                        '</td><td>' + pstartn +
                        '</td><td>' + pendn +
												'</td><td>' + item.peffort +
												'</td><td>' + astartn +
												'</td><td>' + aendn +
												'</td><td>' + item.aeffort +
												'</td><td>' + item.tstage +
                        '</td></tr>'
                    )

                });



	      }
	      });

	});

	$('.commentbtn').on('click',function(){




	  $tr= $(this).closest('tr');
	  var data=$tr.children("td").map(function(){
	  return $(this).text();
	  }).get();

		console.log(data[0]);

	  $('#tguid4').val(data[0]);
	  $('#commenttaskmodal').modal('show');
	//console.log(data[0]);
		var tguid= data[0];
		//console.log(tguidstep);
	        $.ajax({
	      url: "showcomment.php",
	      type:"POST",
	      data:{
	        tguid:tguid


	      },
	      cache: false,
	      success:function(dataResult){
	      var dataResult = JSON.parse(dataResult);
	      //console.log(dataResult);
				$("#tbodycomment").empty();
				$(dataResult).each(function (index, item) {
                    console.log(item);
                    //console.log(receipts[index]);
										// 	var pstartn="";
										// 	var pendn="";
										// 	var astartn="";
										// 	var aendn="";
										// 	if(item.pstart=="0000-00-00" || item.pstart=="NULL" || item.pend=="null") pstartn="";
										// 	else pstartn= item.pstart;
										// 	if(item.pend=="0000-00-00" || item.pend=="NULL" || item.pend=="null") pendn="";
										// 	else pendn= item.pendn;
										// 	if(item.astart=="0000-00-00" || item.astart=="NULL" || item.astart=="null") astartn="";
										// 	else astartn= item.astart;
										// 	if(item.aend=="0000-00-00" || item.aend=="NULL" || item.aend=="null") aendn="";
										// 	else aendn= item.aend;
                     $('#tcomments tbody').append(
                         '<tr><td >' + item.createdon +
										 		'</td><td >' + item.createdat +
                    //     '</td><td>' + item.tstepdescription +
                    //     '</td><td>' + pstartn +
                    //     '</td><td>' + pendn +
										// 		'</td><td>' + item.peffort +
										// 		'</td><td>' + astartn +
										// 		'</td><td>' + aendn +
										// 		'</td><td>' + item.aeffort +
										 		'</td><td>' + item.comment +
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
				$('#editmodal').modal('show');
				$('#tguid1').val(data[0]);
				$('#tdescription1').val(data[2]);
				$('#ttype1').val(data[3]);
				$('#tid1').val(data[1].trim());
				$("#pstart1").val(data[4]);
				$("#pend1").val(data[5]);
				$("#peffort1").val(data[6]);

				$("#edittaskbtn").hide();

				$("#tid1").attr("readonly","readonly");
				$("#tid1").attr("disabled", "disabled");
				$("#tdescription1").attr("readonly","readonly");
				$("#tdescription1").attr("disabled", "disabled");
				$("#ttype1").attr("readonly","readonly");
				$("#ttype1").attr("disabled", "disabled");
				$("#assignto1").attr("readonly","readonly");
				$("#assignto1").attr("disabled", "disabled");
				$("#pstart1").attr("readonly","readonly");
				$("#pstart1").attr("disabled", "disabled");
				$("#pend1").attr("readonly","readonly");
				$("#pend1").attr("disabled", "disabled");
				$("#peffort1").attr("readonly","readonly");
				$("#peffort1").attr("disabled", "disabled");
				$("#error").show();
				$('#error').html("Task is already planned so please contact admin");

			//alert("Task is already planned please contact your admin");
			 }

			 else{

				 $('#editmodal').modal('show');
				 $("#error").hide();
				 $('#tguid1').val(data[0]);
				 $('#tid1').val(data[1].trim());
				 $('#tdescription1').val(data[2]);
				 $('#ttype1').val(data[3]);
				 $("#pstart1").val("");
				 $("#pend1").val("");
				 $("#peffort1").val("");


				 $("#tid1").prop("readonly", false);
				 $("#tid1").prop("disabled", false);
				 $("#tdescription1").prop("readonly", false);
				 $("#tdescription1").prop("disabled", false);
				 $("#ttype1").prop("readonly", false);
				 $("#ttype1").prop("disabled", false);
				 $("#assignto1").prop("readonly", false);
				 $("#assignto1").prop("disabled", false);
				 $("#pstart1").prop("readonly", false);
				 $("#pstart1").prop("disabled", false);
				 $("#pend1").prop("readonly", false);
				 $("#pend1").prop("disabled", false);
				 $("#peffort1").prop("readonly", false);
				 $("#peffort1").prop("disabled", false);

				 $("#edittaskbtn").show();



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

});
