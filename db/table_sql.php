ALTER TABLE `ticket_bookings` ADD `back_side_passport` VARCHAR(255) NULL AFTER `upload_passport`, ADD `upload_visa` VARCHAR(255) NULL AFTER `back_side_passport`;

ALTER TABLE `ticket_bookings` CHANGE `upload_passport` `front_side_passport` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `onward_city_other` `onward_city` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL, CHANGE `return_city_other` `return_city` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `user_account_details` ADD `pancard_link_with_adhar` TINYINT(1) NULL AFTER `pancard_number`;