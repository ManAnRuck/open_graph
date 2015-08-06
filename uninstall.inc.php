<?php

$myself = 'open_graph';

$sql = new rex_sql();
$sql->debugsql = true;

// rex_article
$sql->setQuery('ALTER TABLE `' . $REX['TABLE_PREFIX'] . 'article` DROP `art_open_graph`, DROP `art_open_graph_title`, DROP `art_open_graph_type`, DROP `art_open_graph_typevalues`, DROP `art_open_graph_description`, DROP `art_open_graph_site_name`, DROP `art_open_graph_images`');
$sql->setQuery("DELETE FROM " . $REX['TABLE_PREFIX'] . "62_params WHERE name='art_open_graph' OR name='art_open_graph_title' OR name='art_open_graph_type' OR name='art_open_graph_typevalues' OR name='art_open_graph_description' OR name='art_open_graph_site_name' OR name='art_open_graph_images'");

rex_generateAll();

$REX['ADDON']['install'][$myself] = 0;
?>
