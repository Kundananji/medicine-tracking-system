let User = (function ($) {
 "use strict";

let submitForm = (e)=>{ 

    e.preventDefault();

    let id= $('#id').val();
    let name= $('#name').val();
    let address= $('#address').val();
    let email= $('#email').val();
    let username= $('#username').val();
    let password= $('#password').val();
    let userTypeId= $('#userTypeId').val();

    if(id==null || id==""){
        alert('ID is missing');
        return;
    }
    if(name==null || name==""){
        alert('Name is missing');
        return;
    }
    if(address==null || address==""){
        alert('Address is missing');
        return;
    }
    if(email==null || email==""){
        alert('Email is missing');
        return;
    }
    if(username==null || username==""){
        alert('Username is missing');
        return;
    }
    if(password==null || password==""){
        alert('Password is missing');
        return;
    }
    if(userTypeId==null || userTypeId==""){
        alert('User Type is missing');
        return;
    }

  $.ajax({
      url:"ajax/save-user.php",
      type:"post",
      dataType:"json",
      data:{
          id:id,
          name:name,
          address:address,
          email:email,
          username:username,
          password:password,
          userTypeId:userTypeId,
      },
      success:(resp)=>{
          if(resp && resp.status=="status"){
              viewUser();
          }else{;
              alert(resp.message);
          }
      }
  });

}; //end submit form-add-user

  let addUser=(id)=>{
      $.ajax({
          url:"forms/user-form.php",
          type:"get",
          data:{
              id:id
          },
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

  let viewUser=()=>{
      $.ajax({
          url:"ajax/view-user.php",
          type:"get",
          success:(resp)=>{
              $('#page-content').html(resp);
          }
      })

} //end view function

return {
    addUser: addUser,
    viewUser: viewUser,
    submitForm:submitForm
  };

})(jQuery);
