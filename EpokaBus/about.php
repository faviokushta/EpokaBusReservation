<!DOCTYPE html>
<html>
<head>
    <title>About Us</title>
    <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f2f2f2;
      color: #333;
    }
        /* Style for the table */
        table {
            border: 2px solid black;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Bus Timetable</h1>

    <table>
        <thead>
            <tr>
                <th>Route</th>
                <th>Departure Times (Mon-Fri)</th>
                <th>Departure Times (Sat)</th>
                <th>Number of Buses</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tirana - Campus</td>
                <td>07:40, 08:40, 09:40, 10:40, 11:40, 12:40, 13:40, 14:40, 15:40, 16:40, 17:40</td>
                <td>08:30</td>
                <td>2-4</td>
            </tr>
            <tr>
                <td>Campus - Tirana</td>
                <td>09:55-10:55, 11:55, 12:55, 13:55, 14:55, 15:55, 16:55, 18:55, 20:55</td>
                <td>13:10</td>
                <td>2-4</td>
            </tr>
            <tr>
                <td>Durres - Campus</td>
                <td>08:00, 09:30, 11:00, 13:00, 15:00</td>
                <td>---</td>
                <td>3</td>
            </tr>
            <tr>
                <td>Campus - Durres</td>
                <td>10:15, 12:15, 14:15, 15:40, 17:15</td>
                <td>---</td>
                <td>3</td>
            </tr>
        </tbody>
    </table>
    <p><a href="dashboard.php">Go to Dashboard</a></p>
</body>
</html>