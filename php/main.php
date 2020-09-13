<?
/**
 * Debug function
 */
function d($value = null, $die = 1) {
  echo 'Debug: <br /><pre>';
  print_r($value);
  echo '</pre>';

  if($die) die;
};

//If count of tasks = 0 add default values
if(!isset($_SESSION['tasks'])) {
  $_SESSION['tasks'] = [
    [
      'id' => rand(),
      "userName" => "fox",
      "email" => "paspd@mail.com",
      "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, eum!",
      "status" => 0
    ],
    [
      'id' => rand(),
      "userName" => "rud",
      "email" => "asd@gmail.com",
      "description" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis, aliquid perspiciatis praesentium molestiae, facilis sequi, ipsa dicta rem sint obcaecati temporibus officiis voluptatem fugiat reiciendis odio neque iste expedita. Distinctio!",
      "status" => 0
    ],
    [
      'id' => rand(),
      "userName" => "sadfg",
      "email" => "asd1@gmail.com",
      "description" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis, aliquid perspiciatis praesentium molestiae, facilis sequi, ipsa dicta rem sint obcaecati temporibus",
      "status" => 0
    ],
    [
      'id' => rand(),
      "userName" => "rud234",
      "email" => "asd@gmailads.com",
      "description" => "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis, aliquid perspiciatis",
      "status" => 0
    ]
  ];
}

//Users
if(!isset($_SESSION['users'])) {
  $_SESSION['users'][] = [
    'login' => 'admin',
    'password' => '123',
    'admin' => '1'
  ];
}

//Initialization status as not admin
if(!isset($_SESSION['status'])) {
  $_SESSION['status'] = 0;
}

?>
