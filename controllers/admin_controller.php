<?php
require_once('controllers/base_controller.php');
require_once('utils/MyUtil.php');;
require_once('models/Admin.php');
require_once('models/AdminDAO.php');
require_once('models/Category.php');
require_once('models/CategoryDAO.php');
require_once('models/Product.php');
require_once('models/ProductDAO.php');
require_once('models/COrder.php');
require_once('models/COrderDAO.php');
require_once('models/OrderDetail.php');
require_once('models/OrderDetailDAO.php');
require_once('models/Customer.php');
require_once('models/CustomerDAO.php');
require_once('utils/EmailUtil.php');


class AdminController extends BaseController {
  function __construct() {
    $this->folder = 'admin';
  }
  public function home() {
    if ($_SESSION['admin'] != null) {
      $this->render('home');
    } else {
      header('Location:?controller=admin&action=login');
    }
  }
  // login | logout
  public function login() {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $admin = AdminDAO::selectByUsername($username);
      if ($admin != null && $admin->password == $password) {
        $_SESSION['admin'] = serialize($admin);
        header('Location:?controller=admin&action=home');
      } else {
        //MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=login');
      }
    } else { // GET
      $this->render('login');
    }
  }
  public function logout() {
    unset($_SESSION['admin']);
    header('Location:?controller=admin&action=home');
  }
  public function listcategory() {
    $cates = CategoryDAO::selectAll();
    $data = array('cates'=>$cates);
    $this->render('listcategory', $data);
  }
  
  public function listproduct() {
    $cates = CategoryDAO::selectAll();
    $prods = ProductDAO::selectAll();
    $data = array('cates'=>$cates, 'prods'=>$prods);
    $this->render('listproduct', $data);
  }
  public function addproduct() {
    $name = $_POST['txtName'];
    $price = $_POST['txtPrice'];
    $cateid = $_POST['cmbCategory'];
    $file = $_FILES['fileImage'];
    if ($file['name'] != '') {
      $image = base64_encode(file_get_contents($file['tmp_name']));
      $cdate = round(microtime(true) * 1000); // now in milliseconds
      $prod = new Product(0, $name, $price, $image, $cdate, $cateid);
      $result = ProductDAO::insert($prod);
      if ($result) {
        MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listproduct');
      }
     
    }
    MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listproduct');
  }
  public function updateproduct() {
    $id = $_POST['txtID'];
    $name = $_POST['txtName'];
    $price = $_POST['txtPrice'];
    $cateid = $_POST['cmbCategory'];
    $file = $_FILES['fileImage'];
    if ($file['name'] != '') {
      $image = base64_encode(file_get_contents($file['tmp_name']));
    } else {
      $dbProd = ProductDAO::selectByID($id);
      $image = $dbProd->image;
    }
    $cdate = round(microtime(true) * 1000); // now in milliseconds
    $prod = new Product($id, $name, $price, $image, $cdate, $cateid);
    $result = ProductDAO::update($prod);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listproduct');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listproduct');
    }
  }
  public function deleteproduct() {
    $id = $_POST['txtID'];
    $result = ProductDAO::delete($id);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listproduct');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listproduct');
    }
  }
  public function addcategory() {
    $name = $_POST['txtName'];
    $cate = new Category(0, $name);
    $result = CategoryDAO::insert($cate);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listcategory');
    }
  }
  public function updatecategory() {
    $id = $_POST['txtID'];
    $name = $_POST['txtName'];
    $cate = new Category($id, $name);
    $result = CategoryDAO::update($cate);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listcategory');
    }
  }
  public function listorder() {
    $orders = COrderDAO::selectAll();
    $data = array('orders'=>$orders);
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $odetails = OrderDetailDAO::selectByOrderID($id);
      $data += array('odetails'=>$odetails);
    }
    $this->render('listorder', $data);
  }
  public function updatestatus() {
    $id = $_GET['id'];
    $status = $_GET['status'];
    COrderDAO::update($id, $status);
    header('Location:?controller=admin&action=listorder&id=' . $id);
  }
  public function listcustomer() {
    $custs = CustomerDAO::selectAll();
    $data = array('custs'=>$custs);
    if (isset($_GET['cid'])) {
      $cid = $_GET['cid'];
      $orders = COrderDAO::selectByCustID($cid);
      $data += array('orders'=>$orders);
      if (isset($_GET['oid'])) {
        $oid = $_GET['oid'];
        $odetails = OrderDetailDAO::selectByOrderID($oid);
        $data += array('odetails'=>$odetails);
      }
    }
    $this->render('listcustomer', $data);
  }
  public function deactive() {
    $id = $_GET['id'];
    $token = $_GET['token'];
    $result = CustomerDAO::active($id, $token, 0);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listcustomer');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listcustomer');
    }
  }
  public function sendmail() {
    $id = $_GET['id'];
    $cust = CustomerDAO::selectByID($id);
    if ($cust != null) {
      $subject = 'Signup | Verification';
      $content = 'Thanks for signing up! Please click this link to activate your account:<br/>';
      $content .= 'http://domain/?controller=customer&action=verify&id=' . $cust->id . '&token=' . $cust->token;
      $result = EmailUtil::send($cust->email, $subject, $content);
      if ($result) {
        MyUtil::showAlertAndRedirect('CHECK EMAIL!', '?controller=admin&action=listcustomer');
      } else {
        MyUtil::showAlertAndRedirect('EMAIL FAILURE!', '?controller=admin&action=listcustomer');
      }
    } else {
      header('Location:?controller=admin&action=listcustomer');
    }
  }
  public function deletecategory() {
    $id = $_POST['txtID'];
    $result = CategoryDAO::delete($id);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=admin&action=listcategory');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=admin&action=listcategory');
    }
  }
}
?>