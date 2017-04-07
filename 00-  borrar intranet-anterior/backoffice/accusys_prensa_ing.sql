/*
MySQL Data Transfer
Source Host: 190.228.29.54
Source Database: calandrelli
Target Host: 190.228.29.54
Target Database: calandrelli
Date: 30/07/2010 18:32:50
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for accusys_prensa_ing
-- ----------------------------
CREATE TABLE `accusys_prensa_ing` (
  `id` int(4) NOT NULL auto_increment,
  `fecha` varchar(8) NOT NULL default '',
  `volanta` varchar(150) default '',
  `titulo` varchar(255) default '',
  `bajada` text,
  `texto` text,
  `imagen` varchar(30) default '',
  `publicado` char(1) NOT NULL default 'N',
  `archivo` varchar(30) default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `accusys_prensa_ing` VALUES ('30', '20100704', '', 'AMBA’s Work Breakfast', 'The presentation will show how the COE solution (Optimal Control of Cash) enables a comprehensive and efficient management of financial institutions’ monetary resources.', ' ', 'foto_nota03.jpg', 'S', 'evento02_img_ing.jpg');
INSERT INTO `accusys_prensa_ing` VALUES ('31', '20100705', '', '10th International Congress on Financial Business Technology', 'Accusys invites you to participate in the conference “How to apply an operating and financial intelligence model to enhance bank profitability through effective cash management.” ', ' ', 'foto_evento01.jpg', 'S', 'pic24912_ing.jpg');
