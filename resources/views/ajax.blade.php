@section('main')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">



  <link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}"/>


</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('plugins/morris/morris.min.js') }}"></script>

<script>
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            
            @foreach ($sales_data as $data)
            {
               
               
               
                ym: "{{ $year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
               
               
            },
            @endforeach
        ],
        xkey: 'ym',
        ykeys: ['sum'],
        labels: ['total'],
        lineWidth: 2,
        hideHover: 'auto',
        gridStrokeWidth: 0.4,
        pointSize: 4,
        gridTextFamily: 'Open Sans',
        gridTextSize: 10
    });
</script>
@stop
