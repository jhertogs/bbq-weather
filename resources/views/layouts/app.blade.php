<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 ">
    <div class="min-h-screen flex flex-col">
        
        @include('components.navbar')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footer')
    </div>
    <script> 

        let precipLabels = @json($precipLabels);
        let precipValues = @json($precipValues);

        let tempLabels = @json($tempLabels);
        let tempValues = @json($tempValues);

        let windLabels = @json($windLabels);
        let windValues = @json($windValues);

        let tempValuesH = @json($tempValuesH);
        let tempLabelsH = @json($tempLabelsH);

        let precipLabelsH = @json($precipLabelsH);
        let precipValuesH = @json($precipValuesH);

        let windLabelsH = @json($windLabelsH);
        let windValuesH = @json($windValuesH);
        
        const ctx = document.getElementById('chart').getContext('2d');
        const ctx2 = document.getElementById('chart2').getContext('2d');
        const ctx3 = document.getElementById('chart3').getContext('2d');

        const precipChart = new Chart(ctx, {
            type: 'line', // You can change this to 'line', 'pie', etc.
            data: {
                labels: precipLabels,
                datasets: [{
                    label: 'Weekly precipitation',
                    data: precipValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });

        const tempChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: tempLabels,
                datasets: [{
                    label: 'Weekly temperature',
                    data: tempValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });

        const windChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: windLabels,
                datasets: [{
                    label: 'Weekly windSpeeds',
                    data: windValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });
        
        function switchCharts() {
            tempChart.update();
            precipChart.update();
            let btnValue = document.getElementById('chartBtn').value;
            console.log(btnValue);
            
            if (btnValue === 'Switch to weekly values') {
                document.getElementById('chartBtn').value = 'Switch to historical data (Zwolle)';
                tempChart.data.datasets[0].label = 'Weekly temperature';
                tempChart.data.labels = tempLabels;
                tempChart.data.datasets[0].data = tempValues;
                tempChart.update();

                precipChart.data.datasets[0].label ='Weekly precipitation';
                precipChart.data.labels = precipLabels;
                precipChart.data.datasets[0].data = precipValues;
                precipChart.update();

                windChart.data.datasets[0].label = 'Weekly windSpeeds';
                windChart.data.labels = windLabels;
                windChart.data.datasets[0].data = windValues;
                windChart.update();

            } else if (btnValue === 'Switch to historical data (Zwolle)' ) {
                document.getElementById('chartBtn').value = 'Switch to weekly values';
                tempChart.data.datasets[0].label = 'Historical temperature';
                tempChart.data.labels = tempLabelsH;
                tempChart.data.datasets[0].data = tempValuesH;
                tempChart.update();

                precipChart.data.datasets[0].label ='historical precipitation';
                precipChart.data.labels = precipLabelsH;
                precipChart.data.datasets[0].data = precipValuesH;
                precipChart.update();

                windChart.data.datasets[0].label = 'Historical windspeeds';
                windChart.data.labels = windLabelsH;
                windChart.data.datasets[0].data = windValuesH;
                windChart.update();
            }    
        }
    </script>
</body>
</html>
