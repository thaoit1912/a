<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
function details(id, name) {
  document.getElementById("txtID").value = id;
  document.getElementById("txtName").value = name;
  document.getElementById("btnUpdate").style.display = "inline";
  document.getElementById("btnDelete").style.display = "inline";
}
</script>
<body class="admin">
  <?php require_once('views/layouts/admin_menu.php') ?>
  <div class="float-left2">
    <h2 class="text-center2">CATEGORY LIST</h2>
    <table class="datatable" border="1">
      <tr class="datatable">
        <th>ID</th>
        <th>Name</th>
      </tr>
      <?php foreach ($cates as $item) { ?>
        <tr class="datatable" onclick="details('<?=$item->id?>','<?=$item->name?>')">
          <th><?=$item->id?></th>
          <td><?=$item->name?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <div class="inline" style="width: 40px"></div>
  <div class="float-right2">
    <h2 class="text-center2">CATEGORY DETAIL</h2>
    <form method="POST">
      <table>
        <tr>
          <td class= "b">ID</td>
          <td><input type="text" id="txtID" name="txtID" readonly /></td>
        </tr>
        <tr>
          <td class= "b">Name</td>
          <td><input type="text" id="txtName" name="txtName" required /></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" formaction="?controller=admin&action=addcategory" value="ADD NEW" />
            <input type="submit" formaction="?controller=admin&action=updatecategory" value="UPDATE" id="btnUpdate" style="display:none" />
            <input type="submit" formaction="?controller=admin&action=deletecategory" value="DELETE" id="btnDelete" style="display:none" onclick="return confirm('ARE YOU SURE?')" />
          </td>
        </tr>
      </table>
    </form>
  </div>
  <div class="float-clear"></div>
</body>