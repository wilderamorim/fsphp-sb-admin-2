<?php
if (strpos(url(), "localhost")) {
    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();
    $minCSS->add(dirname(__DIR__, 3) . "/shared/styles/boot.css");
    $minCSS->add(dirname(__DIR__, 3) . "/shared/styles/styles.css");
    $minCSS->add(dirname(__DIR__, 3) . "/node_modules/@fortawesome/fontawesome-free/css/all.min.css");
    $minCSS->add(dirname(__DIR__, 3) . "/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css");

    //theme CSS
    $cssDir = scandir(dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/css");
    foreach ($cssDir as $css) {
        $cssFile = dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/css/{$css}";
        if (is_file($cssFile) && pathinfo($cssFile)['extension'] == "css") {
            $minCSS->add($cssFile);
        }
    }

    //Minify CSS
    $minCSS->minify(dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/style.min.css");

    /**
     * JS
     */
    $minJS = new MatthiasMullie\Minify\JS();
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/jquery/dist/jquery.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/jquery-form/dist/jquery.form.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/shared/scripts/jquery-ui.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/jquery-mask-plugin/dist/jquery.mask.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/jquery.easing/jquery.easing.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/datatables.net/js/jquery.dataTables.min.js");
    $minJS->add(dirname(__DIR__, 3) . "/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js");

    //theme CSS
    $jsDir = scandir(dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/js");
    foreach ($jsDir as $js) {
        $jsFile = dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/js/{$js}";
        if (is_file($jsFile) && pathinfo($jsFile)['extension'] == "js") {
            $minJS->add($jsFile);
        }
    }

    //Minify JS
    $minJS->minify(dirname(__DIR__, 3) . "/themes/" . CONF_VIEW_ADMIN . "/assets/script.min.js");
}