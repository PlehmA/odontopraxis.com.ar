/*
MySQL Data Transfer
Source Host: 190.228.29.54
Source Database: calandrelli
Target Host: 190.228.29.54
Target Database: calandrelli
Date: 30/07/2010 18:32:45
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for accusys_prensa
-- ----------------------------
CREATE TABLE `accusys_prensa` (
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
INSERT INTO `accusys_prensa` VALUES ('30', '20100704', '', 'Desayuno de trabajo AMBA', 'La presentación abordara como el modelo de solución COE – Control Optimo del efectivo - permite gestionar el manejo integral y eficiente de los recursos monetarios de las instituciones financieras.\r\n', ' ', 'foto_nota03.jpg', 'S', 'evento02_img.jpg');
INSERT INTO `accusys_prensa` VALUES ('31', '20100705', '', '10º Congreso internacional de tecnología para el negocio financiero', 'Accusys lo invita a participar de la conferencia \"Como aplicar un modelo de inteligencia operativa y financiera para rentabilizar el efectivo en la Banca\"\r\n', ' ', 'foto_evento01.jpg', 'S', 'pic24912.jpg');
