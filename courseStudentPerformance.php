<?php
@include 'connect.php';
if(isset($_POST['submit'])){
   $id=mysqli_real_escape_string($con, $_POST['Student_ID']);
   $year=mysqli_real_escape_string($con, $_POST['Year']);
   $semester=mysqli_real_escape_string($con, $_POST['Semester']);
   $course=mysqli_real_escape_string($con, $_POST['Course']);
   $sec=mysqli_real_escape_string($con, $_POST['Section']);
   $grade=mysqli_real_escape_string($con, $_POST['Grade']);

   $insert="INSERT INTO registration_t(sectionID,studentID) VALUES('$sec','$id')";
   mysqli_query($con,$insert);

   $insert1="INSERT INTO section_t(sectionNUM,semester,courseID,facultyID,year)VALUES('$sec','$semester','$course','2255','$year')";
   mysqli_query($con,$insert1);

   $sql = "SELECT COUNT(*) AS row_num FROM registration_t";

// execute query
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          $count=$row["row_num"];
    }
} else {
    echo "No rows found.";
}


   

   
    
   
   

   if($grade=='A')
   {
    $totalMark='92';
    $gradePoint='4.0';
   }

  else if($grade=='A-')
   {
    $totalMark='87';
    $gradePoint='3.7';
   }

   else if($grade=='B+')
   {
    $totalMark='82';
    $gradePoint='3.3';
   }

   else if($grade=='B')
   {
    $totalMark='77';
    $gradePoint='3.0';
   }

   else if($grade=='B-')
   {
    $totalMark='72';
    $gradePoint='2.7';
   }

   else if($grade=='C+')
   {
    $totalMark='67';
    $gradePoint='2.3';
   }

   else if($grade=='C')
   {
    $totalMark='62';
    $gradePoint='2.0';
   }

   else if($grade=='C-')
   {
    $totalMark='57';
    $gradePoint='1.7';
   }

   else if($grade=='D+')
   {
    $totalMark='53';
    $gradePoint='1.3';
   }

   else if($grade=='D')
   {
    $totalMark='47';
    $gradePoint='1.0';
   }

   else if($grade=='P')
   {
    $totalMark='45';
    $gradePoint='0.0';
   }

   else if($grade=='F')
   {
    $totalMark='27';
    $gradePoint='0.0';
   }

   $insert2="INSERT INTO student_course_performance_t(registrationID,totalMarksObtained,gradePoint)VALUES(' $count','$totalMark',' $gradePoint')";

   mysqli_query($con,$insert2);

   $questionDetails="abvdgrb";
   $markPerQuestion="100";
   $questionNum="1";
   $difficultyLevel="1";
   $examID="16";
   $coNum="3";



   $insert3="INSERT INTO question_t(questionDetails,markPerQuestion,questionNum,difficultyLevel,examID,courseID,coNum)VALUES(' $questionDetails',' $markPerQuestion','$questionNum','$difficultyLevel',
   ' $examID',' $course',' $coNum')";

    mysqli_query($con,$insert3);

    $answerDetails="aaaaa";
    $answerNum="1";
    $markObtained='$totalMark';
    $registrationID='$count';
    $questionID="0";
    $examID="16";

    $insert4="INSERT INTO answer_t(answerDetails,answerNum,questionNum,markObtained,registrationID,questionID,examID)VALUES('  $answerDetails','  $answerNum',' $markObtained',' $registrationID',
    ' $questionID','  $examID')";

    mysqli_query($con,$insert4);
 

     




 




   echo
   "
   <script>alert('Data Inserted successfully');</script>
   ";

 

  
   }
   
     
?>


<!DOCTYPE html>
<html>
<head>
	</title></title>
	<link rel="stylesheet" href="hp.css">
	
	
</head>
<body>
<div class = "form-container">
        <form action ="" method ="post">
            <h3>Upload Grade</h3>

            <input type="text" name="Student_ID" required placeholder="Enter Student ID">
            <input type="text" name="Year" required placeholder="Enter Enroll Year">
            <input type="text" name="Semester" required placeholder="Enter Enroll Semester">
            <input type="text" name="Course" required placeholder="Enter Enroll course">
            <input type="text" name="Section" required placeholder="Enter Section">
            <input type="text" name="Grade" required placeholder="Enter Grade">
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</body>
</html>















