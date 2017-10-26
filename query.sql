CREATE DATABASE midtermAfenkin;
CREATE TABLE Lecturers (
  lecturer_id integer NOT NULL AUTO_INCREMENT UNIQUE,
  lecturer_name varchar(40),
  lecturer_surname varchar(50),
  lecturer_subject varchar(50)
);

INSERT INTO Lecturers (
	lecturer_name,
	lecturer_surname,
	lecturer_subject
)
VALUES
	('Leanne', 'Graham', 'Discrete Mathematics'),
	('Ervin', 'Howell', 'Physics'),
	('Clementine', 'Bauch', 'Electronics'),
	('Petricia', 'Lebsack', 'Digital Technology'),
	('Chelsey', 'Dietrich', 'P.E.');

CREATE TABLE Students (
	student_id integer NOT NULL AUTO_INCREMENT UNIQUE,
	student_name varchar(40),
	student_surname varchar(40)
);
INSERT INTO Students (
	student_name,
	student_surname
) 
VALUES
	('Dennis', 'Schulist'),
	('Kurtis', 'Weissnat'),
	('Nicholas', 'Runolfsdottir'),
	('Glenna', 'Reichert');

CREATE TABLE Exams (
	exam_id int NOT NULL AUTO_INCREMENT UNIQUE,
	lecturer_id int NOT NULL,
	student_id int NOT NULL,
	exam_mark int NOT NULL,
	exam_date varchar(30),
	PRIMARY KEY (exam_id),
	FOREIGN KEY (lecturer_id) REFERENCES Lecturers(lecturer_id),
	FOREIGN KEY (student_id) REFERENCES Students(student_id)
);