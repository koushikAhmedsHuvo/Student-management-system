<!DOCTYPE html>
<html>

<head>
  <title>Student Performance Chart</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
  <form method="post" action="">
    <label for="studentID">Enter Student ID:</label>
    <input type="text" name="studentID" id="studentID">
    <br>
    <label for="courseID">Enter Course ID:</label>
    <input type="text" name="courseID" id="courseID">
    <br>
    <input type="submit" value="Generate Chart">
  </form>
  <div id="chart_div" style="width: 900px; height: 500px;"></div>

  <?php
  include("connect.php");

  if(isset($_POST['studentID']) && isset($_POST['courseID'])) {
    // Get the student and course IDs from the form submission
    $studentID = $_POST["studentID"];
    $courseID = $_POST["courseID"];

    // Query the database to get the registration ID for the given student and course
    $sql = "SELECT registrationID FROM registration_t WHERE studentID = $studentID AND courseID = '$courseID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $registrationID = $row["registrationID"];

    // Query the database to get the grade point for the given registration ID
    $sql = "SELECT gradePoint FROM student_course_performance_t WHERE registrationID = $registrationID";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $gradePoint = $row["gradePoint"];

    // Query the database to get the number of COs for the given course ID
    $sql = "SELECT coNum FROM co_t WHERE courseID = '$courseID'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $coNum = $row["coNum"];

    // Initialize an array to hold the CO percentages
    $coPercentages = array();

    // Calculate the percentage for each CO
    for ($i = 1; $i <= $coNum; $i++) {
      $coPercentages[] = rand(10,100) / 10; // Random CO percentages for demo purposes only
    }

    // Multiply each CO percentage by the student's grade point to get the CO score
    $coScores = array();
    foreach ($coPercentages as $percentage) {
      $coScores[] = round($percentage * $gradePoint / 4, 2);
    }

    // Format the CO scores as a comma-separated string for use in the Google Chart
    $coScoresString = implode(",", $coScores);

		  // Generate the Google Chart using the CO scores
echo "<script type='text/javascript'>
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([            ['CO', 'Percentage'],";

// Create an array to hold each CO's label and percentage
$coData = array();

// Loop through each CO and add its data to the array
for ($i = 1; $i <= $coNum; $i++) {
$coData[] = "['CO$i', " . $coScores[$i - 1] . "]";
}

// Join the CO data into a string to use in the Google Chart
$coDataString = implode(",", $coData);

echo "[$coDataString]);

  var options = {
	title: 'Student Course Outcome Chart',
	hAxis: {title: 'CO', minValue: 0, maxValue: $coNum},
	vAxis: {title: 'Percentage', minValue: 0, maxValue: 100},
	legend: 'none'
  };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
</script>";

// Display the Google Chart
echo "<div id='chart_div' style='width: 100%; height: 500px;'></div>";
}

mysqli_close($con);
  
?>
</body>
</html>
