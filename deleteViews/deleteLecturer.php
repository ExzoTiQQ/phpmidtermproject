<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MidTerm App</title>
	<link rel="stylesheet" href="../css/style.css">
	<?php
		$username = 'root';
		$password = '';
		$server = 'localhost';
		$database = 'midtermafenkin';
		$br = "<br>";

		$conn = new mysqli($server, $username, $password, $database);
	?>
</head>
<body>
    <h1>Delete Lecturers</h1>
    <?php 
        $lecturers = $conn->query("SELECT * FROM lecturers");
        if (!$lecturers) 
            die ($conn->error);
        $lecturersRecords = $lecturers->num_rows;
    ?>
	<form action="deleteLecturer.php" method="POST">
        <section>
            <label for="lecturer">Please select teacher</label><br>
            <select name="lecturerToDelete" id="lecturer">
                <?php
                    $i = 0;
                    while($i < $lecturersRecords) {
                        $lecturers->data_seek($i);
                        $row = $lecturers->fetch_assoc();

                        $lecturer_id = $row["lecturer_id"];
                        $lecturer_name = $row["lecturer_name"];
                        $lecturer_surname = $row["lecturer_surname"];
                        echo "<option value=".$lecturer_id.">".$lecturer_name." ".$lecturer_surname."</option>";
                        $i++;
                    }
                    $lecturers->close();
                ?>
            </select>
        </section>
        <input type="submit" value="Delete lecturer">
    </form>
	<nav>
		<a href="../index.html">Main page</a>
        <a href="../addviews/addLecturer.php">Add new lecturer</a>
        <a href="../showviews/showLecturers.php">Show all lecturers</a>
    </nav>
    <?php
        $pushAllowed = true;
        if(isset($_POST["lecturerToDelete"]))
            $idToDelete = $_POST["lecturerToDelete"];
        else
            $pushAllowed = false;

        if($pushAllowed) {
            echo("DELETE FROM lecturers WHERE lecturer_id = '$idToDelete'");
            $conn->query("DELETE FROM lecturers WHERE lecturer_id = '$idToDelete'");
            header("location: ../showviews/showLecturers.php");
        }
        $conn->close();
    ?>
</body>
</html>