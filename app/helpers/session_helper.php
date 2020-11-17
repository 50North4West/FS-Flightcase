<?php

  session_start();

  //function for flash messaging
  //example - flash('register_success', 'You are now registered', 'alert alert-danger');
  //example in template - flash('register_success');
  function flash($name = '', $message = '', $class = 'bg-success') {
    if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
        if (!empty($_SESSION[$name])) {
          unset($_SESSION[$name]);
        }

        if (!empty($_SESSION[$name.'_class'])) {
          unset($_SESSION[$name.'_class']);
        }

        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;
      } elseif (empty($message) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
        echo '
        <div id="siteMessage" class="toast shadow" data-delay="8000" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top: 19px; right: 19px; z-index:10">
          <div class="toast-header '.$class.'">
            <i class="fas fa-envelope mr-2 pt-1 text-white"></i>
            <strong class="mr-auto text-white">Notification</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span class="text-white" aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body">
            '.$_SESSION[$name].'
          </div>
        </div>
        ';
        unset($_SESSION[$name]);
        unset($_SESSION[$name.'_class']);
      }
    }
  }

  function isLoggedIn() {
    if (isset($_SESSION['userId'])) {
      return true;
    } else {
      return false;
    }
  }


