<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colorful Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .calendar {
            width: 100%;
            height: 90%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
        }
        .calendar-header button {
            background-color: #fff;
            color: #4CAF50;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .calendar-header button:hover {
            background-color: #45a049;
            color: #fff;
        }
        .calendar-header h2 {
            margin: 0;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #ddd;
            flex-grow: 1;
        }
        .calendar-cell {
            border: 1px solid #ddd;
            background-color: #fff;
            min-height: 120px;
            position: relative;
            padding: 5px;
            box-sizing: border-box;
            transition: background-color 0.3s;
            overflow-y: auto;
        }
        .calendar-cell:hover {
            background-color: #f1f1f1;
        }
        .event-status {
            font-size: 12px;
            margin-bottom: 3px;
            padding: 2px 4px;
            border-radius: 3px;
            color: #fff;
            cursor: pointer;
        }
        .event-complete {
            background-color: #4CAF50;
        }
        .event-inprocess {
            background-color: #FF9800;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="calendar">
        <div class="calendar-header">
            <button id="prev-month">Prev</button>
            <h2 id="month-year"></h2>
            <button id="next-month">Next</button>
        </div>
        <div class="calendar-grid" id="calendar-grid">
            <!-- Calendar cells will be generated here -->
        </div>
    </div>

    <!-- Modal -->
    <div id="event-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 id="event-title"></h2>
            <p id="event-date"></p>
            <p id="event-description"></p>
            <p id="event-status"></p>
        </div>
    </div>

    <script>
        let currentDate = new Date();

        function renderCalendar() {
            const monthYear = document.getElementById('month-year');
            const calendarGrid = document.getElementById('calendar-grid');

            monthYear.textContent = currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
            
            const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
            const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);

            calendarGrid.innerHTML = '';

            // เติมช่องว่างก่อนวันที่ 1
            for (let i = 0; i < firstDay.getDay(); i++) {
                const emptyCell = document.createElement('div');
                emptyCell.classList.add('calendar-cell');
                calendarGrid.appendChild(emptyCell);
            }

            // สร้างช่องวันที่
            for (let day = 1; day <= lastDay.getDate(); day++) {
                const cell = document.createElement('div');
                cell.classList.add('calendar-cell');
                cell.dataset.date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day).toISOString().split('T')[0];
                cell.textContent = day;
                calendarGrid.appendChild(cell);
            }

            fetchEvents();
        }

        function fetchEvents() {
            fetch('events.php')
                .then(response => response.json())
                .then(events => {
                    events.forEach(event => {
                        const eventDate = new Date(event.date).toISOString().split('T')[0];
                        const cell = document.querySelector(`.calendar-cell[data-date='${eventDate}']`);
                        if (cell) {
                            const eventStatus = document.createElement('div');
                            eventStatus.classList.add('event-status');
                            if (event.status.toLowerCase() === 'complete') {
                                eventStatus.classList.add('event-complete');
                            } else if (event.status.toLowerCase() === 'inprocess') {
                                eventStatus.classList.add('event-inprocess');
                            }
                            eventStatus.textContent = `${event.status}: ${event.count}`;
                            eventStatus.dataset.title = event.title;
                            eventStatus.dataset.date = event.date;
                            eventStatus.dataset.description = event.description;
                            eventStatus.dataset.status = event.status;
                            eventStatus.onclick = () => openModal(eventStatus.dataset);
                            cell.appendChild(eventStatus);
                        }
                    });
                });
        }

        function openModal(event) {
            const modal = document.getElementById("event-modal");
            const span = document.getElementsByClassName("close")[0];

            document.getElementById('event-title').textContent = event.title;
            document.getElementById('event-date').textContent = `Date: ${event.date}`;
            document.getElementById('event-description').textContent = `Description: ${event.description}`;
            document.getElementById('event-status').textContent = `Status: ${event.status}`;

            modal.style.display = "block";

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        renderCalendar();
    </script>
</body>
</html>
