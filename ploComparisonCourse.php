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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript"></script>  

  </head>

  <body>



     <!--menu bar -->
     <div class="menu-bar">

<ul> 
    <li><a  href="">Dashboard</a></li>

    <li><a  href="#">PlO Analysis</a>

       <div class="menu1">
        <ul>
            <li><a href="ploAnalysisDepartmentProgramSchoolAverage.php"> PLO Analysis (Department/Program/School/Average) </a> </li>
            <li><a href="ploAnalysisOverall.php"> PLO Analysis(Overall, CO wise, Course wise) </a> </li>
        </ul>
       </div>

    </li>

    <li><a class="pagePoint" href="#">PLO Achievement Stats</a>

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

    <li><a href="#">Data Entry</a>

        <div class="menu1">
            <ul>
                <li><a href="exam.php"> Exam </a> </li>
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

    
    
    
    
    <!--



    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            SPMS 3.0
          </div>
        </div>
        <div class="nav-btn">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
        </div>
        
        <div class="nav-links">
            <ul>
          <li><a href="employee_dashboard.php" target="_self">Dashboard</a></li>
          <li><a href="ploComparisonStudent.php" target="_self">PLO Comparison(Student)</a></li>
          <li><a href="ploComparisonCourse.php" target="_self">PLO Comparison(Course)</a></li>
          <li><a href="ploComparisonProgram.php" target="_self">PLO Comparison(Program)</a></li>
          <li><a href="ploComparisonSchool.php" target="_self">PLO Comparison(School)</a></li>
          <li><a href="ploComparisonDepartment.php" target="_self">PLO Comparison(Department)</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>


    -->

<div class="background">

     <div style="display:flex;justify-content:center;" class="row1">
     <form method="POST">

     <select style="height: 30px;
     display:inline-block;
     border-radius: 10px;
     border: none;
     outline: none;
     background: #0a2c6f;
     color: #fff;
     font-size: 15px;
     letter-spacing:2px;
     text-transform: uppercase;
     cursor:pointer;
     font-weight: bold;
     margin-left:10px;
     font-family: Arial, Helvetica, sans-serif;
     margin-top:15px;"
       name="courseID" class="select">
       <option disabled selected>Course</option>
       <option value="CSC101">CSC101</option>
       <option value="EEE131">EEE131</option>
     </select>
     

     <select style="height: 30px;
     display:inline-block;
     border-radius: 10px;
     border: none;
     outline: none;
     background: #0a2c6f;
     color: #fff;
     font-size: 15px;
     letter-spacing:2px;
     text-transform: uppercase;
     cursor:pointer;
     font-weight: bold;
     margin-left:10px;
     font-family: Arial, Helvetica, sans-serif;
     margin-top:15px;" 
      name="year" class="select select">
       <option disabled selected>Year</option>
       <option value="2020">2020</option>
       <option value="2021">2021</option>
       <option value="2022">2022</option>
     </select>
       <input class="button"
              type="submit" name="submit" value="Submit"/>
    </form>       
    </div>  <!-- div row-1 ends here -->

       
       

        <div style="display:flex;justify-content:center;"class="row3" style="margin-top:5px;"> 
        <div id="curve_chart" style="width: 900px; height: 500px; margin-top:15px;"></div>
        </div> <!-- div row-3 ends here -->

</div>  <!-- background div ends here -->


<?php
    /*if(isset($_POST['submit'])){
   $year=$_POST['year'];
   $courseID=$_POST['courseID'];
  } */
  ?>

<?php
if(isset($_POST['submit'])){
  $year=$_POST['year'];
  $courseID=$_POST['courseID'];
  ?>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      view('<?php echo $courseID; ?>');
    });
  </script>
  <?php
}
?>



<script>
    function view(){
     
    <?php 

    $sql="SELECT sec.semester AS semester, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM section_t AS sec, plo_t AS plo, answer_t AS ans, question_t AS q, 
    registration_t AS r, co_t AS co
    WHERE r.sectionID=sec.sectionID AND r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND sec.courseID='$courseID' AND sec.year='$year'
    GROUP BY semester";

    $result=mysqli_query($con,$sql);
    ?>
    
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Semester','Actual','Expected'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
              $semester=$data['semester'];
              $percent=$data['percent'];
           ?>
           ['<?php echo $semester." ".$year;?>',<?php echo $percent;?>,<?php echo '70';?>],   
           <?php   
            }
           ?> 
        ]);

        var options = {
          title: 'Semester Wise PLO Achievement Comparison For Course',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }

  }

</script>



</body>

</html>