let Medicines  = (function($) {
    "use strict";

    $(document).ready(()=>{
        //submit add medicine form
        
        $('#form-add-medicine').on('submit',(e=>{
            e.preventDefault();

        })

    })

    /**
     * function returns a form to allow adding of medicines
     */
    let addMedicine = ()=>{
        $.ajax({
            url:'forms/add-medicine.php',
            type:'get',
            success:(resp)=>{
                  $('#page-content').html(resp);
            }
        })
    }


    return {
        addMedicine:addMedicine
    }



})(jQuery);
