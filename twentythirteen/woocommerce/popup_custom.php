<!-- //popup code -->
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/custom.js"></script>

<div id="forgotpass-block-change" style="display:none">
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
  </form>
</div>

<div id="forgotpass-block" style="display:none">
  <div class="popup-box">
   <div id="error_msg2" style="color:red;font-size:15px;"></div>
    <div class="heading">Lost password</div>
      <div class="content-box">
      <p class="note1">Please enter your Email Address</p>
      <p class="notesub_forgot_pw12">Please check your email for a link to reset your password</p>
        <div class="input-box-holder">
           <form id="password_reset" method="post" action="">
          <input type="text" placeholder="Email" id="emailid" name="emailid" class="inputT" />
          <div class="button-box">
          <p class="loginBtn"><input type="button" value="Submit" name="sub_forgot_pw1" id="sub_forgot_pw1" class="sub_forgot_pw1"/></p>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>


<div id="register-block" style="display:none">
      <div class="regMainpage">
         <h1>Join FOR FREE!</h1>
          <div class="facebook-wrap-login">
            <div class="or-divider">OR</div>
            <div id="welcomemsg" style="color:green;"></div> 
            <div id="errortopmsg" style="color:red;"></div>  
          </div>  
           <div class="regInner">
      <form id="myForm" name="form2" method="post" action="">
        <input type="text" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>" placeholder="*First Name" name="firstname" id="firstname"/>
         <p class="error-msg errorfirstname"><?php if($errorfirstname) echo $errorfirstname;?></p>
        <input type="text" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname'];?>" placeholder="*Last Name" name="lastname" id="lastname"/>
        <p class="error-msg errorlastname"><?php if($errorlastname) echo $errorlastname;?></p>
        <input type="text" value="" placeholder="*Email" name="email1" id="email1"/>
        <p class="error-msg erroremail"><?php if($erroremail) echo $erroremail;?></p>
        <input type="password" value="" placeholder="*Password" name="password1" id="password1"/>
        <p class="error-msg errorpassword"><?php if($errorpassword) echo $errorpassword;?></p>
        <input type="password" value="<?php if(isset($_POST['cpassword'])) echo $_POST['cpassword'];?>" placeholder="*Confirm Password" name="cpassword" id="cpassword"/>
        <p class="error-msg errorcpassword"><?php if($errorcpassword) echo $errorcpassword;?></p>
        <div class="captcha-wrap">
          <div class="captcha-code">           
           <div  class="validation-code"> <?php 
           include 'captcha/captcha.php';?>
          <span class="math"><?php echo $math; ?></span><span class="e"> = </span><input name="answer" type="text"  id="answer"/>
           <p class="error-msg errorcaptcha"><?php if($errorcaptcha) echo $errorcaptcha;?></p>
         </div>
          </div>
        </div>
        <div class="term">
         
         <div class="term-check">
          <input type="checkbox" name="agree" value="1" id="agree" checked="checked"/>
          <p class="term-text">I agree to the <span class="termcon">Terms & Conditions</span></p>
          <p class="error-msg erroragree"><?php if($erroragree) echo $erroragree;?></p>
        </div>
          <div class="reg-submit-btn">
             <input type="button" value="JOIN FREE NOW" class="join buttom" name="registration" id="registration"/>
          </div>
      </div>
       
      </form>
    </div>
      </div>
</div>
<!-- //popup div -->
<div id="popupdiv" title="" style="display: none">
  <div class="top-popup">
    <div class="details-wrap-popup">
      <h4>JUST 1 STEP AWAY FROM GRABBING THIS DEAL</h4>
      <h2>NEW USERS, JOIN NOW</h2>
      <a class="button" id="reg-btn" href="#" rel="nofollow">JOIN TO GET EXTRA CASHBACK</a>
    <ul class="fw clearfix"><li class="pos"><strong>GET CASHBACK WHEN YOU SHOP VIA US</strong></li><li class="pos"><strong>500+ PARTNER SITES</strong></li></ul>
    </div>
    <div class="login-wrap">
      <h3>EXISTING USERS, LOGIN</h3>
      <div class="error"></div>
       <form method="post" action="#">
        <input type="text" name="email" id="email" value="" placeholder="Email" onfocus="" onblur="" />
        <input type="password" name="password" id="password" value="" placeholder="Password" onfocus="" onblur=""  />
        <a href="#" class="forgotpass" id="forgotpass">Forgot Password? </a>
        <input type="submit" name="login" id="login" value="Sign in" class="login" />
      </form>
    </div>
  </div>
  <div class="buttom-popup">
    <a id="without" href="">ELSE CONTINUE WITHOUT CASHBACK</a>
  </div>
</div>