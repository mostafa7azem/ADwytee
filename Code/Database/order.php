<?php
/**
 *
 */
class Order_Query
{
  private $file_name ='DataBase.php';
  private $database;
  private $file_name2= 'credential.php';
  function __construct()
  {
    try {
   include_once $this->file_name ;
     } catch (Exception $e) {
     echo "error in file name";
   }

     $this->database = new DataBase($this->file_name2);
}
   public function fetch_order($id)
  {
    # code...
    $query = "SELECT `Id`, `PharmacyId`, `date`, `status` FROM `Order` WHERE `UserId` = $id ";
    return ($this->database->fetch_query($query));
    }
    public function fetch_pharmacy($id){
        $query = "SELECT `Name` FROM `Pharmacy` WHERE `UserId` = $id ";
        return ($this->database->fetch_query($query));
    }
    public function fetch_all_pharmacy(){
        $query = "SELECT `Name` FROM `Pharmacy`";
        return ($this->database->fetch_query($query));
    }
    public function deleteOrder($id)
    {
      $query ="DELETE FROM `Order` WHERE `id`=$id";
      $this->database->fetch_query($query);
    }
  public function add()
  {
    $query ="INSERT INTO `Usertype`( `Type`) VALUES ('m5ns')";
    $this->database->database_query($query);
  }
}

 ?>
