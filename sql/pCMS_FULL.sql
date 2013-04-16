-- ----------------------------
-- Table structure for navigation
-- ----------------------------
CREATE TABLE `navigation` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for page_content
-- ----------------------------
CREATE TABLE `page_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `variable` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `style_id` int(10) NOT NULL,
  `template_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for plugin_scripts
-- ----------------------------
CREATE TABLE `plugin_scripts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `script` varchar(255) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for plugins
-- ----------------------------
CREATE TABLE `plugins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `repo` varchar(255) NOT NULL,
  `installed` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for style_attribute
-- ----------------------------
CREATE TABLE `style_attribute` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for style_declaration
-- ----------------------------
CREATE TABLE `style_declaration` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for styles
-- ----------------------------
CREATE TABLE `styles` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for templates
-- ----------------------------
CREATE TABLE `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for user
-- ----------------------------
CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `navigation` VALUES ('1', 'Home', '?p=home');
INSERT INTO `navigation` VALUES ('2', 'Bilder', '?p=gallery');
INSERT INTO `navigation` VALUES ('3', 'Github', 'https://github.com/PatrickFarnkopf');
INSERT INTO `navigation` VALUES ('4', 'Impressum', '?p=impressum');
INSERT INTO `page_content` VALUES ('1', '1', 'SITE_TITLE', 'pCMS | Default');
INSERT INTO `page_content` VALUES ('2', '1', 'MAIN_CONTENT', 'Willkommen auf der Default Seite von pCMS!');
INSERT INTO `page_content` VALUES ('3', '1', 'SITE_LOGO', '<h1>pCMS Default Page</h1>');
INSERT INTO `pages` VALUES ('1', 'Default', '1', '1');
INSERT INTO `plugins` VALUES ('1', 'Demo', '0.1', '', '0');
INSERT INTO `style_attribute` VALUES ('1', '1', 'background-color', '#00ffef');
INSERT INTO `style_attribute` VALUES ('2', '1', 'color', '#ff0000');
INSERT INTO `style_attribute` VALUES ('3', '1', 'text-align', 'center');
INSERT INTO `style_attribute` VALUES ('6', '2', 'background-color', '#DDDDDD');
INSERT INTO `style_attribute` VALUES ('7', '2', 'width', '70%');
INSERT INTO `style_attribute` VALUES ('8', '2', 'height', '400px');
INSERT INTO `style_attribute` VALUES ('9', '2', 'border-radius', '8px');
INSERT INTO `style_attribute` VALUES ('10', '2', 'border', '1px solid black');
INSERT INTO `style_attribute` VALUES ('11', '2', 'box-shadow', '0 0 9px black');
INSERT INTO `style_attribute` VALUES ('12', '2', 'color', '#333333');
INSERT INTO `style_attribute` VALUES ('13', '2', 'margin', '0px auto');
INSERT INTO `style_attribute` VALUES ('14', '3', 'margin', '6px auto');
INSERT INTO `style_attribute` VALUES ('15', '3', 'padding', '7px 6px 0');
INSERT INTO `style_attribute` VALUES ('17', '3', 'line-height', '100%');
INSERT INTO `style_attribute` VALUES ('18', '3', 'border-radius', '2em');
INSERT INTO `style_attribute` VALUES ('19', '4', 'margin', '0 5px');
INSERT INTO `style_attribute` VALUES ('20', '4', 'padding', '0 0 8px');
INSERT INTO `style_attribute` VALUES ('21', '4', 'float', 'left');
INSERT INTO `style_attribute` VALUES ('22', '4', 'position', 'relative');
INSERT INTO `style_attribute` VALUES ('23', '4', 'list-style', 'none');
INSERT INTO `style_attribute` VALUES ('24', '5', 'font-weight', 'bold');
INSERT INTO `style_attribute` VALUES ('25', '5', 'color', '#555555');
INSERT INTO `style_attribute` VALUES ('26', '5', 'text-decoration', 'none');
INSERT INTO `style_attribute` VALUES ('27', '5', 'display', 'block');
INSERT INTO `style_attribute` VALUES ('28', '5', 'padding', '8px 20px');
INSERT INTO `style_attribute` VALUES ('29', '5', 'margin', '0');
INSERT INTO `style_attribute` VALUES ('30', '5', 'border-radius', '1.6em');
INSERT INTO `style_attribute` VALUES ('31', '3', 'height', '40px');
INSERT INTO `style_attribute` VALUES ('32', '3', 'background-color', '#ddd');
INSERT INTO `style_attribute` VALUES ('33', '3', 'width', '70%');
INSERT INTO `style_declaration` VALUES ('1', '1', 'body', '');
INSERT INTO `style_declaration` VALUES ('2', '1', '#main', '');
INSERT INTO `style_declaration` VALUES ('3', '1', '#nav', '');
INSERT INTO `style_declaration` VALUES ('4', '1', '#nav li', '');
INSERT INTO `style_declaration` VALUES ('5', '1', '#nav a', '');
INSERT INTO `styles` VALUES ('1', 'Default', './css/default.css');
INSERT INTO `templates` VALUES ('1', 'Default', './includes/Templates/template_one.tpl');
INSERT INTO `user` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', 'demo@demo.de');
