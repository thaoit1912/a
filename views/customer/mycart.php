    <link rel="stylesheet" href="assets/css/home.css">
<body class="customer">

  <?php require_once('views/layouts/customer_menu.php') ?>
  <?php require_once('views/layouts/customer_inform.php') ?>
  <div class="align-center">
    <h2 class="text-center">ITEM LIST</h2>
    <table class="datatable_1" border="0">
      <tr class="datatable_1">
        <th>ID</th>
        <th>Name</th>
        <th>CatID</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Action</th>
      </tr>
      <?php foreach (unserialize($_SESSION['mycart'])->items as $item) { ?>
      <tr class="datatable">
        <th><?=$item->product->id?></th>
        <td><?=$item->product->name?></td>
        <td><?=$item->product->cateid?></td>
        <td><img src="data:image/jpg;base64,<?=$item->product->image?>" width="70" height="70" /></td>
        <td><?=$item->product->price?></td>
        <td><?=$item->quantity?></td>
        <td><?=$item->product->price * $item->quantity?></td>
        <td><a href="?controller=customer&action=remove2cart&id=<?=$item->product->id?>">Remove</a></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="5"></td>
        <td>Total</td>
        <td><?= unserialize($_SESSION['mycart'])->getTotal() ?></td>
        <td><a href="?controller=customer&action=checkout" onclick="return confirm('ARE YOU SURE?')">CHECKOUT</a></td>
      </tr>
      
    </table>
    
  </div>
</body>