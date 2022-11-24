<?php
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  $name_web = "สั่งออเดอร์";
  $table =   $_SESSION["session_table"] = isset($_SESSION["session_table"]) ? $_SESSION["session_table"] :  "คุณไม่ได้เลือกโต๊ะ";
  $food = "ขนมปัง กาเเฟ";
  $array = "";
  $countdata = 0;
  $count_order = isset($_SESSION["count_order"]) ? $_SESSION["count_order"] : 0;
  $_SESSION['total'] = isset($_SESSION["total"]) ? $_SESSION["total"] : 0;
  $_SESSION['check_update'] = true;
  if (isset($_SESSION['data'])) {
    $array = $_SESSION['data'];
    $array2 = $_SESSION['data'];
    usort($array, function ($a, $b) {
      return $a['id'] - $b['id'];
    });
    $input = array_map("unserialize", array_unique(array_map("serialize", $array)));
    usort($input, function ($a, $b) {
      return $a['id'] - $b['id'];
    });
    $data = $input;
    $countdata = count($data);
    $order = 1;
    $total = 0;
    $count_products = 0;
    $count_delete = 0;

    $count  = count($array) > 0  ?  count($array) : 0;
    $_SESSION["count_order"] = $count;
    $count_order = isset($_SESSION["count_order"]) ? $_SESSION["count_order"] : 0;


    if (count($array) > 0) {
      for ($x = 0; $x < count($array); $x++) {
        $total += $array[$x]['price_food'];
        $_SESSION['total'] = $total;
      }
    } else {
      $total  = 0;
      $_SESSION['total'] = $total;
    }
  }

  // usort($_SESSION['data'], function ($a, $b) {
  //   return $a['id'] - $b['id'];
  // });
  // echo "<pre>";
  // print_r($_SESSION['data']);
  // echo "</pre>";
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name_web;  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/management.css">
    <link rel="icon" href="../../favicon/logo_favicon.png">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
  </head>

  <body class="body-order">


    <header class="header-nav-order">
      <div class="d-flex align-items-center">
        <img src="../../dist/img/food_pachaew_logo.png" alt="profile" class="mx-2 header-profile-order">
        <p class="mb-0 mx-2 text-white">สั่งออเดอร์</p>
      </div>
      <div>
        <a href="../../home.php" class="btn btn-light px-4 m-2 ">กลับหน้าหลัก</a>
        <a href="order_receive.php" class="btn btn-light px-4 m-2">กลับ</a>
      </div>
    </header>

    <div class="header-content my-3 mx-3">
      <p class="mb-0 fw-bold fs-3 ">รายการที่สั่ง</p>
      <p class="mb-0 fw-semibold fs-5 m-2">โต๊ะ : <?= $table ?></p>
      <p class="mb-0 fw-semibold fs-5 m-2">ราคารวม : <?= number_format($_SESSION['total'], 2) . "฿"; ?> </p>
      <p class="mb-0 fw-semibold fs-5 m-2">รายการทั้งหมด : <?= $count_order . " รายการ"; ?></p>
    </div>

    <?php if ($countdata > 5) { ?>
      <div class="list-menu-order mb-3">
        <?php for ($i  = 0; $i < count($data); $i++) {
          $id_for1 = $data[$i]['id'];
          for ($k  = 0; $k < count($array2); $k++) {
            $id_for2 = $array2[$k]['id'];
            if ($id_for1 ==  $id_for2) {
              $count_products  += $array2[$k]['count'];
              $data[$i]['count'] =  $count_products;
            }
          }
          $data[$i]['priceAll'] =  $data[$i]['price_food'] * $count_products;
          $count_delete += $data[$i]['count'];
        ?>
          <div class="content-menu">
            <div>
              <?php if (strpos($data[$i]['image'], ".")) { ?>
                <img src="../..//image_myweb/img_product/<?= $data[$i]['image'] ?>" alt="food_lists" class="img_menu">
              <?php } else { ?>
                <img src="../../assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
              <?php } ?>
            </div>
            <div class="content-menu-bottom">
              <div>
                <p class="mb-0 fw-semibold"><?= $data[$i]['name'] ?></p>
                <p class="mb-0">ราคา : <span><?= number_format($data[$i]['price_food'], 2) ?> ฿</span></p>
                <p class="mb-0">ราคารวม : <span><?= number_format($data[$i]['priceAll'], 2) ?> ฿</span></p>
              </div>
              <div>
                <button class="btn btn-primary p-1 px-3 mt-1 add_order" id="<?= $data[$i]['id'] ?>">+ เพิ่ม</button>
                <button class="btn btn-danger p-1 px-3 mt-1 delete_order" id="<?= $count_delete - 1  ?>">ลบ</button>
              </div>
            </div>
            <p class="count mb-0 font-five">จำนวน : <span><?= $data[$i]['count'] ?></span></p>
          </div>
        <?php
          $count_products = 0;
        } ?>
        <?php
        $_SESSION['send_order'] = $data;
        ?>
      </div>
    <?php } else if ($countdata <= 5 && $countdata > 0) { ?>
      <div class="list-menu-order-set mb-3">
        <?php for ($i  = 0; $i < count($data); $i++) {
          $id_for1 = $data[$i]['id'];
          for ($k  = 0; $k < count($array2); $k++) {
            $id_for2 = $array2[$k]['id'];
            if ($id_for1 ==  $id_for2) {
              $count_products  += $array2[$k]['count'];
              $data[$i]['count'] =  $count_products;
            }
          }
          $data[$i]['priceAll'] =  $data[$i]['price_food'] * $count_products;
          $priceall = $data[$i]['priceAll'];
          $count_delete += $data[$i]['count'];
        ?>
          <div class="content-menu">
            <div>
              <?php if (strpos($data[$i]['image'], ".")) { ?>
                <img src="../..//image_myweb/img_product/<?= $data[$i]['image'] ?>" alt="food_lists" class="img_menu">
              <?php } else { ?>
                <img src="../../assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
              <?php } ?>
            </div>
            <div class="content-menu-bottom">
              <div>
                <p class="mb-0 fw-semibold"><?= $data[$i]['name'] ?></p>
                <p class="mb-0">ราคา : <span><?= number_format($data[$i]['price_food'], 2) ?> ฿</span></p>
                <p class="mb-0">ราคารวม : <span><?= number_format($data[$i]['priceAll'], 2) ?> ฿</span></p>
              </div>
              <div>
                <button class="btn btn-primary p-1 px-3 mt-1 add_order" id="<?= $data[$i]['id'] ?>">+ เพิ่ม</button>
                <button class="btn btn-danger p-1 px-3 mt-1 delete_order" id="<?= $count_delete - 1  ?>">ลบ</button>
              </div>
            </div>
            <p class="count mb-0 font-five">จำนวน : <span><?= $data[$i]['count'] ?></span></p>
          </div>
        <?php
          $count_products = 0;
        } ?>
        <?php
        $_SESSION['send_order'] = $data;
        ?>
      </div>
    <?php } else if ($countdata <= 0) { ?>
      <div class="d-flex justify-content-center align-items-center mt-4">
        <p class="fw-bold fs-4 set-hide" id="1">คุณไม่มีรายการที่เลือก❗❗❗</p>
      </div>
    <?php } ?>

    <form action="insert_order.php" method="post" class="note">
      <div class="send-to-manage">
        <div class="input-group m-2 ">
          <span class="input-group-text">โน๊ต</span>
          <textarea class="form-control " aria-label="With textarea" id="note" name="note"></textarea>
        </div>
        <button class="btn btn-primary px-4 m-2  mt-2  mr-4" id="btn-confirm" type="submit" <?= $table == "คุณไม่ได้เลือกโต๊ะ" ? 'disabled' : '' ?>>
          ยืนยันคำสั่ง
        </button>
      </div>
    </form>

    <script src="../../add_framwork/jquery.js"></script>
    <script>
      $("document").ready(() => {
        $(".delete_order").click(function(e) {
          e.preventDefault();
          var mid = $(this).attr("id");
          console.log(mid);

          $.ajax({
            url: "set_cart.php",
            method: "post",
            data: {
              id: mid
            },
            success: function(response) {
              console.log(response);
              location.reload();
            }
          });
        });

        $(".add_order").click(function(e) {
          e.preventDefault();
          var mid = $(this).attr("id");

          $.ajax({
            url: "set_session_order.php",
            method: "post",
            data: {
              id: mid
            },
            success: function(response) {
              location.reload();
              console.log(response);
            }
          });
        });

        var check_out = $(".set-hide").attr("id");
        if (check_out == 1) {
          $(".send-to-manage").hide();
          $("#btn-confirm").attr("disabled", true);
        }

      })
    </script>

  </body>

  </html>

<?php } else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('../../login.php');
}else {
location.assign('../../login.php');
}
</script>";
} ?>