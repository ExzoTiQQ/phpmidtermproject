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
		if($conn->connect_error) 
			die($conn->connect_error);

		$data = $conn->query("SELECT * FROM lecturers");
		if (!$data) 
			die ($conn->error);
		$conn->close();
		$num = $data->num_rows;
	?>
</head>
<body>
	<h1>Lecturers</h1>
	<table>
		<tr>
			<th><strong>Name</strong></th>
			<th><strong>Surname</strong></th>
			<th><strong>Subject</strong></th>
		</tr>
	<?php
		$i = 0;
		while($i < $num) {
			$data->data_seek($i);
			$row = $data->fetch_assoc();

			$lecturer_name = $row["lecturer_name"];
			$lecturer_surname = $row["lecturer_surname"];
			$lecturer_subject = $row["lecturer_subject"];
			$i++;

			echo 	"<tr>
						<td>$lecturer_name</td>
						<td>$lecturer_surname</td>
						<td>$lecturer_subject</td>
					</tr>";
		}
		$data->close();
	?>
	</table>
	<nav>
		<a href="../index.html">Main page</a>
		<a href="../addviews/addLecturer.php">Add new lecturer</a>
	</nav>
</body>
</html>