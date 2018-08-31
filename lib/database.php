<?php

/**
 * Database class
 */
class Database
{
  private $dbhost = "localhost";
  private $dbuser = "root";
  private $dbpass = "";
  private $dbname = "contact_oop";
  public $connection;
  private $error;

  function __construct()
  {
    $this->connection = mysqli_connect($this->dbhost,$this->dbuser,$this->dbpass,$this->dbname);

    if(!$this->connection)
    {
      $this->error = "Database not connected :( due to ".$this->connection->error;
      echo $this->error;
    }
  }



  public function select($qry)
  {
    $result = $this->connection->query($qry) or die($this->connection->error.__LINE__);

    if ($result->num_rows > 0) {
      return $result;
    } else {
      return false;
    }
  }


  public function insert($qry)
  {
    $insert_row = $this->connection->query($qry) or die($this->connection->error.__LINE__);

    if ($insert_row) {
      header("Location: index.php?msg=".urlencode('Data Inserted Successfully;'));
      exit();
    }
    else {
      die("Error: ".$this->connection->errno." and ".$this->connection->error.__LINE__);
    }
  }


  public function update($query)
  {
    $update_row = $this->connection->query($query) or die($this->connection->error.__LINE__);

    if ($update_row) {
      header("Location: index.php?msg=".urlencode('Data Updated Successfully;'));
      exit();
    }
    else {
      die("Error: ".$this->connection->errno." and ".$this->connection->error.__LINE__);
    }
  }


  public function delete($tbl,$id)
  {
    $query = 'delete from '.$tbl.' where Id='.$id;
    $del = $this->connection->query($query) or die($this->connection->error.__LINE__);

    if ($del) {
      header("Location: index.php?del=".urlencode('Data Deleted Successfully;'));
      echo $table." and ".$id;
      exit();
    }
    else {
      die("Error: ".$this->connection->errno." and ".$this->connection->error.__LINE__);
    }
  }



}
 ?>
