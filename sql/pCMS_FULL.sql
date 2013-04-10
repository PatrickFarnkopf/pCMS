CREATE TABLE `page_content` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL,
  `variable` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE TABLE `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `style_id` int(10) NOT NULL,
  `template_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `style_attribute` (
  `id` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `style_declaration` (
  `id` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `styles` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `page_content` VALUES ('1', '1', 'SITE_TITLE', 'pCMS | Default');
INSERT INTO `page_content` VALUES ('2', '1', 'BOX_ONE_CONTENT', 'Willkommen auf der Default Seite von pCMS!');
INSERT INTO `pages` VALUES ('1', 'Default', '1', '1');
INSERT INTO `style_attribute` VALUES ('1', '1', 'background-color', 'darkblue');
INSERT INTO `style_attribute` VALUES ('2', '1', 'color', 'white');
INSERT INTO `style_attribute` VALUES ('3', '1', 'text-align', 'center');
INSERT INTO `style_attribute` VALUES ('4', '2', 'margin-top', '150px');
INSERT INTO `style_declaration` VALUES ('1', '1', 'body');
INSERT INTO `style_declaration` VALUES ('2', '1', '.box_one');
INSERT INTO `styles` VALUES ('1', 'Default', './css/default.css');
INSERT INTO `templates` VALUES ('1', 'Default', './includes/Templates/template_one.tpl');
INSERT INTO `user` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', 'patrickfarnkopf4@gmx.de');
