@include('header');

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            @if(auth()->user()->hasPermission('create_products'))
            <a class="btn btn-primary" href="{{route('product.create')}}">Add Product</a>
            @else
            <a class="btn btn-primary disabled">Add Product</a>
            @endif
           
          
                      
            
          <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" name="search" value="{{request()->search}}" type="search" placeholder="Search" aria-label="Search">
      </div>
        <div class="input-group input-group-sm">
        <select type="text"  name="category_id" class="form-control"  >
          <option value=" ">Categories</option> 
          
        
           @foreach($category as $index=>$item)
           <option value="{{$item->id}}" {{$item->id==request()->category_id? 'selected': ""}}  >{{$item->name}}</option>  
         
           @endforeach
          
         </select>  
        </div>
          <div class="input-group-append">
          <button class="btn btn-navbar" type="submit1">
            <i class="fas fa-search"></i>
          </button>
        </div>
     
    </form>
    
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    @if($products->count()>0)
<div class="container" style="margin-left:7px">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color:blue">
                <h3 class="card-title">Products</h3>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body">
                <table class="table table-bordered">

                  <thead>
                    <tr>
                      <th style=" background-color:red" >#</th>
                      <th style="background-color:red">name</th>
                      <th style="background-color:red">category</th>
                      <th style="background-color:red">description</th>
                      <th style="background-color:red">purchase_price</th>
                      <th style="background-color:red">sale_price</th>
                      <th style="background-color:red">stock</th>
                      <th style="background-color:red">date</th>
                      <th style="background-color:red">photo</th>
                      <th style="background-color:red">action</th>
                    </tr>
                  </thead>

                  @php
                $i=1;
                @endphp
                @foreach($products as $item)
                  <tbody>
                    <tr>
                      <td>{{$i++}}</td>
                      <td style="color:green">{{$item->name}}</td>
                      <td style="color:green">
                      @foreach($category as $item1)
                      @if($item1->id==$item->category_id)
                      {{$item1->name}}
                      @endif
                      @endforeach
                      
                      </td>
                      <td style="color:green">{{$item->description}}</td>
                      <td style="color:green">{{$item->purchase_price}}</td>
                      <td style="color:green">{{$item->sale_price}}</td>
                      <td style="color:green">{{$item->stock}}</td>
                      <td style="color:green">{{$item->created_at->diffForHumans()}}</td>   
                      <td>
                     <img  src="{{$item->image_path}}" alt="{{$item->image_path}}" width="150" height="100">
                     </td>
                      <td>
                      @if(auth()->user()->hasPermission('update_products'))
                      <a class="btn btn-info" href="{{route('product.edit',$item->id)}}">Edit</a>
                      @else
                      <a class="btn btn-info disabled" >Edit</a>
                      @endif
                      @if(auth()->user()->hasPermission('delete_products'))
                      <a class="btn btn-danger" href="{{route('product.delete',$item->id)}}">Delete</a>
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
            Empty products!!
        </div>
    @endif

@include('footer');
</body>
</html>
