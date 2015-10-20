<?php
/*
Template Name: Forget Password
*/
?>
<?php

global $post;
global $wpdb;
$Emailencode = $_GET['e'];
			   $Emaildecode = base64_decode($Emailencode);
				$s=$_GET['s'];
				$user = get_user_by( 'email', $Emaildecode );
				// print_r($user);
				// echo 'zxdf'.get_user_meta($user->ID,'email_flug',true);

				if(get_user_meta($user->ID,'email_flug',true)==2)
				{
					echo "link disable";
					die;
				}
				get_header();
?>
<script>
$(document).ready(function(){
	$("#sign_in").hide();
    $("#update_password").click(function(){
	
	var check = true;
	var mailid=$("#mailid").val();
        var newPassword = $("#newpassword").val();
       var f = $("#f").val();
       
	var newConfirmPassword = $("#confirmnewpassword").val();
	
	$("#error_msg").text("");
	if (newPassword == '') {
	   $("#error_msg").text("Enter password");
        }
        else if(newConfirmPassword == ''){
		$("#error_msg").text("Enter confirm password");
        }
	 else if(newConfirmPassword !=newPassword){
		$("#error_msg").text("Password not match");
        }
	else{
		$.ajax({
		type: "POST",
		url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
		
		data: {"newpassword":newPassword,"mailid":mailid,"flug":f,"action":'update_password'},
		dataType: "json",
		success: function(response){
		    if(response==0)
		    {
			$("#error_msg").html("Your Email Address is not registered");
		    }
		    else 
		    {
			$("#error_msg").html("Congratulations You have successfully changed your password");
			$("#update_password").hide();
			$("#sign_in").show();
		    }
		} 
	    }); 
	}
 

    });
});
</script>
<!-- Body Starts -->

	<div id="body">

		
			<div class="overview_content">
			       <h1>Change Password</h1>
			      <form id="password_update" method="POST" action="">
				<div id="error_msg" style="color:red;font-size:15px;"></div>
			       <table>
			     <tr>
			       <td>Enter your new password:</td>
			       <td><input type="password" size="10" name="newpassword" id="newpassword"></td>
			       </tr>
			       <tr>
			      <td>Re-enter your new password:</td>
			      <td><input type="password" size="10" name="confirmnewpassword" id="confirmnewpassword"></td>
			       </tr>
			       <input type="hidden" name="mailid" id="mailid" value="<?php echo $Emaildecode ;?>"/>
			       <input type="hidden" name="f" id="f" value="<?php echo $s ;?>"/>
			       </table>
			       <input type="button" value="Update Password" name="update_password" id="update_password">
			       <a href="<?php echo site_url(); ?>/login"><input type="button" value="Sign in "id="sign_in"></a>
			       </form>
	</div>

	<!-- Body Ends -->
<?php		
get_footer();
?>
