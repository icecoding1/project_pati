<!DOCTYPE html>
<html lang="en" class="html">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <?php include 'add_framwork/css.php' ?>
</head>

<body>

  <div class="bg-login d-flex justify-content-center align-items-center">

    <div class="login-box">

      <div class="login-logo">
        <a href="index.php" class="d-flex justify-content-center align-items-center flex-wrap">
          <img src="dist/img/food_pachaew_logo.png" alt="logo" class="logo-login">
          <b class="text-white px-1 text-pachaew">ร้านป้าเเจ๋ว</b>
        </a>
      </div>

      <div class="card padding-card-login ">
        <div class="card-body   ">
          <p class="login-box-msg">Sign in to management</p>

          <form action="index1.php" method="get">
            <div class="input-group mb-3">
              <input type="username" class="form-control" placeholder="Username" name="txt_username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="bi bi-person-circle"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="txt_password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    จดจำ
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>



    <?php include 'add_framwork/js.php' ?>
</body>

</html>