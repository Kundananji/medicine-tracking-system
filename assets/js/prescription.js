let Prescription = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val().trim();
    let prescriptionDate= $('#prescriptionDate').val().trim();
    let hospitalId= $('#hospitalId').val().trim();
    let patientId= $('#patientId').val().trim();
    let location= $('#location').val().trim();

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
    if(location==null || location==""){
        alert('Patient Id is missing');
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
    
    window.selectedMedicines.forEach((elem,index)=>{

        let div = `#med_${elem.id}`;
        let dosage = $(div).val().trim();
        if(dosage == null || dosage == ""){
            alert('Please enter the dosage for '+elem.name);
            missing+=1;
        }

        window.selectedMedicines[index].dosage = dosage;

    });
    

    if(missing>0){
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
          medicines:window.selectedMedicines,
          location:location
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
              viewPrescription();
          }else{
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
              $('select').select2({
                width:"resolve"
              });
          }
      })

} //end view function

  let viewPrescription=()=>{
    let loader =  `<div class="alert alert-warning"><i class="bi bi-hourglass"></i> Loading....</div>`;
          
       $('#show-content-modal-body').html(loader);

      $.ajax({
          url:"ajax/view-prescription.php",
          type:"get",
          success:(resp)=>{
        
              $('#page-content').html(resp);
              $('#table-data-table').DataTable();
              
          }
      })

} //end view function

return {
    addPrescription: addPrescription,
    viewPrescription: viewPrescription,
    submitForm:submitForm
  };

})(jQuery);
