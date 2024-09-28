$(function () {
    "use strict";
	// Bar chart for students
	new Chart(document.getElementById("bar-chart-students"), {
		type: 'bar',
		data: {
		  labels: stdRegionNames,
		  datasets: [
			{
			  label: "Numbers",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#7385df", "#7385df", "#7385df"],
			  data: studentData
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true, 
			text: 'Number of students across different regions'
		  },
		  scales: {
		    yAxes: [{
		      ticks: {
		        beginAtZero: true,
		        stepSize: 1  // Set interval size to 1
		      }
		    }]
		  }
		}
	});

	// Bar chart for parents
	new Chart(document.getElementById("bar-chart-parents"), {
		type: 'bar',
		data: {
		  labels: parRegionNames,
		  datasets: [
			{
			  label: "Numbers",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa", "#7385df", "#7385df", "#7385df"],
			  data: parentsData
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true, 
			text: 'Number of Parents across different regions'
		  },
		  scales: {
		    yAxes: [{
		      ticks: {
		        beginAtZero: true,
		        stepSize: 1  // Set interval size to 1
		      }
		    }]
		  }
		}
	});

	// Bar chart for teachers
	new Chart(document.getElementById("bar-chart-teachers"), {
		type: 'bar',
		data: {
		  labels: tchRegionNames,
		  datasets: [
			{
			  label: "Numbers",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa", "#7385df", "#7385df", "#7385df"],
			  data: teachersData
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true, 
			text: 'Number of Teachers across different regions'
		  },
		  scales: {
		    yAxes: [{
		      ticks: {
		        beginAtZero: true,
		        stepSize: 1  // Set interval size to 1
		      }
		    }]
		  }
		}
	});

	// Bar chart for schools
	new Chart(document.getElementById("bar-chart-schools"), {
		type: 'bar',
		data: {
		  labels: schRegionNames,
		  datasets: [
			{
			  label: "Numbers",
			  backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#b1bdfa", "#7385df", "#7385df", "#7385df"],
			  data: schoolsData
			}
		  ]
		},
		options: {
		  legend: { display: false },
		  title: {
			display: true, 
			text: 'Number of Schools across different regions'
		  },
		  scales: {
		    yAxes: [{
		      ticks: {
		        beginAtZero: true,
		        stepSize: 1  // Set interval size to 1
		      }
		    }]
		  }
		}
	});
});
