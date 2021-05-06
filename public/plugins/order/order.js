$(document).ready(function()
{
    
$('.add').on('click',function(e){
    e.preventDefault();
    var name=$(this).data('name');
    var id=$(this).data('id');
    var price=$(this).data('price');
     $(this).removeClass('btn-primary').addClass('btn-default disabled');
  var html=`
     <tr>
     <td>${name}</td>
     <td><input type="number" data-price="${price}"  name="quantities[]" class="form-control input-sm product-quantity" min="1" value="1"></td>
     <td><input type="hidden" value="${id}" name="products_ids[]"></td>
     <td class="product-price">${price}</td>
     <td><button class="btn btn-danger  btn-sm trash" data-id="${id}"><span class="fa fa-trash"></span></button></td>
     </tr>`;
  
     $('.order-list').append(html);
     calculete();
});


     $('body').on('click','.trash',function(e){
        e.preventDefault();
        var id=$(this).data('id');
         $(this).closest('tr').remove();
          $('.product-'+id).removeClass('btn-default disabled').addClass('btn-primary');
          calculete();
    });

    $('body').on('keyup change','.product-quantity',function(){

      var ProductQuantity=parseInt($(this).val());
      var ProductPrice= $(this).data('price');
      var TotalPrice=ProductQuantity*ProductPrice;
      $(this).closest('tr').find('.product-price').html(TotalPrice);
      calculete();
 
      
      
    });
 

    $('.showProduct').on('click',function(e){

      e.preventDefault();
      var url=$(this).data('url');
      var method=$(this).data('method');
      
      $.ajax(
         {
            url:url,
            method:method,
            success:function(data)
            {
               $('.list-orders').empty();
               $('.list-orders').append(data);
            }
         }
      )

    })
    $(document).on('click','.print',function(){
      $('.product-print').printThis()
   })
    
     

});
function calculete(){
    var price=0;
$('.order-list .product-price').each(function(index){
   price+=parseInt($(this).html());
});
var html=`<h4>Total Price:${price}</h4>`
$('.total-price').html(html);
  if(price>0)  {
     $('#add-form-button').removeClass('disabled')   
  }else{
    $('#add-form-button').addClass('disabled')   
  }
}

     


