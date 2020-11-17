<?php

  class Settings extends Controller {

    public function __construct() {
      $this->userModel = $this->model('User');
      $this->permissionModel = $this->model('Permission');
    }

    //main settings page -------------------------------------------------------------------------
    public function index() {

    } //end index

    //whole site usergroups page
    public function usergroups() {

    } //end usergroups  --------------------------------------------------------------------------

    //add usergroup page
    public function addusergroup() {

    } //end add usergroup  -----------------------------------------------------------------------

    //edit usergroup page
    public function editusergroup($groupID) {

    } //end edit usergroup -----------------------------------------------------------------------

    //deactivate usergroup
    public function deactivateusergroup($groupID) {

    } //end deactivate user group   --------------------------------------------------------------

    //set group permissions
    public function permissions() {
      if (!$this->permissionModel->checkSettingsPermission(get_class($this), $_SESSION['userGroup']) && $_SESSION['userGroup'] != 1) {
        flash('siteMessage', 'You do not have permission to edit the settings', 'bg-danger');
        redirect('register'); //leave blank for homepage
      } else {
        //process the registration form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          //sanitise POST array
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
          //set a failed state for use in the foreach loop
          $failed = true;
          //Run each group though a foreach loop and if it is set, re-write it as a 1, this way we can skip validation
          foreach ($_POST['permission'] as $permission) {
            if (!preg_match('/[0-9.-]/', $permission['recordId'])) {
              flash('siteMessage', 'Oops, the ID was not a number', 'bg-danger');
              redirect('register/settings');
            } else {
              $permission['read'] = (isset($permission['read'])) ? 1 : 0;
              $permission['create'] = (isset($permission['create'])) ? 1 : 0;
              $permission['update'] = (isset($permission['update'])) ? 1 : 0 ;
              $permission['delete'] = (isset($permission['delete'])) ? 1 : 0;
              $permission['settings'] = (isset($permission['settings'])) ? 1 : 0;
              //pull the data together in an array so we can send to the update
              $data = [
                'permission_id' => $permission['recordId'],
                'permission_read' => $permission['read'],
                'permission_create' => $permission['create'],
                'permission_update' => $permission['update'],
                'permission_delete' => $permission['delete'],
                'permission_settings' => $permission['settings']
              ];
              if ($this->permissionModel->updatePermissions($data)) {
                $failed = false;
              }
            }
          }
          if ($failed) {
            flash('siteMessage', 'Oops, something went wrong', 'bg-danger');
            redirect('register/settings');
          } else {
            flash('siteMessage', 'Permissions have been updated');
            redirect('register/settings');
          }
        } else { //not post data load the normal view
          //data for the template to display on the page header
          $pageHead = [
            'pageTitle' => 'User Registration Settings',
            'pageDescription' => '',
            'pageAddress' => URLROOT.'/50NorthMVC/register/settings',
            'pageImage' => ''
          ];
          $pageData = $this->permissionModel->getPermissions(get_class($this));
          //build the data array and pass it to the view
          $data = ['pageHeader' => $pageHead, 'pageData' => $pageData];
          //load the view
          $this->view('pages/register/settings', $data);
        }
      }
    } //end permissions  -------------------------------------------------------------------------

  } //end controller
