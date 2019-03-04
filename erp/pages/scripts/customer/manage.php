<?php
require_once("../../includes/db.php");

$columns = array("customer_name","customer_address","customer_email","customer_contact","gst_no");
$query = "SELECT * FROM customer WHERE deleted=0";

if(isset($_POST["search"]["value"])){
    $query .= " AND (customer_name like '%".$_POST["search"]["value"]."%' OR customer_contact like '%". $_POST['search']['value']."%' OR customer_email like '%". $_POST['search']['value']."%') ";
}
if(isset($_POST["order"])){
    $query .= " ORDER BY ".$columns[$_POST['order']['0']['column']]." ".$_POST['order']['0']['dir'];
}
else{
    $query .=" ORDER BY ".$columns[0]." ASC";
}

$query1 = "";

if($_POST["length"]!=-1){
    $query1 = ' LIMIT '.$_POST['start'] .','.$_POST['length'];
}

//Here search,value is used for search bar and start to length are used mainly for pagination of table if number of rows are fixed as 5 for the table then the datatable displays this table till 0 to 5,5 to 10 and so on where start index=0/5 and length index=0+5/5+5 if not specified default length is -1 which displays all the rows
$number_filtered_row = mysqli_num_rows(mysqli_query($connection, $query));
$result = mysqli_query($connection, $query . $query1);
//echo $query.$query1;
$data = array();
while($row = mysqli_fetch_assoc($result)){
    $sub_array = array();
    
    $sub_array[] = $row["customer_name"];
    $sub_array[] = $row["customer_address"];
    $sub_array[] = $row["customer_email"];
    $sub_array[] = $row["customer_contact"];
    $sub_array[] = $row["gst_no"];
    $sub_array[] = "<button class='edit fa fa-pencil btn blue' id='".$row['customer_id']."' data-toggle='modal' data-target='#editModal'></button>";
    $sub_array[] = "<button class='delete fa fa-trash btn red' id='".$row['customer_id']."' data-toggle='modal' data-target='#deleteModal'></button>";
    //I may have to add some columns !!!
    
    $data[] = $sub_array;
}

function get_all_data($connection){
    $query = "SELECT * FROM customer";
    return (mysqli_num_rows(mysqli_query($connection, $query)));
}

$output = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => get_all_data($connection),
    "recordsFiltered" => $number_filtered_row,
    "data" => $data,
    );
echo json_encode($output);

?>