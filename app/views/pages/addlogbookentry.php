<?php
  require APPROOT.'/views/template/header.php';
  require APPROOT.'/views/template/navbar.php';
  //flash messages
  flash('siteMessage');
?>
<section class="bg-white shadow">
  <div class="container-fluid">
    <div class="row header-row">
      <div class="col-md-6 my-auto">
        <h1 class="display-4 mb-0 ml-3"><?php echo $data['pageHeader']['pageTitle']; ?></h1>
      </div>
    </div>
  </div>
</section>
<i class="fas fa-caret-down fa-5x text-white caret"></i>
<section>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <p>

        </p>
        <form action="<?php echo URLROOT; ?>/logbook/add" method="post">
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control <?php echo (!empty($data['form']['date_error'])) ? 'is-invalid' : ''; ?>" id="date" name="date" value="<?php echo $data['form']['date']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['date_error'])) ? '' : $data['form']['date_error']; ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="acType">A/C Type</label>
                <input type="text" class="form-control <?php echo (!empty($data['form']['acType_error'])) ? 'is-invalid' : ''; ?>" id="acType" name="acType" value="<?php echo $data['form']['acType']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['acType_error'])) ? '' : $data['form']['acType_error']; ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="acReg">A/C Reg</label>
                <input type="text" class="form-control <?php echo (!empty($data['form']['acReg_error'])) ? 'is-invalid' : ''; ?>" id="acReg" name="acReg" value="<?php echo $data['form']['acReg']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['acReg_error'])) ? '' : $data['form']['acReg_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="fltFrom">From</label>
                <input type="fltFrom" class="form-control <?php echo (!empty($data['form']['fltFrom_error'])) ? 'is-invalid' : ''; ?>" id="fltFrom" name="fltFrom" value="<?php echo $data['form']['fltFrom']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['fltFrom_error'])) ? '' : $data['form']['fltFrom_error']; ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="fltTo">To</label>
                <input type="fltTo" class="form-control <?php echo (!empty($data['form']['fltTo_error'])) ? 'is-invalid' : ''; ?>" id="fltTo" name="fltTo" value="<?php echo $data['form']['fltTo']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['fltTo_error'])) ? '' : $data['form']['fltTo_error']; ?></span>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label for="fltNum">Flight Num</label>
                <input type="fltNum" class="form-control <?php echo (!empty($data['form']['fltNum_error'])) ? 'is-invalid' : ''; ?>" id="fltNum" name="fltNum" value="<?php echo $data['form']['fltNum']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['fltNum_error'])) ? '' : $data['form']['fltNum_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="form-group">
                <label for="engType">Engine Type</label>
                <select class="form-control <?php echo (!empty($data['form']['engType_error'])) ? 'is-invalid' : ''; ?>" id="engType" name="engType">
                  <option>Piston Single</option>
                  <option>Piston Multi</option>
                  <option>Turboprop Single</option>
                  <option>Turboprop Multi</option>
                  <option>Jet Single</option>
                  <option>Jet Multi</option>
                </select>
                <span class="invalid-feedback"><?php echo (empty($data['form']['engType_error'])) ? '' : $data['form']['engType_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-fcBlue">Add entry</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require APPROOT.'/views/template/footer.php'; ?>