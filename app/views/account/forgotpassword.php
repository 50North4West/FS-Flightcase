<?php
  require APPROOT.'/views/inc/header.php';
  //flash messages
  flash('siteMessage');
?>
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Forgotten Password</h5>
      <h6 class="card-subtitle mb-2 text-muted">To reset your password fill in the form below to recieve a password reset email to your registered email address.</h6>
      <form action="<?php echo URLROOT; ?>/account/forgotpassword" method="POST" id="frmLogin">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="username">Username / Email address <span class="text-danger">*</span></label>
              <input type="email" id="username" name="username" class="form-control <?php echo (!empty($data['pageData']['username_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['username']; ?>" required/>
              <span class="invalid-feedback"><?php echo $data['pageData']['username_error']; ?></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-primary float-right mt-3 "><i class="fas fa-key"></i> Reset Password</button>
          </div>
        </div>
      </form>
      <script type="text/javascript">
        $("#frmLogin").validate({
          rules: {
            username: {
              required: true,
              minlength: 2,
              maxlength: 150,
              email: true
            }
          }
        });
      </script>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
