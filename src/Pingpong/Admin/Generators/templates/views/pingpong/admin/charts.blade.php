@extends('admin::template')

@section('main')
<h4 class="page-header">
  Chart : {{ $chart->title }}
</h4>

<?php
$options = [
url('admin/charts/'.$table.'?chart-type=line') => 'Line',
url('admin/charts/'.$table.'?chart-type=bar') => 'Bar',
];
?>

<div class="btn-add-new col-md-2">
  {{ Form::select('select-chart', $options, $selected, ['class'=>'select-chart form-control']) }}
</div>
<div id="myfirstchart" style="height: 450px;"></div>

@endsection

@section('style')
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
@endsection

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>

<script>
  @if($charttype == 'bar')
  Morris.Bar({
    element: 'myfirstchart',
    data: [
    @foreach($datas as $data) 
    { date: '{{$data->date}}', count: {{$data->count}} },
    @endforeach
    ],
    xkey: 'date',
    ykeys: ['count'],
    labels: ['Count']
  });
  @elseif($charttype == 'line')
  new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  @foreach($datas as $data) 
  { date: '{{$data->date}}', count: {{$data->count}} },
  @endforeach
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'date',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['count'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Count']
});
  @else
  alert("Unknow charttype '{{$charttype}}'");
  @endif

  (function(){

   $('.select-chart').on('change',function(){
    var val = $(this).val();
    document.location.href = val;
  });

 })();
</script>
@endsection