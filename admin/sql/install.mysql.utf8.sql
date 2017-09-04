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
    INDEX `ind_attendancelist_category_code` (`code`),
    INDEX `ind_attendancelist_category_attendancelist_id` (`attendancelist_id`),
    INDEX `ind_attendancelist_category_parent` (`parent`),
    INDEX `ind_attendancelist_category_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Student */
DROP TABLE IF EXISTS `#__attendancelist_student`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_student` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`category_id` BIGINT(18) NOT NULL,
	`code` VARCHAR(45) NOT NULL,
	`genre` ENUM('F','M') NULL DEFAULT NULL,
	`firstname` VARCHAR(255) NOT NULL,
	`lastname` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL,
	`obs` TEXT NULL,
	`created` DATETIME NOT NULL,
	`modified` DATETIME NOT NULL,
	`published` TINYINT(1) NOT NULL DEFAULT '1',
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_student_code` (`code`),
    INDEX `ind_attendancelist_category_category_id` (`category_id`),
    INDEX `ind_attendancelist_student_genre` (`genre`),
    INDEX `ind_attendancelist_student_published` (`published`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

/* Attendance List Student Attendance */
DROP TABLE IF EXISTS `#__attendancelist_student_attendance`;
CREATE TABLE IF NOT EXISTS `#__attendancelist_student_attendance` (
	`id` BIGINT(18) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`student_id` BIGINT(18) NOT NULL,
	`present` ENUM('0','1') NOT NULL,
	`created` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `ind_attendancelist_student_attendance_user_id` (`user_id`),
    INDEX `ind_attendancelist_student_attendance_student_id` (`student_id`),
    INDEX `ind_attendancelist_student_attendance_present` (`present`),
    INDEX `ind_attendancelist_student_attendance_created` (`created`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;