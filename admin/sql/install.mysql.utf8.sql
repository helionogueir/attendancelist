/* Attendance List */
DROP TABLE IF EXISTS `#__attendancelist`;
CREATE TABLE IF NOT EXISTS `#__attendancelist` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(45) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_code` (`code`),
    INDEX `ind_attendancelist_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Step */
DROP TABLE IF EXISTS `#__attendancelist_step`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_step` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`attendancelist_id` BIGINT(18) NOT NULL,
	`position` TINYINT(4) NOT NULL,
	`title` VARCHAR(100) NOT NULL,
	`obs` TEXT NULL,
	`setting` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_step_attendancelist_id` (`attendancelist_id`),
    INDEX `ind_attendancelist_step_position` (`position`),
    UNIQUE INDEX `unq_attendancelist_step_position` (`attendancelist_id`, `position`),
    INDEX `ind_attendancelist_step_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Category */
DROP TABLE IF EXISTS `#__attendancelist_category`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_category` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`attendancelist_id` BIGINT(18) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`parent` BIGINT(18) NULL DEFAULT NULL,
	`name` VARCHAR(255) NOT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_category_attendancelist_id` (`attendancelist_id`),
    INDEX `ind_attendancelist_category_code` (`code`),
    UNIQUE INDEX `unq_attendancelist_category_code` (`parent`, `code`),
    INDEX `ind_attendancelist_category_parent` (`parent`),
    INDEX `ind_attendancelist_category_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Category Target */
DROP TABLE IF EXISTS `#__attendancelist_category_target`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_category_target` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`category_id` BIGINT(18) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`title` VARCHAR(255) NOT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_category_target_id` (`category_id`),
    INDEX `ind_attendancelist_category_target_code` (`code`),
    UNIQUE INDEX `unq_attendancelist_category_target_code` (`category_id`, `code`),
    INDEX `ind_attendancelist_category_target_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Quiz */
DROP TABLE IF EXISTS `#__attendancelist_quiz`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_quiz` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`attendancelist_id` BIGINT(18) NOT NULL,
	`position` TINYINT(4) NOT NULL,
	`type` VARCHAR(25) NOT NULL,
	`question` TEXT NOT NULL,
	`obs` TEXT NULL,
	`setting` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_quiz_attendancelist_id` (`attendancelist_id`),
    INDEX `ind_attendancelist_quiz_position` (`position`),
    UNIQUE INDEX `unq_attendancelist_quiz_position` (`attendancelist_id`, `position`),
    INDEX `ind_attendancelist_quiz_type` (`type`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Quiz Alternative */
DROP TABLE IF EXISTS `#__attendancelist_quiz_alternative`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_quiz_alternative` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`quiz_id` BIGINT(18) NOT NULL,
	`position` TINYINT(4) NOT NULL,
	`alternative` TEXT NOT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_quiz_alternative_quiz_id` (`quiz_id`),
    INDEX `ind_attendancelist_quiz_alternative_position` (`position`),
    UNIQUE INDEX `unq_attendancelist_quiz_alternative_position` (`quiz_id`, `position`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Feedback */
DROP TABLE IF EXISTS `#__attendancelist_feedback`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_feedback` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`date` DATE NOT NULL,
	`timestart` TIME NULL,
	`timefinish` TIME NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_feedback_user_id` (`user_id`),
    INDEX `ind_attendancelist_feedback_date` (`date`),
    INDEX `ind_attendancelist_feedback_timestart` (`timestart`),
    INDEX `ind_attendancelist_feedback_timefinish` (`timefinish`),
    INDEX `ind_attendancelist_feedback_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Feedback Quiz */
DROP TABLE IF EXISTS `#__attendancelist_feedback_quiz`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_feedback_quiz` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`feedback_id` BIGINT(18) NOT NULL,
	`question` TEXT NOT NULL,
	`answer` TEXT NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_feedback_quiz_feedback_id` (`feedback_id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Feedback Presence */
DROP TABLE IF EXISTS `#__attendancelist_feedback_presence`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_feedback_presence` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`feedback_id` BIGINT(18) NOT NULL,
	`target_id` BIGINT(18) NOT NULL,
	`present` ENUM('0','1') NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_feedback_presence_feedback_id` (`feedback_id`),
    INDEX `ind_attendancelist_feedback_presence_target_id` (`target_id`),
    INDEX `ind_attendancelist_feedback_presence_present` (`present`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;