<?php

  /*
  *   Base Controller
  *   Loads the models and views
  */

  class Controller {

    //load the model
    public function model($model) {
      //Require/load model file
      require_once '../app/models/'.$model.'.php';

      //instantiate the model
      return new $model();
    }

    //load the view
    public function view($view, $data = []) {
      //check for the view file
      if (file_exists('../app/views/'.$view.'.php')) {
        require_once '../app/views/'.$view.'.php';
      } else {
        //view does not exist, load 404 page
        require_once '../app/views/error/404.php';
      }
    }
  }
