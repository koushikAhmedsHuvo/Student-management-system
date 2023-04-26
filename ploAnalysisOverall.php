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

    <style>

        ::placeholder{
          color:white;
        }

        ::-ms-input-placeholder{
          color:white;
        }

        :-ms-input-placeholder{
          color:white;
        }

    </style>


  </head>

  <body>



  <div class="menu-bar">

<ul> 
    <li><a  href="dashboard.php">Dashboard</a></li>

    <li><a class="pagePoint" href="#">PlO Analysis</a>

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

    <li><a href="#">Data Entry</a>

        <div class="menu1">
            <ul>
                <li><a href="#"> Exam </a> </li>
                <li><a href="#"> Create Course Outline </a> </li>
                <li><a href="#"> View Course Outline </a> </li>
            </ul>
           </div>
    
    </li>

    <?php } ?>


    <li><a href="viewCourseOutline.php">View course Outline</a></li>


    <li><a href="#">Enrollment Stats</a>

        <div class="menu1">
            <ul>
                <li><a href="#"> Student Wise PLO Analysis </a> </li>
                <li><a href="#"> PLO Achievement Statistics </a> </li>
                <li><a href="#"> Student Enrollment Statistics</a> </li>
                <li><a href="#"> Student Performance Stats</a> </li>
            </ul>
           </div>
    
    </li>

    <li><a href="#">GPA Analysis</a>


        <div class="menu1">
            <ul>
                <li><a href="#"> School/Department/Program-wise</a> </li>
                <li><a href="#"> Course-wise</a> </li>
                <li><a href="#"> Instructor-wise </a> </li>
                <li><a href="#"> Instructor-wise(Chosen Course) </a> </li>
                <li><a href="#"> VC/Dean/Head-wise</a> </li>
            </ul>
           </div>
    
    
    </li>



    <li><a href="logout.php">Logout</a></li>  
</ul>

</div>


    <!--

      Here is the menu bar for this page.

   


    <!--
    <div class="container" id="logoutbutton">
    <a href="logout.php" class="btn btn-primary mb-5">Logout</a>
    </div>
    -->
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
          <li><a href="ploAnalysisDepartmentProgramSchoolAverage.php" target="_self">PLO Analysis With Department/Program/School Average</a></li>
          <li><a href="ploAnalysisOverall.php" target="_self">PLO Analysis (Overall, CO Wise, Course Wise)</a></li>
          <li><a href="logout.php" target="_self">Logout</a></li>
            </ul>
        </div>
      </div>

    -->
<div class="background">

      <div style="height:80px;"class="row1">
        <form method="POST">
        <input style="background-color:#4a7678;height:50px;border: 1px solid;cursor: pointer;border-radius: 5px;font-size: 14px;letter-spacing:2px;
                      font-weight: bold;text-transform:uppercase; border: none;outline: none;text-align: center;margin-right:20px;
                      color:white; margin-left:43%;margin-top:13px;" type="text" placeholder="Enter Student ID" name="studentID"/>
             
        <input class="button"type="submit" name="submit" value="Submit"/>
        </form>
        </div>

      <div style="display:flex;justify-content:space-around" class="row2">
        <button onclick="overallPlo()" id="button_style">Overall PLO</button>
        <button onclick="coWisePlo()" id="button_style">CO Wise PLO</button>
        <button onclick="courseWisePlo()" id="button_style">Course Wise PLO</button>
      </div>
    
     <div style="display:flex;justify-content:center;" class="row3" style="margin-top:20px;"> 
       <div id="Autumn" style="width: 65%; height: 500px; display:inline-block;margin-top:23px;"></div>
       
     </div>
</div>  

<!--


<?php

/*
if(isset($_POST['submit'])){
  $studentID=$_POST['studentID'];
}

*/

?>
-->


<?php
if(isset($_POST['submit'])){
  $studentID=$_POST['studentID'];
  ?>
  <script>
    window.addEventListener('DOMContentLoaded', (event) => {
      overallPlo('<?php echo $studentID; ?>');
    });
  </script>
  <?php
}
?>


<!-- Overall plo -->
<script>
    function overallPlo(){
    <?php

    $sql="SELECT plo.ploNum AS ploNum, 
    AVG((ans.markObtained/q.markPerQuestion)*100) AS percent
    FROM registration_t AS r, answer_t AS ans, question_t AS q, 
    co_t AS co, plo_t AS plo
    WHERE r.registrationID=ans.registrationID 
    AND ans.examID=q.examID
    AND ans.answerNum=q.questionNum AND q.coNum=co.coNum 
    AND q.courseID=co.courseID AND co.ploID=plo.ploID 
    AND r.studentID='$studentID'
    GROUP BY plo.ploNum,r.studentID";

    $result=mysqli_query($con,$sql);
    ?>
    
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawAutumnChart);

      function drawAutumnChart() {
        var data = google.visualization.arrayToDataTable([
          ['ploNum','PLO Percentage'],
          
          <?php
            while($data=mysqli_fetch_array($result)){
             
              $ploNum="PLO".$data['ploNum'];
              $percent=$data['percent'];
              
           ?>

           ['<?php echo $ploNum;?>',<?php echo $percent;?>],   
           <?php   
            }
           ?> 
        ]);

        var options = {
          chart: {
            title: 'Overall PLO Analysis',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('Autumn'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
}
</script> 


<!-- Co wise plo -->
<script>
function coWisePlo(){
   
    }
</script>

<!-- course wise plo -->

<script>
function courseWisePlo(){


    }
</script>

</body>

</html>