@include('header');

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Clients</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(auth()->user()->hasPermission('create_clients'))
            <a class="btn btn-primary" href="{{route('client.create')}}">Add Client</a>
            @else
            <a class="btn btn-primary disabled">Add Client</a>
            @endif
            <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" value="{{request()->search1}}" name="search1" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    @if($clients->count()>0)

<div class="container" style="margin-left:100px">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header" style="background-color:blue">
                <h3 class="card-title">clients</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <table class="table table-bordered">

                  <thead>
                    <tr>
                      <th style=" background-color:red" >#</th>
                      <th style="background-color:red">name</th>
                      <th style="background-color:red">phone</th>
                      <th style="background-color:red">address</th>
                      <th style="background-color:red">orders</th>
                      <th style="background-color:red">date</th>
                      <th style="background-color:red">action</th>
                    </tr>
                  </thead>

                @php
                $i=1;
                @endphp
                @foreach($clients as $item)
                  <tbody>
                    <tr>
                      <td>{{$i++}}</td>
                      <td style="color:green">{{$item->name}}</td>
                      <td style="color:green">
                      @if($item->phone2!=null)
                      {{  $item->phone1."-".$item->phone2 }}
                      @else
                      {{ $item->phone1}}
                      @endif
                      </td>
                      <td style="color:green">{{$item->address}}</td>
                      <td style="color:green"><a href="{{route('client.order.create',$item->id)}}">Add Order</a></td>

                      <td style="color:green">{{$item->created_at->diffForHumans()}}</td>   
                      <td>
                      @if(auth()->user()->hasPermission('update_clients'))
                      <a class="btn btn-info" href="{{route('client.edit',$item->id)}}">Edit</a>
                      @else
                      <a class="btn btn-info disabled" >Edit</a>
                      @endif
                      @if(auth()->user()->hasPermission('delete_clients'))
                      <a class="btn btn-danger" href="{{route('client.delete',$item->id)}}">Delete</a>
                      @else
                      <a class="btn btn-danger disabled" >Delete</a>
                      @endif
                      </td>
                    </tr>
                    </tbody>
                    @endforeach
                  </table>
                  
                  </div>
                  <div class="card-footer clearfix">
               
             
                
                 
               
              </div>
                  
                  </div></div></div></div>
                  </section></div>
                  @else
        <div class="alert alert-danger" role="alert">
            Empty clients!!
        </div>
    @endif

@include('footer');
</body>
</html>
