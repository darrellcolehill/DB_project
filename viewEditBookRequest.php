<?php
    include_once('db_connection.php');

    $email = "b@ucf.com"; // TODO: change to get from cookie/session

    if(isset($_GET['delete']))
    {
        $delete = $_GET['delete'];
        if($delete == 'true')
        {
            $ISBN = $_GET['ISBN'];
            $semester = $_GET['semester'];
            $class = $_GET['class'];

            // Deletes book with specified key
            $query = "DELETE FROM books WHERE email = '{$email}' AND semester = '{$semester}' AND ISBN = '{$ISBN}' AND class = '{$class}'";
            if ($result = $conn->query($query)) {
                header("Location: http://localhost/DB_project/viewEditBookRequest.php?semester=$semester"); 
            } 
            else{
                echo "ERROR: Could not able to execute $query. ";
                echo $conn->error;
            }
        }
        
         
    }


    if(isset($_GET['add'])) {

        $class = $_GET['class'];
        $ISBN = $_GET['ISBN'];
        $semester = $_GET['semester'];
        $title = $_GET['title'];
        $authors = $_GET['authors'];
        $publisher = $_GET['publisher'];
        $edition = $_GET['edition'];
        $count = $_GET['count'];

        // Inserts book with specified values
        $query = "INSERT INTO books
        VALUES ('{$email}', '{$semester}', '{$ISBN}', '{$class}', '{$title}', '{$authors}', '{$edition}', '{$publisher}', {$count})";

        if ($result = $conn->query($query)) {
            header("Location: http://localhost/DB_project/viewEditBookRequest.php?semester=$semester"); 
        } 
        else{
            echo "ERROR: Could not able to execute $query. ";
        }
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


        <script>
            function myFunction(elmnt,clr) {
                location.replace("http://localhost/DB_project/viewAllBookRequest.php")
            }
        </script>
        <?php
            
            $semester = $_GET['semester'];
            
            echo "<h1>{$semester}</h1>";

            // TODO: change to email
            $query = "SELECT * FROM books WHERE email = '{$email}' AND semester = '{$semester}'";
            
            if ($result = $conn->query($query)) {
                ?>
                <table style="width:100%">
                    <tr>
                        <th>class</th>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Edition</th>
                        <th>Publisher</th>
                        <th>count</th>
                        <th>Options</th>
                    </tr>
                <?php
            
                while ($row = $result->fetch_assoc()) {

                    $class = $row["class"];
                    $ISBN = $row["ISBN"];
                    $title = $row["title"];
                    $authors = $row["authors"];
                    $edition = $row["edition"];
                    $publisher = $row["publisher"];
                    $count = $row["count"];
                    ?>

                    <tr>
                        <td><?php echo $class?></td>
                        <td><?php echo $ISBN?></td>
                        <td><?php echo $title?></td>
                        <td><?php echo $authors?></td>
                        <td><?php echo $edition?></td>
                        <td><?php echo $publisher?></td>
                        <td><?php echo $count?></td>
                        <td><?php echo "<button><a href='http://localhost/DB_project/viewEditBookRequest.php?delete=true&semester=$semester&ISBN=$ISBN&class=$class'>Delete</a></button>" ?></td>
                    </tr>
                    <?php

                }
            

            $result->free();
            }
        ?>          
                    
                    <form action='http://localhost/DB_project/viewEditBookRequest.php?delete=true&semester=$semester' method='GET'>
                        <tr>
                            <td><input type="text" name="class"></td>
                            <td><input type="text" name="ISBN"></td>
                            <td><input type="text" name="title"></td>
                            <td><input type="text" name="authors"></td>
                            <td><input type="text" name="edition"></td>
                            <td><input type="text" name="publisher"></td>
                            <td><input type="text" name="count"></td>
                            <?php echo "<input type='hidden' name='semester' value='$semester'>" ?>
                            <td><input type='submit' name='add' value='add'></td>
                        </tr>
                    </form>
                </table>
        </br>
        </br>
        </br>


        <button onClick="myFunction()">back</button></br>
    </body>
</html>








