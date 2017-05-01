<?php
/**
 *
 */
class orderManger
{
private $file_name = '../../Database/order.php';
private $file_name2 = '../../Application/order.php';
private $file_name3 = '../../Application/medicineOrder.php';
private $order_query;
private $order;
  function __construct()
  {
    try {
   include_once ($this->file_name) ;
   include_once ($this->file_name2) ;
   include_once ($this->file_name3) ;
     } catch (Exception $e) {
     echo "error in file name";

  }
  $this->order_query=  new Order_Query();

}
 public function return_order($id)
 {
   $order_result =$this->order_query->fetch_order($id);
   $size = sizeof($order_result);
   if($size !=0){
  for($i =0; $i < $size  ;$i++){
    $this->order[$i] = new Order ();
    $this->order[$i]->setId($order_result[$i]['Id']);
    $this->order[$i]->setPharmacyId($order_result[$i]['PharmacyId']);
    $this->order[$i]->setUserId($id);
    $this->order[$i]->setStatus($order_result[$i]['status']);
    $this->order[$i]->setDate($order_result[$i]['date']);

}

  return ($this->order);
}
else {
  return 0;
}
 }
  public function return_pharmacy($id){
    $order_result =$this->order_query->fetch_pharmacy($id);
    return ($order_result);
  }


public function return_all_pharmacy(){
  $order_result =$this->order_query->fetch_all_pharmacy();
  return ($order_result);
}
 public function checkorder($id)
 {
   return ($this->order_query->deleteOrder($id));
 }
 public function fech_deatails($id)
 {
   $order_result = $this->order_query->fetch_order_details($id);

   if(isset($order_result)){
   $order_status=$this->order_query->get_Status($order_result[0]['status'])[0]['Status'];
   $pharmacy_name = $this->order_query->fetch_pharmacy($order_result[0]['PharmacyId'])[0]['Name'];
   $medicine = $this->order_query -> get_medicine_order($id);
    $this->order = new Order ();
     $this->order->setId($id);
     $this->order->setPharmacyId($pharmacy_name);
     $this->order->setStatus($order_status);
     $this->order->setDate($order_result[0]['date']);
     $medicine_lenght =sizeof($medicine);
     $medicine_array;
     if($medicine_lenght){
     for( $i=0 ;$i< $medicine_lenght ; $i++){
       $medicine_array[$i] =new MedicineOrder();
       $medicine_array[$i]->setAmount($medicine[$i]['Amount']);
       $medicine_name =$this->order_query->get_medicine_name($medicine[$i]['MedicineCode']);
       
       $medicine_array[$i]->setMedicine($medicine_name[0]['EnName']);
     }
     $this->order->setMedicine($medicine_array);

     }
     return $this->order;
   }
   else {
     return False;
   }
 }

}

?>
