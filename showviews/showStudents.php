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

		$data = $conn->query("SELECT * FROM students");
		if (!$data) 
			die ($conn->error);
		$conn->close();
		$num = $data->num_rows;
	?>
</head>
<body>
	<h1>Student</h1>
	<table>
		<tr>
			<th><strong>Name</strong></th>
			<th><strong>Surname</strong></th>
		</tr>
		<?php
			$i = 0;
			while($i < $num) {
				$data->data_seek($i);
				$row = $data->fetch_assoc();

				$student_name = $row["student_name"];
				$student_surname = $row["student_surname"];
				$i++;

				echo 	"<tr>
							<td>$student_name</td>
							<td>$student_surname</td>
						</tr>";
			}
			$data->close();
		?>
		</table>
	<nav>
		<a href="../index.html">Main page</a>
		<a href="../addviews/addStudent.php">Add new student</a>
		<a href="../deleteviews/deleteStudent.php">Delete student</a>
	</nav>
</body>
</html>