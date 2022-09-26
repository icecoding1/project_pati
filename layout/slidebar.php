<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="home.php" class="brand-link">

    <?php if (strpos($_SESSION["logo_shop"], ".")) {
    ?>
      <img src="image_myweb/img_structure_management/<?= $_SESSION["logo_shop"] ?>" class="img-circle profile_slidebar" alt="User Image">
    <?php } else { ?>
      <img src="assets/img/logo_empty.jpg" alt="Logo" class="img-circle profile_slidebar">
    <?php } ?>

    <span class="brand-text font-weight-light mx-2"><?= $_SESSION["name_shop"] ?></span>
  </a>
  <!-- Sidebar user panel (optional)  user-panel-->
  <div class=" box-slide mt-3 pb-3 mb-3 px-3   d-flex  align-items-center">
    <div class="image">

      <?php if (strpos($_SESSION["session_image"], ".")) {
      ?>
        <img src="image_myweb/img_member/<?= $_SESSION["session_image"] ?>" class="img-circle profile_slidebar" alt="User Image">
      <?php } else { ?>
        <img src="dist/img/avatar5.png" class="img-circle profile_slidebar " alt="profile_member">
      <?php } ?>

    </div>
    <div class="info px-3">
      <a href="#" class="d-block text-white"><?= $_SESSION["session_name"] ?></a>
    </div>
  </div>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="" class="nav-link active">
            <i class="nav-icon far fa-circle"></i>
            <p>
              การจัดการร้าน
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php if ($_SESSION["session_status"] == "admin" || $_SESSION["session_status"] == "cashier") { ?>
              <li class="nav-item">
                <a href="report.php" class="nav-link" id="nav-link1">
                  <i class="bi bi-bar-chart-line nav-icon"></i>
                  <p>รายงานสรุปผล</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item show_count_list">
              <a href="management_order.php" class="nav-link " id="nav-link2">
                <i class="bi bi-bag-heart-fill nav-icon"></i>
                <p>จัดการออเดอร์</p>
              </a>
              <p class="count_list_new mb-0" id="count_list_new"></p>
            </li>
            <li class="nav-item">
              <a href="list_menu.php" class="nav-link" id="nav-link3">
                <i class="bi bi-receipt-cutoff nav-icon"></i>
                <p>จัดการรายการเมนู</p>
              </a>
            </li>
            <?php if ($_SESSION["session_status"] == "admin") { ?>
              <li class="nav-item">
                <a href="management_member.php" class="nav-link" id="nav-link4">
                  <i class="bi bi-person-lines-fill nav-icon"></i>
                  <p>จัดการสมาชิก</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="view/order_food/index.php" class="nav-link" id="nav-link5">
                <i class="bi bi-pencil-square"></i>
                <p>สั่งออเดอร์</p>
              </a>
            </li>
            <?php if ($_SESSION["session_status"] == "admin") { ?>
              <li class="nav-item" id="nav-item-end">
                <a href="setting.php" class="nav-link" id="nav-link6">
                  <i class="bi bi-gear-wide nav-icon"></i>
                  <p>ตั้งค่า</p>
                </a>
              </li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


<script>
  var count_order = document.getElementById("count_list_new");

  setInterval(fetchdata = async () => {
    const data = await fetch("fetch_count_order.php?show_count=1", {
      method: "GET"
    })
    const res = await data.text();
    count_order.innerHTML = res;
  }, 1000);
</script>