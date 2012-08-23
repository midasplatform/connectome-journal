CREATE TABLE IF NOT EXISTS `journal_journal` (
  `journal_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `community_id` bigint(20) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`journal_id`)
)   DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `journal_issue` (
  `issue_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `journal_id` bigint(20) NOT NULL,
  `folder_id` bigint(20) NOT NULL,
  PRIMARY KEY (`issue_id`)
)   DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `journal_paper` (
  `paper_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `issue_id` bigint(20) NOT NULL,
  `folder_id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `abstract` text NOT NULL,
  `paper_item_id` bigint(20) NOT NULL,
  `status` bigint(20) NOT NULL,
  `script_item_id` bigint(20),
  PRIMARY KEY (`paper_id`)
)   DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `journal_author` (
  `author_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paper_id` bigint(20) NOT NULL,
  `author_firstname` text NOT NULL,
  `author_middlename` text,
  `author_lastname` text NOT NULL,
  `author_order` bigint(20) NOT NULL,
  PRIMARY KEY (`author_id`)
)   DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `journal_keyword` (
  `keyword_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `paper_id` bigint(20) NOT NULL,
  `keyword` text NOT NULL,
  `keyword_order` bigint(20) NOT NULL,
  PRIMARY KEY (`keyword_id`)
)   DEFAULT CHARSET=utf8;
