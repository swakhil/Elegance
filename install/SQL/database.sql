/*
// +------------------------------------------------------------------------+
// | @Team author : Smart Xplorer (smartxplorer)
// | @Team author email: smartxplorerdev@gmail.com   
// +------------------------------------------------------------------------+
// | Elegance - The Elegant Social Network Platform
// | Copyright (c) 2017 Elegant. All rights reserved.
// +------------------------------------------------------------------------+
*/


SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snv`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(300) NOT NULL DEFAULT '0',
  `email` varchar(300) NOT NULL DEFAULT '0',
  `password` varchar(300) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE IF NOT EXISTS `attempts` (
  `ip` varchar(20) NOT NULL,
  `when` datetime NOT NULL,
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatting`
--

CREATE TABLE IF NOT EXISTS `chatting` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_chat` int(200) NOT NULL,
  `cvid` int(200) NOT NULL,
  `id_user` int(200) NOT NULL,
  `id_session` int(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `cid` int(200) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '0',
  `cpid` int(200) NOT NULL,
  `times_com` varchar(255) NOT NULL,
  `id_user_com` varchar(255) NOT NULL,
  `id_post_owner` varchar(255) NOT NULL,
  `date_send` varchar(255) NOT NULL DEFAULT '0',
  `date_receive` varchar(255) NOT NULL DEFAULT '0',
  `date_seen` varchar(255) NOT NULL DEFAULT '0',
  `adult_content_score` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cid`),
  KEY `cpid` (`cpid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `cvid` int(11) NOT NULL AUTO_INCREMENT,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `dates_cv` varchar(255) NOT NULL,
  PRIMARY KEY (`cvid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cover_position`
--

CREATE TABLE IF NOT EXISTS `cover_position` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) NOT NULL,
  `position_x` varchar(255) NOT NULL DEFAULT '50%',
  `position_y` varchar(255) NOT NULL DEFAULT '50%',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `email_notifications`
--

CREATE TABLE IF NOT EXISTS `email_notifications` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_user` int(200) NOT NULL,
  `follows` varchar(400) NOT NULL DEFAULT '0',
  `comments` varchar(400) NOT NULL DEFAULT '0',
  `likes` varchar(400) NOT NULL DEFAULT '0',
  `shares` varchar(400) NOT NULL DEFAULT '0',
  `messages` varchar(400) NOT NULL DEFAULT '0',
  `block_adult_content` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` varchar(100) NOT NULL,
  `id_recipient` varchar(100) NOT NULL,
  `date_send` varchar(255) NOT NULL DEFAULT '0',
  `date_receive` varchar(255) NOT NULL DEFAULT '0',
  `date_seen` varchar(255) NOT NULL DEFAULT '0',
  `date_format` varchar(255) NOT NULL DEFAULT '0',
  `active` varchar(10) NOT NULL DEFAULT '0',
  `block` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE IF NOT EXISTS `general_settings` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(200) NOT NULL,
  `site_url` varchar(200) NOT NULL,
  `site_logo` varchar(400) NOT NULL DEFAULT '0',
  `site_favicon` varchar(400) NOT NULL,
  `site_desc` varchar(400) NOT NULL,
  `site_desc2` varchar(300) NOT NULL,
  `background_home1` varchar(400) NOT NULL,
  `background_home2` varchar(400) NOT NULL,
  `background_home3` varchar(400) NOT NULL,
  `background_home4` varchar(400) NOT NULL,
  `background_home5` varchar(400) NOT NULL,
  `privacy` text NOT NULL,
  `email_noreply` varchar(400) NOT NULL,
  `email_contact` varchar(100) NOT NULL,
  `meta` text NOT NULL,
  `ads_1` text NOT NULL,
  `ads_2` text NOT NULL,
  `ads_3` text NOT NULL,
  `ads_4` text NOT NULL,
  `ads_text_1` text NOT NULL,
  `ads_text_2` text NOT NULL,
  `ads_text_3` text NOT NULL,
  `ads_text_4` text NOT NULL,
  `ads_link_1` varchar(400) NOT NULL,
  `ads_link_2` varchar(400) NOT NULL,
  `ads_link_3` varchar(400) NOT NULL,
  `ads_link_4` varchar(400) NOT NULL,
  `ads_img_1` varchar(400) NOT NULL,
  `ads_img_2` varchar(400) NOT NULL,
  `ads_img_3` varchar(400) NOT NULL,
  `ads_img_4` varchar(400) NOT NULL,
  `website_ads` varchar(20) NOT NULL DEFAULT '0',
  `ads_options` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_name`, `site_url`, `site_logo`, `site_favicon`, `site_desc`, `site_desc2`, `background_home1`, `background_home2`, `background_home3`, `background_home4`, `background_home5`, `privacy`, `email_noreply`, `email_contact`, `meta`, `ads_1`, `ads_2`, `ads_3`, `ads_4`, `ads_text_1`, `ads_text_2`, `ads_text_3`, `ads_text_4`, `ads_link_1`, `ads_link_2`, `ads_link_3`, `ads_link_4`, `ads_img_1`, `ads_img_2`, `ads_img_3`, `ads_img_4`, `website_ads`, `ads_options`) VALUES
(1, 'Elegance', 'http://localhost/snvtest/', 'assets/logo/logo.png', 'assets/logo/favicon.png', 'Connect the world and people near you!', 'Sharing fun with friends! Every moment can be perfect...', 'assets/img/back_1.jpg', 'assets/img/back_2.jpg', 'assets/img/back_3.jpg', 'assets/img/back_4.jpg', 'assets/img/back_5.jpg', '&#60;div style=&#34;text-align: center;&#34;&#62;&#60;span style=&#34;font-size: x-large;&#34;&#62;&#60;span style=&#34;font-weight: bold;&#34;&#62;Privacy Policy&#60;/span&#62;&#60;/span&#62;&#60;/div&#62;&#60;div style=&#34;text-align: center;&#34;&#62;&#60;span style=&#34;font-weight: bold; font-size: x-large;&#34;&#62;&#60;br&#62;&#60;/span&#62;&#60;/div&#62;&#10;&#10;&#60;p&#62;By visiting this website you agree to be bound by the terms and conditions of this privacy policy. If you do not agree, please do not use or access our website. By mere use of the Website, you expressly consent to, our use and disclosure, of your personal information in accordance with this Privacy Policy. This Privacy Policy is subject to the Terms of Services.&#60;/p&#62;&#10;        &#60;p&#62;We, at Toiljobs value the trust you place in us. We insist upon the highest standards for secure transactions and customer&#39;s information privacy. Please read the following statements to learn about our information gathering and dissemination practices. Our privacy policy is subject to change at any time without notice. To make sure you are aware of any changes, please review this policy periodically&#60;/p&#62;&#10;        &#60;p&#62;We, at &#39;Funds and Toils&#39; and our affiliated companies/organisations worldwide, are committed to respecting your online privacy and recognize your need for appropriate protection and management of any personally identifiable information (&#34;Personal Information&#34;) you share with us. In order to provide a personalised browsing experience, Toiljobs.com may collect information from you, this may include technical or other related information from the device used to access Toiljobs.com including without limitation contact lists in your device and its location, you may also be asked to complete a registration form. When you let us have your preferences, we will be able to deliver or allow you to access the most relevant information that meets your end.&#60;/p&#62;&#10;        &#60;p&#62;&#34;Personal Information&#34; means any information that may be used to identify an individual, including, but not limited to, a first and last name, a home or other physical address and an email address or other contact information, whether at work or at home. In general, you can visit all web pages without telling us who you are or revealing any Personal Information about yourself.&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Cookies and Other Tracking Technologies&#60;/h4&#62;&#10;        &#60;p&#62;Some of our web pages utilize &#34;cookies&#34; and other tracking technologies. A &#34;cookie&#34; is a small text file that may be used, for example, to collect information about activity on the web site. Some cookies and other technologies may serve to recall Personal Information previously indicated by a Web user. Most browsers allow you to control cookies, including whether or not to accept them and how to remove them.&#60;/p&#62;&#10;        &#60;p&#62;You may set most browsers to notify you if you receive a cookie, or you may choose to block cookies with your browser, but please note that if you choose to erase or block your cookies, you will need to re-enter your original user ID and password to gain access to certain parts of the web site. &#60;/p&#62;&#10;        &#60;p&#62;Tracking technologies may record information such as internet domain and host names; internet protocol (IP) addresses; browser software and operating system types; clickstream patterns; and dates and times that our site is accessed. Our use of cookies and other tracking technologies allows us to improve our web site and your web experience. We may also analyze information that does not contain Personal Information for trends and statistics.&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Third Party Services&#60;/h4&#62;&#10;        &#60;p&#62;Third parties provide certain services available on www.toiljobs.com on Funds and Toil&#39;s behalf. &#39;Funds and Toils&#39; may provide information, including Personal Information, that &#39;Funds and Toils&#39; collects on the web to third-party service providers to help us deliver programs, products, information, and services. Service providers are also an important means by which &#39;Funds and Toils&#39; maintains its websites and mailing lists. &#39;Funds and Toils&#39; will take reasonable steps to ensure that these third-party service providers are obligated to protect Personal Information on Funds and Toilsâ€™s behalf.&#60;/p&#62;&#10;        &#60;p&#62;&#39;Funds and Toils&#39; does not intend to transfer Personal Information without your consent to third parties who are not bound to act on Funds and Toils&#39;s behalf unless such transfer is legally required. Similarly, it is against Funds and Toils&#39;s policy to sell Personal Information collected online without consent.&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Your Consent&#60;/h4&#62;&#10;        &#60;p&#62;By using this web site, you consent to the terms of our online Privacy Policy and to Funds and Toils&#39;s processing of Personal Information for the purposes given above as well as those explained where &#39;Funds and Toils&#39; collects Personal Information on the web&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Information security&#60;/h4&#62;&#10;        &#60;p&#62;â€¢    We take appropriate security measures to protect against unauthorized access to or unauthorized alteration, disclosure or destruction of data&#60;/p&#62;&#10;        &#60;p&#62;â€¢  We restrict access to your personally identifying information to employees who need to know that information in order to operate, develop or improve our services&#60;/p&#62;&#60;br&#62;&#10;      &#60;h4&#62;Updating your information&#60;/h4&#62;&#10;      &#60;p&#62;We provide mechanisms for updating and correcting your personally identifying information for many of our services. For more information, please see the help pages for each service&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Children&#60;/h4&#62;&#10;        &#60;p&#62;&#39;Funds and Toils&#39; will not contact children under age 13 about special offers or for marketing purposes without a parent&#39;s permission&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Information Sharing and Disclosure&#60;/h4&#62;&#10;        &#60;ul type=&#34;disc&#34; class=&#34;privacy&#34;&#62;&#10;            &#60;li&#62;&#39;Funds and Toils&#39; does not rent, sell, or share personal information about you with other people (save with your consent) or non-affiliated companies except to provide products or services you&#39;ve requested, when we have your permission, or under the following circumstances&#10;                &#60;ul type=&#34;circle&#34; class=&#34;pricavy&#34;&#62;&#10;                    &#60;li&#62;We provide the information to trusted partners who work on behalf of or with &#39;Funds and Toils&#39; under confidentiality agreements. These companies may use your personal information to help &#39;Funds and Toilsâ€™ communicate with you about offers from &#39;Funds and Toils and our marketing partners. However, these companies do not have any independent right to share this information&#60;/li&#62;&#10;                    &#60;li&#62;We respond to subpoenas, court orders, or legal process, or to establish or exercise our legal rights or defend against legal claims&#60;/li&#62;&#10;                    &#60;li&#62;We believe it is necessary to share information in order to investigate, prevent, or take action regarding illegal activities, suspected fraud, situations involving potential threats to the physical safety of any person, violations of Funds and Toils&#39;s terms of use, or as otherwise required by law&#60;/li&#62;&#10;                    &#60;li&#62;We transfer information about you if &#39;Funds and Toils&#39; is acquired by or merged with another company. In this event, &#39;Funds and Toils&#39; will notify you before information about you is transferred and becomes subject to a different privacy policy&#60;/li&#62;&#10;                &#60;/ul&#62;&#10;            &#60;/li&#62;&#10;            &#60;li&#62;&#10;                &#39;Funds and Toils&#39; displays targeted advertisements based on personal information. Advertisers (including ad serving companies) may assume that people who interact with, view, or click on targeted ads meet the targeting criteria - for example, women ages 18-24 from a particular geographic area&#10;                &#60;ul type=&#34;circle&#34; class=&#34;privacy&#34;&#62;&#10;                    &#60;li&#62;&#39;Funds and Toils&#39; does not provide any personal information to the advertiser when you interact with or view a targeted ad. However, by interacting with or viewing an ad you are consenting to the possibility that the advertiser will make the assumption that you meet the targeting criteria used to display the ad&#60;/li&#62;&#10;                    &#60;li&#62;&#39;Funds and Toils&#39; advertisers include financial service providers (such as banks, insurance agents, stock brokers and mortgage lenders) and non-financial companies (such as stores, airlines, and software companies)&#60;/li&#62;&#10;                &#60;/ul&#62;&#10;            &#60;/li&#62;&#10;        &#60;/ul&#62;&#60;br&#62;&#10;        &#60;h4&#62;Confidentiality and Security&#60;/h4&#62;&#10;        &#60;p&#62;â€¢  We limit access to personal information about you to employees who we believe reasonably need to come into contact with that information to provide products or services to you or in order to do their jobs&#60;/p&#62;&#10;        &#60;p&#62;â€¢  &#34;We have physical, electronic, and procedural safeguards that comply with the laws prevalent in India to protect personal information about you. We seek to ensure compliance with the requirements of the Information Technology Act, 2000 as amended and rules made thereunder to ensure the protection and preservation of your privacy&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Changes to this Privacy Policy&#60;/h4&#62;&#10;        &#60;p&#62;&#39;Funds and Toils&#39; reserves the right to update, change or modify this policy at any time. The policy shall come to effect from the date of such update, change or modification.&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Disclaimer &#60;/h4&#62;&#10;        &#60;p&#62;Funds and Toils uses the maximum care as is possible to ensure that all or any data / information in respect of electronic transfer of money does not fall in the wrong hands. For completing online transactions involving payments a user is directed to a secured payment gateway, Funds and Toils does not store or keep financial data such as credit card numbers/passwords/PINs etc &#34;Personal Account Related Information&#34;. Since the transaction happens on a third party network not controlled by Funds and Toils, once an online transaction has been completed, the Personal Account Related Information is not accessible to anyone at Funds and Toils after completion of the online transaction at the payment gateway, this ensures maximum security.&#60;br&#62;&#60;br&#62;Funds and Toils shall not be liable for any loss or damage sustained by reason of any disclosure (inadvertent or otherwise) of any information concerning the user&#39;s account and / or information relating to or regarding online transactions using credit cards / debit cards and / or their verification process and particulars nor for any error, omission or inaccuracy with respect to any information so disclosed and used whether or not in pursuance of a legal process or otherwise&#60;/p&#62;&#60;br&#62;&#10;        &#60;h4&#62;Contact Information&#60;/h4&#62;&#10;        &#60;p&#62;&#39;Funds and Toils&#39; welcomes your comments regarding this privacy statement at the contact address given at the website. Should there be any concerns about contravention of this Privacy Policy, &#39;Funds and Toils&#39; will employ all commercially reasonable efforts to address the same. &#10;        Note : The terms in this agreement may be changed by Funds and Toils at any time. Funds and Toils is free to offer its services to any client/prospective client without restriction&#10;        &#60;/p&#62;&#10;', 'noreply@website.com', 'support@website.com', '&#60;!-- COMMON TAGS --&#62;&#10;&#60;meta charset=&#34;utf-8&#34;&#62;&#10;&#60;!-- Search Engine --&#62;&#10;&#60;meta name=&#34;description&#34; content=&#34;Connect the world, Sharing funs with friends! Every moment can be perfect...&#34;&#62;&#10;&#60;meta name=&#34;image&#34; content=&#34;http://localhost/snv1/admin/assets/logo/logo.png&#34;&#62;&#10;&#60;meta name=&#34;keywords&#34; content=&#34;world,people,love,like,friends,share,funs,tag,together,hashtag,user&#34;&#62;&#10;&#10;&#60;!-- Schema.org for Google --&#62;&#10;&#60;meta itemprop=&#34;name&#34; content=&#34;Elegance, The ultimate social network!&#34;&#62;&#10;&#60;meta itemprop=&#34;description&#34; content=&#34;Connect the world, Sharing funs with friends! Every moment can be perfect...&#34;&#62;&#10;&#60;meta itemprop=&#34;image&#34; content=&#34;http://localhost/snv1/admin/assets/logo/logo.png&#34;&#62;&#10;&#10;&#60;!-- Open Graph general (Facebook, Pinterest &#38; Google+) --&#62;&#10;&#60;meta name=&#34;og:title&#34; content=&#34;Elegance, The ultimate social network!&#34;&#62;&#10;&#60;meta name=&#34;og:description&#34; content=&#34;Connect the world, Sharing funs with friends! Every moment can be perfect...&#34;&#62;&#10;&#60;meta name=&#34;og:image&#34; content=&#34;http://localhost/snv1/admin/assets/logo/logo.png&#34;&#62;&#10;&#60;meta name=&#34;og:url&#34; content=&#34;http://localhost/snv1&#34;&#62;&#10;&#60;meta name=&#34;og:site_name&#34; content=&#34;Elegance&#34;&#62;&#10;&#60;meta name=&#34;og:locale&#34; content=&#34;en_US&#34;&#62;&#10;&#60;meta name=&#34;og:type&#34; content=&#34;website&#34;&#62;&#10;', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(110) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  `group_desc` varchar(200) DEFAULT NULL,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`group_id`),
  KEY `user_id_fk` (`user_id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `group_user_id` int(110) NOT NULL AUTO_INCREMENT,
  `group_id_fk` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`user_id_fk`,`group_id_fk`),
  KEY `group_id_fk` (`group_id_fk`),
  KEY `group_user_id` (`group_user_id`),
  KEY `group_user_id_2` (`group_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `cvid_fk` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `img_url` varchar(255) NOT NULL DEFAULT '0',
  `unread` varchar(255) DEFAULT '1',
  `notif_unread` varchar(255) NOT NULL DEFAULT '1',
  `dates_send` varchar(255) NOT NULL DEFAULT '0',
  `hide_user_from` varchar(200) NOT NULL DEFAULT '0',
  `hide_user_to` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `unread` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) NOT NULL DEFAULT '',
  `parameters` text NOT NULL,
  `reference_id` int(11) NOT NULL,
  `created_at` varchar(200) NOT NULL,
  `time_notif` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE IF NOT EXISTS `online` (
  `online_id` int(200) NOT NULL AUTO_INCREMENT,
  `online_ip` varchar(200) NOT NULL,
  `online_user` int(200) NOT NULL,
  `online_time` varchar(200) NOT NULL,
  `absent` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`online_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(110) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) DEFAULT NULL,
  `page_desc` varchar(200) DEFAULT NULL,
  `user_id_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`page_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_users`
--

CREATE TABLE IF NOT EXISTS `page_users` (
  `page_user_id` int(110) NOT NULL AUTO_INCREMENT,
  `page_id_fk` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`user_id_fk`,`page_id_fk`),
  KEY `page_id_fk` (`page_id_fk`),
  KEY `page_user_id` (`page_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `pid` int(200) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(255) NOT NULL DEFAULT '0',
  `texts` text NOT NULL,
  `hashtag` text NOT NULL,
  `image_url` text NOT NULL,
  `image_url_thumb` text NOT NULL,
  `video` text NOT NULL,
  `video_thumb` text NOT NULL,
  `video_url` varchar(100) NOT NULL DEFAULT '0',
  `video_url_thumb` text NOT NULL,
  `video_url_type` varchar(255) NOT NULL DEFAULT '0',
  `video_url_desc` text NOT NULL,
  `video_url_title` text NOT NULL,
  `video_url_class` varchar(255) NOT NULL DEFAULT '0',
  `link_url` text NOT NULL,
  `link_title_url` text NOT NULL,
  `link_img_url` text NOT NULL,
  `link_desc_url` text NOT NULL,
  `date_post` varchar(20) NOT NULL DEFAULT '0',
  `time_post` varchar(255) NOT NULL DEFAULT '0',
  `likes` varchar(255) NOT NULL DEFAULT '0',
  `share` varchar(255) NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  `user_share` varchar(255) NOT NULL DEFAULT '0',
  `pid_share` varchar(400) NOT NULL DEFAULT '0',
  `avatar_status` varchar(255) NOT NULL DEFAULT '0',
  `cover_status` varchar(255) NOT NULL DEFAULT '0',
  `privacy` varchar(255) NOT NULL DEFAULT '0',
  `adult_content_score` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved`
--

CREATE TABLE IF NOT EXISTS `saved` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `id_user` int(200) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `save` text NOT NULL,
  `created_at` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(400) NOT NULL DEFAULT '0',
  `lastname` varchar(400) NOT NULL DEFAULT '0',
  `email` varchar(400) NOT NULL DEFAULT '0',
  `phone` varchar(400) NOT NULL DEFAULT '0',
  `sex` varchar(400) DEFAULT '0',
  `birthday` varchar(400) NOT NULL DEFAULT '0',
  `city` varchar(400) NOT NULL DEFAULT '0',
  `address` varchar(400) NOT NULL DEFAULT '0',
  `country` varchar(400) NOT NULL DEFAULT '0',
  `password` varchar(400) NOT NULL DEFAULT '0',
  `code` varchar(400) NOT NULL DEFAULT '0',
  `avatar` varchar(400) NOT NULL DEFAULT '0',
  `avatar_thumb` varchar(400) NOT NULL DEFAULT '0',
  `cover` varchar(400) NOT NULL DEFAULT '0',
  `cover_thumb` varchar(400) NOT NULL DEFAULT '0',
  `active` varchar(400) NOT NULL DEFAULT '0',
  `username` varchar(400) NOT NULL DEFAULT '0',
  `verified` varchar(400) NOT NULL DEFAULT '0',
  `about` text NOT NULL,
  `language` varchar(400) NOT NULL DEFAULT '0',
  `date_signin` varchar(400) NOT NULL DEFAULT '0',
  `level` varchar(255) NOT NULL DEFAULT '0',
  `last_time_session` varchar(255) NOT NULL DEFAULT '0',
  `privacy` varchar(255) NOT NULL DEFAULT '0',
  `forget_pwd` varchar(300) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE IF NOT EXISTS `user_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_post_owner` varchar(255) NOT NULL,
  `date_send` varchar(255) NOT NULL DEFAULT '0',
  `date_receive` varchar(255) NOT NULL DEFAULT '0',
  `date_seen` varchar(255) NOT NULL DEFAULT '0',
  `date_notif` varchar(255) NOT NULL DEFAULT '0',
  `dates` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_share`
--

CREATE TABLE IF NOT EXISTS `user_share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `share_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `share_post_owner` int(11) NOT NULL,
  `date_send` varchar(255) NOT NULL DEFAULT '0',
  `date_receive` varchar(255) NOT NULL DEFAULT '0',
  `date_seen` varchar(255) NOT NULL DEFAULT '0',
  `date_notif` varchar(255) NOT NULL DEFAULT '0',
  `dates` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
