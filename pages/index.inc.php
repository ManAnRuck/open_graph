<?php
/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 12:18
 */

$startSubpage = 'start';

$myself = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string') != '' ? rex_request('subpage', 'string') : $startSubpage;
$func = rex_request('func', 'string');
$myroot = $REX['INCLUDE_PATH'] . '/addons/' . $myself;

// layout top
require($REX['INCLUDE_PATH'] . '/layout/top.php');

// title
rex_title($REX['ADDON']['name'][$myself] . ' <span style="font-size:14px; color:silver;">' . $REX['ADDON']['version'][$myself] . '</span>', $REX['ADDON'][$myself]['SUBPAGES']);

// subpages
switch($subpage){
    case '':
        $subpage = $startSubpage;
    case 'start':
    case 'settings':
    case 'redirects':
    case 'tools':
    case 'setup':
    case 'help':
        $local_path = '/addons/' . $myself . '/pages/';
        break;
    default:
        $local_path = '/addons/' . $myself . '/plugins/' . $subpage . '/pages/';
}


require $REX['INCLUDE_PATH'] . $local_path . $subpage . '.inc.php';

// layout bottom
require $REX['INCLUDE_PATH'] . '/layout/bottom.php';