<?php

  class Pages extends Controller {
    public function __construct() {
    }

    //The home page for the site
    public function index() {
      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Welcome!',
        'pageDescription' => 'FS Flightcase, an electronic flightbag for use in Microsoft Flight Simulator ',
        'pageAddress' => URLROOT.'/50NorthMVC/',
        'pageImage' => ''
      ];
      //get the posts or other content and add it here
      $pageData = [

      ];
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
      //load the view
      $this->view('pages/index', $data);
    }
  }
