<?

/**
 * Sort $_SESSION['tasks']
 * @sortby String sort by this value 
 */
if(isset($_GET['sortby'])) {

  function cmp_function($a, $b){
    global $field;
    return ($a[$field] < $b[$field]);
  }

  switch ($_GET['sortby']) {
    case 'name':
      $field = 'userName';
      uasort($_SESSION['tasks'], 'cmp_function');
      break;
    case 'email':
      $field = 'email';
      uasort($_SESSION['tasks'], 'cmp_function');
      break;
    case 'status':
      $field = 'status';
      uasort($_SESSION['tasks'], 'cmp_function');
      break;
  }
}

?>