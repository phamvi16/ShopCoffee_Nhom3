
$(document).ready(function(){
  $('.add-to-cart').click(function(){
      var id = $(this).data('id');
      var _token = $('input[name="_token"]').val();
      
      var pos = $(this).data('pos');
      var cart_product_id;
      var cart_product_size;
      var cart_product_name;
      var cart_product_image;
      var cart_product_price;

      if (pos == 'prodetail') {
        // Click add to cart in product detail page
        // Get selected size
        var selected_size = $('input[name="Size"]:checked');
        cart_product_id = selected_size.data('product-id');
        cart_product_size = selected_size.closest('li').find('span.radio-label').text();
        cart_product_name = $('#name').text();
        cart_product_image = $('.images-container img').data('product-image');
        cart_product_price = selected_size.data('buyprice');
      }
      else {
        // Click add to cart in menu page
        cart_product_id = $('.cart_product_id_' + id).val();
        cart_product_size = $('.cart_product_size_' + id).val();
        cart_product_name = $('.cart_product_name_' + id).val();
        cart_product_image = $('.cart_product_image_' + id).val();
        cart_product_price = $('.cart_product_price_' + id).val();
      }
      // console.log(cart_product_id + ' / ' + cart_product_size + "/" + cart_product_name + "/" + cart_product_image + "/" + cart_product_price);
       
      $.ajax({
              url: '/add-cart',
              type: 'post',
              data: {cart_product_id:cart_product_id,cart_product_size:cart_product_size,cart_product_name:cart_product_name,cart_product_image:cart_product_image,_token:_token,cart_product_price:cart_product_price},
              dataType:('text'),
              success:function(cart){
              //  alert(cart);
                swal("Thông Báo","Thêm Vào Giỏ Thành Công !", "success");
              },
              error: function(error) {
                console.log(error)
              }
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

