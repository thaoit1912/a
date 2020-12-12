<?php
require_once('controllers/base_controller.php');
require_once('models/Category.php');
require_once('models/CategoryDAO.php');
require_once('models/Product.php');
require_once('models/ProductDAO.php');
require_once('models/Customer.php');
require_once('models/CustomerDAO.php');
require_once('utils/MyUtil.php');
require_once('utils/EmailUtil.php');
require_once('models/Cart.php');
require_once('models/CartItem.php');
require_once('models/COrder.php');
require_once('models/COrderDAO.php');
require_once('models/OrderDetail.php');
require_once('models/OrderDetailDAO.php');
class CustomerController extends BaseController {
  function __construct() {
    $this->folder = 'customer';
  }
  public function home() {
    $cates = CategoryDAO::selectAll();
    $newprods = ProductDAO::selectTopNew(15);
    $hotprods = ProductDAO::selectTopHot(3);
    $data = array('cates'=>$cates,'newprods'=>$newprods,'hotprods'=>$hotprods);
    $this->render('home', $data);
  }
  public function listproduct() {
    $cates = CategoryDAO::selectAll();
    $cateid = $_GET['cateid'];
    $prods = ProductDAO::selectByCateID($cateid);
    $data = array('cates'=>$cates, 'prods'=>$prods);
    $this->render('listproduct', $data);
  }
  public function search() {
    $cates = CategoryDAO::selectAll();
    $keyword = $_POST['txtKeyword'];
    $prods = ProductDAO::selectByKeyword($keyword);
    $data = array('cates'=>$cates, 'prods'=>$prods);
    $this->render('listproduct', $data);
  }
  public function details() {
    $id = $_GET['id'];
    $prod = ProductDAO::selectByID($id);
    $data = array('prod'=>$prod);
    $this->render('details', $data);
  }
  public function signup() {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $name = $_POST['txtName'];
      $phone = $_POST['txtPhone'];
      $email = $_POST['txtEmail'];
      $dbCust = CustomerDAO::selectByUsernameOrEmail($username, $email);
      if ($dbCust != null) {
        MyUtil::showAlertAndRedirect('EXISTS USERNAME OR EMAIL!', '?controller=customer&action=signup');
      } else {
        $now = round(microtime(true) * 1000); // now in milliseconds
        $token = md5($now);
        $newCust = new Customer(0, $username, $password, $name, $phone, $email, 0, $token);
        $newID = CustomerDAO::insert($newCust);
        if ($newID > 0) {
          $subject = 'Signup | Verification';
          $content = 'Thanks for signing up! Please click this link to activate your account:<br/>';
          $content .= 'http://domain/?controller=customer&action=verify&id=' . $newID . '&token=' . $token;
          $result = EmailUtil::send($email, $subject, $content);
          if ($result) {
            MyUtil::showAlertAndRedirect('CHECK EMAIL!', '?controller=customer&action=login');
          } else {
            MyUtil::showAlertAndRedirect('EMAIL FAILURE!', '?controller=customer&action=signup');
          }
        } else {
          MyUtil::showAlertAndRedirect('INSERT FAILURE!', '?controller=customer&action=signup');
        }
      }
    } else { // GET
      $this->render('signup');
    }
  }
  public function verify() {
    $id = $_GET['id'];
    $token = $_GET['token'];
    $result = CustomerDAO::active($id, $token, 1);
    if ($result) {
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=customer&action=login');
    } else {
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=customer&action=signup');
    }
  }
  public function login() {
    if (isset($_POST['btnSubmit'])) { // POST
      $username = $_POST['txtUsername'];
      $password = $_POST['txtPassword'];
      $cust = CustomerDAO::selectByUsernameAndPassword($username, $password);
      if ($cust != null && $cust->active == 1) {
        $_SESSION['customer'] = serialize($cust);
        header('Location:?controller=customer&action=home');
      } else {
        MyUtil::showAlertAndRedirect('Vui lòng nhập lại', '?controller=customer&action=login');
      }
    } else { // GET
      $this->render('login');
    }
  }
  public function logout() {
    unset($_SESSION['customer']);
    header('Location:?controller=customer&action=home');
  }
  public function myprofile() {
    if (isset($_POST['btnSubmit'])) { // POST
      if (isset($_SESSION['customer'])) {
        $curCust = unserialize($_SESSION['customer']);
        $username = $_POST['txtUsername'];
        $password = $_POST['txtPassword'];
        $name = $_POST['txtName'];
        $phone = $_POST['txtPhone'];
        $email = $_POST['txtEmail'];
        $newCust = new Customer($curCust->id, $username, $password, $name, $phone, $email, $curCust->active, $curCust->token);
        $result = CustomerDAO::update($newCust);
        if ($result) {
          $_SESSION['customer'] = serialize($newCust);
          MyUtil::showAlertAndRedirect('OK BABY!', '?controller=customer&action=home');
        }
      }
      MyUtil::showAlertAndRedirect('SORRY BABY!', '?controller=customer&action=myprofile');
    } else { // GET
      $this->render('myprofile');
    }
  }
  public function add2cart() {
    $id = $_POST['txtID'];
    $quantity = $_POST['txtQuantity'];
    $prod = ProductDAO::selectByID($id);
    if ($prod != null) {
      $item = new CartItem($prod, $quantity);
      if (isset($_SESSION['mycart'])) {
        $mycart = unserialize($_SESSION['mycart']);
      } else {
        $mycart = new Cart();
      }
      $mycart->addItem($item);
      $_SESSION['mycart'] = serialize($mycart);
    }
    header('Location:?controller=customer&action=home');
  }
  public function mycart() {
    if (isset($_SESSION['mycart']) && unserialize($_SESSION['mycart'])->getSize() > 0) {
      $this->render('mycart');
    } else {
      header('Location:?controller=customer&action=home');
    }
  }
  public function remove2cart() {
    $id = $_GET['id'];
    if (isset($_SESSION['mycart'])) {
      $mycart = unserialize($_SESSION['mycart']);
      $item = $mycart->getItem($id);
      if ($item != null) {
        $mycart->removeItem($item);
        $_SESSION['mycart'] = serialize($mycart);
      }
    }
    header('Location:?controller=customer&action=mycart');
  }
  public function checkout() {
    if (isset($_SESSION['customer'])) {
      $cust = unserialize($_SESSION['customer']);
      if (isset($_SESSION['mycart'])) {
        $mycart = unserialize($_SESSION['mycart']);
        if ($mycart->getSize() > 0) {
          $now = round(microtime(true) * 1000); // now in milliseconds
          $order = new COrder(0, $now, $mycart->getTotal(), 'PENDING', $cust->id);
          $orderid = COrderDAO::insert($order);
          if ($orderid > 0) {
            foreach ($mycart->items as $item) {
              $odetail = new OrderDetail($orderid, $item->product->id, $item->quantity);
              OrderDetailDAO::insert($odetail);
            }
            unset($_SESSION['mycart']);
          }
        }
      }
      MyUtil::showAlertAndRedirect('OK BABY!', '?controller=customer&action=home');
    } else {
      header('Location:?controller=customer&action=login');
    }
  }
  public function myorders() {
    if (isset($_SESSION['customer'])) {
      $cust = unserialize($_SESSION['customer']);
      $orders = COrderDAO::selectByCustID($cust->id);
      $data = array('orders'=>$orders);
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $odetails = OrderDetailDAO::selectByOrderID($id);
        $data += array('odetails'=>$odetails);
      }
      $this->render('myorders', $data);
    } else {
      header('Location:?controller=customer&action=home');
    }
  }
  
}
?>