<?php
$name_web = "ระบบจัดการร้านอาหาร";
require_once("connection/config.php");
ob_start();
session_start();
include("check_session.php");
$page_nav = 6;
?>

  $sql = "SELECT * FROM  table_article ";
  $select =  $obj->prepare($sql);
  $select->execute();
  $rows = $select->fetchAll();
  $id_member = 1;
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

    <!-- page to web -->
    <input type="number" id="nav_page" value="<?= $page_nav  ?>" class="d-none">

    <div class="wrapper">
      <!-- Preloader -->
      <?php include('layout/header.php') ?>
      <?php include('layout/slidebar.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper set-content">

        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"> <i class="bi bi-pen-fill"></i> จัดการบทความ</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active">จัดการบทความ </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content p-2">
          <div class="container-fluid ">

            <div class="d-flex justify-content-end my-3">
              <a href="add_article.php" class="btn btn-primary mx-1 ">+ เพิ่มบทความ</a>
            </div>

            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">บทความทั้งหมด</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body table-responsive p-0 ">
                <table class="table table-striped projects table table-hover table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ลำดับ</th>
                      <th>หัวข้อ</th>
                      <th>ประเภท</th>
                      <th>เเก้ไขล่าสุด</th>
                      <th>ผู้เเก้ไข</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($rows)) { ?>
                      <tr></tr>
                      <td colspan="6" class="text-center"> ไม่พบข้มูล</td>
                      </tr>
                    <?php } else foreach ($rows as $row) {
                    ?>
                      <tr>
                        <td>
                          <?= $id_member++ ?>
                        </td>
                        <td>
                          <?= $row['header'] ?>
                        </td>
                        <td>
                          <?= $row['type']; ?>
                        </td>
                        <td>
                          <?= $row['date_created']; ?>
                        </td>
                        <td>
                          <span class="badge badge-success"><?= $row['name_edit']; ?></span>
                        </td>
                        <td class="project-actions text-right">
                          <a class="btn btn-info btn-sm mx-1 " type="button" href="detail_article.php?id=<?= $row['id'] ?>">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                          </a>
                          <button class="btn btn-danger btn-sm mx-1 deletebtn_article" type="button" id="<?= $row['id'] ?>">
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
    </div>


    <div class="modal fade" id="deleteModal">
      <form id="form_delete" method="post">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">ลบบทความ</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailDelete">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </form>
    </div>

    <?php include 'add_framwork/js.php' ?>
    <script>
      var tbody = document.querySelector("tbody");
      var detailDelete = document.getElementById("detailDelete");
      var modal_deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));
      var form_delete = document.getElementById("form_delete");

      tbody.addEventListener("click", (e) => {
        if (e.target.matches('button.deletebtn_article')) {
          e.preventDefault();
          let id = e.target.getAttribute("id");
          delaete_article(id);
        }
      })


      const delaete_article = async (id) => {
        const data = await fetch(`view/article/add_article.php?fetch_delete=${id}`, {
          method: "GET"
        })
        const res = await data.text();
        detailDelete.innerHTML = res;
        modal_deleteModal.show();

      }

      form_delete.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form_delete);
        formData.append("submit_delete", 1);

        if (form_delete.checkValidity() === false) {
          e.preventDefault();
          e.stopPropagation();
          return false;
        } else {
          const data = await fetch("view/article/add_article.php", {
            method: "POST",
            body: formData
          })
          const response = await data.text();
          // console.log(response);
          if (response == "success") {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'ลบบทความสำเร็จ',
              showConfirmButton: false,
            })
            setTimeout(() => {
              location.reload();
            }, 1500);
          } else {
            Swal.fire({
              position: 'top-end',
              icon: 'error',
              title: response,
              showConfirmButton: false,
            })
          }
        }
      })
    </script>
  </body>

  </html>