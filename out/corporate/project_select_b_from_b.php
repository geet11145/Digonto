<?php include_once (dirname(dirname(dirname(__FILE__))).'/initialize.php'); ?>
<?php
include_once(ebbd.'/connection.inc.php');
include_once (ebcorporate.'/corporate.php');
$obj = new ebapps\corporate\corporate();
if(isset($_POST['pic_name']) && $_POST['pic_name'] != '')
{
$pic_name = $_POST['pic_name'];
$query = "SELECT * FROM ";
$query .= "eb_corporate_sub_category ";
$query .= "where project_category_in_eb_corporate_sub_category='".$pic_name."'";
$result = $connectdb -> query($query);
if($result)
{
while($row = $result->fetch_array())
{
echo "<option value='".$row['project_sub_category']."'>".ucfirst($obj->visulString($row['project_sub_category']))."</option>";
}
$result -> free_result();
}
$connectdb -> close();
}
?>