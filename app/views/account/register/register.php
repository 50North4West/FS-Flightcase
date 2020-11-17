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
        <h5 class="card-title">User Registration</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please complete all the required fields marked by a <span class="text-danger">*</span></h6>
        <form action="<?php echo URLROOT; ?>/account/register" method="post" enctype="multipart/form-data" id="frmRegister">
          <div class="row mt-4">
            <div class="col-6">
              <div class="form-group">
                <label class="w-100" for="firstName">First Name <span class="text-danger">*</span></label>
                <input type="text" id="firstName" name="firstName" class="form-control <?php echo (!empty($data['pageData']['firstName_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['firstName']; ?>" required />
                <span class="invalid-feedback"><?php echo (empty($data['pageData']['firstName_error'])) ? '' : $data['pageData']['firstName_error']; ?></span>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label class="w-100" for="lastName">Last Name <span class="text-danger">*</span></label>
                <input type="text" id="lastName" name="lastName" class="form-control <?php echo (!empty($data['pageData']['lastName_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['lastName']; ?>" required />
                <span class="invalid-feedback"><?php echo (empty($data['pageData']['lastName_error'])) ? '' : $data['pageData']['lastName_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label class="w-100" for="email">Email address <span class="text-danger">*</span></label>
                <input type="text" id="email" name="email" class="form-control <?php echo (!empty($data['pageData']['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['email']; ?>" required />
                <span class="invalid-feedback"><?php echo (empty($data['pageData']['email_error'])) ? '' : $data['pageData']['email_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="w-100" for="password">Password <span class="text-danger">*</span></label>
                <input type="text" id="password" name="password" class="form-control <?php echo (!empty($data['pageData']['password_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['pageData']['password']; ?>" required />
                <span class="invalid-feedback"><?php echo (empty($data['pageData']['password_error'])) ? '' : $data['pageData']['password_error']; ?></span>
              </div>
            </div>
          </div>
        <div class="row">
          <div class="col">
            <button type="submit" class="btn btn-fcBlue float-right mt-3">Register</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
<?php require APPROOT.'/views/template/footer.php'; ?>
