<?php

// deja appele par l'installer
// $db->beginTransaction();

$sql = <<<SQL

INSERT INTO `clementine_users_privileges` (`id`, `privilege`) VALUES ('', 'manage_categories');

INSERT INTO `clementine_users_groups_has_privileges` (`group_id`, `privilege_id`) (
    SELECT `clementine_users_groups`.`id`, `clementine_users_privileges`.`id` FROM `clementine_users_privileges`, `clementine_users_groups` WHERE `clementine_users_groups`.`group` = 'administrateurs' AND `clementine_users_privileges`.`privilege` = 'manage_categories'
);

SQL;

if (!$db->prepare($sql)->execute()) {
    $db->rollBack();
    return false;
}

// deja appele par l'installer
// $db->commit();

return true;
?>
