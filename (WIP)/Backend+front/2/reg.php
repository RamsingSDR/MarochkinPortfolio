<?php include "app/controllers/users.php";
?>
<?php include "app/include/meta.php";
?>
    <title>Registration</title>
  </head>
  <body>
<?php include("app/include/header.php")?>
<!-- MAIN_BODY -->
<div class="container reg_form">
  <form class="row justify-content-center" method="post" action="reg.php">
    <h2>Registration</h2>
    <div class="mb-3 col-12 col-md-4 err">
      <p><?=$errMsg?></p>  
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="formGroupExampleInput2" class="form-label">Login</label>
      <input type="text" name="input_login" class="form-control" id="formGroupExampleInput2" value="<?=$login?>">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="input_email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$email?>" placeholder="mail_name@mail.com">
      <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="input_pass" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputPassword2" class="form-label">Confirm password</label>
      <input type="password" name="input_confirm_pass" class="form-control" id="exampleInputPassword2">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <button type="submit" name="btn_reg" class="btn btn-success">Submit</button>
      <a href="aut.php">Or Sign in</a>
    </div>
  </form>
</div>
<?php include("app/include/footer.php")?>