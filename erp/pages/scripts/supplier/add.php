<?php
session_start();
require_once("../../includes/db.php");
require_once("../../includes/functions.php");
$employee_id = $_SESSION['employee_id'];

if(isset($_POST['add_supplier'])){
    $supplier_name = $_POST['supplier_name'];
    $supplier_address = $_POST['supplier_address'];
    $supplier_email = $_POST['supplier_email'];
    $supplier_contact= $_POST['supplier_contact'];
    $gst_no = $_POST['gst_no'];
    
    $query_contact = "SELECT * FROM supplier WHERE supplier_contact = $supplier_contact";
    $result_contact = mysqli_query($connection,$query_contact);
    checkQueryResult($result_contact);
    
    if(mysqli_num_rows($result_contact)==0)
    {
        
        $query = "INSERT INTO supplier(supplier_name, supplier_address, supplier_email,supplier_contact,gst_no,created_at,created_by) VALUES('$supplier_name', '$supplier_address ','$supplier_email',$supplier_contact,$gst_no,now(),$employee_id)";
        $add_supplier_query_result = mysqli_query($connection,$query);
        checkQueryResult($add_supplier_query_result);
        
    }
    else{
            header("Location: http://".BASE_SERVER."/erp/pages/add-supplier.php?q=error&status=supplier");
            exit;
    }
    header("Location: http://".BASE_SERVER."/erp/pages/add-supplier.php?q=success");
    exit;  
}
?>
