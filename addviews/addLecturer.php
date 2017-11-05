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
	<h1>Add new Lecturer</h1>
		<form action="addLecturer.php" method="POST">
			<input type="text" name="name" id="name" placeholder="Name" required><br>
			<input type="text" name="surname" id="surname" placeholder="Surname" required><br>
			<input type="text" name="subject" id="subject" placeholder="Subject" required><br>
			<input type="submit" value="Add lecturer">
		</form>
		<nav>
			<a href="../index.html">Main page</a>
			<a href="../showviews/showLecturers.php">Show all lecturers</a>
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
		if(isset($_POST["subject"]))
			$subject = $_POST["subject"];
		else
			$pushAllowed = false;

		if($pushAllowed) {
			$conn->query("INSERT INTO lecturers (lecturer_name, lecturer_surname, lecturer_subject) VALUES (\"$name\", \"$surname\", \"$subject\")");
			header('location: ../showviews/showLecturers.php');
		}
		$conn->close();
	?>
</body>
</html>