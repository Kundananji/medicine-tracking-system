let UserType = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let name = $('#name ').val();
    let description= $('#description').val();
    let canAddMedicine= $('#canAddMedicine').val();
    let canViewMedicine= $('#canViewMedicine').val();
    let canSale= $('#canSale').val();
    let canBuy= $('#canBuy').val();
    let canReceive= $('#canReceive').val();
    let canDeliver= $('#canDeliver').val();
    let canDispense= $('#canDispense').val();

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
    if(canAddMedicine==null || canAddMedicine==""){
        alert('Can Add Medicine is missing');
        return;
    }
    if(canViewMedicine==null || canViewMedicine==""){
        alert('Can View Medicine is missing');
        return;
    }
    if(canSale==null || canSale==""){
        alert('Can Sale is missing');
        return;
    }
    if(canBuy==null || canBuy==""){
        alert('Can Buy is missing');
        return;
    }
    if(canReceive==null || canReceive==""){
        alert('Can Receive is missing');
        return;
    }
    if(canDeliver==null || canDeliver==""){
        alert('Can Deliver is missing');
        return;
    }
    if(canDispense==null || canDispense==""){
        alert('Can Dispense is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-usertype.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          name :name ,
          description:description,
          canAddMedicine:canAddMedicine,
          canViewMedicine:canViewMedicine,
          canSale:canSale,
          canBuy:canBuy,
          canReceive:canReceive,
          canDeliver:canDeliver,
          canDispense:canDispense,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewUserType();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-userType

  let addUserType=(id)=>{
      $.ajax({
          url:"forms/usertype-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewUserType=()=>{
      $.ajax({
          url:"ajax/view-usertype.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addUserType: addUserType,
    viewUserType: viewUserType,
    submitForm:submitForm
  };

})(jQuery);
