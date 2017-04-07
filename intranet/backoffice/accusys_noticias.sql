/*
MySQL Data Transfer
Source Host: 190.228.29.54
Source Database: calandrelli
Target Host: 190.228.29.54
Target Database: calandrelli
Date: 30/07/2010 18:32:29
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for accusys_noticias
-- ----------------------------
CREATE TABLE `accusys_noticias` (
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
INSERT INTO `accusys_noticias` VALUES ('30', '20100703', '', 'MGI-Accusys presentó la solución COE', 'Antonio Melo, Presidente de BIT Consulting, presentó el 11 de marzo pasado la solución COE -Control Optimo del Efectivo-, diseñada para gestionar con eficiencia los recursos monetarios de las instituciones financieras y maximizar su rentabilidad mediante la reducción de gastos.\r\n', 'El ejecutivo, de la compañía aliada estratégica de MGI-Accusys, analizó cómo optimizar con esta solución la gestión del Área de Administración del efectivo y los procesos involucrados en el manejo del efectivo, a fin de generar ahorros a corto plazo.\r\n\r\nEn otro tramo de su presentación, Antonio Melo explicó cómo COE permite lograr un balance óptimo entre los costos operativos y financieros garantizando la disponibilidad del efectivo en las sucursales y cajeros automáticos.\r\n\r\nLa conferencia se realizó en la ciudad de Buenos Aires, el marco del ciclo de desayunos organizados por AMBA (Asociación de Marketing Bancario Argentino).\r\n', 'logo_coe.jpg', 'S', '');
INSERT INTO `accusys_noticias` VALUES ('31', '20100704', '', 'Marcelo Pícolo fue designado Director Comercial en MGI-Accusys', 'La compañía anunció la incorporación de Marcelo Pícolo como Director Comercial para Latinoamérica. En su nueva función el ejecutivo trabajará en la expansión regional de la cartera de clientes de MGI-Accusys con foco en Argentina, Uruguay, Chile, Paraguay y Perú.', '\"Es un honor para mi ingresar a la compañía asumiendo este desafío\", declaró Pícolo. \"Mi tarea será liderar un equipo que permita consolidar el posicionamiento de MGI-Accusys ofreciendo servicios de valor agregado, iniciar una nueva etapa de crecimiento focalizado en Latinoamérica y coordinar el diseño de innovadoras soluciones de negocios para la Banca y Compañías de Seguros.\"\r\n\r\nPrevio a su ingreso a la compañía, Marcelo Pícolo fue Gerente de Desarrollo de Negocios y Marketing Regional en Inworx-Telesoft. \r\n\r\nComenzó su carrera profesional Telecom Argentina y IT&T Latinoamérica, logrando así una trayectoria de más de 12 años en la comercialización de soluciones tecnológicas en compañías de primera línea. Pícolo se graduó en Licenciatura en Comercialización en la Universidad Argentina de la Empresa - UADE\r\n', 'foto_nota02.jpg', 'S', '');
INSERT INTO `accusys_noticias` VALUES ('33', '20100705', '', 'MGI-Accusys presente en el 10º Congreso Internacional de AMBA', 'La compañía participó del 10º Congreso Internacional de Tecnología para el Negocio Financiero organizado por la Asociación de Marketing Bancario Argentino (AMBA), el 7 y 8 de junio pasados en la ciudad de Buenos Aires. \r\n\r\n<a href=\"nota_prensa_video.php\">Ver video </a>\r\n', 'En este tradicional encuentro de la Industria Financiera, distintas entidades vinculadas al sector analizaron las nuevas tendencias tecnológicas con el fin de dar respuestas a la dinámica del negocio.\r\nMGI-Accusys, junto a sualiado estratégico BIT Consulting, presentaron la solución COE -Control Optimo del Efectivo-, que permite gestionar con eficiencia los recursos monetarios de las instituciones financieras, y maximizar su rentabilidad mediante la reducción de gastos.\r\n\r\n\"Fue muy interesante haber participado en este evento, no sólo porque es una exposición referente a nivel regional en materia de industria financiera, sino también porque nos dio la posibilidad de estar en contacto con los protagonistas del sector para ofrecerles nuevas propuestas de valor\", destacó Marcelo Pícolo, Director Comercial para MGI-Accusys Latinoamerica.', 'foto_nota03_play.jpg', 'N', '');
