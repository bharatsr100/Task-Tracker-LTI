$(document).ready(function() {
	let dropdown = $('#userslist');
	dropdown.empty();
	dropdown.append('<option selected="true" disabled value="0">Choose User Name</option>');
	dropdown.prop('selectedIndex', 0);

	const url = 'employeelist.json';

	// Populate dropdown with list of provinces
	$.getJSON(url, function (data) {
	  $.each(data, function (key, entry) {
	    dropdown.append($('<option></option>').attr('value', entry.uguid).text(entry.uname+"---"+entry.e_emailid));
	  })
	});


	$('[data-toggle="tooltip"]').tooltip();
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
		var tasklist=[

			{	tsequenceid:"21",
				tstepdescription:"Kickoff"
				},
			{	tsequenceid:"31",
				tstepdescription:"Requirement Gathering"
				},
			{	tsequenceid:"41",
				tstepdescription:"Requirement Analysis"
				},
			{	tsequenceid:"51",
				tstepdescription:"Estimation"
				},
			{	tsequenceid:"61",
				tstepdescription:"Approval Step"
				},
			{	tsequenceid:"71",
				tstepdescription:"Functional Specification (FSR)"
				},
			{	tsequenceid:"81",
				tstepdescription:"Functional Design (FSD)"
				},
			{	tsequenceid:"91",
				tstepdescription:"Technical Design (TSD) "
				},
			{	tsequenceid:"101",
				tstepdescription:"Code"
				},
			{	tsequenceid:"111",
				tstepdescription:"Code Review"
				},
			{	tsequenceid:"121",
				tstepdescription:"Technical Testing"
				},
			{	tsequenceid:"131",
				tstepdescription:"Unit Testing (UT)"
				},

			{	tsequenceid:"141",
				tstepdescription:"Integration Testing (TIN)"
				},
			{	tsequenceid:"151",
				tstepdescription:"User Acceptance Testing (UAT)"
				},
			{	tsequenceid:"161",
				tstepdescription:"Non Regression Testing (NRT)"
				},
			{	tsequenceid:"171",
				tstepdescription:"Cut Over"
				},
			{	tsequenceid:"181",
				tstepdescription:"Go Live"
				},
			{	tsequenceid:"191",
				tstepdescription:"Hypercare"
			},
			{	tsequenceid:"201",
				tstepdescription:"Bug Fix"
				},
			{	tsequenceid:"211",
				tstepdescription:"Closure"}

		 ]


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
						var taskpresent=[];


				$(dataResult).each(function (index, item) {
									$('.deletestep2').on('click',function(){
										$tr= $(this).closest('tr');
										var data=$tr.children("td").map(function(){
										return $(this).text();
									}).get();
									console.log("deletetaskfunction");
										if(data[3]==""){
											console.log("insideifcondition");
											$('#deletetaskmodal1').modal('show');
											$('#tguidd').val(data[0]);
											$('#tsequenceidd').val(data[1]);}
										});
										var task1={
											tsequenceid:item.tsequenceid,
											tstepdescription:item.tstepdescription

										}
										taskpresent.push(task1);
                    //console.log(item);
                    //console.log(receipts[index]);
											var pstartn="";
											var pendn="";
											var astartn="";
											var aendn="";
											var pstagen="";
											if(item.pstart=="0000-00-00" || item.pstart=="NULL" || item.pend=="null") pstartn="";
											else pstartn= item.pstart;
											if(item.pend=="0000-00-00" || item.pend=="NULL" || item.pend=="null") pendn="";
											else pendn= item.pendn;
											if(item.astart=="0000-00-00" || item.astart=="NULL" || item.astart=="null") astartn="";
											else astartn= item.astart;
											if(item.aend=="0000-00-00" || item.aend=="NULL" || item.aend=="null") aendn="";
											else aendn= item.aend;
											if(item.tstage=="1") pstagen="To be planned";
											else if(item.tstage=="2" || item.stage==3) pstagen="In Progress";
											else if(item.tstage=="4") pstagen="Completed";
											else if(item.tstage=="5") pstagen="On Hold";
											else pstagen="Awaiting";
										$('[data-toggle="tooltip"]').tooltip();
										$('#tsteps tbody').append(
                        '<tr><td style="display:none;">' + item.tguid +
												'</td><td >' + item.tsequenceid +
                        '</td><td>' + item.tstepdescription +
                        '</td><td>' + pstartn +
                        '</td><td>' + pendn +
												'</td><td>' + item.peffort +
												'</td><td>' + astartn +
												'</td><td>' + aendn +
												'</td><td>' + item.aeffort +
												'</td><td style="width: 160px;">' + pstagen +
												'</td><td style="width: 100px;" ><button class="deletestep2" id="deletestep1" ><i data-toggle="tooltip" data-placement="right" title="Delete Task Step" class="fas fa-trash deletetstep" style="font-size:20px;" id="deletestep"></i></button> &nbsp; &nbsp;<a href="#"  data-toggle="modal" data-target="#"><i data-toggle="tooltip" data-placement="right" title="Update Task Step" class="fas fa-edit" style="font-size:20px;" id="update"></i></a>' +
                        '</td></tr>'


                    )


									});







								// console.log(tasklist);
								// console.log(taskpresent);

				$(tasklist).each(function (index, item) {

					let toSearch = item.tsequenceid;
					let result = taskpresent.filter(o=> o.tsequenceid === toSearch);
					var res= result.length;
					//console.log(item);
					//console.log(result);
					//console.log(res);
					if(res==0){
						//console.log("true");
						$('[data-toggle="tooltip"]').tooltip();
						$('#tasksteplist tbody').append(
							'<tr><td>' + item.tsequenceid +
							'</td><td>' + item.tstepdescription +
							'</td><td  ><a href="#"  data-toggle="modal" data-target="#"><i data-toggle="tooltip" data-placement="right" title="Add Task Step" class="fas fa-calendar-plus" style="font-size:20px;" id="deletestep"></i></a>'+
							'</td></tr>'
						)

					}


				});



	      }
	      });

	});



	$('.createbtn').on('click',function(){
		$('#createtaskmodal').modal('show');
	});

	$('.commentbtn').on('click',function(){




	  $tr= $(this).closest('tr');
	  var data=$tr.children("td").map(function(){
	  return $(this).text();
	  }).get();

		console.log(data[0]);
		var pstart=data[4];
		var pend=data[5];
		var astart=data[7];
		var aend=data[9];

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


// $('.deletetstep').on('click',function(){
//
//
// });
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
					alert(dataResult.description);
					window.location.href = 'mytask.php';


				// 	if(dataResult.statuscode=="s"){
				// 		$("#createtask").removeAttr("disabled");
				// 		$('#task_form').find('input:text').val('');
				//
        //     alert(dataResult.description);
				// 		window.location.href = 'mytask.php';
				// 		 $("#success").show();
				// 		 $('#success').html('Successfully created task!');
				//
        // }
        // else {
        //    $("#error").show();
        //    $('#error').html('Task Creation Unsuccessful');
        //   alert(dataResult.description);
				// 	window.location.href = 'mytask.php';
        // }
      }
      });
    }
    else {
        alert('Please fill all the required field !');
        //console. log("4");
      }
  });



});
