<?
$active = (empty($_GET['page']) ? 1 : intval($_GET['page']));
$count_pages = ceil(count($_SESSION['tasks'])/3);
$count_show_pages = 3;

/**
 * Save state sortby + page
 */
if(isset($_GET['sortby'])) {
  $url_page = "?sortby=". $_GET['sortby'] ."&page=";
} else {
  $url_page = "?page=";
}
$pages_content='';
/**
 * Calculation paginator values
 */
$minPage = max(1, $active - 3);
$maxPage = min($count_pages, $active + 3);


/**
 * Output $_SESSION['tasks'] with limit
 */
$offset = ($active - 1) * $count_show_pages;
$tasks = $_SESSION['tasks'];
$tasks = array_splice($tasks, $offset, $count_show_pages);

?>