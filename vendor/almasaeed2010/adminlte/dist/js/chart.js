google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
	var data = google.visualization.arrayToDataTable([
	  ['Task', 'Hours per Day'],
	  ['Work',     11],
	  ['Eat',      2],
	  ['Commute',  2],
	  ['Watch TV', 2],
	  ['Sleep',    7]
	]);

	var options = {
	  title: 'My Daily Activities',
	  is3D: true,
	};
	// Instantiate and draw our chart, passing in some options.
	var chart1 = new google.visualization.PieChart(document.getElementById('pieChart1'));
	chart1.draw(data, options);
	var chart2 = new google.visualization.PieChart(document.getElementById('pieChart2'));
	chart2.draw(data, options);
	var chart3 = new google.visualization.PieChart(document.getElementById('pieChart3'));
	chart3.draw(data, options);
}