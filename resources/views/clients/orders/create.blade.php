@include('header');
  <div class="content-wrapper">
    
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <h3>Add Order</h3>
        <hr>
        <br>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Categories</h3>
          </div>
          <div class="col-sm-6">
            <h3>Orders</h3>
          </div>
        </div>




        <div class="row mb-2">
          <div class="col-sm-6">
            
            <div class="card-body">          
              <div id="accordion">
                <div class="card card-primary">
                  @foreach ($category as $index=>$item )
                      
                  
                  <div class="card-header">
                    <h4 class="card-title w-140">
                      <a class="d-block w-140" data-toggle="collapse" href="#cat{{$index}}">
                      {{$item->name}}
                      </a>
                    </h4>
                  </div>
                  
                  <div id="cat{{$index}}" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                      
                      <table class="table table-bordered">

                        <thead>
                          <tr>
                            <th style=" background-color:red" >#</th>
                            <th style="background-color:red">name</th>
                            <th style="background-color:red">sale_price</th>
                            <th style="background-color:red">add</th>
                          </tr>
                        </thead>
      
                        @php
                      $i=1;
                      @endphp
                      @foreach($product as $item1)
                    @if($item1->category_id==$item->id)
                        <tbody>
                          <tr>
                              <td>{{$i++}}</td>
                              <td style="color:green">{{$item1->name}}</td>
                              <td style="color:green">{{$item1->sale_price}}</td>
                              <td style="color:green"><a
                                  href="#" class="btn btn-primary btn-sm add product-{{$item1->id}} "
                                  
                                  data-name="{{$item1->name}}"
                                  data-id="{{$item1->id}}"
                                  data-price="{{$item1->sale_price}}"
                                 >
                                 <span class="fa fa-plus"></span>
                                </a></td>
                            </tr>
                          </tbody>
                          @endif
                          @endforeach
                        </table>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div><!-- /.col -->
         
         
          <div class="col-sm-6">
          <br>
          <form action="{{route('client.order.store',$clients->id)}}" method="post">
            {{csrf_field()}}
          <table class="table" style="">
            <thead>
              <tr>
                
                <th>product</th>
                <th>quantity</th>
                <th style="width: 40px">price</th>
              </tr>
            </thead>


            <tbody class="order-list">
            
            </tbody>
          </table>
          <div class="total-price">
            <h4>Total Price:0</h4>
          </div>
          <div>
          <button id="add-form-button" type="submit"   class="d-block btn btn-primary disabled " >Add Order</button>
          </div>
        </form>
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>


  






 

 @include('footer');

</body>
</html>
