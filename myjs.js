$(document).ready(function() {

  $("#login-form").submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "/~yuan/UNOCAFE/process/login.php",
      data: data,
      success: function(data) {
        if (data === "Success") {
          alert("Login Success");
          window.location.replace("index.php");
        } else {
          alert("Invalid User");
        }
      }
    });
  });



  $(".product-form").submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "/~yuan/UNOCAFE/process/add-to-cart.php",
      data: data,
      success: function(data) {
        if (data === "Success") {
          alert("Successfuly Added to Cart");
        } else if (data === "Already Added") {
          alert("Already Added to the Cart");
        } else if (data == "Please Login First") {
          alert("Please Login First")
        } else {
          alert("Invalid User");
        }

      }
    });
  });



  $(".remove-product").click(function(e) {
    var index = $(this)
      .closest(".product-removal")
      .attr("id");
    var remove = "remove";
    $.ajax({
      type: "POST",
      url: "/~yuan/UNOCAFE/process/remove-product.php",
      data: { index: index, remove: remove },
      success: function(data) {}
    });
  });

  $(".place-order").submit(function(e) {
    e.preventDefault();

    var address = $(".place-order")
      .children(".modal-body")
      .children("textarea")
      .val();
    var total = $("#cart-total").text();
    var order = "order";

    $.ajax({
      type: "POST",
      url: "/~yuan/UNOCAFE/process/order.php",
      data: {
        address: address,
        total: total,
        order: order
      },
      success: function(data) {
        if (data === "ongoing") {
          alert("You still have a ongoing delivery");
          window.location.replace("cart.php");
        } else {
          $(".product").each(function() {
            var product_id=$(".product-id").val();
            var product = $(this)
              .children(".product-details")
              .children(".product-title")
              .text();
            var qty = $(this)
              .children(".product-quantity")
              .children("input")
              .val();
            var price = $(this)
              .children(".product-line-price")
              .text();
            var order_details = "order";
            var order_id = data;

            $.ajax({
              type: "POST",
              url: "/~yuan/UNOCAFE/process/order.php",
              data: {
                product_id:product_id,
                product: product,
                qty: qty,
                price: price,
                order_id: order_id,
                order_details: order_details
              },
              success: function(data) {}
              
            });
          });
          alert("Order Successfully");
          window.location.replace("cart.php");
        }
      }
    });
  });

  /* Set rates + misc */
  var taxRate = 0.12;
  var shippingRate = 15.0;
  var fadeTime = 300;
  var checkout = [];
  recalculateCart();

  /* Assign actions */
  $(".product-quantity input").change(function() {
    updateQuantity(this);
  });

  $(".product-removal button").click(function() {
    removeItem(this);
  });

  $(".checkout").click(function() {
    putCheckout(this);
  });

  /* Recalculate cart */
  function recalculateCart() {
    var subtotal = 0;

    /* Sum up row totals */
    $(".product").each(function() {
      subtotal += parseFloat(
        $(this)
          .children(".product-line-price")
          .text()
      );
    });

    /* Calculate totals */
    var tax = subtotal * taxRate;
    var shipping = subtotal > 0 ? shippingRate : 0;
    var total = subtotal + tax + shipping;

    /* Update totals display */
    $(".totals-value").fadeOut(fadeTime, function() {
      $("#cart-subtotal").html(subtotal.toFixed(2));
      $("#cart-tax").html(tax.toFixed(2));
      $("#cart-shipping").html(shipping.toFixed(2));
      $("#cart-total").html(total.toFixed(2));
      if (total == 0) {
        $(".checkout").fadeOut(fadeTime);
      } else {
        $(".checkout").fadeIn(fadeTime);
      }
      $(".totals-value").fadeIn(fadeTime);
    });
  }

  /* Update quantity */
  function updateQuantity(quantityInput) {
    /* Calculate line price */
    var productRow = $(quantityInput)
      .parent()
      .parent();
    var price = parseFloat(productRow.children(".product-price").text());
    var quantity = $(quantityInput).val();
    var linePrice = price * quantity;

    /* Update line price display and recalc cart totals */
    productRow.children(".product-line-price").each(function() {
      $(this).fadeOut(fadeTime, function() {
        $(this).text(linePrice.toFixed(2));
        recalculateCart();
        $(this).fadeIn(fadeTime);
      });
    });
  }

  // /* Checkout */
  // function putCheckout(checkout) {
  //   $("#modal-checkout").text("");
  //   $(".product").each(function() {
  //     var product = $(this)
  //       .children(".product-details")
  //       .children(".product-title")
  //       .text();
  //     var qty = $(this)
  //       .children(".product-quantity")
  //       .children("input")
  //       .val();
  //     var price = $(this)
  //       .children(".product-line-price")
  //       .text();
  //     $("#modal-checkout").append(
  //       "<li>" + product + "  " + qty + "pcs" + " " + price + "</li><br>"
  //     );
  //   });
  // }

  /* Remove item from cart */
  function removeItem(removeButton) {
    /* Remove row from DOM and recalc cart total */
    var productRow = $(removeButton)
      .parent()
      .parent();
    productRow.slideUp(fadeTime, function() {
      productRow.remove();
      recalculateCart();
    });
  }
});

/* Register Form Validation */

$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("#register-form").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      username: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      cpassword: {
        required: true,
        equalTo: "#orangeForm-pass"
      }
    },
    // Specify validation error messages
    messages: {
      username: "Please enter your username",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      cpassword: {
        required: "Please confirm your password",
        equalTo: "Password not match"
      },
      email: "Please enter a valid email address"
    },

    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
