<?php
namespace ebapps\corporate;
/*****************************************************************************
############################### GNU General Public License ###################
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
#############################################################################
*****************************************************************************/
include_once(ebbd.'/dbconfig.php');
use ebapps\dbconnection\dbconfig;
/*** ***/
include_once(ebbd.'/eBConDb.php');
use ebapps\dbconnection\eBConDb;

class corporate extends dbconfig
{
/** **/
public function __construct()
{
parent::__construct();
include_once(ebcorporate.'/htaccessCorporateGenerator.php');

/* ######## Corporate ######## */

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporate_category` (
`project_category_id` int(11) NOT NULL AUTO_INCREMENT,
`project_category` varchar(64) NOT NULL,
PRIMARY KEY (`project_category_id`),
UNIQUE KEY `project_category` (`project_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporate_project` (
`project_id` int(11) NOT NULL AUTO_INCREMENT,
`username_project` varchar(64) NOT NULL,
`project_approved` int(3) NOT NULL,
`project_category` varchar(64) NOT NULL,
`project_sub_category` varchar(64) NOT NULL,
`project_og_image_url` varchar(255) NOT NULL,
`project_og_small_image_url` varchar(255) NOT NULL,
`project_og_image_title` varchar(160) NOT NULL,
`project_og_image_what_to_do` longtext NOT NULL,
`project_og_image_how_to_solve` longtext NOT NULL,
`project_affiliate_link` varchar(255) NOT NULL,
`project_github_link` varchar(255) NOT NULL,
`project_preview_link` varchar(255) NOT NULL,
`project_video_link` varchar(255) NOT NULL,
`project_date` varchar(64) NOT NULL,
PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporate_multi_img` (
`eb_corporate_multi_image_id` int(11) NOT NULL AUTO_INCREMENT,
`eb_corporate_id_in_multi_img` int(11) NOT NULL,
`eb_corporate_image_approved` int(1) NOT NULL,
`eb_corporate_big_imag_url` varchar(255) NOT NULL,
PRIMARY KEY (`eb_corporate_multi_image_id`),
KEY `eb_corporate_id_in_multi_img` (`eb_corporate_id_in_multi_img`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporates_comments` (
`eb_corporates_comments_id` int(11) NOT NULL AUTO_INCREMENT,
`eb_corporates_id_in_comments` int(11) NOT NULL,
`eb_corporates_username` varchar(64) NOT NULL,
`eb_corporates_comment_details` varchar(1024) NOT NULL,
`eb_corporates_comment_date` varchar(64) NOT NULL,
`eb_corporates_comment_status` varchar(4) NOT NULL,
PRIMARY KEY (`eb_corporates_comments_id`),
KEY `eb_corporates_username` (`eb_corporates_username`),
KEY `eb_corporates_comment_status` (`eb_corporates_comment_status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporate_sub_category` (
`project_sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
`project_sub_category` varchar(64) NOT NULL,
`project_category_in_eb_corporate_sub_category` varchar(64) NOT NULL,
PRIMARY KEY (`project_sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
	
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `eb_corporate_like` (
`eb_corporate_like_id` int(11) NOT NULL AUTO_INCREMENT,
`eb_project_id_in_eb_corporate_like` int(11) NOT NULL,
`eb_corporate_username` varchar(64) NOT NULL,
`eb_corporate_date` varchar(64) NOT NULL,
PRIMARY KEY (`eb_corporate_like_id`),
KEY `eb_corporate_username` (`eb_corporate_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `eb_corporate_category` (`project_category_id`, `project_category`) VALUES
(1, 'Handbags-and-Accessories'),
(2, 'Jewelry-and-Watches'),
(3, 'Men-s'),
(4, 'Women-s')");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `eb_corporate_sub_category` (`project_sub_category_id`, `project_sub_category`, `project_category_in_eb_corporate_sub_category`) VALUES
(1, 'Women-s-Handbags', 'Handbags-and-Accessories'),
(2, 'Fine-Jewelry', 'Jewelry-and-Watches'),
(3, 'Watches', 'Jewelry-and-Watches'),
(4, 'T-shirt', 'Men-s'),
(5, 'Sweaters', 'Men-s'),
(6, 'T-shirt', 'Women-s'),
(7, 'Sweaters', 'Women-s')");
}
/*** ***/
public function CorporateLikeAll()
{
$userForCorp = $_SESSION['ebusername'];
$queryLike = "SELECT * FROM eb_corporate_project";
$queryLike .= " JOIN eb_corporate_like ON eb_corporate_project.project_id = eb_corporate_like.eb_project_id_in_eb_corporate_like";
$queryLike .= " JOIN excessusers ON excessusers.ebusername = eb_corporate_like.eb_corporate_username";	
$queryLike .= " WHERE eb_corporate_project.project_approved=1 AND excessusers.ebusername='$userForCorp' ORDER BY eb_corporate_project.project_id DESC";		 
$result = eBConDb::eBgetInstance()->eBgetConection()->query($queryLike);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function count_total_like_corporate($project_id)
{
$corporate_id_in_like = intval($project_id);
$query = "SELECT COUNT(eb_project_id_in_eb_corporate_like) as totalPostLikes FROM";
$query .= " eb_corporate_like";
$query .= " where eb_project_id_in_eb_corporate_like=$corporate_id_in_like";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
	
/*** ***/
public function add_for_like_corporate($corporate_id_for_like)
{
if(isset($_REQUEST['add_for_like']))
{
extract($_REQUEST);
$corporate_id_for_like = intval($_POST["corporate_id_for_like"]);
$usernameLiker = $_SESSION["ebusername"];
$corporate_like_date = date("r");

$queryCheck = "SELECT * FROM eb_corporate_like WHERE eb_project_id_in_eb_corporate_like=$corporate_id_for_like AND eb_corporate_username='$usernameLiker'";
$resultCheck = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheck);
$num_result = $resultCheck->num_rows;

if($num_result == 0)
{
$query = "INSERT INTO eb_corporate_like SET eb_project_id_in_eb_corporate_like=$corporate_id_for_like, eb_corporate_username='$usernameLiker', eb_corporate_date='$corporate_like_date'";
$entryResult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
//$this->massMailForCorporateLike($usernameLiker, $corporate_id_for_like);
}	
}
}

/*
#####################
Corporate Mass eMail
#####################
*/
public function massMailForCorporate($corporate_id_for_like){
/*** eMail to Users ***/
$queryCheckForEmail = "SELECT email FROM excessusers";
$queryCheckForEmail .= " JOIN eb_corporate_like ON eb_corporate_like.eb_corporate_username =  excessusers.ebusername";
$queryCheckForEmail .= " WHERE eb_corporate_like.eb_project_id_in_eb_corporate_like=$corporate_id_for_like";
$resultCheckForEmail = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckForEmail);
if($resultCheckForEmail)
{
while($rows = $resultCheckForEmail->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$resultCheckForEmail -> free_result();
}

public function massMailForCorporateLike($usernameLiker, $corporate_id_for_like){

/*** eMail to Users ***/
$arr_email = $this->massMailForCorporate($corporate_id_for_like);
if( $arr_email >= 1){
foreach($arr_email as $val): extract($val);
$iTo[]=$email;
endforeach;
}

/*** eMail from ***/
/*** 
$from = contactEmail;
OR
$from = adminEmail; 
***/
$from = adminEmail;
$subject = $usernameLiker." also like this link";
/*** ***/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
/*** $headers .= "From: $from \r\n"; ***/
$headers .= "Reply-To: $from \r\n";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>$subject</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi, $subject</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outCorporateLinkFull."/project/details/$corporate_id_for_like/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View the link</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*** ***/
for($i =0; $i<=count($iTo)-1; $i++)
{
mail($iTo[$i], $subject, $message, $headers);
}
}

/*** ***/
public function count_corporate_like_now($projectid)
{
$like_username = isset($_SESSION['ebusername']);
$corporate_id_in_like = intval($projectid);
$query = "SELECT COUNT(eb_project_id_in_eb_corporate_like) AS likeNow FROM";
$query .= " eb_corporate_like";
$query .= " WHERE eb_project_id_in_eb_corporate_like=$corporate_id_in_like AND eb_corporate_username='$like_username'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function project_same_project_multi_image($projectid)
{
$projectid = intval($projectid);
$query = "select * from eb_corporate_multi_img where eb_corporate_image_approved=1 and eb_corporate_id_in_multi_img=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function deleteScreenShootMerchantcorporates($eb_corporate_multi_image_id, $eb_corporate_id_in_multi_img, $eb_corporate_big_imag_url)
{
$eb_corporate_multi_image_id = intval($eb_corporate_multi_image_id);
$eb_corporate_id_in_multi_img = intval($eb_corporate_id_in_multi_img);
$eb_corporate_big_imag_url = str_replace(hostingName, docRoot, hypertext.$eb_corporate_big_imag_url);
if(!empty($eb_corporate_big_imag_url))
{
unlink($eb_corporate_big_imag_url);
}

$query1st = "UPDATE eb_corporate_project SET project_approved=0 WHERE project_id=$eb_corporate_id_in_multi_img";
eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

$query3 = "update eb_corporate_multi_img set eb_corporate_image_approved=3, eb_corporate_big_imag_url='' where eb_corporate_multi_image_id=$eb_corporate_multi_image_id";
$result3 = eBConDb::eBgetInstance()->eBgetConection()->query($query3);
if($result3)
{
echo $this->ebDone();
}
}
/*** ***/
public function approve_the_image_corporates($project_id,$eb_corporate_multi_image_id)
{
$eb_corporate_multi_image_id = intval($eb_corporate_multi_image_id);
$project_id = intval($project_id);
$image_approved_corporates =1;

/* update soft_merchant_add_items */
$query1st = "update eb_corporate_multi_img set eb_corporate_image_approved=$image_approved_corporates where eb_corporate_id_in_multi_img=$project_id and eb_corporate_multi_image_id=$eb_corporate_multi_image_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();
}
$result1st -> free_result();
}
/*** ***/
public function reject_the_image_corporates($eb_corporate_multi_image_id, $eb_corporate_big_imag_url)
{
$eb_corporate_multi_image_id = intval($eb_corporate_multi_image_id);
$image_approved_corporates = 3;
$eb_corporate_big_imag_url = str_replace(hostingName, docRoot, hypertext.$eb_corporate_big_imag_url);
if(!empty($eb_corporate_big_imag_url))
{
unlink($eb_corporate_big_imag_url); 
}
/* update soft_merchant_add_items */
$query1st = "update eb_corporate_multi_img set eb_corporate_image_approved=$image_approved_corporates, eb_corporate_big_imag_url='' where eb_corporate_multi_image_id=$eb_corporate_multi_image_id";
$result1st = eBConDb::eBgetInstance()->eBgetConection()->query($query1st);

if($result1st)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function project_multi_img_admin_review($project_id)
{
$project_id = intval($project_id);
$query = "SELECT * FROM";
$query .= " eb_corporate_multi_img";
$query .= " WHERE eb_corporate_id_in_multi_img=$project_id ORDER BY eb_corporate_multi_image_id DESC";
/*** $query .= " WHERE eb_corporate_id_in_multi_img=$project_id and eb_corporate_image_approved=0 ORDER BY eb_corporate_multi_image_id DESC"; ***/
/*** $query .= " LIMIT 1"; ***/
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_multi_img($project_id)
{
$projectid = intval($project_id);
$query = "SELECT * FROM";
$query .= " eb_corporate_multi_img";
$query .= " WHERE eb_corporate_id_in_multi_img=$projectid ORDER BY eb_corporate_id_in_multi_img DESC";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function insert_project_multi_image_url($project_id,$project_big_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$project_id = intval($project_id);
/*** ***/
if(!empty($project_big_image_url))
{ 

$query1 = "INSERT INTO eb_corporate_multi_img SET eb_corporate_id_in_multi_img=$project_id, eb_corporate_image_approved=0, eb_corporate_big_imag_url='$project_big_image_url'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);

/*** ***/
$query2nd = "update eb_corporate_project set project_approved=0 where project_id=$project_id";
$result2nd = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);

if($result2nd){
/*** ***/
echo $this->ebDone();
}
}

}
/*** ***/
public function select_multi_image_from_project()
{
/* Read to Edit */
if(isset($_REQUEST['project_upload_image']))
{
extract($_REQUEST);
$project_id = intval($_REQUEST['project_id']);
$query = "SELECT * FROM ";
$query .= " eb_corporate_project";
$query .= " where project_id=$project_id";
$query .= " limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
public function corporates_implementation_video_last_for_promotion()
{
$query = "select project_video_link, project_sub_category FROM eb_corporate_project WHERE project_approved=1 AND project_video_link LIKE '%/%' ORDER BY project_id DESC limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function delete_project_query_admin($eb_corporates_comments_id,$eb_corporates_comment_details)
{
$eb_corporates_comments_id = intval($eb_corporates_comments_id);
$eb_corporates_comment_details = $_POST['eb_corporates_comment_details'];
$query = "DELETE FROM eb_corporates_comments";
$query .= " WHERE eb_corporates_comments_id=$eb_corporates_comments_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function approve_project_query_admin($eb_corporates_comments_id, $eb_corporates_id_in_comments, $eb_corporates_comment_details)
{
$eb_corporates_comments_id = intval($eb_corporates_comments_id);
$eb_corporates_id_in_comments = intval($eb_corporates_id_in_comments);
$eb_corporates_comment_details_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$_POST['eb_corporates_comment_details']);
$query = "UPDATE eb_corporates_comments SET eb_corporates_comment_details='$eb_corporates_comment_details_2nd', eb_corporates_comment_status='OK'";
$query .= " WHERE eb_corporates_comments_id=$eb_corporates_comments_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
$queryTwo = "SELECT eb_corporates_username FROM eb_corporates_comments WHERE eb_corporates_comments_id=$eb_corporates_comments_id";
$resultTwo = eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);
$resultTwoInfo = mysqli_fetch_array($resultTwo);
$eb_corporates_comment_username = $resultTwoInfo['eb_corporates_username'];
/*** ***/
$queryThree = "SELECT email FROM excessusers WHERE ebusername='$eb_corporates_comment_username'";
$resultThree = eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
$resultThreeInfo = mysqli_fetch_array($resultThree);
$eb_corporates_comment_email = $resultThreeInfo['email'];
/*** ***/
$to = $eb_corporates_comment_email;
$from = adminEmail;
/*** ***/
$subject = "Your comment approved";
/*** ***/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
/*** $headers .= "From: $from \r\n"; ***/
$headers .= "Reply-To: $from \r\n";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>Your comment approved</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi, $eb_corporates_comment_username your comment approved</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outCorporateLinkFull."/project/details/$eb_corporates_id_in_comments/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View the comment</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*** ***/
mail($to, $subject, $message, $headers);
/*** ***/
if($result)
{
/*** ***/
echo $this->ebDone();
}
//
//$this->massMailSendForCorporateComment($eb_corporates_comment_username, $eb_corporates_id_in_comments);
}
/*
#####################
Corporate Mass eMail for Comments
#####################
*/
public function massMailForCorporateComment($eb_corporates_id_in_comments){
/*** eMail to Users ***/
$queryCheckForEmail = "SELECT email FROM excessusers";
$queryCheckForEmail .= " JOIN eb_corporates_comments ON eb_corporates_comments.eb_corporates_username =  excessusers.ebusername";
$queryCheckForEmail .= " WHERE eb_corporates_comments.eb_corporates_id_in_comments=$eb_corporates_id_in_comments AND eb_corporates_comments.eb_corporates_comment_status='OK'";
$resultCheckForEmail = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckForEmail);
if($resultCheckForEmail)
{
while($rows = $resultCheckForEmail->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
}

public function massMailSendForCorporateComment($eb_corporates_comment_username, $eb_corporates_id_in_comments){

/*** eMail to Users ***/
$arr_email = $this->massMailForCorporateComment($eb_corporates_id_in_comments);
if( $arr_email >= 1){
foreach($arr_email as $val): extract($val);
$iTo[]=$email;
endforeach;
}

/*** eMail from ***/
/*** 
$from = contactEmail;
OR
$from = adminEmail; 
***/
$from = adminEmail;
$subject = $eb_corporates_comment_username." also comment where you comment";
/*** ***/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
/*** $headers .= "From: $from \r\n"; ***/
$headers .= "Reply-To: $from \r\n";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>$subject</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>Hi, $subject</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outCorporateLinkFull."/project/details/$eb_corporates_id_in_comments/";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>View the comment</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*** ***/
for($i =0; $i<=count($iTo)-1; $i++)
{
mail($iTo[$i], $subject, $message, $headers);
}
}
/*** ***/
public function read_all_project_query_admin()
{
$query = "SELECT * FROM ";
$query .= " eb_corporates_comments";
$query .= " where eb_corporates_comment_status='NO' order by eb_corporates_id_in_comments desc, eb_corporates_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function submit_project_query_mini_merchant($eb_corporates_id_in_comments,$eb_corporates_comment_details)
{
$eb_corporates_id_in_comments = intval($eb_corporates_id_in_comments);
$eb_corporates_username = $_SESSION['ebusername'];
$eb_corporates_comment_date = date("r");
$eb_corporates_comment_details_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$eb_corporates_comment_details);
eBConDb::eBgetInstance()->eBgetConection()->query("insert into eb_corporates_comments set eb_corporates_id_in_comments=$eb_corporates_id_in_comments, eb_corporates_username='$eb_corporates_username', eb_corporates_comment_details='$eb_corporates_comment_details_2nd', eb_corporates_comment_date='$eb_corporates_comment_date', eb_corporates_comment_status='OK'");
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function submit_project_query_visitor($eb_corporates_id_in_comments,$eb_corporates_comment_details)
{
$eb_corporates_id_in_comments = intval($eb_corporates_id_in_comments);
$eb_corporates_username = $_SESSION['ebusername'];
$eb_corporates_comment_date = date("r");
$eb_corporates_comment_details_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$eb_corporates_comment_details);
eBConDb::eBgetInstance()->eBgetConection()->query("insert into eb_corporates_comments set eb_corporates_id_in_comments=$eb_corporates_id_in_comments, eb_corporates_username='$eb_corporates_username', eb_corporates_comment_details='$eb_corporates_comment_details_2nd', eb_corporates_comment_date='$eb_corporates_comment_date', eb_corporates_comment_status='NO'");

/*** ***/
$queryThree = "SELECT email FROM excessusers WHERE ebusername='$eb_corporates_username'";
$resultThree = eBConDb::eBgetInstance()->eBgetConection()->query($queryThree);
$resultThreeInfo = mysqli_fetch_array($resultThree);
$eb_corporates_comment_email = $resultThreeInfo['email'];

/*** ***/
$to = adminEmail;
$from = $eb_corporates_comment_email;
/*** ***/
$subject = "$eb_corporates_username left a comment";
/*** ***/
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
/*** $headers .= "From: $from \r\n"; ***/
$headers .= "Reply-To: $from \r\n";
/*** ***/
$message ="<html>";
$message .="<head>";
$message .="<title>$eb_corporates_username left a comment</title>";
$message .="<meta charset='utf-8'>";
$message .="<meta name='viewport' content='width=device-width, initial-scale=1'>";
$message .="<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
$message .="<style type='text/css'>
/* CLIENT-SPECIFIC STYLES */
body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;}
table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;}
img{-ms-interpolation-mode: bicubic;}
/* RESET STYLES */
img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
table{border-collapse: collapse !important;}
body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
/* iOS BLUE LINKS */
a[x-apple-data-detectors]
{
color: inherit !important;
text-decoration: none !important;
font-size: inherit !important;
font-family: inherit !important;
font-weight: inherit !important;
line-height: inherit !important;
}
/* MOBILE STYLES */
@media screen and (max-width: 525px)
{
/* ALLOWS FOR FLUID TABLES */
.wrapper
{
width: 100% !important;
max-width: 100% !important;
}
/* ADJUSTS LAYOUT OF LOGO IMAGE */
.logo img
{
margin: 0 auto !important;
}
/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
.mobile-hide 
{
display: none !important;
}
.img-max 
{
max-width: 100% !important;
width: 100% !important;
height: auto !important;
}
/* FULL-WIDTH TABLES */
.responsive-table
{
width: 100% !important;
}
/* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
.padding
{
padding: 6px 3% 9px 3% !important;
}
.padding-meta
{
padding: 9px 3% 0px 3% !important;
text-align: center;
}
.padding-copy
{
padding: 9px 3% 9px 3% !important;
text-align: center;
}
.no-padding
{
padding: 0 !important;
}
.section-padding
{
padding: 9px 9px 9px 9px !important;
}
/* ADJUST BUTTONS ON MOBILE */
.mobile-button-container
{
margin: 0 auto;
width: 100% !important;
}
.mobile-button
{
padding: 9px !important;
border: 0 !important;
font-size: 16px !important;
display: block !important;
}
}
/* ANDROID CENTER FIX */
div[style*='margin: 16px 0;'] { margin: 0 !important; }
</style>";
$message .="</head>";
$message .="<body>";
$message .="<table border='0' cellpadding='0' cellspacing='0' width='100%' class='wrapper'>";
//
$message .="<tr>";
$message .="<td>$eb_corporates_username left a comment on $eb_corporates_comment_date</td>";
$message .="</tr>";
//
$message .="<tr bgcolor='#014693'>";
$message .="<td>";
$message .="<a href='";
$message .=outCorporateLinkFull."/project-approve-query.php";
$message .="' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; border-radius: 3px; padding: 9px 9px; border: 1px solid #014693; display: block;'>Review the comment</a>";
$message .="</td>";
$message .="</tr>";
//
$message .="</table>";
$message .="</body>";
$message .="</html>";
/*** ***/
mail($to, $subject, $message, $headers);
/*** ***/
echo $this->ebDone();
}
/*** ***/
/*** ***/
public function read_project_query_to_submit_another_one($projectid)
{
$soft_items_id = intval($projectid);
$query = "SELECT * FROM ";
$query .= " eb_corporates_comments";
$query .= " where eb_corporates_id_in_comments=$soft_items_id order by eb_corporates_comments_id desc LIMIT 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function read_all_project_query($projectid)
{
$eb_corporates_id_in_comments = intval($projectid);
$query = "SELECT * FROM ";
$query .= " eb_corporates_comments";
$query .= " where eb_corporates_id_in_comments=$eb_corporates_id_in_comments and eb_corporates_comment_status='OK' order by eb_corporates_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*##################################################################################### 
############### UP For Domain and License Verified Users by Auto Update ###############
#################################################################################### */

/*** ***/
public function edit_update_project_item($project_id, $username_project, $project_approved, $project_category, $project_sub_category, $project_og_image_title,$project_og_image_what_to_do,$project_og_image_how_to_solve,$project_affiliate_link, $project_github_link,$project_preview_link,$project_video_link)
{
$project_id = intval($project_id);
$project_approved = intval($project_approved);
$project_og_image_what_to_do_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$project_og_image_what_to_do);
$project_og_image_how_to_solve_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$project_og_image_how_to_solve);

$query = "SELECT * FROM  eb_corporate_project where project_id=$project_id and username_project='$username_project'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $testresult->num_rows;
/*** ***/
if($num_result == 1)
{
if(!empty($project_approved))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_approved=0 where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_category))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_category='$project_category' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_sub_category))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_sub_category='$project_sub_category' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_og_image_title))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_og_image_title='$project_og_image_title' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(isset($project_og_image_what_to_do))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_og_image_what_to_do='$project_og_image_what_to_do_2nd' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(isset($project_og_image_how_to_solve))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_og_image_how_to_solve='$project_og_image_how_to_solve_2nd' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_affiliate_link) || empty($project_affiliate_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_affiliate_link='$project_affiliate_link' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_github_link) || empty($project_github_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_github_link='$project_github_link' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_preview_link) || empty($project_preview_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_preview_link='$project_preview_link' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
if(!empty($project_video_link) || empty($project_video_link))
{
eBConDb::eBgetInstance()->eBgetConection()->query("update eb_corporate_project set project_video_link='$project_video_link' where project_id=$project_id and username_project='$username_project'");
}
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function edit_select_project_item()
{
$project_id = intval($_GET['project_id']);
$username_project = $_GET['username_project'];
$query = "SELECT * FROM eb_corporate_project";
$query .= " WHERE project_id =$project_id and username_project ='$username_project'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function menu_sub_category_project($cat)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_category='$cat' AND project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_sub_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function menu_category_project()
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function search_in_project()
{
/* Read to Edit */
if(isset($_REQUEST['search_project']))
{
extract($_REQUEST);
$query = "SELECT * FROM eb_corporate_project where eb_corporate_project.project_approved=1 AND eb_corporate_project.project_og_image_title LIKE '%".$_REQUEST['search_project']."%'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
public function submit_project_category($project_category)
{
$query_test = "SELECT * FROM  eb_corporate_category where project_category='$project_category'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;
if($num_result == 0)
{
$query = "INSERT INTO eb_corporate_category set project_category='$project_category'";
$result= eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}
/*** ***/
public function edit_select_project_category(){
$query = "SELECT * FROM ";
$query .= "eb_corporate_category";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function select_project_category(){
$query = "SELECT * FROM ";
$query .= "eb_corporate_category";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
echo "<option value='".$rows['project_category']."'>".ucfirst($this->visulString($rows['project_category']))."</option>"; 
}
}
$result -> free_result();
}
/*** ***/
public function submit_project_sub_category($project_category, $project_sub_category)
{
$query_test = "SELECT * FROM  eb_corporate_sub_category where project_sub_category='$project_sub_category' and project_category_in_eb_corporate_sub_category='$project_category'";

$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query_test);
$num_result = $testresult->num_rows;

if($num_result == 0)
{
$query = "INSERT INTO eb_corporate_sub_category set project_sub_category='$project_sub_category', project_category_in_eb_corporate_sub_category='$project_category'";
$entryResult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
if($entryResult)
{
/*** ***/
echo $this->ebDone();
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}
else
{
/*** ***/
echo $this->ebNotDone();
}
}
/*** ***/
public function submit_new_project_item($project_category, $project_sub_category, $project_og_image_title, $project_og_image_what_to_do, $project_og_image_how_to_solve, $project_affiliate_link, $project_github_link, $project_preview_link, $project_video_link)
{
$username = $_SESSION['ebusername'];
$project_date = date("r");
$project_og_image_what_to_do_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$project_og_image_what_to_do);
$project_og_image_how_to_solve_2nd = mysqli_real_escape_string (eBConDb::eBgetInstance()->eBgetConection(),$project_og_image_how_to_solve);
$query1 = "INSERT INTO eb_corporate_project set username_project='$username', project_approved=0, project_category='$project_category', project_sub_category='$project_sub_category',project_og_image_url='',project_og_small_image_url='',project_og_image_title='$project_og_image_title', project_og_image_what_to_do='$project_og_image_what_to_do_2nd', project_og_image_how_to_solve='$project_og_image_how_to_solve_2nd', project_affiliate_link='$project_affiliate_link', project_github_link='$project_github_link', project_preview_link='$project_preview_link', project_video_link='$project_video_link', project_date='$project_date'";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$corporates_id = eBConDb::eBgetInstance()->eBgetConection()->insert_id;
/* #### First entry for Comments #### */
$query2 = "INSERT INTO eb_corporates_comments SET eb_corporates_id_in_comments=$corporates_id, eb_corporates_username='$username', eb_corporates_comment_details='Any Query?', eb_corporates_comment_date='$project_date', eb_corporates_comment_status='OK'";
eBConDb::eBgetInstance()->eBgetConection()->query($query2);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function project_view_items()
{
$username = $_SESSION['ebusername'];
$query = "SELECT * FROM ";
$query .= "eb_corporate_project ";
$query .= "where project_approved <=2 and eb_corporate_project.username_project='$username' ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
$result -> free_result();
}
/*** ***/
public function updates_project_image_url($project_id,$project_og_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$project_id = intval($project_id);
$query = "update eb_corporate_project set project_approved=0, project_og_image_url='$project_og_image_url' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
echo $this->ebDone();
?>
<script>
window.location.replace('project-items-status.php');
</script>
<?php
}
}
/*** ***/
public function updates_project_small_image_url($project_id,$project_og_small_image_url)
{
/* Do not use target='_blank', it will not remove the image */
$project_id = intval($project_id);
$query = "update eb_corporate_project set project_approved=0, project_og_small_image_url='$project_og_small_image_url' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
}
/*** ***/
public function select_image_from_project()
{
/* Read to Edit */
if(isset($_REQUEST['upload_image']))
{
extract($_REQUEST);
$project_id = intval($project_id);
$query = "SELECT * FROM ";
$query .= "eb_corporate_project  ";
$query .= "where eb_corporate_project.project_id=$project_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
/* admin project view */
public function admin_project_view_items()
{
$query = "SELECT * FROM ";
$query .= "eb_corporate_project where project_approved =0 ORDER BY eb_corporate_project.project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function approve_project_items($project_id)
{
/*** ***/
$project_id = intval($project_id);
$project_approved =1;
/* update bay_merchant_add_items */
$update_project_add_items = "update eb_corporate_project set project_approved=$project_approved where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($update_project_add_items);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function notSercicesApproved($project_id, $project_og_image_url) 
{
$project_id = intval($project_id);
$project_og_image_url = str_replace(hostingName, docRoot, hypertext.$project_og_image_url);
if(!empty($project_og_image_url))
{
unlink($project_og_image_url);
}
$query1 = "UPDATE eb_corporate_project SET project_approved=0, project_og_image_url='', project_og_small_image_url='' where project_id=$project_id";
eBConDb::eBgetInstance()->eBgetConection()->query($query1);
$result1 = eBConDb::eBgetInstance()->eBgetConection()->query($query1);
if($result1)
{
/*** ***/
echo $this->ebDone();
}
}
/*** ***/
public function notSercicesApproved_small($project_id, $project_og_small_image_url) 
{
$project_og_small_image_url = str_replace(hostingName, docRoot, hypertext.$project_og_small_image_url);
if(!empty($project_og_small_image_url))
{
unlink($project_og_small_image_url); 
}
}
/*** ***/
public function delete_project_items($project_id, $project_og_image_url) 
{
$project_id = intval($project_id);
/*** you'll have to use the path on your server to delete the image, not the url.  ***/
$project_image_path = str_replace(hostingName, docRoot, hypertext.$project_og_image_url);
if(!empty($project_image_path))
{
unlink($project_image_path);
}
$query = "UPDATE eb_corporate_project SET project_approved=3, project_og_image_url='', project_og_small_image_url='' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function delete_project_small_items($project_id, $project_og_small_image_url) 
{
$project_id = intval($project_id);
/*** you'll have to use the path on your server to delete the image, not the url. ***/ 
$project_small_image_path = str_replace(hostingName, docRoot, hypertext.$project_og_small_image_url);
if(!empty($project_small_image_path))
{
unlink($project_small_image_path); 
}
}
/*** ***/
public function delete_project_items_multi_image($project_id) 
{
$project_id = intval($project_id);
$queryCheck = "SELECT * FROM eb_corporate_multi_img WHERE eb_corporate_id_in_multi_img=$project_id";
$resultCheck = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheck);
$numResultCheck = $resultCheck->num_rows;
if($numResultCheck)
{
$queryTwo = "SELECT * FROM eb_corporate_multi_img WHERE eb_corporate_id_in_multi_img=$project_id";
$resultTwo = eBConDb::eBgetInstance()->eBgetConection()->query($queryTwo);
$numResultTwo = $resultTwo->num_rows;
if($numResultTwo)
{
for($i=1; $i<=$numResultTwo; $i++)
{
$resultTwoInfo = mysqli_fetch_array($resultTwo);
$multiImageURL = $resultTwoInfo['eb_corporate_big_imag_url'];
$multiImagePath = str_replace(hostingName, docRoot, hypertext.$multiImageURL);
if(!empty($multiImagePath))
{
unlink($multiImagePath);
}
}
}
//
}
}
/*** ***/
public function read_project_items_download_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['project_github_link']))
{
extract($_REQUEST);
$project_id = intval($_REQUEST['project_id']);
$query = "SELECT * FROM ";
$query .= "eb_corporate_project  ";
$query .= "where project_id=$project_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
public function update_project_download_link($project_id, $project_github_link)
{
$project_id = intval($project_id);
$query = "update eb_corporate_project set project_approved=0, project_github_link='$project_github_link' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function read_project_items_video_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['project_video_link']))
{
extract($_REQUEST);
$project_id = intval($_REQUEST['project_id']);
$query = "SELECT * FROM ";
$query .= "eb_corporate_project  ";
$query .= "where project_id=$project_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
public function read_project_items_preview_link_to_edit()
{
/* Read to Edit */
if(isset($_REQUEST['project_preview_link']))
{
extract($_REQUEST);
$project_id = intval($_REQUEST['project_id']);
$query = "SELECT * FROM ";
$query .= "eb_corporate_project  ";
$query .= "where project_id=$project_id ";
$query .= "limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
}
/*** ***/
public function update_project_video_link($project_id, $project_video_link)
{
$project_id = intval($project_id);
$query = "update eb_corporate_project set project_approved=0, project_video_link='$project_video_link' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}

/*** ***/
public function update_project_preview_link($project_id, $project_preview_link)
{
$project_id = intval($project_id);
$query = "update eb_corporate_project set project_approved=0, project_preview_link='$project_preview_link' where project_id=$project_id";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
/*** ***/
echo $this->ebDone();
}
/*** ***/
public function corporate_curl()
{
$c = curl_init();
curl_setopt($c, CURLOPT_URL, "https://ebangali.com/out/soft/licensekey.php");
curl_setopt($c, CURLOPT_TIMEOUT, 30);
curl_setopt($c, CURLOPT_POST, 1);
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
$postfileds = 'server='.domain.'&license='.license;
curl_setopt($c, CURLOPT_POSTFIELDS, $postfileds);
$result = curl_exec($c);
if($result == "fail")
{
/*Fake License Do Nothing*/
}	
}
/*** ***/
public function corporate_control(){
$this->eb_corporate();
}
/*** ***/
private function eb_corporate()
{
if(isset($_GET['id']))
{
$projectid = intval($_GET['id']);
$projectDetails = $this->item_details_project($projectid);
$projectCategory = $projectDetails['project_category'];
$projectSubCategory = $projectDetails['project_sub_category'];
$projectUserGroup = $projectDetails['username_project'];
}
/**/
if(isset($_GET['articlewriter'])){
$articlewriter = strval($_GET['articlewriter']);
$projectDetails = $this->item_details_articlewriter_project($articlewriter);
$projectCategory = $projectDetails['project_category'];
$projectSubCategory = $projectDetails['project_sub_category'];
$projectUserGroup = $projectDetails['username_project'];
}
/* controling cart */
$view = empty($_GET['view']) ? 'index' : $_GET['view'];
$controller = 'shop';
/* switch to which view */
switch ($view){
case "index":
		
break;
/**/
case "category":
	
break;
/**/
case "subcategory":

break;

/**/
case "writer":

break;
/**/
case "details":
$this->corporate_curl();
break;
/**/
case "solve":

break;
}
include (ebcorporatePages.'/views/layouts/'.$controller.'.php');
}
/*** ***/
public function project_project_all_sub_category()
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
}
/*** ***/
public function project_carousel_all_sub_category()
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC LIMIT 8";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_carousel_all()
{
$query = "SELECT * FROM eb_corporate_project WHERE project_category IN (SELECT project_category from eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC LIMIT 5";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_video()
{
$query = "SELECT project_category, project_sub_category, project_video_link FROM eb_corporate_project WHERE project_sub_category IN (SELECT project_sub_category FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_sub_category) ORDER BY project_id DESC LIMIT 9";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_all()
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function project_carousel_sub_category($projectCategory, $projectSubCategory)
{
$query = "select * from eb_corporate_project where project_approved=1 and project_category='$projectCategory' and project_sub_category='$projectSubCategory' ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function project_carousel_category($projectCategory)
{
$query = "select * from eb_corporate_project where project_approved=1 and project_category='$projectCategory' ORDER BY project_id DESC LIMIT 5";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_category_sub_category($projectCategory, $projectSubCategory)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_sub_category IN (SELECT project_sub_category FROM eb_corporate_project WHERE project_approved=1 AND project_category='$projectCategory' AND project_sub_category='$projectSubCategory' GROUP BY project_sub_category ORDER BY project_id DESC) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_category_details($projectCategory)
{
$query = "select * from eb_corporate_project WHERE project_approved=1 and project_category='$projectCategory' ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_category_category($projectCategory)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_sub_category IN (SELECT project_sub_category FROM eb_corporate_project WHERE project_approved=1 and project_category='$projectCategory' GROUP BY project_sub_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_sub_category($projectCategory, $projectSubCategory)
{
$query = "select * from eb_corporate_project where project_approved=1 and project_category='$projectCategory' and project_sub_category='$projectSubCategory' ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function itemDetailsBreadcrumbs($projectid)
{
$projectid = intval($projectid);
$query = "select * from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function itemDetailsAll($projectid)
{
$projectid = intval($projectid);
$query = "select * from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_thurmnail_group($username_project)
{
$query = "select * from eb_corporate_project where project_approved=1 and username_project='$username_project' ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function item_details_project($projectid)
{
$projectid = intval($projectid);
$query = "select * from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if ($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}

/*** ***/
public function item_details_articlewriter_project($articlewriter)
{
$articlewriter = strval($articlewriter);
$query = "select * from eb_corporate_project where project_approved=1 and username_project='$articlewriter'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while ($row = $result->fetch_array()) 
{
return $row;
}
}
$result -> free_result();
}

/*** ***/
public function count_total_contents_in_project($projectid)
{
$projectid = intval($projectid);
$query = "SELECT COUNT(eb_corporates_id_in_comments) as totalPostCommentsProject FROM";
$query .= " eb_corporates_comments";
$query .= " where eb_corporates_id_in_comments=$projectid and eb_corporates_comment_status='OK' order by eb_corporates_comments_id desc";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/** **/
public function rightBarAllProjects($projectid)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_approved=1 AND project_id !=$projectid ORDER BY project_id DESC LIMIT 5";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/** **/
public function rightBarCategoryProject($projectid)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/** **/
public function rightBarSubCategoryProject($projectid)
{
$query = "SELECT * FROM eb_corporate_project WHERE project_id IN (SELECT MAX(project_id) FROM eb_corporate_project WHERE project_approved=1 GROUP BY project_sub_category) ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
if($result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_detail_video($projectid)
{
$projectid = intval($projectid);
$query = "select project_video_link from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_download($projectid)
{
$projectid = intval($projectid);
$query = "select project_preview_link, project_github_link from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}

/*** ***/
public function item_details_seo($projectid)
{
$projectid = intval($projectid);
$query = "select * from eb_corporate_project where project_approved=1 and project_id=$projectid";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function last_item()
{
$query = "select * from eb_corporate_project where project_approved=1 ORDER BY project_id DESC limit 1";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result == 1)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_mrss()
{
$query = "select * from eb_corporate_project where project_approved=1 ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/*** ***/
public function project_mrss_video()
{
$query = "select project_id, project_category, project_sub_category, project_og_image_title, project_og_image_what_to_do, project_date, project_video_link from eb_corporate_project where project_approved=1 ORDER BY project_id DESC";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $result->num_rows;
if($num_result)
{
while($rows = $result->fetch_array())
{
$this->data[]=$rows;
}
return $this->data;
}
$result -> free_result();
}
/* End */
}
?>