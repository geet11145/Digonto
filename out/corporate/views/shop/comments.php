<?php
if(isset($projectid))
{ 
if(isset($_SESSION['memberlevel']))
{
if($_SESSION['memberlevel']<=8)
{
include_once ('query-visitor.php'); 
}
elseif($_SESSION['memberlevel']>=9)
{
include_once ('query-admin.php'); 
}
}
else
{
echo "<b>You have to Signin to Query</b><br />";
}
}
?>
<?php
$obj = new ebapps\corporate\corporate();
$obj->read_all_project_query($projectid);
if($obj->data >= 1)
{
foreach($obj->data as $val)
{
extract($val);

$queryMe  ="<div class='well'>";
$queryMe .="By <a href='".outCorporateLink."/project/writer/$eb_corporates_username/'>$eb_corporates_username</a> on ".date('d M Y',strtotime($eb_corporates_comment_date));
$queryMe .="<p>$eb_corporates_comment_details</p>";
$queryMe .="</div>"; 
echo $queryMe; 
 
}
}
?>