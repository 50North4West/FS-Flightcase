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
        <div class="row">
          <div class="col-6">
            <dl class="row mb-0 pb-0">
              <dt class="col-sm-4 text-sm">Aircraft Type:</dt>
              <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_acType; ?> // <?php echo $data['activeFlight']->logbook_engType; ?></dd>
              <dt class="col-sm-4 text-sm">From:</dt>
              <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_from; ?> </dd>
              <dt class="col-sm-4 text-sm">To:</dt>
              <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_to; ?> </dd>
            </dl>
          </div>
          <div class="col-6">
            <dl class="row mb-0 pb-0">
              <dt class="col-sm-4 text-sm">Aircraft Reg:</dt>
              <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_acReg; ?> </dd>
              <dt class="col-sm-4 text-sm">Start:</dt>
              <dd class="col-sm-8 text-sm"><?php echo date(DATEFORMAT.' H:i', strtotime($data['activeFlight']->logbook_timeStart)); ?></dd>
              <dt class="col-sm-4 text-sm">Stop:</dt>
              <dd class="col-sm-8 text-sm"><?php echo date(DATEFORMAT.' H:i', strtotime($data['activeFlight']->logbook_timeStop)); ?></dd>
              <dt class="col-sm-4 text-sm">Total Hours</dt>
              <dd class="col-sm-4 text-sm"><?php echo number_format($data['flightHours'], 2); ?></dd>
            </dl>
          </div>
        </div>
        <hr />
        <p class="text-sm">
          Your completed flight hours can be allocated against day hours, night hours and IFR day or IFR Night
        </p>
        <form action="<?php echo URLROOT; ?>/logbook/completeFlight" method="post">
          <input type="hidden" id="recordId" name="recordId" value="<?php echo $data['activeFlight']->logbook_id; ?>">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="dayHrs">Day</label>
                <input type="number" step="0.01" class="form-control <?php echo (!empty($data['form']['dayHrs_error'])) ? 'is-invalid' : ''; ?>" id="dayHrs" name="dayHrs" value="<?php echo $data['form']['dayHrs']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['dayHrs_error'])) ? '' : $data['form']['dayHrs_error']; ?></span>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="nightHrs">Night</label>
                <input type="number" step="0.01" class="form-control <?php echo (!empty($data['form']['nightHrs_error'])) ? 'is-invalid' : ''; ?>" id="nightHrs" name="nightHrs" value="<?php echo $data['form']['nightHrs']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['nightHrs_error'])) ? '' : $data['form']['nightHrs_error']; ?></span>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="ifrDay">IFR Day</label>
                <input type="number" step="0.01" class="form-control <?php echo (!empty($data['form']['ifrDay_error'])) ? 'is-invalid' : ''; ?>" id="ifrDay" name="ifrDay" value="<?php echo $data['form']['ifrDay']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['ifrDay_error'])) ? '' : $data['form']['ifrDay_error']; ?></span>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="ifrNight">IFR Night</label>
                <input type="number" step="0.01" class="form-control <?php echo (!empty($data['form']['ifrNight_error'])) ? 'is-invalid' : ''; ?>" id="ifrNight" name="ifrNight" value="<?php echo $data['form']['ifrNight']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['ifrNight_error'])) ? '' : $data['form']['ifrNight_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label for="landingsDay">Landings Day</label>
                <input type="number" class="form-control <?php echo (!empty($data['form']['landingsDay_error'])) ? 'is-invalid' : ''; ?>" id="landingsDay" name="landingsDay" value="<?php echo $data['form']['landingsDay']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['landingsDay_error'])) ? '' : $data['form']['landingsDay_error']; ?></span>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label for="landingsNight">Landings Night</label>
                <input type="number" class="form-control <?php echo (!empty($data['form']['landingsNight_error'])) ? 'is-invalid' : ''; ?>" id="landingsNight" name="landingsNight" value="<?php echo $data['form']['landingsNight']; ?>">
                <span class="invalid-feedback"><?php echo (empty($data['form']['landingsNight_error'])) ? '' : $data['form']['landingsNight_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea class="form-control <?php echo (!empty($data['form']['remarks_error'])) ? 'is-invalid' : ''; ?>" id="remarks" name="remarks" rows="5"><?php echo $data['form']['remarks']; ?></textarea>
                <span class="invalid-feedback"><?php echo (empty($data['form']['remarks_error'])) ? '' : $data['form']['remarks_error']; ?></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-fcBlue">Complete Flight</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require APPROOT.'/views/template/footer.php'; ?>