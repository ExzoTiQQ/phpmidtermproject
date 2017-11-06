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
	?>
</head>
<body>
	<h1>Add new exam meeting</h1>
	<?php
		$lecturers = $conn->query("SELECT * FROM lecturers");
		if (!$lecturers) die ($conn->error);
		$students = $conn->query("SELECT * FROM students");
		if (!$students) die ($conn->error);
		
		$lecturersRecords = $lecturers->num_rows;
		$studentsRecords = $students->num_rows;
	?>
		<form action="addExamMeeting.php" method="POST">
			<section>
				<label for="lecturer">Please select teacher</label><br>
				<select name="lecturer" id="lecturer">
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
					?>
				</select>
			</section>
			<section>
				<label for="student">Please select student</label><br>
				<select name="student" id="student">
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
					?>
				</select>
			</section>
			<section>
				<label for="grade">Please choose mark (1-5)</label><br>
				<input name="grade" type="number" min="1" max="5" id="grade" value="5">
			</section>
			<section>
				<label for="meetingDate">Please enter the date of exam</label><br>
				<input type="text" id="meetingDate" name="meetingDate" placeholder="For example: 'January 11'">
			</section>
			<input type="submit" value="Add meeting">
		</form>
		<nav>
			<a href="../index.html">Main page</a>
			<a href="../showviews/showExams.php">Show all exam meetings</a>
			<a href="../deleteViews/deleteExamMeeting.php">Delete exam meeting</a>
		</nav>
		<?php
			$pushAllowed = true;
			if(isset($_POST["lecturer"]))
				$lecturer_id = $_POST["lecturer"];
			else
				$pushAllowed = false;
			if(isset($_POST["student"]))
				$student_id = $_POST["student"];
			else
				$pushAllowed = false;
			if(isset($_POST["grade"]))
				$grade = $_POST["grade"];
			else
				$pushAllowed = false;
			if(isset($_POST["meetingDate"]))
				$meetingDate = $_POST["meetingDate"];
			else
				$pushAllowed = false;

			if($pushAllowed) {
				$conn->query("INSERT INTO exams (lecturer_id, student_id, exam_mark, exam_date) VALUES (\"$lecturer_id\", \"$student_id\", \"$grade\", \"$meetingDate\")");
				header("location: ../showviews/showExams.php");
			}
			$conn->close();
		?>
</body>
</html>