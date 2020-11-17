<?php

  /*
  * App core class
  * Creates URL & Loads core controller
  * URL format = /controller/method/params
  * IF USING SUB-DIRECTORIES IN THE STRUCTURE YOU NEED TO ADD A PAGES.PHP & INDEX METHOD AS THE DEAFUALT FOR THAT FOLDER
  */

  class Core {

    protected $currentController = '';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct() {
      $url = $this->getURL(); //get an array built from the URL
      $urlCount = count($url);

      if ($urlCount > 0) {
        $urlLoop = true;
      } else {
        $this->currentController = 'Pages';
      }

      //set the default folder structure and set and create a counter we can use
      //$structure = $_SERVER['DOCUMENT_ROOT'].'/app/controllers/';
      $structure = '../app/controllers/';
      $i = 0;

      //check if there are values in the URL and if there are loop through each value in the array checking whether the file exists
      //or whether the folder exists. Either set current controller to the file, or add the directory to the structure. $e_type = str_replace(' ', '_', $e_type);
      if(isset($urlLoop)) {

        foreach ($url as $controller) {

          $controller = str_replace('-', '_', $controller);

          if (is_dir($structure.''.$controller)) {
            //if the value in the array is a folder add it to the structure and unset the value
            $structure .= $controller.'/';
            unset($url[$i]);
            $i++;
          } elseif (file_exists($structure.''.$controller.'.php')) {
            //if it exists set it as the current controller and unset the value
            $this->currentController = $controller;
            unset($url[$i]);
            $i++;
          }

        }

      }

      if (!file_exists($structure.''.$this->currentController.'.php')) {
        //load the 404
        http_response_code(404);
        header("HTTP/1.0 404 Not Found");
        include(APPROOT.'/views/error/404.php'); // provide your own file for the error page
        die();
      } else {
        //load the controller
        require_once $structure.$this->currentController.'.php';
        //instatiate the controller
        $this->currentController = new $this->currentController;
        //check for second part of url so pages/about
        if (isset($url[$i])) {
          //check to see if the method exists in the controller
          if (method_exists($this->currentController, str_replace('-', '_', $url[$i]))) {
            $this->currentMethod = str_replace('-', '_', $url[$i]);
            //unset index from $url
            unset($url[$i]);
          }
        }
      }


      //check the third part of the url with the parameters
      $this->params = $url ? array_values($url) : [];
      //call a callback with an array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl() {
      if (isset($_GET['url'])) { //check to see if we have variables in the URL
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL); //ensures no naughty characters are added to the URL
        $url = explode('/', $url);
        return $url;
      } else {
        $url = [];
        return $url;
      }
    }
  }
