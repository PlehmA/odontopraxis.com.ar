/*
MySQL Data Transfer
Source Host: 190.228.29.54
Source Database: calandrelli
Target Host: 190.228.29.54
Target Database: calandrelli
Date: 04/08/2010 18:26:28
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for accusys_usuarios
-- ----------------------------
CREATE TABLE `accusys_usuarios` (
  `id` int(11) NOT NULL default '0',
  `usuario` varchar(50) NOT NULL default '',
  `clave` varchar(50) NOT NULL default '',
  `adm` char(1) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `accusys_usuarios` VALUES ('1', 'admin', 'admin', 'S');
