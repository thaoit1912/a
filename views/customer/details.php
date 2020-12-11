<link rel="stylesheet" href="assets/css/home.css">
<body class="customer">

  <div class="align-center">
  <?php require_once('views/layouts/customer_menu.php') ?>
  <?php require_once('views/layouts/customer_inform.php') ?>
    <h2 class="text-center">PRODUCT DETAILS</h2>
    <figure class="caption-right">
      <img src="data:image/jpg;base64,<?=$prod->image?>" width="400" height="400" />
      <figcaption>
        <form action="?controller=customer&action=add2cart" method="POST">
          <table class="detail">
            <tr>
              <td align="right">ID:&nbsp;&nbsp;</td>
              <td><?=$prod->id?></td>
            <tr>
            <tr>
              <td align="right">Name:&nbsp;&nbsp;</td>
              <td><?=$prod->name?></td>
            <tr>
            <tr>
              <td align="right">Price:&nbsp;&nbsp;</td>
              <td><?=$prod->price?>00$</td>
            <tr>
            <tr>
              <td align="right">CatID:&nbsp;&nbsp;</td>
              <td><?=$prod->cateid?></td>
            <tr>
            <tr>
              <td align="right">Quantity:&nbsp;&nbsp;</td>
              <td class="a"><input type="number" name="txtQuantity" value="1" min="1" max="99" required /></td>
            <tr>
            <tr>
              <td><input type="hidden" name="txtID" value="<?=$prod->id?>" /></td>
              <td><input type="submit" value="ADD TO CART" /></td>
            </tr>
          </table>
        </form>
      </figcaption>
    </figure>
  </div>
</body>