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
    <h1>Delete Exam Meeting</h1>
    <?php 
        $data = $conn->query("SELECT exams.exam_id, lecturers.lecturer_name, lecturers.lecturer_surname, students.student_name, students.student_surname, lecturers.lecturer_subject, exams.exam_date
        FROM lecturers, students, exams
        WHERE exams.lecturer_id = lecturers.lecturer_id AND exams.student_id = students.student_id");
        if (!$data) 
            die ($conn->error);
        $num = $data->num_rows;
    ?>
	<form action="deleteExamMeeting.php" method="POST">
        <section>
            <label for="meeting">Please select exam meeting to remove</label><br>
            <select name="meetingToRemove" id="meeting">
                <?php
                    $i = 0;
                    while($i < $num) {
                        $data->data_seek($i);
                        $row = $data->fetch_assoc();
                        
                        $exam_id = $row["exam_id"];
                        $lecturer_name = $row["lecturer_name"];
                        $lecturer_surname = $row["lecturer_surname"];
                        $student_name = $row["student_name"];
                        $student_surname = $row["student_surname"];
                        $subject = $row["lecturer_subject"];
                        $exam_date = $row["exam_date"];
                        echo "<option value=".$exam_id.">Lecturer: ".$lecturer_name." ".$lecturer_surname.", Student: ".$student_name." ".$student_surname.", Subject: ".$subject.", Date: ".$exam_date."</option>";
                        $i++;
                    }
                    $data->close();
                ?>
            </select>
        </section>
        <input type="submit" value="Delete exam meeting">
    </form>
	<nav>
		<a href="../index.html">Main page</a>
        <a href="../addviews/addExamMeeting.php">Add new exam meeting</a>
        <a href="../showviews/showExams.php">Show all exam meetings</a>
    </nav>
    <?php
        $pushAllowed = true;
        if(isset($_POST["meetingToRemove"]))
            $meetingId = $_POST["meetingToRemove"];
        else
            $pushAllowed = false;

        if($pushAllowed) {
            $conn->query("DELETE FROM exams WHERE exam_id = '$meetingId'");
            header("location: ../showviews/showExams.php");
        }
        $conn->close();
    ?>
</body>
</html>