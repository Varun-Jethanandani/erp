jQuery(document).ready(function(){
    $("#category_id").select2({
        placeholder: 'Select...',
    });
    $("#supplier_id").select2({
        multiple: true,//multiple options can be selected from the combobox at the same time
        placeholder: 'Select...',
    });
    

});