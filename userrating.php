<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="name"><br>
        <select name="movies" required>
            <option value="">Select Movie</option>
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

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row["id"]. "'>" . $row["name"]. "</option>";
                    }
                } else {
                    echo "0 results";
                }

                mysqli_close($conn);
            ?>
        </select><br>
        <b>Select Rating</b>
        <label><input type="radio" name="rating" value="1">1</label>
        <label><input type="radio" name="rating" value="2">2</label>
        <label><input type="radio" name="rating" value="3">3</label>
        <label><input type="radio" name="rating" value="4">4</label>
        <label><input type="radio" name="rating" value="5">5</label>
        <br>
        <input type="submit" value="submit" name="s1">
        <?php
            if(isset($_POST['s1'])!=null)
            {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "website";
                $name=$_POST['username']; 
                $movie=$_POST['movies'];
                $rating=$_POST['rating'];
                // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                $av=0;
                $n=0;
                $sql = "SELECT userrating FROM user_rating where movieid='$movie'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        $av+=$row["userrating"];
                        $n++;   
                    }
                } else {
                    echo "0 results";
                }
                if($n==0)
                {
                    $avgrating=$rating;   
                }
                else
                {
                    $avgrating=($av+$rating)/$n;  
                }
                $sql = "INSERT INTO user_rating (username, movieid, userrating, averagerating)
                VALUES ('$name', '$movie', '$rating','$avgrating')";

                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        ?>
    </form>
</body>
</html>