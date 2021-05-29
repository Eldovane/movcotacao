/*
Navicat MySQL Data Transfer

Source Server         : srv
Source Server Version : 80017
Source Host           : localhost:3306
Source Database       : ibcotacao

Target Server Type    : MYSQL
Target Server Version : 80017
File Encoding         : 65001

Date: 2021-03-15 15:31:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `movcotacao`
-- ----------------------------
DROP TABLE IF EXISTS `movcotacao`;
CREATE TABLE `movcotacao` (
  `id` int(11) NOT NULL,
  `idsku` varchar(50) DEFAULT NULL,
  `idreferencia` varchar(50) DEFAULT NULL,
  `descricao_produto` varchar(150) DEFAULT NULL,
  `quantidadeproduto` float DEFAULT NULL,
  `valorofertado` float DEFAULT NULL,
  `observacao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of movcotacao
-- ----------------------------
INSERT INTO movcotacao VALUES ('1', 'A', 'A1', 'A1-TESTE', '1', null, null);
INSERT INTO movcotacao VALUES ('2', 'B', 'B2', 'B2-TESTE', '2', null, null);
INSERT INTO movcotacao VALUES ('3', 'C', 'C3', 'C3-TESTE', '3', null, null);
INSERT INTO movcotacao VALUES ('4', 'D', 'D4', 'D4-TESTE', '4', null, null);
INSERT INTO movcotacao VALUES ('5', 'E', 'E5', 'E5-TESTE', '5', null, null);
INSERT INTO movcotacao VALUES ('6', 'F', 'F6', 'F6-TESTE', '6', null, null);
INSERT INTO movcotacao VALUES ('7', 'G', 'G7', 'G7-TESTE', '7', null, null);
INSERT INTO movcotacao VALUES ('8', 'H', 'H8', 'H8-TESTE', '8', null, null);
INSERT INTO movcotacao VALUES ('9', 'I', 'I9', 'I9-TESTE', '9', null, null);
INSERT INTO movcotacao VALUES ('10', 'J', 'J10', 'J10-TESTE', '10', '0', 't');
