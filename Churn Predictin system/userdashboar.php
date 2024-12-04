<?php 
include 'action.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DahBoard For Staff</title>
    <style>
        /* Container for the table with fixed height and scrollable */
        .table-container {
            width: 99%;
            height: 400px; /* Set a fixed height for the scrollable container */
            overflow-y: auto; /* Enable vertical scrolling if content exceeds the container height */
            margin: 20px auto;
        }

        /* Styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgb(18, 0, 50);
            color: white;
        }

        /* Styling for status buttons */
        button {
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
        }

        .resolved {
            background-color: green;
            color: white;
        }

        .not-resolved {
            background-color: red;
            color: white;
        }

        /* Center the input box */
        .inputsection {
            display: flex;
            justify-content: center; /* Horizontally centers the content */
            align-items: center; /* Vertically centers the content */
            height: 100vh; /* Full height of the viewport */
            position: absolute; /* Positioning the div relative to the page */
            top: 50%; /* Move the div to the vertical center */
            left: 50%; /* Move the div to the horizontal center */
            transform: translate(-50%, -50%); /* Adjust for exact centering */
            width: 100%;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th><b>REF.Id</b></th>
                <th><b>Name</b></th>
                <th><b>Email Id</b></th>
                <th><b>Message</b></th>
                <th><b>Time</b></th>
                <th><b>Status</b></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $q = "SELECT id, name, email, message, times, status FROM info where status=0";
            $qtodbms = mysqli_query($connection, $q);

            while ($f = mysqli_fetch_assoc($qtodbms)) {
                echo "<tr>";
                echo "<td>" . $f["id"] . "</td>";
                echo "<td>" . $f["name"] . "</td>";
                echo "<td>" . $f["email"] . "</td>";
                echo "<td>" . $f["message"] . "</td>";
                echo "<td>" . $f["times"] . "</td>";
                echo "<td>";
                $p = $f["status"];
                if ($p == '0') {
                    echo "<button class='not-resolved'>Not Resolved</button>";
                } else {
                    echo "<button class='resolved'>Resolved</button>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="inputsection">

   <form action ="action.php" method="post">

    <b>Ref Id:&nbsp;</b>
    <input type="text" placeholder="Ref Id For Validate" name="refids" autofocus required>&nbsp;
    <button style="background-color:red;color:white" name ="validations">Validate</button>
        </form>
</div>

</body>
</html>
