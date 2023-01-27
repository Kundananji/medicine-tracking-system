(function() {
    "use strict";

    $(document).ready(()=>{

        $('#form-login').on('submit',(e)=>{
            e.preventDefault();
            let username = $('#yourUsername').val();
            let password = $('#yourPassword').val();

            if(!username){
                alert('Please enter username');
                return;
            }

            if(!password){
                alert('Please enter password');
                return;
            }

            $.ajax({
                url:'ajax/login.php',
                type:'post',
                dataType:'json',
                data:{
                    username:username,
                    password:password,

                },
                success:(resp)=>{
                    if(resp){
                        if(resp.status =="success"){
                            alert('Logged in successfully');
                            window.location="index.php";
                        }
                        else{
                            alert('Invalid username or password');
                        }
                    }
                    else{
                        alert('Invalid username or password');
                    }
                },
                error:(resp)=>{
                    alert('Sorry, an error occurred');
                }
            });
        })

    });

})();