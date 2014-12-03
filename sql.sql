/*
Navicat MySQL Data Transfer

Source Server         : Mysql
Source Server Version : 50610
Source Host           : localhost:3306
Source Database       : piweb

Target Server Type    : MYSQL
Target Server Version : 50610
File Encoding         : 65001

Date: 2014-12-01 23:59:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `arquivos`
-- ----------------------------
DROP TABLE IF EXISTS `arquivos`;
CREATE TABLE `arquivos` (
`id_arquivo`  int(11) NOT NULL AUTO_INCREMENT ,
`nome`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id_arquivo`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of arquivos
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `cidades`
-- ----------------------------
DROP TABLE IF EXISTS `cidades`;
CREATE TABLE `cidades` (
`id_cidade`  int(5) NOT NULL AUTO_INCREMENT ,
`id_uf`  int(11) NOT NULL ,
`cidade`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_cidade`),
FOREIGN KEY (`id_uf`) REFERENCES `uf` (`id_uf`) ON DELETE NO ACTION ON UPDATE NO ACTION
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=185

;

-- ----------------------------
-- Records of cidades
-- ----------------------------
BEGIN;
INSERT INTO `cidades` VALUES ('105', '7', 'Rio Branco'), ('106', '8', 'Maceió'), ('107', '9', 'Macapá'), ('108', '10', 'Manaus'), ('109', '11', 'Salvador'), ('110', '12', 'Fortaleza'), ('111', '13', 'Brasília'), ('112', '14', 'Vitória'), ('113', '15', 'Goiânia'), ('114', '16', 'São Luís'), ('115', '17', 'Cuiabá'), ('116', '18', 'Campo Grande'), ('117', '19', 'Belo Horizonte'), ('118', '20', 'Curitiba'), ('119', '21', 'João Pessoa'), ('120', '22', 'Belém'), ('121', '23', 'Recife'), ('122', '24', 'Teresina'), ('123', '25', 'Rio de Janeiro'), ('124', '26', 'Natal'), ('125', '27', 'Porto Alegre'), ('126', '28', 'Porto Velho'), ('127', '29', 'Boa Vista'), ('128', '30', 'Florianópolis'), ('129', '31', 'Aracaju'), ('130', '32', 'Palmas'), ('131', '30', 'Água Doce'), ('132', '30', 'Blumenau'), ('133', '30', 'Brusque'), ('134', '30', 'Balneário Camboriú'), ('135', '30', 'Tubarão'), ('136', '30', 'Lages'), ('137', '30', 'Itajaí'), ('138', '30', 'Chapecó'), ('139', '30', 'Criciúma'), ('140', '30', 'Joinville'), ('141', '30', 'Rio do Sul'), ('142', '30', 'Araranguá'), ('143', '30', 'Canoinhas'), ('144', '30', 'Laguna'), ('145', '30', 'Lauro Müller'), ('146', '30', 'Guaraciaba '), ('147', '30', 'Mondaí'), ('148', '30', 'Agrolândia'), ('149', '30', 'Nova Itaberaba'), ('150', '30', 'Arabutã'), ('151', '30', 'Witmarsum'), ('152', '30', 'Vargeão'), ('153', '30', 'Santiago do Sul'), ('154', '27', 'Caxias do Sul'), ('155', '27', 'Pelotas'), ('156', '27', 'Santa Maria'), ('157', '27', 'Canoas'), ('158', '27', 'Gravataí'), ('159', '27', 'Viamão'), ('160', '27', 'Novo Hamburgo'), ('161', '27', 'São Leopoldo'), ('162', '27', 'Rio Grande'), ('163', '27', 'Alvorada'), ('164', '27', 'Passo Fundo'), ('165', '27', 'Sapucaia do Sul'), ('166', '27', 'Uruguaiana'), ('167', '27', 'Santa Cruz do Sul'), ('168', '27', 'Cachoeirinha'), ('169', '27', 'Bagé'), ('170', '27', 'Bento Gonçalves'), ('171', '27', 'Erechim'), ('172', '27', 'Guaíba'), ('173', '27', 'Cachoeira do Sul'), ('174', '27', 'Santana do Livramento'), ('175', '27', 'Esteio'), ('176', '27', 'Ijuí'), ('177', '27', 'Alegrete'), ('178', '27', 'Santo Ângelo'), ('179', '27', 'Sapiranga'), ('180', '27', 'Lajeado'), ('181', '27', 'Santa Rosa'), ('182', '27', 'Venâncio Aires'), ('183', '27', 'Farroupilha'), ('184', '27', 'Camaquã');
COMMIT;

-- ----------------------------
-- Table structure for `clinicas`
-- ----------------------------
DROP TABLE IF EXISTS `clinicas`;
CREATE TABLE `clinicas` (
`id_clinica`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`ativo`  bit(1) NULL DEFAULT NULL ,
`logo`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`nome`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`cnpj`  varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`responsavel`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`rua`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`senha`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`numero`  int(11) NOT NULL ,
`complemento`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`bairro`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`cep`  varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`telefone`  varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_clinica`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=72

;

-- ----------------------------
-- Records of clinicas
-- ----------------------------
BEGIN;
INSERT INTO `clinicas` VALUES ('64', '', '00776574000156.jpg', 'Clinica Dr Pita', '00776574/0001-56', 'Rossano', 'Rua Mostardeiro', '4badaee57fed5610012a296273158f5f', '545', 'Sala 405', 'Auxiliadora', '90250-080', '(51) 5487-87878'), ('65', '', null, 'Olivia Heinz', '74818225/0001-96', 'Olivia Heinz', 'Rua Vinte Quatro de Outubro', '4badaee57fed5610012a296273158f5f', '546', 'sala 202', 'Moinhos de Vento', '90450-050', '(51) 3336-95989'), ('71', '', null, 'Koerich', '76797148/0001-60', 'IsabelaKoerich', 'Rua Santos Dumont', '4badaee57fed5610012a296273158f5f', '56', 'sala 400', 'Cetro', '80798-797', '(51) 6989-78977');
COMMIT;

-- ----------------------------
-- Table structure for `clinicas_medicos`
-- ----------------------------
DROP TABLE IF EXISTS `clinicas_medicos`;
CREATE TABLE `clinicas_medicos` (
`id_medico`  int(11) NOT NULL ,
`id_clinica`  int(11) NULL DEFAULT NULL 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci

;

-- ----------------------------
-- Records of clinicas_medicos
-- ----------------------------
BEGIN;
INSERT INTO `clinicas_medicos` VALUES ('3', '64'), ('2', '64'), ('1', '65'), ('2', '65'), ('1', '71'), ('2', '71'), ('3', '71'), ('3', '65'), ('1', '64');
COMMIT;

-- ----------------------------
-- Table structure for `consulta`
-- ----------------------------
DROP TABLE IF EXISTS `consulta`;
CREATE TABLE `consulta` (
`id_consulta`  int(11) NOT NULL AUTO_INCREMENT ,
`id_paciente`  int(11) NOT NULL ,
`id_horarios`  int(11) NOT NULL ,
`pago`  binary(1) NULL DEFAULT NULL ,
`st_atend`  tinyint(1) NULL DEFAULT 0 ,
`atendimento`  binary(1) NULL DEFAULT NULL ,
PRIMARY KEY (`id_consulta`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=6

;

-- ----------------------------
-- Records of consulta
-- ----------------------------
BEGIN;
INSERT INTO `consulta` VALUES ('4', '2', '5', 0x31, '2', null), ('5', '1', '6', 0x31, '0', null);
COMMIT;

-- ----------------------------
-- Table structure for `especialidades`
-- ----------------------------
DROP TABLE IF EXISTS `especialidades`;
CREATE TABLE `especialidades` (
`id_especialidade`  int(5) NOT NULL AUTO_INCREMENT ,
`especialidade`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_especialidade`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=32

;

-- ----------------------------
-- Records of especialidades
-- ----------------------------
BEGIN;
INSERT INTO `especialidades` VALUES ('0', 'selecione uma especialidade...'), ('2', 'Alergia'), ('3', 'Cardiologia'), ('4', 'Check Up'), ('5', 'Dentistica'), ('6', 'Dermatologia'), ('7', 'Diagnóstico por  Imagem'), ('8', 'Dor'), ('9', 'Endocrinilogia'), ('10', 'Endoscopia'), ('11', 'Enfermagem'), ('12', 'Fonoaudiologia'), ('13', 'Gastrologia'), ('14', 'Geriatria'), ('15', 'Ginecologia'), ('16', 'Hematologia'), ('17', 'Imunologia'), ('18', 'Infectologia'), ('19', 'Nutrição'), ('20', 'Obstetrícia'), ('21', 'Oftalmologia'), ('22', 'Oncologia'), ('23', 'Patologia'), ('24', 'Pediatria'), ('25', 'Pneumologia'), ('26', 'Psiquiatria'), ('27', 'Radioterapia'), ('28', 'Trauma'), ('29', 'Traumatologia'), ('30', 'Urologia'), ('31', 'Vascular');
COMMIT;

-- ----------------------------
-- Table structure for `historico`
-- ----------------------------
DROP TABLE IF EXISTS `historico`;
CREATE TABLE `historico` (
`id_historico`  int(11) NOT NULL AUTO_INCREMENT ,
`id_paciente`  int(11) NOT NULL ,
`id_consulta`  int(11) NOT NULL ,
`descricao`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
PRIMARY KEY (`id_historico`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Records of historico
-- ----------------------------
BEGIN;
INSERT INTO `historico` VALUES ('1', '2', '4', 'asdasdas asd asd asdasd asd'), ('2', '2', '4', 'Aqui vai qualquer descrição que o médico considere necessário');
COMMIT;

-- ----------------------------
-- Table structure for `horarios`
-- ----------------------------
DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
`id_horarios`  int(11) NOT NULL AUTO_INCREMENT ,
`id_clinica`  int(11) NULL DEFAULT NULL ,
`id_medico`  int(11) NOT NULL ,
`data`  datetime NOT NULL ,
`valor`  decimal(10,0) NOT NULL ,
`horario`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' ,
PRIMARY KEY (`id_horarios`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=140

;

-- ----------------------------
-- Records of horarios
-- ----------------------------
BEGIN;
INSERT INTO `horarios` VALUES ('1', '65', '2', '2014-12-01 13:00:00', '20', '13:00'), ('2', '65', '2', '2014-12-01 13:30:00', '20', '13:30'), ('3', '65', '2', '2014-12-01 14:00:00', '20', '14:00'), ('4', '65', '2', '2014-12-01 14:30:00', '20', '14:30'), ('5', '65', '1', '2014-12-01 23:00:00', '20', '08:00'), ('6', '65', '1', '2014-12-01 23:30:00', '20', '08:30'), ('7', '65', '1', '2014-12-01 09:00:00', '20', '09:00'), ('8', '65', '1', '2014-12-01 09:30:00', '20', '09:30'), ('9', '65', '1', '2014-12-01 10:00:00', '20', '10:00'), ('10', '65', '2', '2014-12-01 12:30:00', '20', '12:30'), ('11', '65', '2', '2014-12-01 15:30:00', '20', '15:30'), ('12', '64', '1', '2014-12-03 08:00:00', '20', '08:00'), ('13', '64', '1', '2014-12-03 08:30:00', '20', '08:30'), ('14', '64', '1', '2014-12-03 09:00:00', '20', '09:00'), ('15', '64', '1', '2014-12-04 08:00:00', '20', '08:00'), ('16', '64', '1', '2014-12-04 08:30:00', '20', '08:30'), ('17', '64', '1', '2014-12-04 09:00:00', '20', '09:00'), ('18', '64', '1', '2014-12-05 08:00:00', '20', '08:00'), ('19', '64', '1', '2014-12-05 08:30:00', '20', '08:30'), ('20', '64', '1', '2014-12-05 09:00:00', '20', '09:00'), ('21', '64', '1', '2014-12-06 08:00:00', '20', '08:00'), ('22', '64', '1', '2014-12-06 08:30:00', '20', '08:30'), ('23', '64', '1', '2014-12-06 09:00:00', '20', '09:00'), ('24', '64', '1', '2014-12-08 08:00:00', '20', '08:00'), ('25', '64', '1', '2014-12-08 08:30:00', '20', '08:30'), ('26', '64', '1', '2014-12-08 09:00:00', '20', '09:00'), ('27', '64', '1', '2014-12-09 08:00:00', '20', '08:00'), ('28', '64', '1', '2014-12-09 08:30:00', '20', '08:30'), ('29', '64', '1', '2014-12-09 09:00:00', '20', '09:00'), ('30', '64', '1', '2014-12-10 08:00:00', '20', '08:00'), ('31', '64', '1', '2014-12-10 08:30:00', '20', '08:30'), ('32', '64', '1', '2014-12-10 09:00:00', '20', '09:00'), ('33', '64', '1', '2014-12-11 08:00:00', '20', '08:00'), ('34', '64', '1', '2014-12-11 08:30:00', '20', '08:30'), ('35', '64', '1', '2014-12-11 09:00:00', '20', '09:00'), ('36', '64', '1', '2014-12-12 08:00:00', '20', '08:00'), ('37', '64', '1', '2014-12-12 08:30:00', '20', '08:30'), ('38', '64', '1', '2014-12-12 09:00:00', '20', '09:00'), ('39', '64', '1', '2014-12-15 08:00:00', '20', '08:00'), ('40', '64', '1', '2014-12-15 08:30:00', '20', '08:30'), ('41', '64', '1', '2014-12-15 09:00:00', '20', '09:00'), ('42', '64', '1', '2014-12-16 08:00:00', '20', '08:00'), ('43', '64', '1', '2014-12-16 08:30:00', '20', '08:30'), ('44', '64', '1', '2014-12-16 09:00:00', '20', '09:00'), ('45', '64', '1', '2014-12-17 08:00:00', '20', '08:00'), ('46', '64', '1', '2014-12-17 08:30:00', '20', '08:30'), ('47', '64', '1', '2014-12-17 09:00:00', '20', '09:00'), ('48', '64', '1', '2014-12-18 08:00:00', '20', '08:00'), ('49', '64', '1', '2014-12-18 08:30:00', '20', '08:30'), ('50', '64', '1', '2014-12-18 09:00:00', '20', '09:00'), ('51', '64', '1', '2014-12-19 08:00:00', '20', '08:00'), ('52', '64', '1', '2014-12-19 08:30:00', '20', '08:30'), ('53', '64', '1', '2014-12-19 09:00:00', '20', '09:00'), ('54', '64', '1', '2014-12-22 08:00:00', '20', '08:00'), ('55', '64', '1', '2014-12-22 08:30:00', '20', '08:30'), ('56', '64', '1', '2014-12-22 09:00:00', '20', '09:00'), ('57', '64', '1', '2014-12-23 08:00:00', '20', '08:00'), ('58', '64', '1', '2014-12-23 08:30:00', '20', '08:30'), ('59', '64', '1', '2014-12-23 09:00:00', '20', '09:00'), ('60', '64', '1', '2014-12-24 08:00:00', '20', '08:00'), ('61', '64', '1', '2014-12-24 08:30:00', '20', '08:30'), ('62', '64', '1', '2014-12-24 09:00:00', '20', '09:00'), ('63', '64', '1', '2014-12-25 08:00:00', '20', '08:00'), ('64', '64', '1', '2014-12-25 08:30:00', '20', '08:30'), ('65', '64', '1', '2014-12-25 09:00:00', '20', '09:00'), ('66', '64', '1', '2014-12-26 08:00:00', '20', '08:00'), ('67', '64', '1', '2014-12-26 08:30:00', '20', '08:30'), ('68', '64', '1', '2014-12-26 09:00:00', '20', '09:00'), ('69', '64', '1', '2014-12-29 08:00:00', '20', '08:00'), ('70', '64', '1', '2014-12-29 08:30:00', '20', '08:30'), ('71', '64', '1', '2014-12-29 09:00:00', '20', '09:00'), ('72', '64', '1', '2014-12-30 08:00:00', '20', '08:00'), ('73', '64', '1', '2014-12-30 08:30:00', '20', '08:30'), ('74', '64', '1', '2014-12-30 09:00:00', '20', '09:00'), ('75', '64', '2', '2014-12-03 08:30:00', '20', '08:30'), ('76', '64', '2', '2014-12-03 09:00:00', '20', '09:00'), ('77', '64', '2', '2014-12-03 09:30:00', '20', '09:30'), ('78', '64', '2', '2014-12-03 10:00:00', '20', '10:00'), ('79', '64', '2', '2014-12-03 10:30:00', '20', '10:30'), ('80', '64', '2', '2014-12-03 13:00:00', '20', '13:00'), ('81', '64', '2', '2014-12-03 13:30:00', '20', '13:30'), ('82', '64', '2', '2014-12-03 14:00:00', '20', '14:00'), ('83', '64', '2', '2014-12-03 14:30:00', '20', '14:30'), ('84', '64', '2', '2014-12-03 15:00:00', '20', '15:00'), ('85', '64', '2', '2014-12-10 08:30:00', '20', '08:30'), ('86', '64', '2', '2014-12-10 09:00:00', '20', '09:00'), ('87', '64', '2', '2014-12-10 09:30:00', '20', '09:30'), ('88', '64', '2', '2014-12-10 10:00:00', '20', '10:00'), ('89', '64', '2', '2014-12-10 10:30:00', '20', '10:30'), ('90', '64', '2', '2014-12-10 13:00:00', '20', '13:00'), ('91', '64', '2', '2014-12-10 13:30:00', '20', '13:30'), ('92', '64', '2', '2014-12-10 14:00:00', '20', '14:00'), ('93', '64', '2', '2014-12-10 14:30:00', '20', '14:30'), ('94', '64', '2', '2014-12-10 15:00:00', '20', '15:00'), ('95', '64', '2', '2014-12-17 08:30:00', '20', '08:30'), ('96', '64', '2', '2014-12-17 09:00:00', '20', '09:00'), ('97', '64', '2', '2014-12-17 09:30:00', '20', '09:30'), ('98', '64', '2', '2014-12-17 10:00:00', '20', '10:00'), ('99', '64', '2', '2014-12-17 10:30:00', '20', '10:30'), ('100', '64', '2', '2014-12-17 13:00:00', '20', '13:00');
INSERT INTO `horarios` VALUES ('101', '64', '2', '2014-12-17 13:30:00', '20', '13:30'), ('102', '64', '2', '2014-12-17 14:00:00', '20', '14:00'), ('103', '64', '2', '2014-12-17 14:30:00', '20', '14:30'), ('104', '64', '2', '2014-12-17 15:00:00', '20', '15:00'), ('105', '64', '2', '2014-12-24 08:30:00', '20', '08:30'), ('106', '64', '2', '2014-12-24 09:00:00', '20', '09:00'), ('107', '64', '2', '2014-12-24 09:30:00', '20', '09:30'), ('108', '64', '2', '2014-12-24 10:00:00', '20', '10:00'), ('109', '64', '2', '2014-12-24 10:30:00', '20', '10:30'), ('110', '64', '2', '2014-12-24 13:00:00', '20', '13:00'), ('111', '64', '2', '2014-12-24 13:30:00', '20', '13:30'), ('112', '64', '2', '2014-12-24 14:00:00', '20', '14:00'), ('113', '64', '2', '2014-12-24 14:30:00', '20', '14:30'), ('114', '64', '2', '2014-12-24 15:00:00', '20', '15:00'), ('115', '64', '2', '2014-12-31 08:30:00', '20', '08:30'), ('116', '64', '2', '2014-12-31 09:00:00', '20', '09:00'), ('117', '64', '2', '2014-12-31 09:30:00', '20', '09:30'), ('118', '64', '2', '2014-12-31 10:00:00', '20', '10:00'), ('119', '64', '2', '2014-12-31 10:30:00', '20', '10:30'), ('120', '64', '2', '2014-12-31 13:00:00', '20', '13:00'), ('121', '64', '2', '2014-12-31 13:30:00', '20', '13:30'), ('122', '64', '2', '2014-12-31 14:00:00', '20', '14:00'), ('123', '64', '2', '2014-12-31 14:30:00', '20', '14:30'), ('124', '64', '2', '2014-12-31 15:00:00', '20', '15:00'), ('125', '71', '1', '2014-12-03 12:30:00', '20', '12:30'), ('126', '71', '1', '2014-12-03 13:00:00', '20', '13:00'), ('127', '71', '1', '2014-12-03 13:30:00', '20', '13:30'), ('128', '71', '1', '2014-12-10 12:30:00', '20', '12:30'), ('129', '71', '1', '2014-12-10 13:00:00', '20', '13:00'), ('130', '71', '1', '2014-12-10 13:30:00', '20', '13:30'), ('131', '71', '1', '2014-12-17 12:30:00', '20', '12:30'), ('132', '71', '1', '2014-12-17 13:00:00', '20', '13:00'), ('133', '71', '1', '2014-12-17 13:30:00', '20', '13:30'), ('134', '71', '1', '2014-12-19 12:30:00', '20', '12:30'), ('135', '71', '1', '2014-12-19 13:00:00', '20', '13:00'), ('136', '71', '1', '2014-12-19 13:30:00', '20', '13:30'), ('137', '71', '1', '2014-12-26 12:30:00', '20', '12:30'), ('138', '71', '1', '2014-12-26 13:00:00', '20', '13:00'), ('139', '71', '1', '2014-12-26 13:30:00', '20', '13:30');
COMMIT;

-- ----------------------------
-- Table structure for `medicos`
-- ----------------------------
DROP TABLE IF EXISTS `medicos`;
CREATE TABLE `medicos` (
`id_medico`  int(11) NOT NULL AUTO_INCREMENT ,
`nome`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`crm`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`id_especialidade`  int(11) NOT NULL ,
`dta_nasc`  date NULL DEFAULT NULL ,
`celular`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`cep`  varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`id_cidade`  tinyint(4) NOT NULL ,
`bairro`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`complemento`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`numero`  int(11) NOT NULL ,
`rua`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`user`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`senha`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id_medico`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=4

;

-- ----------------------------
-- Records of medicos
-- ----------------------------
BEGIN;
INSERT INTO `medicos` VALUES ('1', 'Otávio Augusto', '52.74345-3', '2', '1957-05-05', '(51)825639', null, '2', 'Bairro', 'Complemento', '1256', 'Rua', 'otavio', '4badaee57fed5610012a296273158f5f'), ('2', 'Ana Paula', '50.7896-6', '2', '1980-08-20', '(51)911278', null, '4', 'Bairro', 'complemento', '5898', 'Rua', 'ana', '4badaee57fed5610012a296273158f5f'), ('3', 'Carla Celi', '40.78978-3', '3', '1965-01-25', '(51)000000', null, '2', 'Centro', 'complemento', '48', 'Rua', 'carla', '4badaee57fed5610012a296273158f5f');
COMMIT;

-- ----------------------------
-- Table structure for `pacientes`
-- ----------------------------
DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE `pacientes` (
`id_paciente`  int(4) NOT NULL AUTO_INCREMENT ,
`nome`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`rg`  varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`cpf`  varchar(14) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`dta_nasc`  date NOT NULL ,
`estado_civil`  char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`sexo`  char(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`telefone`  varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`rua`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`numero`  int(11) NOT NULL ,
`complemento`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`bairro`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`id_cidade`  int(4) NOT NULL ,
`cep`  varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`email`  varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`senha`  varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`foto`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id_paciente`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=3

;

-- ----------------------------
-- Records of pacientes
-- ----------------------------
BEGIN;
INSERT INTO `pacientes` VALUES ('1', 'Rossano Ramos Bavaresco', '6073522325', '937.521.990-91', '1978-01-30', 's', 'm', '(51) 3337-8998', 'Max Juniman', '105', 'Apartamento 209', 'Humaitá', '125', '90250-060', 'rossanorb@aol.com', '4badaee57fed5610012a296273158f5f', null), ('2', 'Juliana Gerlach', '6089789789', '810.857.830-22', '1984-10-03', 'c', 'f', '(51) 8487-79878', 'Rua Jeronimo', '465', 'casa 564', 'Boa Esperança', '125', '90889-789', 'juliana@dominio.com', '4badaee57fed5610012a296273158f5f', null);
COMMIT;

-- ----------------------------
-- Table structure for `uf`
-- ----------------------------
DROP TABLE IF EXISTS `uf`;
CREATE TABLE `uf` (
`id_uf`  int(5) NOT NULL AUTO_INCREMENT ,
`uf`  char(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`estado`  varchar(220) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_uf`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
AUTO_INCREMENT=33

;

-- ----------------------------
-- Records of uf
-- ----------------------------
BEGIN;
INSERT INTO `uf` VALUES ('0', '..', '..'), ('7', 'AC', 'Acre'), ('8', 'AL', 'Alagoas'), ('9', 'AP', 'Amapá'), ('10', 'AM', 'Amazonas'), ('11', 'BA', 'Bahia'), ('12', 'CE', 'Ceará'), ('13', 'DF', 'Distrito Federal'), ('14', 'ES', 'Espírito Santo'), ('15', 'GO', 'Goiás'), ('16', 'MA', 'Maranhão'), ('17', 'MT', 'Mato Grosso'), ('18', 'MS', 'Mato Grosso do Sul'), ('19', 'MG', 'Minas Gerais'), ('20', 'PR', 'Paraná'), ('21', 'PB', 'Paraíba'), ('22', 'PA', 'Pará'), ('23', 'PE', 'Pernambuco'), ('24', 'PI', 'Piauí'), ('25', 'RJ', 'Rio de Janeiro'), ('26', 'RN', 'Rio Grande do Norte'), ('27', 'RS', 'Rio Grande do Sul'), ('28', 'RO', 'Rondonia'), ('29', 'RR', 'Roraima'), ('30', 'SC', 'Santa Catarina'), ('31', 'SE', 'Sergipe'), ('32', 'SP', 'São Paulo');
COMMIT;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`name`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`email`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`password`  varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
`level`  tinyint(4) NOT NULL ,
`date_created`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=latin1 COLLATE=latin1_swedish_ci
AUTO_INCREMENT=1

;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Auto increment value for `arquivos`
-- ----------------------------
ALTER TABLE `arquivos` AUTO_INCREMENT=1;

-- ----------------------------
-- Indexes structure for table cidades
-- ----------------------------
CREATE UNIQUE INDEX `cidade_idx` ON `cidades`(`cidade`) USING BTREE ;
CREATE INDEX `id_uf` ON `cidades`(`id_uf`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `cidades`
-- ----------------------------
ALTER TABLE `cidades` AUTO_INCREMENT=185;

-- ----------------------------
-- Auto increment value for `clinicas`
-- ----------------------------
ALTER TABLE `clinicas` AUTO_INCREMENT=72;

-- ----------------------------
-- Auto increment value for `consulta`
-- ----------------------------
ALTER TABLE `consulta` AUTO_INCREMENT=6;

-- ----------------------------
-- Auto increment value for `especialidades`
-- ----------------------------
ALTER TABLE `especialidades` AUTO_INCREMENT=32;

-- ----------------------------
-- Auto increment value for `historico`
-- ----------------------------
ALTER TABLE `historico` AUTO_INCREMENT=3;

-- ----------------------------
-- Auto increment value for `horarios`
-- ----------------------------
ALTER TABLE `horarios` AUTO_INCREMENT=140;

-- ----------------------------
-- Auto increment value for `medicos`
-- ----------------------------
ALTER TABLE `medicos` AUTO_INCREMENT=4;

-- ----------------------------
-- Indexes structure for table pacientes
-- ----------------------------
CREATE UNIQUE INDEX `idx_rg` ON `pacientes`(`rg`) USING BTREE ;
CREATE UNIQUE INDEX `idx_cpf` ON `pacientes`(`cpf`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `pacientes`
-- ----------------------------
ALTER TABLE `pacientes` AUTO_INCREMENT=3;

-- ----------------------------
-- Indexes structure for table uf
-- ----------------------------
CREATE UNIQUE INDEX `uf_idx` ON `uf`(`uf`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `uf`
-- ----------------------------
ALTER TABLE `uf` AUTO_INCREMENT=33;

-- ----------------------------
-- Indexes structure for table user
-- ----------------------------
CREATE UNIQUE INDEX `email` ON `user`(`email`) USING BTREE ;

-- ----------------------------
-- Auto increment value for `user`
-- ----------------------------
ALTER TABLE `user` AUTO_INCREMENT=1;
