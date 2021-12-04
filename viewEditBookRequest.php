<?php
    include_once('db_connection.php');

    if(isset($_GET['delete']))
    {
        $delete = $_GET['delete'];
        if($delete == 'true')
        {
            $ISBN = $_GET['ISBN'];
            $username = $_GET['username']; // TODO: change to get this from cookie
            $semester = $_GET['semester'];

            // Deletes book with specified key
            $query = "DELETE FROM books WHERE username = '{$username}' AND semester = '{$semester}' AND ISBN = '{$ISBN}'";
            if ($result = $conn->query($query)) {
                header("Location: http://localhost/DB_project/viewEditBookRequest.php?semester=$semester"); 
            } 
            else{
                echo "ERROR: Could not able to execute $query. ";
            }
        }
        
         
    }


    if(isset($_GET['add'])) {
        $ISBN = $_GET['ISBN'];
        $username = $_GET['username']; // TODO: change to get this from cookie
        $semester = $_GET['semester'];
        $title = $_GET['title'];
        $authors = $_GET['authors'];
        $publisher = $_GET['publisher'];
        $edition = $_GET['edition'];

        // Inserts book with specified values
        $query = "INSERT INTO books (username, semester, ISBN, title, authors, edition, publisher) 
        VALUES ('{$username}', '{$semester}', '{$ISBN}', '{$title}', '{$authors}', '{$edition}', '{$publisher}')";

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
            

            $username = "b"; // TODO: change this to the user name stored in the cookie created during login
            $semester = $_GET['semester'];
            
            echo "<h1>{$semester}</h1>";

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
                        <td><?php echo "<button><a href='http://localhost/DB_project/viewEditBookRequest.php?delete=true&semester=$semester&ISBN=$ISBN&username=$username'>Delete</a></button>" ?></td>
                    </tr>
                    <?php

                }
            

            $result->free();
            }
        ?>          
                    
                    <form action='http://localhost/DB_project/viewEditBookRequest.php?delete=true&semester=$semester' method='GET'>
                        <tr>
                            <td><input type="text" name="ISBN"></td>
                            <td><input type="text" name="title"></td>
                            <td><input type="text" name="authors"></td>
                            <td><input type="text" name="edition"></td>
                            <td><input type="text" name="publisher"></td>
                            <?php echo "<input type='hidden' name='semester' value='$semester'>" ?>
                            <?php echo "<input type='hidden' name='username' value='$username'>" ?>
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








