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

require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.opengraph.inc.php');
require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.image.inc.php');
require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.profile.inc.php');
require_once($REX['INCLUDE_PATH'] . '/addons/' . $myself . '/classes/class.video.inc.php');

define('OPENGRAPH_DATA_DIR', $REX['INCLUDE_PATH'] . '/data/addons/' . $myself . '/');

$REX['ADDON'][$myself]['settings'] = [
    'https' => false,
];

\maru\og\OpenGraph::includeSettingsFile();

// append lang file
if ($REX['REDAXO']) {
    $I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/open_graph/lang/');
}


if ($REX['REDAXO']) {
    $REX['ADDON'][$myself]['SUBPAGES'] = [];
    array_push($REX['ADDON'][$myself]['SUBPAGES'],
        array('settings', $I18N->msg($myself . '_settings')),
        array('help', $I18N->msg($myself . '_help'))
    );

}



if (!$REX['REDAXO']) {
    rex_register_extension('ART_INIT', function () {
        global $REX;
        \maru\og\OpenGraph::initArticle($REX['ARTICLE_ID']);
    });
    rex_register_extension('OUTPUT_FILTER', function ($params) {
        global $REX;
        $params['subject'] = str_replace('</head>', "<!-- OpenGraph -->\n\t".\maru\og\OpenGraph::getAllHTML() . "\n</head>", $params['subject']);
        return $params['subject'];
    });
}