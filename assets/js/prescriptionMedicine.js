let PrescriptionMedicine = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let prescriptionId= $('#prescriptionId').val();
    let medicineId= $('#medicineId').val();
    let quantity= $('#quantity').val();
    let amount= $('#amount').val();
    let dosage= $('#dosage').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(prescriptionId==null || prescriptionId==""){
        alert('Prescription is missing');
        return;
    }
    if(medicineId==null || medicineId==""){
        alert('Medicine is missing');
        return;
    }
    if(quantity==null || quantity==""){
        alert('Quantity is missing');
        return;
    }
    if(amount==null || amount==""){
        alert('Amount is missing');
        return;
    }
    if(dosage==null || dosage==""){
        alert('Dosage is missing');
        return;
    }
    

  $.ajax({
      url:"ajax/save-prescriptionmedicine.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          prescriptionId:prescriptionId,
          medicineId:medicineId,
          quantity:quantity,
          amount:amount,
          dosage:dosage,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewPrescriptionMedicine();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-prescriptionMedicine

  let addPrescriptionMedicine=(id)=>{
      $.ajax({
          url:"forms/prescriptionmedicine-form.php",
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

  let viewPrescriptionMedicine=(data)=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
    if(data.prescriptionId){        
       $('#show-content-modal-body').html(loader);
     }
     else{
       $('#page-content').html(loader);
     }
      $.ajax({
          url:"ajax/view-prescriptionmedicine.php",
          type:"get",
          data:data,
          success:(resp)=>{
            if(data.prescriptionId){
                $('#showContentModal').modal('show');
                $('#show-content-modal-body').html(resp);
                $('#table-data-table').DataTable();
              }
              else{
              $('#page-content').html(resp);
              }
          }
      })

} //end view function

return {
    addPrescriptionMedicine: addPrescriptionMedicine,
    viewPrescriptionMedicine: viewPrescriptionMedicine,
    submitForm:submitForm
  };

})(jQuery);
