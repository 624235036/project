<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            width: 1000px;
            margin: 3rem auto;
        }
        #chart-container {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script>
        $(document).ready(function() {
            showGraph();
        });

        function showGraph() {
            {
                $.post("data.php", function(data) {
                    console.log(data);
                    let name = [];
                    let score = [];
                    for (let i in data) {
                        name.push(data[i].name_header);
                        score.push(data[i].avgscore);
                    }
                    let chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'ภาพรวมสมรรถนะ',
                            backgroundColor: 'red',
                            borderColor: '#46d5f1',
                            hoverBackgroundColor: '#CCCCCC',
                            hoverBorderColor: '#666666',
                            data: score
                        }]
                    };
                    let graphTarget = $('#graphCanvas');
                    let radarGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    })
                })
            }
        }
    </script>
</body>
</html>