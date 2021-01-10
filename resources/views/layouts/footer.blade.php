<footer class="bg-light py-5">
    <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Start Bootstrap</div></div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('plugins/Chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
    var ctx1 = document.getElementById('compare');
    var myLineChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($graph->label);?>,
            datasets: [
                {
                    label: "COLLECTION",
                    data: <?php echo json_encode($graph->collect);?>,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                },
                {
                    label: "COST",
                    data: <?php echo json_encode($graph->expense);?>,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script src="{{asset('js/scripts.js')}}"></script>