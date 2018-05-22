DROP TABLE IF EXISTS `c`;

CREATE TABLE `c` (
  `Cno` varchar(10) NOT NULL,
  `Cname` varchar(10) NOT NULL,
  `Ccredit` int(10) NOT NULL,
  PRIMARY KEY (`Cno`),
  UNIQUE KEY `Cname` (`Cname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `s`;

CREATE TABLE `s` (
  `Sno` int(10) NOT NULL,
  `Sname` varchar(10) NOT NULL,
  `Ssex` enum('男','女') NOT NULL,
  `Sage` int(10) NOT NULL,
  `Sdept` varchar(10) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `sc`;

CREATE TABLE `sc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Sno` int(10) NOT NULL,
  `Cno` varchar(10) NOT NULL,
  `Grade` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Sno` (`Sno`),
  KEY `Cno` (`Cno`),
  CONSTRAINT `sc_ibfk_1` FOREIGN KEY (`Sno`) REFERENCES `s` (`Sno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sc_ibfk_2` FOREIGN KEY (`Cno`) REFERENCES `c` (`Cno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
