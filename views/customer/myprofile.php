<body>
  <?php require_once('views/layouts/customer_menu.php') ?>
  <?php require_once('views/layouts/customer_inform.php') ?>
  <link rel="stylesheet" href="assets/css/home.css">
  <div class="align-center">
    <h2 class="text-center">MY PROFILE</h2>
    <form action="?controller=customer&action=myprofile" method="POST">
      <table class="align-centerprofile">
        <tr>
          
          <td>Username&nbsp;&nbsp;</td>
          <td class = "pf"><input type="text" name="txtUsername" value="<?= unserialize($_SESSION['customer'])->username ?>" readonly /></td>
        </tr>
        <tr>
          <td>Password&nbsp;&nbsp;</td>
          <td class = "pf"><input type="password" name="txtPassword" value="<?= unserialize($_SESSION['customer'])->password ?>" pattern=".{3,}" required /></td>
        </tr>
        <tr>
          <td>Name&nbsp;&nbsp;</td>
          <td class = "pf"><input type="text" name="txtName" value="<?= unserialize($_SESSION['customer'])->name ?>" required /></td>
        </tr>
        <tr>
          <td>Phone&nbsp;&nbsp;</td>
          <td class = "pf"><input type="tel" name="txtPhone" value="<?= unserialize($_SESSION['customer'])->phone ?>" pattern="0[0-9]{9}" required /></td>
        </tr>
        <tr>
          <td>Email&nbsp;&nbsp;</td>
          <td class = "pf"><input type="email" name="txtEmail" value="<?= unserialize($_SESSION['customer'])->email ?>" readonly /></td>
        </tr>
        <tr>
          <td></td>
          <td class = "pf1" ><input type="submit" name="btnSubmit" value="UPDATE" /></td>
        </tr>
      </table>
    </form>
  </div>
</body>