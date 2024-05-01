<?php include("app/include/meta.php")?>
    <title>Registration</title>
  </head>
  <body>
<?php include("app/include/header.php")?>
<!-- MAIN_BODY -->
<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="reg.php">
    <h2>Registration</h2>
    <div class="mb-3 col-12 col-md-4">
      <label for="formGroupExampleInput2" class="form-label">Login</label>
      <input type="text" class="form-control" id="formGroupExampleInput2">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputPassword2" class="form-label">Submit password</label>
      <input type="password" class="form-control" id="exampleInputPassword2">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <button type="button" class="btn btn-success">Submit</button>
      <a href="authoriz.php">Or Sign in</a>
    </div>
  </form>
</div>
<?php include("app/include/footer.php")?>
  </body>
</html>