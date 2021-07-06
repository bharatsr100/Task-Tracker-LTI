$(document).ready(function() {

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

});
