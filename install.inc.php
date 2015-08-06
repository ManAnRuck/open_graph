<?php
/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 11:46
 */


$myself = 'open_graph';
$myroot = $REX['INCLUDE_PATH'] . '/addons/' . $myself;
$error = array();

// append lang file
$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/lang/');

// check redaxo version
if (version_compare($REX['VERSION'] . '.' . $REX['SUBVERSION'] . '.' . $REX['MINORVERSION'], '4.5.0', '<=')) {
    $error[] = $I18N->msg('opengraph_install_rex_version');
}

if (count($error) == 0) {
    $sql = new rex_sql();
    $sql->debugsql = true;

    $sql->setQuery('ALTER TABLE `' . $REX['TABLE_PREFIX'] . 'article` ADD `art_open_graph` TEXT, ADD `art_open_graph_title` TEXT, ADD `art_open_graph_type` VARCHAR(255), ADD `art_open_graph_typevalues` TEXT, ADD `art_open_graph_description` TEXT, ADD `art_open_graph_site_name` TEXT, ADD `art_open_graph_images` TEXT');

    $sql->setQuery("INSERT INTO `rex_62_params` (`title`, `name`, `prior`, `attributes`, `type`, `default`, `params`, `validate`, `restrictions`, `createuser`, `createdate`, `updateuser`, `updatedate`)
VALUES
	('Open Graph', 'art_open_graph', 9, '', 12, '', '', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('og:title', 'art_open_graph_title', 11, '', 1, '', '', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('og:type', 'art_open_graph_type', 13, '', 3, 'website', 'website|music.song|music.album|music.playlist|music.radio_station|video.movie|video.episode|video.tv_show|video.other|article|book|profile', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('Type Values', 'art_open_graph_typevalues', 14, '', 2, '', '', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('og:description', 'art_open_graph_description', 12, '', 2, '', '', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('og:site_name', 'art_open_graph_site_name', 10, '', 1, '', '', NULL, '', '%USER%', ".time().", '%USER%', ".time()."),
	('Images', 'art_open_graph_images', 15, '', 7, '', 'types=\"gif,jpg,jpeg,png\" preview=1', NULL, '', '%USER%', ".time().", '%USER%', ".time().")
	;");
    // delete cache
    rex_generateAll();

    // done!
    $REX['ADDON']['install'][$myself] = 1;
} else {
    $REX['ADDON']['installmsg'][$myself] = '<br />' . implode($error, '<br />');
    $REX['ADDON']['install'][$myself] = 0;
}
