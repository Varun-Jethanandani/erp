<?php
require_once("../../includes/db.php");

if(isset($_POST['supplier_id'])){
    $supplier_id=$_POST['supplier_id'];
    $query="select supplier_id,supplier_name,supplier_address,supplier_email,supplier_contact,gst_no from supplier where  supplier_id = $supplier_id";
    
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    echo json_encode($row);
}
?>