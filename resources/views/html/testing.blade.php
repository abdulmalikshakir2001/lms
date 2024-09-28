<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Distribution Chart</title>
</head>
<body>
    <h2>Teacher Distribution by Region</h2>
    <canvas id="teacherChart" width="400" height="200"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('teacherChart').getContext('2d');
        var teacherChart = new Chart(ctx, {
            type: 'bar',  // You can change this to 'line', 'pie', etc.
            data: {
                labels: {!! json_encode($regionNames) !!}, // X-axis labels
                datasets: [{
                    label: 'Number of Teachers',
                    data: {!! json_encode($teacherCounts) !!}, // Y-axis data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
