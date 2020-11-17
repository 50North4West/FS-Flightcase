<?php
  require APPROOT.'/views/inc/header.php';
  //flash messages
  flash('siteMessage');
?>
<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">New Password</h5>
      <h6 class="card-subtitle mb-2 text-muted">Please enter a new password below.</h6>
      <form action="<?php echo URLROOT; ?>/account/resetpassword/<?php echo $data['pageData']['email'].'/'.$data['pageData']['token']; ?>" method="POST" id="frmLogin">
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label class="w-100" for="password">Password <span class="text-danger">*</span></label>
              <input type="text" id="password" name="password" class="form-control <?php echo (!empty($data['pageData']['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['password']; ?>" required />
              <span class="invalid-feedback"><?php echo (empty($data['pageData']['password_error'])) ? '' : $data['pageData']['password_error']; ?></span>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label class="w-100" for="repeatPassword">Repeat Password <span class="text-danger">*</span></label>
              <input type="text" id="repeatPassword" name="repeatPassword" class="form-control <?php echo (!empty($data['pageData']['repeatPassword_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['repeatPassword']; ?>" required />
              <span class="invalid-feedback"><?php echo (empty($data['pageData']['repeatPassword_error'])) ? '' : $data['pageData']['repeatPassword_error']; ?></span>
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
            password: {
              required: true,
              minlength: 2,
              maxlength: 150
            },
            repeatPassword: {
              required: true,
              minlength: 6,
              maxlength: 50,
              equalTo: "#password"
            }
          }
        });
      </script>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
