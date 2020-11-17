<?php
require APPROOT.'/views/template/header.php';
require APPROOT.'/views/template/navbar.php';
require APPROOT.'/views/template/heading.php';
  //flash messages
  flash('siteMessage');
?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1>Registration was successful</h1>
      <p>
        Please check your email to confirm your account.
      </p>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/template/footer.php'; ?>
