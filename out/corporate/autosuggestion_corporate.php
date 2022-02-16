<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once (ebbd."/connection.inc.php");
if(isset($_POST['searchQuery'])  && $_POST['searchQuery'] != '')
{
$outPut = "";
//
$query  ="SELECT";
$query .=" project_id,";
$query .=" project_og_small_image_url,";
$query .=" project_og_image_title";
$query .=" FROM eb_corporate_project";
$query .=" WHERE";
$query .=" project_approved = 1";
$query .=" AND project_og_image_title LIKE '%".$_POST['searchQuery']."%'";
$query .=" ORDER BY project_id DESC";
//
$result = $connectdb -> query($query);
$outPut = "<ul class='list-group'>";
if($result)
{
while($row = $result->fetch_array())
{ 
$outPut .= "<li class='list-group-item'><img class='search-img' src='".hypertextWithOrWithoutWww.$row['project_og_small_image_url']."' />".$row['project_og_image_title']."</li>";
}
$result -> free_result();
}
else
{
$outPut .= "<li class='list-group-item'>Nothing Found</li>";
}
$outPut .= "</ul>";
$connectdb -> close();
echo $outPut;
}
?>