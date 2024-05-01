<?php include("app/include/meta.php")?>
    <title>Sign in</title>
  </head>
  <body>
<?php include("app/include/header.php")?>
<!-- MAIN_BODY -->
<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="aut.php">
    <h2>Sign in</h2>
    <div class="mb-3 col-12 col-md-4">
      <label for="formGroupExampleInput2" class="form-label">Login</label>
      <input type="text" class="form-control" id="formGroupExampleInput2">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="w-100"></div>
    <div class="mb-3 col-12 col-md-4">
      <button type="button" class="btn btn-success">Submit</button>
      <span>
        <a href="reg.php">Or Registration</a>
      </span>
    </div>
  </form>
</div>
<?php include("app/include/footer.php")?>