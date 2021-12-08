<?php
    // Generates a list of all the requst for a given semester in the following format
    // Professor's email, class, title, authors, edition, publisher, ISBN, and count
    // Allows the admins to see which professor is requestion what book, for what class, and how many books


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
                <th>professor's email</th>
                <th>class</th>
                <th>title</th>
                <th>authors</th>
                <th>edition</th>
                <th>publisher</th>
                <th>ISBN</th>
                <th>count</th>
            </tr>

        <?php
            
            $semester = $_GET['semester'];

            echo "<h1>Final Book Request Form for $semester</h1>";
        
            // Gets all books that have a corresponding semester attribute value
            // Orders by semester for consistency and readability
            $query = "SELECT * FROM books WHERE semester = '{$semester}' ORDER BY semester";
            
            if ($result = $conn->query($query)) {
            
                while ($row = $result->fetch_assoc()) {

                    $email = $row['email'];
                    $ISBN = $row['ISBN'];
                    $title = $row['title'];
                    $count = $row['count'];
                    $class = $row['class'];
                    $authors = $row['authors'];
                    $edition = $row['edition'];
                    $publisher = $row['publisher'];

                ?>

                    <tr>
                        <td><?php echo $email?></td>
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
