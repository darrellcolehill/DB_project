<?php

    include_once('db_connection.php');

    $month = date('m');
    $year = date('y');

    if($month >= 1 && $month <= 5){ // current is spring, so get summer
        $semester = "SUMMER{$year}";
    } 
    else if($month >= 6 && $month <= 8) // current is summer, so get fall
    {
        $semester = "FALL{$year}";
    }
    else // current if fall, so get spring
    {
        $year = $year + 1;
        $semester = "SPRING{$year}";
    }
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
                <th>class</th>
                <th>title</th>
                <th>authors</th>
                <th>edition</th>
                <th>publisher</th>
                <th>ISBN</th>
                <th>count</th>
            </tr>

        <?php

            echo "<h1>Final Book Request Form for $semester</h1>";
        

            $query = "SELECT ISBN, title, class, authors, edition, publisher, SUM(count) AS count 
                      FROM books 
                      WHERE semester = '{$semester}' 
                      GROUP BY ISBN, title, class";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {

                    $ISBN = $row['ISBN'];
                    $title = $row['title'];
                    $count = $row['count'];
                    $class = $row['class'];
                    $authors = $row['authors'];
                    $edition = $row['edition'];
                    $publisher = $row['publisher'];

                ?>

                    <tr>
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
