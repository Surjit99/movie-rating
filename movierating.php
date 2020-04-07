<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "website";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM movies";
    $result = mysqli_query($conn, $sql);
    $j=0;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
            $i=0;
            echo "<b>Movie : ".$row["name"]."</b>----->>>>";
            
            $j=$row["id"];
            $sql2 = "SELECT * FROM user_rating where movieid='$j'";
            $result2 = mysqli_query($conn, $sql2);
			$i=0;
            $c=0;
            if (mysqli_num_rows($result2) > 0) {
                // output data of each row
                while($row2 = mysqli_fetch_assoc($result2)) {
                    $i+=$row2["userrating"];
                    $c++;
                }
            echo "<b>AVG Rating : ".($i/$c)."</b><br>";
            } else {
                echo "No rating found<br>";
            }
        }
    } else {
        echo "No movie added";
    }

    mysqli_close($conn);
?>