<!DOCTYPE html>
<html>
<head>
	<title>Two Charts Example with PHP</title>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
		google.charts.load('current', {'packages':['corechart']});
	</script>
</head>
<body>
	<h1>Two Charts Example with PHP</h1>
	<form method="POST">
		<label for="input1">Input 1:</label>
		<input type="text" id="input1" name="input1">
		<br><br>
		<label for="input2">Input 2:</label>
		<input type="text" id="input2" name="input2">
		<br><br>
		<button type="submit" name="chart1">Chart 1</button>
		<button type="submit" name="chart2">Chart 2</button>
	</form>
	<br><br>
	<div id="chart_div"></div>

	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$input1 = $_POST["input1"];
			$input2 = $_POST["input2"];

			if (isset($_POST["chart1"])) {
				$data = "['Input', 'Value'], ['Input 1', $input1], ['Input 2', $input2]";
				$options = "{title: 'Chart 1', width: 400, height: 300}";
				$type = "ColumnChart";
			}
			elseif (isset($_POST["chart2"])) {
				$data = "['Input', 'Value'], ['Input 1', " . ($input1 * 2) . "], ['Input 2', " . ($input2 * 2) . "]";
				$options = "{title: 'Chart 2', width: 400, height: 300}";
				$type = "PieChart";
			}

			echo "<script type='text/javascript'>
					google.charts.setOnLoadCallback(drawChart);
					function drawChart() {
						var data = google.visualization.arrayToDataTable([$data]);
						var options = $options;
						var chart = new google.visualization.$type(document.getElementById('chart_div'));
						chart.draw(data, options);
					}
				</script>";
		}
	?>

</body>
</html>
