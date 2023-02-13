let Patient = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let name= $('#name').val();
    let dateOfBirth= $('#dateOfBirth').val();
    let gender= $('#gender').val();
    let User ID= $('#User ID').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(name==null || name==""){
        alert('Name is missing');
        return;
    }
    if(dateOfBirth==null || dateOfBirth==""){
        alert('Date of Birth is missing');
        return;
    }
    if(gender==null || gender==""){
        alert('Gender is missing');
        return;
    }
    if(User ID==null || User ID==""){
        alert('User is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-patient.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          name:name,
          dateOfBirth:dateOfBirth,
          gender:gender,
          User ID:User ID,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewPatient();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-patient

  let addPatient=(id)=>{
      $.ajax({
          url:"forms/patient-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewPatient=()=>{
      $.ajax({
          url:"ajax/view-patient.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addPatient: addPatient,
    viewPatient: viewPatient,
    submitForm:submitForm
  };

})(jQuery);
