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
    <h1>Delete students</h1>
    <?php 
        $students = $conn->query("SELECT * FROM students");
        if (!$students) 
            die ($conn->error);
        $studentsRecords = $students->num_rows;
    ?>
	<form action="deleteStudent.php" method="POST">
        <section>
            <label for="student">Please select student</label><br>
            <select name="studentToDelete" id="student">
                <?php
                    $i = 0;
                    while($i < $studentsRecords) {
                        $students->data_seek($i);
                        $row = $students->fetch_assoc();

                        $student_id = $row["student_id"];
                        $student_name = $row["student_name"];
                        $student_surname = $row["student_surname"];
                        echo "<option value=".$student_id.">".$student_name." ".$student_surname."</option>";
                        $i++;
                    }
                    $students->close();
                ?>
            </select>
        </section>
        <input type="submit" value="Delete student">
    </form>
	<nav>
		<a href="../index.html">Main page</a>
        <a href="../addviews/addStudent.php">Add new student</a>
        <a href="../showviews/showStudents.php">Show all students</a>
    </nav>
    <?php
        $pushAllowed = true;
        if(isset($_POST["studentToDelete"]))
            $idToDelete = $_POST["studentToDelete"];
        else
            $pushAllowed = false;

        if($pushAllowed) {
            $conn->query("DELETE FROM students WHERE student_id = '$idToDelete'");
            header("location: ../showviews/showStudents.php");
        }
        $conn->close();
    ?>
</body>
</html>