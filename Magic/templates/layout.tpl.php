<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <? Magic::addTpl('head') ?>
    </head>
    <body <?if($main):?>class="<?=$main;?>"<?endif;?>>
    <!--[if lt IE 8]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
        <?if(Magic::DebugMode()):?>
            <?Magic::addTpl('debug/main');?>
        <?endif;?>
        <div id="wrapper" role="main">
            <header>
                <? Magic::addTpl('header'); ?>
            </header>
            <div id="content">
                <? //Magic::loadMain($main)?>
            </div>
            <footer>
                <? Magic::addTpl('footer'); ?>
            </footer>
        </div>
        <? Magic::addTpl('js_includes'); ?>
    </body>
</html>