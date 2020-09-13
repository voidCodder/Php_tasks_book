<?
session_start();

if(isset($_POST['userLogin']) && isset($_POST['userPassword'])) {
  $userLogin = htmlspecialchars($_POST['userLogin']);
  $userPassword = htmlspecialchars($_POST['userPassword']);
  
  foreach ($_SESSION['users'] as $key => $value) {
    if($value['login'] == $userLogin && $value['password'] == $userPassword) {
      $_SESSION['status'] =  $value['admin'];
    }
  }
}

//Redirect
header("Location:" . $_SERVER['HTTP_ORIGIN']);
exit;



?>