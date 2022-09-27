<?php
require_once("connection/config.php");
ob_start();
session_start();
if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {
  if ($_SERVER['REQUEST_METHOD']  == 'GET') {
    
    if (isset($_GET['show_count'])) {
      $sql_showcount = "SELECT * FROM table_order WHERE status = 1";
      $result_showcount  = $obj->query($sql_showcount);
      $count_list_new = $result_showcount->rowCount();
      $text = "";
      $text .= "<span>" . $count_list_new . "</span>";
      echo $text;
    }

    if (isset($_GET['get_ordernew1'])) {
      $sql1 = "SELECT * FROM table_order WHERE status = 1 ORDER BY number_sort DESC";
      $result  = $obj->query($sql1);
      $count_list_new = $result->rowCount();
      $text = "";

      if ($count_list_new == 0) {

        $text .= "  <tr>
        <td colspan='5' align='center'>ไม่มีรายการ</td>
      </tr>";
      } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $text .= " <tr>
          <td nowrap>" . $row['number_order'] . "</td>
          <td nowrap> " . $row['create_date'] . "</td>
          <td nowrap>โต๊ะ " . $row['table_user'] . "</td>
          <td nowrap><span class='text-danger fw-semibold'>รอการยืนยัน</span></td>
          <td nowrap> <a href='order_new.php?page=1&id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      echo $text;
    }


    if (isset($_GET['get_ordernew2'])) {
      $sql1 = "SELECT * FROM table_order WHERE status = 2 ORDER BY number_sort DESC";
      $result  = $obj->query($sql1);
      $count_list_new = $result->rowCount();
      $text = "";

      if ($count_list_new == 0) {

        $text .= "  <tr>
        <td colspan='5' align='center'>ไม่มีรายการ</td>
      </tr>";
      } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $text .= " <tr>
          <td nowrap>" . $row['number_order'] . "</td>
          <td nowrap> " . $row['create_date'] . "</td>
          <td nowrap>โต๊ะ " . $row['table_user'] . "</td>
          <td nowrap><span class='text-warning fw-semibold'>ยืนยันเเล้ว</span></td>
          <td nowrap> <a href='order_new.php?page=2&id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      echo $text;
    }



    if (isset($_GET['get_ordernew3'])) {
      $sql1 = "SELECT * FROM table_order WHERE status = 3 ORDER BY number_sort DESC";
      $result  = $obj->query($sql1);
      $count_list_new = $result->rowCount();
      $text = "";

      if ($count_list_new == 0) {

        $text .= "  <tr>
        <td colspan='5' align='center'>ไม่มีรายการ</td>
      </tr>";
      } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $text .= " <tr>
          <td nowrap>" . $row['number_order'] . "</td>
          <td nowrap> " . $row['create_date'] . "</td>
          <td nowrap>โต๊ะ " . $row['table_user'] . "</td>
          <td nowrap><span class='text-success fw-semibold'>สำเร็จ</span></td>
          <td nowrap> <a href='order_new.php?page=3&id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      echo $text;
    }
  } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['search'])) {
      $txt_search = isset($_POST['text_search_order']) ? $_POST['text_search_order'] : "";
      $check_count = str_split($txt_search);

      if (count($check_count) == 2) {
        $sql = "SELECT * FROM table_order WHERE status = 3 AND  table_user LIKE '%$txt_search%' ORDER BY number_sort DESC";
      } else {
        $sql = "SELECT * FROM table_order WHERE status = 3 AND number_order LIKE '%$txt_search%' ORDER BY number_sort DESC";
      }
      $result = $obj->query($sql);
      $count_list_new = $result->rowCount();

      $text = "";

      if ($count_list_new == 0) {

        $text .= "  <tr>
        <td colspan='5' align='center'>ไม่มีรายการ</td>
      </tr>";
      } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $text .= " <tr>
          <td nowrap>" . $row['number_order'] . "</td>
          <td nowrap> " . $row['create_date'] . "</td>
          <td nowrap>โต๊ะ " . $row['table_user'] . "</td>
          <td nowrap><span class='text-success fw-semibold'>สำเร็จ</span></td>
          <td nowrap> <a href='order_new.php?page=3&id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      echo $text;
    }
  } else {
    echo "<script>window.history.back();</script>";
  }
} else {
  echo "<script>
  if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
  location.assign('../../login.php');
  } else {
  location.assign('../../login.php');
  }
  </script>";
}
