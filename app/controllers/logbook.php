<?php

  class Logbook extends Controller {
    public function __construct() {
      $this->logbookModel = $this->model('logbookModel');
    }

    //The home page for the site
    public function index() {
      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Logbook',
        'pageDescription' => '',
      ];
      //get the posts or other content and add it here
      $logbookEntries = $this->logbookModel->getAllEntries($_SESSION['userId']);
      $activeFlight = $this->logbookModel->getActiveFlight($_SESSION['userId']);
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'logbookEntries' => $logbookEntries, 'activeFlight' => $activeFlight];
      //load the view
      $this->view('pages/logbook', $data);
    }

    public function add() {
      //process the login form
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Santise POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //instatiate the form validation class
        $validate = new Validate($_POST, $_FILES);
        //send the fields to be validated
        $validate->name('date')->required()->date('Y-m-d');
        $validate->name('acType')->required()->maxSize(50)->regex('/^[a-zA-Z0-9]+$/');
        $validate->name('acReg')->required()->maxSize(10)->regex('/^[a-zA-Z0-9\-]+$/');
        $validate->name('fltFrom')->required()->maxSize(50)->regex('/^[a-zA-Z0-9\s]+$/');
        $validate->name('fltTo')->required()->maxSize(50)->regex('/^[a-zA-Z0-9\s]+$/');
        $validate->name('fltNum')->maxSize(20)->regex('/^[a-zA-Z0-9\-]+$/');
        $validate->name('engType')->required()->oneOf('Piston Single:Piston Multi:Turboprop Single:Turboprop Multi:Jet Single:Jet Multi');
        $validate->name('remarks')->regex('/^[a-zA-Z0-9\s\,\.\-]+$/');
        //Check the validation state
        if($validate->isGroupValid() == false) {
          //Validation Failed
          //Prepare the form fields to send back to the page
          $formData = [
            'date' => $validate->getValue('date'),
            'acType' => $validate->getValue('acType'),
            'acReg' => $validate->getValue('acReg'),
            'fltFrom' => $validate->getValue('fltFrom'),
            'fltTo' => $validate->getValue('fltTo'),
            'fltNum' => $validate->getValue('fltNum'),
            'engType' => $validate->getValue('engType'),
            'remarks' => $validate->getValue('remarks'),
            'date_error' => $validate->getValue('date'),
            'acType_error' => $validate->getValue('acType'),
            'acReg_error' => $validate->getValue('acReg'),
            'fltFrom_error' => $validate->getValue('fltFrom'),
            'fltTo_error' => $validate->getValue('fltTo'),
            'fltNum_error' => $validate->getValue('fltNum'),
            'engType_error' => $validate->getValue('engType'),
            'remarks_error' => $validate->getValue('remarks')
          ];
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Add a logbook entry',
            'pageDescription' => '',
          ];
          //build the data array and pass it to the view
          $data = ['pageHeader' => $pageHead, 'form' => $formData];
          //load the view
          $this->view('pages/addlogbookentry', $data);
        } else {
          $formData = [
            'date' => $validate->getValue('date'),
            'acType' => $validate->getValue('acType'),
            'acReg' => $validate->getValue('acReg'),
            'fltFrom' => $validate->getValue('fltFrom'),
            'fltTo' => $validate->getValue('fltTo'),
            'fltNum' => $validate->getValue('fltNum'),
            'engType' => $validate->getValue('engType'),
            'remarks' => $validate->getValue('remarks')
          ];
          $formSubmission = $this->logbookModel->createLogEntry($formData);
          if ($formSubmission) {
            flash('siteMessage', 'Active Flight Added');
            redirect('logbook');
          }
        }
      }
      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Add a logbook entry',
        'pageDescription' => '',
      ];
      $formData = [
        'date' => '',
        'acType' => '',
        'acReg' => '',
        'fltFrom' => '',
        'fltTo' => '',
        'fltNum' => '',
        'engType' => '',
        'remarks' => ''
      ];
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'form' => $formData];
      //load the view
      $this->view('pages/addlogbookentry', $data);
    }

    public function startTimer($flight = '') {
      if ($flight == '') {
        flash('siteMessage', 'No ID', 'bg-danger');
        redirect('logbook');
      } else {
        $startTimer = $this->logbookModel->startTimer($flight);
        if ($startTimer) {
          flash('siteMessage', 'Flight Timer Started');
          redirect('logbook');
        } else {
          flash('siteMessage', 'Flight Timer Not Started', 'bg-danger');
          redirect('logbook');
        }
      }
    }


    public function stopTimer($flight = '') {
      if ($flight == '') {
        flash('siteMessage', 'No ID', 'bg-danger');
        redirect('logbook');
      } else {
        $stopTimer = $this->logbookModel->stopTimer($flight);
        if ($stopTimer) {
          flash('siteMessage', 'Flight Timer Stopped');
          redirect('logbook/completeflight/'.$flight);
        } else {
          flash('siteMessage', 'Flight Timer Not Stopped', 'bg-danger');
          redirect('logbook');
        }
      }
    }

    public function completeFlight($flight = '') {

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Santise POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //instatiate the form validation class
        $validate = new Validate($_POST, $_FILES);
        //send the fields to be validated
        $validate->name('dayHrs')->numberFloat();
        $validate->name('nightHrs')->numberFloat();
        $validate->name('ifrDay')->numberFloat();
        $validate->name('ifrNight')->numberFloat();
        $validate->name('landingsDay')->numberInteger();
        $validate->name('landingsNight')->numberInteger();
        $validate->name('remarks')->regex('/^[a-zA-Z0-9\s\,\.\-]+$/');
        if($validate->isGroupValid() == false) {
          $formData = [
            'dayHrs' => $validate->getvalue('dayHrs'),
            'nightHrs' => $validate->getvalue('nightHrs'),
            'ifrDay' => $validate->getvalue('ifrDay'),
            'ifrNight' => $validate->getvalue('ifrNight'),
            'landingsDay' => $validate->getvalue('landingsDay'),
            'landingsNight' => $validate->getvalue('landingsNight'),
            'remarks' => $validate->getvalue('remarks'),
            'dayHrs_error' => $validate->getvalue('dayHrs'),
            'nightHrs_error' => $validate->getvalue('nightHrs'),
            'ifrDay_error' => $validate->getvalue('ifrDay'),
            'ifrNight_error' => $validate->getvalue('ifrNight'),
            'landingsDay_error' => $validate->getvalue('landingsDay'),
            'landingsNight_error' => $validate->getvalue('landingsNight'),
            'remarks_error' => $validate->getvalue('remarks')
          ];
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Complete your flight record',
            'pageDescription' => '',
          ];
          $flightData = $this->logbookModel->getFlight($flight);
          // Create two new DateTime-objects...
          $date1 = new DateTime($flightData->logbook_timeStart);
          $date2 = new DateTime($flightData->logbook_timeStop);
          // The diff-methods returns a new DateInterval-object...
          $diff = $date2->diff($date1);
          // Call the format method on the DateInterval-object
          $hours = $diff->format('%h');
          $decMins = minutes_to_decimal($diff->format('%i'));
          $flightHours = $hours.'.'.$decMins;
          //build the data array and pass it to the view
          $data = ['pageHeader' => $pageHead, 'activeFlight' => $flightData, 'flightHours' => $flightHours, 'form' => $formData];
          //load the view
          $this->view('pages/complete', $data);
        } else {
          $formData = [
            'dayHrs' => $validate->getvalue('dayHrs'),
            'nightHrs' => $validate->getvalue('nightHrs'),
            'ifrDay' => $validate->getvalue('ifrDay'),
            'ifrNight' => $validate->getvalue('ifrNight'),
            'landingsDay' => $validate->getvalue('landingsDay'),
            'landingsNight' => $validate->getvalue('landingsNight'),
            'remarks' => $validate->getvalue('remarks'),
            'recordId' => $validate->getValue('recordId')
          ];
          $formSubmission = $this->logbookModel->completeFlight($formData);
          if ($formSubmission) {
            flash('siteMessage', 'Flight Completed');
            redirect('logbook');
          } else {
            flash('siteMessage', 'Flight not-completed', 'bg-danger');
            redirect('logbook');
          }
        }
      }


      if ($flight == '') {
        flash('siteMessage', 'No ID', 'bg-danger');
        redirect('logbook');
      }
      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Complete your flight record',
        'pageDescription' => '',
      ];
      $flightData = $this->logbookModel->getFlight($flight);

      // Create two new DateTime-objects...
      $date1 = new DateTime($flightData->logbook_timeStart);
      $date2 = new DateTime($flightData->logbook_timeStop);

      // The diff-methods returns a new DateInterval-object...
      $diff = $date2->diff($date1);

      // Call the format method on the DateInterval-object
      $flightHours = $diff->format('%h.%i');

      $formData = [
        'dayHrs' => $flightHours,
        'nightHrs' => '',
        'ifrDay' => '',
        'ifrNight' => '',
        'landingsDay' => '',
        'landingsNight' => '',
        'remarks' => ''
      ];
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'activeFlight' => $flightData, 'flightHours' => $flightHours, 'form' => $formData];
      //load the view
      $this->view('pages/complete', $data);
    }



  }
