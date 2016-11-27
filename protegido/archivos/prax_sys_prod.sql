/*
Navicat MySQL Data Transfer

Source Server         : LocalWamp
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : prax_sys_prod

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-11-23 21:28:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_acudientes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_acudientes`;
CREATE TABLE `tbl_acudientes` (
  `id_acudiente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre1` varchar(20) NOT NULL,
  `nombre2` varchar(20) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `tipo_doc_id` int(11) NOT NULL,
  `identificacion` varchar(15) NOT NULL,
  `telefono1` varchar(15) DEFAULT NULL,
  `telefono2` varchar(15) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_acudiente`),
  KEY `fk_tbl_acudientes_tbl_tipos_identificacion1_idx` (`tipo_doc_id`) USING BTREE,
  CONSTRAINT `fk_tbl_acudientes_tbl_tipos_identificacion1` FOREIGN KEY (`tipo_doc_id`) REFERENCES `tbl_tipos_identificacion` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_acudientes
-- ----------------------------
INSERT INTO `tbl_acudientes` VALUES ('1', 'Jorge', 'Alejandro', 'Quiroz', 'Serna', '1', '12345678', '12312313', '5555555', 'alejo.jko@gmail.com', 'Cr 45 # 78 -34', '1', null);
INSERT INTO `tbl_acudientes` VALUES ('2', 'Brayan', 'Steven', 'Quiroz', 'Serna', '2', '132888128', '98798797', null, 'Bs@gmail.comcom', 'Cr 45 # 78 -34', '1', null);
INSERT INTO `tbl_acudientes` VALUES ('3', 'Charles', null, 'Jiménez', null, '1', '1234567', '1245', null, null, 'sdghfd234', '1', null);
INSERT INTO `tbl_acudientes` VALUES ('4', 'Hector', null, 'Alzate', null, '1', '11111', null, null, null, null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('5', 'Paola', null, 'Calle', null, '2', '1', null, null, null, null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('6', 'Lina', null, 'Montes', null, '1', '123', null, null, null, null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('7', 'Paola', null, 'Tejada', null, '1', '1234', null, null, 'a@gmail.com', null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('9', 'steve', null, 'suarez', null, '1', '123123213123', '123123123', '12312312', 'steve@gmail.com', '12312312312312', '1', null);
INSERT INTO `tbl_acudientes` VALUES ('10', 'Juana', null, 'Cardona', null, '1', '15', null, null, null, null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('13', 'Alejo', null, 'Quiroz', null, '1', '111111', null, null, 'demo1@localhost.com', null, '1', '1');
INSERT INTO `tbl_acudientes` VALUES ('14', 'Alvaro', null, 'Quiroz', null, '1', '11', null, null, null, null, '1', null);
INSERT INTO `tbl_acudientes` VALUES ('15', 'Manuel', null, 'Medrano', null, '1', '222222', null, null, 'demo1@localhost.com', null, '1', '1');
INSERT INTO `tbl_acudientes` VALUES ('16', 'Alguien', null, 'Otro', null, '1', '222221675756', null, null, null, null, '1', null);

-- ----------------------------
-- Table structure for tbl_acudientes_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_acudientes_documentos`;
CREATE TABLE `tbl_acudientes_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acudiente_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_acudientes_documentos_tbl_documentos1_idx` (`documento_id`) USING BTREE,
  KEY `fk_tbl_acudientes_documentos_tbl_acudientes1_idx` (`acudiente_id`) USING BTREE,
  CONSTRAINT `fk_tbl_acudientes_documentos_tbl_acudientes1` FOREIGN KEY (`acudiente_id`) REFERENCES `tbl_acudientes` (`id_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_acudientes_documentos_tbl_documentos1` FOREIGN KEY (`documento_id`) REFERENCES `tbl_documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_acudientes_documentos
-- ----------------------------
INSERT INTO `tbl_acudientes_documentos` VALUES ('1', '3', '2');
INSERT INTO `tbl_acudientes_documentos` VALUES ('2', '7', '4');
INSERT INTO `tbl_acudientes_documentos` VALUES ('4', '9', '10');
INSERT INTO `tbl_acudientes_documentos` VALUES ('5', '10', '18');
INSERT INTO `tbl_acudientes_documentos` VALUES ('6', '15', '21');
INSERT INTO `tbl_acudientes_documentos` VALUES ('7', '16', '22');

-- ----------------------------
-- Table structure for tbl_asistencia
-- ----------------------------
DROP TABLE IF EXISTS `tbl_asistencia`;
CREATE TABLE `tbl_asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `novedad` text,
  `realizada_por` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id_asistencia`),
  KEY `fk_tbl_asistencia_tbl_categorias1_idx` (`categoria_id`) USING BTREE,
  CONSTRAINT `fk_tbl_asistencia_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_asistencia
-- ----------------------------
INSERT INTO `tbl_asistencia` VALUES ('3', '2016-11-17', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('4', '2016-11-25', 'Esta hospitalizado', '1', '5');
INSERT INTO `tbl_asistencia` VALUES ('5', '2016-11-20', 'Alguna novedad', '1', '5');
INSERT INTO `tbl_asistencia` VALUES ('6', '2016-11-26', null, '1', '5');
INSERT INTO `tbl_asistencia` VALUES ('7', '2016-11-20', null, '1', '5');
INSERT INTO `tbl_asistencia` VALUES ('8', '2016-11-19', null, '1', '5');
INSERT INTO `tbl_asistencia` VALUES ('9', '2016-11-25', null, '1', '5');

-- ----------------------------
-- Table structure for tbl_categorias
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE `tbl_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text,
  `cupo_maximo` int(10) unsigned NOT NULL,
  `cupo_minimo` int(10) unsigned DEFAULT NULL,
  `tarifa` double NOT NULL DEFAULT '0',
  `edad_minima` int(11) NOT NULL,
  `edad_maxima` int(11) NOT NULL,
  `estado` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `entrenador_id` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_categorias
-- ----------------------------
INSERT INTO `tbl_categorias` VALUES ('1', 'Pony', null, '22', '11', '10000', '8', '12', '1', '2');
INSERT INTO `tbl_categorias` VALUES ('2', 'Pre-pony', null, '34', '17', '10000', '6', '8', '1', '2');
INSERT INTO `tbl_categorias` VALUES ('3', 'Baby', null, '30', '15', '20000', '5', '6', '1', '2');
INSERT INTO `tbl_categorias` VALUES ('5', 'Mayores', null, '2', '1', '5000', '15', '20', '1', '2');

-- ----------------------------
-- Table structure for tbl_categorias_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categorias_implementos`;
CREATE TABLE `tbl_categorias_implementos` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_categorias_implementos
-- ----------------------------
INSERT INTO `tbl_categorias_implementos` VALUES ('2', 'Deportivos', null, '1');

-- ----------------------------
-- Table structure for tbl_clubes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clubes`;
CREATE TABLE `tbl_clubes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_clubes
-- ----------------------------
INSERT INTO `tbl_clubes` VALUES ('1', 'Praxis', null, null, '1');
INSERT INTO `tbl_clubes` VALUES ('2', 'Colombus', null, null, '1');

-- ----------------------------
-- Table structure for tbl_comentarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comentarios`;
CREATE TABLE `tbl_comentarios` (
  `id_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `publicacion_id` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `fk_comentarios_usuarios` (`usuario_id`) USING BTREE,
  KEY `fk_comentarios_padres` (`padre_id`) USING BTREE,
  KEY `fk_comentarios_publicacion` (`publicacion_id`) USING BTREE,
  CONSTRAINT `fk_comentarios_padres` FOREIGN KEY (`padre_id`) REFERENCES `tbl_comentarios` (`id_comentario`),
  CONSTRAINT `fk_comentarios_publicacion` FOREIGN KEY (`publicacion_id`) REFERENCES `tbl_publicaciones` (`id_publicacion`),
  CONSTRAINT `fk_comentarios_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_comentarios
-- ----------------------------
INSERT INTO `tbl_comentarios` VALUES ('1', 'Es es mejor Club de Barbosa!!', '2', null, '5', '1', '2016-11-23 08:40:50');

-- ----------------------------
-- Table structure for tbl_comprobantes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_comprobantes`;
CREATE TABLE `tbl_comprobantes` (
  `id_comprobante` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `pago_id` int(11) NOT NULL,
  PRIMARY KEY (`id_comprobante`),
  KEY `fk_tbl_comprobantes_tbl_pagos1_idx` (`pago_id`) USING BTREE,
  CONSTRAINT `fk_tbl_comprobantes_tbl_pagos1` FOREIGN KEY (`pago_id`) REFERENCES `tbl_pagos` (`id_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_comprobantes
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_configuraciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_configuraciones`;
CREATE TABLE `tbl_configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `valor` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_configuraciones
-- ----------------------------
INSERT INTO `tbl_configuraciones` VALUES ('1', 'quienes_somos', '<h1>&nbsp;Club deportivo PRAXYS</h1>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');
INSERT INTO `tbl_configuraciones` VALUES ('2', 'redes_facebook', 'https://facebook.com');
INSERT INTO `tbl_configuraciones` VALUES ('3', 'redes_twitter', 'http://site.jakolab.com');
INSERT INTO `tbl_configuraciones` VALUES ('4', 'redes_instagram', 'http://site.jakolab.com');
INSERT INTO `tbl_configuraciones` VALUES ('5', 'redes_youtube', 'https://facebook.com');
INSERT INTO `tbl_configuraciones` VALUES ('6', 'email_admin', 'demo@localhost.com');
INSERT INTO `tbl_configuraciones` VALUES ('7', 'url_sitio_web', 'http://localhost/proyecto-formacion/prax-sys-web-site/');
INSERT INTO `tbl_configuraciones` VALUES ('8', 'url_app', 'http://localhost/proyecto-formacion/prax-sys-prod/');
INSERT INTO `tbl_configuraciones` VALUES ('9', 'ruta_sitio', 'C:\\wamp\\www\\proyecto-formacion\\prax-sys-web-site');
INSERT INTO `tbl_configuraciones` VALUES ('10', 'ruta_app', 'C:\\wamp\\www\\proyecto-formacion\\prax-sys-prod');
INSERT INTO `tbl_configuraciones` VALUES ('11', 'nombre_club', 'Club Deportivo Praxis Juan Carlos Jímenez');
INSERT INTO `tbl_configuraciones` VALUES ('12', 'edad_max_deps', '16');
INSERT INTO `tbl_configuraciones` VALUES ('13', 'club_principal', '1');
INSERT INTO `tbl_configuraciones` VALUES ('14', 'max_date_range', '1');
INSERT INTO `tbl_configuraciones` VALUES ('15', 'anio_maximo', null);

-- ----------------------------
-- Table structure for tbl_deportistas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas`;
CREATE TABLE `tbl_deportistas` (
  `id_deportista` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` varchar(45) NOT NULL,
  `nombre1` varchar(15) NOT NULL,
  `nombre2` varchar(15) DEFAULT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `telefono1` varchar(10) NOT NULL,
  `telefono2` varchar(10) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `estado_id` int(11) NOT NULL DEFAULT '1',
  `estado_anterior` int(11) DEFAULT NULL,
  `tipo_documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id_deportista`),
  KEY `fk_tbl_personas_tbl_tipos_documento_idx` (`tipo_documento_id`) USING BTREE,
  KEY `fk_tbl_personas_tbl_estado_deportistas1_idx` (`estado_id`) USING BTREE,
  CONSTRAINT `fk_tbl_personas_tbl_estado_deportistas1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estado_deportistas` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_personas_tbl_tipos_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tbl_tipos_identificacion` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_deportistas
-- ----------------------------
INSERT INTO `tbl_deportistas` VALUES ('1', '09898789789', 'Cristian', 'Giovanny', 'Martinez', null, null, 'Foto_09898789789.JPG', '565765765', null, '2009-02-01', '1', null, '3');
INSERT INTO `tbl_deportistas` VALUES ('4', '987898797', 'Bryan', 'Stevens', 'Bedoya', null, null, null, '32132231', null, '2008-01-01', '1', null, '3');
INSERT INTO `tbl_deportistas` VALUES ('5', '0', 'Juan', '               ', 'Muñoz', null, 'vd67', 'Foto_1234.jpg', '456789', null, '2011-08-17', '1', null, '2');
INSERT INTO `tbl_deportistas` VALUES ('6', '1229', 'Pedro', 'Antonio', 'Perez', null, 'calle 30', 'Foto_1229.jpg', 'hkjhdfkjhs', null, '1989-01-02', '1', null, '3');
INSERT INTO `tbl_deportistas` VALUES ('7', '10342020', 'juan', null, 'cardona', null, null, null, '56789', null, '2007-02-01', '1', null, '2');
INSERT INTO `tbl_deportistas` VALUES ('8', '103455553453543', 'Pedro', null, 'Corrales', null, null, null, '2343434', null, '1997-12-01', '1', null, '3');
INSERT INTO `tbl_deportistas` VALUES ('9', '1111111111', 'Juan', null, 'David', null, 'Sur', null, '1232313546', '3213212313', '2000-01-12', '1', null, '3');
INSERT INTO `tbl_deportistas` VALUES ('10', '2222222222', 'Alguien', null, 'Someone', null, null, null, 'Algo', null, '2009-08-05', '1', null, '3');

-- ----------------------------
-- Table structure for tbl_deportistas_acudientes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_acudientes`;
CREATE TABLE `tbl_deportistas_acudientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acudiente_id` int(11) NOT NULL,
  `deportista_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_deportistas_acudientes_tbl_personas2_idx` (`deportista_id`) USING BTREE,
  KEY `fk_tbl_deportistas_acudientes_tbl_acudientes1_idx` (`acudiente_id`) USING BTREE,
  CONSTRAINT `fk_tbl_deportistas_acudientes_tbl_acudientes1` FOREIGN KEY (`acudiente_id`) REFERENCES `tbl_acudientes` (`id_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_deportistas_acudientes_tbl_personas2` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_deportistas_acudientes
-- ----------------------------
INSERT INTO `tbl_deportistas_acudientes` VALUES ('1', '1', '1');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('4', '2', '4');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('5', '3', '5');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('6', '5', '6');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('7', '1', '5');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('10', '2', '7');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('11', '2', '8');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('15', '3', '9');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('20', '5', '9');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('21', '4', '9');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('22', '1', '10');

-- ----------------------------
-- Table structure for tbl_deportistas_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_documentos`;
CREATE TABLE `tbl_deportistas_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deportista_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_personas_documentos_tbl_documentos1_idx` (`documento_id`) USING BTREE,
  KEY `fk_tbl_personas_documentos_tbl_personas1_idx` (`deportista_id`) USING BTREE,
  CONSTRAINT `fk_tbl_personas_documentos_tbl_documentos1` FOREIGN KEY (`documento_id`) REFERENCES `tbl_documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_personas_documentos_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_deportistas_documentos
-- ----------------------------
INSERT INTO `tbl_deportistas_documentos` VALUES ('1', '4', '1');
INSERT INTO `tbl_deportistas_documentos` VALUES ('2', '5', '3');
INSERT INTO `tbl_deportistas_documentos` VALUES ('6', '5', '8');
INSERT INTO `tbl_deportistas_documentos` VALUES ('7', '1', '11');
INSERT INTO `tbl_deportistas_documentos` VALUES ('9', '5', '13');
INSERT INTO `tbl_deportistas_documentos` VALUES ('11', '7', '15');
INSERT INTO `tbl_deportistas_documentos` VALUES ('12', '9', '16');
INSERT INTO `tbl_deportistas_documentos` VALUES ('13', '9', '17');
INSERT INTO `tbl_deportistas_documentos` VALUES ('14', '8', '19');
INSERT INTO `tbl_deportistas_documentos` VALUES ('15', '10', '20');
INSERT INTO `tbl_deportistas_documentos` VALUES ('16', '8', '23');

-- ----------------------------
-- Table structure for tbl_deportistas_equipos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_equipos`;
CREATE TABLE `tbl_deportistas_equipos` (
  `id_de` int(11) NOT NULL AUTO_INCREMENT,
  `deportista_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  `amonestaciones` int(11) DEFAULT '0',
  `expulsiones` int(11) DEFAULT '0',
  `anotaciones` int(11) DEFAULT '0',
  PRIMARY KEY (`id_de`),
  KEY `fk_tbl_deportistas_equipos_tbl_equipos1_idx` (`equipo_id`) USING BTREE,
  KEY `fk_tbl_deportistas_equipos_tbl_personas1_idx` (`deportista_id`) USING BTREE,
  CONSTRAINT `fk_tbl_deportistas_equipos_tbl_equipos1` FOREIGN KEY (`equipo_id`) REFERENCES `tbl_equipos` (`id_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_deportistas_equipos_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_deportistas_equipos
-- ----------------------------
INSERT INTO `tbl_deportistas_equipos` VALUES ('1', '5', '1', null, null, null);
INSERT INTO `tbl_deportistas_equipos` VALUES ('2', '4', '2', null, null, null);
INSERT INTO `tbl_deportistas_equipos` VALUES ('5', '4', '6', null, null, null);

-- ----------------------------
-- Table structure for tbl_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_documentos`;
CREATE TABLE `tbl_documentos` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `papelera` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_documento`),
  KEY `fk_tbl_documentos_tbl_tipos_documento1_idx` (`tipo_id`) USING BTREE,
  CONSTRAINT `fk_tbl_documentos_tbl_tipos_documento1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_documento` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_documentos
-- ----------------------------
INSERT INTO `tbl_documentos` VALUES ('1', 'deportistas/4/Tarjeta de identidad_deportista_987898797.jpg', 'Tarjeta de identidad_deportista_987898797', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('2', 'acudientes/3/Cédula_acudiente_1234567.jpg', 'Cédula_acudiente_1234567', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('3', 'deportistas/5/Tarjeta de identidad_deportista_1234.jpg', 'Tarjeta de identidad_deportista_1234', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('4', 'acudientes/7/_acudiente_7878787.jpg', '_acudiente_7878787', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('8', 'deportistas/5/nuevo doc_deportista_12312312312387687678.jpg', 'nuevo doc_deportista_12312312312387687678', '2', '0');
INSERT INTO `tbl_documentos` VALUES ('10', 'acudientes/9/Cedula_acudiente_123123213123.jpg', 'Cedula_acudiente_123123213123', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('11', 'deportistas/1/Tarjeta de identidad_deportista_09898789789.jpg', 'Tarjeta de identidad_deportista_09898789789', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('13', 'deportistas/5/er123213_deportista_11111111.jpg', 'er123213_deportista_11111111', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('15', 'deportistas/7/recibo_deportista_10342020.jpg', 'recibo_deportista_10342020', '2', '0');
INSERT INTO `tbl_documentos` VALUES ('16', 'deportistas/9/Nuevo_deportista_123123.jpg', 'Nuevo_deportista_123123', '2', '0');
INSERT INTO `tbl_documentos` VALUES ('17', 'deportistas/9/Alguno_deportista_123123.PNG', 'Alguno_deportista_123123', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('18', 'acudientes/10/cc_acudiente_15.jpg', 'cc_acudiente_15', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('19', 'deportistas/8/alguno_deportista_10345555.PNG', 'alguno_deportista_10345555', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('20', 'deportistas/10/Nuevo doc_deportista_2222222222.PNG', 'Nuevo doc_deportista_2222222222', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('21', 'acudientes/15/nuevo doc_acudiente_222222.PNG', 'nuevo doc_acudiente_222222', '2', '0');
INSERT INTO `tbl_documentos` VALUES ('22', 'acudientes/16/Nuevo_acudiente_222221.PNG', 'Nuevo_acudiente_222221', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('23', 'deportistas/8/varios_deportista_103455553453543.PNG', 'varios_deportista_103455553453543', '1', '0');

-- ----------------------------
-- Table structure for tbl_entradas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_entradas`;
CREATE TABLE `tbl_entradas` (
  `id_entrada` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_realizacion` datetime NOT NULL,
  `descripcion` text,
  `responsable_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_entrada`),
  KEY `fk_tbl_entradas_tbl_usuarios1_idx` (`responsable_id`) USING BTREE,
  CONSTRAINT `fk_tbl_entradas_tbl_usuarios1` FOREIGN KEY (`responsable_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_entradas
-- ----------------------------
INSERT INTO `tbl_entradas` VALUES ('1', '2016-11-01 10:30:24', null, '1', '1');
INSERT INTO `tbl_entradas` VALUES ('2', '2016-11-19 20:33:32', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', '1');

-- ----------------------------
-- Table structure for tbl_entradas_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_entradas_implementos`;
CREATE TABLE `tbl_entradas_implementos` (
  `id_si` int(11) NOT NULL AUTO_INCREMENT,
  `entrada_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `cantidad` int(10) unsigned NOT NULL DEFAULT '0',
  `detalle` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_si`),
  KEY `fk_tbl_salidas_implementos_tbl_implementos1_idx` (`implemento_id`) USING BTREE,
  KEY `fk_tbl_salidas_implementos_tbl_entradas1_idx` (`entrada_id`) USING BTREE,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_entradas1` FOREIGN KEY (`entrada_id`) REFERENCES `tbl_entradas` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_implementos1` FOREIGN KEY (`implemento_id`) REFERENCES `tbl_implementos` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_entradas_implementos
-- ----------------------------
INSERT INTO `tbl_entradas_implementos` VALUES ('1', '1', '1', '10', null);
INSERT INTO `tbl_entradas_implementos` VALUES ('2', '2', '1', '10', null);

-- ----------------------------
-- Table structure for tbl_equipos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_equipos`;
CREATE TABLE `tbl_equipos` (
  `id_equipo` int(11) NOT NULL AUTO_INCREMENT,
  `cupo_maximo` int(11) NOT NULL,
  `cupo_minimo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `posicion` int(11) DEFAULT NULL,
  `entrenador_id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `torneo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `fk_equipo_torneo` (`torneo_id`) USING BTREE,
  CONSTRAINT `fk_equipo_torneo` FOREIGN KEY (`torneo_id`) REFERENCES `tbl_torneos` (`id_torneo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_equipos
-- ----------------------------
INSERT INTO `tbl_equipos` VALUES ('1', '1', '0', '1', null, '2', 'Praxys - Mayores', '2');
INSERT INTO `tbl_equipos` VALUES ('2', '11', '0', '1', null, '2', 'Nuevo equipo', '4');
INSERT INTO `tbl_equipos` VALUES ('5', '1', '0', '1', null, '2', 'ADSI SENA (1)', '6');
INSERT INTO `tbl_equipos` VALUES ('6', '1', '0', '1', null, '2', 'ADSI', '6');

-- ----------------------------
-- Table structure for tbl_estados_evento
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados_evento`;
CREATE TABLE `tbl_estados_evento` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_estados_evento
-- ----------------------------
INSERT INTO `tbl_estados_evento` VALUES ('1', 'Abierto', null);
INSERT INTO `tbl_estados_evento` VALUES ('2', 'Finalizado', null);

-- ----------------------------
-- Table structure for tbl_estados_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados_implementos`;
CREATE TABLE `tbl_estados_implementos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_estados_implementos
-- ----------------------------
INSERT INTO `tbl_estados_implementos` VALUES ('1', 'Activo', null);
INSERT INTO `tbl_estados_implementos` VALUES ('2', 'Inactivo', null);
INSERT INTO `tbl_estados_implementos` VALUES ('3', 'Agotado', null);

-- ----------------------------
-- Table structure for tbl_estados_publicacion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados_publicacion`;
CREATE TABLE `tbl_estados_publicacion` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_estados_publicacion
-- ----------------------------
INSERT INTO `tbl_estados_publicacion` VALUES ('1', 'Borrador', null);
INSERT INTO `tbl_estados_publicacion` VALUES ('2', 'Disponible', null);
INSERT INTO `tbl_estados_publicacion` VALUES ('3', 'No disponible', null);

-- ----------------------------
-- Table structure for tbl_estado_deportistas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estado_deportistas`;
CREATE TABLE `tbl_estado_deportistas` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `icono` varchar(50) DEFAULT NULL,
  `etiqueta` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_estado_deportistas
-- ----------------------------
INSERT INTO `tbl_estado_deportistas` VALUES ('1', 'Activo', null, null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('2', 'Inactivo', null, null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('3', 'Eliminado', '', null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('4', 'Lista de Espera', '', null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('5', 'Sancionado', null, null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('6', 'Retirado', null, null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('7', 'Prestado', 'De praxis a otro club', null, null);
INSERT INTO `tbl_estado_deportistas` VALUES ('8', 'Préstamo', 'De otro club a praxis', null, null);

-- ----------------------------
-- Table structure for tbl_eventos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_eventos`;
CREATE TABLE `tbl_eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `contenido` text,
  `fecha_publicacion` datetime DEFAULT NULL,
  `fecha_disponibilidad` datetime DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `lugar` varchar(200) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento`),
  KEY `fk_tbl_eventos_tbl_tipos_evento1_idx` (`tipo_id`) USING BTREE,
  KEY `fk_tbl_eventos_tbl_estados_evento` (`estado`) USING BTREE,
  CONSTRAINT `fk_tbl_eventos_tbl_estados_evento` FOREIGN KEY (`estado`) REFERENCES `tbl_estados_evento` (`id_estado`),
  CONSTRAINT `fk_tbl_eventos_tbl_tipos_evento1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_evento` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_eventos
-- ----------------------------
INSERT INTO `tbl_eventos` VALUES ('1', 'Fiesta a los niños', '<p>Celebracion anual para los ni&ntilde;os del Club</p>', '2016-11-01 09:24:44', '2016-11-10 00:00:00', '1', 'El parque de los pies descalsos', '20:22:00', '1', '2016-11-10', '1');
INSERT INTO `tbl_eventos` VALUES ('2', 'Bazar Dia de los niños', '<p>Fiesta de disfraces</p>', '2016-11-01 10:41:29', '2016-11-11 00:00:00', '1', 'Cisneros', '00:00:00', '1', '2016-11-24', '1');
INSERT INTO `tbl_eventos` VALUES ('3', 'Bazar Chido', '<p>Bazar entretenido</p>', '2016-11-23 08:04:56', '2016-11-24 00:00:00', '1', 'Plaza Mayor', '19:00:00', '1', '2016-11-24', '1');

-- ----------------------------
-- Table structure for tbl_faltas_x_matriculas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_faltas_x_matriculas`;
CREATE TABLE `tbl_faltas_x_matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_id` int(11) NOT NULL,
  `asistencia_id` int(11) NOT NULL,
  `justificacion` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_faltas_x_matriculas_tbl_matriculas1_idx` (`matricula_id`) USING BTREE,
  KEY `fk_tbl_faltas_x_matriculas_tbl_asistencia1_idx` (`asistencia_id`) USING BTREE,
  CONSTRAINT `fk_tbl_faltas_x_matriculas_tbl_asistencia1` FOREIGN KEY (`asistencia_id`) REFERENCES `tbl_asistencia` (`id_asistencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_faltas_x_matriculas_tbl_matriculas1` FOREIGN KEY (`matricula_id`) REFERENCES `tbl_matriculas` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_faltas_x_matriculas
-- ----------------------------
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('3', '2', '3', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('4', '10', '4', 'Tiene sarampion     ');
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('5', '10', '9', null);

-- ----------------------------
-- Table structure for tbl_fichas_posiciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fichas_posiciones`;
CREATE TABLE `tbl_fichas_posiciones` (
  `id_fp` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `posicion_id` int(11) NOT NULL,
  PRIMARY KEY (`id_fp`),
  KEY `fk_tbl_fichas_posiciones_tbl_fichas_tecnicas1_idx` (`ficha_id`) USING BTREE,
  KEY `fk_tbl_fichas_posiciones_tbl_posiciones1_idx` (`posicion_id`) USING BTREE,
  CONSTRAINT `fk_tbl_fichas_posiciones_tbl_fichas_tecnicas1` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_fichas_tecnicas` (`id_ficha_tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_fichas_posiciones_tbl_posiciones1` FOREIGN KEY (`posicion_id`) REFERENCES `tbl_posiciones` (`id_posicion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_fichas_posiciones
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_fichas_tecnicas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fichas_tecnicas`;
CREATE TABLE `tbl_fichas_tecnicas` (
  `id_ficha_tecnica` int(11) NOT NULL AUTO_INCREMENT,
  `amonestacion` int(11) DEFAULT '0',
  `dorsal` int(11) DEFAULT '0',
  `expulsion` int(11) DEFAULT '0' COMMENT '0',
  `fecha_actualizacion` date DEFAULT NULL,
  `peso` float DEFAULT '0',
  `pierna_habil` tinyint(1) DEFAULT NULL,
  `entrenador_id` int(11) NOT NULL,
  `talla` float DEFAULT '0',
  `valoracion` float DEFAULT '0' COMMENT '0',
  `rh` varchar(6) DEFAULT 'N/A',
  `deportista_id` int(11) NOT NULL,
  `lesiones` text,
  PRIMARY KEY (`id_ficha_tecnica`),
  KEY `fk_tbl_fichas_tecnicas_tbl_personas1_idx` (`deportista_id`) USING BTREE,
  CONSTRAINT `fk_tbl_fichas_tecnicas_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_fichas_tecnicas
-- ----------------------------
INSERT INTO `tbl_fichas_tecnicas` VALUES ('1', '0', '0', '0', null, '0', null, '1', '0', null, 'N/A', '5', 'Ninguna');

-- ----------------------------
-- Table structure for tbl_galerias
-- ----------------------------
DROP TABLE IF EXISTS `tbl_galerias`;
CREATE TABLE `tbl_galerias` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  `evento_id` int(11) NOT NULL,
  PRIMARY KEY (`id_galeria`),
  KEY `fk_tbl_galerias_tbl_eventos1_idx` (`evento_id`) USING BTREE,
  CONSTRAINT `fk_tbl_galerias_tbl_eventos1` FOREIGN KEY (`evento_id`) REFERENCES `tbl_eventos` (`id_evento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_galerias
-- ----------------------------
INSERT INTO `tbl_galerias` VALUES ('1', 'Galería 1', '1');
INSERT INTO `tbl_galerias` VALUES ('2', 'Mi galería', '2');

-- ----------------------------
-- Table structure for tbl_imagenes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_imagenes`;
CREATE TABLE `tbl_imagenes` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_imagenes
-- ----------------------------
INSERT INTO `tbl_imagenes` VALUES ('2', null, 'komp_13.jpg');
INSERT INTO `tbl_imagenes` VALUES ('3', null, 'Selección_017.png');
INSERT INTO `tbl_imagenes` VALUES ('4', null, 'a.aaa.jpg');
INSERT INTO `tbl_imagenes` VALUES ('9', null, 'hackergarage-20-22-septiembre-aprende-php-desde-cero-gdl.jpg');
INSERT INTO `tbl_imagenes` VALUES ('10', null, 'Captura.PNG');
INSERT INTO `tbl_imagenes` VALUES ('11', null, 'COMPUTADORAS.jpg');
INSERT INTO `tbl_imagenes` VALUES ('12', null, 'glassy-php-wallpaper.jpg');
INSERT INTO `tbl_imagenes` VALUES ('13', null, 'hackergarage-20-22-septiembre-aprende-php-desde-cero-gdl.jpg');

-- ----------------------------
-- Table structure for tbl_imagenes_galerias
-- ----------------------------
DROP TABLE IF EXISTS `tbl_imagenes_galerias`;
CREATE TABLE `tbl_imagenes_galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NOT NULL,
  `galeria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_imagenes_galerias_tbl_imagenes1_idx` (`imagen_id`) USING BTREE,
  KEY `fk_tbl_imagenes_galerias_tbl_galerias1_idx` (`galeria_id`) USING BTREE,
  CONSTRAINT `fk_tbl_imagenes_galerias_tbl_galerias1` FOREIGN KEY (`galeria_id`) REFERENCES `tbl_galerias` (`id_galeria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_imagenes_galerias_tbl_imagenes1` FOREIGN KEY (`imagen_id`) REFERENCES `tbl_imagenes` (`id_imagen`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_imagenes_galerias
-- ----------------------------
INSERT INTO `tbl_imagenes_galerias` VALUES ('2', '4', '2');
INSERT INTO `tbl_imagenes_galerias` VALUES ('3', '3', '2');
INSERT INTO `tbl_imagenes_galerias` VALUES ('4', '2', '2');

-- ----------------------------
-- Table structure for tbl_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_implementos`;
CREATE TABLE `tbl_implementos` (
  `id_implemento` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text,
  `unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `minimo_unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `maximo_unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `estado_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id_implemento`),
  KEY `fk_tbl_implementos_tbl_categorias_implementos1_idx` (`categoria_id`) USING BTREE,
  KEY `fk_tbl_implementos_tbl_estados_implementos1_idx` (`estado_id`) USING BTREE,
  CONSTRAINT `fk_tbl_implementos_tbl_categorias_implementos1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias_implementos` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_implementos_tbl_estados_implementos1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estados_implementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_implementos
-- ----------------------------
INSERT INTO `tbl_implementos` VALUES ('1', '2', 'Balón', null, '22', '6', '12', '1');

-- ----------------------------
-- Table structure for tbl_lista_espera
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lista_espera`;
CREATE TABLE `tbl_lista_espera` (
  `id_lista` int(11) NOT NULL AUTO_INCREMENT,
  `deportista_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` int(11) DEFAULT '1',
  PRIMARY KEY (`id_lista`),
  KEY `fk_lista_deportista` (`deportista_id`),
  KEY `fk_listas_categorias` (`categoria_id`),
  CONSTRAINT `fk_listas_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`),
  CONSTRAINT `fk_lista_deportista` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_lista_espera
-- ----------------------------
INSERT INTO `tbl_lista_espera` VALUES ('6', '4', '1', '2016-11-23 00:00:00', '0');
INSERT INTO `tbl_lista_espera` VALUES ('7', '7', '1', '2016-11-23 00:00:00', '0');

-- ----------------------------
-- Table structure for tbl_mapa_navegacion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mapa_navegacion`;
CREATE TABLE `tbl_mapa_navegacion` (
  `id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text,
  `padre_id` int(11) DEFAULT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_opcion`),
  KEY `fk_mapa_navegacion_padre` (`padre_id`),
  CONSTRAINT `fk_mapa_navegacion_padre` FOREIGN KEY (`padre_id`) REFERENCES `tbl_mapa_navegacion` (`id_opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_mapa_navegacion
-- ----------------------------
INSERT INTO `tbl_mapa_navegacion` VALUES ('1', 'Deportistas', null, null, 'male', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('2', 'Formación', null, null, 'soccer-ball-o', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('3', 'Implementos', null, null, 'cubes', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('4', 'Pagos', null, null, 'money', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('5', 'Torneos', null, null, 'trophy', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('6', 'Publicaciones', null, null, 'newspaper-o', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('7', 'Usuarios', null, null, 'users', null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('8', 'Acudientes', null, '1', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('9', 'Deportistas', null, '1', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('10', 'Documentos', null, '1', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('11', 'Registrar Acudientes', null, '8', null, 'acudiente/crear');
INSERT INTO `tbl_mapa_navegacion` VALUES ('12', 'Consultar Acudientes', null, '8', null, 'acudiente/inicio');
INSERT INTO `tbl_mapa_navegacion` VALUES ('13', 'Modificar Acudientes', null, '8', null, '#');
INSERT INTO `tbl_mapa_navegacion` VALUES ('14', 'Eliminar Acudientes', null, '8', null, '#');
INSERT INTO `tbl_mapa_navegacion` VALUES ('15', 'Registrar Deportistas', null, '9', null, 'deportista/registrar');
INSERT INTO `tbl_mapa_navegacion` VALUES ('16', 'Consultar Deporistas', null, '9', null, 'deportista/inicio');
INSERT INTO `tbl_mapa_navegacion` VALUES ('17', 'Modificar Deportistas', null, '9', null, '#');
INSERT INTO `tbl_mapa_navegacion` VALUES ('18', 'Cambiar estado a Deportistas', null, '9', null, '#');
INSERT INTO `tbl_mapa_navegacion` VALUES ('19', 'Ver Ficha tecnica de Deportistas', null, '9', null, '#');
INSERT INTO `tbl_mapa_navegacion` VALUES ('20', 'Listar Documentos cargados', null, '10', null, 'documentos/inicio');
INSERT INTO `tbl_mapa_navegacion` VALUES ('21', 'Gestionar Categorías de Deportistas', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('22', 'Gestionar Matrículas de Deportistas', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('23', 'Toma de Asistencia', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('24', 'Consultar Lista de Espera', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('25', 'Gestionar Planes de Trabajo', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('26', 'Gestionar Objetivos de Planes de Trabajo', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('27', 'Gestionar Préstamo de Deportistas', null, '2', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('28', 'Registrar Categoría', null, '21', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('29', 'Consultar Categoría', null, '21', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('30', 'Modificar Categoría', null, '21', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('31', 'Inhabilitar Categoría', null, '21', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('32', 'Matricular Deportista', null, '22', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('33', 'Ver Matrículas', null, '22', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('34', 'Anular Matrículas', null, '22', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('35', 'Tomar Asistencia', null, '23', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('36', 'Consultar Asistencias', null, '23', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('37', 'Registrar Justificación a faltas', null, '23', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('38', 'Ver Lista de Espera', null, '24', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('39', 'Enviar Deportista a Lista de Espera', null, '24', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('40', 'Registrar Planes de Trabajo', null, '25', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('41', 'Consultar Planes de Trabajo', null, '25', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('42', 'Modificar Planes de Trabajo', null, '25', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('43', 'Eliminar Planes de Trabajo', null, '25', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('44', 'Registrar Objetivos', null, '26', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('45', 'Consultar Objetivos', null, '26', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('46', 'Modificar Objetivos', null, '26', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('47', 'Eliminar Objetivos', null, '26', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('48', 'Registrar Préstamos de Deportistas', null, '27', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('49', 'Consultar Préstamos de Deportistas', null, '27', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('50', 'Modificar Préstamo de Deportistas', null, '27', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('51', 'Eliminar Préstamos de Deportistas', null, '27', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('52', 'Finalizar Préstamo de Deportistas', null, '27', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('53', 'Gestionar Categorías de Implementos', null, '3', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('54', 'Gestionar Implementos', null, '3', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('55', 'Gestionar Entradas de Implementos', null, '3', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('56', 'Gestionar Préstamo de Implementos', null, '3', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('57', 'Registrar Categorías', null, '53', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('58', 'Consultar Categorías', null, '53', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('59', 'Modificar Categoría', null, '53', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('60', 'Inhabilitar Categoría', null, '53', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('61', 'Registrar Implementos', null, '54', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('62', 'Consultar Implementos', null, '54', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('63', 'Modificar Implemento', null, '54', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('64', 'Ihabilitar Implementos', null, '54', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('65', 'Registrar Entrada', null, '55', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('66', 'Consultar Entrada', null, '55', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('67', 'Anular Entradas', null, '55', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('68', 'Registrar Préstamos', null, '56', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('69', 'Consultar Préstamos', null, '56', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('70', 'Anular Préstamos', null, '56', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('71', 'Registra Entregas', null, '56', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('72', 'Consultar Pagos Pendientes', null, '4', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('73', 'Consultar Pagos Realizados', null, '4', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('74', 'Registrar Pagos', null, '72', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('75', 'Anular Pagos', null, '73', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('76', 'Torneos', null, '5', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('77', 'Registrar Torneos', null, '5', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('78', 'Consultar Torneos', null, '76', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('79', 'Modificar Torneos', null, '76', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('80', 'Gestionar Equipos', null, '76', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('81', 'Gestionar Equipos', null, '77', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('82', 'Gestionar Publicaciones', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('83', 'Gestionar Tipos de Publicación', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('84', 'Gestionar Eventos', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('85', 'Gestionar Tipos de Evento', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('86', 'Gestionar Imagenes', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('87', 'Configuración de Publicaciones', null, '6', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('88', 'Registrar Publicación', null, '82', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('89', 'Consultar publicaciones', null, '82', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('90', 'Modificar Publicación', null, '82', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('91', 'Registrar tipo', null, '83', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('92', 'Consultar Tipo', null, '83', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('93', 'Modificar Tipo', null, '83', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('94', 'Anular Tipo', null, '83', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('95', 'Registrar Evento', null, '84', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('96', 'Consultar Evnetos', null, '84', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('97', 'Modificar Evento', null, '84', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('98', 'Registrar tipo', null, '85', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('99', 'Consultar Tipo', null, '85', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('100', 'Modificar Tipo', null, '85', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('101', 'Anular Tipo', null, '85', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('102', 'Consultar Imagenes', null, '86', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('103', 'Cargar Imagenes', null, '86', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('104', 'Eliminar imagenes', null, '86', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('105', 'Roles', null, '7', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('106', 'Usuarios', null, '7', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('107', 'Permisos', null, '7', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('108', 'Registrar Roles', null, '105', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('109', 'Consultar Roles', null, '105', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('110', 'Modificar Rol', null, '105', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('111', 'Ihabilitar Rol', null, '105', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('112', 'Registrar Usuarios', null, '106', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('113', 'Consultar Usuarios', null, '106', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('114', 'Modificar Usuario', null, '106', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('115', 'Ihabilitar Usuarios', null, '106', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('116', 'Asignar Privilegios', null, '107', null, null);
INSERT INTO `tbl_mapa_navegacion` VALUES ('117', 'Remover Privilegios', null, '107', null, null);

-- ----------------------------
-- Table structure for tbl_matriculas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_matriculas`;
CREATE TABLE `tbl_matriculas` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_pago` date NOT NULL,
  `url_comprobante` varchar(50) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `deportista_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `anio` year(4) DEFAULT NULL,
  `fecha_realizacion` datetime DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `fk_tbl_matriculas_tbl_personas1_idx` (`deportista_id`) USING BTREE,
  KEY `fk_tbl_matriculas_tbl_categorias1_idx` (`categoria_id`) USING BTREE,
  KEY `fk_tbl_matriculas_tbl_clubes` (`club_id`),
  CONSTRAINT `fk_tbl_matriculas_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_matriculas_tbl_clubes` FOREIGN KEY (`club_id`) REFERENCES `tbl_clubes` (`id`),
  CONSTRAINT `fk_tbl_matriculas_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_matriculas
-- ----------------------------
INSERT INTO `tbl_matriculas` VALUES ('1', '2016-11-02', 'Matricula-2016-09898789789.jpg', '0', '1', '1', '2016', '2016-11-01 09:49:45', '1');
INSERT INTO `tbl_matriculas` VALUES ('2', '2016-11-01', 'Matricula-2016-09898789789.jpg', '0', '1', '1', '2016', '2016-11-01 10:11:01', '1');
INSERT INTO `tbl_matriculas` VALUES ('3', '2016-11-01', null, '0', '5', '1', '2016', '2016-10-01 10:23:45', '1');
INSERT INTO `tbl_matriculas` VALUES ('4', '2016-11-11', null, '0', '4', '2', '2016', '2016-11-17 01:51:03', '1');
INSERT INTO `tbl_matriculas` VALUES ('5', '2016-11-16', 'Matricula-2016-1229.jpg', '0', '6', '1', '2016', '2016-11-17 01:56:40', '1');
INSERT INTO `tbl_matriculas` VALUES ('6', '2015-03-04', null, '0', '8', '5', '2016', '2016-11-17 07:42:21', '1');
INSERT INTO `tbl_matriculas` VALUES ('7', '2016-11-30', null, '0', '8', '5', '2016', '2016-11-17 07:53:25', '1');
INSERT INTO `tbl_matriculas` VALUES ('8', '2016-11-30', null, '0', '8', '5', '2016', '2016-11-17 07:55:10', '1');
INSERT INTO `tbl_matriculas` VALUES ('9', '2016-11-16', null, '0', '8', '5', '2016', '2016-11-17 07:57:06', '1');
INSERT INTO `tbl_matriculas` VALUES ('10', '2018-11-01', 'Matricula-2016-10345555.jpg', '0', '8', '5', '2016', '2016-11-17 07:58:16', '1');
INSERT INTO `tbl_matriculas` VALUES ('11', '2016-11-30', null, '0', '7', '5', '2016', '2016-11-17 08:00:00', '1');
INSERT INTO `tbl_matriculas` VALUES ('12', '2016-11-01', 'Matricula-2016-1229.PNG', '0', '6', '5', '2016', '2016-11-17 08:07:58', '1');
INSERT INTO `tbl_matriculas` VALUES ('13', '2016-11-17', 'Matricula-2016-09898789789.jpg', '0', '1', '2', '2016', '2016-11-21 08:26:06', '1');
INSERT INTO `tbl_matriculas` VALUES ('14', '2016-11-21', 'Matricula-2016-10342020.PNG', '0', '7', '1', '2016', '2016-11-21 09:19:07', '2');
INSERT INTO `tbl_matriculas` VALUES ('15', '2016-11-22', 'Matricula-2016-0.PNG', '0', '5', '3', '2016', '2016-11-21 22:27:28', '1');
INSERT INTO `tbl_matriculas` VALUES ('16', '2016-11-21', 'Matricula-2016-0.PNG', '0', '5', '3', '2016', '2016-11-21 22:28:29', '1');
INSERT INTO `tbl_matriculas` VALUES ('17', '2016-11-23', null, '0', '10', '2', '2016', '2016-11-23 01:26:34', '1');
INSERT INTO `tbl_matriculas` VALUES ('18', '2016-11-23', 'Matricula-2016-987898797.PNG', '0', '4', '1', '2016', '2016-11-23 01:53:17', '1');
INSERT INTO `tbl_matriculas` VALUES ('19', '2016-11-23', 'Matricula-2016-987898797.PNG', '0', '4', '1', '2016', '2016-11-23 02:26:23', '1');
INSERT INTO `tbl_matriculas` VALUES ('20', '2016-11-23', 'Matricula-2016-987898797.PNG', '1', '4', '1', '2016', '2016-11-23 02:28:34', '1');
INSERT INTO `tbl_matriculas` VALUES ('21', '2016-11-23', null, '1', '7', '1', '2016', '2016-11-23 06:36:55', '1');

-- ----------------------------
-- Table structure for tbl_modulos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_modulos`;
CREATE TABLE `tbl_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_modulos
-- ----------------------------
INSERT INTO `tbl_modulos` VALUES ('1', 'Formación', 'Este es un módulo.');
INSERT INTO `tbl_modulos` VALUES ('2', 'Control de Existencias', '');
INSERT INTO `tbl_modulos` VALUES ('3', 'Deportistas', '');
INSERT INTO `tbl_modulos` VALUES ('4', 'Usuarios', '');

-- ----------------------------
-- Table structure for tbl_objetivos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_objetivos`;
CREATE TABLE `tbl_objetivos` (
  `id_objetivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_objetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_objetivos
-- ----------------------------
INSERT INTO `tbl_objetivos` VALUES ('1', 'Trotar', null);
INSERT INTO `tbl_objetivos` VALUES ('2', 'Driblar', null);
INSERT INTO `tbl_objetivos` VALUES ('3', 'Pases', null);
INSERT INTO `tbl_objetivos` VALUES ('4', 'Cabecear', null);
INSERT INTO `tbl_objetivos` VALUES ('5', 'Velocidad', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisici');
INSERT INTO `tbl_objetivos` VALUES ('6', 'Nuevo', null);
INSERT INTO `tbl_objetivos` VALUES ('7', 'Otro', null);
INSERT INTO `tbl_objetivos` VALUES ('8', 'Alguno', null);

-- ----------------------------
-- Table structure for tbl_objetivos_planes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_objetivos_planes`;
CREATE TABLE `tbl_objetivos_planes` (
  `id_op` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  PRIMARY KEY (`id_op`),
  KEY `fk_tbl_objetivos_planes_tbl_objetivos1_idx` (`objetivo_id`) USING BTREE,
  KEY `fk_tbl_objetivos_planes_tbl_planes_trabajo1_idx` (`plan_id`) USING BTREE,
  CONSTRAINT `fk_tbl_objetivos_planes_tbl_objetivos1` FOREIGN KEY (`objetivo_id`) REFERENCES `tbl_objetivos` (`id_objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_objetivos_planes_tbl_planes_trabajo1` FOREIGN KEY (`plan_id`) REFERENCES `tbl_planes_trabajo` (`id_plan_trabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_objetivos_planes
-- ----------------------------
INSERT INTO `tbl_objetivos_planes` VALUES ('1', '1', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('2', '2', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('3', '3', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('4', '4', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('5', '5', '2');
INSERT INTO `tbl_objetivos_planes` VALUES ('6', '1', '2');
INSERT INTO `tbl_objetivos_planes` VALUES ('12', '1', '3');
INSERT INTO `tbl_objetivos_planes` VALUES ('13', '2', '3');
INSERT INTO `tbl_objetivos_planes` VALUES ('14', '1', '6');
INSERT INTO `tbl_objetivos_planes` VALUES ('15', '3', '7');

-- ----------------------------
-- Table structure for tbl_opmenu
-- ----------------------------
DROP TABLE IF EXISTS `tbl_opmenu`;
CREATE TABLE `tbl_opmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(45) NOT NULL,
  `ruta_id` int(11) NOT NULL,
  `padre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_opmenu_tbl_rutas1_idx` (`ruta_id`) USING BTREE,
  KEY `fk_tbl_opmenu_padre_id_idx` (`padre_id`) USING BTREE,
  CONSTRAINT `fk_tbl_opmenu_padre_id` FOREIGN KEY (`padre_id`) REFERENCES `tbl_opmenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_opmenu_tbl_rutas1` FOREIGN KEY (`ruta_id`) REFERENCES `tbl_rutas` (`id_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_opmenu
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pagos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pagos`;
CREATE TABLE `tbl_pagos` (
  `id_pago` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `valor_cancelado` double NOT NULL,
  `url_comprobante` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `descuento` double DEFAULT NULL,
  `razon_descuento` varchar(200) DEFAULT NULL,
  `matricula_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_tbl_pagos_tbl_matriculas1_idx` (`matricula_id`) USING BTREE,
  CONSTRAINT `fk_tbl_pagos_tbl_matriculas1` FOREIGN KEY (`matricula_id`) REFERENCES `tbl_matriculas` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_pagos
-- ----------------------------
INSERT INTO `tbl_pagos` VALUES ('1', '2016-11-01', '100000', 'comprobante-1229-2016-11-01.jpg', '0', '100000', null, '12');
INSERT INTO `tbl_pagos` VALUES ('2', '2016-11-01', '0', 'comprobante-1229-2016-11-01.jpg', '1', '0', null, '12');
INSERT INTO `tbl_pagos` VALUES ('3', '2016-11-01', '10000', 'comprobante-0-2016-11-01.jpg', '1', null, null, '3');
INSERT INTO `tbl_pagos` VALUES ('4', '2016-12-01', '5000', 'comprobante-1229-2016-12-01.jpg', '1', null, null, '12');

-- ----------------------------
-- Table structure for tbl_planes_trabajo
-- ----------------------------
DROP TABLE IF EXISTS `tbl_planes_trabajo`;
CREATE TABLE `tbl_planes_trabajo` (
  `id_plan_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `fecha_aplicacion` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id_plan_trabajo`),
  KEY `fk_tbl_planes_trabajo_tbl_categorias1_idx` (`categoria_id`) USING BTREE,
  CONSTRAINT `fk_tbl_planes_trabajo_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_planes_trabajo
-- ----------------------------
INSERT INTO `tbl_planes_trabajo` VALUES ('1', 'Plan para el año actual.', '2016-01-01', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('2', 'Fortalecer ', '2017-12-14', '1', '5');
INSERT INTO `tbl_planes_trabajo` VALUES ('3', 'Mayores', '2016-11-30', '1', '5');
INSERT INTO `tbl_planes_trabajo` VALUES ('4', 'Nuevo plan', '2016-11-23', '0', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('5', 'dfjlkasjñflkajdlsk', '2016-11-24', '0', '2');
INSERT INTO `tbl_planes_trabajo` VALUES ('6', 'lkjasdñljfasfklasdjfñaslkdjfñsaldjfkasfjñlka', '2016-11-27', '1', '2');
INSERT INTO `tbl_planes_trabajo` VALUES ('7', 'asldfkjñlaksdflkasdjfñjask', '2016-11-26', '1', '1');

-- ----------------------------
-- Table structure for tbl_posiciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_posiciones`;
CREATE TABLE `tbl_posiciones` (
  `id_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `posicion` varchar(25) NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_posicion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_posiciones
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_prestamos_deportista
-- ----------------------------
DROP TABLE IF EXISTS `tbl_prestamos_deportista`;
CREATE TABLE `tbl_prestamos_deportista` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `club_origen` varchar(80) NOT NULL,
  `club_destino` varchar(80) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `deportista_id` int(11) NOT NULL,
  `tipo_prestamo` enum('salida','entrada') NOT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `fk_tbl_prestamos_deportista_tbl_personas1_idx` (`deportista_id`) USING BTREE,
  CONSTRAINT `fk_tbl_prestamos_deportista_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_prestamos_deportista
-- ----------------------------
INSERT INTO `tbl_prestamos_deportista` VALUES ('1', 'Alguno', 'Otro', '2016-11-01', '2016-11-30', '0', '1', 'salida');
INSERT INTO `tbl_prestamos_deportista` VALUES ('2', 'Leones', 'Los delfines', '1977-02-03', '2016-02-04', '0', '6', 'salida');
INSERT INTO `tbl_prestamos_deportista` VALUES ('3', 'Los Leones', 'Los delfines', '2016-11-01', '2016-11-02', '0', '1', 'salida');

-- ----------------------------
-- Table structure for tbl_publicaciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_publicaciones`;
CREATE TABLE `tbl_publicaciones` (
  `id_publicacion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `contenido` text,
  `consecutivo` int(10) unsigned DEFAULT NULL,
  `fecha_publicacion` datetime NOT NULL,
  `fecha_disponibilidad` datetime DEFAULT NULL,
  `tipo_id` int(11) NOT NULL,
  `lugar` varchar(200) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `resumen` varchar(150) DEFAULT NULL,
  `img_previsualizacion` varchar(300) DEFAULT NULL,
  `vistas` int(11) DEFAULT '0',
  PRIMARY KEY (`id_publicacion`),
  KEY `fk_tbl_publicaciones_tbl_usuarios1_idx` (`usuario_id`) USING BTREE,
  KEY `fk_tbl_publicaciones_tbl_tipos_publicacion1_idx` (`tipo_id`) USING BTREE,
  KEY `fk_tbl_publicaciones_tbl_estados_publicacion1_idx` (`estado_id`) USING BTREE,
  CONSTRAINT `fk_tbl_publicaciones_tbl_estados_publicacion1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estados_publicacion` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_publicaciones_tbl_tipos_publicacion1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_publicacion` (`id_tipo_publicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_publicaciones_tbl_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_publicaciones
-- ----------------------------
INSERT INTO `tbl_publicaciones` VALUES ('1', 'La noticia', '<h1 style=\"text-align: center;\"><strong>NUEVOS ENTRENADORES</strong></h1>\r\n<p>&nbsp;Alejandro Quiroz</p>\r\n<p><img src=\"http://localhost/proyecto-formacion/prax-sys-prod/publico/imagenes/galerias/Selecci&oacute;n_017.png\" alt=\"\" width=\"590\" height=\"362\" /></p>\r\n<p>&nbsp;</p>', null, '2016-11-01 10:39:40', '2016-11-25 00:00:00', '1', null, null, '1', '1', 'Noticia', 'http://localhost/proyecto-formacion/prax-sys-prod/publico/imagenes/galerias/Selección_017.png', null);
INSERT INTO `tbl_publicaciones` VALUES ('2', 'Circular Iniciación de actividades', '<p>Circular....</p>', '7', '2016-11-23 03:36:29', '2016-11-30 00:00:00', '2', null, null, '2', '1', 'Una hermosa circular', 'http://localhost/proyecto-formacion/prax-sys-prod/publico/imagenes/galerias/komp_13.jpg', null);
INSERT INTO `tbl_publicaciones` VALUES ('3', 'Matricula', '<h1 style=\"text-align: center;\">CIRCULAR MATRICULA</h1>\r\n<p style=\"text-align: justify;\">&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Medellin, 23 de noviembre de 2016</p>\r\n<p><a title=\"Pagina Sena\" href=\"http://www.sena.edu.co\" target=\"_blank\">www.sena.edu.co</a></p>\r\n<p>&nbsp;</p>\r\n<p>Asunto: Matricula nuevos deportistas</p>\r\n<p>&nbsp;</p>\r\n<p>Apreciados padres de familia:</p>\r\n<p>La fecha de matricula para el a&ntilde;o 2017 se realizara el dia 1 de diciembre de 2016 en el horario de 9:00am a 12:00m y de 1:00pm a 5:00pm</p>\r\n<p>&nbsp;</p>\r\n<p>Cordialmente,</p>\r\n<p>Equipo Praxys</p>', '6', '2016-11-23 07:37:09', '2016-12-07 00:00:00', '2', null, null, '1', '1', 'Circular de Matricula', null, null);

-- ----------------------------
-- Table structure for tbl_roles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `desarrollador` tinyint(1) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `web_site` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_roles
-- ----------------------------
INSERT INTO `tbl_roles` VALUES ('1', 'Desarrollador', null, '1', '1', '0');
INSERT INTO `tbl_roles` VALUES ('2', 'Administrador', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('3', 'Secretaria', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('4', 'Entrenador', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('5', 'Asistente', 'Asistente', '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('6', 'Suscrito', 'Suscrito', '0', '1', '1');

-- ----------------------------
-- Table structure for tbl_rutas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rutas`;
CREATE TABLE `tbl_rutas` (
  `id_ruta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `modulo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_ruta`),
  KEY `fk_tbl_rutas_tbl_modulos1_idx` (`modulo_id`) USING BTREE,
  CONSTRAINT `fk_tbl_rutas_tbl_modulos1` FOREIGN KEY (`modulo_id`) REFERENCES `tbl_modulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_rutas
-- ----------------------------
INSERT INTO `tbl_rutas` VALUES ('1', 'Registrar Usuario', 'Usuario/crear', '4');
INSERT INTO `tbl_rutas` VALUES ('2', 'Listar Usuarios', 'Usuario/inicio', '4');
INSERT INTO `tbl_rutas` VALUES ('3', 'Registrar Deportista', 'Deportista/crear', '3');
INSERT INTO `tbl_rutas` VALUES ('4', 'Listar Deportistas', 'Deportista/inicio', '3');
INSERT INTO `tbl_rutas` VALUES ('5', 'Registrar Implemento', 'Implemento/crear', '2');
INSERT INTO `tbl_rutas` VALUES ('6', 'Listar Implementos', 'Implemento/inicio', '2');

-- ----------------------------
-- Table structure for tbl_rutas_x_rol
-- ----------------------------
DROP TABLE IF EXISTS `tbl_rutas_x_rol`;
CREATE TABLE `tbl_rutas_x_rol` (
  `id_rxr` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `ruta_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_rxr`),
  KEY `fk_tbl_rutas_x_rol_tbl_controladores_rutas1_idx` (`ruta_id`) USING BTREE,
  KEY `fk_tbl_rutas_x_rol_tbl_roles1_idx` (`rol_id`) USING BTREE,
  CONSTRAINT `fk_tbl_rutas_x_rol_tbl_controladores_rutas1` FOREIGN KEY (`ruta_id`) REFERENCES `tbl_rutas` (`id_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_rutas_x_rol_tbl_roles1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_rutas_x_rol
-- ----------------------------
INSERT INTO `tbl_rutas_x_rol` VALUES ('1', '1', '5', '1');
INSERT INTO `tbl_rutas_x_rol` VALUES ('2', '1', '6', '1');

-- ----------------------------
-- Table structure for tbl_salidas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_salidas`;
CREATE TABLE `tbl_salidas` (
  `id_salida` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_realizacion` datetime NOT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `descripcion` text,
  `responsable_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_salida`),
  KEY `fk_tbl_salidas_tbl_usuarios1_idx` (`responsable_id`) USING BTREE,
  CONSTRAINT `fk_tbl_salidas_tbl_usuarios1` FOREIGN KEY (`responsable_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_salidas
-- ----------------------------
INSERT INTO `tbl_salidas` VALUES ('1', '2016-11-01 10:31:27', '2016-11-10 00:00:00', null, '2', '1');
INSERT INTO `tbl_salidas` VALUES ('2', '2016-11-17 03:27:16', '2016-11-17 00:00:00', null, '3', '0');
INSERT INTO `tbl_salidas` VALUES ('3', '2016-11-17 03:28:28', '2016-11-17 00:00:00', null, '1', '2');
INSERT INTO `tbl_salidas` VALUES ('4', '2016-11-19 20:22:25', '2016-11-23 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisici', '2', '1');

-- ----------------------------
-- Table structure for tbl_salidas_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_salidas_implementos`;
CREATE TABLE `tbl_salidas_implementos` (
  `id_si` int(11) NOT NULL AUTO_INCREMENT,
  `salida_id` int(11) NOT NULL,
  `implemento_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `detalle` varchar(300) DEFAULT NULL,
  `cantidad_devuelta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_si`),
  KEY `fk_tbl_salidas_implementos_tbl_salidas1_idx` (`salida_id`) USING BTREE,
  KEY `fk_tbl_salidas_implementos_tbl_implementos2_idx` (`implemento_id`) USING BTREE,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_implementos2` FOREIGN KEY (`implemento_id`) REFERENCES `tbl_implementos` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_salidas1` FOREIGN KEY (`salida_id`) REFERENCES `tbl_salidas` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_salidas_implementos
-- ----------------------------
INSERT INTO `tbl_salidas_implementos` VALUES ('1', '1', '1', '10', null, null);
INSERT INTO `tbl_salidas_implementos` VALUES ('2', '2', '1', '10', null, null);
INSERT INTO `tbl_salidas_implementos` VALUES ('3', '3', '1', '10', null, '10');
INSERT INTO `tbl_salidas_implementos` VALUES ('4', '4', '1', '10', null, null);

-- ----------------------------
-- Table structure for tbl_seguimientos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_seguimientos`;
CREATE TABLE `tbl_seguimientos` (
  `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_seguimiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `evaluacion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `ficha_tecnica_id` int(11) NOT NULL,
  `realizado_por` int(11) NOT NULL,
  PRIMARY KEY (`id_seguimiento`),
  KEY `fk_tbl_seguimientos_tbl_fichas_tecnicas1_idx` (`ficha_tecnica_id`) USING BTREE,
  CONSTRAINT `fk_tbl_seguimientos_tbl_fichas_tecnicas1` FOREIGN KEY (`ficha_tecnica_id`) REFERENCES `tbl_fichas_tecnicas` (`id_ficha_tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_seguimientos
-- ----------------------------
INSERT INTO `tbl_seguimientos` VALUES ('1', '0', '1', '2', '2016-11-16', 'asdfñlasdñfkasdfñlkasñldfñaskldflñkasfasdñlfklñasdfkñlasdkflñsadfñlkfkasdñlfañsflkñalsdkf{asdkfasdflñkasldñfkasdñflklñaksd', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('2', '0', '1', '3', '2016-11-16', 'asdfasdfasdfasdfasdfasdfasdfadsfasdfasdfasdfasdfasdfasjdflñkasjdflñjasdlñkfjlañskdjflñkasjdflñjasdlñ', '1', '1');

-- ----------------------------
-- Table structure for tbl_tipos_documento
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_documento`;
CREATE TABLE `tbl_tipos_documento` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `padre_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`),
  KEY `fk_padre_id_tipos_documentos_idx` (`padre_id`) USING BTREE,
  CONSTRAINT `fk_padre_id_tipos_documentos` FOREIGN KEY (`padre_id`) REFERENCES `tbl_tipos_documento` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_tipos_documento
-- ----------------------------
INSERT INTO `tbl_tipos_documento` VALUES ('1', 'Documentos personales', null, null);
INSERT INTO `tbl_tipos_documento` VALUES ('2', 'Recibos', null, null);
INSERT INTO `tbl_tipos_documento` VALUES ('3', 'Boletines', null, null);

-- ----------------------------
-- Table structure for tbl_tipos_evento
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_evento`;
CREATE TABLE `tbl_tipos_evento` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_tipos_evento
-- ----------------------------
INSERT INTO `tbl_tipos_evento` VALUES ('1', 'Bazar     ', 'Bazar anual');

-- ----------------------------
-- Table structure for tbl_tipos_identificacion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_identificacion`;
CREATE TABLE `tbl_tipos_identificacion` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_tipos_identificacion
-- ----------------------------
INSERT INTO `tbl_tipos_identificacion` VALUES ('1', 'Cédula', 'CC');
INSERT INTO `tbl_tipos_identificacion` VALUES ('2', 'Registro civil', 'RC');
INSERT INTO `tbl_tipos_identificacion` VALUES ('3', 'Tarjeta de identidad', 'TI');

-- ----------------------------
-- Table structure for tbl_tipos_publicacion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_publicacion`;
CREATE TABLE `tbl_tipos_publicacion` (
  `id_tipo_publicacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `consecutivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_publicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_tipos_publicacion
-- ----------------------------
INSERT INTO `tbl_tipos_publicacion` VALUES ('1', 'Noticia', 'Noticias frecuentes del club', null);
INSERT INTO `tbl_tipos_publicacion` VALUES ('2', 'Circular', 'Fin de año', null);

-- ----------------------------
-- Table structure for tbl_torneos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_torneos`;
CREATE TABLE `tbl_torneos` (
  `id_torneo` int(11) NOT NULL AUTO_INCREMENT,
  `cupo_maximo` int(11) NOT NULL,
  `cupo_minimo` int(11) NOT NULL,
  `edad_maxima` int(11) NOT NULL,
  `edad_minima` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `observaciones` text,
  `tabla_posiciones` varchar(200) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(300) DEFAULT NULL,
  `contenido` text,
  PRIMARY KEY (`id_torneo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_torneos
-- ----------------------------
INSERT INTO `tbl_torneos` VALUES ('1', '2', '2', '12', '6', '2016-11-03', '2016-11-04', 'Colomboholandez', null, 'hackergarage-20-22-septiembre-aprende-php-desde-cero-gdl.jpg', null, null, null);
INSERT INTO `tbl_torneos` VALUES ('2', '3', '1', '16', '6', '2015-09-17', '2016-11-25', 'Intercolegiados', 'Solo Medellin', 'COMPUTADORAS.jpg', null, null, null);
INSERT INTO `tbl_torneos` VALUES ('3', '6', '4', '6', '6', '2016-11-21', '2016-12-22', 'Nuevo torneo', 'ajñflkajflñajsdfñljasfkljaf', 'Captura.PNG', null, null, null);
INSERT INTO `tbl_torneos` VALUES ('4', '3', '3', '16', '6', '2016-11-23', '2016-11-23', 'Torneo juandis', null, null, null, null, null);
INSERT INTO `tbl_torneos` VALUES ('5', '1', '4', '5', '6', '2016-11-23', '2016-11-23', 'Los sardinos', null, null, null, null, null);
INSERT INTO `tbl_torneos` VALUES ('6', '2', '1', '10', '6', '2016-11-23', '2016-11-23', 'Torneo Sena', 'A nivel nacional', 'COMPUTADORAS.jpg', null, null, null);

-- ----------------------------
-- Table structure for tbl_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `clave` varchar(180) NOT NULL,
  `recuperacion` tinyint(1) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `foto` varchar(200) DEFAULT NULL,
  `url_recuperacion` varchar(200) DEFAULT NULL,
  `identificacion` varchar(15) DEFAULT NULL,
  `tipo_identificacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_tbl_usuarios_tbl_roles1_idx` (`rol_id`) USING BTREE,
  CONSTRAINT `fk_tbl_usuarios_tbl_roles1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_usuarios
-- ----------------------------
INSERT INTO `tbl_usuarios` VALUES ('1', '1', 'demo1@localhost.com', 'developer', 'Alejo', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'jako_ologram1.png', null, '111111', '1');
INSERT INTO `tbl_usuarios` VALUES ('2', '4', 'milton@gmail.com', 'el_milton', 'Milton', 'Agudelo', '12312313', '7775561b057357e29efd51762e0039957e501d08', null, '1', 'Foto_el_milton.JPG', null, '1231421434', '1');
INSERT INTO `tbl_usuarios` VALUES ('3', '6', 'demo@localhost.com', 'el_jako', 'Alejandro', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'el_jako.jpg', null, '1231241444', '1');
INSERT INTO `tbl_usuarios` VALUES ('4', '2', 'usuario1@localhost.com', 'maistro', 'Cristian', 'Martinez', '123123', 'f67ba7ab3375ff42fb257820c1ec76a2e13dee54', '1', '1', 'Foto_maistro.jpg', 'MTQ3ODIyNzY1Mw==#NDg3NQ==#Mjc=', '32443534', '1');
INSERT INTO `tbl_usuarios` VALUES ('5', '6', 'usuario2@localhost.com', 'alguien', 'Alejandro', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'glassy-php-wallpaper.jpg', null, null, null);

-- ----------------------------
-- Table structure for tbl_visitas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_visitas`;
CREATE TABLE `tbl_visitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicacion_id` int(11) DEFAULT NULL,
  `vistas` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visitas_publicaciones` (`publicacion_id`) USING BTREE,
  CONSTRAINT `fk_visitas_publicaciones` FOREIGN KEY (`publicacion_id`) REFERENCES `tbl_publicaciones` (`id_publicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_visitas
-- ----------------------------
INSERT INTO `tbl_visitas` VALUES ('1', '1', '1', '2016-11-01');

-- ----------------------------
-- Procedure structure for pa_obtenerPartidos
-- ----------------------------
DROP PROCEDURE IF EXISTS `pa_obtenerPartidos`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `pa_obtenerPartidos`(IN `_deportista_id` int)
BEGIN
	SELECT 'jako';

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for fn_comentarios_sin_aprobar
-- ----------------------------
DROP FUNCTION IF EXISTS `fn_comentarios_sin_aprobar`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_comentarios_sin_aprobar`(`_id_publicacion` int) RETURNS double
BEGIN
	DECLARE TOTAL INT;
	SELECT COUNT(id_comentario) INTO TOTAL FROM tbl_comentarios WHERE estado = 2 AND publicacion_id = _id_publicacion;
	RETURN TOTAL;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for fn_get_amonestaciones
-- ----------------------------
DROP FUNCTION IF EXISTS `fn_get_amonestaciones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_amonestaciones`(`_id_deportista` int) RETURNS double
BEGIN
	DECLARE total INT;
	SELECT SUM(amonestaciones) INTO total FROM tbl_deportistas_equipos WHERE deportista_id = _id_deportista;
	RETURN total;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for fn_get_edad_deportistas
-- ----------------------------
DROP FUNCTION IF EXISTS `fn_get_edad_deportistas`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_edad_deportistas`(`_id_deportista` int) RETURNS double
BEGIN
	#Routine body goes here...
	DECLARE edad INT;
	SELECT
		(YEAR(NOW()) - YEAR(t.fecha_nacimiento)) - (RIGHT(CURRENT_DATE(), 5) < RIGHT(t.fecha_nacimiento, 5)) AS edad INTO edad
		FROM
			tbl_deportistas t
		WHERE t.id_deportista = _id_deportista;
		
	RETURN edad;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for fn_get_expulsiones
-- ----------------------------
DROP FUNCTION IF EXISTS `fn_get_expulsiones`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_expulsiones`(`_id_deportista` int) RETURNS double
BEGIN
	DECLARE total INT;
	SELECT SUM(expulsiones) INTO total FROM tbl_deportistas_equipos WHERE deportista_id = _id_deportista;
	RETURN total;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for fn_get_goles
-- ----------------------------
DROP FUNCTION IF EXISTS `fn_get_goles`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `fn_get_goles`(`_id_deportista` int) RETURNS double
BEGIN
	DECLARE total INT;
	SELECT SUM(anotaciones) INTO total FROM tbl_deportistas_equipos WHERE deportista_id = _id_deportista;
	RETURN total;
END
;;
DELIMITER ;
