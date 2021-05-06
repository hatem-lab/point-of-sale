
<div class="product-print">
<div class="card-body table-responsive p-0">
   <table class="table table-hover text-nowrap">
     <thead>
       <tr>
  
         <th>product-name</th>
         <th>quantity</th>
         <th>price</th>
  
       </tr>
     </thead>
     <tbody>
      @foreach ($products as $product )
    

      <tr>
         <td>{{$product->name}}</td>
         <td>{{$product->pivot->quantity}}</td>
         <td>{{$product->sale_price * $product->pivot->quantity}} </td>                                    
      </tr>
      
      @endforeach
     
     </tbody>
   </table>
   
 </div>
 <br> <br>
 <br> 
 <div>
 </div>
 <h3> Total Price: {{$order->total_price}}</h3>
 </div>
 <div class="container">
   <button class="print" id="print-form-button" type="submit"   class="d-block btn btn-primary " >Print</button>
   </div>