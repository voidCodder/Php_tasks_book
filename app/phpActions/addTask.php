<?
session_start();

if(isset($_POST['userName']) && isset($_POST['userEmail'])) {
  $userName = htmlspecialchars($_POST['userName']);
  $userEmail = htmlspecialchars($_POST['userEmail']);
  $userMessage = htmlspecialchars($_POST['userMessage']);
  
  $_SESSION['tasks'][] = [
    'id' => rand(),
    'userName' => $userName,
    'email' => $userEmail,
    'description' => $userMessage,
    'status' => 0
  ];
}

//Redirect
header("Location:" . $_SERVER['HTTP_ORIGIN']);
exit;
?>