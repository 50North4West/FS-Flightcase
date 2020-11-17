<?php
  /*
  * PDO Database Class
  * Connect to the database
  * Create prepared statements
  * Bind values
  * Return rows and results
  */

  class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbHandler;
    private $statement;
    private $error;

    public function __construct() {
      //set DSN
      $dsn = 'mysql:host='.$this->host.'; dbname='.$this->dbname;
      $options = array(
        PDO::ATTR_PERSISTENT => true, //checks to see if the database is already opens, better for performance
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      );

      //create PDO instance
      try {
        $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);
      } catch (PDOException $e) {
        $this->error = $e->getMessage();
        echo $this->error;
      }
    }

    // prepare statement with query
    public function query($sql) {
      $this->statement = $this->dbHandler->prepare($sql);
    }

    //bind values
    public function bind($param, $value, $type = null) {
      if (is_null($type)) {
        switch(true) {
          case is_int($value) :
            $type = PDO::PARAM_INT;
            break;
          case is_bool($value) :
            $type = PDO::PARAM_BOOL;
            break;
          case is_null($value) :
            $type = PDO::PARAM_NULL;
            break;
          default :
            $type = PDO::PARAM_STR;
        }
      }

      $this->statement->bindValue($param, $value, $type);
    }

    //execute the prepared statement
    public function execute() {
      return $this->statement->execute();
    }

    //execute the prepared statement and return the ID
    public function executeReturnId() {
      $this->statement->execute();
      return $this->dbHandler->lastInsertId();
    }

    //get results set as array of objects
    public function resultSet() {
      $this->execute();
      return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    //get results set as array of objects - grouped
    public function resultSetGrouped() {
      $this->execute();
      return $this->statement->fetchAll(PDO::FETCH_GROUP);
    }

    //get single record as an object
    public function single() {
      $this->execute();
      return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    //get row count
    public function rowCount() {
      return $this->statement->rowCount();
    }

  }
