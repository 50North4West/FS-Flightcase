<?php

  class User {

    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    //register user
    public function register($data) {
      $this->db->query('INSERT INTO users (user_key, user_confEmail, user_firstName, user_lastName, user_email, user_password) VALUES (:user_key, :user_confEmail, :user_firstName, :user_lastName, :user_email, :user_password)');
      //bind values
      $this->db->bind(':user_key', $data['userKey']);
      $this->db->bind(':user_confEmail', $data['confEmail']);
      $this->db->bind(':user_firstName', $data['firstName']);
      $this->db->bind(':user_lastName', $data['lastName']);
      $this->db->bind(':user_email', $data['email']);
      $this->db->bind(':user_password', $data['password']);

      //execute
      $recordId = $this->db->executeReturnId();
      if (isset($recordId)) {
        return $recordId;
      } else {
        return false;
      }
    }

    //update user picture
    public function updateUserPicture($data) {
      $this->db->query('UPDATE users SET user_profilePicture = :picture WHERE user_id = :userId');
      //bind values
      $this->db->bind(':userId', $data['userId']);
      $this->db->bind(':picture', $data['picture']);
      //execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    //update user record with a new key, set their account as innactive, and add a date as we want the reset link to be valid for 24hrs only
    public function updatePasswordReset($token, $userId, $date) {
      $this->db->query('UPDATE users SET user_key = :userKey, user_passwordReset = :passwordResetDate, user_status = 0 WHERE user_id = :userId');
      //bind values
      $this->db->bind(':userKey', $token);
      $this->db->bind(':passwordResetDate', $date);
      $this->db->bind(':userId', $userId);
      //execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    //update user record with a new key, set their account as innactive, and add a date as we want the reset link to be valid for 24hrs only
    public function updatePassword($userId, $password) {
      $this->db->query('UPDATE users SET user_key = "", user_passwordReset = "", user_status = 1, user_password = :password WHERE user_id = :userId');
      //bind values
      $this->db->bind(':password', $password);
      $this->db->bind(':userId', $userId);
      //execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function login($username, $password) {
      //query
      $this->db->query('SELECT * from users WHERE user_email = :username');
      //bind values
      $this->db->bind(':username', $username);
      //get the returned result
      $row = $this->db->single();
      //check the password matches
      if (password_verify($password, $row->user_password)) {
        return $row;
      } else {
        return false;
      }
    }

    //find user by email
    public function findUserByEmail($email) {
      $this->db->query('SELECT * FROM users WHERE user_email = :email');
      //bind value
      $this->db->bind(':email', $email);
      $row = $this->db->single();

      //check row for a registered user
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //find user by email
    public function getUserByEmail($email) {
      $this->db->query('SELECT * FROM users WHERE user_email = :email');
      //bind value
      $this->db->bind(':email', $email);
      $row = $this->db->single();
      return $row;
    }

    //find user by email and supplied token - used in email messages
    public function findUserByEmailToken($token, $email) {
      $this->db->query('SELECT * FROM users WHERE user_email = :email AND user_key = :user_key');
      //bind value
      $this->db->bind(':email', $email);
      $this->db->bind(':user_key', $token);
      $row = $this->db->single();
      //check row for a registered user
      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    //find user by email
    public function confirmUser($email) {
      $this->db->query('UPDATE users SET user_status = 1 WHERE user_email = :email');
      //bind value
      $this->db->bind(':email', $email);

      //execute
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    //find user by id
    public function getUserById($id) {
      $this->db->query('SELECT * FROM users WHERE staffId = :staffId');
      //bind value
      $this->db->bind(':staffId', $id);
      $row = $this->db->single();
      return $row;
    }

    //get user groups
    public function getUserGroups() {
      $this->db->query('SELECT * FROM usergroups WHERE userGroup_deleted != 1');
      $results = $this->db->resultSet();
      return $results;
    }

    //get list of users
    public function getUserList() {
      $this->db->query('SELECT * FROM users WHERE user_deleted != 1');
      $results = $this->db->resultSet();
      return $results;
    }


  }
