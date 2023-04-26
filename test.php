<?php
  include 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>CSV Upload</title>
</head>
<body>
	<h1>Upload CSV File</h1>
	<form method="POST" enctype="multipart/form-data">
		<label for="file">Select file:</label>
		<input type="file" name="file" id="file"><br><br>
		<input type="submit" name="submit" value="Upload">
	</form>
	<?php
		if(isset($_POST["submit"])) {
			$filename = $_FILES["file"]["tmp_name"];
			if($_FILES["file"]["size"] > 0) {
				
				// Read CSV file
				$file = fopen($filename, "r");
				fgetcsv($file); // Skip header row
				$sections = array();
				$registrations = array();
				$questions = array();
				$grade_marks = array();
				while(($data = fgetcsv($file, 1000, ",")) !== false) {
					$student_id = $data[0];
					$edu_semester = $data[2];
					$edu_year = $data[1];
					$enrolled_course = $data[3];
					$enrolled_section = $data[4];
					$grade_point = $data[5];
					
					// Insert data into section_t table
					if(!array_key_exists($enrolled_section, $sections)) {
						$query = "INSERT INTO section_t (sectionNum, semester,courseID, year) VALUES ($enrolled_section, '$edu_semester','$enrolled_course', $edu_year)";
						mysqli_query($con, $query);
						$section_id = mysqli_insert_id($con);
						$sections[$enrolled_section] = $section_id;
					} else {
						$section_id = $sections[$enrolled_section];
					}
				

					
					// Insert data into registration_t table
					$query = "SELECT sectionID FROM section_t WHERE sectionNum=$enrolled_section AND semester='$edu_semester' AND year=$edu_year";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					$section_id = $row["sectionID"];
					$query = "INSERT INTO registration_t (sectionID, studentID) VALUES ($section_id, $student_id)";
					mysqli_query($con, $query);
					$registration_id = mysqli_insert_id($con);
					


					// Insert data into question_t table


					if (!in_array($enrolled_course, $questions)) {
						// Fetch examId from exam_t table
						$exam_name = $enrolled_course . "FinalSummer2021";
						$query = "SELECT examID FROM exam_t WHERE examName='$exam_name'";
						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
						$exam_id = $row["examID"];
						
						// Fetch coNum from co_t table
						$query = "SELECT coNum FROM co_t WHERE courseID='$enrolled_course'";
						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
						$co_num = $row["coNum"];
						

						// Loop through each question and add mark to answer table
						for ($i = 1; $i <= 3; $i++) {
							// Insert data into question table
							$query = "INSERT INTO question_t (markPerQuestion, courseID, coNum, examID, questionNUm) VALUES (100, '$enrolled_course', $i, $exam_id, 1)";
							mysqli_query($con, $query);
						}
						
						$questions[] = $enrolled_course; // Add the course to questions array
					}

					// Grade to mark mapping
					$grade_marks = array(
						"4" => 90,
						"3.7" => 85,
						"3.3" => 80,
						"3" => 75,
						"2.7" => 70,
						"2.3" => 65,
						"2" => 60,
						"1.7" => 55,
						"1.3" =>50,
						"1" => 45,
						"0" => 40
					);

					$mark_obtained = $grade_marks[$grade_point];

					// Loop through each question and add mark to answer table
					for ($i = 1; $i <= $co_num; $i++) {

						// Insert data into answer table and set mark obtained based on grade
						
						$query = "INSERT INTO answer_t(answerNum, examID, registrationID, markObtained) VALUES(1, $exam_id, $registration_id, $mark_obtained)";
						mysqli_query($con, $query);
					}
					
					

					/*
					$query = "SELECT coNum FROM co_t WHERE courseID='$enrolled_course'";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					$co_num = $row["coNum"];
					$query = "INSERT INTO question_t (markPerQuestion, courseID, coNum) VALUES (100, '$enrolled_course', $co_num)";
					mysqli_query($con, $query);

					*/

					// Grade to mark mapping
					$grade_marks = array(
						"4" => 90,
						"3.7" => 85,
						"3.3" => 80,
						"3" => 75,
						"2.7" => 70,
						"2.3" => 65,
						"2" => 60,
						"1.7" => 55,
						"1.3" =>50,
						"1" => 45,
						"0" => 40
					);
					

					 // Replace with the actual grade obtained by the student
					$mark_obtained = $grade_marks[$grade_point];
					
					// Insert data into student_course_performance_t table
					$query = "INSERT INTO student_course_performance_t (registrationID, gradePoint, totalMarksObtained) VALUES ($registration_id, $grade_point, $mark_obtained)";
					mysqli_query($con, $query);


					// Insert data into answer table
					/*
					//fetch data of questionID from question Table
					$query= "SELECT questionID FROM question_t WHERE courseID='$enrolled_course' and examID= $exam_id";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					$question_ID = $row["questionID"];

					*/
					

					


				}
				fclose($file);
				mysqli_close($con);
				echo "Data uploaded successfully!";
			} else {
				echo "Invalid file!";
			}
		}
	?>
</body>
</html>
