<?php
require "../config/functions.php";
require "../config/connect.php";
adminOnly();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


  <style>
    .header {
      background: #b9cced;
      padding: 30px;
      height: 100px;
      text-transform: uppercase;
      text-align: left;
      border: 1px solid gray;
      box-shadow: 5px 5px #888888;
    }

    .content {
      background-color: #f6e7e6;
      height: 1000px;
    }

    .sidebar-container {
      height: 100%;
      max-width: 200px;
      border-right: 1px solid gray;

      background: #fbf4f9;
      text-align: center;
    }

    .sidebar-container ul {
      padding: 0;
      padding-top: 10px;
    }

    .sidebar-container li {
      list-style: none;
      margin-bottom: 10px;
      font-weight: 100;
    }

    a.nav-link:hover {
      background-color: gray;
    }

    .header h1 {
      font-weight: 100;
      margin: 0;
    }

    table {
      background-color: white;
    }
  </style>
  <script>
    $(document).ready(function() {
      $(".edit-button").click(function() {
        var row = $(this).parent().parent();
        var id = $(row).children('input[name = "id"]').val();
        var product_name = $(row).children('input[name = "product_name"]').val();
        var price = $(row).children('input[name = "price"]').val();
        var description = $(row).children('input[name = "description"]').val();

        $("form").children('input[name="id"]').val(id);
        $("form").children('input[name="product_name"]').val(product_name);
        $("form").children('input[name="price"]').val(price);
        $("form").children('textarea[name="description"]').val(description);


      });
    });
  </script>
</head>


<body>
  <header>
    <div class="container-fluid header">
      <h1>ADMIN</h1>
    </div>
  </header>

  <div class="container-fluid content">
    <div class="row h-100">
      <div class="col-md-2 p-0">
        <nav class="sidebar-container">
          <ul>
            <li><a class="nav-link active">Products</a></li>
            <li><a class="nav-link">Customers</a></li>
            <li><a class="nav-link">Orders</a></li>
          </ul>
        </nav>
      </div>

      <div class="col-lg">
        <div class="container pt-5">
          <table class="table">
            <button class="btn btn-dark mb-2"> ADD USER </button>
            <thead class="thead-dark">
              <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Role</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $users = $db->query("SELECT * FROM users");
              while ($row = $users->fetch_object()) : ?>
                <tr>
                  <td><?= $row->id ?></td>
                  <td><?= $row->username ?></td>
                  <td><?= $row->role ?></td>
                  <td><?= $row->email ?></td>
                  <td>
                    <button class="btn btn-default"> EDIT</button>
                    <button class="btn btn-default"> REMOVE</button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <?php $categ = $db->query("SELECT * FROM product_categ ORDER BY id");
        while ($row = $categ->fetch_object()) : ?>
          <div class="container">
            <table class="table">
              <button class="btn btn-dark"> ADD PRODUCT </button>
              <div class="bg-dark text-white"><?= $row->categ ?></div>
              <thead class="thead-dark">
                <tr>
                  <th>Id</th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $products = $db->query("SELECT * FROM products WHERE categ = '$row->id' ");
                while ($row2 = $products->fetch_object()) : ?>
                  <!-- <form action="editProduct.php" method="POST"> -->
                  <tr>
                    <td><?= $row2->id ?></td>
                    <input type="hidden" name="id" value="<?= $row2->id ?>">
                    <td><?= $row2->product_name ?></td>
                    <input type="hidden" name="product_name" value="<?= $row2->product_name ?>">
                    <td><?= $row2->price ?></td>
                    <input type="hidden" name="price" value="<?= $row2->price ?>">
                    <td><?= $row2->description ?></td>
                    <input type="hidden" name="description" value="<?= $row2->description ?>">
                    <td>
                      <button class="btn btn-default edit-button" data-target="#editModal" data-toggle="modal">UPDATE</button>
                      <button class="btn btn-default">REMOVE</button>
                    </td>
                  </tr>
                  <!-- </form> -->
              <?php endwhile;
              endwhile; ?>
              </tbody>
            </table>
          </div>


          <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <form>
                    <h4>Id</h4>
                    <input type="text" name="id" value="">
                    <h4>Product Name</h4>
                    <input type="text" name="product_name" value="">
                    <h4> Price</h4>
                    <input type="text" name="price" value="">
                    <h4>Description</h4>
                    <textarea name="description"cols="50" rows="5"></textarea>
                  </form>
                </div>
                <div class="modal-footer">
                  <div class="col-md-12">
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>


      </div>
    </div>
  </div>


</body>

</html>