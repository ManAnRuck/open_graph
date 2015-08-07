<?php
/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 07.08.15
 * Time: 11:19
 */
$myself = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$func = rex_request('func', 'string');

// save settings
if ($func == 'update') {
    $settings = (array)rex_post('settings', 'array', array());

    // type conversion normal settings
    foreach ($REX['ADDON'][$myself]['settings'] as $key => $value) {
        if (isset($settings[$key])) {
            $settings[$key] = $settings[$key];
        }
    }

    // replace settings
    $REX['ADDON'][$myself]['settings'] = array_merge((array)$REX['ADDON'][$myself]['settings'], $settings);

    // update settings file
    \maru\og\OpenGraph::updateSettingsFile();
}


?>

<div class="rex-addon-output">
    <div class="rex-form">

        <form action="index.php" method="post">
            <input type="hidden" name="page" value="<?= $myself ?>"/>
            <input type="hidden" name="subpage" value="<?php echo $subpage; ?>"/>
            <input type="hidden" name="func" value="update"/>

            <fieldset class="rex-form-col-1">
                <legend><?php echo $I18N->msg('open_graph_settings_https'); ?></legend>
                <div class="rex-form-wrapper slide">

                    <div class="rex-form-row rex-form-element-v1">
                        <p class="rex-form-checkbox">
                            <label for="https"><?php echo $I18N->msg('open_graph_settings_https'); ?></label>
                            <input type="hidden" name="settings[https]" value="0"/>
                            <input type="checkbox" name="settings[https]" id="https"
                                   value="1" <?php if ($REX['ADDON'][$myself]['settings']['https']) {
                                echo 'checked="checked"';
                            } ?>>
                        </p>
                    </div>

                </div>
            </fieldset>

            <fieldset class="rex-form-col-1">
                <div class="rex-form-wrapper">

                    <div class="rex-form-row rex-form-element-v2">

                        <p class="rex-form-submit">
                            <input style="margin-top: 5px; margin-bottom: 5px;" class="rex-form-submit" type="submit"
                                   id="sendit" name="sendit"
                                   value="<?php echo $I18N->msg('open_graph_settings_submit'); ?>"/>
                        </p>
                    </div>

                </div>
            </fieldset>

        </form>
    </div>
</div>

<?php
unset($homeurl_select, $url_ending_select);
?>

<style type="text/css">
    div.rex-form legend {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        width: 100%;
        cursor: pointer;
        border-bottom: 1px solid #fff;
        background: transparent url("../<?php echo $REX['MEDIA_ADDON_DIR']; ?>/<?= $myself ?>/arrows.png") no-repeat 7px 10px;
        padding-left: 19px;
    }

    div.rex-form legend:hover {
        background-color: #eee;
    }

    div.rex-form legend.open {
        background-position: 7px -36px;
    }

    .rex-form-wrapper.slide {
        display: none;
    }

    .pipes {
        font-family: Verdana, 'Trebuchet MS', Arial, sans-serif;
    }

    .preset-button {
        float: right;
        margin-right: 4px;
        margin-top: -23px;
        font-weight: bold;
        border-radius: 4px;
        padding: 2px 4px;
    }

    .preset-button:hover,
    .preset-button.dropdown-open {
        background: #ccc;
        text-decoration: none !important;
    }

    .preset-button:after {
        color: #08c;
        content: "↓";
        font-size: 12px;
        font-weight: bold;
        margin-left: 3px;
        vertical-align: text-top;
    }

    div#rex-website .dropdown a:hover {
        text-decoration: none;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function ($) {

        // slide
        $('.rex-form-col-1 legend').click(function (e) {
            $(this).toggleClass('open');
            $(this).next('.rex-form-wrapper.slide').slideToggle();
        });
    });
</script>


