<?php 
include_once 'admin/admin_menu.php';


/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
add_action('wp_enqueue_scripts', 'teo_load_css');
if( !function_exists('teo_load_css') ) {
  function teo_load_css() {   
    wp_enqueue_style( 'ui-theme', get_template_directory_uri() . '/css/jquery-ui-theme.css', array(), '1.0');
    wp_enqueue_style( 'Ubuntu-font', 'http://fonts.googleapis.com/css?family=Ubuntu:400,300,700');
    wp_enqueue_script( 'jquery');
  }
}
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return home_url().'/index.php/profile/';
		} else {
			return home_url().'/index.php/profile/';
		}
	} else {
		return home_url().'/index.php/profile/';
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
add_action("wp_ajax_user_login", "login");
add_action("wp_ajax_nopriv_user_login", "login");
function login()
{
  extract($_POST);
   if( !email_exists( $email )) {
      $data = array();
      echo json_encode(array("url" => "2"));
      exit;
   }
   else{
      $userdata= get_user_by( 'email',$email);
      $creds = array();
      $creds['user_login'] =$userdata->user_login;
      $creds['user_password'] = $password;
      $creds['remember'] = true;
      $user = wp_signon ($creds, true);
      if ( is_wp_error($user) ){
	   echo json_encode(array("url" => "0"));
	   exit;
      }
      else{ 
          wp_set_current_user($user->ID);
          wp_set_auth_cookie($user->ID);
          get_currentuserinfo();
          $current_user = wp_get_current_user();
	 	  $data = array();  
          echo json_encode(array("url" => get_bloginfo('url') . '/profile/',
             "id" => $current_user->ID));
          exit;
     }
  }
        
}

add_action("wp_ajax_user_login_page", "login_page");
add_action("wp_ajax_nopriv_user_login_page", "login_page");
function login_page()
{
  extract($_POST);
   if( !email_exists( $email )) {
      $data = array();
      echo json_encode(array("url" => "2"));
      exit;
   }
   else{
      $userdata= get_user_by( 'email',$email);
      $creds = array();
      $creds['user_login'] =$userdata->user_login;
      $creds['user_password'] = $password;
      $creds['remember'] = true;
      $user = wp_signon ($creds, true);
      if ( is_wp_error($user) ){
	   echo json_encode(array("url" => "0"));
	   exit;
      }
      else{ 
          wp_set_current_user($user->ID);
          wp_set_auth_cookie($user->ID);
          get_currentuserinfo();
          $current_user = wp_get_current_user();
	 	  $data = array();  
          echo json_encode(array("url" => get_bloginfo('url') . '/profile/',
             "id" => $current_user->ID));
          exit;
     }
  }
        
}
//registre

add_action("wp_ajax_user_registration", "registration");
add_action("wp_ajax_nopriv_user_registration", "registration");
function registration()
{
	global $wpdb;
	extract($_POST);
	include_once(ABSPATH . 'wp-admin/includes/admin.php');
 	require_once( ABSPATH . '/wp-includes/pluggable.php');
	$query = "SELECT ID FROM wp_users WHERE user_email='".$email."'";
	$results1=$wpdb->get_results($query);
	$count=count($results1);
	if( $count>0) {
	       echo '2';
	       exit;
	}
    else if ($_SESSION['answer'] != $answer ) {
      echo '4';
      exit;
    }
    else{    	
      $sql=$wpdb->prepare('INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, 
    `user_nicename`, `user_email`, `display_name`)
     VALUES ("","'.$firstname.'","'.md5($password).'","'.$firstname.'","'.$email.'","'.$firstname.'")');
      $r=$wpdb->query($sql);
      if($r){
      	echo "1";
      	exit;
      }
    }
}
//popup reg
add_action("wp_ajax_user_registration_pop", "registration_pop");
add_action("wp_ajax_nopriv_user_registration_pop", "registration_pop");
function registration_pop()
{
	global $wpdb;
	extract($_POST);
	include_once(ABSPATH . 'wp-admin/includes/admin.php');
 	require_once( ABSPATH . '/wp-includes/pluggable.php');
	$query = "SELECT ID FROM wp_users WHERE user_email='".$email1."'";
	$results1=$wpdb->get_results($query);
	$count=count($results1);
	if( $count>0) {
	        echo json_encode(array("url" => "2"));
	       exit;
	}
    else if ($_SESSION['answer'] != $answer ) {
       echo json_encode(array("url" => "4"));
      exit;
    }
    else{    	
     $sql=$wpdb->prepare('INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, 
    `user_nicename`, `user_email`, `display_name`)
     VALUES ("","'.$firstname.'","'.md5($password1).'","'.$firstname.'","'.$email1.'","'.$firstname.'")');
      $r=$wpdb->query($sql);
      if($r){
      	$userdata= get_user_by( 'email',$email1);
	      $creds = array();
	      $creds['user_login'] =$userdata->user_login;
	      $creds['user_password'] = $password1;
	      $creds['remember'] = true;
	      $user = wp_signon ($creds, true);
	      if ( is_wp_error($user) ){
		   echo json_encode(array("url" => "0"));
		   exit;
	      }
	      else{ 
	          wp_set_current_user($user->ID);
	          wp_set_auth_cookie($user->ID);
	          get_currentuserinfo();
	          $current_user = wp_get_current_user();
		 	  $data = array();  
	          echo json_encode(array("url" => get_bloginfo('url') . '/profile/',
	             "id" => $current_user->ID));
	          exit;
      		}
   		 }
		}
	}
	add_action("wp_ajax_exit_id_details", "exit_id_details");
add_action("wp_ajax_nopriv_exit_id_details", "exit_id_details");
function exit_id_details()
{
	explode($_POST);
	global $wpdb,$current_user;	
	//print_r($_POST);	
	$rand_num=rand(999999,99999999999);
	// echo $rand_num;
	// echo $_POST['store'];
	$sql=$wpdb->prepare('INSERT INTO `exit_id_table` (`id`, `exit_id`, `user_id`,`retailer`,`url`,`cashback`)
     VALUES ("","'.$rand_num.'","'.$current_user->ID.'","'.$_POST['store'].'","","")');	
      $r=$wpdb->query($sql);
   
     // echo $r;
	//exit;
      if($r){
      	     echo $_POST['affurl'].'&aff_sub='.$rand_num;         
	          exit;
   		} 
   		else{
   			 echo "0";
	          exit;
   		}
}
/************************Forgot Password*********************************/
add_action("wp_ajax_forgot_password", "password");
add_action("wp_ajax_nopriv_forgot_password", "password");

function password()
{
    //extract($_POST);
    global $wpdb;
    $Email = $_POST['emailid'];
    $mail_check = $wpdb->get_var("SELECT Count(*) FROM {$wpdb->prefix}users WHERE user_email ='$Email'");
    //$success = false;
    echo $mail_check;
        if($mail_check==1) {
            $user = get_user_by( 'email', $Email );
            update_user_meta($user->ID,'email_flug','0');      
            $username = $user->user_login; 
            $to = 'cutepie.keya@gmail.com';
            $subject = "Password Help";
            $message = "Dear $username,<br />We understand you'd like to change your password. Just <a href=".site_url()."/forgot-password?e=".base64_encode($Email).">click here</a> and follow the prompts. And don't forget your password is case sensitive.";
            $from = "cutepie.keya@gmail.com";
            // $headers  = 'MIME-Version: 1.0' . "\n";
            // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            // $headers .= "From: $from";
           // wp_mail( 'me@example.net', 'The subject', 'The message' ); 
            if(wp_mail( $to,$subject,$message)){
               echo json_encode(1);
               exit;
            }
            else{
                echo json_encode(2);
                exit;
            }
         
        }
        else
        {
            echo json_encode(0);
            exit;
    
    
        }
}
add_filter( 'wp_mail_content_type', 'set_html_content_type' );

remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

function set_html_content_type() {
  return 'text/html';
}
/************************Change Password*********************************/
add_action("wp_ajax_update_password", "newpassword");
add_action("wp_ajax_nopriv_update_password", "newpassword");

function newpassword()
{
    global $wpdb;
    $mail = $_POST['mailid'];
    $f=$_POST['flug'];
   // print_r($_POST);
    $Email_check = $wpdb->get_var("SELECT Count(*) FROM {$wpdb->prefix}users WHERE user_email ='$mail'");
     $user = get_user_by( 'email', $mail );
    $newpassword = $_POST['newpassword'];
  // echo "UPDATE {$wpdb->prefix}users SET user_pass='$newpassword' where user_email='$mail'";
        if($Email_check) {
            $res2=wp_update_user( array ('ID' =>$user->ID,'user_pass' => $newpassword));

            if($res2)
            {
                update_user_meta($user->ID,'email_flug','2');      
                echo json_encode(1);
                exit;
            }
            
   }
        else
        {
            echo json_encode(0);
            exit;
    
    
        }
} 
?>