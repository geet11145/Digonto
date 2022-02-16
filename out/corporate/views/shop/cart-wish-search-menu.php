<script>
$(document).ready(function(){
$("#search").keyup(function(){
var searchQuery = $(this).val();
if(searchQuery != '')  
{
$.ajax
({
type: "POST",
url: "<?php echo outCorporateLink; ?>/autosuggestion_corporate.php",
data: "searchQuery="+ searchQuery,
success: function(data)
{
$('#match-list').fadeIn();
$('#match-list').html(data);
}
});
}
else
{
$('#match-list').fadeOut();
$('#match-list').html('');
}
});

$(document).on('click','li',function()
{
$('#search').val($(this).text());
$('#match-list').fadeOut();
});

});
</script>
<?php include_once (ebcorporate.'/corporate.php'); ?>
<?php include_once (ebformkeys.'/valideForm.php'); ?>
<?php $formKey = new ebapps\formkeys\valideForm(); ?>
<?php
/* Initialize valitation */
$error = 0;
$formKey_error = "";
$search_project_error = "*";
?>
<?php
/* Data Sanitization */
include_once(ebsanitization.'/sanitization.php'); 
$sanitization = new ebapps\sanitization\formSanitization();
?>

<?php
if(isset($_REQUEST['submit_search_project']))
{
extract($_REQUEST);

/* Form Key*/
if(isset($_REQUEST["form_key"]))
{
$form_key = preg_replace('#[^a-zA-Z0-9]#i','',$_POST["form_key"]);
if($formKey->read_and_check_formkey($form_key) == true)
{

}
else
{
$formKey_error = "Sorry the server is currently too busy please try again later.";
$error = 1;
}
}

/* search_project */
if (empty($_REQUEST["search_project"]))
{
$search_project_error = "Keyword required";
$error =1;
} 
/* valitation search_project  */
elseif (! preg_match("/^([A-Za-z ]+){2,48}$/",$search_project))
{
$search_project_error = "Keyword required only letters are allowed";
$error =1;
}
else 
{
$search_project = $sanitization -> test_input($_POST["search_project"]);
}
?>
<?php } ?>
<div class='col-lg-7 col-md-5 col-sm-5 col-xs-3 hidden-xs category-search-form'>
<div class='search-box'>
<form id='search_mini_form' method='post'>
<select name='cat' id='cat' class='cate-dropdown hidden-sm hidden-md'>
<option value=''>All Categories</option>
<?php
$category = new ebapps\corporate\corporate();
$category ->menu_category_project();
?>
<?php if($category->data >= 1) { ?>
<?php foreach($category->data as $catval): extract($catval); ?>
<?php if (!empty($project_category)){ ?>
<option value='<?php echo $project_category; ?>'><?php echo ucfirst($category->visulString($project_category)); ?></option>
<?php } ?>
<?php endforeach; } ?>
</select>
<!-- Autocomplete End code -->
<input id='search' type='text' name='search_project' value='' class='searchbox' required />
<input type='hidden' name='form_key' value='<?php echo $formKey->outputKey(); ?>'>
<button type='submit' name='submit_search_project' title='Search' class='search-btn-bg' id='submit-button'><span>Search</span></button>
</form>
<div id='match-list'></div>
</div>
</div>
<div class='col-lg-3 col-md-4 col-sm-4 col-xs-12 card_wishlist_area'>
<div class='mm-toggle-wrap'>
<div class='mm-toggle'><i class='fa fa-align-justify'></i><span class='mm-label'>Menu</span> </div>
</div>
<!-- mgk home -->
<div class='mgk-ebhome'><a title='My Home' href='<?php echo outCorporateLink; ?>/project.php'><i class='fa fa-home'></i><span class='title-ebhome hidden-xs'></span></a></div>
<!-- mgk wishlist -->
<div class='mgk-wishlist'><a title='My Wishlist' href='<?php echo outCorporateLink; ?>/project/wishlist/'><i class='fa fa-heart'></i><span class='title-wishlist hidden-xs'></span></a></div>
</div>