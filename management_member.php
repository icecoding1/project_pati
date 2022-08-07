<?php $name_web = "ระบบจัดการร้านอาหาร";
$code = $_GET['c'];
// $link = 'orders_new.php?c=' . $code;
$id   = isset($_GET['id']) ? $_GET['id'] : 0;
// $receive = $_POST['id_send'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $name_web;  ?></title>

  <?php include 'add_framwork/css.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center bg-dark">
      <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
    </div>
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">จัดการสมาชิก</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                <li class="breadcrumb-item active">จัดการสมาชิก</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">

          <div class="d-flex justify-content-end my-3">
            <a href="view/member/add_member.php" class="btn btn-primary mx-1 ">+ เพิ่มสมาชิก</a>
          </div>

          <div class="card my-3 mx-2">
            <div class="card-header">
              <h3 class="card-title">ตารางสมาชิก</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped projects table table-hover table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i  = 0; $i < 10; $i++) {
                    $id += 1;
                  ?>
                    <tr>
                      <td>
                        <?= $id ?>
                      </td>
                      <td>
                        <img src="dist/img/user2-160x160.jpg" class="img-circle profile_member " alt="profile_member">
                      </td>
                      <td>
                        <?= "ปฏิพล วงศ์ศรี"; ?>
                      </td>
                      <td>
                        <?= "patiphon"; ?>
                      </td>
                      <td>
                        <?= "123456789"; ?>
                      </td>
                      <td>
                        <span class="badge badge-success">admin</span>
                      </td>
                      <td class="project-actions text-right">
                        <!-- <a class="btn btn-primary btn-sm mx-1" href="#">
                          <i class="fas fa-folder">
                          </i>
                          View
                        </a> -->
                        <button class="btn btn-info btn-sm mx-1" type="button" data-bs-toggle="modal" data-bs-target="#edit_member" id="<?= $id; ?>">
                          <i class="fas fa-pencil-alt">
                          </i>
                          Edit
                        </button>
                        <button class="btn btn-danger btn-sm mx-1 deletemember" type="button" data-bs-toggle="modal" data-bs-target="#delete_member" id="<?= $id; ?>">
                          <i class="fas fa-trash">
                          </i>
                          Delete
                        </button>
                      </td>

                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>

        </div>
      </section>
    </div>

    <?php include('layout/footer.php') ?>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

  </div>
  <!-- Modal delete -->
  <div class="modal fade" id="delete_member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ลบสมาชิก</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณต้องการลบสมาชิก <b><?= "ปฏิพล วงศ์ศรี" . "\r:\r" . $id; ?></b> ออกใช่หรือไม่
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <a href="management_member?id=<?= $id ?>"><button type="submit" class="btn btn-danger" id="emp_id">ลบสมาชิก</button></a>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal edit -->
  <div class="modal fade" id="edit_member" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="" method="">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูลสมาชิก : <?= $id ?> </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex justify-content-center align-items-center mb-3">
              <img src="dist/img/user2-160x160.jpg" class=" profile_member_edit " alt="profile_member">
            </div>
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Name</span>
              <input type="text" class="form-control" id="" name="" value="ค่าเดิม">
            </div>
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Username</span>
              <input type="text" class="form-control" id="" name="" value="ค่าเดิม">
            </div>
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Password</span>
              <input type="text" class="form-control" id="" name="" value="ค่าเดิม">
            </div>
            <p class="fw-bold  mb-1">รูปภาพของคุณ <span class="text-danger">เฉพาะ png, jpg/jpeg</span></p>
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="inputGroupFile01" alt="Image" accept="image/jpeg, image/png" value="">
            </div>
            <select class="form-select mb-3">
              <option disabled>สถานะ</option>
              <option value="1" selected="selected">admin</option>
              <option value="2">cashier</option>
              <option value="3">member</option>
            </select>

          </div>
          <div class="modal-footer d-flex justify-content-between">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">ยกลิก</but>
              <button type="subbmit" class="btn btn-primary px-4">บันทึก</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php include 'add_framwork/js.php' ?>
  <!-- <script>
    $(document).ready(function() {

      $('.deletemember').click(function() {
        var id_send = $(this).attr('id');
        $.ajax({
          url: "delete.php",
          method: "post",
          data: {
            receive: id_send
          },
          success: function(data) {
            // location.reload();
            // $('#deletemember').show();
          }
        });
      });

    });
  </script> -->

</body>

</html>