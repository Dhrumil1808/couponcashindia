jQuery( document ).ready(function() {
  ///
    jQuery("#sub_forgot_pw1").click(function(){
  var check = true;
        var emailPattern = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var email2 = jQuery("#emailid").val();
  jQuery("#error_msg2").text("");
  if (email2 == '') {
     jQuery("#error_msg2").text("Please Enter your Email Address");
     //return false;
        }
        else if(!emailPattern.test(email2)){
    jQuery("#error_msg2").text("Invalid Email Address");
    //return false;
        }
  else{
    jQuery.ajax({
    type: "POST",
    url: 'http://couponcashindia.com/wp-admin/admin-ajax.php',
    
    data: {"emailid":email2,"action":'forgot_password'},
    dataType: "json",
    success: function(response){
        if(response==0)
        {
      jQuery("#error_msg2").html("Email is not registered");
        }
        else if(response==2)
        {
     jQuery("#error_msg2").html("Email is not sent");
        }
        else 
        {
      //$("#error_msg2").html("Please check your email for a link to reset your password");
     jQuery("#emailid").hide();
      jQuery("#sub_forgot_pw1").hide();
      jQuery(".note1").hide();
     jQuery(".note2").show();
        }
    } 
      }); 
  }
 

    });
  
   jQuery("body").on('click', '#forgotpass', function () {
       jQuery("#forgotpass-block").dialog({ 
        width: 400,
        height: 500,
        modal: true,
          buttons: {
            Close: function() {
              jQuery(this).dialog('close');
            // jQuery.removeCookie('product-url');
            }
          }
    });
   });
   jQuery("body").on('click', '#aff-click', function () {
     var affurl=jQuery(this).attr('aff-url');

     var store=jQuery(this).attr('store');
     jQuery.ajax({
      url:'http://couponcashindia.com/wp-admin/admin-ajax.php',   
          type: 'post',
      cache: false,
          data :{ action:'exit_id_details',affurl:affurl,store:store},
           beforeSend: function(){
                 jQuery('#loading').show();
              },
          success:function(response) {
            jQuery('#loading').hide();   
             if(response==0)
            {

            }   
            else{
              //alert(response);
             window.location.href=response;
            } 
        }
     });
   });
   jQuery("body").on('click', '#reg-btn', function () {
    jQuery("#popupdiv").dialog('close');
    var url=jQuery(this).attr('url');
    jQuery("#without").attr('href',url);
     jQuery.cookie("product-url", url); 
  jQuery("#register-block").dialog({ 
    width: 400,
    height: 500,
    modal: true,
      buttons: {
        Close: function() {
          jQuery(this).dialog('close');
         jQuery.removeCookie('product-url');
        }
      }
    });
  });
  // alert( jQuery.cookie("product-url") );
  jQuery("body").on('click', '#btnclick', function () {
  var url=jQuery(this).attr('url');
  jQuery("#without").attr('href',url);
   jQuery.cookie("product-url", url); 
  jQuery("#popupdiv").dialog({    
    width: 900,
    height: 650,
    modal: true,
      buttons: {
        Close: function() {
          jQuery(this).dialog('close');
          jQuery.removeCookie('product-url');
        }
      }
    });
  });
})

jQuery(document).ready(function(e){
   jQuery("#agree").prop("checked");
    jQuery("#agree").prop("checked");
  //for firstname
  jQuery('#firstname').blur(function(){
    if(jQuery('#firstname').val() == ''){
      jQuery('#firstname').val('Please type your firstname');
      jQuery("#firstname").addClass("error-msg");
    }
  });
  jQuery('#firstname').click(function(){
    if(jQuery('#firstname').val() == 'Please type your firstname'){
      jQuery('#firstname').val('');
      jQuery("#firstname").removeClass("error-msg");
    }
  });
  //for lastname
  jQuery('#lastname').blur(function(){
    if(jQuery('#lastname').val() == ''){
      jQuery('#lastname').val('Please type your lastname');
      jQuery("#lastname").addClass("error-msg");
    }
  });
  jQuery('#lastname').click(function(){
    if(jQuery('#lastname').val() == 'Please type your lastname'){
      jQuery('#lastname').val('');
      jQuery("#lastname").removeClass("error-msg");
    }
  });  
   //for email
  jQuery('#email1').blur(function(){
    if(jQuery('#email1').val() == ''){
      jQuery('#email1').val('Please type your email');
      jQuery("#email1").addClass("error-msg");
    }
  });
  jQuery('#email1').click(function(){
    if(jQuery('#email1').val() == 'Please type your email'){
      jQuery('#email1').val('');
      jQuery("#email1").removeClass("error-msg");
    }
  });
   //for Email In Use!  
  jQuery('#email1').click(function(){
    if(jQuery('#email1').val() == 'Email in use!'){
      jQuery('#email1').val('');
      jQuery("#email1").removeClass("error-msg");
    }
  });
   //for password
  jQuery('#password1').blur(function(){
    if(jQuery('#password1').val() == ''){
      jQuery('#password1').val('Please type your password');
      jQuery('#password1').removeAttr("type");
      jQuery('#password1').attr('type', 'text');
      jQuery("#password1").addClass("error-msg");
    }
  });
  jQuery('#password1').click(function(){
    if(jQuery('#password1').val() == 'Please type your password'){
      jQuery('#password1').val('');
      jQuery('#password1').removeAttr("type");
      jQuery('#password1').attr('type', 'password');
      jQuery("#password1").removeClass("error-msg");
    }
  });
   //for confirm password
  jQuery('#cpassword').blur(function(){
    if(jQuery('#cpassword').val() == ''){
      jQuery('#cpassword').val('Please type your confirm password');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'text');
      jQuery("#cpassword").addClass("error-msg");
    }
  });
  jQuery('#cpassword').click(function(){
    if(jQuery('#cpassword').val() == 'Please type your confirm password'){
      jQuery('#cpassword').val('');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'password');
      jQuery("#cpassword").removeClass("error-msg");
    }
  });
    //for Password does not match
  jQuery('#cpassword').blur(function(){
    if(jQuery('#cpassword').val() == 'Password does not match'){
      jQuery('#cpassword').val('Password does not match');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'text');
      jQuery("#cpassword").addClass("error-msg");
    }
  });
  jQuery('#cpassword').click(function(){
    if(jQuery('#cpassword').val() == 'Password does not match'){
      jQuery('#cpassword').val('');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'password');
      jQuery("#cpassword").removeClass("error-msg");
    }
  });
      //for answer
  jQuery('#answer').blur(function(){
    if(jQuery('#answer').val() == 'Please enter valid number' || jQuery('#answer').val() == ''){
      jQuery('#answer').val('Please enter valid number');
      jQuery("#answer").addClass("error-msg");
    }
  });
  jQuery('#answer').click(function(){
    if(jQuery('#answer').val() == 'Please enter valid number'){
      jQuery('#answer').val('');
      jQuery("#answer").removeClass("error-msg");
    }
  });
      //for answer
  jQuery('#answer').blur(function(){
    if(jQuery('#answer').val() == 'Value entered is wrong' || jQuery('#answer').val() == ''){
      jQuery('#answer').val('Value entered is wrong');
      jQuery("#answer").addClass("error-msg");
    }
  });
  jQuery('#answer').click(function(){
    if(jQuery('#answer').val() == 'Value entered is wrong'){
      jQuery('#answer').val('');
      jQuery("#answer").removeClass("error-msg");
    }
  });
jQuery('#registration').click( function() {
    
   jQuery(".error-msg").html("");
   jQuery("#firstname").removeClass("error-msg");
    jQuery("#lastname").removeClass("error-msg");
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(jQuery("#firstname").val()=='' || jQuery("#firstname").val()=='Please type your firstname')
    {
      jQuery("#firstname").val('Please type your firstname');
      jQuery("#firstname").addClass("error-msg");
    }
    if(jQuery("#lastname").val()=='' || jQuery("#lastname").val()=='Please type your lastname')
    {
      jQuery("#lastname").val('Please type your lastname');
      jQuery("#lastname").addClass("error-msg");
    }
    if(jQuery("#email1").val()=='' || jQuery("#email1").val()=='Please type your email')
    {
      jQuery("#email1").val('Please type your email');
      jQuery("#email1").addClass("error-msg");
    }   
    if(jQuery("#password1").val()=='' || jQuery("#password1").val()=='Please type your password')
    {
      jQuery("#password1").val('Please type your password');
      jQuery('#password1').removeAttr("type");
      jQuery('#password1').attr('type', 'text');
      jQuery("#password1").addClass("error-msg");
    }  
    if(jQuery("#cpassword").val()=='' || jQuery("#cpassword").val()=='Please type your confirm password')
    {
      jQuery("#cpassword").val('Please type your confirm password');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'text');
      jQuery("#cpassword").addClass("error-msg");
    }   
    if(jQuery("#cpassword").val()=='' || jQuery("#cpassword").val()=='Password does not match')
    {
      jQuery("#cpassword").val('Password does not match');
      jQuery('#cpassword').removeAttr("type");
      jQuery('#cpassword').attr('type', 'text');
      jQuery("#cpassword").addClass("error-msg");
    }   
    if(jQuery("#answer").val()=='' || jQuery("#answer").val()=='Please enter valid number')
    {
      jQuery("#answer").val('Please enter valid number');
      jQuery("#answer").addClass("error-msg");
    }    
     if (!jQuery("#agree").prop("checked"))
    {
        jQuery(".erroragree").html("Please read and agree to the Terms & Conditions");
        return false;
    }
  else{
     var url=jQuery("#btnclick").attr('url');
    var dataString=jQuery('#myForm').serialize();
    jQuery(".error-msg ").html("");
     jQuery.ajax({
      url:'http://couponcashindia.com/wp-admin/admin-ajax.php',  
        cache: false,
        type: 'post',
        dataType: 'json',
        data :'action=user_registration_pop&' +dataString,
        success: function(response) {
          if(response.url==0)
          {
            jQuery("#errortopmsg").html('Registration Fail!');
            return false;
          }
          else if(response.url==2)
          {     
            jQuery("#email1").val('Email in use!');
            jQuery("#email1").addClass("error-msg");
            return false;
          }
          else if(response.url==3)
          {
            jQuery("#answer").val('Please enter valid number');
            jQuery("#answer").addClass("error-msg");
            return false;
          }
          else if(response.url==4)
          {
            jQuery("#answer").val('Value entered is wrong');
            jQuery("#answer").addClass("error-msg");
            return false;
          }
         
           else
           {
                jQuery("input[type=text],input[type=password]").val("");
                jQuery("#welcomemsg").html('Thank you for Your Registration !');                
                 //window.location = "" 
                 jQuery("#popupdiv").dialog('close');
                window.location.href=jQuery.cookie("product-url")+'&aff_sub='+response.id;
                jQuery.removeCookie('product-url');
                 return false;           
          }
        
       }
    });
 }
});
jQuery("#login").click(function(e) {
   e.preventDefault();
  var email = jQuery("#email").val();   
  var password = jQuery("#password").val();
   var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 if(email=='')
  {
    jQuery(".error").html("Enter email");
  }
  else if(!regex.test(email))
  {
    jQuery(".error").html("Invalid Email Address");
  }
  else if(password=='')
  {
    jQuery(".error").html("Enter password");
  }
  else{  
        
        var url=jQuery("#btnclick").attr('url');
        jQuery.ajax({
  url:'http://couponcashindia.com/wp-admin/admin-ajax.php',   
        type: 'post',
        dataType: 'json',
        data :{ action:'user_login', email:email,password:password },
            success:function(response) {
              if(response.url==0)
              {
                jQuery(".error").html("Username or Password not match!");
                jQuery("#password").val('');
              }
              else if(response.url==2)
              {
                jQuery(".error").html("Invalid Username !");
                jQuery("#password").val('');
              }
              else
              {                
                jQuery("#email").val('');   
                jQuery("#password").val('');
                jQuery("#popupdiv").dialog('close');
                if(jQuery.cookie("product-url"))
                {
                   window.location.href=jQuery.cookie("product-url")+'&aff_sub='+response.id;
                  jQuery.removeCookie('product-url');
                }
                else{
                  location.reload(); 
                }
               
              }
          }
       });
  }
});
});

jQuery(document).ready(function(){
    jQuery("#update_password").click(function(){
  
  var check = true;
  var mailid=jQuery("#mailid").val();
        var newPassword = jQuery("#newpassword").val();
       var f = jQuery("#f").val();
       
  var newConfirmPassword = jQuery("#confirmnewpassword").val();
  
  jQuery("#error_msg").text("");
  if (newPassword == '') {
     jQuery("#error_msg").text("Enter password");
        }
        else if(newConfirmPassword == ''){
    jQuery("#error_msg").text("Enter confirm password");
        }
   else if(newConfirmPassword !=newPassword){
    jQuery("#error_msg").text("Password not match");
        }
  else{
    jQuery.ajax({
    type: "POST",
    url: 'http://couponcashindia.com/wp-admin/admin-ajax.php',
    
    data: {"newpassword":newPassword,"mailid":mailid,"flug":f,"action":'update_password'},
    dataType: "json",
    success: function(response){
        if(response==0)
        {
      jQuery("#error_msg").html("Your Email Address is not registered");
        }
        else 
        {
     jQuery("#error_msg").html("Congratulations You have successfully changed your password");
      jQuery("#update_password").hide();
      jQuery("#sign_in").show();
        }
    } 
      }); 
  }
 

    });
});