@include('header')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <p>number Users</p>
                <h3>{{$user->count()}}</h3>

                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{route('admins')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <p>number Categories</p>
                <h3>{{$category->count()}}</h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{route('categories')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <p>number Products</p>
                <h3>{{$product->count()}}</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{route('products')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <p>number Client</p>
                <h3>{{$client->count()}}</h3>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{route('clients')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="box box-solid">
          <label for="exampleInputEmail1">choice year</label>
                    <select type="text" class="year" name="year" 
                   
                    <option value="">اختر السنة</option>
                   <option value="">اختر السنة</option>
                  @foreach ( $year as $data )
                  
                  <option value="{{ $data->year }}"> 
                    {{ $data->year  }}
                  </option>  
                 
                  @endforeach
                    
                   
                    </select>
                    
          <div class="box-header chart">
              <h3 class="box-title">Sales Graph</h3>
          </div>
          <div class="box-body border-radius-none">
              <div class="chart" id="line-chart" style="height: 250px;"></div>
          </div>
          <!-- /.box-body -->
      </div>
        @push('scripts')

    <script>

        //line chart
        var line = new Morris.Line({
            element: 'line-chart',
            resize: true,
            data: [
                @foreach ($sales_data as $data)
                {
                    ym: "{{ $data->year }}-{{ $data->month }}", sum: "{{ $data->sum }}"
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
    <script>
      $(document).ready(function() {
        $('select[name="year"]').on('change', function() {
            var year = $(this).val();
            
            if (year) {
                $.ajax({
                    url: "{{ URL::to('dashboard') }}/" + year  ,
                    type: "GET",
                    dataType: "json",
                    
                    success: function(data) {
                      if (data.status == true) {
                        
                          $('#line-chart').empty().html(data.content);  
                          
                    } 
                    
                    },
                });

            } else {
                console.log('AJAX load did not work');
            }
        });

    });
    </script>

@endpush



























@include('footer')
</body>
</html>
