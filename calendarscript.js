$('.eventstage1').click(function(){
  alert('Clicked !!');
});


let nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const newEventModal = document.getElementById('newEventModal');
const deleteEventModal = document.getElementById('deleteEventModal');
const backDrop = document.getElementById('modalBackDrop');
const eventTitleInput = document.getElementById('eventTitleInput');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function openModal(date) {
  clicked = date;

  const eventForDay = events.find(e => e.date === clicked);

  if (eventForDay) {
    document.getElementById('eventText').innerText = eventForDay.title;
    //deleteEventModal.style.display = 'block';
  } else {
    //newEventModal.style.display = 'block';
  }

  //backDrop.style.display = 'block';
}

function load() {
  const dt = new Date();

  if (nav !== 0) {
    dt.setMonth(new Date().getMonth() + nav);
  }

  const day = dt.getDate();
  const month = dt.getMonth();
  const year = dt.getFullYear();

  const firstDayOfMonth = new Date(year, month, 1);
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });
  const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

  document.getElementById('monthDisplay').innerText =
    `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

  calendar.innerHTML = '';

  for(let i = 1; i <= paddingDays + daysInMonth; i++) {
    const daySquare = document.createElement('div');
    daySquare.classList.add('day');

    const dayString = `${month + 1}/${i - paddingDays}/${year}`;
    var day2=`${i - paddingDays}`;
    var month2=`${month + 1}`;
    if(parseInt(day2)<10 && parseInt(day2)>=0){
      day2= "0"+day2;
      //day2= `0${i - paddingDays}`;
    }
    if(parseInt(month2)<"10"){
      month2="0"+month2;
      month2=`0${month + 1}`;
    }
    const dayString2 = `${year}-${month2}-${day2}`;
    //console.log(dayString2);
    if (i > paddingDays) {
      daySquare.innerText = i - paddingDays;

      var type= "3";

      $.ajax({
        url: "updatetask1.php",
        type: "POST",

        data:    {
              type: type,
              date: dayString2
            },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          //console.log("Result for "+ dayString2);
          //console.log(dataResult);
          //console.log("Result loaded");
          var reslength= dataResult.length;
        //  console.log(reslength);
          if(reslength){
            var eventDiv = document.createElement('div');
            eventDiv.addEventListener("click", function() {
                $('#showstage1tasks').modal('show');
                $("#stage1title").html("");
                $("#stage1list").html("");
                $("#stage1title").append("To be Planned Tasks ("+ dayString2 +")");

                $(dataResult).each(function (index, item) {
                  $("#stage1list").append("  <li class='list-group-item'>"+item.tid+"&nbsp;&nbsp;"+item.tstepdescription +"</li>");

                });

               //alert("You clicked this div");
            });
            eventDiv.classList.add('eventstage1');
            eventDiv.innerText = reslength;
            daySquare.appendChild(eventDiv);


            //   $(dataResult).each(function (index, item) {
            //   var eventDiv = document.createElement('div');
            //   eventDiv.classList.add('eventstage1');
            //   eventDiv.innerText = item.tid;
            //   daySquare.appendChild(eventDiv);
            // });

          }


        }
      });




      // const eventForDay = events.find(e => e.date === dayString);
      //
      if (i - paddingDays === day && nav === 0) {
        daySquare.id = 'currentDay';
      }
      //
      // if (eventForDay) {
      //   const eventDiv = document.createElement('div');
      //   eventDiv.classList.add('event');
      //   eventDiv.innerText = eventForDay.title;
      //   daySquare.appendChild(eventDiv);
      // }
      //
      //  daySquare.addEventListener('click', () => openModal(dayString));
    } else {
      daySquare.classList.add('padding');
    }

    calendar.appendChild(daySquare);
  }
}

function closeModal() {
  eventTitleInput.classList.remove('error');
  newEventModal.style.display = 'none';
  deleteEventModal.style.display = 'none';
  backDrop.style.display = 'none';
  eventTitleInput.value = '';
  clicked = null;
  load();
}

function saveEvent() {
  if (eventTitleInput.value) {
    eventTitleInput.classList.remove('error');

    events.push({
      date: clicked,
      title: eventTitleInput.value,
    });

    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
  } else {
    eventTitleInput.classList.add('error');
  }
}

function deleteEvent() {
  events = events.filter(e => e.date !== clicked);
  localStorage.setItem('events', JSON.stringify(events));
  closeModal();
}

function initButtons() {
  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });
  document.getElementById('todayButton').addEventListener('click', () => {
    nav=0;
    load();
  });

  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });

  document.getElementById('saveButton').addEventListener('click', saveEvent);
  document.getElementById('cancelButton').addEventListener('click', closeModal);
  document.getElementById('deleteButton').addEventListener('click', deleteEvent);
  document.getElementById('closeButton').addEventListener('click', closeModal);
}

initButtons();
load();
