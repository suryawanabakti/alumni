<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Kuesioner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h2 class="text-center mb-4">Hasil Kuesioner</h2>
        
        <div class="row">
            @foreach ($report as $index => $data)
                <div class="col-md-6">
                    <div class="chart-container">
                        <h5 class="text-center">{{ $data['question'] }}</h5>
                        <canvas id="chart-{{ $index }}"></canvas>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var ctx = document.getElementById("chart-{{ $index }}").getContext("2d");
                        var chartData = {
                            labels: {!! json_encode(array_keys($data['responses']->toArray())) !!},
                            datasets: [{
                                label: "Jawaban",
                                data: {!! json_encode(array_values($data['responses']->toArray())) !!},
                                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56", "#4CAF50", "#FF9800"],
                                hoverOffset: 4
                            }]
                        };

                        new Chart(ctx, {
                            type: "pie",
                            data: chartData
                        });
                    });
                </script>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
