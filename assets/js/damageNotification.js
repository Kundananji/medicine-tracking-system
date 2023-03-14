let DamageNotification = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let dateOfNotification= $('#dateOfNotification').val();
    let reportedbyId= $('#reportedbyId').val();
    let details= $('#details').val();
    let location= $('#location').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(dateOfNotification==null || dateOfNotification==""){
        alert('Date of Notification is missing');
        return;
    }
    if(reportedbyId==null || reportedbyId==""){
        alert('Reported By is missing');
        return;
    }
    if(details==null || details==""){
        alert('Details is missing');
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
    window.selectedMedicines.forEach((elem,index)=>{

        let div = `#med_${elem.id}`;
        let damageDetails = $(div).val().trim();
        if(damageDetails == null || damageDetails == ""){
            alert('Please enter the damage details for '+elem.name);
            missing+=1;
        }

        window.selectedMedicines[index].damageDetails = damageDetails;

    });

    if(missing>0){
        return;
    }
$('#submit-feedback').html(`<div class="alert alert-warning"><i class="bi bi-hourglass-split"> Submitting... please wait.</div>`);

  $.ajax({
      url:"ajax/save-damagenotification.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          dateOfNotification:dateOfNotification,
          reportedbyId:reportedbyId,
          details:details,
          location:location,
          medicines:window.selectedMedicines
      },
      success:(resp)=>{
          if(resp && resp.status=="success"){
              viewDamageNotification();
          }else{
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-damageNotification

  let addDamageNotification=(id)=>{
      $.ajax({
          url:"forms/damagenotification-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewDamageNotification=()=>{
    $('#submit-feedback').html(`<div class="alert alert-warning"><i class="bi bi-hourglass-split"> Loading ... please wait.</div>`);
      $.ajax({
          url:"ajax/view-damagenotification.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addDamageNotification: addDamageNotification,
    viewDamageNotification: viewDamageNotification,
    submitForm:submitForm
  };

})(jQuery);
