<?php
namespace ebapps\formkeys;
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

class valideForm extends dbconfig
{
private function generateKey()
{
$uniqid = uniqid(mt_rand(), true);
$shah_1 = sha1(salt_1.$uniqid.salt_2);
$shah_2 = sha1($shah_1);
return $shah_2;
}

public function form_tracking_unique_key()
{
$uniqid = uniqid(mt_rand(), true);
$shah_1 = sha1(salt_1.$uniqid.salt_2.salt_1);
return sha1($shah_1);
}

public function outputKey()
{
$fromkeyid = $this->form_tracking_unique_key();
$ip = $_SERVER['REMOTE_ADDR'];
$domain = $_SERVER['SERVER_NAME'];
$fromkey = $this->generateKey();
if(isset($_SESSION['ebusername']))
{
$ebusername = $_SESSION['ebusername'];
}
else
{
$ebusername = "NA";
}
$visiteddate = date("Y-m-d H:i:s");
$fullUrl = fullUrl;
if(isset($_SERVER['HTTP_REFERER']))
{
$visited_from_url = $_SERVER['HTTP_REFERER'];
}
else
{
$visited_from_url = "Direct";
}
//
$queryCheckDatabase = "SELECT * FROM fromkey";
$testresultCheckDatabase = eBConDb::eBgetInstance()->eBgetConection()->query($queryCheckDatabase);
$resultCheckDatabase = $testresultCheckDatabase->num_rows;
if($resultCheckDatabase > 999999999999999999)
{
$query3nd = "DROP table fromkey";
$resultUpdate = eBConDb::eBgetInstance()->eBgetConection()->query($query3nd);
}
//
$query = "INSERT INTO fromkey SET fromkeyid='$fromkeyid', requestip='$ip', domain='$domain', fromkey='$fromkey', fromkeystatus='NO', ebusername='$ebusername', visiteddate='$visiteddate', visited_from_url='$visited_from_url', visited_url='$fullUrl'";
$result = eBConDb::eBgetInstance()->eBgetConection()->query($query);
return $fromkey;
}

/*** ***/
public function read_and_check_formkey($form_key)
{
$domMaineB = domain;
$query = "SELECT fromkey FROM fromkey WHERE domain='$domMaineB' and fromkey='$form_key' and fromkeystatus='NO'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query);
$num_result = $testresult->num_rows;
if($num_result == 1)
{
$query2nd = "UPDATE fromkey SET fromkeystatus = 'OK' WHERE fromkey = '$form_key'";
$testresult = eBConDb::eBgetInstance()->eBgetConection()->query($query2nd);
return true;
}
}
/*** ***/
}
?>