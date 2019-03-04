var TableDatatables = function(){
    var handleSupplierTable = function(){
        var supplierTable = $("#supplier_list");
        
        var oTable = supplierTable.dataTable({
            /*Used For Server Side Data Processing
              which helps to fetch data*/
            "processing": true,         
            "serverSide": true,
            "ajax":{
                url:
                "http://localhost/erp/pages/scripts/supplier/manage.php",
                type: "POST",
            },
            /*This parameter allows you to readily specify the entries in the length drop down select list that DataTables shows when pagination is enabled. It can be either:

            1D array of integer values which will be used for both the displayed option and the value to use for the display length, or

            2D array which will use the first inner array as the page length values and the second inner array as the displayed options. This is useful for language strings such as 'All').

            The page length values must always be integer values > 0, with the sole exception of -1. When -1 is used as a value this tells DataTables to disable pagination (i.e. display all rows).

            Note that the pageLength property will be automatically set to the first value given in this array, unless pageLength is also provided.*/
            "lengthMenu": [
                [5,15,20,-1],
                [5,15,25, "All"]
            ],
            //"pageLength": 15,//set the default length
            /*The order parameter is an array of arrays where the first value of the inner array is the column to order on, and the second is 'asc' (ascending ordering) or 'desc' (descending ordering) as required. order is a 2D array to allow multi-column ordering to be defined.*/
            "order":[
                [0, "desc"]
            ],
            /*Here orderable is used to disable the ordering of coloumns which include edit and delete buttons*/
            "columnDefs":[{
                'orderable': false,
                'targets':[-1,-2]
            }
            ]
        });
        /*Here on listens for an editor event,Similarly there are two more functions off()-stops listening the events and one()-listens the event once  */
        supplierTable.on('click', '.edit', function(e){//e ?
            $id = $(this).attr('id');// id ?
            $("#edit_supplier_id").val($id);//val() - Get or set the value for one or more fields. 
            //fetching all other values from database using ajax and loading them onto their respective edit fields!
            //alert($id); to print for checking
            $.ajax({
                url:"http://localhost/erp/pages/scripts/supplier/fetch.php",
                method: "POST",
                data: {supplier_id:$id},
                dataType: "json",
                success: function(data){
                    $("#supplier_name").val(data.supplier_name);
                    $("#supplier_address").val(data.supplier_address);
                    $("#supplier_email").val(data.supplier_email);
                    $("#supplier_contact").val(data.supplier_contact);
                    $("#gst_no").val(data.gst_no);
                    $("#editModal").modal('show');
                },
            });
        });
        supplierTable.on('click', '.delete', function(e){
            $id = $(this).attr('id');
            $("#recordID").val($id);
        });
    }
    return{
        //main function in javascript to handle all the initialisation part
        init: function(){
            handleSupplierTable();
        }
    };
}();
jQuery(document).ready(function(){
    TableDatatables.init();
});