<?php

include 'connect.php';

?>

<?php
session_start();
if (isset($_SESSION['user_type'])) {
    // User is logged in, display appropriate menu
} else {
    // User is not logged in, display login/register options
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Employee Dashboard</title>
    <!--Google Font-->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="spms.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="courseOutline.css">
    <link rel="stylesheet" href="questionform.css">

    <style>
      
    </style>


</head>

  <body>
    
 
  <div class="menu-bar">

<ul> 
    <li><a  href="dashboard.php">Dashboard</a></li>

    <li><a  href="#">PlO Analysis</a>

       <div class="menu1">
        <ul>
            <li><a href="ploAnalysisDepartmentProgramSchoolAverage.php"> PLO Analysis (Department/Program/School/Average) </a> </li>
            <li><a href="ploAnalysisOverall.php"> PLO Analysis(Overall, CO wise, Course wise) </a> </li>
        </ul>
       </div>

    </li>

    <li><a href="#">PLO Achievement Stats</a>

        <div class="menu1">
            <ul>
                <li><a href="ploComparisonStudent.php"> PLO Comparison(Student) </a> </li>
                <li><a href="ploComparisonCourse.php"> PLO Comparison(Course) </a> </li>
                <li><a href="ploComparisonProgram.php"> PLO Comparison(Program) </a> </li>
                <li><a href="ploComparisonSchool.php"> PLO Comparison(School) </a> </li>
                <li><a href="ploComparisonDepartment.php"> PLO Comparison(Departement)</a> </li>
            </ul>
           </div>
    
    
    </li>


    <li><a href="spiderChart.php">Spider Chart Analysis</a></li>

    <?php if ($_SESSION['user_type'] == 'employee'){ ?>

    <li><a class="pagePoint" href="#">Data Entry</a>

        <div class="menu1">
            <ul>
                <li><a href="addExam.php">Add Exam </a> </li>
                <li><a href="viewExam.php">View Exam </a> </li>
                <li><a href="viewStudentAnswerScript.php"> Evaluate Exam Script</a> </li>
                <li><a href="createCourseOutlinePage1.php"> Create Course Outline </a> </li>
                <li><a href="viewCourseOutline.php"> View Course Outline </a> </li>
            </ul>
           </div>
    
    </li>

    <?php } ?>


    <li><a href="viewCourseOutline.php">View course Outline</a></li>


    <li><a href="#">Enrollment Stats</a>

        <div class="menu1">
            <ul>
                <li><a href="ploAnalysis.php"> Student Wise PLO Analysis </a> </li>
                <li><a href="ploAchieveStats.php"> PLO Achievement Statistics </a> </li>
                <li><a href="enrollmentStatistics.php"> Student Enrollment Statistics</a> </li>
                <li><a href="performanceStats.php"> Student Performance Stats</a> </li>
            </ul>
           </div>
    
    </li>

    <li><a href="">GPA Analysis</a>


        <div class="menu1">
            <ul>
                <li><a href="school_department_program_stats.php"> School/Department/Program-wise</a> </li>
                <li><a href="courseWiseperformance.php"> Course-wise</a> </li>
                <li><a href="instructorWisePerformance.php"> Instructor-wise </a> </li>
                <li><a href="instructorWiseChosenCourse.php"> Instructor-wise(Chosen Course) </a> </li>
                <li><a href="enrollmentStatisitis.php"> VC/Dean/Head-wise</a> </li>
            </ul>
           </div>
    
    
    </li>



    <li><a href="logout.php">Logout</a></li>  
</ul>

</div>





    <form method="post">
    <div class="row1" style="display:flex;justify-content:space-evenly;">
    
    <select style="width:200px;margin-left:0px;" name="courseID" class="select">
            <option disabled selected>Course</option>
             <option value="CSC101">CSC101</option>
             <option value="CSC303">CSC303</option>
             <option value="MIS430">MIS430</option>
         </select>

    <select style="width:200px;margin-left:0px;" name="sectionNum" class="select">
            <option disabled selected>Section</option>
             <option value="1">Section-1</option>
             <option value="2">Section-2</option>
             <option value="3">Section-3</option>
    </select>  
    
    <select style="width:200px;margin-left:0px;" name="semester" class="select">
            <option disabled selected>Semester</option>
             <option value="spring">spring</option>
             <option value="summer">summer</option>
             <option value="autumn">autumn</option>
    </select>  

    <select style="width:200px;margin-left:0px;" name="year" class="select">
            <option disabled selected>year</option>
             <option value="2020">2020</option>
             <option value="2021">2021</option>
             <option value="2022">2022</option>
             <option value="2023">2023</option>
    </select> 
    </div>

  <input class="button" style="margin-top:25px;margin-left: 718px;" type="submit" value="Submit" name="submit" class="select">
  </form>

  <?php

    if(isset($_POST['submit'])){
        
    session_start();
    $year=$_POST['year'];
    $semester=$_POST['semester'];
    $sectionNum=$_POST['sectionNum'];
    $courseID=$_POST['courseID'];

  //Getting section ID from database
  $result=mysqli_query($con,"SELECT sec.sectionID AS sectionID
  FROM section_t AS sec
  WHERE sec.sectionNum='$sectionNum' AND sec.courseID='$courseID' 
  AND sec.semester='$semester' AND sec.year='$year'");
  $row=mysqli_fetch_assoc($result); 
  $_SESSION['sectionID']=$row['sectionID'];

  header('location:createCourseOutline.php');

  }?>



  </body>

</html>