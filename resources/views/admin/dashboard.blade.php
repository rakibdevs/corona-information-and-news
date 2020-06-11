@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
	<div class="row clearfix">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget bg-warning">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Donor</h6>
                            <h2>{{$data->donor}}</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget bg-primary">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Collection</h6>
                            <h2>৳ {{$data->collection}}</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hand-lizard-o"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget bg-danger">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Expense</h6>
                            <h2>৳ {{$data->expense}}</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="widget bg-success">
                <div class="widget-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="state">
                            <h6>Reserve</h6>
                            <h2>৳ {{($data->collection-$data->expense)}}</h2>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="space-20"></div>
    <div class="row">
    	<div class="col-sm-6">
            <div class="chart">
                <div class="chart-header">
                    <h5>{{ __('Collection')}}</h5>
                </div>
                <div class="chart-body text-center">
                    <canvas id="collection"  height="180"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="chart">
                <div class="chart-header">
                    <h5>{{ __('Expense')}}</h5>
                </div>
                <div class="chart-body text-center">
                    <canvas id="expense"  height="180"></canvas>
                </div>
            </div>
        </div>
    	
    </div>
</div>
@php $label=array(); $dataset=array(); @endphp
@foreach($collections as $k=> $collect) 

<?php 
    array_push($label, $collect['date']);
    array_push($dataset, $collect['amount']);
?> 
@endforeach

@php $label1=array(); $dataset1=array(); @endphp
@foreach($expenses as $k=> $collect) 

<?php 
    array_push($label1, $collect['exp_date']);
    array_push($dataset1, $collect['expense']);
?> 
@endforeach
@push('script')                
	<script src="{{ asset('plugins/Chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript">
    	var ctx1 = document.getElementById('collection');
    	var myLineChart = new Chart(ctx1, {
		    type: 'line',
		    data: {
		        labels: <?php echo json_encode(array_reverse($label));?>,
		        datasets: [{
		            label: '# of Collections',
		            data: <?php echo json_encode(array_reverse($dataset));?>,
		            backgroundColor: 'rgba(54, 162, 235, 1)',
		            borderColor: 'rgba(54, 162, 235, 1)',
		    	}]
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
		var ctx = document.getElementById('expense');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: <?php echo json_encode(array_reverse($label1));?>,
		        datasets: [{
		            label: '# of Expense',
		            data: <?php echo json_encode(array_reverse($dataset1));?>,
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth: 1
		        }]
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
@endpush
@endsection 

