<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>
<!--Project V-1 Start-->
<section class="project-v-1">
    <div class="container">
        <div class="row align-items-stretch align-self-stretch align-content-stretch">
            <?php foreach ($our_works as $key => $value) : ?>
                <!--Project One Single Start-->
                <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                    <div class="project-one__single h-100 bg-transparent mb-0">
                        <div class="project-one__img bg-transparent shadow">
                            <img data-src="<?= get_picture("our_works_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>" class="lazyload img-fluid w-100">
                        </div>
                    </div>
                </div>
                <!--Project One Single End-->
            <?php endforeach ?>
        </div>
    </div>
</section>
<!--Project V-1 End-->