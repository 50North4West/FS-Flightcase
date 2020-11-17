<?php
  require APPROOT.'/views/template/header.php';
  require APPROOT.'/views/template/navbar.php';
  require APPROOT.'/views/template/heading.php';
  //flash messages
  flash('siteMessage');
?>
<div class="container">
  <div class="card">
    <div class="card-body">
      <h6 class="card-subtitle mb-4 text-muted">An account is required to access the FS Flightcase app. If you do not have an account please register using the link below.</h6>
      <form action="<?php echo URLROOT; ?>/account/login" method="POST" id="frmLogin">
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="username">Email address <span class="text-danger">*</span></label>
              <input type="email" id="username" name="username" class="form-control <?php echo (!empty($data['pageData']['username_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['username']; ?>"/>
              <span class="invalid-feedback"><?php echo $data['pageData']['username_error']; ?></span>
            </div>
          </div>
          <script>
          $('#username')
            .keyboard({ layout: 'qwerty' })
            .addTyping();
          </script>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="password">Password <span class="text-danger">*</span></label>
              <input type="text" id="password" name="password" class="form-control <?php echo (!empty($data['pageData']['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['password']; ?>"/>
              <span class="invalid-feedback"><?php echo $data['pageData']['password_error']; ?></span>
            </div>
          </div>
          <script>
          $('#password')
            .keyboard({ layout: 'qwerty' })
            .addTyping();
          </script>
        </div>
        <div class="row">
          <div class="col">
            <a href="<?php echo URLROOT.'/account/forgotpassword'; ?>" class="btn btn-secondary mt-3">Forgotten Password</a>
            <a href="<?php echo URLROOT.'/account/register'; ?>" class="btn btn-secondary mt-3">Register</a>
            <button type="submit" class="btn btn-fcBlue float-right mt-3 ">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/template/footer.php'; ?>
