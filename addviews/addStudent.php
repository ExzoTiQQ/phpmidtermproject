<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>MidTerm App</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1>Add new Student</h1>
		<form action="addStudent.php" method="POST">
			<input type="text" name="name" id="name" placeholder="Name" required><br>
			<input type="text" name="surname" id="surname" placeholder="Surname" required><br>
			<input type="submit" value="Add student">
		</form>
		<nav>
			<a href="../index.html">Main page</a>
			<a href="../showviews/showStudents.php">Show all students</a>
			<a href="../deleteViews/deleteStudent.php">Delete student</a>
		</nav>
	<?php
		$username = 'root';
		$password = '';
		$server = 'localhost';
		$database = 'midtermafenkin';
		$br = "<br>";

		$conn = new mysqli($server, $username, $password, $database);
		if($conn->connect_error) die($conn->connect_error);
		$pushAllowed = true;
		if(isset($_POST["name"]))
			$name = $_POST["name"];
		else
			$pushAllowed = false;
		if(isset($_POST["surname"]))
			$surname = $_POST["surname"];
		else
			$pushAllowed = false;

		if($pushAllowed) {
			$conn->query("INSERT INTO students (student_name, student_surname) VALUES (\"$name\", \"$surname\")");
			header('location: ../showviews/showStudents.php');
		}
		$conn->close();
	?>
</body>
</html>