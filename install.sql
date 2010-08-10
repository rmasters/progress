--
-- Table structure for table `Goal`
--

DROP TABLE IF EXISTS `Goal`;
CREATE TABLE `Goal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value_mask` text,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `GoalStatus`
--

DROP TABLE IF EXISTS `GoalStatus`;
CREATE TABLE `GoalStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goal` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
