@include('header');
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


<div class="container" style="margin-left:200px">
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edite Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">category</label>
                    <select type="text" name="category_id" class="form-control"  >
                    @foreach($categories as $category)
                     <option value="{{$category->id}}" {{ $product->category_id==$category->id ?'selected' : ""}}>{{$category->name}}</option>  
                     @endforeach
                    </select>
                  </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" name="name" value="{{$product->name}}" class="form-control"  >
                  </div>

                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">description</label>
                    <input class="form-control" name="description" value="{{$product->description}}" id="exampleFormControlTextarea1" >
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">purchase_price</label>
                    <input type="number" name="purchase_price" value="{{$product->purchase_price}}" class="form-control" id="exampleInputPassword1" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">sale_price</label>
                    <input type="number" name="sale_price" value="{{$product->sale_price}}" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">stock</label>
                    <input type="number" name="stock" value="{{$product->stock}}" class="form-control" id="exampleInputPassword1" >
                  </div>
                  <div class="form-group">
                        <label for="exampleFormControlFile1">Photo</label>
                        <img  src="{{$product->image_path}}"  alt="{{$product->image_path}}" width="150" height="100">
                        <input type="file" name="photo" class="form-control-file image" id="exampleFormControlFile1">
                    </div>
                    
                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
  </div>


 @include('footer');

</body>
</html>
