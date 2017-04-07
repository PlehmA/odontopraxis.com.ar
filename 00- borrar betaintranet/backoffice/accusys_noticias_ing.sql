/*
MySQL Data Transfer
Source Host: 190.228.29.54
Source Database: calandrelli
Target Host: 190.228.29.54
Target Database: calandrelli
Date: 30/07/2010 18:32:38
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for accusys_noticias_ing
-- ----------------------------
CREATE TABLE `accusys_noticias_ing` (
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
INSERT INTO `accusys_noticias_ing` VALUES ('30', '20100703', '', 'MGI-Accusys Presents COE Solution', 'On March 11, 2010, Antonio Melo, President of BIT Consulting, presented the Optimal Control of Cash solution (COE), designed to manage financial institutions’ monetary resources efficiently and maximize their profitability through expense reduction.  \r\n', 'The executive of MGI-Accusys’ strategic allied company analyzed the way to optimize, through this solution, the operation of the Cash Management Area and the processes involved in the handling of cash, in order to generate savings in the short term. \r\n\r\nDuring his presentation, Antonio Melo also explained how COE solution helps to achieve an optimal balance between operating and financial costs, ensuring cash availability both in branches and ATMs.\r\n\r\nThe conference took place in the city of Buenos Aires, within the framework of the breakfast cycle organized by AMBA (Asociación de Marketing Bancario Argentino).\r\n', 'logo_coe.jpg', 'S', '');
INSERT INTO `accusys_noticias_ing` VALUES ('31', '20100704', '', 'Marcelo Picolo Appointed Business Manager of  MGI-Accusys', 'The company announced the appointment of Marcelo Picolo as Business Manager for Latin America. In his new position, the executive will work on the regional expansion of MGI-Accusys customer portfolio, focusing on Argentina, Uruguay, Chile, Paraguay and Peru.  ', '“It is an honour for me to join the company taking up this challenge,” stated Mr. Picolo. “I will be responsible for leading a team enabling MGI-Accusys positioning in the market, offering value added services, and also for starting a new growth stage focused on Latin America and coordinating the design of innovating business solutions for Banks and Insurance Companies.”\r\n\r\nPrior to joining the company, Marcelo Picolo worked as Business Development and Regional Marketing Manager at Inworx-Telesoft. \r\n\r\nHe began his professional career in Telecom Argentina and IT&T Latin America, and today has a 12-year experience in the commercialization of technological solutions in leading companies. Marcelo Picolo has a degree in Marketing from Universidad Argentina de la Empresa – UADE. \r\n', 'foto_nota02.jpg', 'S', '');
INSERT INTO `accusys_noticias_ing` VALUES ('33', '20100705', '', 'MGI-Accusys Participates in AMBA 10th International Congress', 'The company took part in the 10th International Congress on Financial Business Technology organized by the Asociación de Marketing Bancario Argentino (AMBA) on June 7 and 8, 2010, in the city of Buenos Aires.\r\n\r\n<a href=\"nota_prensa_video_ing.php\">See video </a>\r\n', 'In this traditional encounter of the Financial Industry, different entities related to the sector analyzed the new technological trends with the aim of providing answers to business dynamics. \r\n\r\nMGI-Accusys and its strategic ally BIT Consulting presented the Optimal Control of Cash solution (COE), which allows to manage financial institutions’ monetary resources efficiently and maximize their profitability through cost reduction. \r\n\r\n“Participating in this event was very interesting, not only because this congress is a benchmark of the financial industry at a regional level but also because it gave us the possibility to be in contact with the industry players to make them new value proposals,” highlighted Marcelo Picolo, Business Manager of MGI-Accusys Latin America. \r\n', 'foto_nota03_play.jpg', 'N', '');
