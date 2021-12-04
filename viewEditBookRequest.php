<?php
    include_once('db_connection.php');
?>

<!DOCTYPE html>

<html>
    <style>
        table, th, td {
        border:1px solid black;
        }

        #secret {
            display:hidden;
            width = 0%;
        }
    </style>
    <body>


        <script>
            function myFunction(elmnt,clr) {
                location.replace("http://localhost/DB_project/viewAllBookRequest.php")
            }
        </script>
        <?php

            $username = "b"; // TODO: change this to the user name stored in the cookie created during login
            $semester = $_GET['semester'];

            $query = "SELECT * FROM books WHERE username = '{$username}' AND semester = '{$semester}'";
            
            if ($result = $conn->query($query)) {
                ?>
                <table style="width:100%">
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                        <th>Options</th>
                    </tr>
                <?php
            
                while ($row = $result->fetch_assoc()) {
                    /*
                    echo '<b>'.$row["ISBN"].'</b> ';
                    echo '<b>'.$row["title"].'</b> ';
                    echo '<b>'.$row["authors"].'</b> ';
                    echo '<b>'.$row["edition"].'</b> ';
                    echo '<b>'.$row["publisher"].'</b></br></b></br>';
                    */
                    $ISBN = $row["ISBN"];
                    $title = $row["title"];
                    $authors = $row["authors"];
                    $edition = $row["edition"];
                    $publisher = $row["publisher"];
                    ?>

                    <tr>
                        <td><?php echo $ISBN?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $authors?></td>
                        <td><?php echo $edition?></td>
                        <td><?php echo $publisher?></td>
                        <td><button>delele</button></td>

                    </tr>
                    <?php

                }
            

            $result->free();
            }
        ?>
                </table>
        </br>
        </br>
        </br>
        <button onClick="myFunction()">back</button></br>
    </body>
</html>








