@include('header')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
            <br>
          </div><!-- /.col -->
          <div class="col-sm-1">
          </div>
          <div class="col-sm-5">
            <h1 class="m-0">Show Products</h1>
            <br>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="card">
           
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Date</th>
                      <th>Action</th>
               
                    </tr>
                  </thead>
                  
                      
                 
                  @foreach ($orders as $order)
                      
                  <tbody>
                    <tr>
                      <td>{{$order->client->name}}</td>
                      <td>{{$order->created_at->diffForHumans()}}</td>
                      <td>
                        
                        <a class="btn btn-info" href="{{route('client.order.edit',['order'=>$order->id,'client'=>$order->client->id]) }}">Edit</a>
                       
                        @if(auth()->user()->hasPermission('delete_orders'))
                        <a class="btn btn-danger" href="{{route('client.order.delete',$order->id)}}">Delete</a>
                        @else
                        <a class="btn btn-danger disabled" >Delete</a>
                        @endif
                        <a class="btn btn-primary showProduct" 
                        data-url="{{route('client.order.show',$order->id)}}"
                        data-method="get"
                        >Show</a>
                        

                      </td>
                    </tr>
                    
                  </tbody>
                  
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-sm-1">
          </div>
          <div class="col-sm-5">
        
              <div class="card list-orders">
             
                
              </div>
           
          
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>



 

@include('footer')
</body>
</html>
