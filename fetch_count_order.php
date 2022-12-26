<?php
require_once("connection/config.php");
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  if ($_SERVER['REQUEST_METHOD']  == 'GET') {

    if (isset($_GET['show_count'])) {
      $sql_showcount = "SELECT * FROM table_order WHERE status = 1";
      $result_showcount  = $obj->query($sql_showcount);
      $count_list_new = $result_showcount->rowCount();
      $text = "";
      $text .= "<span>" . $count_list_new . "</span>";
      echo $text;
    }



    if (isset($_GET['update_sound'])) {
      $sql = "UPDATE table_order SET sound_notification = 2 WHERE status = 1";
      $result  = $obj->query($sql);
      if ($result) {
        echo "success";
      }
    }


    if (isset($_GET['get_ordernew1'])) {
      $sql1 = "SELECT * FROM table_order WHERE status = 1 ORDER BY number_sort DESC";
      $result  = $obj->query($sql1);
      $count_list_new = $result->rowCount();

      $sum_sql = "SELECT count(sound_notification) from table_order WHERE status = 1 AND sound_notification = 1";
      $result_sum_sql = $obj->query($sum_sql);
      $number_of_rows = $result_sum_sql->fetchColumn();
      $text = "";


      if ($count_list_new == 0) {
        $text .= "  <tr>
        <td colspan='5' align='center'>ไม่มีรายการ</td>
      </tr>";
        $notification_sound = 0;
      } else {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
          $text .= " <tr>
          <td nowrap>" . $row['number_order'] . "</td>
          <td nowrap> " . $row['create_date'] . "</td>
          <td nowrap>โต๊ะ " . $row['table_user'] . "</td>
          <td nowrap><span class='text-danger fw-semibold'>รอการยืนยัน</span></td>
          <td nowrap> <a href='order_new.php?id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      $arr = ["text" => $text, "notification_sound_check" => $number_of_rows];
      echo json_encode($arr);
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
          <td nowrap> <a href='order_new.php?id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
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
          <td nowrap> <a href='order_new.php?id= " . $row['id'] . "'class='btn btn-primary btn-sm'>รายละเอียด</a></td>
        </tr> ";
        }
      }
      echo $text;
    }




    if (isset($_GET['read_detail_one'])) {
      $date_oneday = date("Y-m-d");
      $total_income = 0;
      $count_orderday = 0;
      $sql_onedaty = "SELECT * FROM table_order WHERE date_report LIKE '%$date_oneday%' AND status = 3 ";
      $result_search_ondeday =  $obj->query($sql_onedaty);

      while ($row = $result_search_ondeday->fetch(PDO::FETCH_ASSOC)) {
        $count_orderday = $result_search_ondeday->rowCount();
        $total_income += $row['priceAll'];
      }
      $text = "";
      $text .= "<div class='col-xl-6  fw-bold'><i class='ion ion-stats-bars pr-1 '></i> ยอดขายวันนี้</div>
      <div class='col-xl-6 mb-2'>วันที่ &nbsp;" .  date('d-m-Y') . "</div>
      <div class='col-xl-6 font-five'>รายได้ทั้งหมด</div>
      <div class='col-xl-6 mb-2 '> " . number_format($total_income, 2) . " <span> &nbsp;&nbsp;&nbsp; บาท </span> </div>
      <div class='col-xl-6 font-five'>ออเดอร์ที่สำเร็จ</div>
      <div class='col-xl-6 mb-2'>" . number_format($count_orderday) . " <span> &nbsp;&nbsp;&nbsp;ออเดอร์ </span></div>";
      echo $text;
    }



    if (isset($_GET['read_detail_All'])) {
      $date_now = date("Y-m-d");
      $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : false;
      $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : $date_now;

      $totalAll_income = 0;
      $count_orderAll = 0;
      $sql = $from_date && $to_date ? "SELECT * FROM table_order WHERE status = 3 AND date_report BETWEEN '$from_date' AND '$to_date'" : "SELECT * FROM table_order WHERE status = 3 ";
      $result_all_success =  $obj->query($sql);

      while ($row = $result_all_success->fetch(PDO::FETCH_ASSOC)) {
        $count_orderAll = $result_all_success->rowCount();
        $totalAll_income += $row['priceAll'];
      }

      $period = $from_date && $to_date  ?   date("d-m-Y", strtotime($from_date)) . " - " . date("d-m-Y", strtotime($to_date)) : "ทั้งหมด";
      $text = "";
      $text .= "<div class='col-xl-12 mb-2 fw-bold'><i class='ion ion-pie-graph pr-1 '></i> ยอดขายโดยรวม</div>
      <div class='col-xl-6 font-five'>รายได้ทั้งหมด</div>
      <div class='col-xl-6 mb-2 '>" . number_format($totalAll_income, 2) . " <span> &nbsp;&nbsp;&nbsp;บาท</span></div>
      <div class='col-xl-6 font-five'>ออเดอร์ที่สำเร็จ</div>
      <div class='col-xl-6 mb-2'>" . number_format($count_orderAll) . " <span> &nbsp;&nbsp;&nbsp;ออเดอร์</span></div>
      <div class='col-xl-6 font-five'>ช่วงเวลา</div>
      <div class='col-xl-6 mb-2'>" . $period . "</div>";
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


    if (isset($_POST['read_detail_all'])) {
      $date_now = date("Y-m-d");
      $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : false;
      $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : $date_now;

      $totalAll_income = 0;
      $count_orderAll = 0;
      $sql = $from_date && $to_date ? "SELECT * FROM table_order WHERE status = 3 AND date_report BETWEEN '$from_date' AND '$to_date'" : "SELECT * FROM table_order WHERE status = 3 ";
      $result_all_success =  $obj->query($sql);

      while ($row = $result_all_success->fetch(PDO::FETCH_ASSOC)) {
        $count_orderAll = $result_all_success->rowCount();
        $totalAll_income += $row['priceAll'];
      }

      $period = $from_date && $to_date  ?   date("d-m-Y", strtotime($from_date)) . " - " . date("d-m-Y", strtotime($to_date)) : "ทั้งหมด";
      $text = "";
      $text .= "<div class='col-xl-12 mb-2 fw-bold'><i class='ion ion-pie-graph pr-1 '></i> ยอดขายโดยรวม</div>
      <div class='col-xl-6 font-five'>รายได้ทั้งหมด</div>
      <div class='col-xl-6 mb-2 '>" . number_format($totalAll_income, 2) . " <span> &nbsp;&nbsp;&nbsp;บาท</span></div>
      <div class='col-xl-6 font-five'>ออเดอร์ที่สำเร็จ</div>
      <div class='col-xl-6 mb-2'>" . number_format($count_orderAll) . " <span> &nbsp;&nbsp;&nbsp;ออเดอร์</span></div>
      <div class='col-xl-6 font-five'>ช่วงเวลา</div>
      <div class='col-xl-6 mb-2'>" . $period . "</div>";
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
