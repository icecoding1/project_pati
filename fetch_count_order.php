<?php
require_once("connection/config.php");

if ($_SERVER['REQUEST_METHOD']  == 'GET') {
  if (isset($_GET['show_count'])) {
    $sql_showcount = "SELECT * FROM table_order WHERE status = 1";
    $result_showcount  = $obj->query($sql_showcount);
    $count_list_new = $result_showcount->rowCount();
    $text = "";
    $text .= "<span>" . $count_list_new . "</span>";
    echo $text;
  }

  // if()
}
