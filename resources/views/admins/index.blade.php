@include('header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(auth()->user()->hasPermission('create_users'))
            <a class="btn btn-primary" href="{{route('admin.create')}}">Add Admin</a>
            @else
            <a class="btn btn-primary disabled">Add Admin</a>
            @endif
            <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="search" type="search" placeholder="Search" aria-label="Search">
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

    @if($admins->count()>0)
<div class="container" style="margin-left:4px">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-14">
            <div class="card">
              <div class="card-header" style="background-color:blue">
                <h3 class="card-title">Admins</h3>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body">
              
                <table class="table table-bordered">

                  <thead>
                    <tr>
                      <th style=" background-color:red" >#</th>
                      <th style="background-color:red">name</th>
                      <th style="background-color:red">email</th>
                      <th style="background-color:red">date</th>
                      <th style="background-color:red">permission</th>
                      <th style="background-color:red">photo</th>
                      <th style="background-color:red" >action</th>
                    </tr>
                  </thead>

                  @php
                $i=1;
                @endphp
                @foreach($admins as $item)
                  <tbody>
                    <tr>
                      <td>{{$i++}}</td>
                      <td style="color:green">{{$item->name}}</td>
                      <td style="color:green">{{$item->email}}</td>
                      <td style="color:green">{{$item->created_at->diffForHumans()}}</td>   
                      <td style="color:green">
                      @foreach($item->permissions as $permission)
                      {{$permission->display_name.","}}
                      @endforeach
                      </td>

                      <td >
                      @if($item->hasRole('user'))
                     <img  src="{{$item->image_path}}" alt="{{$item->image_path}}" width="150" height="100">
                     @else
                     <img  src="{{URL::asset('dist/img/user2-160x160.jpg')}}"  width="150" height="100">
                     @endif
                     </td>
                      <td>
                      @if(auth()->user()->hasPermission('update_users'))
                      <a class="btn btn-info btn-sm" href="{{route('admin.edit',$item->id)}}">Edit</a>
                      @else
                      <a class="btn btn-info btn-sm disabled" >Edit</a>
                      @endif
                      
                      @if(auth()->user()->hasPermission('delete_users'))
                      <a class="btn btn-danger btn-sm" href="{{route('admin.delete',$item->id)}}">Delete</a>
                      @else
                      <a class="btn btn-danger btn-sm disabled" >Delete</a>
                      @endif
                      </td>
                    </tr>
                    </tbody>
                    @endforeach
                  </table>
                  
                  </div>
                  <div class="card-footer clearfix">
               
             
                  <h3>{{$admins->appends(request()->query())->links()}}</h3>
                 
               
              </div>
                  
                  </div></div></div></div>
                  </section></div>
                  @else
        <div class="alert alert-danger" role="alert">
            Empty admins!!
        </div>
    @endif
   
@include('footer')
</body>
</html>
