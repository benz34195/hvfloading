<!DOCTYPE html>
<?php include 'fetch_data.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Data with AJAX</title>
    <script>
        function fetchRealtimeData() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_data.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('data').innerHTML = xhr.responseText;
                    
                }
            };
            xhr.send();
        }

        setInterval(fetchRealtimeData, 1000); // Fetch data every second
    </script>
    <script>
        function fetchRealtimeData() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_data.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('data').innerHTML = xhr.responseText;
                    
                }
            };
            xhr.send();
        }

        setInterval(fetchRealtimeData, 1000); // Fetch data every second
    </script>
</head>
<body>
    <h1>Realtime Data</h1>
    <div id="data">Loading...</div>
    <div id='loading'>Loading...</div>
</body>
</html>



