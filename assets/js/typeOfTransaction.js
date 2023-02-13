let TypeOfTransaction = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let name = $('#name ').val();
    let description= $('#description').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(name ==null || name ==""){
        alert('Name is missing');
        return;
    }
    if(description==null || description==""){
        alert('Description is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-typeoftransaction.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          name :name ,
          description:description,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewTypeOfTransaction();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-typeOfTransaction

  let addTypeOfTransaction=(id)=>{
      $.ajax({
          url:"forms/typeoftransaction-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewTypeOfTransaction=()=>{
      $.ajax({
          url:"ajax/view-typeoftransaction.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addTypeOfTransaction: addTypeOfTransaction,
    viewTypeOfTransaction: viewTypeOfTransaction,
    submitForm:submitForm
  };

})(jQuery);
