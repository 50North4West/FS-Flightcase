<?php

  class logbookModel {

    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function getAllEntries($uid) {
      $this->db->query('SELECT * FROM logbook WHERE logbook_uid = :uid AND logbook_active != 1 AND logbook_fltComplete = 1 AND logbook_deleted != 1');
      $this->db->bind(':uid', $uid);
      $results = $this->db->resultSet();
      return $results;
    }

    public function getActiveFlight($uid) {
      $this->db->query('SELECT * FROM logbook WHERE logbook_uid = :uid AND logbook_active = 1 AND logbook_fltComplete != 1 AND logbook_deleted != 1');
      $this->db->bind(':uid', $uid);
      //return the first row
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return $row;
      } else {
        return false;
      }
    }

    public function getFlight($flight) {
      $this->db->query('SELECT * FROM logbook WHERE logbook_id = :flight AND logbook_deleted != 1');
      $this->db->bind(':flight', $flight);
      $row = $this->db->single();
      //check row for a group
      if ($this->db->rowCount() > 0) {
        return $row;
      } else {
        return false;
      }
    }


    public function createLogEntry($formData) {
      $this->db->query('INSERT INTO logbook (logbook_uid, logbook_date, logbook_acType, logbook_acReg, logbook_from, logbook_to, logbook_fltNum, logbook_engType, logbook_remarks)
      VALUES (:uid, :date, :acType, :acReg, :fltFrom, :fltTo, :fltNum, :engType, :remarks)');
      $this->db->bind(':uid', $_SESSION['userId']);
      $this->db->bind(':date', $formData['date']);
      $this->db->bind(':acType', $formData['acType']);
      $this->db->bind(':acReg', $formData['acReg']);
      $this->db->bind(':fltFrom', $formData['fltFrom']);
      $this->db->bind(':fltTo', $formData['fltTo']);
      $this->db->bind(':fltNum', $formData['fltNum']);
      $this->db->bind(':engType', $formData['engType']);
      $this->db->bind(':remarks', $formData['remarks']);
      //execute
      $recordId = $this->db->executeReturnId();
      if (isset($recordId)) {
        return $recordId;
      } else {
        return false;
      }
    }

    public function startTimer($flight) {
      $this->db->query('UPDATE logbook SET logbook_timeStart = NOW() WHERE logbook_id = :flight');
      $this->db->bind(':flight', $flight);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function stopTimer($flight) {
      $this->db->query('UPDATE logbook SET logbook_timeStop = NOW(), logbook_active = 0, logbook_fltComplete = 1 WHERE logbook_id = :flight');
      $this->db->bind(':flight', $flight);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function completeFlight($formData) {
      $this->db->query('UPDATE logbook SET logbook_dayHrs = :dayHrs, logbook_nightHrs = :nightHrs, logbook_ifrDay = :ifrDay, logbook_ifrNight = :ifrNight, logbook_landingsDay = :landingsDay, logbook_landingsNight = :landingsNight, logbook_remarks = :remarks WHERE logbook_id = :id');
      $this->db->bind(':dayHrs', $formData['dayHrs']);
      $this->db->bind(':nightHrs', $formData['nightHrs']);
      $this->db->bind(':ifrDay', $formData['ifrDay']);
      $this->db->bind(':ifrNight', $formData['ifrNight']);
      $this->db->bind(':landingsDay', $formData['landingsDay']);
      $this->db->bind(':landingsNight', $formData['landingsNight']);
      $this->db->bind(':remarks', $formData['remarks']);
      $this->db->bind(':id', $formData['recordId']);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }



  }