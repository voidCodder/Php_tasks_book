<?
session_start();

$out = json_decode(file_get_contents('php://input'));
if(isset($out)) {
  $id = $out -> id;
  $elementText = $out -> elementText;
  $status = $out -> status;
  $status = intval($status);

  foreach ($_SESSION['tasks'] as $key => $task) {
    if($task['id'] == $id) {
      if(isset($elementText)) {
        $_SESSION['tasks'][$key]['description'] = $elementText;
      }
      $_SESSION['tasks'][$key]['status'] = $status;
    }
  }
}

echo json_encode($out);

?>