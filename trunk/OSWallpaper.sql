-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2009 at 09:57 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";



-- --------------------------------------------------------

--
-- POWERED by OSWallpaper @ http://www.wallpaperscript.org
--

DROP TABLE IF EXISTS `wallpaper_adsense`;
CREATE TABLE `wallpaper_adsense` (
  `adsense_id` int(11) NOT NULL auto_increment,
  `description` varchar(100) NOT NULL default '',
  `code` text NOT NULL,
  PRIMARY KEY  (`adsense_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `wallpaper_adsense`
--

INSERT INTO `wallpaper_adsense` (`adsense_id`, `description`, `code`) VALUES
(1, '728x90 Leaderboard', '<a href="http://www.webune.com"><img 
\nsrc="http://www.wallpaperama.com/post-images/forums/200903/18p-7195-header.jpg" alt="wallpaperama" border="0" /></a>'),
(2, '120x600 Skyscraper', '<a href="http://www.wallpaperama.com"><img 
\nsrc="http://www.wallpaperama.com/post-images/forums/200903/18p-7195-120x600.jpg" alt="Open Source Wallpaper" border="0" 
/></a>'),
(3, '250x250 Square', '<a href="http://www.oswallpaper.com"><img 
\nsrc="http://www.wallpaperama.com/post-images/forums/200903/18p-7195-box.jpg" alt="wallpaper hosting" border="0" /></a>');

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_category`
--

DROP TABLE IF EXISTS `wallpaper_category`;
CREATE TABLE `wallpaper_category` (
  `category_id` int(11) NOT NULL auto_increment,
  `category_name` varchar(50) default NULL,
  `category_url` varchar(100) NOT NULL,
  `category_description` varchar(255) default NULL,
  `category_keywords` varchar(255) default NULL,
  `wallpaper_numb` int(11) NOT NULL default '0',
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `wallpaper_category`
--

INSERT INTO `wallpaper_category` (`category_id`, `category_name`, `category_url`, `category_description`, 
`category_keywords`, `wallpaper_numb`) VALUES
(1, 'example category', 'example', 'These are just some example wallpapers for the open source wallpaper script', 'example, 
wallpapers, \nfree, open, source, category', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_comments`
--

DROP TABLE IF EXISTS `wallpaper_comments`;
CREATE TABLE `wallpaper_comments` (
  `id` int(11) NOT NULL auto_increment,
  `wallpaper_id` int(11) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `time` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `email` varchar(75) NOT NULL default '',
  `comments` varchar(255) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `wallpaper_comments`
--

INSERT INTO `wallpaper_comments` (`id`, `wallpaper_id`, `ip`, `time`, `name`, `email`, `comments`, `status`) VALUES
(1, 367, '7f000001', 1236475845, 'webune', 'example@example.com', 'this script was created in partnershipe with webune.com', 
1),
(2, 388, '7f000001', 1236565026, 'wallpaperama', 'example@example.com', 'please tell your friends about wallpaperama.com', 
1),
(3, 388, '7f000001', 1236565280, 'wallpaperama.com', 'example@example.com', 'help us improve this simple wallpaper script 
and support us', 1),
(4, 1, '46ee5735', 1237150612, 'open source wallpaper script', 'example@example.com', 'we hope you like our wallpaper script 
as we get better at it', 1),
(5, 1, 'c0808644', 1237164369, 'samuel jackson', 'example@example.com', 'i do like it but wish i was at the beach right 
now', 1),
(6, 2, 'c0808544', 1237246069, 'wallpaper link exchange', 'example@example.com', 'if you want to get your wallpaper site 
more traffic, exchange link with us at wallpaperama.com', 1),
(7, 14, '4f77fc80', 1237731069, 'Raul', 'test@test.com', 'if you like this open source wallpaper please help support us', 
1),
(8, 12, '7447a1a7', 1238651811, 'wallpaperlinks.com', 'data4mobile.com@gmail.com', 'thanks thas is nice wallpaper i am 
really happy to join this one', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_config`
--

DROP TABLE IF EXISTS `wallpaper_config`;
CREATE TABLE `wallpaper_config` (
  `config_id` int(11) NOT NULL auto_increment,
  `config_name` varchar(100) NOT NULL default '',
  `config_value` varchar(100) NOT NULL default '',
  `config_desc` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `wallpaper_config`
--

INSERT INTO `wallpaper_config` (`config_id`, `config_name`, `config_value`, `config_desc`) VALUES
(1, 'SiteName', 'Powered by OSWallpaper', 'Website Name'),
(2, 'DefaultPage', 'index', 'This is the default page. index is for pages/index.php'),
(3, 'ErrorTime', '50', 'Number of milliseconds to load refering page with \r\n\r\njavascript'),
(4, 'WallpaperPerPage', '12', 'Number Of Wallpapers Icons Per Page in Category'),
(5, 'WallpaperPerPageMaxLinks', '10', 'Number of Page Links to show in pagination of \r\n\r\neach wallpaper category'),
(6, 'UploadFileMaxSize', '500000', 'Maximum allowed wallpaper image file size in \r\n\r\nBytes'),
(7, 'ThumbWidth', '310', 'Width of the thumbnail image for each wallpaper'),
(8, 'ThumbHeight', '239', 'Height of the thumbnail image for each wallpaper'),
(9, 'IconWidth', '160', 'Width of the icon image for each wallpaper'),
(10, 'IconHeight', '120', 'Height of the icon image for each wallpaper'),
(11, 'Theme', 'default', 'this is the default theme layout'),
(18, 'SiteUrl', '', 'SIte Url Where Script Is Installed'),
(19, 'SiteUrlWalls', '', 'Wallpaper Url Directory for all wallpaper images'),
(20, 'ScriptDIr', '', 'this is the script path dircectory'),
(21, 'WallpaperDir', '', 'The Directory Path Where the script is installed'),
(22, 'ModRewrite', '0', '0=Disabled, 1= Enabled'),
(23, 'IsWriteable', '0', 'Check if all the wallpaper directories have the right permission to upload wallpapers');

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_links`
--

DROP TABLE IF EXISTS `wallpaper_links`;
CREATE TABLE `wallpaper_links` (
  `link_id` int(11) NOT NULL auto_increment,
  `link_title` varchar(50) NOT NULL default '',
  `link_url` varchar(200) NOT NULL default '',
  `link_description` varchar(255) NOT NULL default '',
  `link_username` varchar(25) NOT NULL default '',
  `link_useremail` varchar(55) NOT NULL default '',
  `user_id` int(11) NOT NULL default '0',
  `link_status` tinyint(1) default '1',
  PRIMARY KEY  (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `wallpaper_links`
--

INSERT INTO `wallpaper_links` (`link_id`, `link_title`, `link_url`, `link_description`, `link_username`, `link_useremail`, 
`user_id`, `link_status`) VALUES
(1, 'Free Wallpapers', 'http://www.wallpaperama.com', 'an amazing collection of wallpapers users can download for free', '', 
'', 1, 1),
(2, 'Wallpaper Hosting', 'http://www.webune.com', 'an amazing collection of wallpapers users can download for free', '', '', 
1, 1),
(3, 'Nice Wallpapers', 'http://www.nicewallpapers.com/', 'very nice wallpapers for your computer desktop background', '', 
'', 1, 1),
(4, 'OpenSource Wallpaper', 'http://www.OSwallpaper.com', 'an open source wallpaper for your computer desktop back 
background for free \ndownloads', 'Oswallpaper', 'none@non.com', 1, 1),
(5, 'Wallpaper Webmaster', 'http://www.wallpaperwebmasters.com', 'Wallpaper webmasters resources. If you are looking for 
support for your \nwallpaper website, we can help', 'wallpapermasters', 'none@wallpapermasters.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_pages`
--

DROP TABLE IF EXISTS `wallpaper_pages`;
CREATE TABLE `wallpaper_pages` (
  `id` int(11) NOT NULL auto_increment,
  `page_url` varchar(50) NOT NULL default '',
  `page_name` varchar(50) NOT NULL default '',
  `page_type` tinyint(4) NOT NULL default '1',
  `page_title` varchar(100) NOT NULL default '',
  `page_description` varchar(255) NOT NULL default '',
  `page_keywords` varchar(255) NOT NULL default '',
  `page_level` tinyint(1) NOT NULL default '1',
  `page_content` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `wallpaper_pages`
--

INSERT INTO `wallpaper_pages` (`id`, `page_url`, `page_name`, `page_type`, `page_title`, `page_description`, 
`page_keywords`, `page_level`, `page_content`) VALUES
(1, 'index', 'home', 2, 'Demo Open Source Wallpaper Script', 'this is a demostration of our open source free wallpaper 
script in \ndevelopement in beta', 'wallpaper, script, open, source, free, download', 0, 'this is the default index page'),
(2, 'login', 'login', 2, 'login', 'this is the page to login', 'wallpapers,login', 0, ''),
(3, 'about-us', 'about us', 1, 'about us page', 'this is the about us page', 'about, us', 0, 'this is the default about us 
page, you can \nchange this text in the admin section as this is a database page'),
(4, 'admin-add-page', 'add page', 2, 'admin add page', '', '', 0, ''),
(5, 'logout', 'logout', 2, 'logging out from site', 'this page is used to logout', 'logout', 1, ''),
(6, 'register', 'register', 2, 'register for new account', 'this page is for users to register their account to this site', 
'register, sign \nin, new members', 1, ''),
(7, 'forgot-password', 'forgot password', 2, 'Retrieve Forgotten Password', 'us this page to retrieve your forgotten 
password', 'forgot \npassword, reset, retrieve', 1, ''),
(8, 'passwd', 'resetpassword', 2, 'Resetting forgotten password', 'use this page to reset your fogotten password', 'reset, 
password', 1, ''),
(9, 'admin', 'admin', 2, 'Admin Page', 'this is page is for admin', 'admin', 10, ''),
(10, 'admin-category', 'admin-category', 2, 'admin-category', 'wallpaper category admin', '', 10, ''),
(11, 'admin-wallpaper', 'admin-wallpaper', 2, 'admin-wallpaper', 'wallpaper admin', '', 10, ''),
(12, 'upload', 'upload', 2, 'upload wallpaper', 'use this page to upload wallpaper', '', 2, ''),
(13, 'links', 'links', 2, 'wallpaper links webistes', 'this page contains a list of related walllpaper sites', 'walpaper, 
links', 1, ''),
(14, 'add-link', 'Add Link', 2, 'Add your wallpaper website link', 'use this page to add your like and exchange links with 
us', 'link, \nexchange', 1, ''),
(15, 'admin-peding-wallpapers', 'admin peding wallpapers', 2, 'Manage pending wallpapers', 'this is a admin page for pending 
wallpapers', '', 10, ''),
(16, 'admin-config', 'admin-config', 2, 'Configure Site', 'use this page to configure your site', '', 10, ''),
(17, 'admin-adsense', 'adsense', 2, 'Adsense Admin', 'use this page to admin your adsence code', '', 10, ''),
(18, 'admin-links', 'addmin links', 2, 'Links Administration', 'use this page to manage link partners', '', 10, ''),
(19, 'profile', 'profile', 2, 'User Profile', 'this page is for users profile', 'profiles', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_size`
--

DROP TABLE IF EXISTS `wallpaper_size`;
CREATE TABLE `wallpaper_size` (
  `sizeid` int(10) unsigned NOT NULL default '0',
  `width` int(10) unsigned NOT NULL default '0',
  `height` int(10) unsigned NOT NULL default '0',
  UNIQUE KEY `sizeid` (`sizeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallpaper_size`
--

INSERT INTO `wallpaper_size` (`sizeid`, `width`, `height`) VALUES
(1, 800, 600),
(2, 1024, 768),
(3, 1280, 960),
(4, 1600, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_size_match`
--

DROP TABLE IF EXISTS `wallpaper_size_match`;
CREATE TABLE `wallpaper_size_match` (
  `wallpaper_id` int(10) unsigned NOT NULL default '0',
  `wallpaper_url` varchar(255) NOT NULL,
  `sizeid` int(3) unsigned NOT NULL default '0',
  KEY `wallpaper_id` (`wallpaper_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wallpaper_size_match`
--

INSERT INTO `wallpaper_size_match` (`wallpaper_id`, `wallpaper_url`, `sizeid`) VALUES
(1, 'wallpaperama-com', 1),
(2, 'linux-php', 1),
(3, 'linux', 1),
(4, 'mysql', 1),
(5, 'jesus', 1),
(6, 'webune', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_users`
--

DROP TABLE IF EXISTS `wallpaper_users`;
CREATE TABLE `wallpaper_users` (
  `user_id` int(10) NOT NULL auto_increment,
  `user_level` int(11) NOT NULL default '2',
  `user_date` varchar(15) default NULL,
  `user_ip` varchar(20) NOT NULL default '',
  `user_name` varchar(50) NOT NULL default '',
  `user_password` varchar(32) NOT NULL default '',
  `reset_password` varchar(32) default NULL,
  `user_email` varchar(255) default NULL,
  `user_status` int(11) default NULL,
  `user_wallpapers` int(11) NOT NULL default '0',
  UNIQUE KEY `userid` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wallpaper_users`
--

INSERT INTO `wallpaper_users` (`user_id`, `user_level`, `user_date`, `user_ip`, `user_name`, `user_password`, 
`reset_password`, `user_email`, `user_status`, `user_wallpapers`) VALUES
(1, 10, 'Jul 10, 2005', '71.134.24.161', 'admin', 'fc4d477402d75c8cf7c37e07d68ada9c', '', 'admin@wallpaperscript.org', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallpaper_wallpaper`
--

DROP TABLE IF EXISTS `wallpaper_wallpaper`;
CREATE TABLE `wallpaper_wallpaper` (
  `wallpaper_id` int(10) NOT NULL auto_increment,
  `category_id` int(10) unsigned default NULL,
  `wallpaper_name` varchar(255) default NULL,
  `wallpaper_url` varchar(100) NOT NULL default '',
  `wallpaper_description` varchar(255) NOT NULL default '',
  `wallpaper_keywords` varchar(255) NOT NULL default '',
  `wallpaper_downloads` int(10) unsigned default '0',
  `wallpaper_views` int(10) unsigned default '0',
  `user_id` int(10) unsigned default NULL,
  `date` int(10) NOT NULL default '0',
  `active` tinyint(1) NOT NULL default '0',
  `sizeid` tinyint(4) NOT NULL default '0',
  UNIQUE KEY `recipieid` (`wallpaper_id`),
  UNIQUE KEY `wallpaper_url` (`wallpaper_url`),
  UNIQUE KEY `wallpaper_name` (`wallpaper_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `wallpaper_wallpaper`
--

INSERT INTO `wallpaper_wallpaper` (`wallpaper_id`, `category_id`, `wallpaper_name`, `wallpaper_url`, 
`wallpaper_description`, `wallpaper_keywords`, `wallpaper_downloads`, `wallpaper_views`, `user_id`, `date`, `active`, 
`sizeid`) VALUES
(1, 1, 'wallpaperama com', 'wallpaperama-com', '', '', 0, 0, 1, 1239980417, 1, 1),
(2, 1, 'linux php', 'linux-php', '', '', 0, 0, 1, 1239980684, 1, 1),
(3, 1, 'linux', 'linux', '', '', 0, 0, 1, 1239980847, 1, 1),
(4, 1, 'mysql', 'mysql', '', '', 0, 0, 1, 1239981427, 1, 1),
(5, 1, 'jesus', 'jesus', '', '', 0, 0, 1, 1239981563, 1, 1),
(6, 1, 'webune', 'webune', '', '', 0, 0, 1, 1239981921, 1, 1);

