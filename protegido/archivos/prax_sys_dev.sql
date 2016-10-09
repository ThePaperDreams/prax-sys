/*
Navicat MySQL Data Transfer

Source Server         : Local wamp
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : prax_sys_dev

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-09-26 00:17:44
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
  PRIMARY KEY (`id_acudiente`),
  KEY `fk_tbl_acudientes_tbl_tipos_identificacion1_idx` (`tipo_doc_id`),
  CONSTRAINT `fk_tbl_acudientes_tbl_tipos_identificacion1` FOREIGN KEY (`tipo_doc_id`) REFERENCES `tbl_tipos_identificacion` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_acudientes
-- ----------------------------
INSERT INTO `tbl_acudientes` VALUES ('1', 'Rolando', null, 'Jimenez', null, '1', '65465465', '45464444', null, null, null, '1');
INSERT INTO `tbl_acudientes` VALUES ('2', 'Alejandro', null, 'Quiroz', null, '1', '1152199397', '123123', null, 'alejo.jko@gmail.com', 'sur', null);
INSERT INTO `tbl_acudientes` VALUES ('3', 'Alvaro', null, 'Quiroz', null, '1', '12312313', '1231313', null, null, null, '1');

-- ----------------------------
-- Table structure for tbl_acudientes_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_acudientes_documentos`;
CREATE TABLE `tbl_acudientes_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acudiente_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_acudientes_documentos_tbl_documentos1_idx` (`documento_id`),
  KEY `fk_tbl_acudientes_documentos_tbl_acudientes1_idx` (`acudiente_id`),
  CONSTRAINT `fk_tbl_acudientes_documentos_tbl_acudientes1` FOREIGN KEY (`acudiente_id`) REFERENCES `tbl_acudientes` (`id_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_acudientes_documentos_tbl_documentos1` FOREIGN KEY (`documento_id`) REFERENCES `tbl_documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_acudientes_documentos
-- ----------------------------
INSERT INTO `tbl_acudientes_documentos` VALUES ('1', '2', '6');
INSERT INTO `tbl_acudientes_documentos` VALUES ('2', '2', '7');

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
  KEY `fk_tbl_asistencia_tbl_categorias1_idx` (`categoria_id`),
  CONSTRAINT `fk_tbl_asistencia_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_asistencia
-- ----------------------------
INSERT INTO `tbl_asistencia` VALUES ('1', '2016-07-19', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('2', '2016-07-19', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('3', '2016-07-10', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('4', '2016-07-29', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('5', '2016-07-22', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('6', '2016-08-03', null, '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('7', '2016-08-07', 'Algo', '1', '1');
INSERT INTO `tbl_asistencia` VALUES ('8', '2016-08-07', 'Algo', '1', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categorias
-- ----------------------------
INSERT INTO `tbl_categorias` VALUES ('1', 'prepony', 'Esta es una categoríaaa', '3', '3', '10000', '6', '10', '1', '1');
INSERT INTO `tbl_categorias` VALUES ('2', 'pre-pony', 'Esta es una categoría chidaaaaa', '20', '10', '15000', '5', '6', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_categorias_implementos
-- ----------------------------
INSERT INTO `tbl_categorias_implementos` VALUES ('1', 'Enseres', null, null);
INSERT INTO `tbl_categorias_implementos` VALUES ('2', 'Deportivos', null, '1');

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
  KEY `fk_comentarios_usuarios` (`usuario_id`),
  KEY `fk_comentarios_padres` (`padre_id`),
  KEY `fk_comentarios_publicacion` (`publicacion_id`),
  CONSTRAINT `fk_comentarios_padres` FOREIGN KEY (`padre_id`) REFERENCES `tbl_comentarios` (`id_comentario`),
  CONSTRAINT `fk_comentarios_publicacion` FOREIGN KEY (`publicacion_id`) REFERENCES `tbl_publicaciones` (`id_publicacion`),
  CONSTRAINT `fk_comentarios_usuarios` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comentarios
-- ----------------------------
INSERT INTO `tbl_comentarios` VALUES ('1', 'Sexy comentario', '16', null, '13', '1', '2016-09-25 23:35:26');
INSERT INTO `tbl_comentarios` VALUES ('2', 'Sexy respuesta', '16', '1', '1', '1', '2016-09-25 23:36:49');
INSERT INTO `tbl_comentarios` VALUES ('3', 'Sexy comentario', '16', null, '13', '1', '2016-09-25 23:35:26');
INSERT INTO `tbl_comentarios` VALUES ('4', 'Sexy respuesta', '16', '1', '1', '1', '2016-09-25 23:36:49');
INSERT INTO `tbl_comentarios` VALUES ('7', 'Eva la reina!!!', '15', null, '13', '2', '2016-09-26 00:08:20');

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
  KEY `fk_tbl_comprobantes_tbl_pagos1_idx` (`pago_id`),
  CONSTRAINT `fk_tbl_comprobantes_tbl_pagos1` FOREIGN KEY (`pago_id`) REFERENCES `tbl_pagos` (`id_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_comprobantes
-- ----------------------------

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
  `tipo_documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id_deportista`),
  KEY `fk_tbl_personas_tbl_tipos_documento_idx` (`tipo_documento_id`),
  KEY `fk_tbl_personas_tbl_estado_deportistas1_idx` (`estado_id`),
  CONSTRAINT `fk_tbl_personas_tbl_estado_deportistas1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estado_deportistas` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_personas_tbl_tipos_documento` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tbl_tipos_identificacion` (`id_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_deportistas
-- ----------------------------
INSERT INTO `tbl_deportistas` VALUES ('1', '123456789', 'devi', 'lou', 'per', null, 'occidente', null, '123456', null, '1992-08-01', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('2', '123742764', 'Bryan', null, 'Bedoya', null, 'Calle', 'Foto_1152199397.png', '62374673', null, '1995-03-24', '1', '3');
INSERT INTO `tbl_deportistas` VALUES ('3', '987987897', 'Cristian', null, 'Martinez', null, 'Calle', null, '62374673', null, '1994-03-04', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('4', '11111111', 'Musashi', null, 'Brave', null, 'Calle', null, '62374673', null, '1994-03-04', '8', '1');
INSERT INTO `tbl_deportistas` VALUES ('5', '22222222', 'Noa', null, 'Kaiba', null, 'Calle', null, '62374673', null, '1994-03-04', '4', '1');
INSERT INTO `tbl_deportistas` VALUES ('6', '33333333', 'Yugi', null, 'oh', null, 'Calle', null, '62374673', null, '1994-03-04', '4', '1');
INSERT INTO `tbl_deportistas` VALUES ('7', '1152199397', 'Alejo', null, 'Quiroz', 'Serna', 'Sur', null, '123123', null, '1992-07-19', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('8', '1152199397', 'Alejo', null, 'Quiroz', null, 'Sur', null, '123123', null, '1992-07-19', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('9', '1152199397', 'Alejo', null, 'Quiroz', null, 'Sur', null, '123123', null, '1992-07-19', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('10', '1152199397', 'Alejo', null, 'Quiroz', null, 'Sur', null, '123123', null, '1992-07-19', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('11', '1152199397', 'Alejo', null, 'Quiroz', null, 'Sur', null, '123123', null, '1992-07-19', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('12', '1152199397', 'Alejo', null, 'Quiroz', null, 'Por ahí', 'Foto_1152199397.png', '21321231', null, '1992-07-26', '1', '1');
INSERT INTO `tbl_deportistas` VALUES ('13', '12345678', 'Juan', null, 'Ramirez', null, 'sur', 'Foto_12345678.PNG', '123456', null, '1992-12-12', '1', '1');

-- ----------------------------
-- Table structure for tbl_deportistas_acudientes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_acudientes`;
CREATE TABLE `tbl_deportistas_acudientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acudiente_id` int(11) NOT NULL,
  `deportista_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_deportistas_acudientes_tbl_personas2_idx` (`deportista_id`),
  KEY `fk_tbl_deportistas_acudientes_tbl_acudientes1_idx` (`acudiente_id`),
  CONSTRAINT `fk_tbl_deportistas_acudientes_tbl_acudientes1` FOREIGN KEY (`acudiente_id`) REFERENCES `tbl_acudientes` (`id_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_deportistas_acudientes_tbl_personas2` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_deportistas_acudientes
-- ----------------------------
INSERT INTO `tbl_deportistas_acudientes` VALUES ('1', '1', '2');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('2', '1', '7');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('3', '1', '8');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('4', '1', '9');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('5', '1', '10');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('6', '1', '11');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('8', '1', '1');
INSERT INTO `tbl_deportistas_acudientes` VALUES ('10', '2', '1');

-- ----------------------------
-- Table structure for tbl_deportistas_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_documentos`;
CREATE TABLE `tbl_deportistas_documentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deportista_id` int(11) NOT NULL,
  `documento_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_personas_documentos_tbl_documentos1_idx` (`documento_id`),
  KEY `fk_tbl_personas_documentos_tbl_personas1_idx` (`deportista_id`),
  CONSTRAINT `fk_tbl_personas_documentos_tbl_documentos1` FOREIGN KEY (`documento_id`) REFERENCES `tbl_documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_personas_documentos_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_deportistas_documentos
-- ----------------------------
INSERT INTO `tbl_deportistas_documentos` VALUES ('1', '11', '5');

-- ----------------------------
-- Table structure for tbl_deportistas_equipos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_deportistas_equipos`;
CREATE TABLE `tbl_deportistas_equipos` (
  `id_de` int(11) NOT NULL AUTO_INCREMENT,
  `deportista_id` int(11) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id_de`),
  KEY `fk_tbl_deportistas_equipos_tbl_equipos1_idx` (`equipo_id`),
  KEY `fk_tbl_deportistas_equipos_tbl_personas1_idx` (`deportista_id`),
  CONSTRAINT `fk_tbl_deportistas_equipos_tbl_equipos1` FOREIGN KEY (`equipo_id`) REFERENCES `tbl_equipos` (`id_equipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_deportistas_equipos_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_deportistas_equipos
-- ----------------------------
INSERT INTO `tbl_deportistas_equipos` VALUES ('33', '2', '10');
INSERT INTO `tbl_deportistas_equipos` VALUES ('34', '10', '11');
INSERT INTO `tbl_deportistas_equipos` VALUES ('35', '4', '11');

-- ----------------------------
-- Table structure for tbl_documentos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_documentos`;
CREATE TABLE `tbl_documentos` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(50) NOT NULL,
  `titulo` varchar(30) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `papelera` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_documento`),
  KEY `fk_tbl_documentos_tbl_tipos_documento1_idx` (`tipo_id`),
  CONSTRAINT `fk_tbl_documentos_tbl_tipos_documento1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_documento` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_documentos
-- ----------------------------
INSERT INTO `tbl_documentos` VALUES ('1', 'publico/deportistas/7/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('2', 'publico/deportistas/8/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('3', 'publico/deportistas/9/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('4', 'publico/deportistas/10/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('5', 'publico/deportistas/11/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('6', 'publico/acudientes/2/Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('7', 'Recibos.png', 'Recibos', '2', '0');
INSERT INTO `tbl_documentos` VALUES ('8', 'Documentos personales.jpg', 'Documentos personales', '1', '0');
INSERT INTO `tbl_documentos` VALUES ('9', 'Documentos personales.PNG', 'Documentos personales', '1', '0');

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
  KEY `fk_tbl_entradas_tbl_usuarios1_idx` (`responsable_id`),
  CONSTRAINT `fk_tbl_entradas_tbl_usuarios1` FOREIGN KEY (`responsable_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_entradas
-- ----------------------------

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
  KEY `fk_tbl_salidas_implementos_tbl_implementos1_idx` (`implemento_id`),
  KEY `fk_tbl_salidas_implementos_tbl_entradas1_idx` (`entrada_id`),
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_entradas1` FOREIGN KEY (`entrada_id`) REFERENCES `tbl_entradas` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_implementos1` FOREIGN KEY (`implemento_id`) REFERENCES `tbl_implementos` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_entradas_implementos
-- ----------------------------

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
  KEY `fk_equipo_torneo` (`torneo_id`),
  CONSTRAINT `fk_equipo_torneo` FOREIGN KEY (`torneo_id`) REFERENCES `tbl_torneos` (`id_torneo`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_equipos
-- ----------------------------
INSERT INTO `tbl_equipos` VALUES ('1', '5', '5', '1', '1', '1', 'Medellín', null);
INSERT INTO `tbl_equipos` VALUES ('2', '5', '6', '1', '3', '2', 'El 8  hojos', null);
INSERT INTO `tbl_equipos` VALUES ('4', '12', '12', '1', null, '1', 'equipo1 (1)', '2');
INSERT INTO `tbl_equipos` VALUES ('5', '5', '5', '1', null, '1', 'Equipo (1)', '3');
INSERT INTO `tbl_equipos` VALUES ('6', '5', '5', '1', null, '1', 'Equipo', '3');
INSERT INTO `tbl_equipos` VALUES ('10', '5', '0', '1', null, '1', 'Equipo1 (1)', '1');
INSERT INTO `tbl_equipos` VALUES ('11', '5', '0', '1', null, '1', 'Equipo1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
  `titulo` varchar(200) DEFAULT NULL,
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
  KEY `fk_tbl_eventos_tbl_tipos_evento1_idx` (`tipo_id`),
  KEY `fk_tbl_eventos_tbl_estados_evento` (`estado`),
  CONSTRAINT `fk_tbl_eventos_tbl_estados_evento` FOREIGN KEY (`estado`) REFERENCES `tbl_estados_evento` (`id_estado`),
  CONSTRAINT `fk_tbl_eventos_tbl_tipos_evento1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_evento` (`id_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_eventos
-- ----------------------------
INSERT INTO `tbl_eventos` VALUES ('1', 'Evento1', 'Soy un evento', '2016-09-12 10:40:28', '2016-09-22 10:40:32', '1', 'Alguno', '09:00:00', '1', '2016-09-12', null);
INSERT INTO `tbl_eventos` VALUES ('2', 'Evento2', 'Soy un evento', '2016-09-12 10:40:28', '2016-09-22 10:40:32', '1', 'Alguno', '10:00:00', '1', '2016-09-12', null);
INSERT INTO `tbl_eventos` VALUES ('3', 'Evento3', 'Soy un evento', '2016-09-12 10:40:28', '2016-09-22 10:40:32', '1', 'Alguno', '10:00:00', '1', '2016-09-15', null);
INSERT INTO `tbl_eventos` VALUES ('4', 'Evento4', 'Soy un evento', '2016-09-12 10:40:28', '2016-09-22 10:40:32', '1', 'Alguno', '10:00:00', '1', '2016-09-21', null);
INSERT INTO `tbl_eventos` VALUES ('5', 'Evento4', 'Soy un evento', '2016-09-12 10:40:28', '2016-09-22 10:40:32', '1', 'Alguno', '10:00:00', '1', '2016-09-21', null);
INSERT INTO `tbl_eventos` VALUES ('12', 'Mi evento', '<p>Este es un evento muy chido</p>', '2016-09-20 14:41:56', '2016-09-30 00:00:00', '1', 'Av 45 # 45 - 45', '14:10:00', '1', '2016-09-21', '1');
INSERT INTO `tbl_eventos` VALUES ('13', 'El evento favorito del pueblo', '<p>Este es un evento&nbsp;</p>', '2016-09-20 15:27:32', '2016-09-30 00:00:00', '1', 'Cr 45 # 23 -12', '12:00:00', '1', '2016-09-21', '1');

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
  KEY `fk_tbl_faltas_x_matriculas_tbl_matriculas1_idx` (`matricula_id`),
  KEY `fk_tbl_faltas_x_matriculas_tbl_asistencia1_idx` (`asistencia_id`),
  CONSTRAINT `fk_tbl_faltas_x_matriculas_tbl_asistencia1` FOREIGN KEY (`asistencia_id`) REFERENCES `tbl_asistencia` (`id_asistencia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_faltas_x_matriculas_tbl_matriculas1` FOREIGN KEY (`matricula_id`) REFERENCES `tbl_matriculas` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_faltas_x_matriculas
-- ----------------------------
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('1', '14', '1', 'Tenia churria');
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('2', '14', '2', 'Tenía churria sonica !!!\n');
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('3', '13', '3', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('4', '14', '3', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('5', '16', '3', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('6', '16', '4', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('7', '13', '5', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('8', '14', '5', 'Estaba enfermo');
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('9', '14', '6', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('10', '14', '7', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('11', '16', '7', null);
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('12', '18', '8', 'Estaba enfermo');
INSERT INTO `tbl_faltas_x_matriculas` VALUES ('13', '19', '8', null);

-- ----------------------------
-- Table structure for tbl_fichas_posiciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fichas_posiciones`;
CREATE TABLE `tbl_fichas_posiciones` (
  `id_fp` int(11) NOT NULL AUTO_INCREMENT,
  `ficha_id` int(11) NOT NULL,
  `posicion_id` int(11) NOT NULL,
  PRIMARY KEY (`id_fp`),
  KEY `fk_tbl_fichas_posiciones_tbl_fichas_tecnicas1_idx` (`ficha_id`),
  KEY `fk_tbl_fichas_posiciones_tbl_posiciones1_idx` (`posicion_id`),
  CONSTRAINT `fk_tbl_fichas_posiciones_tbl_fichas_tecnicas1` FOREIGN KEY (`ficha_id`) REFERENCES `tbl_fichas_tecnicas` (`id_ficha_tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_fichas_posiciones_tbl_posiciones1` FOREIGN KEY (`posicion_id`) REFERENCES `tbl_posiciones` (`id_posicion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_fichas_posiciones
-- ----------------------------
INSERT INTO `tbl_fichas_posiciones` VALUES ('1', '1', '1');
INSERT INTO `tbl_fichas_posiciones` VALUES ('2', '1', '2');

-- ----------------------------
-- Table structure for tbl_fichas_tecnicas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fichas_tecnicas`;
CREATE TABLE `tbl_fichas_tecnicas` (
  `id_ficha_tecnica` int(11) NOT NULL AUTO_INCREMENT,
  `amonestacion` int(11) DEFAULT '0',
  `dorsal` int(11) DEFAULT NULL,
  `expulsion` int(11) DEFAULT NULL COMMENT '0',
  `fecha_actualizacion` date DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `pierna_habil` tinyint(1) DEFAULT NULL,
  `entrenador_id` int(11) NOT NULL,
  `talla` float DEFAULT NULL,
  `valoracion` float DEFAULT NULL COMMENT '0',
  `rh` varchar(6) DEFAULT NULL,
  `deportista_id` int(11) NOT NULL,
  `lesiones` text,
  PRIMARY KEY (`id_ficha_tecnica`),
  KEY `fk_tbl_fichas_tecnicas_tbl_personas1_idx` (`deportista_id`),
  CONSTRAINT `fk_tbl_fichas_tecnicas_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_fichas_tecnicas
-- ----------------------------
INSERT INTO `tbl_fichas_tecnicas` VALUES ('1', '0', '17', '0', null, '64', '0', '0', '12', '77777800000', 'A+', '1', 'Se aporreó, estreñido');
INSERT INTO `tbl_fichas_tecnicas` VALUES ('2', '0', '10', null, null, null, '1', '1', null, '10', 'A+', '2', 'Una');
INSERT INTO `tbl_fichas_tecnicas` VALUES ('3', '0', '20', null, null, null, '0', '1', null, null, 'O-', '3', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_galerias
-- ----------------------------
INSERT INTO `tbl_galerias` VALUES ('3', 'g', '12');
INSERT INTO `tbl_galerias` VALUES ('4', 'g', '12');
INSERT INTO `tbl_galerias` VALUES ('5', 'Galeria', '13');

-- ----------------------------
-- Table structure for tbl_imagenes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_imagenes`;
CREATE TABLE `tbl_imagenes` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`id_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_imagenes
-- ----------------------------
INSERT INTO `tbl_imagenes` VALUES ('52', null, '11863409_1010871408977567_1416304767942653844_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('53', null, '11846741_1013558955375479_7245894287860886372_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('54', null, '11866437_1112335482168083_2595705107349108760_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('55', null, '11873524_1013649368699771_5397195395460541103_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('56', null, '11873472_1015268645204510_4045432949383032702_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('57', null, '11870862_1112992228769075_3003191989677629103_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('58', null, '11873798_1112764945458470_3598730677379681201_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('59', null, '11888087_1019031258161582_3558216739616058145_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('60', null, '26a4b2c308964a904a69c76b4446c86c.jpg');
INSERT INTO `tbl_imagenes` VALUES ('61', null, '639ed62b067e028747052cc17cbbf69b.jpg');
INSERT INTO `tbl_imagenes` VALUES ('62', null, '1947838_646377598833341_3118370995584117528_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('63', null, '12122730_648371118633989_7105395743743005459_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('64', null, '3538_644248642379570_3653412228495972524_n.jpg');
INSERT INTO `tbl_imagenes` VALUES ('65', null, '14432951_1726658147599912_3238717654601223037_n.jpg');

-- ----------------------------
-- Table structure for tbl_imagenes_galerias
-- ----------------------------
DROP TABLE IF EXISTS `tbl_imagenes_galerias`;
CREATE TABLE `tbl_imagenes_galerias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_id` int(11) NOT NULL,
  `galeria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_imagenes_galerias_tbl_imagenes1_idx` (`imagen_id`),
  KEY `fk_tbl_imagenes_galerias_tbl_galerias1_idx` (`galeria_id`),
  CONSTRAINT `fk_tbl_imagenes_galerias_tbl_galerias1` FOREIGN KEY (`galeria_id`) REFERENCES `tbl_galerias` (`id_galeria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_imagenes_galerias_tbl_imagenes1` FOREIGN KEY (`imagen_id`) REFERENCES `tbl_imagenes` (`id_imagen`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_imagenes_galerias
-- ----------------------------
INSERT INTO `tbl_imagenes_galerias` VALUES ('16', '61', '3');
INSERT INTO `tbl_imagenes_galerias` VALUES ('17', '60', '3');
INSERT INTO `tbl_imagenes_galerias` VALUES ('18', '59', '3');
INSERT INTO `tbl_imagenes_galerias` VALUES ('19', '58', '3');
INSERT INTO `tbl_imagenes_galerias` VALUES ('20', '57', '3');
INSERT INTO `tbl_imagenes_galerias` VALUES ('21', '61', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('22', '60', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('23', '59', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('24', '58', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('25', '57', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('26', '56', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('27', '55', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('28', '54', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('29', '53', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('30', '52', '4');
INSERT INTO `tbl_imagenes_galerias` VALUES ('31', '64', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('32', '63', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('33', '62', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('34', '61', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('35', '60', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('36', '59', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('37', '58', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('38', '57', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('39', '56', '5');
INSERT INTO `tbl_imagenes_galerias` VALUES ('40', '55', '5');

-- ----------------------------
-- Table structure for tbl_implementos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_implementos`;
CREATE TABLE `tbl_implementos` (
  `id_implemento` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `minimo_unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `maximo_unidades` int(10) unsigned NOT NULL DEFAULT '0',
  `estado_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id_implemento`),
  KEY `fk_tbl_implementos_tbl_categorias_implementos1_idx` (`categoria_id`),
  KEY `fk_tbl_implementos_tbl_estados_implementos1_idx` (`estado_id`),
  CONSTRAINT `fk_tbl_implementos_tbl_categorias_implementos1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias_implementos` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_implementos_tbl_estados_implementos1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estados_implementos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_implementos
-- ----------------------------
INSERT INTO `tbl_implementos` VALUES ('2', '2', 'Balón', null, '3', '2', '10', '1');
INSERT INTO `tbl_implementos` VALUES ('3', '1', 'Sillas', null, '25', '2', '20', '1');
INSERT INTO `tbl_implementos` VALUES ('4', '2', 'Toallas', 'Toallin gusta.', '25', '5', '10', '1');
INSERT INTO `tbl_implementos` VALUES ('7', '1', 'Mesa', null, '8', '1', '5', '1');
INSERT INTO `tbl_implementos` VALUES ('8', '1', 'nuevo', null, '10', '0', '12', '1');
INSERT INTO `tbl_implementos` VALUES ('9', '2', 'Sillas1', null, '10', '4', '10', '1');

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
  PRIMARY KEY (`id_matricula`),
  KEY `fk_tbl_matriculas_tbl_personas1_idx` (`deportista_id`),
  KEY `fk_tbl_matriculas_tbl_categorias1_idx` (`categoria_id`),
  CONSTRAINT `fk_tbl_matriculas_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_matriculas_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_matriculas
-- ----------------------------
INSERT INTO `tbl_matriculas` VALUES ('13', '2016-06-29', 'Matricula-2016-123456789.jpg', '0', '1', '1', '2016', '2016-06-29 13:50:13');
INSERT INTO `tbl_matriculas` VALUES ('14', '2016-06-29', 'Matricula-2016-123742764.jpg', '1', '2', '1', '2016', '2016-06-29 13:50:43');
INSERT INTO `tbl_matriculas` VALUES ('15', '2016-06-29', 'Matricula-2016-987987897.jpg', '0', '3', '1', '2016', '2016-06-29 13:50:58');
INSERT INTO `tbl_matriculas` VALUES ('16', '2016-07-19', 'Matricula-2016-987987897.jpg', '1', '3', '1', '2016', '2016-07-19 07:56:58');
INSERT INTO `tbl_matriculas` VALUES ('17', '2016-07-29', 'Matricula-2016-11111111.sql', '0', '4', '1', '2016', '2016-07-29 20:40:27');
INSERT INTO `tbl_matriculas` VALUES ('18', '2016-07-30', null, '1', '10', '2', '2016', '2016-07-30 13:41:58');
INSERT INTO `tbl_matriculas` VALUES ('19', '2016-07-31', null, '1', '4', '2', '2016', '2016-07-31 17:50:18');
INSERT INTO `tbl_matriculas` VALUES ('20', '2016-08-08', 'Matricula-2016-123456789.PNG', '1', '1', '1', '2016', '2016-08-09 07:34:25');

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
INSERT INTO `tbl_modulos` VALUES ('2', 'Control de Existencias', null);
INSERT INTO `tbl_modulos` VALUES ('3', 'Deportistas', null);
INSERT INTO `tbl_modulos` VALUES ('4', 'Usuarios', null);

-- ----------------------------
-- Table structure for tbl_objetivos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_objetivos`;
CREATE TABLE `tbl_objetivos` (
  `id_objetivo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_objetivo`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_objetivos
-- ----------------------------
INSERT INTO `tbl_objetivos` VALUES ('1', 'Correr', 'Wolas');
INSERT INTO `tbl_objetivos` VALUES ('2', 'Driblar', null);
INSERT INTO `tbl_objetivos` VALUES ('3', 'Saltar', 'Se salta');
INSERT INTO `tbl_objetivos` VALUES ('6', 'Nuevo objetivo', null);
INSERT INTO `tbl_objetivos` VALUES ('7', 'nuevo objetivo 3', 'Este es un sexy objetivo');
INSERT INTO `tbl_objetivos` VALUES ('8', 'trotar', 'El trote');
INSERT INTO `tbl_objetivos` VALUES ('9', 'Jugar', null);
INSERT INTO `tbl_objetivos` VALUES ('10', 'Esperar', null);
INSERT INTO `tbl_objetivos` VALUES ('11', 'Obj', 'Esta es una descripción');
INSERT INTO `tbl_objetivos` VALUES ('14', 'Nuevo obj', null);
INSERT INTO `tbl_objetivos` VALUES ('15', 'Nuevo obj2', null);
INSERT INTO `tbl_objetivos` VALUES ('16', 'Okas', null);
INSERT INTO `tbl_objetivos` VALUES ('17', 'El obj', null);
INSERT INTO `tbl_objetivos` VALUES ('18', 'El okas', null);
INSERT INTO `tbl_objetivos` VALUES ('19', 'Bryan', 'asdfasdfa');
INSERT INTO `tbl_objetivos` VALUES ('20', 'Mi okas', null);
INSERT INTO `tbl_objetivos` VALUES ('21', 'Titulo', 'asdfasdf');
INSERT INTO `tbl_objetivos` VALUES ('22', 'Un objetivo más', null);

-- ----------------------------
-- Table structure for tbl_objetivos_planes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_objetivos_planes`;
CREATE TABLE `tbl_objetivos_planes` (
  `id_op` int(11) NOT NULL AUTO_INCREMENT,
  `objetivo_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  PRIMARY KEY (`id_op`),
  KEY `fk_tbl_objetivos_planes_tbl_objetivos1_idx` (`objetivo_id`),
  KEY `fk_tbl_objetivos_planes_tbl_planes_trabajo1_idx` (`plan_id`),
  CONSTRAINT `fk_tbl_objetivos_planes_tbl_objetivos1` FOREIGN KEY (`objetivo_id`) REFERENCES `tbl_objetivos` (`id_objetivo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_objetivos_planes_tbl_planes_trabajo1` FOREIGN KEY (`plan_id`) REFERENCES `tbl_planes_trabajo` (`id_plan_trabajo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_objetivos_planes
-- ----------------------------
INSERT INTO `tbl_objetivos_planes` VALUES ('1', '1', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('2', '2', '1');
INSERT INTO `tbl_objetivos_planes` VALUES ('4', '6', '2');
INSERT INTO `tbl_objetivos_planes` VALUES ('5', '1', '2');
INSERT INTO `tbl_objetivos_planes` VALUES ('6', '1', '3');
INSERT INTO `tbl_objetivos_planes` VALUES ('7', '1', '4');
INSERT INTO `tbl_objetivos_planes` VALUES ('8', '2', '4');
INSERT INTO `tbl_objetivos_planes` VALUES ('9', '3', '5');
INSERT INTO `tbl_objetivos_planes` VALUES ('10', '6', '5');
INSERT INTO `tbl_objetivos_planes` VALUES ('11', '1', '15');
INSERT INTO `tbl_objetivos_planes` VALUES ('12', '3', '15');
INSERT INTO `tbl_objetivos_planes` VALUES ('13', '7', '15');
INSERT INTO `tbl_objetivos_planes` VALUES ('14', '1', '16');
INSERT INTO `tbl_objetivos_planes` VALUES ('15', '1', '17');
INSERT INTO `tbl_objetivos_planes` VALUES ('18', '3', '17');
INSERT INTO `tbl_objetivos_planes` VALUES ('20', '6', '17');
INSERT INTO `tbl_objetivos_planes` VALUES ('21', '2', '17');
INSERT INTO `tbl_objetivos_planes` VALUES ('22', '21', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('23', '1', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('24', '2', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('25', '3', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('26', '6', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('27', '7', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('28', '11', '18');
INSERT INTO `tbl_objetivos_planes` VALUES ('29', '15', '18');

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
  KEY `fk_tbl_opmenu_tbl_rutas1_idx` (`ruta_id`),
  KEY `fk_tbl_opmenu_padre_id_idx` (`padre_id`),
  CONSTRAINT `fk_tbl_opmenu_padre_id` FOREIGN KEY (`padre_id`) REFERENCES `tbl_opmenu` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_opmenu_tbl_rutas1` FOREIGN KEY (`ruta_id`) REFERENCES `tbl_rutas` (`id_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  KEY `fk_tbl_pagos_tbl_matriculas1_idx` (`matricula_id`),
  CONSTRAINT `fk_tbl_pagos_tbl_matriculas1` FOREIGN KEY (`matricula_id`) REFERENCES `tbl_matriculas` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_pagos
-- ----------------------------
INSERT INTO `tbl_pagos` VALUES ('1', '2016-06-01', '10000', 'comprobante-123456789-2016-06-01.jpg', '1', '0', null, '13');
INSERT INTO `tbl_pagos` VALUES ('2', '2016-06-01', '10000', 'comprobante-123742764-2016-06-01.jpg', '0', null, null, '14');
INSERT INTO `tbl_pagos` VALUES ('3', '2016-07-01', '10000', 'comprobante-987987897-2016-07-01.PNG', '0', null, null, '16');

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
  KEY `fk_tbl_planes_trabajo_tbl_categorias1_idx` (`categoria_id`),
  CONSTRAINT `fk_tbl_planes_trabajo_tbl_categorias1` FOREIGN KEY (`categoria_id`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_planes_trabajo
-- ----------------------------
INSERT INTO `tbl_planes_trabajo` VALUES ('1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo', '2016-06-17', '0', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('2', 'Esta es una prueba', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('3', 'asdfasdfasf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('4', 'asdfafa', '2016-07-31', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('5', 'asdfasdfsadfasfasdf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('6', 'asdfasdfsadfasfasdf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('7', 'Esta es una prueba', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('8', 'asdfasdfsadfasfasdf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('9', 'asdfasdfsadfasfasdf', '2016-07-30', '0', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('10', 'Esta es una prueba', '2016-07-30', '0', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('11', 'Esta es una prueba', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('12', 'asdfasdfsadfasfasdf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('13', 'asdfasdfsadfasfasdf', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('14', 'Esta es una prueba', '2016-07-30', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('15', 'Descripción', '2016-07-31', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('16', 'asdfasdf', '2016-08-27', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('17', 'Esta es una descripción. ', '2016-09-02', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('18', 'Esta es tytytyyy', '2016-09-03', '1', '1');
INSERT INTO `tbl_planes_trabajo` VALUES ('19', 'alkfjlfjasñkjfasdj', '2016-09-03', '1', '1');

-- ----------------------------
-- Table structure for tbl_posiciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_posiciones`;
CREATE TABLE `tbl_posiciones` (
  `id_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `posicion` varchar(25) NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_posicion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_posiciones
-- ----------------------------
INSERT INTO `tbl_posiciones` VALUES ('1', 'Arquero', 'PT');
INSERT INTO `tbl_posiciones` VALUES ('2', 'Defensa central', 'DFC');
INSERT INTO `tbl_posiciones` VALUES ('3', 'Defensa lateral', 'DFL');
INSERT INTO `tbl_posiciones` VALUES ('4', 'Medio campista central', 'MCC');
INSERT INTO `tbl_posiciones` VALUES ('5', 'Medio campista externo', 'MCE');
INSERT INTO `tbl_posiciones` VALUES ('6', 'Delantero centro', 'DC');
INSERT INTO `tbl_posiciones` VALUES ('7', 'Delantero externo', 'DE');

-- ----------------------------
-- Table structure for tbl_prestamos_deportista
-- ----------------------------
DROP TABLE IF EXISTS `tbl_prestamos_deportista`;
CREATE TABLE `tbl_prestamos_deportista` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `club_origen` varchar(100) NOT NULL,
  `club_destino` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `deportista_id` int(11) NOT NULL,
  `tipo_prestamo` enum('salida','entrada') NOT NULL,
  PRIMARY KEY (`id_prestamo`),
  KEY `fk_tbl_prestamos_deportista_tbl_personas1_idx` (`deportista_id`),
  CONSTRAINT `fk_tbl_prestamos_deportista_tbl_personas1` FOREIGN KEY (`deportista_id`) REFERENCES `tbl_deportistas` (`id_deportista`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_prestamos_deportista
-- ----------------------------
INSERT INTO `tbl_prestamos_deportista` VALUES ('1', 'Praxis', 'Otrosss', '2016-08-07', '2016-08-31', '1', '4', 'salida');

-- ----------------------------
-- Table structure for tbl_publicaciones
-- ----------------------------
DROP TABLE IF EXISTS `tbl_publicaciones`;
CREATE TABLE `tbl_publicaciones` (
  `id_publicacion` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
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
  PRIMARY KEY (`id_publicacion`),
  KEY `fk_tbl_publicaciones_tbl_usuarios1_idx` (`usuario_id`),
  KEY `fk_tbl_publicaciones_tbl_tipos_publicacion1_idx` (`tipo_id`),
  KEY `fk_tbl_publicaciones_tbl_estados_publicacion1_idx` (`estado_id`),
  CONSTRAINT `fk_tbl_publicaciones_tbl_estados_publicacion1` FOREIGN KEY (`estado_id`) REFERENCES `tbl_estados_publicacion` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_publicaciones_tbl_tipos_publicacion1` FOREIGN KEY (`tipo_id`) REFERENCES `tbl_tipos_publicacion` (`id_tipo_publicacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_publicaciones_tbl_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_publicaciones
-- ----------------------------
INSERT INTO `tbl_publicaciones` VALUES ('1', 'Nueva publicación', '<p><sup><strong><del>Esta es una publicación...&nbsp;</del></strong></sup></p><p><del><sub>Wola</sub></del></p><p><del><sub><br></sub></del></p><p></p><ul><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del>olkas</del></span></li><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del>okas</del></span></li><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del><em>okas</em></del></span></li></ul><p></p>', null, '2016-08-08 00:00:00', '2016-07-28 00:00:00', '1', null, null, '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('2', 'Una publicación', 'Esta es una publicación', '1', '2016-08-08 00:00:00', '2016-07-29 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('3', 'Titulo', '<p>Soy un contenido sexy</p>', null, '2016-08-08 00:00:00', '0000-00-00 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('4', 'Estoy muy bueno', '<p>Esta publicación dice que estoy muy bueno ;) </p>', '1', '2016-08-08 00:00:00', '0000-00-00 00:00:00', '2', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('5', 'Nueva pub...', '<p>Boobies </p>', '1', '2016-08-08 00:00:00', '0000-00-00 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('6', 'Nueva publicación', '<p><sup><strong><del>Esta es una publicación...&nbsp;</del></strong></sup></p><p><del><sub>Wola</sub></del></p><p><del><sub><br></sub></del></p><p></p><ul><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del>olkas</del></span></li><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del>okas</del></span></li><li><span style=\"font-size: 10.5px; line-height: 0px;\"><del><em>okas</em></del></span></li></ul><p></p>', null, '2016-08-08 00:00:00', '2016-07-28 00:00:00', '1', '', '00:00:00', '2', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', '');
INSERT INTO `tbl_publicaciones` VALUES ('7', 'Una publicación', 'Esta es una publicación', '1', '2016-08-08 00:00:00', '2016-07-29 00:00:00', '1', '', '00:00:00', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', '');
INSERT INTO `tbl_publicaciones` VALUES ('8', 'Titulo', '<p>Soy un contenido sexy</p>', null, '2016-08-08 00:00:00', '0000-00-00 00:00:00', '1', '', '00:00:00', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', '');
INSERT INTO `tbl_publicaciones` VALUES ('9', 'Estoy muy bueno', '<p>Esta publicación dice que estoy muy bueno ;) </p>', '1', '2016-08-08 00:00:00', '0000-00-00 00:00:00', '2', '', '00:00:00', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', '');
INSERT INTO `tbl_publicaciones` VALUES ('10', 'Nueva pub...', '<p>Boobies </p>', '1', '2016-08-08 00:00:00', '0000-00-00 00:00:00', '1', '', '00:00:00', '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', '');
INSERT INTO `tbl_publicaciones` VALUES ('11', 'Publicación', '<p>lorem&nbsp;</p>\r\n<p>Wola&nbsp;</p>\r\n<p>Esto&nbsp;</p>\r\n<p>Es una</p>\r\n<p>publiaci&oacute;n&nbsp;</p>\r\n<p>muy</p>\r\n<p>Chida</p>\r\n<p>&nbsp;</p>', null, '2016-09-14 00:00:00', '2016-09-30 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('13', 'Piernotas', '<p><img src=\"http://localhost/proyecto-formacion/prax-sys/publico/imagenes/galerias/13620981_669070126589333_2451808129287193673_n.jpg\" alt=\"\" width=\"937\" height=\"467\" /></p>', null, '2016-09-17 14:53:00', '2016-09-30 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('14', 'El aseo es important', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br />tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br />quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo<br />consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse<br />cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non<br />proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '2', '2016-09-17 16:26:06', '2016-09-30 00:00:00', '2', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_publicaciones` VALUES ('15', 'Eva Andressa', '<p>&nbsp;</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;</p>\r\n<p><img src=\"http://localhost/proyecto-formacion/prax-sys/publico/imagenes/galerias/11870862_1112992228769075_3003191989677629103_n.jpg\" alt=\"\" width=\"639\" height=\"960\" /></p>', null, '2016-09-23 22:36:40', '2016-09-30 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', 'http://localhost/proyecto-formacion/prax-sys/publico/imagenes/galerias/3538_644248642379570_3653412228495972524_n.jpg');
INSERT INTO `tbl_publicaciones` VALUES ('16', 'Piernotas everywhere', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&nbsp;</p>\r\n<p><img src=\"http://localhost/proyecto-formacion/prax-sys/publico/imagenes/galerias/14432951_1726658147599912_3238717654601223037_n.jpg\" alt=\"\" width=\"960\" height=\"960\" /></p>', null, '2016-09-25 16:10:53', '2016-09-30 00:00:00', '1', null, null, '1', '1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', 'http://localhost/proyecto-formacion/prax-sys/publico/imagenes/galerias/14432951_1726658147599912_3238717654601223037_n.jpg');

-- ----------------------------
-- Table structure for tbl_reseteopass
-- ----------------------------
DROP TABLE IF EXISTS `tbl_reseteopass`;
CREATE TABLE `tbl_reseteopass` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusuario` int(10) unsigned NOT NULL,
  `username` varchar(15) NOT NULL,
  `token` varchar(64) NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idusuario` (`idusuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_reseteopass
-- ----------------------------
INSERT INTO `tbl_reseteopass` VALUES ('1', '1', 'developer', '8218494fe7aeadc5a303827663c4d0e33cb98a25', '2016-09-21 08:57:46');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_roles
-- ----------------------------
INSERT INTO `tbl_roles` VALUES ('1', 'Desarrollador', null, '1', '1', '0');
INSERT INTO `tbl_roles` VALUES ('2', 'Administrador', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('3', 'Secretaria', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('4', 'Entrenador', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('5', 'Asistente', null, '0', '1', '0');
INSERT INTO `tbl_roles` VALUES ('6', 'suscrito', null, '0', '1', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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
  KEY `fk_tbl_rutas_x_rol_tbl_controladores_rutas1_idx` (`ruta_id`),
  KEY `fk_tbl_rutas_x_rol_tbl_roles1_idx` (`rol_id`),
  CONSTRAINT `fk_tbl_rutas_x_rol_tbl_controladores_rutas1` FOREIGN KEY (`ruta_id`) REFERENCES `tbl_rutas` (`id_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_rutas_x_rol_tbl_roles1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_rutas_x_rol
-- ----------------------------
INSERT INTO `tbl_rutas_x_rol` VALUES ('1', '1', '5', '1');
INSERT INTO `tbl_rutas_x_rol` VALUES ('2', '1', '6', '1');
INSERT INTO `tbl_rutas_x_rol` VALUES ('3', '1', '3', '0');
INSERT INTO `tbl_rutas_x_rol` VALUES ('4', '1', '4', '1');

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
  KEY `fk_tbl_salidas_tbl_usuarios1_idx` (`responsable_id`),
  CONSTRAINT `fk_tbl_salidas_tbl_usuarios1` FOREIGN KEY (`responsable_id`) REFERENCES `tbl_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_salidas
-- ----------------------------

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
  KEY `fk_tbl_salidas_implementos_tbl_salidas1_idx` (`salida_id`),
  KEY `fk_tbl_salidas_implementos_tbl_implementos2_idx` (`implemento_id`),
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_implementos2` FOREIGN KEY (`implemento_id`) REFERENCES `tbl_implementos` (`id_implemento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salidas_implementos_tbl_salidas1` FOREIGN KEY (`salida_id`) REFERENCES `tbl_salidas` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_salidas_implementos
-- ----------------------------

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
  KEY `fk_tbl_seguimientos_tbl_fichas_tecnicas1_idx` (`ficha_tecnica_id`),
  CONSTRAINT `fk_tbl_seguimientos_tbl_fichas_tecnicas1` FOREIGN KEY (`ficha_tecnica_id`) REFERENCES `tbl_fichas_tecnicas` (`id_ficha_tecnica`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_seguimientos
-- ----------------------------
INSERT INTO `tbl_seguimientos` VALUES ('1', '0', '1', '10', '2016-08-18', 'asdfasdfaf', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('2', '0', '1', '5', '2016-08-18', 'Buenas', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('3', '0', '1', '5', '2016-08-18', 'Buenas', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('4', '0', '1', '6', '2016-08-18', 'okas', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('5', '1', '1', '6', '2016-08-18', 'okas', '1', '1');
INSERT INTO `tbl_seguimientos` VALUES ('6', '1', '1', '6', '2016-08-18', 'okas', '1', '1');

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
  KEY `fk_padre_id_tipos_documentos_idx` (`padre_id`),
  CONSTRAINT `fk_padre_id_tipos_documentos` FOREIGN KEY (`padre_id`) REFERENCES `tbl_tipos_documento` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tbl_tipos_evento
-- ----------------------------
INSERT INTO `tbl_tipos_evento` VALUES ('1', 'Bazar', null);

-- ----------------------------
-- Table structure for tbl_tipos_identificacion
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_identificacion`;
CREATE TABLE `tbl_tipos_identificacion` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `abreviatura` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tipos_identificacion
-- ----------------------------
INSERT INTO `tbl_tipos_identificacion` VALUES ('1', 'Cédula', 'CC');
INSERT INTO `tbl_tipos_identificacion` VALUES ('2', 'Registro civil', 'RC');
INSERT INTO `tbl_tipos_identificacion` VALUES ('3', 'Tarjeta de identidad', 'TI');

-- ----------------------------
-- Table structure for tbl_tipos_persona
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_persona`;
CREATE TABLE `tbl_tipos_persona` (
  `id_tipo_persona` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id_tipo_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tipos_persona
-- ----------------------------
INSERT INTO `tbl_tipos_persona` VALUES ('1', 'Usuario');
INSERT INTO `tbl_tipos_persona` VALUES ('2', 'Deportista');
INSERT INTO `tbl_tipos_persona` VALUES ('3', 'Acudiente');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_tipos_publicacion
-- ----------------------------
INSERT INTO `tbl_tipos_publicacion` VALUES ('1', 'Noticia', null, null);
INSERT INTO `tbl_tipos_publicacion` VALUES ('2', 'Circular', null, null);

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
  `tabla_posiciones` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `imagen` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_torneo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_torneos
-- ----------------------------
INSERT INTO `tbl_torneos` VALUES ('1', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', null, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_torneos` VALUES ('2', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_torneos` VALUES ('3', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_torneos` VALUES ('4', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_torneos` VALUES ('5', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);
INSERT INTO `tbl_torneos` VALUES ('6', '3', '2', '15', '0', '2016-08-10', '2016-08-11', 'Torneo de Juanda', 'Lorem', '', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna', null);

-- ----------------------------
-- Table structure for tbl_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `nombre_usuario` varchar(30) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `clave` varchar(180) NOT NULL,
  `recuperacion` tinyint(1) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `foto` varchar(200) DEFAULT NULL,
  `url_recuperacion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_tbl_usuarios_tbl_roles1_idx` (`rol_id`),
  CONSTRAINT `fk_tbl_usuarios_tbl_roles1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_usuarios
-- ----------------------------
INSERT INTO `tbl_usuarios` VALUES ('1', '1', 'alejoqs@misena.edu.co', 'developer', 'Alejo', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'developer.png', null);
INSERT INTO `tbl_usuarios` VALUES ('2', '1', 'alejo.jko@gmail.com', 'desarrollador', 'Alejo', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'desarrollador', null);
INSERT INTO `tbl_usuarios` VALUES ('13', '6', 'demo@localhost.com', 'el_jako', 'Alejandro', 'Quiroz', null, '7c4a8d09ca3762af61e59520943dc26494f8941b', null, '1', 'el_jako.jpg', null);
