@include('header');
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Admins</h1>
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
                <h3 class="card-title">Edit Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('admin.update',$admin->id)}}" method="post">
              {{csrf_field()}}
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">UserName</label>
                    <input type="text" name="name" value="{{$admin->name}}" class="form-control"  placeholder="Enter name">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" value="{{$admin->email}}" class="form-control"  placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>

                  <div class="form-group">
                        <label for="exampleFormControlFile1">Photo</label><br>
                        <img  src="{{URL::asset($admin->photo)}}" class=" image_preview" alt="{{$admin->photo}}" width="150" height="100">
                        <input type="file" name="photo" vlaue="" class="form-control-file image" id="exampleFormControlFile1">
                    </div>
                
                </div>
                <!-- /.card-body -->
                <h5 class="mt-4 mb-2">Permission</h5>

<div class="row">
  <div class="col-12">
    <!-- Custom Tabs -->
    <div class="card">
      <div class="card-header d-flex p-0">
      @php
      $models=['users','categories','products'];
      $maps=['create','read','update','delete'];
      @endphp
        <ul class="nav nav-pills ml-auto p-2">
        @foreach($models as $index=>$model)
          <li class="nav-item"><a class="nav-link {{$index==0 ? 'active' : ''}} " href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>
          @endforeach
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
        @foreach($models as $index=>$model)
          <div class="tab-pane {{$index==0 ? 'active' : ''}}" id="{{$model}}">
          <div >
          @foreach($maps as $index=>$map)
                   <label> <input type="checkbox" name="permissions[]" value="{{$map}}_{{$model}}" {{$admin->hasPermission($map."_".$model) ? "checked" : ''}} >{{$map}}</label>
                   
                   @endforeach  
                   
           </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
 
  </div>

</div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
  </div>




  <script>


$(".image").change(function() {
    if (this.files && this.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('.image_preview').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(this.files[0]); // convert to base64 string
  }
});

</script>

@include('footer');
</body>
</html>
