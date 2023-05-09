<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>


<section class="services-details-two">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-7">
                <div class="services-details-two__right">
                    <div class="services-details-two__img">
                        <img width="1000" height="1000" loading="lazy" data-src="<?= get_picture("blogs_v", $blog->img_url) ?>" title="<?= $blog->title ?>" alt="<?= $blog->title ?>" class="img-fluid w-100 lazyload">
                    </div>
                    <h3 class="services-details-two__title-1"><?= $blog->title ?></h3>
                    <?php foreach ($categories as $k => $v) : ?>
                        <?php if ($v->id == $blog->category_id) : ?>
                            <a rel="dofollow" href="<?= base_url(lang("routes_blog") . "/{$v->seo_url}") ?>" title="<?= $v->title ?>"><?= $v->title ?></a>
                        <?php endif ?>
                    <?php endforeach ?>
                    <p class="services-details-two__text-1"><?= $blog->content ?></p>
                    <p class="services-details-two__text-2 border rounded p-3 mt-3" style="width: fit-content;">
                        <span class="me-2"><?= lang("shareBlog") ?> : </span>
                        <a class="mx-1" rel="nofollow" title="Facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-facebook"></i></a>
                        <a class="mx-1" rel="nofollow" title="Twitter" target="_blank" href="https://twitter.com/intent/tweet?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&t=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-twitter"></i></a>
                        <a class="mx-1" rel="nofollow" title="Linkedin" target="_blank" href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($blog->title) ?>"><i class="fa-brands fa-linkedin"></i></a>
                        <a class="mx-1" rel="nofollow" title="Pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&description=<?= urlencode($blog->title) ?>"><i class="fa-brands fa-pinterest"></i></a>
                        <a class="mx-1" rel="nofollow" title="Reddit" target="_blank" href="https://www.reddit.com/submit?url=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>&title=<?= urlencode($blog->title) ?>"><i class="fa-brands fa-reddit"></i></a>
                        <a class="mx-1" rel="nofollow" title="Whatsapp" target="_blank" href="https://wa.me/?text=<?= urlencode(str_replace("tr/index.php/", "", current_url())) ?>"><i class="fa-brands fa-whatsapp"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>