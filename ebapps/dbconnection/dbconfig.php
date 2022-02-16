<?php
namespace ebapps\dbconnection;
include_once(ebbd.'/eBConDb.php');
use ebapps\dbconnection\eBConDb;

class dbconfig extends eBConDb
{
public $AdminUserIsSet;
public $eBebusername;
public $eBpassword;
public $activeEmail;
public $fullname;
public $activeMobile;
public $membertype;
public $memberlevel;
public $addressverified;
public $data;
/* Member level
admin = 13
merchant = 8
premier = 7
plus = 6
basic = 5
intro = 4
manager = 3
salseman = 2
staff = 2
online = 1
blocked = 0
*/

public function __construct()
{
$this->businessSetting();
}
//
public function referral()
{
if(isset($_GET['omr']))
{
$_SESSION['omrebusername'] = strval($_GET['omr']);
}
}
/*** ***/
private function checkTablesToCreate()
{
include_once(ebbd.'/htaccessGenerator.php');

date_default_timezone_set("Asia/Dacca");
//date_default_timezone_set("Australia/Sydney");

/* ######## eBangali CMS Default ######## */
eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `excessusers` (
`userid` int(11) NOT NULL AUTO_INCREMENT,
`ebusername` varchar(64) NOT NULL,
`ebpassword` varchar(64) NOT NULL,
`email` varchar(64) NOT NULL,
`emailhash` varchar(64) NOT NULL,
`active` int(1) NOT NULL DEFAULT '0',
`full_name` varchar(64) NOT NULL,
`gender` varchar(16) NOT NULL,
`date_of_birth` varchar(64) NOT NULL,
`mobile` varchar(64) NOT NULL,
`mobilehash` varchar(64) NOT NULL,
`mobileactive` int(1) NOT NULL DEFAULT '0',
`signup_date` varchar(64) NOT NULL,
`account_type` varchar(64) NOT NULL,
`member_level` int(1) NOT NULL,
`position_names` varchar(64) NOT NULL,
`user_ip` varchar(64) NOT NULL,
`address_line_1` varchar(80) NOT NULL,
`address_line_2` varchar(80) NOT NULL,
`city_town` varchar(64) NOT NULL,
`state_province_region` varchar(64) NOT NULL,
`postal_code` varchar(64) NOT NULL,
`country` varchar(64) NOT NULL,
`address_verification_codes` int(11) NOT NULL,
`address_verified` int(1) NOT NULL,
`omrusername` varchar(64) NOT NULL,
`paypalid` varchar(64) NOT NULL,
`bkashid` varchar(16) NOT NULL,
`branch_name` varchar(64) NOT NULL,
`facebook_link` varchar(255) NOT NULL,
`twitter_link` varchar(255) NOT NULL,
`github_link` varchar(255) NOT NULL,
`linkedin_link` varchar(255) NOT NULL,
`pinterest_link` varchar(255) NOT NULL,
`youtube_link` varchar(255) NOT NULL,
`instagram_link` varchar(255) NOT NULL,
`profile_picture_link` varchar(255) NOT NULL,
`cover_photo_link` varchar(255) NOT NULL,
PRIMARY KEY (`userid`),
UNIQUE KEY `ebusername` (`ebusername`),
KEY `account_type` (`account_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `userpower` (
`userpowerid` int(11) NOT NULL AUTO_INCREMENT,
`userpower_level_names` varchar(64) NOT NULL,
`userpower_level_power` int(1) NOT NULL,
`userpower_position` varchar(64) NOT NULL,
PRIMARY KEY (`userpowerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `fromkey` (
`fromkeyid` CHAR(100) NOT NULL,  
`requestip` CHAR(100) NOT NULL,
`domain` CHAR(100) NOT NULL,
`fromkey` CHAR(100) NOT NULL,
`fromkeystatus` varchar(2) NOT NULL,
`ebusername` varchar(64) NOT NULL,
`visiteddate` varchar(32) NOT NULL,
`visited_from_url` varchar(255) NOT NULL,
`visited_url` varchar(255) NOT NULL,
PRIMARY KEY (`fromkeyid`),
KEY (`ebusername`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `excess_merchant_business_details` (
`business_details_id` int(11) NOT NULL AUTO_INCREMENT,
`business_username` varchar(64) NOT NULL,
`business_name` varchar(80) NOT NULL,
`business_vat_tax_gst` varchar(80) NOT NULL,
`business_title_one` varchar(160) NOT NULL,
`business_title_two` varchar(160) NOT NULL,
`business_full_address` varchar(160) NOT NULL,
`business_city_town` varchar(64) NOT NULL,
`business_state_province_region` varchar(64) NOT NULL,
`business_postal_code` varchar(64) NOT NULL,
`business_country` varchar(64) NOT NULL,
`business_geolocation_longitude` varchar(64) NOT NULL,
`business_geolocation_latitude` varchar(64) NOT NULL,
`cash_on_delivery_distance_meter` int(11) NOT NULL,
`business_logo_link` varchar(255) NOT NULL,
`business_cover_photo_link` varchar(255) NOT NULL,
`verification_status` varchar(8) NOT NULL,
PRIMARY KEY (`business_details_id`),
UNIQUE KEY `business_username` (`business_username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `payment_gateways` (
`payment_gateways_id` int(11) NOT NULL AUTO_INCREMENT,
`payment_gateways_brand` varchar(255) NOT NULL,
`payment_gateways_username` varchar(255) NOT NULL,
`payment_gateways_public_key` varchar(255) NOT NULL,
`payment_gateways_privet_key` varchar(255) NOT NULL,
`payment_gateways_extra_key_one` varchar(255) NOT NULL,
`payment_gateways_extra_key_two` varchar(255) NOT NULL,
`payment_gateways_status` varchar(4) NOT NULL,
PRIMARY KEY (`payment_gateways_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `country_and_zone` (
`bay_dhl_country_zone_id` int(11) NOT NULL AUTO_INCREMENT,
`country_name` varchar(64) NOT NULL,
`dhl_country_zone` int(4) NOT NULL,
`country_code` int(8) NOT NULL,
PRIMARY KEY (`bay_dhl_country_zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");


eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_dhl_express_worldwide_admin_shipping_zone` (
`admin_dhl_zone_id` int(4) NOT NULL,
`admin_dhl_country_id` int(4) NOT NULL,
`admin_country_name` varchar(64) NOT NULL,
PRIMARY KEY (`admin_dhl_zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_dhl_express_worldwide_zone_export_price` (
`bay_dhl_weight_zone_price_id` int(11) NOT NULL AUTO_INCREMENT,
`dhl_zone` int(4) NOT NULL,
`dhl_weight` double(16,2) NOT NULL,
`dhl_price` double(16,2) NOT NULL,
PRIMARY KEY (`bay_dhl_weight_zone_price_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

eBConDb::eBgetInstance()->eBgetConection()->query("CREATE TABLE IF NOT EXISTS `bay_size_all` (
`size_id` int(4) NOT NULL AUTO_INCREMENT,
`size_name` varchar(64) NOT NULL,
PRIMARY KEY (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
/* End of Creating Tables */

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `userpower` (`userpowerid`, `userpower_level_names`, `userpower_level_power`, `userpower_position`) VALUES
(1, 'merchant', 8, 'Merchant'),
(2, 'plus', 6, 'Plus'),
(3, 'intro', 4, 'Intro'),
(4, 'manager', 3, 'Project Lead'),
(5, 'salseman', 2, 'Senior Software Engineer'),
(6, 'salseman', 2, 'Team Lead'),
(7, 'salseman', 2, 'CMO'),
(8, 'salseman', 2, 'CTO'),
(9, 'salseman', 2, 'OMR'),
(10, 'salseman', 2, 'Salseman'),
(11, 'staff', 2, 'Staff'),
(12, 'public', 1, 'Public'),
(13, 'public', 1, 'UI UX Designer'),
(14, 'public', 1, 'Graphic Designer'),
(15, 'protected', 1, 'Protected'),
(16, 'private', 1, 'Private'),
(17, 'invited', 1, 'Invited'),
(18, 'unsubscribe', 1, 'Unsubscribe'),
(19, 'blocked', 0, 'Blocked')");

/* DHL shipment PRICE 2020 from Bangladesh to WorldWide in USD. If your are using this script out of Bangladesh. Change these from dhl_express_rate_guide_bd_en_2020. Your DHL shipment PRICE is totaly different. */

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `country_and_zone` (`bay_dhl_country_zone_id`, `country_name`, `dhl_country_zone`, `country_code`) VALUES
(1, 'Afghanistan', 7, 93),
(2, 'Albania', 6, 355),
(3, 'Algeria', 7, 213),
(4, 'American Samoa', 7, 1684),
(5, 'Andorra', 6, 376),
(6, 'Angola', 7, 244),
(7, 'Anguilla', 7, 1264),
(8, 'Antigua', 7, 1268),
(9, 'Argentina', 7, 54),
(10, 'Armenia', 6, 374),
(11, 'Aruba', 7, 297),
(12, 'Australia', 3, 61),
(13, 'Austria', 4, 43),
(14, 'Azerbaijan', 7, 994),
(15, 'Bahamas', 7, 1242),
(16, 'Bahrain', 1, 973),
(17, 'Bangladesh', 0, 880),
(18, 'Barbados', 7, 1246),
(19, 'Belarus', 6, 375),
(20, 'Belgium', 4, 32),
(21, 'Belize', 7, 501),
(22, 'Benin', 7, 229),
(23, 'Bermuda', 7, 1441),
(24, 'Bhutan', 2, 975),
(25, 'Bolivia', 7, 591),
(26, 'Bonaire', 7, 599),
(27, 'Bosnia and Herzegovina', 6, 387),
(28, 'Botswana', 7, 267),
(29, 'Brazil', 7, 55),
(30, 'Brunei', 2, 673),
(31, 'Bulgaria', 4, 359),
(32, 'Burkina Faso', 7, 226),
(33, 'Burundi', 7, 257),
(34, 'Cambodia', 2, 855),
(35, 'Cameroon', 7, 237),
(36, 'Canada', 5, 1),
(37, 'Cape Verde', 7, 238),
(38, 'Cayman Islands', 7, 1345),
(39, 'Central African Republic', 7, 236),
(40, 'Chad', 7, 235),
(41, 'Chile', 7, 56),
(42, 'Colombia', 7, 57),
(43, 'Comoros', 7, 269),
(44, 'Cook Islands', 7, 682),
(45, 'Costa Rica', 7, 506),
(46, 'Cuba', 7, 53),
(47, 'Croatia', 4, 385),
(48, 'Curacao', 7, 599),
(49, 'Cyprus', 4, 357),
(50, 'Czech Republic', 4, 420),
(51, 'Democratic Republic of the Congo', 7, 243),
(52, 'Denmark', 4, 45),
(53, 'Djibouti', 7, 253),
(54, 'Dominica', 7, 17),
(55, 'Dominican Republic', 7, 18),
(56, 'Ecuador', 7, 593),
(57, 'Egypt', 7, 20),
(58, 'El Salvador', 7, 503),
(59, 'Eritrea ', 7, 291),
(60, 'Estonia', 4, 372),
(61, 'Ethiopia', 7, 251),
(62, 'Falkland Islands', 7, 500),
(63, 'Faroe Islands', 6, 298),
(64, 'Fiji', 7, 679),
(65, 'Finland', 4, 358),
(66, 'France', 4, 33),
(67, 'French Polynesia', 7, 689),
(68, 'Gabon', 7, 241),
(69, 'Gambia', 7, 220),
(70, 'Georgia', 6, 995),
(71, 'Germany', 4, 49),
(72, 'Ghana', 7, 233),
(73, 'Gibraltar', 6, 350),
(74, 'Greece', 4, 30),
(75, 'Greenland', 6, 299),
(76, 'Guadeloupe', 7, 590),
(77, 'Guam', 7, 1671),
(78, 'Guatemala', 7, 502),
(79, 'Guernsey', 6, 1481),
(80, 'Guinea Republic', 7, 224),
(81, 'Guinea Bissau', 7, 245),
(82, 'Guinea Ecuatorial', 7, 240),
(83, 'Guyana', 7, 592),
(84, 'Haiti', 7, 509),
(85, 'Honduras', 7, 504),
(86, 'Hong Kong', 1, 852),
(87, 'Hungary', 4, 36),
(88, 'Iceland', 6, 354),
(89, 'India', 1, 91),
(90, 'Indonesia', 2, 62),
(91, 'Iran', 7, 98),
(92, 'Iraq', 7, 964),
(93, 'Ireland', 4, 353),
(94, 'Israel', 6, 972),
(95, 'Italy', 4, 39),
(96, 'Jamaica', 7, 1876),
(97, 'Japan', 3, 81),
(98, 'Jersey', 6, 44),
(99, 'Jordan', 1, 962),
(100, 'Kazakhstan', 7, 7),
(101, 'Kenya', 7, 254),
(102, 'Kiribati', 7, 686),
(103, 'Kosovo', 7, 383),
(104, 'Kuwait', 1, 965),
(105, 'Kyrgyzstan', 7, 996),
(106, 'Laos', 2, 856),
(107, 'Latvia', 4, 371),
(108, 'Lebanon', 7, 961),
(109, 'Lesotho', 7, 266),
(110, 'Liberia', 7, 231),
(111, 'Libya', 7, 218),
(112, 'Liechtenstein', 4, 423),
(113, 'Lithuania', 4, 370),
(114, 'Luxembourg', 4, 352),
(115, 'Macau', 2, 853),
(116, 'Macedonia', 6, 389),
(117, 'Madagascar', 7, 261),
(118, 'Malawi', 7, 265),
(119, 'Malaysia', 2, 60),
(120, 'Maldives', 2, 960),
(121, 'Mali', 7, 223),
(122, 'Malta', 4, 356),
(123, 'Marshall Islands', 7, 692),
(124, 'Martinique', 7, 596),
(125, 'Mauritania', 7, 222),
(126, 'Mauritius', 7, 230),
(127, 'Mayotte', 7, 262),
(128, 'Mexico', 5, 52),
(129, 'Micronesia', 7, 691),
(130, 'Moldova', 7, 373),
(131, 'Monaco', 4, 377),
(132, 'Mongolia', 2, 976),
(133, 'Montenegro', 7, 382),
(134, 'Montserrat', 7, 1664),
(135, 'Morocco', 7, 212),
(136, 'Mozambique', 7, 258),
(137, 'Myanmar', 7, 95),
(138, 'Namibia', 7, 264),
(139, 'Nauru', 7, 674),
(140, 'Nepal', 2, 977),
(141, 'Netherlands Antilles', 7, 599),
(142, 'Netherlands', 4, 31),
(143, 'Nevis', 7, 1869),
(144, 'New Caledonia', 7, 687),
(145, 'New Zealand', 3, 64),
(146, 'Nicaragua', 7, 505),
(147, 'Niger', 7, 227),
(148, 'Nigeria', 7, 234),
(149, 'Niue', 7, 683),
(150, 'North Korea', 7, 850),
(151, 'Norway', 6, 47),
(152, 'Oman', 1, 968),
(153, 'Pakistan', 2, 92),
(154, 'Palau', 7, 680),
(155, 'Panama', 7, 507),
(156, 'Papua New Guinea', 7, 675),
(157, 'Paraguay', 7, 595),
(158, 'Peru', 7, 51),
(159, 'Philippines', 2, 63),
(160, 'Poland', 4, 48),
(161, 'Portugal', 4, 351),
(162, 'Puerto Rico', 4, 1787),
(163, 'Qatar', 1, 974),
(164, 'Reunion', 7, 262),
(165, 'Romania', 4, 40),
(166, 'Russia', 6, 7),
(167, 'Rwanda', 7, 250),
(168, 'Saint Helena', 7, 290),
(169, 'Saipan', 7, 1670),
(170, 'Samoa', 7, 685),
(171, 'San Marino', 7, 378),
(172, 'Sao Tome and Principe', 7, 239),
(173, 'Saudi Arabia', 1, 966),
(174, 'Senegal', 7, 221),
(175, 'Serbia', 7, 381),
(176, 'Seychelles', 7, 248),
(177, 'Sierra Leone', 7, 232),
(178, 'Singapore', 1, 65),
(179, 'Slovakia', 4, 421),
(180, 'Slovenia', 4, 386),
(181, 'Solomon Islands', 7, 677),
(182, 'Somalia', 7, 252),
(183, 'Somaliland,', 7, 252),
(184, 'South Africa', 7, 27),
(185, 'South Korea', 2, 82),
(186, 'South Sudan', 7, 211),
(187, 'Spain', 4, 34),
(188, 'Sri Lanka', 2, 94),
(189, 'Saint Barthelemy', 7, 590),
(190, 'Sint Eustatius', 7, 5993),
(191, 'Saint Kitts', 7, 1869),
(192, 'Saint Lucia', 7, 1758),
(193, 'Sint Maarten', 7, 1721),
(194, 'Saint Vincent', 7, 1784),
(195, 'Sudan', 7, 249),
(196, 'Suriname', 7, 597),
(197, 'Swaziland', 7, 268),
(198, 'Sweden', 4, 46),
(199, 'Switzerland', 4, 41),
(200, 'Syria', 7, 963),
(201, 'Tahiti', 7, 689),
(202, 'Taiwan', 2, 886),
(203, 'Tajikistan', 7, 992),
(204, 'Tanzania', 7, 255),
(205, 'Thailand', 1, 66),
(206, 'Timor leste', 7, 670),
(207, 'Togo', 7, 228),
(208, 'Tonga', 7, 676),
(209, 'Trinidad and Tobago', 7, 1868),
(210, 'Tunisia', 7, 216),
(211, 'Turkey', 4, 90),
(212, 'Turkmenistan', 7, 993),
(213, 'Turks and Caicos Islands', 7, 1649),
(214, 'Tuvalu', 7, 688),
(215, 'Uganda', 7, 256),
(216, 'Ukraine', 6, 380),
(217, 'United Arab Emirates', 1, 971),
(218, 'United Kingdom', 4, 44),
(219, 'United States', 5, 1),
(220, 'Uruguay', 7, 598),
(221, 'Uzbekistan', 7, 998),
(222, 'Vanuatu', 7, 678),
(223, 'Vatican City', 4, 379),
(224, 'Venezuela', 7, 58),
(225, 'Vietnam', 2, 84),
(226, 'Virgin islands UK', 7, 1284),
(227, 'Virgin islands US', 7, 1340),
(228, 'Yemen', 7, 967),
(229, 'Yugoslavia', 7, 38),
(230, 'Zaire', 7, 243),
(231, 'Zambia', 7, 260),
(232, 'Zimbabwe', 7, 263),
(233, 'China', 2, 86)");

eBConDb::eBgetInstance()->eBgetConection()->query("INSERT INTO `bay_dhl_express_worldwide_zone_export_price` (`bay_dhl_weight_zone_price_id`, `dhl_zone`, `dhl_weight`, `dhl_price`) VALUES
(1, 0, 0.50, 0.80),
(2, 0, 1.00, 1.00),
(3, 0, 1.50, 1.50),
(4, 0, 2.00, 2.00),
(5, 0, 2.50, 2.50),
(6, 0, 3.00, 3.00),
(7, 0, 3.50, 3.50),
(8, 0, 4.00, 4.00),
(9, 0, 4.50, 4.50),
(10, 0, 5.00, 5.00),
(11, 0, 5.50, 5.50),
(12, 0, 6.00, 6.00),
(13, 0, 6.50, 6.50),
(14, 0, 7.00, 7.00),
(15, 0, 7.50, 7.50),
(16, 0, 8.00, 8.00),
(17, 0, 8.50, 8.50),
(18, 0, 9.00, 9.00),
(19, 0, 9.50, 9.50),
(20, 0, 10.00, 10.00),
(21, 0, 10.50, 10.50),
(22, 0, 11.00, 11.00),
(23, 0, 11.50, 11.50),
(24, 0, 12.00, 12.00),
(25, 0, 12.50, 12.50),
(26, 0, 13.00, 13.00),
(27, 0, 13.50, 13.50),
(28, 0, 14.00, 14.00),
(29, 0, 14.50, 14.50),
(30, 0, 15.00, 15.00),
(31, 0, 15.50, 15.50),
(32, 0, 16.00, 16.00),
(33, 0, 16.50, 16.50),
(34, 0, 17.00, 17.00),
(35, 0, 17.50, 17.50),
(36, 0, 18.00, 18.00),
(37, 0, 18.50, 18.50),
(38, 0, 19.00, 19.00),
(39, 0, 19.50, 19.50),
(40, 0, 20.00, 20.00),
(41, 0, 20.50, 20.50),
(42, 0, 21.00, 21.00),
(43, 0, 21.50, 21.50),
(44, 0, 22.00, 22.00),
(45, 0, 22.50, 22.50),
(46, 0, 23.00, 23.00),
(47, 0, 23.50, 23.50),
(48, 0, 24.00, 24.00),
(49, 0, 24.50, 24.50),
(50, 0, 25.00, 25.00),

(51, 1, 0.50, 25.30),
(52, 2, 0.50, 45.51),
(53, 3, 0.50, 48.61),
(54, 4, 0.50, 48.61),
(55, 5, 0.50, 49.92),
(56, 6, 0.50, 58.65),
(57, 7, 0.50, 60.68),

(58, 1, 1.00, 31.34),
(59, 2, 1.00, 54.69),
(60, 3, 1.00, 58.27),
(61, 4, 1.00, 58.69),
(62, 5, 1.00, 62.00),
(63, 6, 1.00, 74.26),
(64, 7, 1.00, 78.56),

(65, 1, 1.50, 37.38),
(66, 2, 1.50, 63.87),
(67, 3, 1.50, 67.93),
(68, 4, 1.50, 68.77),
(69, 5, 1.50, 74.08),
(70, 6, 1.50, 89.87),
(71, 7, 1.50, 96.44),

(72, 1, 2.00, 43.42),
(73, 2, 2.00, 73.05),
(74, 3, 2.00, 77.59),
(75, 4, 2.00, 78.85),
(76, 5, 2.00, 86.16),
(77, 6, 2.00, 105.48),
(78, 7, 2.00, 114.32),

(79, 1, 2.50, 48.58),
(80, 2, 2.50, 80.16),
(81, 3, 2.50, 85.29),
(82, 4, 2.50, 87.15),
(83, 5, 2.50, 96.75),
(84, 6, 2.50, 119.19),
(85, 7, 2.50, 131.66),

(86, 1, 3.00, 53.74),
(87, 2, 3.00, 87.27),
(88, 3, 3.00, 92.99),
(89, 4, 3.00, 95.45),
(90, 5, 3.00, 107.34),
(91, 6, 3.00, 132.90),
(92, 7, 3.00, 149.00),

(93, 1, 3.50, 58.90),
(94, 2, 3.50, 94.38),
(95, 3, 3.50, 100.69),
(96, 4, 3.50, 103.75),
(97, 5, 3.50, 117.93),
(98, 6, 3.50, 146.61),
(99, 7, 3.50, 166.34),

(100, 1, 4.00, 64.06),
(101, 2, 4.00, 101.49),
(102, 3, 4.00, 108.39),
(103, 4, 4.00, 112.05),
(104, 5, 4.00, 128.52),
(105, 6, 4.00, 160.32),
(106, 7, 4.00, 183.68),

(107, 1, 4.50, 69.22),
(108, 2, 4.50, 108.60),
(109, 3, 4.50, 116.09),
(110, 4, 4.50, 120.35),
(111, 5, 4.50, 139.11),
(112, 6, 4.50, 174.04),
(113, 7, 4.50, 201.02),

(114, 1, 5.00, 74.38),
(115, 2, 5.00, 115.71),
(116, 3, 5.00, 123.79),
(117, 4, 5.00, 128.65),
(118, 5, 5.00, 149.70),
(119, 6, 5.00, 187.74),
(120, 7, 5.00, 218.36),

(121, 1, 5.50, 79.54),
(122, 2, 5.50, 122.82),
(123, 3, 5.50, 131.49),
(124, 4, 5.50, 136.95),
(125, 5, 5.50, 160.29),
(126, 6, 5.50, 201.45),
(127, 7, 5.50, 235.70),

(128, 1, 6.00, 84.70),
(129, 2, 6.00, 129.93),
(130, 3, 6.00, 139.19),
(131, 4, 6.00, 145.25),
(132, 5, 6.00, 170.88),
(133, 6, 6.00, 215.16),
(134, 7, 6.00, 253.04),

(135, 1, 6.50, 89.86),
(136, 2, 6.50, 137.04),
(137, 3, 6.50, 146.89),
(138, 4, 6.50, 153.55),
(139, 5, 6.50, 181.47),
(140, 6, 6.50, 228.87),
(141, 7, 6.50, 270.38),

(142, 1, 7.00, 95.02),
(143, 2, 7.00, 144.15),
(144, 3, 7.00, 154.59),
(145, 4, 7.00, 161.85),
(146, 5, 7.00, 192.06),
(147, 6, 7.00, 242.58),
(148, 7, 7.00, 287.72),

(149, 1, 7.50, 100.18),
(150, 2, 7.50, 151.26),
(151, 3, 7.50, 162.29),
(152, 4, 7.50, 170.15),
(153, 5, 7.50, 202.65),
(154, 6, 7.50, 256.29),
(155, 7, 7.50, 305.06),

(156, 1, 8.00, 105.34),
(157, 2, 8.00, 158.37),
(158, 3, 8.00, 169.99),
(159, 4, 8.00, 178.45),
(160, 5, 8.00, 213.24),
(161, 6, 8.00, 270.00),
(162, 7, 8.00, 322.40),

(163, 1, 8.50, 110.50),
(164, 2, 8.50, 165.48),
(165, 3, 8.50, 177.69),
(166, 4, 8.50, 186.75),
(167, 5, 8.50, 223.83),
(168, 6, 8.50, 283.71),
(169, 7, 8.50, 339.74),

(170, 1, 9.00, 115.66),
(171, 2, 9.00, 172.59),
(172, 3, 9.00, 185.39),
(173, 4, 9.00, 195.05),
(174, 5, 9.00, 234.42),
(175, 6, 9.00, 297.42),
(176, 7, 9.00, 357.08),

(177, 1, 9.50, 120.82),
(178, 2, 9.50, 179.70),
(179, 3, 9.50, 193.09),
(180, 4, 9.50, 203.35),
(181, 5, 9.50, 245.01),
(182, 6, 9.50, 311.13),
(183, 7, 9.50, 374.42),

(184, 1, 10.00, 125.98),
(185, 2, 10.00, 186.81),
(186, 3, 10.00, 200.79),
(187, 4, 10.00, 211.65),
(188, 5, 10.00, 255.60),
(189, 6, 10.00, 324.84),
(190, 7, 10.00, 391.76),

(191, 1, 11.00, 129.86),
(192, 2, 11.00, 192.71),
(193, 3, 11.00, 207.41),
(194, 4, 11.00, 218.93),
(195, 5, 11.00, 264.42),
(196, 6, 11.00, 335.52),
(197, 7, 11.00, 404.32),

(198, 1, 12.00, 133.74),
(199, 2, 12.00, 198.61),
(200, 3, 12.00, 214.03),
(201, 4, 12.00, 226.21),
(202, 5, 12.00, 273.24),
(203, 6, 12.00, 346.20),
(204, 7, 12.00, 416.88),

(205, 1, 13.00, 137.62),
(206, 2, 13.00, 204.51),
(207, 3, 13.00, 220.65),
(208, 4, 13.00, 233.49),
(209, 5, 13.00, 282.06),
(210, 6, 13.00, 356.88),
(211, 7, 13.00, 429.44),

(212, 1, 14.00, 141.50),
(213, 2, 14.00, 210.41),
(214, 3, 14.00, 227.27),
(215, 4, 14.00, 240.77),
(216, 5, 14.00, 290.88),
(217, 6, 14.00, 367.56),
(218, 7, 14.00, 442.00),

(219, 1, 15.00, 145.38),
(220, 2, 15.00, 216.31),
(221, 3, 15.00, 233.89),
(222, 4, 15.00, 248.05),
(223, 5, 15.00, 299.70),
(224, 6, 15.00, 378.24),
(225, 7, 15.00, 454.56),

(226, 1, 16.00, 149.26),
(227, 2, 16.00, 222.21),
(228, 3, 16.00, 240.51),
(229, 4, 16.00, 255.33),
(230, 5, 16.00, 308.52),
(231, 6, 16.00, 388.92),
(232, 7, 16.00, 467.12),

(233, 1, 17.00, 153.14),
(234, 2, 17.00, 228.11),
(235, 3, 17.00, 247.13),
(236, 4, 17.00, 262.61),
(237, 5, 17.00, 317.34),
(238, 6, 17.00, 399.60),
(239, 7, 17.00, 479.68),

(240, 1, 18.00, 157.02),
(241, 2, 18.00, 234.01),
(242, 3, 18.00, 253.75),
(243, 4, 18.00, 269.89),
(244, 5, 18.00, 326.16),
(245, 6, 18.00, 410.28),
(246, 7, 18.00, 492.24),

(247, 1, 19.00, 160.90),
(248, 2, 19.00, 239.91),
(249, 3, 19.00, 260.37),
(250, 4, 19.00, 277.17),
(251, 5, 19.00, 334.98),
(252, 6, 19.00, 420.96),
(253, 7, 19.00, 504.80),

(254, 1, 20.00, 164.78),
(255, 2, 20.00, 245.81),
(256, 3, 20.00, 266.99),
(257, 4, 20.00, 284.45),
(258, 5, 20.00, 343.80),
(259, 6, 20.00, 431.64),
(260, 7, 20.00, 517.36),

(261, 1, 21.00, 168.66),
(262, 2, 21.00, 251.71),
(263, 3, 21.00, 273.61),
(264, 4, 21.00, 291.73),
(265, 5, 21.00, 352.62),
(266, 6, 21.00, 442.32),
(267, 7, 21.00, 529.92),

(268, 1, 22.00, 172.54),
(269, 2, 22.00, 257.61),
(270, 3, 22.00, 280.23),
(271, 4, 22.00, 299.01),
(272, 5, 22.00, 361.44),
(273, 6, 22.00, 453.00),
(274, 7, 22.00, 542.48),

(275, 1, 23.00, 176.42),
(276, 2, 23.00, 263.51),
(277, 3, 23.00, 286.85),
(278, 4, 23.00, 306.29),
(279, 5, 23.00, 370.26),
(280, 6, 23.00, 463.68),
(281, 7, 23.00, 555.04),

(282, 1, 24.00, 180.30),
(283, 2, 24.00, 269.41),
(284, 3, 24.00, 293.47),
(285, 4, 24.00, 313.57),
(286, 5, 24.00, 379.08),
(287, 6, 24.00, 474.36),
(288, 7, 24.00, 567.60),

(289, 1, 25.00, 184.18),
(290, 2, 25.00, 275.31),
(291, 3, 25.00, 300.09),
(292, 4, 25.00, 320.85),
(293, 5, 25.00, 387.90),
(294, 6, 25.00, 485.04),
(295, 7, 25.00, 580.16)");
}
/*** ***/
protected function ebDone()
{
return "<div class='well'><b>Done</b></div>";
}

/*** ***/
protected function ebNotDone()
{
return "<div class='well'><b>Sorry Not Done</b></div>";
}

/*** ***/
protected function ebWithdrawalPaymentDone()
{
return "<div class='well'><b>Payment Done</b></div>";
}
/*** ***/
protected function ebDoneWithdrawal()
{
return "<div class='well'><b>Withdrawal Request Submitted</b></div>";
}

/*** ***/
public function posVisulString($string)
{
// Make alphanumeric (removes all other characters)
$string = preg_replace("/[^a-zA-Z0-9\-\,\(\)\/]/", "", $string);
// Clean up multiple dashes to whitespaces
$string = preg_replace("/[\s-]+/", " ", $string);
return $string;
}


/*** ***/
public function visulString($string)
{
// Make alphanumeric (removes all other characters)
$string = preg_replace("/[^a-zA-Z0-9\-\,\(\)\/]/", "", $string);
// Convert -s to 's
$string = str_replace("-s", "'s", $string);
// Convert and to &
$string = str_replace("-and-", " & ", $string);
// Convert Only T' to T-
$string = str_replace("T'", "T-", $string);
// Clean up multiple dashes to whitespaces
$string = preg_replace("/[\s-]+/", " ", $string);
return $string;
}

/*** ***/
public function seoUrl($string)
{
/** Lower case everything ***/
$string = strtolower($string);
/*** Make alphanumeric (removes all other characters) ***/
$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
/*** Clean up multiple dashes or whitespaces ***/
$string = preg_replace("/[\s-]+/", " ", $string);
/*** Convert whitespaces and underscore to dash ***/
$string = preg_replace("/[\s_]/", "-", $string);
return $string;
}

/*** ***/
private function businessSetting()
{
$this->checkTablesToCreate();
/*** ***/
$queryExcessusers = "SELECT ebusername, active, account_type, member_level FROM  excessusers WHERE account_type='admin' AND member_level=13";
$returnExcessuser = eBConDb::eBgetInstance()->eBgetConection()->query($queryExcessusers);
$resultCountExcessuser = $returnExcessuser->num_rows;
$rowExcessuser = mysqli_fetch_array($returnExcessuser);
if(!empty($rowExcessuser['ebusername'])){$adminUser = $rowExcessuser['ebusername'];}
if(!empty($adminUser)){$this->AdminUserIsSet = $adminUser;}
if(!empty($rowExcessuser['active'])){$adminEmailVerified = $rowExcessuser['active'];}
//
if(isset($adminUser) and isset($adminEmailVerified)==1)
{
$queryLongitude = "SELECT business_geolocation_longitude FROM  excess_merchant_business_details WHERE business_username='$adminUser'";
$returnLongitude = eBConDb::eBgetInstance()->eBgetConection()->query($queryLongitude);
$rowLongitude = mysqli_fetch_array($returnLongitude);
$businessLongitude = $rowLongitude['business_geolocation_longitude'];
//
if(empty($businessLongitude))
{
include_once (ebaccess.'/access-admin-merchant-first-time-set-up.php');
}
$this->referral();
}
//
}

/*** ***/
}
?>