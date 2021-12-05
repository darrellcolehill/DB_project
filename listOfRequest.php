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
                <th>professor</th>
                <th>class</th>
                <th>title</th>
                <th>authors</th>
                <th>edition</th>
                <th>publisher</th>
                <th>ISBN</th>
                <th>count</th>
            </tr>

        <?php
            $username = "b"; // TODO: change this to the user name stored in the cookie created during login
            // TODO: add user authenticaion here. Maybe just check if the token containing the username also contains a role value equal to "admin"

            $semester = $_GET['semester'];

            echo "<h1>Final Book Request Form for $semester</h1>";
        

            $query = "SELECT * FROM books WHERE semester = '{$semester}' ORDER BY semester";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {

                    $username = $row['username'];
                    $ISBN = $row['ISBN'];
                    $title = $row['title'];
                    $count = $row['count'];
                    $class = $row['class'];
                    $authors = $row['authors'];
                    $edition = $row['edition'];
                    $publisher = $row['publisher'];

                ?>

                    <tr>
                        <td><?php echo $username?></td>
                        <td><?php echo $class?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $authors?></td>
                        <td><?php echo $edition?></td>
                        <td><?php echo $publisher?></td>
                        <td><?php echo $ISBN?></td>
                        <td><?php echo $count?></td>
                    </tr>
         <?php
                }
            
            $result->free();
            }

        ?>

    </body>

</html>
