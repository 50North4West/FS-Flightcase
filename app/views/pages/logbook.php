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
      <div class="col-md-6 my-auto">
        <a href="<?php echo URLROOT; ?>/logbook/add" class="btn btn-fcBlue float-right">Add a new flight</a>
      </div>
    </div>
  </div>
</section>
<i class="fas fa-caret-down fa-5x text-white caret"></i>
<section>
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title border-bottom border-fcOrange text-fcOrange text-uppercase">Active Flight</h4>

        <div class="row">
          <?php if (!isset($data['activeFlight']->logbook_id)) : ?>
            <div class="col my-auto">
              <p class="text-sm">
                There are no active flights.
              </p>
            </div>
          <?php else : ?>
            <div class="col-12">
              <p class="text-sm">
                Your current active flight is shown below. To record your flight hours start the flight on engine start, and stop the flight on engine shutdown.
              </p>
            </div>
            <div class="col-6">
              <dl class="row">
                <dt class="col-sm-4 text-sm">Date:</dt>
                <dd class="col-sm-8 text-sm"><?php echo date(DATEFORMAT, strtotime($data['activeFlight']->logbook_date)); ?></dd>
                <dt class="col-sm-4 text-sm">Aircraft Type:</dt>
                <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_acType; ?> // <?php echo $data['activeFlight']->logbook_engType; ?></dd>
                <dt class="col-sm-4 text-sm">Aircraft Reg:</dt>
                <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_acReg; ?> </dd>
                <dt class="col-sm-4 text-sm">From:</dt>
                <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_from; ?> </dd>
                <dt class="col-sm-4 text-sm">To:</dt>
                <dd class="col-sm-8 text-sm"><?php echo $data['activeFlight']->logbook_to; ?> </dd>
              </dl>
            </div>
            <div class="col my-auto text-center">
              <?php echo (!$data['activeFlight']->logbook_timeStart) ?
                '<a href="logbook/startTimer/'.$data['activeFlight']->logbook_id.'" class="btn btn-sm btn-danger">Start Timer</a>' :
                '<i class="fal fa-spinner fa-lg fa-pulse"></i><br />Timer Running<br /><a href="logbook/stopTimer/'.$data['activeFlight']->logbook_id.'" class="btn btn-sm btn-success mt-3">Complete Flight & Stop Timer</a>'; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-body">
        <h6 class="card-title border-bottom border-secondary text-secondary text-uppercase">Completed Flights</h4>
        <p class="text-sm">
          All of your completed flights are shown below. If you want to print or export your logbook this can be completed on a web browser when no longer flying.
          The full logbook can be viewed on the Simulated.Flights website.
        </p>
        <table id="logbook" class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>
                Date
              </th>
              <th>
                Aircraft
              </th>
              <th>
                From
              </th>
              <th>
                To
              </th>
              <th>
                Day Hrs
              </th>
              <th>
                Night Hrs
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['logbookEntries'] as $flight) : ?>
              <tr>
                <td>
                  <?php echo date(DATEFORMAT, strtotime($flight->logbook_date)); ?>
                </td>
                <td>
                  <?php echo $flight->logbook_acType.' '.$flight->logbook_acReg; ?>
                </td>
                <td>
                  <?php echo $flight->logbook_from; ?>
                </td>
                <td>
                  <?php echo $flight->logbook_to; ?>
                </td>
                <td>
                  <?php echo $flight->logbook_dayHrs; ?>
                </td>
                <td>
                  <?php echo $flight->logbook_nightHrs; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php require APPROOT.'/views/template/footer.php'; ?>