 $(document).ready(function () {
alert("THis is document.ready");
 }),
 $(window).load(function () {
    alert("THis is window.load");
     }),
$(document).ready(function()
{
    $(document).on('click','#login_button',function()
    {
        $('#login_form').validate({ 
            rules: 
            {
                useremail:
                {
                    required:true,
                    email:true
                },
                password:"required"
            },
            messages:
            {
                useremail:
                {
                    required:"Please enter email",
                    email:"Please enter valid email"
                },
                password:"Please enter password"
            },
            submitHandler: function(form,e)
            {
                e.preventDefault();
                var url = "http://192.168.20.246/codeigniterproject/codeigniter/index.php/login/verify";
                swal({
                    
                    title: "Are you sure?",
                    text: "You want to login",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, login!",
                    cancelButtonText: "No, stay in the page",
                     closeOnConfirm: false,
                     closeOnCancel: false
                },
                function(isConfirm) 
                {
                    if (isConfirm) 
                    {      
                        $.ajax
                        ({
                        type: "POST",
                        url: url,
                        data: $("#login_form").serialize(), // serializes the form's elements.
                        success: function(msg)
                        {
                            if(msg=="success")
                            {  
                             
                            swal("loggedin", "You are successfully logged in", "success");          
                            window.location.href = "http://192.168.20.246/codeigniterproject/codeigniter/index.php/home";
                            }
                            else
                            {
                            swal("The username/password  you entered is incorrect", "ok ", "error");
                            }
                        }
                        });
                    }
                })
            }
        })
    }),
    
    $(document).on('click','#add_button',function()
    {
        $('#add_user_form').validate({
            rules:
            {
                username:"required",
                email:
                {
                    required:true,
                    email:true
                },
                password:"required",
                confirmpassword:
                {
                    required:true,
                    equalTo:"#pass"
                },
                department:"required",
                designation:"required"
            },
            messages:
            {
                username:"Please enter username",
                email:
                {
                    required:"Please enter email",
                    email:"Please enter valid email"
                },
                password:"Please enter password",
                confirmpassword:
                {
                    required:"Please enter confirm password",
                    equalTo:"Confirm password and password are not equal"
                },
                department:"Please enter departmemnt",
                designation:"Please enter designation"
            },
            // submitHandler: function(form,e){
            //     e.preventDefault();
            //     var url = "http://192.168.20.245/codeigniter/index.php/home/do_upload/";    
            //     $.ajax({
            //         type: "POST",
            //         url: url,
            //         data: $("#update_user_form").serialize(), // serializes the form's elements.
            //         success: function(msg)
            //         {
            //             console.log(msg);
            //             if($.trim(msg)=="success")
            //             {  
            //                 alert('success');            
            //                 window.location.href = "http://192.168.20.245/codeigniter/index.php/home/fetch_user";
            //             }
            //             else
            //             {
            //                 alert('Enter correct details');
            //             }
            //         }
            //     });
            // }
        });
    }),
    $(document).on('click','#update_button',function()
    {
        $('#update_user_form').validate({
            rules:
            {
                username:"required",
                department:"required",
                designation:"required"
            },
            messages:
            {
                username:"Please enter username",
                department:"Please enter departmemnt",
                designation:"Please enter designation"
            },
            submitHandler: function(form,e){
                e.preventDefault();
                var url = "http://192.168.20.246/codeigniterproject/codeigniter/index.php/home/update_now/";  
                swal({
                    
                    title: "Are you sure?",
                    text: "You want to submit",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                     closeOnConfirm: true,
                     closeOnCancel: true
                }, 
                
                function(isConfirm) 
                {
                    if (isConfirm) 
                    {      
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#update_user_form").serialize(), // serializes the form's elements.
                    success: function(msg)
                    {
                        if($.trim(msg)=="success")
                        {  
                           // alert('success');            
                            window.location.href = "http://192.168.20.246/codeigniterproject/codeigniter/index.php/home/fetch_user";
                        }
                        else
                        {
                            alert('Enter correct details');
                        }
                    }
                });
            }
         })
        }
    })
    }),

    $("#countryid").change(function() {
        var country_id = {"country_id" : $('#countryid').val()};
        console.log(country_id);

        $.ajax({
            type: "POST",
            data: country_id,
            url: "http://192.168.20.246/codeigniterproject/codeigniter/index.php/home/ajax_state_list/",
            success: function(data){
                $('#state').html(data);
            }
        })
    }),

    $("#state").change(function() {
        var state_id = {"state_id" : $('#state').val()};
        console.log(state_id);

        $.ajax({
            type: "POST",
            data: state_id,
            url: "http://192.168.20.246/codeigniterproject/codeigniter/index.php/home/ajax_city_list/",
            success: function(data){
                $('#city').html(data);
            }
        })
    })


    $(document).ready(function () {
        $('#table_id').dataTable({
        "pagingType": "full_numbers",
        })
    });




 


})




