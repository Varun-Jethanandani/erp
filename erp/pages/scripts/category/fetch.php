<?php
require_once("../../includes/db.php");

if(isset($_POST['category_id'])){
    $category_id=$_POST['category_id'];
    $query="select category_id,category_name,category.hsn_code,gst_rate from category,gst where category.hsn_code=gst.hsn_code having category.category_id=$category_id";
    
    $result=mysqli_query($connection,$query);
    $row=mysqli_fetch_assoc($result);
    echo json_encode($row);
}

?>