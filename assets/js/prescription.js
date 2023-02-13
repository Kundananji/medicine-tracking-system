let Prescription = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let prescriptionDate= $('#prescriptionDate').val();
    let hospitalId= $('#hospitalId').val();
    let patientId= $('#patientId').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(prescriptionDate==null || prescriptionDate==""){
        alert('Prescription Date is missing');
        return;
    }
    if(hospitalId==null || hospitalId==""){
        alert('Hospital is missing');
        return;
    }
    if(patientId==null || patientId==""){
        alert('Patient Id is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-prescription.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          prescriptionDate:prescriptionDate,
          hospitalId:hospitalId,
          patientId:patientId,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewPrescription();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-prescription

  let addPrescription=(id)=>{
      $.ajax({
          url:"forms/prescription-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewPrescription=()=>{
      $.ajax({
          url:"ajax/view-prescription.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addPrescription: addPrescription,
    viewPrescription: viewPrescription,
    submitForm:submitForm
  };

})(jQuery);
