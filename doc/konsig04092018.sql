/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : konsig

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-09-04 17:53:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for banco
-- ----------------------------
DROP TABLE IF EXISTS `banco`;
CREATE TABLE `banco` (
  `ide_banco` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `num_codigo` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `nom_banco` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `num_cnpj` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_url` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `ide_banco` (`ide_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of banco
-- ----------------------------
INSERT INTO `banco` VALUES ('1', '000', 'Banco Bankpar S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('2', '001', 'Banco do Brasil S.A.', null, 'www.abcbrasil.com.br', 'A');
INSERT INTO `banco` VALUES ('3', '003', 'Banco da Amazônia S.A.', null, 'www.bancoalfa.com.br', 'A');
INSERT INTO `banco` VALUES ('4', '004', 'Banco do Nordeste do Brasil S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('5', '012', 'Banco Standard de Investimentos S.A.', null, 'www.arbi.com.br', 'A');
INSERT INTO `banco` VALUES ('6', '014', 'Natixis Brasil S.A. Banco Múltiplo', null, '-', 'A');
INSERT INTO `banco` VALUES ('7', '019', 'Banco Azteca do Brasil S.A.', null, 'www.banerj.com.br', 'A');
INSERT INTO `banco` VALUES ('8', '021', 'BANESTES S.A. Banco do Estado do Espírito Santo', null, 'www.aexp.com', 'A');
INSERT INTO `banco` VALUES ('9', '024', 'Banco de Pernambuco S.A. - BANDEPE', null, 'www.barclays.com', 'A');
INSERT INTO `banco` VALUES ('10', '025', 'Banco Alfa S.A.', null, 'www.bbmbank.com.br', 'A');
INSERT INTO `banco` VALUES ('11', '029', 'Banco Banerj S.A.', null, 'www.itau.com.br', 'A');
INSERT INTO `banco` VALUES ('12', '031', 'Banco Beg S.A.', null, 'www.bgn.com.br', 'A');
INSERT INTO `banco` VALUES ('13', '033', 'Banco Santander (Brasil) S.A.', null, 'www.bmf.com.br', 'A');
INSERT INTO `banco` VALUES ('14', '036', 'Banco Bradesco BBI S.A.', null, 'www.bancobmg.com.br', 'A');
INSERT INTO `banco` VALUES ('15', '037', 'Banco do Estado do Pará S.A.', null, 'www.bnpparibas.com.br', 'A');
INSERT INTO `banco` VALUES ('16', '039', 'Banco do Estado do Piauí S.A. - BEP', null, '-', 'A');
INSERT INTO `banco` VALUES ('17', '040', 'Banco Cargill S.A.', null, 'www.bancobonsucesso.com.br', 'A');
INSERT INTO `banco` VALUES ('18', '041', 'Banco do Estado do Rio Grande do Sul S.A.', null, 'www.lemon.com', 'A');
INSERT INTO `banco` VALUES ('19', '044', 'Banco BVA S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('20', '045', 'Banco Opportunity S.A.', null, 'www.iamex.com.br', 'A');
INSERT INTO `banco` VALUES ('21', '047', 'Banco do Estado de Sergipe S.A.', null, 'www.bmc.com.br', 'A');
INSERT INTO `banco` VALUES ('22', '062', 'Hipercard Banco Múltiplo S.A.', null, 'www.bradesco.com.br', 'A');
INSERT INTO `banco` VALUES ('23', '063', 'Banco Ibi S.A. Banco Múltiplo', null, 'www.bancobrascan.com.br', 'A');
INSERT INTO `banco` VALUES ('24', '064', 'Goldman Sachs do Brasil Banco Múltiplo S.A.', null, 'www.brjbank.com.br', 'A');
INSERT INTO `banco` VALUES ('25', '065', 'Banco Bracce S.A.', null, 'www.pactual.com.br', 'A');
INSERT INTO `banco` VALUES ('26', '066', 'Banco Morgan Stanley S.A.', null, 'www.bancobva.com.br', 'A');
INSERT INTO `banco` VALUES ('27', '069', 'BPN Brasil Banco Múltiplo S.A.', null, 'www.bancocacique.com.br', 'A');
INSERT INTO `banco` VALUES ('28', '070', 'BRB - Banco de Brasília S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('29', '072', 'Banco Rural Mais S.A.', null, 'www.bancocapital.com.br', 'A');
INSERT INTO `banco` VALUES ('30', '073', 'BB Banco Popular do Brasil S.A.', null, 'www.bancocargill.com.br', 'A');
INSERT INTO `banco` VALUES ('31', '074', 'Banco J. Safra S.A.', null, 'www.citibank.com.br', 'A');
INSERT INTO `banco` VALUES ('32', '075', 'Banco CR2 S.A.', null, 'www.credicardbanco.com.br', 'A');
INSERT INTO `banco` VALUES ('33', '076', 'Banco KDB S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('34', '078', 'BES Investimento do Brasil S.A.-Banco de Investimento', null, 'www.bancocnh.com.br', 'A');
INSERT INTO `banco` VALUES ('35', '079', 'JBS Banco S.A.', null, 'www.sudameris.com.br', 'A');
INSERT INTO `banco` VALUES ('36', '084', 'Unicred Norte do Paraná', null, 'www.bancoob.com.br', 'A');
INSERT INTO `banco` VALUES ('37', '096', 'Banco BM&F de Serviços de Liquidação e Custódia S.A', null, 'www.sicredi.com.br', 'A');
INSERT INTO `banco` VALUES ('38', '104', 'Caixa Econômica Federal', null, 'www.bancocr2.com.br', 'A');
INSERT INTO `banco` VALUES ('39', '107', 'Banco BBM S.A.', null, 'www.credibel.com.br', 'A');
INSERT INTO `banco` VALUES ('40', '168', 'HSBC Finance (Brasil) S.A. - Banco Múltiplo', null, 'www.calyon.com.br', 'A');
INSERT INTO `banco` VALUES ('41', '184', 'Banco Itaú BBA S.A.', null, 'www.csfb.com', 'A');
INSERT INTO `banco` VALUES ('42', '204', 'Banco Bradesco Cartões S.A.', null, 'www.bcsul.com.br', 'A');
INSERT INTO `banco` VALUES ('43', '208', 'Banco BTG Pactual S.A.', null, 'www.bancocedula.com.br', 'A');
INSERT INTO `banco` VALUES ('44', '212', 'Banco Matone S.A.', null, 'www.bancoamazonia.com.br', 'A');
INSERT INTO `banco` VALUES ('45', '213', 'Banco Arbi S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('46', '214', 'Banco Dibens S.A.', null, 'www.bancodaimlerchrysler.com.br', 'A');
INSERT INTO `banco` VALUES ('47', '215', 'Banco Comercial e de Investimento Sudameris S.A.', null, 'www.daycoval.com.br', 'A');
INSERT INTO `banco` VALUES ('48', '217', 'Banco John Deere S.A.', null, 'www.bna.com.ar', 'A');
INSERT INTO `banco` VALUES ('49', '218', 'Banco Bonsucesso S.A.', null, 'www.bapro.com.ar', 'A');
INSERT INTO `banco` VALUES ('50', '222', 'Banco Credit Agricole Brasil S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('51', '224', 'Banco Fibra S.A.', null, 'www.delagelanden.com', 'A');
INSERT INTO `banco` VALUES ('52', '225', 'Banco Brascan S.A.', null, 'www.bandepe.com.br', 'A');
INSERT INTO `banco` VALUES ('53', '229', 'Banco Cruzeiro do Sul S.A.', null, 'www.btm.com.br', 'A');
INSERT INTO `banco` VALUES ('54', '230', 'Unicard Banco Múltiplo S.A.', null, 'www.bancodibens.com.br', 'A');
INSERT INTO `banco` VALUES ('55', '233', 'Banco GE Capital S.A.', null, 'www.bb.com.br', 'A');
INSERT INTO `banco` VALUES ('56', '237', 'Banco Bradesco S.A.', null, 'www.banese.com.br', 'A');
INSERT INTO `banco` VALUES ('57', '241', 'Banco Clássico S.A.', null, 'www.banparanet.com.br', 'A');
INSERT INTO `banco` VALUES ('58', '243', 'Banco Máxima S.A.', null, 'www.bep.com.br', 'A');
INSERT INTO `banco` VALUES ('59', '246', 'Banco ABC Brasil S.A.', null, 'www.banrisul.com.br', 'A');
INSERT INTO `banco` VALUES ('60', '248', 'Banco Boavista Interatlântico S.A.', null, 'www.banconordeste.gov.br', 'A');
INSERT INTO `banco` VALUES ('61', '249', 'Banco Investcred Unibanco S.A.', null, 'www.bancofator.com.br', 'A');
INSERT INTO `banco` VALUES ('62', '250', 'Banco Schahin S.A.', null, 'www.bancofiat.com.br', 'A');
INSERT INTO `banco` VALUES ('63', '254', 'Paraná Banco S.A.', null, 'www.bancofibra.com.br', 'A');
INSERT INTO `banco` VALUES ('64', '263', 'Banco Cacique S.A.', null, 'www.ficsa.com.br', 'A');
INSERT INTO `banco` VALUES ('65', '265', 'Banco Fator S.A.', null, 'www.bancoford.com.br', 'A');
INSERT INTO `banco` VALUES ('66', '266', 'Banco Cédula S.A.', null, 'www.ge.com.br', 'A');
INSERT INTO `banco` VALUES ('67', '300', 'Banco de La Nacion Argentina', null, 'www.bancogerdau.com.br', 'A');
INSERT INTO `banco` VALUES ('68', '318', 'Banco BMG S.A.', null, 'www.bancogm.com.br', 'A');
INSERT INTO `banco` VALUES ('69', '320', 'Banco Industrial e Comercial S.A.', null, 'www.bcoguan.com.br', 'A');
INSERT INTO `banco` VALUES ('70', '341', 'Itaú Unibanco S.A.', null, 'www.bancohonda.com.br', 'A');
INSERT INTO `banco` VALUES ('71', '356', 'Banco Real S.A.', null, 'www.ibi.com.br', 'A');
INSERT INTO `banco` VALUES ('72', '366', 'Banco Société Générale Brasil S.A.', null, 'www.ibm.com/br/financing/', 'A');
INSERT INTO `banco` VALUES ('73', '370', 'Banco WestLB do Brasil S.A.', null, 'www.bancoindustrial.com.br', 'A');
INSERT INTO `banco` VALUES ('74', '376', 'Banco J. P. Morgan S.A.', null, 'www.bicbanco.com.br', 'A');
INSERT INTO `banco` VALUES ('75', '389', 'Banco Mercantil do Brasil S.A.', null, 'www.indusval.com.br', 'A');
INSERT INTO `banco` VALUES ('76', '394', 'Banco Bradesco Financiamentos S.A.', null, 'www.intercap.com.br', 'A');
INSERT INTO `banco` VALUES ('77', '399', 'HSBC Bank Brasil S.A. - Banco Múltiplo', null, 'www.intermedium.com.br', 'A');
INSERT INTO `banco` VALUES ('78', '409', 'UNIBANCO - União de Bancos Brasileiros S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('79', '412', 'Banco Capital S.A.', null, 'www.itaucred.com.br', 'A');
INSERT INTO `banco` VALUES ('80', '422', 'Banco Safra S.A.', null, 'www.itaubba.com.br', 'A');
INSERT INTO `banco` VALUES ('81', '453', 'Banco Rural S.A.', null, 'www.itaubank.com.br', 'A');
INSERT INTO `banco` VALUES ('82', '456', 'Banco de Tokyo-Mitsubishi UFJ Brasil S.A.', null, 'www.jpmorgan.com', 'A');
INSERT INTO `banco` VALUES ('83', '464', 'Banco Sumitomo Mitsui Brasileiro S.A.', null, 'www.jsafra.com.br', 'A');
INSERT INTO `banco` VALUES ('84', '473', 'Banco Caixa Geral - Brasil S.A.', null, 'www.johndeere.com.br', 'A');
INSERT INTO `banco` VALUES ('85', '477', 'Citibank N.A.', null, 'www.bancokdb.com.br', 'A');
INSERT INTO `banco` VALUES ('86', '479', 'Banco ItaúBank S.A', null, 'www.bancokeb.com.br', 'A');
INSERT INTO `banco` VALUES ('87', '487', 'Deutsche Bank S.A. - Banco Alemão', null, 'www.lusobrasileiro.com.br', 'A');
INSERT INTO `banco` VALUES ('88', '488', 'JPMorgan Chase Bank', null, 'www.bancomatone.com.br', 'A');
INSERT INTO `banco` VALUES ('89', '492', 'ING Bank N.V.', null, 'www.bancomaxinvest.com.br', 'A');
INSERT INTO `banco` VALUES ('90', '494', 'Banco de La Republica Oriental del Uruguay', null, 'www.mercantil.com.br', 'A');
INSERT INTO `banco` VALUES ('91', '495', 'Banco de La Provincia de Buenos Aires', null, 'www.bancomodal.com.br', 'A');
INSERT INTO `banco` VALUES ('92', '505', 'Banco Credit Suisse (Brasil) S.A.', null, 'www.bancomoneo.com.br', 'A');
INSERT INTO `banco` VALUES ('93', '600', 'Banco Luso Brasileiro S.A.', null, 'www.bancomorada.com.br', 'A');
INSERT INTO `banco` VALUES ('94', '604', 'Banco Industrial do Brasil S.A.', null, 'www.morganstanley.com.br', 'A');
INSERT INTO `banco` VALUES ('95', '610', 'Banco VR S.A.', null, 'www.bancomaxima.com.br', 'A');
INSERT INTO `banco` VALUES ('96', '611', 'Banco Paulista S.A.', null, 'www.opportunity.com.br', 'A');
INSERT INTO `banco` VALUES ('97', '612', 'Banco Guanabara S.A.', null, 'www.ourinvest.com.br', 'A');
INSERT INTO `banco` VALUES ('98', '613', 'Banco Pecúnia S.A.', null, 'www.panamericano.com.br', 'A');
INSERT INTO `banco` VALUES ('99', '623', 'Banco Panamericano S.A.', null, 'www.bancopaulista.com.br', 'A');
INSERT INTO `banco` VALUES ('100', '626', 'Banco Ficsa S.A.', null, 'www.bancopecunia.com.br', 'A');
INSERT INTO `banco` VALUES ('101', '630', 'Banco Intercap S.A.', null, 'www.personaltrader.com.br', 'A');
INSERT INTO `banco` VALUES ('102', '633', 'Banco Rendimento S.A.', null, 'www.bancopine.com.br', 'A');
INSERT INTO `banco` VALUES ('103', '634', 'Banco Triângulo S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('104', '637', 'Banco Sofisa S.A.', null, 'www.pottencial.com.br', 'A');
INSERT INTO `banco` VALUES ('105', '638', 'Banco Prosper S.A.', null, 'www.bancoprosper.com.br', 'A');
INSERT INTO `banco` VALUES ('106', '641', 'Banco Alvorada S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('107', '643', 'Banco Pine S.A.', null, 'www.rabobank.com.br', 'A');
INSERT INTO `banco` VALUES ('108', '652', 'Itaú Unibanco Holding S.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('109', '653', 'Banco Indusval S.A.', null, 'www.bancoreal.com.br', 'A');
INSERT INTO `banco` VALUES ('110', '654', 'Banco A.J.Renner S.A.', null, 'www.rendimento.com.br', 'A');
INSERT INTO `banco` VALUES ('111', '655', 'Banco Votorantim S.A.', null, 'www.brp.com.br', 'A');
INSERT INTO `banco` VALUES ('112', '707', 'Banco Daycoval S.A.', null, 'www.rodobens.com.br', 'A');
INSERT INTO `banco` VALUES ('113', '719', 'Banif-Banco Internacional do Funchal (Brasil)S.A.', null, 'www.rural.com.br', 'A');
INSERT INTO `banco` VALUES ('114', '721', 'Banco Credibel S.A.', null, 'www.rural.com.br', 'A');
INSERT INTO `banco` VALUES ('115', '724', 'Banco Porto Seguro S.A.', null, 'www.safra.com.br', 'A');
INSERT INTO `banco` VALUES ('116', '734', 'Banco Gerdau S.A.', null, 'www.santander.com.br', 'A');
INSERT INTO `banco` VALUES ('117', '735', 'Banco Pottencial S.A.', null, 'www.bancoschahin.com.br', 'A');
INSERT INTO `banco` VALUES ('118', '738', 'Banco Morada S.A.', null, 'www.bancosemear.com.br', 'A');
INSERT INTO `banco` VALUES ('119', '739', 'Banco BGN S.A.', null, 'www.bancosimples.com.br', 'A');
INSERT INTO `banco` VALUES ('120', '740', 'Banco Barclays S.A.', null, 'www.sgbrasil.com.br', 'A');
INSERT INTO `banco` VALUES ('121', '741', 'Banco Ribeirão Preto S.A.', null, 'www.sofisa.com.br', 'A');
INSERT INTO `banco` VALUES ('122', '743', 'Banco Semear S.A.', null, 'www.standardbank.com', 'A');
INSERT INTO `banco` VALUES ('123', '744', 'BankBoston N.A.', null, '-', 'A');
INSERT INTO `banco` VALUES ('124', '745', 'Banco Citibank S.A.', null, 'www.bancotopazio.com.br', 'A');
INSERT INTO `banco` VALUES ('125', '746', 'Banco Modal S.A.', null, 'www.bancotoyota.com.br', 'A');
INSERT INTO `banco` VALUES ('126', '747', 'Banco Rabobank International Brasil S.A.', null, 'www.tricury.com.br', 'A');
INSERT INTO `banco` VALUES ('127', '748', 'Banco Cooperativo Sicredi S.A.', null, 'www.tribanco.com.br', 'A');
INSERT INTO `banco` VALUES ('128', '749', 'Banco Simples S.A.', null, 'www.bancovw.com.br', 'A');
INSERT INTO `banco` VALUES ('129', '751', 'Dresdner Bank Brasil S.A. - Banco Múltiplo', null, '-', 'A');
INSERT INTO `banco` VALUES ('130', '752', 'Banco BNP Paribas Brasil S.A.', null, 'www.bancovotorantim.com.br', 'A');
INSERT INTO `banco` VALUES ('131', '753', 'NBC Bank Brasil S.A. - Banco Múltiplo', null, 'www.vr.com.br', 'A');
INSERT INTO `banco` VALUES ('132', '755', 'Bank of America Merrill Lynch Banco Múltiplo S.A.', null, 'www.westlb.com.br', 'A');
INSERT INTO `banco` VALUES ('133', '756', 'Banco Cooperativo do Brasil S.A. - BANCOOB', null, 'www.banestes.com.br', 'A');
INSERT INTO `banco` VALUES ('134', '757', 'Banco KEB do Brasil S.A.', null, 'www.banif.com.br', 'A');

-- ----------------------------
-- Table structure for cidade
-- ----------------------------
DROP TABLE IF EXISTS `cidade`;
CREATE TABLE `cidade` (
  `ide_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cidade` varchar(120) DEFAULT NULL,
  `ide_estado` int(5) DEFAULT NULL,
  PRIMARY KEY (`ide_cidade`),
  KEY `fk_Cidade_estado` (`ide_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=416 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cidade
-- ----------------------------
INSERT INTO `cidade` VALUES ('1', 'Abaira', '28');
INSERT INTO `cidade` VALUES ('2', 'Abare', '28');
INSERT INTO `cidade` VALUES ('3', 'Acajutiba', '28');
INSERT INTO `cidade` VALUES ('4', 'Adustina', '28');
INSERT INTO `cidade` VALUES ('5', 'Agua Fria', '28');
INSERT INTO `cidade` VALUES ('6', 'Aiquara', '28');
INSERT INTO `cidade` VALUES ('7', 'Alagoinhas', '28');
INSERT INTO `cidade` VALUES ('8', 'Alcobaca', '28');
INSERT INTO `cidade` VALUES ('9', 'Almadina', '28');
INSERT INTO `cidade` VALUES ('10', 'Amargosa', '28');
INSERT INTO `cidade` VALUES ('11', 'Amelia Rodrigues', '28');
INSERT INTO `cidade` VALUES ('12', 'America Dourada', '28');
INSERT INTO `cidade` VALUES ('13', 'Anage', '28');
INSERT INTO `cidade` VALUES ('14', 'Andarai', '28');
INSERT INTO `cidade` VALUES ('15', 'Andorinha', '28');
INSERT INTO `cidade` VALUES ('16', 'Angical', '28');
INSERT INTO `cidade` VALUES ('17', 'Anguera', '28');
INSERT INTO `cidade` VALUES ('18', 'Antas', '28');
INSERT INTO `cidade` VALUES ('19', 'Antonio Cardoso', '28');
INSERT INTO `cidade` VALUES ('20', 'Antonio Goncalves', '28');
INSERT INTO `cidade` VALUES ('21', 'Apora', '28');
INSERT INTO `cidade` VALUES ('22', 'Apuarema', '28');
INSERT INTO `cidade` VALUES ('23', 'Aracas', '28');
INSERT INTO `cidade` VALUES ('24', 'Aracatu', '28');
INSERT INTO `cidade` VALUES ('25', 'Araci', '28');
INSERT INTO `cidade` VALUES ('26', 'Aramari', '28');
INSERT INTO `cidade` VALUES ('27', 'Arataca', '28');
INSERT INTO `cidade` VALUES ('28', 'Aratuipe', '28');
INSERT INTO `cidade` VALUES ('29', 'Aurelino Leal', '28');
INSERT INTO `cidade` VALUES ('30', 'Baianopolis', '28');
INSERT INTO `cidade` VALUES ('31', 'Baixa Grande', '28');
INSERT INTO `cidade` VALUES ('32', 'Banzae', '28');
INSERT INTO `cidade` VALUES ('33', 'Barra da Estiva', '28');
INSERT INTO `cidade` VALUES ('34', 'Barra do Choca', '28');
INSERT INTO `cidade` VALUES ('35', 'Barra do Mendes', '28');
INSERT INTO `cidade` VALUES ('36', 'Barra do Rocha', '28');
INSERT INTO `cidade` VALUES ('37', 'Barra', '28');
INSERT INTO `cidade` VALUES ('38', 'Barreiras', '28');
INSERT INTO `cidade` VALUES ('39', 'Barro Alto', '28');
INSERT INTO `cidade` VALUES ('40', 'Barro Preto', '28');
INSERT INTO `cidade` VALUES ('41', 'Belmonte', '28');
INSERT INTO `cidade` VALUES ('42', 'Belo Campo', '28');
INSERT INTO `cidade` VALUES ('43', 'Biritinga', '28');
INSERT INTO `cidade` VALUES ('44', 'Boa Nova', '28');
INSERT INTO `cidade` VALUES ('45', 'Boa Vista do Tupim', '28');
INSERT INTO `cidade` VALUES ('46', 'Bom Jesus da Lapa', '28');
INSERT INTO `cidade` VALUES ('47', 'Bom Jesus da Serra', '28');
INSERT INTO `cidade` VALUES ('48', 'Boninal', '28');
INSERT INTO `cidade` VALUES ('49', 'Bonito', '28');
INSERT INTO `cidade` VALUES ('50', 'Boquira', '28');
INSERT INTO `cidade` VALUES ('51', 'Botupora', '28');
INSERT INTO `cidade` VALUES ('52', 'Brejoes', '28');
INSERT INTO `cidade` VALUES ('53', 'Brejolandia', '28');
INSERT INTO `cidade` VALUES ('54', 'Brotas de Macaubas', '28');
INSERT INTO `cidade` VALUES ('55', 'Brumado', '28');
INSERT INTO `cidade` VALUES ('56', 'Buerarema', '28');
INSERT INTO `cidade` VALUES ('57', 'Buritirama', '28');
INSERT INTO `cidade` VALUES ('58', 'Caatiba', '28');
INSERT INTO `cidade` VALUES ('59', 'Cabaceiras do Paraguacu', '28');
INSERT INTO `cidade` VALUES ('60', 'Cachoeira', '28');
INSERT INTO `cidade` VALUES ('61', 'Cacule', '28');
INSERT INTO `cidade` VALUES ('62', 'Caem', '28');
INSERT INTO `cidade` VALUES ('63', 'Caetanos', '28');
INSERT INTO `cidade` VALUES ('64', 'Caetite', '28');
INSERT INTO `cidade` VALUES ('65', 'Cafarnaum', '28');
INSERT INTO `cidade` VALUES ('66', 'Cairu', '28');
INSERT INTO `cidade` VALUES ('67', 'Caldeirao Grande', '28');
INSERT INTO `cidade` VALUES ('68', 'Camacan', '28');
INSERT INTO `cidade` VALUES ('69', 'Camacari', '28');
INSERT INTO `cidade` VALUES ('70', 'Camamu', '28');
INSERT INTO `cidade` VALUES ('71', 'Campo Alegre de Lourdes', '28');
INSERT INTO `cidade` VALUES ('72', 'Campo Formoso', '28');
INSERT INTO `cidade` VALUES ('73', 'Canapolis', '28');
INSERT INTO `cidade` VALUES ('74', 'Canarana', '28');
INSERT INTO `cidade` VALUES ('75', 'Canavieiras', '28');
INSERT INTO `cidade` VALUES ('76', 'Candeal', '28');
INSERT INTO `cidade` VALUES ('77', 'Candeias', '28');
INSERT INTO `cidade` VALUES ('78', 'Candiba', '28');
INSERT INTO `cidade` VALUES ('79', 'Candido Sales', '28');
INSERT INTO `cidade` VALUES ('80', 'Cansancao', '28');
INSERT INTO `cidade` VALUES ('81', 'Canudos', '28');
INSERT INTO `cidade` VALUES ('82', 'Capela do Alto Alegre', '28');
INSERT INTO `cidade` VALUES ('83', 'Capim Grosso', '28');
INSERT INTO `cidade` VALUES ('84', 'Caraibas', '28');
INSERT INTO `cidade` VALUES ('85', 'Caravelas', '28');
INSERT INTO `cidade` VALUES ('86', 'Cardeal da Silva', '28');
INSERT INTO `cidade` VALUES ('87', 'Carinhanha', '28');
INSERT INTO `cidade` VALUES ('88', 'Casa Nova', '28');
INSERT INTO `cidade` VALUES ('89', 'Castro Alves', '28');
INSERT INTO `cidade` VALUES ('90', 'Catolandia', '28');
INSERT INTO `cidade` VALUES ('91', 'Catu', '28');
INSERT INTO `cidade` VALUES ('92', 'Caturama', '28');
INSERT INTO `cidade` VALUES ('93', 'Central', '28');
INSERT INTO `cidade` VALUES ('94', 'Chorrocho', '28');
INSERT INTO `cidade` VALUES ('95', 'Cicero Dantas', '28');
INSERT INTO `cidade` VALUES ('96', 'Cipo', '28');
INSERT INTO `cidade` VALUES ('97', 'Coaraci', '28');
INSERT INTO `cidade` VALUES ('98', 'Cocos', '28');
INSERT INTO `cidade` VALUES ('99', 'Conceicao da Feira', '28');
INSERT INTO `cidade` VALUES ('100', 'Conceicao do Almeida', '28');
INSERT INTO `cidade` VALUES ('101', 'Conceicao do Coite', '28');
INSERT INTO `cidade` VALUES ('102', 'Conceicao do Jacuipe', '28');
INSERT INTO `cidade` VALUES ('103', 'Conde', '28');
INSERT INTO `cidade` VALUES ('104', 'Condeuba', '28');
INSERT INTO `cidade` VALUES ('105', 'Contendas do Sincora', '28');
INSERT INTO `cidade` VALUES ('106', 'Coracao de Maria', '28');
INSERT INTO `cidade` VALUES ('107', 'Cordeiros', '28');
INSERT INTO `cidade` VALUES ('108', 'Coribe', '28');
INSERT INTO `cidade` VALUES ('109', 'Coronel Joao Sa', '28');
INSERT INTO `cidade` VALUES ('110', 'Correntina', '28');
INSERT INTO `cidade` VALUES ('111', 'Cotegipe', '28');
INSERT INTO `cidade` VALUES ('112', 'Cravolandia', '28');
INSERT INTO `cidade` VALUES ('113', 'Crisopolis', '28');
INSERT INTO `cidade` VALUES ('114', 'Cristopolis', '28');
INSERT INTO `cidade` VALUES ('115', 'Cruz das Almas', '28');
INSERT INTO `cidade` VALUES ('116', 'Curaca', '28');
INSERT INTO `cidade` VALUES ('117', 'Dario Meira', '28');
INSERT INTO `cidade` VALUES ('118', 'Dias dAvila', '28');
INSERT INTO `cidade` VALUES ('119', 'Dom Basilio', '28');
INSERT INTO `cidade` VALUES ('120', 'Dom Macedo Costa', '28');
INSERT INTO `cidade` VALUES ('121', 'Elisio Medrado', '28');
INSERT INTO `cidade` VALUES ('122', 'Encruzilhada', '28');
INSERT INTO `cidade` VALUES ('123', 'Entre Rios', '28');
INSERT INTO `cidade` VALUES ('124', 'Erico Cardoso', '28');
INSERT INTO `cidade` VALUES ('125', 'Esplanada', '28');
INSERT INTO `cidade` VALUES ('126', 'Euclides da Cunha', '28');
INSERT INTO `cidade` VALUES ('127', 'Eunapolis', '28');
INSERT INTO `cidade` VALUES ('128', 'Fatima', '28');
INSERT INTO `cidade` VALUES ('129', 'Feira da Mata', '28');
INSERT INTO `cidade` VALUES ('130', 'Feira de Santana', '28');
INSERT INTO `cidade` VALUES ('131', 'Filadelfia', '28');
INSERT INTO `cidade` VALUES ('132', 'Firmino Alves', '28');
INSERT INTO `cidade` VALUES ('133', 'Floresta Azul', '28');
INSERT INTO `cidade` VALUES ('134', 'Formosa do Rio Preto', '28');
INSERT INTO `cidade` VALUES ('135', 'Gandu', '28');
INSERT INTO `cidade` VALUES ('136', 'Gaviao', '28');
INSERT INTO `cidade` VALUES ('137', 'Gentio do Ouro', '28');
INSERT INTO `cidade` VALUES ('138', 'Gloria', '28');
INSERT INTO `cidade` VALUES ('139', 'Gongogi', '28');
INSERT INTO `cidade` VALUES ('140', 'Governador Mangabeira', '28');
INSERT INTO `cidade` VALUES ('141', 'Guajeru', '28');
INSERT INTO `cidade` VALUES ('142', 'Guanambi', '28');
INSERT INTO `cidade` VALUES ('143', 'Guaratinga', '28');
INSERT INTO `cidade` VALUES ('144', 'Heliopolis', '28');
INSERT INTO `cidade` VALUES ('145', 'Iacu', '28');
INSERT INTO `cidade` VALUES ('146', 'Ibiassuce', '28');
INSERT INTO `cidade` VALUES ('147', 'Ibicarai', '28');
INSERT INTO `cidade` VALUES ('148', 'Ibicoara', '28');
INSERT INTO `cidade` VALUES ('149', 'Ibicui', '28');
INSERT INTO `cidade` VALUES ('150', 'Ibipeba', '28');
INSERT INTO `cidade` VALUES ('151', 'Ibipitanga', '28');
INSERT INTO `cidade` VALUES ('152', 'Ibiquera', '28');
INSERT INTO `cidade` VALUES ('153', 'Ibirapitanga', '28');
INSERT INTO `cidade` VALUES ('154', 'Ibirapua', '28');
INSERT INTO `cidade` VALUES ('155', 'Ibirataia', '28');
INSERT INTO `cidade` VALUES ('156', 'Ibitiara', '28');
INSERT INTO `cidade` VALUES ('157', 'Ibitita', '28');
INSERT INTO `cidade` VALUES ('158', 'Ibotirama', '28');
INSERT INTO `cidade` VALUES ('159', 'Ichu', '28');
INSERT INTO `cidade` VALUES ('160', 'Igapora', '28');
INSERT INTO `cidade` VALUES ('161', 'Igrapiuna', '28');
INSERT INTO `cidade` VALUES ('162', 'Iguai', '28');
INSERT INTO `cidade` VALUES ('163', 'Ilheus', '28');
INSERT INTO `cidade` VALUES ('164', 'Inhambupe', '28');
INSERT INTO `cidade` VALUES ('165', 'Ipecaeta', '28');
INSERT INTO `cidade` VALUES ('166', 'Ipiau', '28');
INSERT INTO `cidade` VALUES ('167', 'Ipira', '28');
INSERT INTO `cidade` VALUES ('168', 'Ipupiara', '28');
INSERT INTO `cidade` VALUES ('169', 'Irajuba', '28');
INSERT INTO `cidade` VALUES ('170', 'Iramaia', '28');
INSERT INTO `cidade` VALUES ('171', 'Iraquara', '28');
INSERT INTO `cidade` VALUES ('172', 'Irara', '28');
INSERT INTO `cidade` VALUES ('173', 'Irece', '28');
INSERT INTO `cidade` VALUES ('174', 'Itabela', '28');
INSERT INTO `cidade` VALUES ('175', 'Itaberaba', '28');
INSERT INTO `cidade` VALUES ('176', 'Itabuna', '28');
INSERT INTO `cidade` VALUES ('177', 'Itacare', '28');
INSERT INTO `cidade` VALUES ('178', 'Itaete', '28');
INSERT INTO `cidade` VALUES ('179', 'Itagi', '28');
INSERT INTO `cidade` VALUES ('180', 'Itagiba', '28');
INSERT INTO `cidade` VALUES ('181', 'Itagimirim', '28');
INSERT INTO `cidade` VALUES ('182', 'Itaguacu da Bahia', '28');
INSERT INTO `cidade` VALUES ('183', 'Itaju do Colonia', '28');
INSERT INTO `cidade` VALUES ('184', 'Itajuipe', '28');
INSERT INTO `cidade` VALUES ('185', 'Itamaraju', '28');
INSERT INTO `cidade` VALUES ('186', 'Itamari', '28');
INSERT INTO `cidade` VALUES ('187', 'Itambe', '28');
INSERT INTO `cidade` VALUES ('188', 'Itanagra', '28');
INSERT INTO `cidade` VALUES ('189', 'Itanhem', '28');
INSERT INTO `cidade` VALUES ('190', 'Itaparica', '28');
INSERT INTO `cidade` VALUES ('191', 'Itape', '28');
INSERT INTO `cidade` VALUES ('192', 'Itapebi', '28');
INSERT INTO `cidade` VALUES ('193', 'Itapetinga', '28');
INSERT INTO `cidade` VALUES ('194', 'Itapicuru', '28');
INSERT INTO `cidade` VALUES ('195', 'Itapitanga', '28');
INSERT INTO `cidade` VALUES ('196', 'Itaquara', '28');
INSERT INTO `cidade` VALUES ('197', 'Itarantim', '28');
INSERT INTO `cidade` VALUES ('198', 'Itatim', '28');
INSERT INTO `cidade` VALUES ('199', 'Itirucu', '28');
INSERT INTO `cidade` VALUES ('200', 'Itiuba', '28');
INSERT INTO `cidade` VALUES ('201', 'Itororo', '28');
INSERT INTO `cidade` VALUES ('202', 'Ituacu', '28');
INSERT INTO `cidade` VALUES ('203', 'Itubera', '28');
INSERT INTO `cidade` VALUES ('204', 'Iuiu', '28');
INSERT INTO `cidade` VALUES ('205', 'Jaborandi', '28');
INSERT INTO `cidade` VALUES ('206', 'Jacaraci', '28');
INSERT INTO `cidade` VALUES ('207', 'Jacobina', '28');
INSERT INTO `cidade` VALUES ('208', 'Jaguaquara', '28');
INSERT INTO `cidade` VALUES ('209', 'Jaguarari', '28');
INSERT INTO `cidade` VALUES ('210', 'Jaguaripe', '28');
INSERT INTO `cidade` VALUES ('211', 'Jandaira', '28');
INSERT INTO `cidade` VALUES ('212', 'Jequie', '28');
INSERT INTO `cidade` VALUES ('213', 'Jeremoabo', '28');
INSERT INTO `cidade` VALUES ('214', 'Jiquirica', '28');
INSERT INTO `cidade` VALUES ('215', 'Jitauna', '28');
INSERT INTO `cidade` VALUES ('216', 'Joao Dourado', '28');
INSERT INTO `cidade` VALUES ('217', 'Juazeiro', '28');
INSERT INTO `cidade` VALUES ('218', 'Jucurucu', '28');
INSERT INTO `cidade` VALUES ('219', 'Jussara', '28');
INSERT INTO `cidade` VALUES ('220', 'Jussari', '28');
INSERT INTO `cidade` VALUES ('221', 'Jussiape', '28');
INSERT INTO `cidade` VALUES ('222', 'Lafaiete Coutinho', '28');
INSERT INTO `cidade` VALUES ('223', 'Lagoa Real', '28');
INSERT INTO `cidade` VALUES ('224', 'Laje', '28');
INSERT INTO `cidade` VALUES ('225', 'Lajedao', '28');
INSERT INTO `cidade` VALUES ('226', 'Lajedinho', '28');
INSERT INTO `cidade` VALUES ('227', 'Lajedo do Tabocal', '28');
INSERT INTO `cidade` VALUES ('228', 'Lamarao', '28');
INSERT INTO `cidade` VALUES ('229', 'Lapao', '28');
INSERT INTO `cidade` VALUES ('230', 'Lauro de Freitas', '28');
INSERT INTO `cidade` VALUES ('231', 'Lencois', '28');
INSERT INTO `cidade` VALUES ('232', 'Licinio de Almeida', '28');
INSERT INTO `cidade` VALUES ('233', 'Livramento do Brumado', '28');
INSERT INTO `cidade` VALUES ('234', 'Macajuba', '28');
INSERT INTO `cidade` VALUES ('235', 'Macarani', '28');
INSERT INTO `cidade` VALUES ('236', 'Macaubas', '28');
INSERT INTO `cidade` VALUES ('237', 'Macurure', '28');
INSERT INTO `cidade` VALUES ('238', 'Madre de Deus', '28');
INSERT INTO `cidade` VALUES ('239', 'Maetinga', '28');
INSERT INTO `cidade` VALUES ('240', 'Maiquinique', '28');
INSERT INTO `cidade` VALUES ('241', 'Mairi', '28');
INSERT INTO `cidade` VALUES ('242', 'Malhada de Pedras', '28');
INSERT INTO `cidade` VALUES ('243', 'Malhada', '28');
INSERT INTO `cidade` VALUES ('244', 'Manoel Vitorino', '28');
INSERT INTO `cidade` VALUES ('245', 'Mansidao', '28');
INSERT INTO `cidade` VALUES ('246', 'Maracas', '28');
INSERT INTO `cidade` VALUES ('247', 'Maragogipe', '28');
INSERT INTO `cidade` VALUES ('248', 'Marau', '28');
INSERT INTO `cidade` VALUES ('249', 'Marcionilio Souza', '28');
INSERT INTO `cidade` VALUES ('250', 'Mascote', '28');
INSERT INTO `cidade` VALUES ('251', 'Mata de Sao Joao', '28');
INSERT INTO `cidade` VALUES ('252', 'Matina', '28');
INSERT INTO `cidade` VALUES ('253', 'Medeiros Neto', '28');
INSERT INTO `cidade` VALUES ('254', 'Miguel Calmon', '28');
INSERT INTO `cidade` VALUES ('255', 'Milagres', '28');
INSERT INTO `cidade` VALUES ('256', 'Mirangaba', '28');
INSERT INTO `cidade` VALUES ('257', 'Mirante', '28');
INSERT INTO `cidade` VALUES ('258', 'Monte Santo', '28');
INSERT INTO `cidade` VALUES ('259', 'Morpara', '28');
INSERT INTO `cidade` VALUES ('260', 'Morro do Chapeu', '28');
INSERT INTO `cidade` VALUES ('261', 'Mortugaba', '28');
INSERT INTO `cidade` VALUES ('262', 'Mucuge', '28');
INSERT INTO `cidade` VALUES ('263', 'Mucuri', '28');
INSERT INTO `cidade` VALUES ('264', 'Mulungu do Morro', '28');
INSERT INTO `cidade` VALUES ('265', 'Mundo Novo', '28');
INSERT INTO `cidade` VALUES ('266', 'Muniz Ferreira', '28');
INSERT INTO `cidade` VALUES ('267', 'Muquem de Sao Francisco', '28');
INSERT INTO `cidade` VALUES ('268', 'Muritiba', '28');
INSERT INTO `cidade` VALUES ('269', 'Mutuipe', '28');
INSERT INTO `cidade` VALUES ('270', 'Nazare', '28');
INSERT INTO `cidade` VALUES ('271', 'Nilo Pecanha', '28');
INSERT INTO `cidade` VALUES ('272', 'Nordestina', '28');
INSERT INTO `cidade` VALUES ('273', 'Nova Canaa', '28');
INSERT INTO `cidade` VALUES ('274', 'Nova Fatima', '28');
INSERT INTO `cidade` VALUES ('275', 'Nova Ibia', '28');
INSERT INTO `cidade` VALUES ('276', 'Nova Itarana', '28');
INSERT INTO `cidade` VALUES ('277', 'Nova Redencao', '28');
INSERT INTO `cidade` VALUES ('278', 'Nova Soure', '28');
INSERT INTO `cidade` VALUES ('279', 'Nova Vicosa', '28');
INSERT INTO `cidade` VALUES ('280', 'Novo Horizonte', '28');
INSERT INTO `cidade` VALUES ('281', 'Novo Triunfo', '28');
INSERT INTO `cidade` VALUES ('282', 'Olindina', '28');
INSERT INTO `cidade` VALUES ('283', 'Oliveira dos Brejinhos', '28');
INSERT INTO `cidade` VALUES ('284', 'Ouricangas', '28');
INSERT INTO `cidade` VALUES ('285', 'Ourolandia', '28');
INSERT INTO `cidade` VALUES ('286', 'Palmas de Monte Alto', '28');
INSERT INTO `cidade` VALUES ('287', 'Palmeiras', '28');
INSERT INTO `cidade` VALUES ('288', 'Paramirim', '28');
INSERT INTO `cidade` VALUES ('289', 'Paratinga', '28');
INSERT INTO `cidade` VALUES ('290', 'Paripiranga', '28');
INSERT INTO `cidade` VALUES ('291', 'Pau Brasil', '28');
INSERT INTO `cidade` VALUES ('292', 'Paulo Afonso', '28');
INSERT INTO `cidade` VALUES ('293', 'Pe de Serra', '28');
INSERT INTO `cidade` VALUES ('294', 'Pedrao', '28');
INSERT INTO `cidade` VALUES ('295', 'Pedro Alexandre', '28');
INSERT INTO `cidade` VALUES ('296', 'Piata', '28');
INSERT INTO `cidade` VALUES ('297', 'Pilao Arcado', '28');
INSERT INTO `cidade` VALUES ('298', 'Pindai', '28');
INSERT INTO `cidade` VALUES ('299', 'Pindobacu', '28');
INSERT INTO `cidade` VALUES ('300', 'Pintadas', '28');
INSERT INTO `cidade` VALUES ('301', 'Pirai do Norte', '28');
INSERT INTO `cidade` VALUES ('302', 'Piripa', '28');
INSERT INTO `cidade` VALUES ('303', 'Piritiba', '28');
INSERT INTO `cidade` VALUES ('304', 'Planaltino', '28');
INSERT INTO `cidade` VALUES ('305', 'Planalto', '28');
INSERT INTO `cidade` VALUES ('306', 'Pocoes', '28');
INSERT INTO `cidade` VALUES ('307', 'Pojuca', '28');
INSERT INTO `cidade` VALUES ('308', 'Ponto Novo', '28');
INSERT INTO `cidade` VALUES ('309', 'Porto Seguro', '28');
INSERT INTO `cidade` VALUES ('310', 'Potiragua', '28');
INSERT INTO `cidade` VALUES ('311', 'Prado', '28');
INSERT INTO `cidade` VALUES ('312', 'Presidente Dutra', '28');
INSERT INTO `cidade` VALUES ('313', 'Presidente Janio Quadros', '28');
INSERT INTO `cidade` VALUES ('314', 'Presidente Tancredo Neves', '28');
INSERT INTO `cidade` VALUES ('315', 'Queimadas', '28');
INSERT INTO `cidade` VALUES ('316', 'Quijingue', '28');
INSERT INTO `cidade` VALUES ('317', 'Quixabeira', '28');
INSERT INTO `cidade` VALUES ('318', 'Rafael Jambeiro', '28');
INSERT INTO `cidade` VALUES ('319', 'Remanso', '28');
INSERT INTO `cidade` VALUES ('320', 'Retirolandia', '28');
INSERT INTO `cidade` VALUES ('321', 'Riachao das Neves', '28');
INSERT INTO `cidade` VALUES ('322', 'Riachao do Jacuipe', '28');
INSERT INTO `cidade` VALUES ('323', 'Riacho de Santana', '28');
INSERT INTO `cidade` VALUES ('324', 'Ribeira do Amparo', '28');
INSERT INTO `cidade` VALUES ('325', 'Ribeira do Pombal', '28');
INSERT INTO `cidade` VALUES ('326', 'Ribeirao do Largo', '28');
INSERT INTO `cidade` VALUES ('327', 'Rio Real', '28');
INSERT INTO `cidade` VALUES ('328', 'Rio de Contas', '28');
INSERT INTO `cidade` VALUES ('329', 'Rio do Antonio', '28');
INSERT INTO `cidade` VALUES ('330', 'Rio do Pires', '28');
INSERT INTO `cidade` VALUES ('331', 'Rodelas', '28');
INSERT INTO `cidade` VALUES ('332', 'Ruy Barbosa', '28');
INSERT INTO `cidade` VALUES ('333', 'Salinas da Margarida', '28');
INSERT INTO `cidade` VALUES ('334', 'Salvador', '28');
INSERT INTO `cidade` VALUES ('335', 'Santa Barbara', '28');
INSERT INTO `cidade` VALUES ('336', 'Santa Brigida', '28');
INSERT INTO `cidade` VALUES ('337', 'Santa Cruz Cabralia', '28');
INSERT INTO `cidade` VALUES ('338', 'Santa Cruz da Vitoria', '28');
INSERT INTO `cidade` VALUES ('339', 'Santa Ines', '28');
INSERT INTO `cidade` VALUES ('340', 'Santa Luzia', '28');
INSERT INTO `cidade` VALUES ('341', 'Santa Maria da Vitoria', '28');
INSERT INTO `cidade` VALUES ('342', 'Santa Rita de Cassia', '28');
INSERT INTO `cidade` VALUES ('343', 'Santa Teresinha', '28');
INSERT INTO `cidade` VALUES ('344', 'Santaluz', '28');
INSERT INTO `cidade` VALUES ('345', 'Santana', '28');
INSERT INTO `cidade` VALUES ('346', 'Santanopolis', '28');
INSERT INTO `cidade` VALUES ('347', 'Santo Amaro', '28');
INSERT INTO `cidade` VALUES ('348', 'Santo Antonio de Jesus', '28');
INSERT INTO `cidade` VALUES ('349', 'Santo Estevao', '28');
INSERT INTO `cidade` VALUES ('350', 'Sao Desiderio', '28');
INSERT INTO `cidade` VALUES ('351', 'Sao Domingos', '28');
INSERT INTO `cidade` VALUES ('352', 'Sao Felipe', '28');
INSERT INTO `cidade` VALUES ('353', 'Sao Felix do Coribe', '28');
INSERT INTO `cidade` VALUES ('354', 'Sao Felix', '28');
INSERT INTO `cidade` VALUES ('355', 'Sao Francisco do Conde', '28');
INSERT INTO `cidade` VALUES ('356', 'Sao Gabriel', '28');
INSERT INTO `cidade` VALUES ('357', 'Sao Goncalo dos Campos', '28');
INSERT INTO `cidade` VALUES ('358', 'Sao Jose da Vitoria', '28');
INSERT INTO `cidade` VALUES ('359', 'Sao Jose do Jacuipe', '28');
INSERT INTO `cidade` VALUES ('360', 'Sao Miguel das Matas', '28');
INSERT INTO `cidade` VALUES ('361', 'Sao Sebastiao do Passe', '28');
INSERT INTO `cidade` VALUES ('362', 'Sapeacu', '28');
INSERT INTO `cidade` VALUES ('363', 'Satiro Dias', '28');
INSERT INTO `cidade` VALUES ('364', 'Saubara', '28');
INSERT INTO `cidade` VALUES ('365', 'Saude', '28');
INSERT INTO `cidade` VALUES ('366', 'Seabra', '28');
INSERT INTO `cidade` VALUES ('367', 'Sebastiao Laranjeiras', '28');
INSERT INTO `cidade` VALUES ('368', 'Senhor do Bonfim', '28');
INSERT INTO `cidade` VALUES ('369', 'Sento Se', '28');
INSERT INTO `cidade` VALUES ('370', 'Serra Dourada', '28');
INSERT INTO `cidade` VALUES ('371', 'Serra Preta', '28');
INSERT INTO `cidade` VALUES ('372', 'Serra do Ramalho', '28');
INSERT INTO `cidade` VALUES ('373', 'Serrinha', '28');
INSERT INTO `cidade` VALUES ('374', 'Serrolandia', '28');
INSERT INTO `cidade` VALUES ('375', 'Simoes Filho', '28');
INSERT INTO `cidade` VALUES ('376', 'Sitio do Mato', '28');
INSERT INTO `cidade` VALUES ('377', 'Sitio do Quinto', '28');
INSERT INTO `cidade` VALUES ('378', 'Sobradinho', '28');
INSERT INTO `cidade` VALUES ('379', 'Souto Soares', '28');
INSERT INTO `cidade` VALUES ('380', 'Tabocas do Brejo Velho', '28');
INSERT INTO `cidade` VALUES ('381', 'Tanhacu', '28');
INSERT INTO `cidade` VALUES ('382', 'Tanque Novo', '28');
INSERT INTO `cidade` VALUES ('383', 'Tanquinho', '28');
INSERT INTO `cidade` VALUES ('384', 'Taperoa', '28');
INSERT INTO `cidade` VALUES ('385', 'Tapiramuta', '28');
INSERT INTO `cidade` VALUES ('386', 'Teixeira de Freitas', '28');
INSERT INTO `cidade` VALUES ('387', 'Teodoro Sampaio', '28');
INSERT INTO `cidade` VALUES ('388', 'Teofilandia', '28');
INSERT INTO `cidade` VALUES ('389', 'Teolandia', '28');
INSERT INTO `cidade` VALUES ('390', 'Terra Nova', '28');
INSERT INTO `cidade` VALUES ('391', 'Tremedal', '28');
INSERT INTO `cidade` VALUES ('392', 'Tucano', '28');
INSERT INTO `cidade` VALUES ('393', 'Uaua', '28');
INSERT INTO `cidade` VALUES ('394', 'Ubaira', '28');
INSERT INTO `cidade` VALUES ('395', 'Ubaitaba', '28');
INSERT INTO `cidade` VALUES ('396', 'Ubata', '28');
INSERT INTO `cidade` VALUES ('397', 'Uibai', '28');
INSERT INTO `cidade` VALUES ('398', 'Umburanas', '28');
INSERT INTO `cidade` VALUES ('399', 'Una', '28');
INSERT INTO `cidade` VALUES ('400', 'Urandi', '28');
INSERT INTO `cidade` VALUES ('401', 'Urucuca', '28');
INSERT INTO `cidade` VALUES ('402', 'Utinga', '28');
INSERT INTO `cidade` VALUES ('403', 'Valenca', '28');
INSERT INTO `cidade` VALUES ('404', 'Valente', '28');
INSERT INTO `cidade` VALUES ('405', 'Varzea Nova', '28');
INSERT INTO `cidade` VALUES ('406', 'Varzea da Roca', '28');
INSERT INTO `cidade` VALUES ('407', 'Varzea do Poco', '28');
INSERT INTO `cidade` VALUES ('408', 'Varzedo', '28');
INSERT INTO `cidade` VALUES ('409', 'Vera Cruz', '28');
INSERT INTO `cidade` VALUES ('410', 'Vereda', '28');
INSERT INTO `cidade` VALUES ('411', 'Vitoria da Conquista', '28');
INSERT INTO `cidade` VALUES ('412', 'Wagner', '28');
INSERT INTO `cidade` VALUES ('413', 'Wanderley', '28');
INSERT INTO `cidade` VALUES ('414', 'Wenceslau Guimaraes', '28');
INSERT INTO `cidade` VALUES ('415', 'Xique-Xique', '28');

-- ----------------------------
-- Table structure for convenio
-- ----------------------------
DROP TABLE IF EXISTS `convenio`;
CREATE TABLE `convenio` (
  `ide_convenio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_convenio` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `ide_banco` int(11) DEFAULT NULL,
  `ide_orgao` int(11) DEFAULT NULL,
  `vlr_taxa` decimal(10,2) DEFAULT NULL,
  `des_prazo` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_idade_minima` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_idade_maxima` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_tipo_situacao` int(11) DEFAULT '11',
  `ide_usuario_criador` int(11) DEFAULT NULL,
  `dat_criacao` datetime DEFAULT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  UNIQUE KEY `ide_convenio` (`ide_convenio`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of convenio
-- ----------------------------
INSERT INTO `convenio` VALUES ('2', 'CONSIG. CEF 193', '38', '10', '1.93', '72', '55', '75', '1', '3', '2018-09-01 20:27:48', null, null);
INSERT INTO `convenio` VALUES ('3', 'CONSIG CEF 175', '38', '10', '1.75', '72', '55', '75', '1', '3', '2018-09-01 20:31:17', null, null);
INSERT INTO `convenio` VALUES ('8', 'CONSIG CEF 165', '38', '10', '1.65', '72', '55', '75', '1', '3', '2018-09-01 20:37:58', null, null);

-- ----------------------------
-- Table structure for corretor
-- ----------------------------
DROP TABLE IF EXISTS `corretor`;
CREATE TABLE `corretor` (
  `ide_corretor` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_corretor` varchar(230) COLLATE utf8_unicode_ci NOT NULL,
  `num_cpf` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `dat_nascimento` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `des_email` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_skype` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_endereco` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_endereco` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_complemento` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom_bairro` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_cidade` int(11) NOT NULL,
  `num_cep` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `des_observacao` text COLLATE utf8_unicode_ci,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_corretor` (`ide_corretor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of corretor
-- ----------------------------
INSERT INTO `corretor` VALUES ('1', 'Raine Oliveira da Silva', '68665665170', '19970307', 'rayneaquinooo@gmail.com', null, null, null, null, null, '368', null, 'A', null, '3', '2018-09-01 14:57:16', null, null);

-- ----------------------------
-- Table structure for corretor_banco
-- ----------------------------
DROP TABLE IF EXISTS `corretor_banco`;
CREATE TABLE `corretor_banco` (
  `ide_corretor_banco` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_corretor` int(11) NOT NULL,
  `ide_banco` int(11) NOT NULL,
  `num_agencia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num_conta` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ide_tipo_conta` int(11) NOT NULL,
  `des_observacao` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) NOT NULL,
  `dat_atualizacao` datetime NOT NULL,
  UNIQUE KEY `ide_corretor_banco` (`ide_corretor_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of corretor_banco
-- ----------------------------
INSERT INTO `corretor_banco` VALUES ('1', '1', '38', '0076', '252567', '13', null, '3', '2018-09-03 11:53:29', '3', '2018-09-03 11:53:51');

-- ----------------------------
-- Table structure for corretor_contato
-- ----------------------------
DROP TABLE IF EXISTS `corretor_contato`;
CREATE TABLE `corretor_contato` (
  `ide_corretor_contato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_corretor` int(11) NOT NULL,
  `num_contato` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ide_tipo_contato` int(11) NOT NULL,
  `des_contato` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_operadora` int(11) DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_corretor_contato` (`ide_corretor_contato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of corretor_contato
-- ----------------------------

-- ----------------------------
-- Table structure for estado
-- ----------------------------
DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `ide_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nom_estado` varchar(75) DEFAULT NULL,
  `des_sigla` varchar(5) DEFAULT NULL,
  `ide_pais` int(7) DEFAULT NULL,
  PRIMARY KEY (`ide_estado`),
  KEY `fk_Estado_pais` (`ide_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of estado
-- ----------------------------
INSERT INTO `estado` VALUES ('28', 'Bahia', 'BA', '1');

-- ----------------------------
-- Table structure for notificacao
-- ----------------------------
DROP TABLE IF EXISTS `notificacao`;
CREATE TABLE `notificacao` (
  `ide_notificacao` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `des_elemento` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `ide_elemento` int(11) NOT NULL,
  `ide_tipo_notificacao` int(11) NOT NULL,
  `des_notificacao` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `dat_alarme` datetime DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_notificacao` (`ide_notificacao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of notificacao
-- ----------------------------

-- ----------------------------
-- Table structure for operadora
-- ----------------------------
DROP TABLE IF EXISTS `operadora`;
CREATE TABLE `operadora` (
  `ide_operadora` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_operadora` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ide_operadora`),
  UNIQUE KEY `ide_operadora` (`ide_operadora`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of operadora
-- ----------------------------
INSERT INTO `operadora` VALUES ('1', 'OI');
INSERT INTO `operadora` VALUES ('2', 'CLARO');
INSERT INTO `operadora` VALUES ('3', 'TIM');
INSERT INTO `operadora` VALUES ('4', 'VIVO');

-- ----------------------------
-- Table structure for orgao
-- ----------------------------
DROP TABLE IF EXISTS `orgao`;
CREATE TABLE `orgao` (
  `ide_orgao` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_tipo_orgao` int(11) NOT NULL,
  `nom_orgao` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `des_sigla` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `ide_orgao` (`ide_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of orgao
-- ----------------------------
INSERT INTO `orgao` VALUES ('8', '1', 'PREFEITURA MUNICIPAL DE SENHOR DO BONFIM', 'PMSB');
INSERT INTO `orgao` VALUES ('9', '2', 'POLÍCIA MILITAR DA BAHIA', 'PMBA');
INSERT INTO `orgao` VALUES ('10', '3', 'INSTITUTO NACIONAL DE SEGURIDADE SOCIAL', 'INSS');

-- ----------------------------
-- Table structure for pais
-- ----------------------------
DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `ide_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pais` varchar(60) DEFAULT NULL,
  `des_sigla` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ide_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pais
-- ----------------------------
INSERT INTO `pais` VALUES ('1', 'Brasil', 'BR');

-- ----------------------------
-- Table structure for parceiro
-- ----------------------------
DROP TABLE IF EXISTS `parceiro`;
CREATE TABLE `parceiro` (
  `ide_parceiro` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_parceiro` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `ide_parceiro` (`ide_parceiro`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of parceiro
-- ----------------------------
INSERT INTO `parceiro` VALUES ('1', 'CAIXA ECONÔMICA FEDERAL');
INSERT INTO `parceiro` VALUES ('2', 'SICOB');

-- ----------------------------
-- Table structure for pessoa
-- ----------------------------
DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE `pessoa` (
  `ide_pessoa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_pessoa` varchar(230) COLLATE utf8_unicode_ci NOT NULL,
  `des_apelido` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_cpf` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `dat_nascimento` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `des_email` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_observacao` text COLLATE utf8_unicode_ci,
  `des_falecido` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `des_endereco` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_endereco` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_complemento` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom_bairro` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_cidade` int(11) NOT NULL,
  `num_cep` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_estrela` int(11) DEFAULT '0',
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_pessoa` (`ide_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa
-- ----------------------------
INSERT INTO `pessoa` VALUES ('159', 'ANALIA ALVES LIMA', 'ANALIA', '56888333515', '19351030', 'naotem@gmail.com', null, 'D', 'RUA ENGENHEIRO BAMBERG ', '22', 'CASA', null, '368', '48970000', '0', '3', '2018-08-29 10:41:38', null, null);
INSERT INTO `pessoa` VALUES ('160', 'AILDA TERENCIO DE MATOS', null, '20369956591', '19570422', 'naotem@gmail.com', null, 'D', 'TRAVESSA FRANCISCO JACINTO', '60', 'CASA', 'ALTO DA MARAVILHA', '368', '48970000', '0', '3', '2018-09-01 10:37:24', null, null);

-- ----------------------------
-- Table structure for pessoa_banco
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_banco`;
CREATE TABLE `pessoa_banco` (
  `ide_pessoa_banco` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `ide_banco` int(11) NOT NULL,
  `num_agencia` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num_conta` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ide_tipo_conta` int(11) NOT NULL,
  `des_observacao` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_banco` (`ide_pessoa_banco`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_banco
-- ----------------------------
INSERT INTO `pessoa_banco` VALUES ('1', '159', '2', '1234', '12345', '1', 'teste testes', '3', '2018-09-04 09:33:04', null, null);

-- ----------------------------
-- Table structure for pessoa_consulta
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_consulta`;
CREATE TABLE `pessoa_consulta` (
  `ide_pessoa_consulta` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `ide_pessoa_orgao` int(11) NOT NULL,
  `dat_competencia` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `vlr_margem_disponivel` decimal(10,2) DEFAULT NULL,
  `des_observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `vlr_mensalidade_reajustada` decimal(10,2) DEFAULT NULL,
  `vlr_comp_mr` decimal(10,2) DEFAULT NULL,
  `vlr_salario_familia` decimal(10,2) DEFAULT NULL,
  `vlr_grat_excomb` decimal(10,2) DEFAULT NULL,
  `vlr_rffsa_nao_trib` decimal(10,2) DEFAULT NULL,
  `vlr_compl_acompan` decimal(10,2) DEFAULT NULL,
  `vlr_outras_vantagens` decimal(10,2) DEFAULT NULL,
  `vlr_plansfer_rffsa` decimal(10,2) DEFAULT NULL,
  `vlr_dupla_atividade` decimal(10,2) DEFAULT NULL,
  `vlr_grat_produt_ect` decimal(10,2) DEFAULT NULL,
  `vlr_adic_talidomida` decimal(10,2) DEFAULT NULL,
  `vlr_ir_retido_fonte` decimal(10,2) DEFAULT NULL,
  `vlr_deb_pensao_alim` decimal(10,2) DEFAULT NULL,
  `vlr_consignacao` decimal(10,2) DEFAULT NULL,
  `vlr_ir_exterior` decimal(10,2) DEFAULT NULL,
  `vlr_debito_dif_ir` decimal(10,2) DEFAULT NULL,
  `vlr_desconto_inss` decimal(10,2) DEFAULT NULL,
  `vlr_total_contribuicao` decimal(10,2) DEFAULT NULL,
  `des_automatica` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_consulta` (`ide_pessoa_consulta`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_consulta
-- ----------------------------
INSERT INTO `pessoa_consulta` VALUES ('1', '159', '1', '201809', '224.80', null, 'A', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'D', '3', '2018-09-01 09:08:05', null, null);
INSERT INTO `pessoa_consulta` VALUES ('2', '160', '2', '201809', '286.30', null, 'A', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'D', '3', '2018-09-01 10:40:01', null, null);
INSERT INTO `pessoa_consulta` VALUES ('3', '159', '1', '201809', '345.55', null, 'A', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'D', '3', '2018-09-04 10:28:53', null, null);
INSERT INTO `pessoa_consulta` VALUES ('4', '159', '1', '201809', '1400.00', '', 'A', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'D', '3', '2018-09-04 11:33:39', '3', '2018-09-04 11:45:54');
INSERT INTO `pessoa_consulta` VALUES ('5', '159', '1', '201809', '480.00', null, 'A', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, 'D', '3', '2018-09-04 17:45:01', null, null);

-- ----------------------------
-- Table structure for pessoa_consulta_emprestimo
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_consulta_emprestimo`;
CREATE TABLE `pessoa_consulta_emprestimo` (
  `ide_pessoa_consulta_emprestimo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa_consulta_emprestimo_origem` int(11) DEFAULT NULL,
  `ide_pessoa_consulta_emprestimo_destino` int(11) DEFAULT NULL,
  `ide_pessoa_consulta` int(11) NOT NULL,
  `ide_convenio` int(11) DEFAULT NULL,
  `num_total_parcela` int(11) DEFAULT NULL,
  `ide_pessoa_contrato` int(11) DEFAULT NULL,
  `num_contrato` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_inicio_contrato` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vlr_parcela` decimal(10,2) NOT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `des_observacao` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_congelado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `dat_prazo_congelamento` datetime DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_consulta_emprestimo` (`ide_pessoa_consulta_emprestimo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_consulta_emprestimo
-- ----------------------------
INSERT INTO `pessoa_consulta_emprestimo` VALUES ('1', null, null, '4', null, null, null, null, null, '450.00', 'A', 'BMG', 'D', null, '3', '2018-09-04 11:33:39', null, null);
INSERT INTO `pessoa_consulta_emprestimo` VALUES ('2', null, null, '1', '2', '48', '1', '12345', '20180904', '145.00', 'A', null, 'D', null, '3', '2018-09-04 17:16:39', null, null);

-- ----------------------------
-- Table structure for pessoa_contato
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_contato`;
CREATE TABLE `pessoa_contato` (
  `ide_pessoa_contato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `num_contato` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `ide_tipo_contato` int(11) NOT NULL,
  `des_contato` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `ide_operadora` int(11) DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_contato` (`ide_pessoa_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_contato
-- ----------------------------
INSERT INTO `pessoa_contato` VALUES ('1', '159', '74999190845', '3', 'teste', '4', '3', '2018-09-01 21:02:46', null, null);

-- ----------------------------
-- Table structure for pessoa_contrato
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_contrato`;
CREATE TABLE `pessoa_contrato` (
  `ide_pessoa_contrato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `ide_pessoa_orgao` int(11) NOT NULL,
  `ide_convenio` int(11) NOT NULL,
  `ide_pessoa_consulta_emprestimo` int(11) DEFAULT NULL,
  `ide_tipo_contrato` int(11) NOT NULL,
  `ide_parceiro` int(11) NOT NULL,
  `num_contrato` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `num_proposta` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_inicio_contrato` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dat_cadastro_contrato` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_observacao` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ide_tipo_situacao` int(11) NOT NULL,
  `dat_tipo_situacao` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vlr_bruto` decimal(10,2) NOT NULL,
  `vlr_liquido` decimal(10,2) NOT NULL,
  `vlr_parcela` decimal(10,2) NOT NULL,
  `num_total_parcela` int(11) NOT NULL,
  `vlr_taxa_juros` decimal(10,2) NOT NULL,
  `vlr_taxa_comissao` decimal(10,2) NOT NULL,
  `vlr_comissao_contrato` decimal(10,2) NOT NULL,
  `vlr_comissao_receber` decimal(10,2) DEFAULT NULL,
  `vlr_comissao_pagar` decimal(10,2) DEFAULT NULL,
  `ide_corretor` int(11) DEFAULT NULL,
  `ide_corretor_banco` int(11) DEFAULT NULL,
  `dat_pagamento_corretor` int(11) DEFAULT NULL,
  `vlr_taxa_corretor` int(11) DEFAULT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `des_comissionado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `dat_pagamento_comissao` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_entrega_fisico` datetime DEFAULT NULL,
  `num_protocolo_entrega` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_contrato` (`ide_pessoa_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_contrato
-- ----------------------------
INSERT INTO `pessoa_contrato` VALUES ('1', '159', '1', '2', null, '1', '1', '12345', '1234', '20180904', '20180904', 'teste', '1', '20180904', '3000.00', '3000.00', '145.00', '48', '1.93', '2.00', '60.00', '45.00', '15.00', '1', '1', '20180904', '1', 'A', 'A', null, null, null, '2018-09-04 17:16:39', '3', null, null);

-- ----------------------------
-- Table structure for pessoa_convenio
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_convenio`;
CREATE TABLE `pessoa_convenio` (
  `ide_pessoa_convenio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `ide_convenio` int(11) NOT NULL,
  `des_observacao` varchar(115) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_convenio` (`ide_pessoa_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_convenio
-- ----------------------------

-- ----------------------------
-- Table structure for pessoa_orgao
-- ----------------------------
DROP TABLE IF EXISTS `pessoa_orgao`;
CREATE TABLE `pessoa_orgao` (
  `ide_pessoa_orgao` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_pessoa` int(11) NOT NULL,
  `ide_orgao` int(11) NOT NULL,
  `num_matricula` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `des_login` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_senha` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `des_credencial_publica` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'D',
  `ide_tipo_situacao` int(11) NOT NULL,
  `ide_tipo_especie_beneficio` int(11) NOT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` datetime NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` datetime DEFAULT NULL,
  UNIQUE KEY `ide_pessoa_orgao` (`ide_pessoa_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pessoa_orgao
-- ----------------------------
INSERT INTO `pessoa_orgao` VALUES ('1', '159', '10', '0285355651', null, null, 'D', '1', '3', '3', '2018-09-01 09:05:06', null, null);
INSERT INTO `pessoa_orgao` VALUES ('2', '160', '10', '1543907617', null, null, 'D', '1', '3', '3', '2018-09-01 10:38:58', null, null);

-- ----------------------------
-- Table structure for tipo_contato
-- ----------------------------
DROP TABLE IF EXISTS `tipo_contato`;
CREATE TABLE `tipo_contato` (
  `ide_tipo_contato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipo_contato` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `ide_tipo_contato` (`ide_tipo_contato`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_contato
-- ----------------------------
INSERT INTO `tipo_contato` VALUES ('1', 'Residencial');
INSERT INTO `tipo_contato` VALUES ('2', 'Comercial');
INSERT INTO `tipo_contato` VALUES ('3', 'Celular');

-- ----------------------------
-- Table structure for tipo_contrato
-- ----------------------------
DROP TABLE IF EXISTS `tipo_contrato`;
CREATE TABLE `tipo_contrato` (
  `ide_tipo_contrato` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipo_contrato` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `ide_tipo_contrato` (`ide_tipo_contrato`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_contrato
-- ----------------------------
INSERT INTO `tipo_contrato` VALUES ('1', 'Contrato NOVO');
INSERT INTO `tipo_contrato` VALUES ('2', 'Refinanciamento');
INSERT INTO `tipo_contrato` VALUES ('3', 'Portabilidade');

-- ----------------------------
-- Table structure for tipo_especie_beneficio
-- ----------------------------
DROP TABLE IF EXISTS `tipo_especie_beneficio`;
CREATE TABLE `tipo_especie_beneficio` (
  `ide_tipo_especie_beneficio` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ide_orgao` int(11) NOT NULL,
  `num_codigo` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `nom_tipo_especie_beneficio` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  UNIQUE KEY `ide_especie_beneficio` (`ide_tipo_especie_beneficio`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_especie_beneficio
-- ----------------------------
INSERT INTO `tipo_especie_beneficio` VALUES ('1', '10', '07', 'Aposentadoria por idade do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('2', '10', '08', 'Aposentadoria por idade do empregador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('3', '10', '41', 'Aposentadoria por idade', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('4', '10', '52', 'Aposentadoria por idade (Extinto Plano Básico)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('5', '10', '78', 'Aposentadoria por idade de ex-combatente marítimo (Lei nº 1.756/52)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('6', '10', '81', 'Aposentadoria por idade compulsória (Ex-SASSE)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('7', '10', '04', 'Aposentadoria por invalidez do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('8', '10', '06', 'Aposentadoria por invalidez do empregador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('9', '10', '32', 'Aposentadoria por invalidez previdenciária', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('10', '10', '33', 'Aposentadoria por invalidez de aeronauta', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('11', '10', '34', 'Aposentadoria por invalidez de ex-combatente marítimo (Lei nº 1.756/52)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('12', '10', '51', 'Aposentadoria por invalidez (Extinto Plano Básico)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('13', '10', '83', 'Aposentadoria por invalidez (Ex-SASSE)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('14', '10', '42', 'Aposentadoria por tempo de contribuição previdenciária', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('15', '10', '43', 'Aposentadoria por tempo de contribuição de ex-combatente', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('16', '10', '44', 'Aposentadoria por tempo de contribuição de aeronauta', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('17', '10', '45', 'Aposentadoria por tempo de contribuição de jornalista profissional', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('18', '10', '46', 'Aposentadoria por tempo de contribuição especial', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('19', '10', '49', 'Aposentadoria por tempo de contribuição ordinária', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('20', '10', '57', 'Aposentadoria por tempo de contribuição de professor (Emenda Const.18/81)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('21', '10', '72', 'Apos. por tempo de contribuição de ex-combatente marítimo (Lei 1.756/52)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('22', '10', '82', 'Aposentadoria por tempo de contribuição (Ex-SASSE)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('23', '10', '01', 'Pensão por morte do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('24', '10', '03', 'Pensão por morte do empregador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('25', '10', '21', 'Pensão por morte previdenciária', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('26', '10', '23', 'Pensão por morte de ex-combatente', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('27', '10', '27', 'Pensão por morte de servidor público federal com dupla aposentadoria', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('28', '10', '28', 'Pensão por morte do Regime Geral (Decreto nº 20.465/31)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('29', '10', '29', 'Pensão por morte de ex-combatente marítimo (Lei nº 1.756/52)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('30', '10', '55', 'Pensão por morte (Extinto Plano Básico)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('31', '10', '84', 'Pensão por morte (Ex-SASSE)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('32', '10', '13', 'Auxílio-doença do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('33', '10', '15', 'Auxílio-reclusão do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('34', '10', '25', 'Auxílio-reclusão', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('35', '10', '31', 'Auxílio-doença previdenciário', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('36', '10', '36', 'Auxílio Acidente', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('37', '10', '50', 'Auxílio-doença  (Extinto Plano Básico)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('38', '10', '02', 'Pensão por morte por acidente do trabalho do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('39', '10', '05', 'Aposentadoria por invalidez por acidente do trabalho do trabalhador Rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('40', '10', '10', 'Auxílio-doença por acidente do trabalho do trabalhador rural', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('41', '10', '91', 'Auxílio-doença por acidente do trabalho', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('42', '10', '92', 'Aposentadoria por invalidez por acidente do trabalho', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('43', '10', '93', 'Pensão por morte por acidente do trabalho', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('44', '10', '94', 'Auxílio-acidente por acidente do trabalho', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('45', '10', '95', 'Auxílio-suplementar por acidente do trabalho', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('46', '10', '11', 'Renda mensal vitalícia por invalidez do trabalhador rural (Lei nº 6.179/74)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('47', '10', '12', 'Renda mensal vitalícia por idade do trabalhador rural (Lei nº 6.179/74)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('48', '10', '30', 'Renda mensal vitalícia por invalidez (Lei nº 6179/74)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('49', '10', '40', 'Renda mensal vitalícia por idade (Lei nº 6.179/74)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('50', '10', '85', 'Pensão mensal vitalícia do seringueiro (Lei nº 7.986/89)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('51', '10', '86', 'Pensão mensal vitalícia do dep.do seringueiro (Lei nº 7.986/89)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('52', '10', '87', 'Amparo assistencial ao portador de deficiência (LOAS)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('53', '10', '88', 'Amparo assistencial ao idoso (LOAS)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('54', '10', '47', 'Abono de permanência em serviço 25%', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('55', '10', '48', 'Abono de permanência em serviço 20%', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('56', '10', '68', 'Pecúlio especial de aposentadoria', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('57', '10', '79', 'Abono de servidor aposentado pela autarquia empr.(Lei 1.756/52)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('58', '10', '80', 'Salário-maternidade', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('59', '10', '22', 'Pensão por morte estatutária', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('60', '10', '26', 'Pensão Especial (Lei nº 593/48)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('61', '10', '37', 'Aposentadoria de extranumerário da União', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('62', '10', '38', 'Aposentadoria da extinta CAPIN', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('63', '10', '54', 'Pensão especial vitalícia (Lei nº 9.793/99)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('64', '10', '56', 'Pensão mensal vitalícia por síndrome de talidomida (Lei nº 7.070/82)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('65', '10', '58', 'Aposentadoria excepcional do anistiado (Lei nº 6.683/79)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('66', '10', '59', 'Pensão por morte excepcional do anistiado (Lei nº 6.683/79)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('67', '10', '60', 'Pensão especial mensal vitalícia (Lei 10.923, de 24/07/2004)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('68', '10', '76', 'Salário-família estatutário da RFFSA (Decreto-lei nº 956/69)', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('69', '10', '89', 'Pensão especial aos depedentes de vítimas fatais p/ contaminação na hemodiálise', 'A');
INSERT INTO `tipo_especie_beneficio` VALUES ('70', '10', '96', 'Pensão especial às pessoas atingidas pela hanseníase (Lei nº 11.520/2007)', 'A');

-- ----------------------------
-- Table structure for tipo_orgao
-- ----------------------------
DROP TABLE IF EXISTS `tipo_orgao`;
CREATE TABLE `tipo_orgao` (
  `ide_tipo_orgao` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipo_orgao` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `ide_tipo_situacao` int(11) NOT NULL,
  UNIQUE KEY `ide_orgao` (`ide_tipo_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_orgao
-- ----------------------------
INSERT INTO `tipo_orgao` VALUES ('1', 'MUNICIPAL', '1');
INSERT INTO `tipo_orgao` VALUES ('2', 'ESTADUAL', '1');
INSERT INTO `tipo_orgao` VALUES ('3', 'FEDERAL', '1');

-- ----------------------------
-- Table structure for tipo_situacao
-- ----------------------------
DROP TABLE IF EXISTS `tipo_situacao`;
CREATE TABLE `tipo_situacao` (
  `ide_tipo_situacao` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nom_tipo_situacao` varchar(115) COLLATE utf8_unicode_ci NOT NULL,
  `des_status` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  UNIQUE KEY `ide_tipo_situacao` (`ide_tipo_situacao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tipo_situacao
-- ----------------------------
INSERT INTO `tipo_situacao` VALUES ('1', 'Ativo', 'A');
INSERT INTO `tipo_situacao` VALUES ('2', 'Desligado', 'A');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ide_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(200) NOT NULL,
  `des_email` varchar(150) NOT NULL,
  `des_senha` varchar(32) NOT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('3', 'samuel', 'samuca.guimaraes@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'A');
