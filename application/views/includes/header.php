<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<header id="videohead-pro" class="sticky-header">
    <div id="video-logo-background">
        <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
            <img width="90" height="90" data-src="<?= get_picture("settings_v", $settings->logo) ?>" alt="<?= $settings->company_name ?>" class="lazyload">
        </a>
    </div>
    <div id="video-logo-background2">
        <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>">
            <img width="252" height="160" data-src="<?= get_picture("settings_v", $settings->mobile_logo_2) ?>" alt="<?= $settings->company_name ?>" class="lazyload">
        </a>
    </div>


    <div id="mobile-bars-icon-pro" class="noselect"><i class="fas fa-bars"></i></div>

    <nav id="site-navigation-pro">
        <?= $menus ?>
    </nav>


    <div class="clearfix"></div>

    <nav id="mobile-navigation-pro">
        <?= $menus ?>
        <div class="clearfix"></div>
    </nav>

    <nav id="sidebar-nav">
        <!-- Add class="sticky-sidebar-js" for auto-height sidebar -->
        <ul id="vertical-sidebar-nav" class="sf-menu">
            <?php if (!empty($settings->facebook)) : ?>
                <li class="normal-item-pro">
                    <a class="facebook" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                        <span aria-hidden="true" class="fa fa-facebook color"></span>
                        Facebook
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->twitter)) : ?>
                <li class="normal-item-pro">
                    <a class="twitter" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                        <span aria-hidden="true" class="fa fa-twitter color"></span>
                        Twitter
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->instagram)) : ?>
                <li class="normal-item-pro">
                    <a class="instagram" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                        <span aria-hidden="true" class="fa fa-instagram color"></span>
                        Instagram
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->linkedin)) : ?>
                <li class="normal-item-pro">
                    <a class="linkedin" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                        <span aria-hidden="true" class="fa fa-linkedin color"></span>
                        Linkedin
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->youtube)) : ?>
                <li class="normal-item-pro">
                    <a class="youtube" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                        <span aria-hidden="true" class="fa fa-youtube color"></span>
                        Youtube
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->medium)) : ?>
                <li class="normal-item-pro">
                    <a class="medium" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                        <span aria-hidden="true" class="fa fa-medium color"></span>
                        Medium
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->pinterest)) : ?>
                <li class="normal-item-pro">
                    <a class="pinterest" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                        <span aria-hidden="true" class="fa fa-pinterest color"></span>
                        Pinterest
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                <li class="normal-item-pro">
                    <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                        <span class='fa fa-whatsapp text-success'></span>
                        Whatsapp
                    </a>
                </li>
            <?php endif ?>
        </ul>
        <div class="clearfix"></div>
    </nav>
</header>


<main id="col-main">







