/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : mycms

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-03-18 11:11:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned DEFAULT NULL,
  `image_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `text` text,
  `user_id` int(10) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`article_id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES ('1', '1', null, 'Term of Use', '&lt;p&gt;This web site, together with the sub-sites that are accessible through it, (collectively, this &quot;Site&quot;) is published and maintained by Sample Kings Corporation. When you access, browse or use this Site, you accept, without limitation or qualification, the terms of use set forth below. When you access the sub-sites that are accessible through this Site, you accept any additional terms of such sub-sites if they have their own terms of use. Please read them carefully. Information on this Site may contain technical inaccuracies or typographical errors. Information may be altered or updated at any time without notice.&lt;br /&gt; &lt;br /&gt; &lt;br /&gt; Electronic Communications&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;You consent to receive communications from Sample Kings electronically. Sample Kings will communicate with you by e-mail transmission or by posting to this Site. You agree that all communications that Sample Kings provides to you electronically satisfy any legal requirement that such communications be in writing.&lt;br /&gt; &lt;br /&gt; &lt;br /&gt; Use of Site&lt;/p&gt;\r\n&lt;p&gt;This Site is provided for your personal and non-commercial use only. All content included in this Site, including but not limited to any text, graphics, images, logos, button icons, data compilations, software, audio and video (collectively, &quot;Materials&quot;), is the property of Sample Kings or its content suppliers, and you may not distribute, exchange, modify, reproduce, perform, sell or transmit the Materials for any business, commercial or public purposes. The Materials are protected by applicable laws, including the USA and international copyright and trademark laws, and any unauthorized use of any Materials may violate copyright, trademark, and other applicable laws. You may not frame or utilize framing techniques to enclose any portion of this Site or any Materials without express written consent of Sample Kings. You are granted a revocable and nonexclusive right to create a hyperlink to this Site so long as the link does not portray Sample Kings, its affiliates, or their products or services in a false, misleading, derogatory, or otherwise offensive manner. You may not use any Sample Kings logo or other Materials as part of the link without express written consent of Sample Kings If you breach any of these Terms, your authorization to use this Site automatically terminates and you must immediately destroy any downloaded or printed Materials herefrom.&lt;/p&gt;', '7', '2014-03-15 21:27:15', '2014-03-15 00:00:00');
INSERT INTO `articles` VALUES ('16', '1', null, 'Hello world', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '10', '2014-03-15 14:53:38', '2014-03-15 00:00:00');
INSERT INTO `articles` VALUES ('17', '2', null, 'Javascript I', 'asdfsaf\r\n<span>\r\n        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n    </span>\r\n    <span>\r\n        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.\r\n    </span>\r\n    <span>\r\n        Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.\r\n    </span>\r\n    <span>\r\n        Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.\r\n    </span>', '10', '2014-03-15 15:24:10', '2014-03-15 00:00:00');
INSERT INTO `articles` VALUES ('18', '2', null, 'Javascript II', '<span>\r\n        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n    </span>\r\n    <span>\r\n        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.\r\n    </span>\r\n    <span>\r\n        Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.\r\n    </span>\r\n    <span>\r\n        Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.\r\n    </span>', '10', '2014-03-15 15:25:21', '2014-03-15 00:00:00');
INSERT INTO `articles` VALUES ('22', '3', null, 'Application Demo', '<span>\r\n        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n    </span>\r\n    <span>\r\n        Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.\r\n    </span>\r\n    <span>\r\n        Fusce convallis, mauris imperdiet gravida bibendum, nisl turpis suscipit mauris, sed placerat ipsum urna sed risus. In convallis tellus a mauris. Curabitur non elit ut libero tristique sodales. Mauris a lacus. Donec mattis semper leo. In hac habitasse platea dictumst. Vivamus facilisis diam at odio. Mauris dictum, nisi eget consequat elementum, lacus ligula molestie metus, non feugiat orci magna ac sem. Donec turpis. Donec vitae metus. Morbi tristique neque eu mauris. Quisque gravida ipsum non sapien. Proin turpis lacus, scelerisque vitae, elementum at, lobortis ac, quam. Aliquam dictum eleifend risus. In hac habitasse platea dictumst. Etiam sit amet diam. Suspendisse odio. Suspendisse nunc. In semper bibendum libero.\r\n    </span>\r\n    <span>\r\n        Proin nonummy, lacus eget pulvinar lacinia, pede felis dignissim leo, vitae tristique magna lacus sit amet eros. Nullam ornare. Praesent odio ligula, dapibus sed, tincidunt eget, dictum ac, nibh. Nam quis lacus. Nunc eleifend molestie velit. Morbi lobortis quam eu velit. Donec euismod vestibulum massa. Donec non lectus. Aliquam commodo lacus sit amet nulla. Cras dignissim elit et augue. Nullam non diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In hac habitasse platea dictumst. Aenean vestibulum. Sed lobortis elit quis lectus. Nunc sed lacus at augue bibendum dapibus.\r\n    </span>', '10', '2014-03-15 20:26:21', '2014-03-15 00:00:00');
INSERT INTO `articles` VALUES ('26', null, null, 'Datetime Function', '&lt;p style=&quot;margin: 0in; font-family: Calibri; font-size: 11.0pt;&quot;&gt;&amp;nbsp;In MySQL, dates and time are always expressed in descending order from the largest unit to the smallest: year, month, date, hour, minutes, seconds. Hours are always measured using the 24-hour clock with midnight expressed as 00:00:00.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in; font-family: Calibri; font-size: 11.0pt;&quot;&gt;For example, 2014-02-08 is always in Y-M-D order.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in; font-family: Calibri; font-size: 11.0pt; color: #e84c22;&quot;&gt;So we need to format the date correctly before insertting into Databse.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in; font-family: Calibri; font-size: 11.0pt;&quot;&gt;It is best to validate and format date with PHP before inserting into MySQL.&lt;/p&gt;\r\n&lt;p style=&quot;margin: 0in; font-family: Calibri; font-size: 11.0pt;&quot;&gt;Tools you can use for date input from users:&lt;/p&gt;\r\n&lt;ul style=&quot;margin-left: .375in; direction: ltr; unicode-bidi: embed; margin-top: 0in; margin-bottom: 0in;&quot; type=&quot;disc&quot;&gt;\r\n&lt;li style=&quot;margin-top: 0; margin-bottom: 0; vertical-align: middle;&quot;&gt;&lt;span style=&quot;font-family: Calibri; font-size: 11.0pt;&quot;&gt;JqueryUI datepicker.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;margin-top: 0; margin-bottom: 0; vertical-align: middle;&quot;&gt;&lt;span style=&quot;font-family: Calibri; font-size: 11.0pt;&quot;&gt;HTML5 built-in Date input form. Check browser compatibility.&lt;/span&gt;&lt;/li&gt;\r\n&lt;li style=&quot;margin-top: 0; margin-bottom: 0; vertical-align: middle;&quot;&gt;&lt;span style=&quot;font-family: Calibri; font-size: 11.0pt;&quot;&gt;Built customized input form with Y, M, D input field.&lt;/span&gt;&lt;/li&gt;\r\n&lt;/ul&gt;', '10', '2014-03-17 23:02:26', '2014-03-18 00:00:00');
INSERT INTO `articles` VALUES ('27', '23', null, 'Datetime Function', '&lt;p&gt;In MySQL, dates and time are always expressed in descending order from the largest unit to the smallest: year, month, date, hour, minutes, seconds. Hours are always measured using the 24-hour clock with midnight expressed as 00:00:00.&lt;br /&gt;For example, 2014-02-08 is always in Y-M-D order.&lt;br /&gt;So we need to format the date correctly before insertting into Databse.&lt;br /&gt;&lt;br /&gt;It is best to validate and format date with PHP before inserting into MySQL.&lt;br /&gt;&lt;br /&gt;Tools you can use for date input from users:&lt;br /&gt;&amp;nbsp;&amp;nbsp; &amp;nbsp;- JqueryUI datepicker.&lt;br /&gt;&amp;nbsp;&amp;nbsp; &amp;nbsp;- HTML5 built-in Date input form. Check browser compatibility.&lt;br /&gt;&amp;nbsp;&amp;nbsp; &amp;nbsp;- Built customized input form with Y, M, D input field.&lt;br /&gt;&lt;br /&gt;&lt;/p&gt;', '10', '2014-03-17 23:05:59', '2014-03-17 00:00:00');
INSERT INTO `articles` VALUES ('28', '23', null, 'SQL Basic Syntax', '&lt;p&gt;SELECT [DISTINCT] select_list&lt;br /&gt;FROM table_list&lt;br /&gt;[WHERE where_expression] &lt;br /&gt;[ORDER BY col_name | formula] [ASC | DESC] &lt;br /&gt;[LIMIT [skip_count,] show_count] &lt;br /&gt;&lt;br /&gt;&lt;br /&gt;UPDATE : $q = &quot;UPDATE students SET first_name=\'{$fn}\', last_name=\'{$ln}\', email=\'{$email}\' WHERE id = \'{$uid}\'&quot;;&lt;br /&gt;&lt;br /&gt;use {} curly braces around variable enclosed by single quote\'\'&lt;/p&gt;', '10', '2014-03-17 23:07:20', '2014-03-18 00:00:00');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_description` tinytext,
  `cat_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'PHP', 'PHP and MySQL related topics', 'php.jpg');
INSERT INTO `categories` VALUES ('2', 'Javascript', 'Javascript related topics', 'javascript.png');
INSERT INTO `categories` VALUES ('3', 'Projects', 'Application Demos', null);
INSERT INTO `categories` VALUES ('23', 'Database', 'Database related topics', 'flowchart-v1.png');
INSERT INTO `categories` VALUES ('24', 'Jquery', 'Jquery and Ajax related topics', 'jquery.jpg');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of images
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(20) NOT NULL,
  `access` enum('member','admin') DEFAULT 'member',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('7', 'rattanak', 'rattanak22@gmail.com', 'pass', 'member');
INSERT INTO `users` VALUES ('8', 'rattanak1', 'rattanak22@gmail.com', 'pass', 'member');
INSERT INTO `users` VALUES ('9', 'rattanak2', 'rattanak22@gmail.com', 'pass', 'member');
INSERT INTO `users` VALUES ('10', 'admin', 'admin@mycms.com', 'admin', 'admin');
