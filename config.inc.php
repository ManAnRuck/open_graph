<?php
/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 11:44
 */

// register addon
$myself = 'open_graph';
$REX['ADDON']['rxid'][$myself] = '0';
$REX['ADDON']['name'][$myself] = 'Open Graph';
$REX['ADDON']['version'][$myself] = '0.0.1 DEV';
$REX['ADDON']['author'][$myself] = 'Manuel Ruck';
$REX['ADDON']['supportpage'][$myself] = '';
$REX['ADDON']['perm'][$myself] = $myself . '[]';

// append lang file
if ($REX['REDAXO']) {
    $I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/open_graph/lang/');
}


if ($REX['REDAXO']) {
    $REX['ADDON'][$myself]['SUBPAGES'] = [];
    array_push($REX['ADDON'][$myself]['SUBPAGES'],
        array('help', $I18N->msg($myself . '_help'))
    );

}


require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.opengraph.inc.php');
require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.image.inc.php');

if(!$REX['REDAXO']) {
    rex_register_extension('ART_INIT', function() {
        global $REX;
        \maru\og\OpenGraph::initArticle($REX['ARTICLE_ID']);
    });
}