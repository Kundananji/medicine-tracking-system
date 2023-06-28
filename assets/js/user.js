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
       let publicKey= $('#publicKey').val();
       let ipAddress= $('#ipAddress').val();
   
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


    //disable button
    $('#action_submit_button').attr("disabled","disabled");
    $("#button-loader").html(`<div class="alert alert-warning"><img src="assets/img/spinner.gif/> Working... Please wait</div>`);

   
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
             publicKey:publicKey,
             ipAddress:ipAddress,
         },
         success:(resp)=>{
             //disable button
             $('#action_submit_button').removeAttr("disabled");

             if(resp && resp.status=="success"){
               //  viewUser();
            
                 $("#button-loader").html(`<div class="alert alert-success"><i class="bi bi-check"></i> ${resp.message}</div>`);
             }else{;
              
                 $("#button-loader").html(`<div class="alert alert-danger"><i class="bi bi-x"></i> ${resp.message}</div>`);
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
   
   } //end add user function


   let updateMiningDetails=(id)=>{
    $.ajax({
        url:"forms/user-form-mining.php",
        type:"get",
        data:{
            id:id
        },
        success:(resp)=>{
            $('#page-content').html(resp);
        }
    })

} //end update mining details function
   
     let viewUser=()=>{
         $.ajax({
             url:"ajax/view-user.php",
             type:"get",
             success:(resp)=>{
                 $('#page-content').html(resp);
             }
         })
   
   } //end view User function
   
   return {
       addUser: addUser,
       viewUser: viewUser,
       submitForm:submitForm,
       updateMiningDetails:updateMiningDetails
     };
   
   })(jQuery);
   