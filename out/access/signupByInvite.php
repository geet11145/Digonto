<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php include_once (eblayout.'/a-common-header-icon.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-noindex.php'); ?>
<?php include_once (eblayout.'/a-common-header-title-one.php'); ?>
<?php include_once (eblayout.'/a-common-header-meta-scripts.php'); ?>
<?php include_once (eblayout.'/a-common-page-id-start.php'); ?>
<?php include_once (eblayout.'/a-common-header.php'); ?>
<nav>
  <div class='container'>
    <div>
      <?php include_once (eblayout.'/a-common-navebar.php'); ?>
      <?php include_once (eblayout.'/a-common-navebar-index-blog.php'); ?>
    </div>
  </div>
</nav>
<?php include_once (eblayout.'/a-common-page-id-end.php'); ?>
<div class='container'>
  <div class='row row-offcanvas row-offcanvas-right'>
    <div class='col-xs-12 col-md-2'>
    
    </div>
    <div class='col-xs-12 col-md-7 sidebar-offcanvas'>
    <div class='well'>
        <h2 title='Sign Up by Invite'>Sign Up by Invite</h2>
      </div>
    <div class='well'>
        <?php include_once (eblogin.'/registration_page.php'); ?>
        <?php include_once (ebHashKey.'/hashPassword.php'); ?>
        <script language='javascript' type='text/javascript'>
$(document).ready(function()
{
  $("#selectCountry").change(function()
  {
    var pic_name = $(this).val();
	if(pic_name != '')  
	 {
	  $.ajax
	  ({
	     type: "POST",
		 url: "access_to_get_country_code.php",
		 data: "pic_name="+ pic_name,
		 success: function(data)
		 {
		   $("#selectedCountry").val(data);
		 }
	  });
	 }
	return false;
  });
});
</script>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = '';
$full_name_error = "*";
$code_mobile_error = "*";
$ebusername_error = '*';
$password_error = '*';
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>
<?php
if (isset($_REQUEST['register']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST['form_key']))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST['form_key']);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "<b class='text-warning'>Sorry the server is currently too busy please try again later.</b>";
$error = 1;
}
}
/* Full name */
if (empty($_REQUEST["full_name"]))
{
$full_name_error = "<b class='text-warning'>Name required</b>";
$error =1;
} 

elseif(!preg_match("/^[[A-Za-z.,\-\ ]{3,32}$/",$full_name))
{
$full_name_error = "<b class='text-warning'>Full Name?</b>";
$error =1;
}
else 
{
$full_name = $sanitization->test_input($_POST["full_name"]);
}
/* eMail */
/* valitation eMail  Tested allow (info@bd.com)(info234_bd@google.com)*/
if (! preg_match('/^[A-Za-z0-9._]+@[A-Za-z0-9.\-]{1,16}[a-z]{3,4}$/',$email))
{
$email_error = "<b class='text-warning'>eMail?</b>";
$error =1;
}
else
{
$email = $sanitization->test_input($_POST['email']);
}
/* selectCountryVal */
if (isset($_REQUEST['selectCountryVal']))
{
$selectCountryVal = $_POST['selectCountryVal'];
$countryOfSignup = new ebapps\login\registration_page();
$countryOfSignup->selectedCountryAndCodeWhenSignup($selectCountryVal);
if($countryOfSignup->data)
{
foreach($countryOfSignup->data as $valcountryOfSignup)
{
extract($valcountryOfSignup);
$countryNameWhenSignup = $country_name;
$countryCode = intval(substr($country_code, 0, 1)); 
}
}
}
$codeCheckInMobile = intval(substr($_POST["code_mobile"], 0, 1));
/* Mobile */
if (empty($_REQUEST["code_mobile"]))
{
$code_mobile_error = "<b class='text-warning'>Mobile number required</b>";
$error =1;
} 

elseif (!preg_match("/^[0-9]{3,16}$/",$code_mobile))
{
$code_mobile_error = "<b class='text-warning'>Mobile Number?</b>";
$error =1;
}
elseif ($codeCheckInMobile != $countryCode)
{
$code_mobile_error = "<b class='text-warning'>Country Code?</b>";
$error =1;
}
else 
{
$code_mobile = $sanitization->test_input($_POST["code_mobile"]);
}
/* ebusername */
if (empty($_REQUEST['ebusername']))
{
$ebusername_error = "<b class='text-warning'>ebusername required.</b>";
$error =1;
}
/* valitation ebusername Tested allow (zakir)(zakir333)(zakir_9us2)*/
elseif(! preg_match('/^[A-Za-z0-9]{3,32}$/',$ebusername))
{
$ebusername_error = "<b class='text-warning'>ebusername?</b>";
$error =1;
}
else
{
$ebusername = $sanitization->test_input($_POST['ebusername']);
}
/* password */
if (empty($_REQUEST['password']))
{
$password_error = "<b class='text-warning'>Password required.</b>";
$error =1;
}
/* valitation password  Tested allow (344@dd!%#.,ABad)*/
elseif (! preg_match('/^[A-Za-z0-9\-\.\,\_\[\]\+\=\)\(\*\&\^\%\$\#\@\!]{3,32}$/',$password))
{
$password_error = "<b class='text-warning'>Minimum 3 characters.</b>";
$error =1;
}
else
{
$password = $sanitization->test_input($_POST['password']);
}

/* Submition form */
if($error ==0)
{
extract($_REQUEST);
//
$ha = new ebapps\hashpassword\hashPassword();
$pass = $ha -> hashPassword($password);
$password = $pass;
/*** ***/ 
$generate_email_hash_formate = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$generated_new_email_hash = ''; 
for ($i = 0; $i < 40; $i++)
{
$generated_new_email_hash .= $generate_email_hash_formate[rand(0, strlen($generate_email_hash_formate)-1)];
}
$emailhash = $generated_new_email_hash;
/*** ***/ 
$user = new ebapps\login\registration_page();
$user->registrationInvitedSignup($full_name, $code_mobile, $ebusername, $password, $email, $emailhash, $signup_date, $user_ip_address, $countryNameWhenSignup);
}
}
?>
<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
$ip_user=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
$ip_user=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
$ip_user=$_SERVER['REMOTE_ADDR'];
}
?>
        <form method='post'>
          <fieldset class='group-select'>
            <input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
            <?php echo $formKey_error; ?>
            <input type='hidden' name='signup_date' value='<?php echo date('r'); ?>' />
            <input type='hidden' name='user_ip_address' value='<?php echo $ip_user; ?>' />
            <input class='form-control' type='hidden' name='email' value='<?php echo $_GET['email']; ?>' required />
            
            <div class='input-group'>
            <span class='input-group-addon' id='sizing-addon2'>Full Name <?php echo $full_name_error;  ?></span>
            <input type='text' name='full_name' placeholder='Your name' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
            </div>
            <div class='input-group'>
            <span class='input-group-addon' id='sizing-addon2'>Country: </span>
            <select id='selectCountry' class='form-control' name='selectCountryVal'>
            <option>Select Country</option>
            <?php
            $country = new ebapps\login\registration_page();
            $country->select_country_id();
            ?>
            </select>
            </div>
            <div class='input-group'>
            <span class='input-group-addon' id='sizing-addon2'>Mobile <?php echo $code_mobile_error;  ?></span>
            <input class='form-control' id='selectedCountry' type='text' name='code_mobile' required  autofocus />
            </div>
            
            
            <div class='input-group'>
            <span class='input-group-addon' id='sizing-addon2'>Username: <?php echo $ebusername_error;  ?></span>
            <input type='text' name='ebusername' placeholder='ebusername' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
            </div>
            
            
            <div class='input-group'>
            <span class='input-group-addon' id='sizing-addon2'>Password: <?php echo $password_error;  ?></span>
            <input type='password' name='password' placeholder='password' class='form-control' aria-describedby='sizing-addon2' required  autofocus>
            </div>
            
            <div class='buttons-set'>
              <button type='submit' name='register' title='Signup' class='button submit'> <span> Signup </span> </button>
            </div>
          </fieldset>
        </form>
      </div> 
    </div>
    <div class='col-xs-12 col-md-3 sidebar-offcanvas'>
    
    </div>
  </div>
</div>
<?php include_once (eblayout.'/a-common-footer.php'); ?>
