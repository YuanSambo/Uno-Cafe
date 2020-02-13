$(document).ready(function(){
    
   $("#login-form").submit(function(e) {
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: data,
                    success: function(data) {
                        if (data === "Success") {
                            alert("Login Success");
                            window.location.replace("index.php");
                        } else {
                            alert("Invalid User");
                            alert(data); // Remove later ; Used for debugging;
                        }
                    }
                });
            });



           $(".product-form").submit(function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: data,
                    success: function(data) {
                        if (data === "Success") {
                            alert("Successfuly Added to Cart");
                            // window.location.replace("cart.php");

                        } else if (data === "Already Added") {
                            alert("Already Added to the Cart");
                        } else if (data == "Please Login First"){
                          alert(data);
                        }
                        else {
                            alert("Invalid User");
                            alert(data);
                        }
                    }

                });
            });

            $(".remove-product").click(function(e) {
              var index = $(this).closest(".product-removal").attr("id");
              var remove = "remove";
                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: {index:index,remove:remove},
                    success: function(data) {
                    }
                });
            });



  /* Set rates + misc */
  var taxRate = 0.12;
  var shippingRate = 15.00;
  var fadeTime = 300; 
  var checkout = [];
  recalculateCart();

  /* Assign actions */
  $('.product-quantity input').change(function () {
    updateQuantity(this);
  });

  $('.product-removal button').click(function () {
    removeItem(this);
  });

  $(".checkout").click(function(){
     putCheckout(this);
  }); 

  /* Recalculate cart */
  function recalculateCart() {
    var subtotal = 0;

    /* Sum up row totals */
    $('.product').each(function () {
      subtotal += parseFloat($(this).children('.product-line-price').text());
    });

    /* Calculate totals */
    var tax = subtotal * taxRate;
    var shipping = (subtotal > 0 ? shippingRate : 0);
    var total = subtotal + tax + shipping;

    /* Update totals display */
    $('.totals-value').fadeOut(fadeTime, function () {
      $('#cart-subtotal').html(subtotal.toFixed(2));
      $('#cart-tax').html(tax.toFixed(2));
      $('#cart-shipping').html(shipping.toFixed(2));
      $('#cart-total').html(total.toFixed(2));
      if (total == 0) {
        $('.checkout').fadeOut(fadeTime);
      } else {
        $('.checkout').fadeIn(fadeTime);
      }
      $('.totals-value').fadeIn(fadeTime);

      

    });
  }


  /* Update quantity */
  function updateQuantity(quantityInput) {
    /* Calculate line price */
    var productRow = $(quantityInput).parent().parent();
    var price = parseFloat(productRow.children('.product-price').text());
    var quantity = $(quantityInput).val();
    var linePrice = price * quantity;

    /* Update line price display and recalc cart totals */
    productRow.children('.product-line-price').each(function () {
      $(this).fadeOut(fadeTime, function () {
        $(this).text(linePrice.toFixed(2));
        recalculateCart();
        $(this).fadeIn(fadeTime);
      });
    });
  }
   

/* Checkout */
 function putCheckout(checkout){
  $("#modal-checkout").text("");
   $(".product").each(function(){
    var product = $(this).children(".product-details").children(".product-title").text();
     var qty = $(this).children(".product-quantity").children("input").val();
    var price = $(this).children(".product-line-price").text();
     $("#modal-checkout").append("<li>"+product+"  "+ qty+"pcs" + " " + price + "</li><br>");
    
  

  });

 }


  /* Remove item from cart */
  function removeItem(removeButton) {
    /* Remove row from DOM and recalc cart total */
    var productRow = $(removeButton).parent().parent();
    productRow.slideUp(fadeTime, function () {
      productRow.remove();
      recalculateCart();
    });
  }
});

