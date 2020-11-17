<?php

  class Account extends Controller {

    public function __construct() {
      $this->userModel = $this->model('User');
    }

    //user profile page
    public function index($id = '') {

      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Account',
        'pageDescription' => '',
        'pageAddress' => URLROOT.'/account/index',
        'pageImage' => ''
      ];
      //data for the form
      $pageData = $this->userModel->getUserList();;
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
      //load the view
      $this->view('account/index', $data);
    } //end index -------------------------------------------------------------------------------

    //login page
    public function login() {
      //process the login form
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Santise POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        //instatiate the form validation class
        $validate = new Validate($_POST, $_FILES);
        //send the fields to be validated
        $validate->name('username')->required()->minSize(1)->maxSize(150)->email();
        $validate->name('password')->required()->minsize(6)->maxSize(50)->alpha();

        //check for validation
        if($validate->isGroupValid() == false) {
          //there were errors
          //init form data to return to the view
          $formFields = [
            'username' => $validate->getValue('username'),
            'username_error' => $validate->getError('username'),
            'password' => $validate->getValue('password'),
            'password_error' => $validate->getError('password'),
          ];
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Login Error',
            'pageDescription' => '',
            'pageAddress' => URLROOT.'/account/login',
            'pageImage' => ''
          ];
          $data = ['pageHeader' => $pageHead, 'pageData' => $formFields];
          //load the view
          $this->view('account/login/login', $data);
        } else {
          //form validation passed
          if (!$this->userModel->findUserByEmail($_POST['username'])) {
            //give error
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Register',
              'pageDescription' => '',
              'pageAddress' => URLROOT.'/account/login/',
              'pageImage' => ''
            ];
            $pageData = [
              'username' => trim($_POST['username']),
              'username_error' => 'Your email address was not found',
              'password' => trim($_POST['password']),
            ];
            //merge the arrays
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            flash('siteMessage', 'Your email address was not found', 'bg-danger');
            $this->view('pages/login', $data);
            exit;
          }
          //check the user exists and the password matches
          $user = $this->userModel->login($_POST['username'], $_POST['password']);
          if (!$user) {
            //check the password is correct and if not give error
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Login',
              'pageDescription' => '',
              'pageAddress' => URLROOT.'/account/login/',
              'pageImage' => ''
            ];
            $pageData = [
              'username' => trim($_POST['username']),
              'password' => trim($_POST['password']),
              'password_error' => 'Incorrect password'
            ];
            //merge the arrays
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            flash('siteMessage', 'Incorrect password', 'bg-danger');
            $this->view('account/login/login', $data);
            exit;
          } elseif ($user->user_status != 1) {
            //the user details were correct, but the account has not been activiated
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Login',
              'pageDescription' => '',
              'pageAddress' => URLROOT.'/account/login/',
              'pageImage' => ''
            ];
            $pageData = [
              'username' => trim($_POST['username']),
              'password' => trim($_POST['password']),
            ];
            //merge the arrays
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            flash('siteMessage', 'Your account email has not been verified, please check your email', 'bg-danger');
            $this->view('account/login/login', $data);
            exit;
          } else {
            //create the SESSION
            $_SESSION['userId'] = $user->user_id;
            $_SESSION['userGroup'] = $user->user_userGroup;
            //load the view
            flash('siteMessage', 'Login successfull');
            redirect('logbook'); //blank for homepage
          }
        }
      } else { //no post data, load the view
        //data for the template to display on the page header
        $pageHead = [
          'pageTitle' => 'Please login',
          'pageDescription' => 'Enter your credentials below to logon',
          'pageAddress' => URLROOT.'/account/login',
          'pageImage' => ''
        ];
        //data for the form
        $pageData = [
          'username' => '',
          'password' => '',
        ];
        $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
        //load the view
        $this->view('account/login/login', $data);
      }
    } //end login  ------------------------------------------------------------------------------

    //process logout
    public function logout() {
      unset($_SESSION['userId']);
      unset($_SESSION['userGroup']);
      session_destroy();
      redirect('');
    } //end logout ------------------------------------------------------------------------------

    //registration page
    public function register() {
      switch (REGISTRATION) {
        case true:
          break;
        case false:
          flash('siteMessage', 'Registration is currently unavailable', 'bg-danger');
          redirect('');
          break;
        default:
          flash('siteMessage', 'Registration is currently unavailable', 'bg-danger');
          redirect('');
          break;
      }
      //process the registration form
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Santise POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //Validate the post data
        $validate = new Validate($_POST, $_FILES);
        //Send the files to be validated
        $validate->name('firstName')->required()->minSize(1)->maxSize(50)->text();
        $validate->name('lastName')->required()->minSize(1)->maxSize(50)->text();
        $validate->name('email')->required()->minSize(1)->maxSize(150)->email();
        $validate->name('password')->required()->minSize(1)->maxSize(50)->text();

        //check for validation
        if($validate->isGroupValid() == false) {
          //there were errors
          //init form data to return to the view
          $formFields = [
            'firstName' => $validate->getValue('firstName'),
            'firstName_error' => $validate->getError('firstName'),
            'lastName' => $validate->getValue('lastName'),
            'lastName_error' => $validate->getError('lastName'),
            'email' => $validate->getValue('email'),
            'email_error' => $validate->getError('email'),
            'password' => $validate->getValue('password'),
            'password_error' => $validate->getError('password'),
          ];

          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Register for a new account',
            'pageDescription' => 'Registration is currently free whilst in Beta',
            'pageAddress' => URLROOT.'/account/registration/',
            'pageImage' => ''
          ];
          //merge the arrays
          $data = ['pageHeader' => $pageHead, 'pageData' => $formFields];
          //load the view
          $this->view('account/register/register', $data);
        } else {
          //Validation has passed

          //check if the user is already registered
          if ($this->userModel->findUserByEmail($_POST['email'])) {
            //give error
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Register for a new account',
              'pageDescription' => 'Registration is currently free whilst in Beta',
              'pageAddress' => URLROOT.'/account/registration/',
              'pageImage' => ''
            ];
            $pageData = [
              'firstName' => $validate->getValue('firstName'),
              'firstName_error' => $validate->getError('firstName'),
              'lastName' => $validate->getValue('lastName'),
              'lastName_error' => $validate->getError('lastName'),
              'email' => $validate->getValue('email'),
              'email_error' => $validate->getError('email'),
              'password' => $validate->getValue('password'),
              'password_error' => $validate->getError('password'),
            ];
            //merge the arrays
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            flash('siteMessage', 'Email address is already registered - please choose another', 'bg-danger');
            $this->view('account/register/register', $data);
          } else {

            //hash the password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            //generate a url friendly nonce for the confirmation email and store in database
            $token = base64_encode_url(random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES));

            //encrypt the email address for the confirmation email
            $encryptedEmail = encryptData(trim($_POST['email']));

            //send a confirmation email for the user to confirm their account
            $name = trim($_POST['firstName']);
            $email = trim($_POST['email']);
            $preHeaderText = 'Please confirm your account';
            $message = siteRegistrationMessage($name, $email, $token, $encryptedEmail);
            $altText = '';
            $addresses = array($_POST['email'] => $_POST['firstName'].' '.$_POST['lastName']);
            $email = sendMail($addresses, 'Site Registration', emailTemplate($message, $preHeaderText), $altText);

            //put the form data into an array so we can add it to the database
            $pageData = [
              'userKey' => $token,
              'confEmail' => $email,
              'firstName' => trim($_POST['firstName']),
              'lastName' => trim($_POST['lastName']),
              'email' => trim($_POST['email']),
              'password' => $password,
              'picture' => '',
            ];
            //create record in db
            $recordId = $this->userModel->register($pageData);
            if ($recordId) {
              flash('siteMessage', 'Account registered successfully, please check your email');
              redirect('account/registrationsuccess'); //blank for homepage
            } else {
              flash('siteMessage', 'Something went wrong', 'bg-danger');
              redirect(''); //blank for homepage
            }
          }
        }
      } //end if post
      //no $_POST data present so load the normal view

      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'Register for a new account',
        'pageDescription' => 'Registration is currently free whilst in Beta',
        'pageAddress' => URLROOT.'/account/register',
        'pageImage' => ''
      ];
      //data for the form
      $pageData = [
        'userGroup' => '',
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'password' => '',
        'repeatPassword' => '',
        'picture' => '',
      ];

      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
      //load the view
      $this->view('account/register/register', $data);
    } //end register  ---------------------------------------------------------------------------

    //registration successful page
    public function registrationsuccess() {
      //data for the template to display on the page header
      $pageHead = [
        'pageTitle' => 'successful Registration',
        'pageDescription' => '',
        'pageAddress' => URLROOT.'/account/register/registrationsuccess',
        'pageImage' => ''
      ];
      //data for the form
      $pageData = [
        'userGroup' => '',
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'password' => '',
        'repeatPassword' => '',
        'picture' => '',
      ];
      //data for the usergroup select
      $userGroups = $this->userModel->getUserGroups();
      //build the data array and pass it to the view
      $data = ['pageHeader' => $pageHead, 'pageData' => $pageData, 'userGroups' => $userGroups];
      //load the view
      $this->view('account/register/registrationsuccess', $data);
    } //end registration success page ------------------------------------------------------------

    //confirm account page
    public function confirmaccount($email, $token) {
      //check if the user is registered
      if (!$this->userModel->findUserByEmailToken($token, decryptData($email))) {
        //user not registered and nonce doesn't match
        flash('siteMessage', 'Your email address is not registered on our system', 'bg-danger');
        redirect(''); //blank for homepage
      } else {
        //email and nonce match a database record
        if (!$this->userModel->confirmUser(decryptData($email))) {
          //user not registererd and nonce doesn't match
          flash('siteMessage', 'We could not activate your account, please contact the admin', 'bg-danger');
          redirect(''); //blank for homepage
        } else {
          flash('siteMessage', 'Your account has been activated, please login');
          redirect('account/login'); //blank for homepage
        }
      }
    } //end confirm account  ---------------------------------------------------------------------

    //forgot password page
    public function forgotpassword() {
      //process the forgot password form
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Santise POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //Validate the post data
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
          'username' => array(
            'required' => true,
            'min' => 1,
            'max' => 150,
            'type' => 'email',
            'name' => 'Email Address'
          )
        ));
        //check for validation
        if($validation->passed() == false) {
          //there were errors
          //init form data to return to the view
          $formFields = [
            'email' => trim($_POST['username']),
          ];
          //run through the errors and add the error message to the form
          foreach (array_combine($validation->errors(), $validation->fields()) as $error => $field) {
            $formFields[$field.'_error'] = $error;
          }
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Forgotten Password',
            'pageDescription' => '',
            'pageAddress' => URLROOT.'/account/forgotpassword',
            'pageImage' => ''
          ];
          $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
          //load the view
          $this->view('account/forgotpassword', $data);
        } else {
          //form validation passed
          if (!$this->userModel->findUserByEmail($_POST['username'])) {
            //give error
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Forgotten Password',
              'pageDescription' => '',
              'pageAddress' => URLROOT.'/account/forgotpassword',
              'pageImage' => ''
            ];
            $pageData = [
              'username' => trim($_POST['username']),
              'username_error' => 'Your email address was not found',
            ];
            //merge the arrays
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            flash('siteMessage', 'Your email address was not found', 'bg-danger');
            $this->view('account/forgotpassword', $data);
            exit;
          } else {
            //get the users details from the database
            $user = $this->userModel->getUserByEmail($_POST['username']);

            //generate a url friendly token for the confirmation email and store in database
            $token = base64_encode_url(random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES));

            //encrypt the email address for the confirmation email
            $encryptedEmail = encryptData($user->user_email);

            //update the user record with the current time stamp
            if (!$this->userModel->updatePasswordReset($token, $user->user_id, $resetDateTime = date('Y-m-d H:i:s'))) {
              flash('siteMessage', 'We were unable to reset your password, please contact the administrator');
              redirect('');
            } else {
              //send a confirmation email for the user to confirm their account
              $name = $user->user_firstName;
              $email = $user->user_email;
              $preHeaderText = 'Click the link in the email to reset your password';
              $message = passwordResetMessage($name, $email, $token, $encryptedEmail);
              $altText = '';
              $addresses = array($user->user_email => $user->user_firstName.' '.$user->user_lastName);
              $email = sendMail($addresses, 'Password Reset', emailTemplate($message, $preHeaderText), $altText);
              flash('siteMessage', 'Your password has been reset, please check your email');
              redirect('');
            }
          }
        }
      } else { //no post data, load the view
        //data for the template to display on the page header
        $pageHead = [
          'pageTitle' => 'Forgotten Password',
          'pageDescription' => '',
          'pageAddress' => URLROOT.'/account/forgotpassword',
          'pageImage' => ''
        ];
        //data for the form
        $pageData = [
          'username' => '',
          'password' => '',
        ];
        $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
        //load the view
        $this->view('account/forgotpassword', $data);
      }
    } //end forgot password  ----------------------------------------------------------------------

    //reset password page
    public function resetpassword($email, $token) {

      //decrypt the email address from the URL
      $decryptedEmail = decryptData($email);

      //get the user
      $user = $this->userModel->getUserByEmail($decryptedEmail);

      //get the date/time from the database & the date/time now then compare them
      $databaseTime = new DateTime($user->user_passwordReset);
      $timeNow = new DateTime('NOW');
      $interval = $databaseTime->diff($timeNow);
      $timeDifference = $interval->format('%h');

      //check if the link the user is using is actually valid - check of database for that user and ensures link not over 24hrs old
      if (!$this->userModel->findUserByEmailToken($token, decryptData($email)) && $timeDifference <= 24) {
        //user not registered and nonce doesn't match
        flash('siteMessage', 'This link is not valid', 'bg-danger');
        redirect(''); //blank for homepage
      } else {
        //process the reset form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //Validate the post data
          $validate = new Validate();
          $validation = $validate->check($_POST, array(
            'password' => array(
              'required' => true,
              'min' => 6,
              'max' => 255,
              'type' => 'text',
              'name' => 'Password'
            ),
            'repeatPassword' => array(
              'required' => true,
              'min' => 6,
              'max' => 255,
              'type' => 'text',
              'name' => 'Password'
            )
          ));

          //check for validation
          if($validation->passed() == false) {
            //there were errors
            //init form data to return to the view
            $formFields = [
              'password' => trim($_POST['password']),
              'repeatPassword' => trim($_POST['repeatPassword']),
            ];
            //run through the errors and add the error message to the form
            foreach (array_combine($validation->errors(), $validation->fields()) as $error => $field) {
              $formFields[$field.'_error'] = $error;
            }
            //data for the template to display on the page header
            $pageHead = [
              'pageTitle' => 'Login',
              'pageDescription' => '',
              'pageAddress' => URLROOT.'/account/resetpassword',
              'pageImage' => ''
            ];
            $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
            //load the view
            $this->view('account/resetpassword', $data);
          } else {
            //validation passed

            //hash the new password
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            //update the database and check it worked
            if (!$this->userModel->updatePassword($user->user_id, $password)) {
              //something went wrong with the database update
              flash('siteMessage', 'We were unable to update your password', 'bg-danger');
              redirect(''); //blank for homepage
            } else {
              //password changed
              flash('siteMessage', 'Password updated, you can now login');
              redirect('account/login'); //blank for homepage
            }
          }
        } else {
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'Password Reset',
            'pageDescription' => '',
            'pageAddress' => URLROOT.'/account/resetpassword',
            'pageImage' => ''
          ];
          //data for the form
          $pageData = [
            'password' => '',
            'repeatPassword' => '',
            'token' => $token,
            'email' => $email
          ];
          $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
          //load the view
          $this->view('account/resetpassword', $data);
        }
      }
    } //end reset password  -----------------------------------------------------------------------

  } //end controller
