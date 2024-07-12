<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>CodePen - A Pen by Watcharaphong Phimphatham</title>
  <!-- <link rel="stylesheet" href="./style.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  <style>
    .fc-h-event {
      background-color: var(--fc-event-bg-color);
      border: 1px solid #dfa8a8;
      display: block;
    }

    .fc .fc-daygrid-event {
      margin-top: 2px;
      z-index: 6;
    }

    .fc-direction-ltr .fc-daygrid-event.fc-event-start,
    .fc-direction-rtl .fc-daygrid-event.fc-event-end {
      margin-left: 3%;
      margin-right: 3%;
      padding: 5px;
    }

    a {
      color: black;
      text-decoration: none;
    }

    .fc td{
      padding: 0px;
      vertical-align: top;
      height: 100px;
    }
  </style>
  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="container">
    <div id='calendar'></div>
  </div>
  <!-- partial -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          // start: 'dayGridMonth,timeGridWeek,timeGridDay custom1',
          start: 'dayGridMonth',
          center: 'title',
          // end: 'custom2 prevYear,prev,next,nextYear'
          end: 'prevYear,prev,next,nextYear'
        },
        footerToolbar: {
          // start: 'custom1,custom2',
          center: '',
          end: 'prev,next'
        },
        // customButtons: {
        //   custom1: {
        //     text: 'custom 1',
        //     click: function() {
        //       alert('clicked custom button 1!');
        //     }
        //   },
        //   custom2: {
        //     text: 'custom 2',
        //     click: function() {
        //       alert('clicked custom button 2!');
        //     }
        //   }
        // },
        events: {
          url: 'events.php',
          method: 'GET',
          failure: function() {
            alert('there was an error while fetching events!');
          }
        },
        eventDidMount: function(info) {
          // กำหนดสีของเหตุการณ์ตามที่ส่งมาจาก PHP
          info.el.style.backgroundColor = info.event.extendedProps.eventColor;
          // ตรวจสอบค่า eventColor เพื่อกำหนดตำแหน่งข้อความ
          if (info.event.extendedProps.eventColor === '#1795ce') {
            info.el.style.textAlign = 'left'; // จัดตำแหน่งข้อความไว้ทางซ้าย
          } else if (info.event.extendedProps.eventColor === '#8de02c') {
            info.el.style.textAlign = 'right'; // จัดตำแหน่งข้อความไว้ทางขวา
          }
        },
        // eventClick: function(info) {
        //   // การทำงานเมื่อคลิกที่เหตุการณ์
        //   alert('Event: ' + info.event.title);
        // }
      });

      calendar.render();
    });
  </script>

</body>

</html>