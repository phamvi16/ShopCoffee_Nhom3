
$(document).ready(function(){
  $('.add-to-cart').click(function(){
      var id = $(this).data('id');
      var cart_product_id = $('.cart_product_id_' + id).val();
      var cart_product_size = $('.cart_product_size_' + id).val();
      var cart_product_name = $('.cart_product_name_' + id).val();
      var cart_product_image = $('.cart_product_image_' + id).val();
      var cart_product_price = $('.cart_product_price_' + id).val();
      var _token = $('input[name="_token"]').val();
       
      $.ajax({
              url: '/add-cart',
              type: 'post',
              data: {cart_product_id:cart_product_id,cart_product_size:cart_product_size,cart_product_name:cart_product_name,cart_product_image:cart_product_image,_token:_token,cart_product_price:cart_product_price},
               dataType:('json'),
              success:function(cart){
               alert(cart);
                swal("Add to cart success !", "success");
              },
         });
      });
  });
  jQuery(document).ready(function($) {
    // Show price when click on Size
    $(document).on('click', 'input[name="Size"]', function(event) {
      $(".product-prices #saleprice").text($(this).data('saleprice') + ' VND');
      $(".product-prices #price").text($(this).data('price') + ' VND');
    });
  });

