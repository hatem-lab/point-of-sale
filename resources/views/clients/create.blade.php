@include('header');
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Clients</h1>
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
                <h3 class="card-title">Add Client</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('client.store')}}" method="post">
              {{csrf_field()}}
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Client</label>
                    <input type="text" name="name" class="form-control"  placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="number" name="phone1" class="form-control"  placeholder="Enter first phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="number" name="phone2" class="form-control"  placeholder="Enter second phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Address</label>
                    <input type="text" name="address" class="form-control"  placeholder="Enter address">
                  </div>

                  </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
              </form>
            </div>
  </div>
  </div>
  </div>
  </section>
  </div>



 @include('footer');

</body>
</html>
