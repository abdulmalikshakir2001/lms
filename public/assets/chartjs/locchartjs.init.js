$(function () {
    "use strict";
	new Chart(document.getElementById("bar-chart-regFacilitator"), {
        type: 'bar',
        data: {
          labels: ["Students", "Parents", "Teachers", "Schools", "Sessions"],
          datasets: [
            {
              label: "Numbers",
              backgroundColor: ["#6174d5", "#5f76e8", "#768bf4", "#7385df", "#7385df"],
              data: [studentData, parentsData, teachersData, schoolsData, sessionsData]
            }
          ]
        },
        options: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Numbers of Students, Parents, Teachers, and Schools in ' + regionName
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
                stepSize: 1,   // Ensure step size is 1 to show integer intervals
                callback: function(value) { return Number.isInteger(value) ? value : ''; } // Filter out non-integer values
              }
            }]
          }
        }
      });
      
}); 