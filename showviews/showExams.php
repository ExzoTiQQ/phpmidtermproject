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
		if($conn->connect_error) die($conn->connect_error);
		$data = $conn->query("SELECT lecturers.lecturer_name, lecturers.lecturer_surname, students.student_name, students.student_surname, lecturers.lecturer_subject, exams.exam_mark
			FROM lecturers, students, exams
			WHERE exams.lecturer_id = lecturers.lecturer_id AND exams.student_id = students.student_id");
		if (!$data) die ($conn->error);
		$conn->close();
		$num = $data->num_rows;
	?>
</head>
<body>
	<h1>Exam meetings</h1>
	<table>
		<tr>
			<th><strong>Lecturer</strong></th>
			<th><strong>Student</strong></th>
			<th><strong>Subject</strong></th>
			<th><strong>Mark</strong></th>
		</tr>
	<?php
		$i = 0;
		while($i < $num) {
			$data->data_seek($i);
			$row = $data->fetch_assoc();

			$lecturer_name = $row["lecturer_name"];
			$lecturer_surname = $row["lecturer_surname"];
			$student_name = $row["student_name"];
			$student_surname = $row["student_surname"];
			$subject = $row["lecturer_subject"];
			$mark = $row["exam_mark"];
			$i++;
			echo "<tr>
					<td>$lecturer_name $lecturer_surname</td>
					<td>$student_name $student_surname</td>
					<td>$subject</td>
					<td>$mark</td>
				<tr>";
		}
		$data->close();
	?>
	</table>
	<nav>
		<a href="../index.html">Main page</a>
		<a href="../addviews/addExamMeeting.php">Add new exam meeting</a>
	</nav>
</body>
</html>