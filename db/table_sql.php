ALTER TABLE `curators` ADD `serendipity_arts_festival` VARCHAR(255) NULL AFTER `name`;

ALTER TABLE `ticket_bookings` CHANGE `project_id` `project_ids` VARCHAR(255) NULL DEFAULT NULL;

ALTER TABLE `ticket_bookings` ADD `onward_date` DATE NULL AFTER `upload_passport`, ADD `return_date` DATE NULL AFTER `onward_date`;

ALTER TABLE `share_rooms` ADD `name_3` VARCHAR(255) NULL AFTER `name_2`;

ALTER TABLE `share_rooms` CHANGE `room_no` `sharing_room` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;