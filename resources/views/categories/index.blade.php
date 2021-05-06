@include('header');

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(auth()->user()->hasPermission('create_users'))
            <a class="btn btn-primary" href="{{route('category.create')}}">Add Category</a>
            @else
            <a class="btn btn-primary disabled">Add Category</a>
            @endif
            <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="search1" type="search" placeholder="Search" aria-label="Search">
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
    @if($categories->count()>0)

<div class="container" style="margin-left:100px">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header" style="background-color:blue">
                <h3 class="card-title">Categories</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <table class="table table-bordered">

                  <thead>
                    <tr>
                      <th style=" background-color:red" >#</th>
                      <th style="background-color:red">name</th>
                      <th style="background-color:red">product_count</th>
                      <th style="background-color:red">category_content</th>
                      <th style="background-color:red">date</th>
                      <th style="background-color:red">action</th>
                    </tr>
                  </thead>

                  @php
                  
                $i=1;
                $count=0;
                @endphp
                @foreach($categories as $item)
                  <tbody>
                    <tr>
                      <td>{{$i++}}</td>
                      <td style="color:green">{{$item->name}}</td>
                      
                      <td style="color:green">
                      @foreach($product as $item1)
                      @if($item1->category_id==$item->id)
                      @php
                       $count=$count+1;
                       @endphp
                      @endif 
                      @endforeach
                      
                     {{$count}}
                     @php
                       $count=0;
                       @endphp
                      </td>
                      <td style="color:green"><a class="btn btn-sucsess" href="{{route('product_id',$item->id)}}"> products-info</a></td>
                      <td style="color:green">{{$item->created_at->diffForHumans()}}</td>   
                      <td>
                      @if(auth()->user()->hasPermission('update_users'))
                      <a class="btn btn-info" href="{{route('category.edit',$item->id)}}">Edit</a>
                      @else
                      <a class="btn btn-info disabled" >Edit</a>
                      @endif
                      @if(auth()->user()->hasPermission('delete_users'))
                      <a class="btn btn-danger" href="{{route('category.delete',$item->id)}}">Delete</a>
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
            Empty categories!!
        </div>
    @endif

@include('footer');
</body>
</html>
