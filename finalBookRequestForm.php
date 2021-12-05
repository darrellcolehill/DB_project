<?php

    include_once('db_connection.php');

?>



<!DOCTYPE html>

<html>

    <style>
        table, th, td {
        border:1px solid black;
        }
        input{
            width: 97%;
        }
    </style>

    <body>

        <table style="width:100%">
            <tr>
                <th>title</th>
                <th>ISBN</th>
                <th>class</th>
                <th>count</th>
            </tr>

        <?php
            $username = "b"; // TODO: change this to the user name stored in the cookie created during login
            // TODO: add user authenticaion here. Maybe just check if the token containing the username also contains a role value equal to "admin"

            $semester = $_GET['semester'];

            echo "<h1>Final Book Request Form for $semester</h1>";
        

            $query = "SELECT ISBN, title, class, SUM(count) AS count FROM books WHERE semester = '{$semester}' GROUP BY ISBN, title, class";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {

                    $ISBN = $row['ISBN'];
                    $title = $row['title'];
                    $count = $row['count'];
                    $class = $row['class'];

                ?>

                    <tr>
                        <td><?php echo $title?></td>
                        <td><?php echo $ISBN?></td>
                        <td><?php echo $class?></td>
                        <td><?php echo $count?></td>
                    </tr>
         <?php
                }
            
            $result->free();
            }

        ?>

    </body>

</html>
