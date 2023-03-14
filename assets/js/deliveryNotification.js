let DeliveryNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfDelivery= $('#dateOfDelivery').val();
    let deliveredById= $('#deliveredById').val();
    let deliveredToId= $('#deliveredToId').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfDelivery==null || dateOfDelivery==""){
        alert('Date of Delivery is missing');
        return;
    }
    if(deliveredById==null || deliveredById==""){
        alert('Delivered By is missing');
        return;
    }
    if(deliveredToId==null || deliveredToId==""){
        alert('Delivered To is missing');
        return;
    }
    if(location==null || location==""){
        alert('Location is missing');
        return;
    }

    if(!window.selectedMedicines){
        alert('Please select the medicine that was sold');
        return;
    }

    if(window.selectedMedicines.length == 0){
        alert('Please select the medicine that was sold');
        return;
    }

    //loop through each medicines and append amounts
    let missing = 0;
    /*
    window.selectedMedicines.forEach((elem,index)=>{

        let div = `#med_${elem.id}`;
        let quantity = $(div).val().trim();
        if(quantity == null || quantity == ""){
            alert('Please enter the quantity for '+elem.name);
            missing+=1;
        }

        window.selectedMedicines[index].quantity = quantity;

    });
    */

    if(missing>0){
        return;
    }
    $('#submit-feedback').html(`<div class="alert alert-warning"><i class="bi bi-hourglass-split"> Submitting... please wait.</div>`);
  $.ajax({
      url:"ajax/save-deliverynotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfDelivery:dateOfDelivery,
          deliveredById:deliveredById,
          deliveredToId:deliveredToId,
          location:location,
          medicines:window.selectedMedicines
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
              viewDeliveryNotification();
          }else{
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-deliveryNotification

  let addDeliveryNotification=(id)=>{
      $.ajax({
          url:"forms/deliverynotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
              $('select').select2({
                width:"resolve"
              });
          }
      })

} //end view function

  let viewDeliveryNotification=()=>{
    $('#page-content').html(`<div class="alert alert-warning"><i class="bi bi-hourglass-split"> Loading... please wait.</div>`);
    
      $.ajax({
          url:"ajax/view-deliverynotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
              $('#table-data-table').DataTable();
          }
      })

} //end view function

return {
    addDeliveryNotification: addDeliveryNotification,
    viewDeliveryNotification: viewDeliveryNotification,
    submitForm:submitForm
  };

})(jQuery);
