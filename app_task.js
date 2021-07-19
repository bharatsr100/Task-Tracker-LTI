$(document).ready(function() {
function loadtask_types(){
  // event.preventDefault();
  var type="35";
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
      let dropdown_ttype = $('#ttype');
      let dropdown_ttype1 = $('#ttype1');
      dropdown_ttype.empty();
      dropdown_ttype1.empty();
      $(dataResult).each(function (index, item) {
        dropdown_ttype.append($('<option></option>').attr('value', item.ttype).text(item.ttype_desc));
        dropdown_ttype1.append($('<option></option>').attr('value', item.ttype).text(item.ttype_desc));
      });

    }
  });
}
loadtask_types();

var table1=$('#mytasktable').DataTable({

    "paging": false,
    "ordering": true,
    "info": false,
    "order": [
      [4, "asc"]
    ]

  });



  $('#taskdequencetable').DataTable({
    "paging": false,
    //"ordering": true,
    "info": false,
    "columnDefs": [
      // { type: 'num', targets: 3 },
      {
        targets: [4],
        orderData: [13, 5]
      },
      {
        targets: [6],
        orderData: [5]
      }
    ],
    "order": [
      [4, "asc"]
    ]

  });


  let dropdown = $('#userslist');
  dropdown.empty();
  dropdown.append('<option selected="true" value="0">--Choose User Name--</option>');
  dropdown.prop('selectedIndex', 0);

  const url = 'employeelist.json';


  $.getJSON(url, function(data) {
    $.each(data, function(key, entry) {
      dropdown.append($('<option></option>').attr('value', entry.uguid).text(entry.uname + "---" + entry.e_emailid));
    })
  });


  $('[data-toggle="tooltip"]').tooltip();

  let dropdown1 = $('#assignto');
  //let dropdown = $('#assignto');
  dropdown1.empty();
  dropdown1.append('<option selected="true" value="0">--Choose User Name--</option>');
  dropdown1.prop('selectedIndex', 0);

  const url1 = 'employeelist.json';


  $.getJSON(url1, function(data1) {
    $.each(data1, function(key, entry) {
      dropdown1.append($('<option></option>').attr('value', entry.uguid).text(entry.uname + "---" + entry.e_emailid));
    })
  });

  let dropdown5 = $('#userslist5');
  //let dropdown = $('#assignto');
  dropdown5.empty();
  dropdown5.append('<option selected="true" value="0">--Choose User Name--</option>');

  dropdown5.prop('selectedIndex', 0);
  const url5 = 'employeelist.json';


  $.getJSON(url5, function(data5) {
    $.each(data5, function(key, entry) {
      dropdown5.append($('<option></option>').attr('value', entry.uguid).text(entry.uname + "---" + entry.e_emailid));
    })
  });


  let dropdown3 = $('#efforth');
  //let dropdown = $('#assignto');
  dropdown3.empty();
  dropdown3.append('<option selected="true" value=0>--Hours--</option>');
  dropdown3.prop('selectedIndex', 0);

  for (var i = 1; i < 101; i++) {
    dropdown3.append($('<option></option>').attr('value', i).text(i));
  }

  let dropdown4 = $('#effortm');
  //let dropdown = $('#assignto');
  dropdown4.empty();
  dropdown4.append('<option selected="true" value=0>--Minutes--</option>');
  dropdown4.prop('selectedIndex', 0);

  for (var i = 1; i < 61; i++) {
    dropdown4.append($('<option></option>').attr('value', i).text(i));
  }

  let dropdown7 = $('#efforth5');
  //let dropdown = $('#assignto');
  dropdown7.empty();
  dropdown7.append('<option selected="true" value=0>--Hours--</option>');
  dropdown7.prop('selectedIndex', 0);

  for (var i = 1; i < 101; i++) {
    dropdown7.append($('<option></option>').attr('value', i).text(i));
  }
  let dropdown6 = $('#effortm5');
  //let dropdown = $('#assignto');
  dropdown6.empty();
  dropdown6.append('<option selected="true" value=0>--Minutes--</option>');
  dropdown6.prop('selectedIndex', 0);

  for (var i = 1; i < 61; i++) {
    dropdown6.append($('<option></option>').attr('value', i).text(i));
  }


  $('#deletestep1').on('click', function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    console.log("deletetaskfunction");
    if (data[3] == "") {
      console.log("insideifcondition");
      $('#deletetaskmodal1').modal('show');
      $('#tguidd').val(data[0]);
      $('#tsequenceidd').val(data[1]);
    }
  });
  $(document).on('click', '.stpbtn12', function(e) {
  //$('.stpbtn12').on('click', function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();
    var tguidstep23 = data[1];
    var taskid23 = data[2].trim();
    sessionStorage.setItem("taskid23", taskid23);
    sessionStorage.setItem("tguidstep23", tguidstep23);
    location.href = "taskstepsadd_del.php";


    // var tasklist=[
    //
    // 	{	tguid:data[0],
    // 		tsequenceid:"21",
    // 		tstepdescription:"Kickoff"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"31",
    // 		tstepdescription:"Requirement Gathering"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"41",
    // 		tstepdescription:"Requirement Analysis"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"51",
    // 		tstepdescription:"Estimation"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"61",
    // 		tstepdescription:"Approval Step"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"71",
    // 		tstepdescription:"Functional Specification (FSR)"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"81",
    // 		tstepdescription:"Functional Design (FSD)"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"91",
    // 		tstepdescription:"Technical Design (TSD) "
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"101",
    // 		tstepdescription:"Code"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"111",
    // 		tstepdescription:"Code Review"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"121",
    // 		tstepdescription:"Technical Testing"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"131",
    // 		tstepdescription:"Unit Testing (UT)"
    // 		},
    //
    // 	{	tguid:data[0],
    // 		tsequenceid:"141",
    // 		tstepdescription:"Integration Testing (TIN)"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"151",
    // 		tstepdescription:"User Acceptance Testing (UAT)"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"161",
    // 		tstepdescription:"Non Regression Testing (NRT)"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"171",
    // 		tstepdescription:"Cut Over"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"181",
    // 		tstepdescription:"Go Live"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"191",
    // 		tstepdescription:"Hypercare"
    // 	},
    // 	{	tguid:data[0],
    // 		tsequenceid:"201",
    // 		tstepdescription:"Bug Fix"
    // 		},
    // 	{	tguid:data[0],
    // 		tsequenceid:"211",
    // 		tstepdescription:"Closure"}
    //
    //  ]
    //
    //  $.ajax({
    // url: "tasksteps.php",
    // type:"POST",
    // data:{
    //  tguidstep:tguidstep
    //
    //
    // },
    // cache: false,
    // success:function(dataResult){
    // var dataResult = JSON.parse(dataResult);
    // //console.log(dataResult);
    // $("#tbodystep23").empty();
    // $("#tbodylist23").empty();
    // 	 var taskpresent=[];
    //
    //
    // $(dataResult).each(function (index, item) {
    //
    // 					 var task1={
    // 						 tguid:item.tguid,
    // 						 tsequenceid:item.tsequenceid,
    // 						 tstepdescription:item.tstepdescription
    //
    // 					 }
    // 					 taskpresent.push(task1);
    // 					 //console.log(item);
    // 					 //console.log(receipts[index]);
    // 						 var pstartn="";
    // 						 var pendn="";
    // 						 var astartn="";
    // 						 var aendn="";
    // 						 var pstagen="";
    // 						 if(item.pstart=="0000-00-00" || item.pstart=="NULL" || item.pstart=="null" || item.pstart==null) pstartn="";
    // 						 else pstartn= item.pstart;
    // 						 if(item.pend=="0000-00-00" || item.pend=="NULL" || item.pend=="null" || item.pend==null) pendn="";
    // 						 else pendn= item.pendn;
    // 						 if(item.astart=="0000-00-00" || item.astart=="NULL" || item.astart=="null" || item.astart==null) astartn="";
    // 						 else astartn= item.astart;
    // 						 if(item.aend=="0000-00-00" || item.aend=="NULL" || item.aend=="null" || item.astart==null) aendn="";
    // 						 else aendn= item.aend;
    // 						 if(item.tstage=="1") pstagen="To be planned";
    // 						 else if(item.tstage=="2" || item.stage==3) pstagen="In Progress";
    // 						 else if(item.tstage=="4") pstagen="Completed";
    // 						 else if(item.tstage=="5") pstagen="On Hold";
    // 						 else pstagen="Awaiting";
    // 					 $('[data-toggle="tooltip"]').tooltip();
    // 					 $('#tsteps23 tbody').append(
    // 							 '<tr><td >' + item.tguid +
    // 							 '</td><td >' + item.tsequenceid +
    // 							 '</td><td>' + item.tstepdescription +
    // 							 '</td><td>' + pstartn +
    // 							 '</td><td>' + pendn +
    // 							 '</td><td>' + item.peffort +
    // 							 '</td><td>' + astartn +
    // 							 '</td><td>' + aendn +
    // 							 '</td><td>' + item.aeffort +
    // 							 '</td><td style="width: 160px;">' + pstagen +
    // 							 '</td><td><button class="deletestep2" id="deletestep1" ><i data-toggle="tooltip" data-placement="right" title="Delete Task Step" class="fas fa-trash deletetstep" style="font-size:20px;" id="deletestep"></i></button>' +
    // 							 '</td></tr>'
    //
    //
    // 					 )
    //
    //
    // 				 });
    //
    //
    //
    //
    //
    //
    //
    // 			 // console.log(tasklist);
    // 			 // console.log(taskpresent);
    //
    // $(tasklist).each(function (index, item) {
    //
    //  let toSearch = item.tsequenceid;
    //  let result = taskpresent.filter(o=> o.tsequenceid === toSearch);
    //  var res= result.length;
    //  //console.log(item);
    //  //console.log(result);
    //  //console.log(res);
    //  if(res==0){
    // 	 //console.log("true");
    // 	 $('[data-toggle="tooltip"]').tooltip();
    // 	 $('#tasksteplist23 tbody').append(
    // 		 '<tr><td>' + item.tguid +
    // 		 '</td><td>' + item.tsequenceid +
    // 		 '</td><td>' + item.tstepdescription +
    // 		 '</td><td><button class="addstep2" id="addstep1" ><i data-toggle="tooltip" data-placement="right" title="Add Task Step" class="fas fa-plus" style="font-size:20px;" id="deletestep"></i></button>'+
    // 		 '</td></tr>'
    // 	 )
    //
    //  }
    //
    //
    // });
    //
    //
    //
    // }
    // });



  });

  $('.stpbtn').on('click', function() {

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    console.log(data[0]);

    $('#tguid2').val(data[0]);
    $('#stepmodal').modal('show');
    //console.log(data[0]);
    var tguidstep = data[0];
    var tasklist = [

      {
        tguid: data[0],
        tsequenceid: "21",
        tstepdescription: "Kickoff"
      },
      {
        tguid: data[0],
        tsequenceid: "31",
        tstepdescription: "Requirement Gathering"
      },
      {
        tguid: data[0],
        tsequenceid: "41",
        tstepdescription: "Requirement Analysis"
      },
      {
        tguid: data[0],
        tsequenceid: "51",
        tstepdescription: "Estimation"
      },
      {
        tguid: data[0],
        tsequenceid: "61",
        tstepdescription: "Approval Step"
      },
      {
        tguid: data[0],
        tsequenceid: "71",
        tstepdescription: "Functional Specification (FSR)"
      },
      {
        tguid: data[0],
        tsequenceid: "81",
        tstepdescription: "Functional Design (FSD)"
      },
      {
        tguid: data[0],
        tsequenceid: "91",
        tstepdescription: "Technical Design (TSD) "
      },
      {
        tguid: data[0],
        tsequenceid: "101",
        tstepdescription: "Code"
      },
      {
        tguid: data[0],
        tsequenceid: "111",
        tstepdescription: "Code Review"
      },
      {
        tguid: data[0],
        tsequenceid: "121",
        tstepdescription: "Technical Testing"
      },
      {
        tguid: data[0],
        tsequenceid: "131",
        tstepdescription: "Unit Testing (UT)"
      },

      {
        tguid: data[0],
        tsequenceid: "141",
        tstepdescription: "Integration Testing (TIN)"
      },
      {
        tguid: data[0],
        tsequenceid: "151",
        tstepdescription: "User Acceptance Testing (UAT)"
      },
      {
        tguid: data[0],
        tsequenceid: "161",
        tstepdescription: "Non Regression Testing (NRT)"
      },
      {
        tguid: data[0],
        tsequenceid: "171",
        tstepdescription: "Cut Over"
      },
      {
        tguid: data[0],
        tsequenceid: "181",
        tstepdescription: "Go Live"
      },
      {
        tguid: data[0],
        tsequenceid: "191",
        tstepdescription: "Hypercare"
      },
      {
        tguid: data[0],
        tsequenceid: "201",
        tstepdescription: "Bug Fix"
      },
      {
        tguid: data[0],
        tsequenceid: "211",
        tstepdescription: "Closure"
      }

    ]


    //console.log(tguidstep);
    $.ajax({
      url: "tasksteps.php",
      type: "POST",
      data: {
        tguidstep: tguidstep


      },
      cache: false,
      success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        //console.log(dataResult);
        $("#tbodystep").empty();
        var taskpresent = [];


        $(dataResult).each(function(index, item) {

          var task1 = {
            tguid: item.tguid,
            tsequenceid: item.tsequenceid,
            tstepdescription: item.tstepdescription

          }
          taskpresent.push(task1);
          //console.log(item);
          //console.log(receipts[index]);
          var pstartn = "";
          var pendn = "";
          var astartn = "";
          var aendn = "";
          var pstagen = "";
          if (item.pstart == "0000-00-00" || item.pstart == "NULL" || item.pstart == "null" || item.pstart == null) pstartn = "";
          else pstartn = item.pstart;
          if (item.pend == "0000-00-00" || item.pend == "NULL" || item.pend == "null" || item.pend == null) pendn = "";
          else pendn = item.pendn;
          if (item.astart == "0000-00-00" || item.astart == "NULL" || item.astart == "null" || item.astart == null) astartn = "";
          else astartn = item.astart;
          if (item.aend == "0000-00-00" || item.aend == "NULL" || item.aend == "null" || item.astart == null) aendn = "";
          else aendn = item.aend;
          if (item.tstage == "1") pstagen = "To be planned";
          else if (item.tstage == "2" || item.stage == 3) pstagen = "In Progress";
          else if (item.tstage == "4") pstagen = "Completed";
          else if (item.tstage == "5") pstagen = "On Hold";
          else pstagen = "Awaiting";
          $('[data-toggle="tooltip"]').tooltip();
          $('#tsteps tbody').append(
            '<tr><td >' + item.tguid +
            '</td><td >' + item.tsequenceid +
            '</td><td>' + item.tstepdescription +
            '</td><td>' + pstartn +
            '</td><td>' + pendn +
            '</td><td>' + item.peffort +
            '</td><td>' + astartn +
            '</td><td>' + aendn +
            '</td><td>' + item.aeffort +
            '</td><td style="width: 160px;">' + pstagen +
            '</td><td><button class="deletestep2" id="deletestep1" ><i data-toggle="tooltip" data-placement="right" title="Delete Task Step" class="fas fa-trash deletetstep" style="font-size:20px;" id="deletestep"></i></button>' +
            '</td></tr>'


          )


        });







        // console.log(tasklist);
        // console.log(taskpresent);

        $(tasklist).each(function(index, item) {

          let toSearch = item.tsequenceid;
          let result = taskpresent.filter(o => o.tsequenceid === toSearch);
          var res = result.length;
          //console.log(item);
          //console.log(result);
          //console.log(res);
          if (res == 0) {
            //console.log("true");
            $('[data-toggle="tooltip"]').tooltip();
            $('#tasksteplist tbody').append(
              '<tr><td>' + item.tguid +
              '</td><td>' + item.tsequenceid +
              '</td><td>' + item.tstepdescription +
              '</td><td><button class="addstep2" id="addstep1" ><i data-toggle="tooltip" data-placement="right" title="Add Task Step" class="fas fa-plus" style="font-size:20px;" id="deletestep"></i></button>' +
              '</td></tr>'
            )

          }


        });



      }
    });

  });

  // $('.close').on('click', function() {
    // window.location.reload();
    //  $(document).on('click', '.stpbtn12', function(e) {
    // $(document).on('click', '.commentbtn', function(e) {
    //window.location.href = 'mytask.php';
  // });

  //To refresh table 1
  function loadtable1(){

    table1=$('#mytasktable').DataTable({

        "paging": false,
        "ordering": true,
        "info": false,
        "order": [
          [4, "asc"]
        ]

      });


  }
    // $(document).on('click', '.close1', function(e) {
  $('.close').on('click', function() {
      window.location.reload();
    });
  $('.close1').on('click', function() {
    // table1.destroy();
    // table1=$('#mytasktable').DataTable({
    //
    //     "paging": false,
    //     "ordering": true,
    //     "info": false,
    //     "order": [
    //       [4, "asc"]
    //     ]
    //
    //   });
    window.location.reload();

  });
  $('.close2').on('click', function() {
      window.location.reload();
    // $("#mytaskstep_div").load(location.href + " #mytaskstep_div");
  });

  function close1function(callback){
    $('#editmodal').modal('hide');
   table1.destroy();
   table1.destroy();
   //table1.clear();
    $("#mytask_div").load(location.href + " #mytask_div");
    callback();
  }


//To refresh table 2

  $('.createbtn').on('click', function() {
    //	$('#createtaskmodal').modal('show');
    $('#createtaskmodal').modal({
      backdrop: 'static',
      keyboard: false
    });


  });
  $('.tstepstage').on('click', function() {

    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    $('#uguid_comment5').val(data[1]);
    $('#tguid5').val(data[2]);
    $('#tsequenceid5').val(data[4]);
		$("#headercommentstep_table").html("Task Step Comment History for: "+data[12]);

    //$('#commenttaskmodal5').modal('show');
    $('#commenttaskmodal5').modal({
      backdrop: 'static',
      keyboard: false
    });

    var tguids = data[2];
    var tsequenceids = data[4];
    $.ajax({
      url: "showcomment.php",
      type: "POST",
      data: {
        type: 2,
        tguids: tguids,
        tsequenceids: tsequenceids


      },
      cache: false,
      success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        //console.log(dataResult);
        $("#tbodycomment5").empty();
        $(dataResult).each(function(index, item) {

          $('#tcomments5 tbody').append(
            '<tr><td >' + item.createdon +
            '</td><td >' + item.createdat +
            '</td><td >' + item.createdby +
            '</td><td>' + item.comment +
            '</td></tr>'
          )

        });
      }
    });

  });
	function loadcommentsteptable(tguids,tsequenceids){
		$.ajax({
			url: "showcomment.php",
			type: "POST",
			data: {
				type: 2,
				tguids: tguids,
				tsequenceids: tsequenceids


			},
			cache: false,
			success: function(dataResult) {
				var dataResult = JSON.parse(dataResult);
				//console.log(dataResult);
				$("#tbodycomment5").empty();
				$(dataResult).each(function(index, item) {

					$('#tcomments5 tbody').append(
						'<tr><td >' + item.createdon +
						'</td><td >' + item.createdat +
						'</td><td >' + item.createdby +
						'</td><td>' + item.comment +
						'</td></tr>'
					)

				});
			}
		});
	}
  $(document).on('click', '.commentbtn', function(e) {
  //$('.commentbtn').on('click', function() {




    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    var tidd = data[2].trim();
    var l = tidd.length;
    var tids = tidd.substring(0, l / 2);
    tids = tids.trim();

    //console.log(data[0]);
    var pstart = data[5];
    var pend = data[6];
    var astart = data[8];
    var aend = data[10];
    var tid1 = data[2];

    $('#uguid_comment').val(data[0]);
    $('#tguid4').val(data[1]);
    $("#errorcommenttask").hide();
    $(".savecomment").prop('disabled', false);
    $("#successcommenttask").hide();
    //$('#commenttaskmodal').modal('show');
    $('#commenttaskmodal').modal({
      backdrop: 'static',
      keyboard: false
    });

    $('#commenttaskhead').html("Comment History for : " + tids);
    //console.log(data[0]);
    var tguid = data[1];
    //console.log(tguidstep);
    $.ajax({
      url: "showcomment.php",
      type: "POST",
      data: {
        type: 1,
        tguid: tguid


      },
      cache: false,
      success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        //console.log(dataResult);
        $("#tbodycomment").empty();
        $(dataResult).each(function(index, item) {
          //console.log(item);
          $('#tcomments tbody').append(
            '<tr><td >' + item.createdon +
            '</td><td >' + item.createdat +
            '</td><td >' + item.createdby +
            '</td><td>' + item.comment +
            '</td></tr>'
          )

        });
      }
    });

  });

  function loadcommenttable(taskguid) {
    var tguid = taskguid;
    $.ajax({
      url: "showcomment.php",
      type: "POST",
      data: {
        type: 1,
        tguid: tguid


      },
      cache: false,
      success: function(dataResult) {
        var dataResult = JSON.parse(dataResult);
        //console.log(dataResult);
        $("#tbodycomment").empty();
        $(dataResult).each(function(index, item) {
          //console.log(item);
          $('#tcomments tbody').append(
            '<tr><td >' + item.createdon +
            '</td><td >' + item.createdat +
            '</td><td >' + item.createdby +
            '</td><td>' + item.comment +
            '</td></tr>'
          )

        });
      }
    });
  }



  $(document).on('click', '.stpedit12', function(e) {
  //$('.stpedit12').on('click', function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();


    var tidd = data[3].trim();
    var l = tidd.length;
    var tids = tidd.substring(0, l / 2);
    tids = tids.trim();

    //console.log(data);
    if (data[6] != "") {
      $('#editstaskstepmodal').modal({
        backdrop: 'static',
        keyboard: false
      });
      //$('#editstaskstepmodal').modal('show');
      $('#uguid3').val(data[1]);
      $('#tsequenceid3').val(data[4]);
      $('#tguid3').val(data[2]);
      $('#tid3').val(tids);
      // var s = data[3].replace(/\d+/g, '');
      //s.replace(/\d+/g, '');
      $('#tdescription3').val(data[5]);
      //data[3]

      $("#pstart3").val(data[6]);
      $("#pend3").val(data[7]);
      $("#peffort3").val(data[8]);

      $("#edittaskstepbtn").hide();

      $("#tid3").attr("readonly", "readonly");
      $("#tid3").attr("disabled", "disabled");
      $("#tsequenceid3").attr("readonly", "readonly");
      $("#tsequenceid3").attr("disabled", "disabled");
      $("#tdescription3").attr("readonly", "readonly");
      $("#tdescription3").attr("disabled", "disabled");
      $("#pstart3").attr("readonly", "readonly");
      $("#pstart3").attr("disabled", "disabled");
      $("#pend3").attr("readonly", "readonly");
      $("#pend3").attr("disabled", "disabled");
      $("#peffort3").attr("readonly", "readonly");
      $("#peffort3").attr("disabled", "disabled");
      $("#error3").show();
      $('#error3').html("Task is already planned so please contact admin");

      //$(".edittaskstepbtn").prop('disabled', false);
      $("#successedittaskstep").hide();
      $("#erroredittaskstep").hide();


    } else {

      $('#editstaskstepmodal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#successedittaskstep").hide();
      $("#erroredittaskstep").hide();
      $("#error3").hide();
      $('#tsequenceid3').val(data[4]);
      $('#uguid3').val(data[1]);
      $('#tguid3').val(data[2]);
      $('#tid3').val(tids);
      //var s = data[3];
      var s = data[5].replace(/\d+/g, '');
      $('#tdescription3').val(s);
      //data[3]

      $("#pstart3").val("");
      $("#pend3").val("");
      $("#peffort3").val("");


      $("#tid3").prop("readonly", true);
      $("#tid3").prop("disabled", false);
      $("#tsequenceid3").prop("readonly", true);
      $("#tsequenceid3").prop("disabled", false);
      $("#tdescription3").prop("readonly", true);
      $("#tdescription3").prop("disabled", false);
      $("#pstart3").prop("readonly", false);
      $("#pstart3").prop("disabled", false);
      $("#pend3").prop("readonly", false);
      $("#pend3").prop("disabled", false);
      $("#peffort3").prop("readonly", false);
      $("#peffort3").prop("disabled", false);

      $("#edittaskstepbtn").show();



    }

  });
  $(document).on('click', '.editbtn', function(e) {
  //$('.editbtn').on('click', function() {
    $tr = $(this).closest('tr');
    var data = $tr.children("td").map(function() {
      return $(this).text();
    }).get();

    var tidd = data[2].trim();
    var l = tidd.length;
    var tids = tidd.substring(0, l / 2);
    tids = tids.trim();

    if (data[5] != "") {

      //$('#editmodal').modal('show');
      $('#editmodal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $('#uguid1').val(data[0]);
      $('#tguid1').val(data[1]);
      $('#tdescription1').val(data[3]);
      // $('#ttype1').val(data[4].trim());
      var textToFind = data[4].trim();
      var dd = document.getElementById ('ttype1');
      dd.selectedIndex = [...dd.options].findIndex (option => option.text === textToFind);


      //data[1].trim()
      $('#tid1').val(tids);
      $("#pstart1").val(data[5]);
      $("#pend1").val(data[6]);
      $("#peffort1").val(data[7]);
      $("#priority1").val(data[13]);

      $("#edittaskbtn").hide();
      $("#priority1").prop("readonly", true);
      $("#priority1").prop("disabled", true);
      $("#tid1").attr("readonly", "readonly");
      $("#tid1").attr("disabled", "disabled");
      $("#tdescription1").attr("readonly", "readonly");
      $("#tdescription1").attr("disabled", "disabled");
      $("#ttype1").attr("readonly", "readonly");
      $("#ttype1").attr("disabled", "disabled");
      $("#assignto1").attr("readonly", "readonly");
      $("#assignto1").attr("disabled", "disabled");
      $("#pstart1").attr("readonly", "readonly");
      $("#pstart1").attr("disabled", "disabled");
      $("#pend1").attr("readonly", "readonly");
      $("#pend1").attr("disabled", "disabled");
      $("#peffort1").attr("readonly", "readonly");
      $("#peffort1").attr("disabled", "disabled");
      $("#error").show();

      $('#error').html("Task is already planned so please contact admin");
      $("#successedittask").hide();
      $("#erroredittask").hide();
      //alert("Task is already planned please contact your admin");
    } else {

      //$('#editmodal').modal('show');
      $('#editmodal').modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#priority1").val(data[13]);
      $(".edittaskbtn").prop('disabled', false);
      $("#successedittask").hide();
      $("#erroredittask").hide();
      $('#uguid1').val(data[0]);
      $("#error").hide();
      $('#tguid1').val(data[1]);
      $('#tid1').val(tids);
      $('#tdescription1').val(data[3]);
      // $('#ttype1').val(data[4].trim());
      var textToFind = data[4].trim();
      var dd = document.getElementById ('ttype1');
      dd.selectedIndex = [...dd.options].findIndex (option => option.text === textToFind);

      $("#pstart1").val("");
      $("#pend1").val("");
      $("#peffort1").val("");

      $("#priority1").prop("readonly", false);
      $("#priority1").prop("disabled", false);
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
    event.preventDefault();

    var tid = $('#tid').val();
    var tdescription = $('#tdescription').val();
    var ttype = $('#ttype').val();
    var assignto = $('#assignto').val();
    var pstart = $('#pstart').val();
    var pend = $('#pend').val();
    var astart = "0000-00-00";
    var aend = "0000-00-00";
    var peffort = ($('#peffort').val())*480;
    var comment = $('#comment').val();
    var type = "1";
    var priority=$('#priority').val();
    var ajaxResult = [];
    //console. log("4");
    //console. log("3");
    //alert("Submit the form?");
    $.ajax({
      url: "task.php",
      type: "POST",

      data: {
        type: type,
        tid: tid,
        tdescription: tdescription,
        ttype: ttype,
        assignto: assignto,
        pstart: pstart,
        pend: pend,
        astart: astart,
        aend: aend,
        peffort: peffort,
        priority:priority,
        comment: comment
      },
      cache: false,
      success: function(dataResult) {
        //console. log("success");
        var dataResult = JSON.parse(dataResult);
        ajaxResult.push(dataResult);
        //console.log("Hello");
        console.log(dataResult);
        console.log("Data Result loaded");


        //alert(dataResult.description);
        //window.location.href = 'mytask.php';
        if (dataResult.statuscode == "s") {
          console.log("display s message");
          //window.location.href = 'mytask.php';
          //$("#createtask").removeAttr("disabled");

          //$('#task_form').find('input:text').val('');
          $("#task_form")[0].reset();
          $("#errortask").hide();
          $("#successtask").show();
          $('#successtask').html(dataResult.description);
          //alert(dataResult.description);
          //window.location.href = 'mytask.php';
        } else {
          console.log("display e message");
          //window.location.href = 'mytask.php';
          $("#successtask").hide();
          $("#errortask").show();
          $('#errortask').html(dataResult.description);
          //window.location.href = 'mytask.php';
          //alert(dataResult.description);
        }

      },
      complete: function() {
        //after completed request then this method will be called.
        //console.log(ajaxResult[0]);
        // $("#errortask").show();
        // $('#errortask').html(ajaxResult[0].description);

      }


    });


  });
  $('.edittaskbtn').on('click', function() {

    event.preventDefault();

    var uguid1 = $('#uguid1').val();
    var tguid1 = $('#tguid1').val();
    var tid1 = $('#tid1').val();
    var tdescription1 = $('#tdescription1').val();
    var ttype1 = $('#ttype1').val();
    var assignto1 = $('#assignto1').val();
    var pstart1 = $('#pstart1').val();
    var pend1 = $('#pend1').val();
    var priority1 = $('#priority1').val();
    var peffort1 = ($('#peffort1').val())*480;
    var type = "6";

    $.ajax({
      url: "updatetask1.php",
      type: "POST",
      data: {
        type: type,
        uguid1: uguid1,
        tguid1: tguid1,
        tid1: tid1,
        tdescription1: tdescription1,
        assignto1: assignto1,
        pstart1: pstart1,
        pend1: pend1,
        peffort1: peffort1,
        priority1: priority1,
        ttype1: ttype1

      },
      cache: false,
      success: function(dataResult) {
        // console.log(dataResult);
        var dataResult = JSON.parse(dataResult);
        // console.log(dataResult);
        if (dataResult.statuscode == "s") {
          $(".edittaskbtn").prop('disabled', true);
          // $("#task_edit_form")[0].reset();
          $("#erroredittask").hide();
          $("#successedittask").show();
          $('#successedittask').html(dataResult.description);
          $("#mytask_div").load(location.href + " #mytask_div");
        } else {
          $(".edittaskbtn").prop('disabled', false);
          $("#successedittask").hide();
          $("#erroredittask").show();
          $('#erroredittask').html(dataResult.description);
        }

      }

    });

  });
  //save_comment_form
  $('.savecomment').on('click', function() {


    event.preventDefault();

    var comment4 = $('#comment4').val();
    var userslist = $('#userslist').val();
    var tstatus4 = $('#tstatus4').val();
    var tguid4 = $('#tguid4').val();
    var efforth = $('#efforth').val();
    var effortm = $('#effortm').val();
    var type = "7";

    $.ajax({
      url: "updatetask1.php",
      type: "POST",
      data: {
        type: type,
        comment4: comment4,
        userslist: userslist,
        tstatus4: tstatus4,
        tguid4: tguid4,
        efforth: efforth,
        effortm: effortm

      },
      cache: false,
      success: function(dataResult) {
				//console.log(dataResult);
        var dataResult = JSON.parse(dataResult);
        //console.log(dataResult);
        if (dataResult.statuscode == "s") {
          $(".savecomment").prop('disabled', true);
          $("#save_comment_form")[0].reset();
          $("#errorcommenttask").hide();
          $("#successcommenttask").show();
          $('#successcommenttask').html(dataResult.description);
          loadcommenttable(dataResult.tguid);
        } else {
          $(".savecomment").prop('disabled', false);

          $("#successcommenttask").hide();
          $("#errorcommenttask").show();
          $('#errorcommenttask').html(dataResult.description);
        }

      }

    });
  });

  $('.edittaskstepbtn').on('click', function() {
    event.preventDefault();

    var uguid3 = $('#uguid3').val();
    var tguid3 = $('#tguid3').val();
    var tsequenceid3 = $('#tsequenceid3').val();
    var pstart3 = $('#pstart3').val();
    var pend3 = $('#pend3').val();
    var peffort3 = ($('#peffort3').val())*480;
    var type = "8";

    $.ajax({
      url: "updatetask1.php",
      type: "POST",
      data: {
        type: type,
        uguid3: uguid3,
        tguid3: tguid3,
        tsequenceid3: tsequenceid3,
        pstart3: pstart3,
        pend3: pend3,
        peffort3: peffort3

      },
      cache: false,
      success: function(dataResult) {
			console.log(dataResult);
			var dataResult = JSON.parse(dataResult);
      console.log(dataResult);
      if (dataResult.statuscode == "s") {
        $(".edittaskstepbtn").prop('disabled', true);
        $("#erroredittaskstep").hide();
        $("#successedittaskstep").show();
        $('#successedittaskstep').html(dataResult.description);

      } else {
        $(".edittaskstepbtn").prop('disabled', false);
        $("#successedittaskstep").hide();
        $("#erroredittaskstep").show();
        $('#erroredittaskstep').html(dataResult.description);
      }

      }


    });



  });

	$('.savecomment5').on('click', function() {
		event.preventDefault();

		var comment5 = $('#comment5').val();
    var tguid5 = $('#tguid5').val();
    var tsequenceid5 = $('#tsequenceid5').val();
    var efforth5 = $('#efforth5').val();
    var effortm5 = $('#effortm5').val();
    var userslist5 = $('#userslist5').val();
		var tstatus5 = $('#tstatus5').val();
    var type = "9";

  	$.ajax({
      url: "updatetask1.php",
      type: "POST",
      data: {
        type: type,
				comment5:comment5,
        tguid5: tguid5,
        tsequenceid5: tsequenceid5,
        efforth5: efforth5,
        effortm5: effortm5,
        userslist5: userslist5,
				tstatus5: tstatus5
      },
      cache: false,
      success: function(dataResult) {
			console.log(dataResult);

			var dataResult = JSON.parse(dataResult);
			console.log(dataResult);
			if (dataResult.statuscode == "s") {
				$(".savecomment5").prop('disabled', true);
        $("#comment_form2")[0].reset();
				$("#errorcommentstep").hide();
				$("#successcommentstep").show();
				$('#successcommentstep').html(dataResult.description);
				 loadcommentsteptable(dataResult.tguid,dataResult.tsequenceid);
			} else {
				$(".savecomment5").prop('disabled', false);
				$("#successcommentstep").hide();
				$("#errorcommentstep").show();
				$('#errorcommentstep').html(dataResult.description);
			}
		}


	});

	});


});
