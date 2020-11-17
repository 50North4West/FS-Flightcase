<?php

  class Permission {

    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    //check create permission level
    public function checkCreatePermission($controller, $group) {
      //query
      $this->db->query('SELECT * from userpermissions WHERE permission_linkedTo = :controller AND permission_groupId = :group AND permission_create = 1');
      //bind values
      $this->db->bind(':controller', $controller);
      $this->db->bind(':group', $group);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //check read permission level
    public function checkReadPermission($controller, $group) {
      //query
      $this->db->query('SELECT * from userpermissions WHERE permission_linkedTo = :controller AND permission_groupId = :group AND permission_read = 1');
      //bind values
      $this->db->bind(':controller', $controller);
      $this->db->bind(':group', $group);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //check update permission level
    public function checkUpdatePermission($controller, $group) {
      //query
      $this->db->query('SELECT * from userpermissions WHERE permission_linkedTo = :controller AND permission_groupId = :group AND permission_update = 1');
      //bind values
      $this->db->bind(':controller', $controller);
      $this->db->bind(':group', $group);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //check delete permission level
    public function checkDeletePermission($controller, $group) {
      //query
      $this->db->query('SELECT * from userpermissions WHERE permission_linkedTo = :controller AND permission_groupId = :group AND permission_delete = 1');
      //bind values
      $this->db->bind(':controller', $controller);
      $this->db->bind(':group', $group);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //check super user permission level
    public function checkSettingsPermission($controller, $group) {
      //query
      $this->db->query('SELECT * from userpermissions WHERE permission_linkedTo = :controller AND permission_groupId = :group AND permission_settings = 1');
      //bind values
      $this->db->bind(':controller', $controller);
      $this->db->bind(':group', $group);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //get user permissions for the class
    public function getPermissions($controller) {
      //query
      $this->db->query('SELECT * FROM userpermissions INNER JOIN usergroups ON userpermissions.permission_groupId = usergroups.userGroup_id WHERE permission_linkedTo = :controller AND permission_markDeleted != 1');
      //bind values
      $this->db->bind(':controller', $controller);
      //get the results
      $results = $this->db->resultSet();
      return $results;
    }

    //update the permissions
    public function updatePermissions($data) {
      $this->db->query('UPDATE userpermissions SET permission_create = :permission_create, permission_read = :permission_read, permission_update = :permission_update, permission_delete = :permission_delete, permission_settings = :permission_settings WHERE permission_id = :permission_id');
      //bind values
      $this->db->bind(':permission_create', $data['permission_create']);
      $this->db->bind(':permission_read', $data['permission_read']);
      $this->db->bind(':permission_update', $data['permission_update']);
      $this->db->bind(':permission_delete', $data['permission_delete']);
      $this->db->bind(':permission_settings', $data['permission_settings']);
      $this->db->bind(':permission_id', $data['permission_id']);
      //execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

  }
