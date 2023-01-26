(function() {
    "use strict";

    $(document).ready(()=>{

        $('#register-form').on('submit',(e)=>{
            e.preventDefault();
            let name = $('#yourName').val();
            let address = $('#yourAddress').val();
            let email = $('#yourEmail').val();
            let username= $('#yourUsername').val();
            let password = $('#yourPassword').val();
            let passwordConfirm = $('#yourPasswordConfirm').val();

            if(!name){
                alert('Please enter name');
                return;
            }
            if(!address){
                alert('Please enter address');
                return;
            }
            if(!email){
                alert('Please enter email');
                return;
            }
            if(!username){
                alert('Please enter username');
                return;
            }
            if(!password){
                alert('Please enter password');
                return;
            }

            if(password != passwordConfirm){
                alert('Passwords do not match');
                return;
            }

            $.ajax({
                url:'ajax/register.php',
                type:'post',
                dataType:'json',
                data:{
                    name:name,
                    address:address,
                    email:email,
                    username: username,
                    password:password,
                    passwordConfirm:passwordConfirm


                },
                success:(resp)=>{
                    alert(resp.message);
                    if(resp.status=="success"){
                        window.location = "login.php";
                    }
                }

            })


        });




    });



})();