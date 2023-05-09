<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>
<!-- BEGIN: About Section -->
<section class="welcome-one">
    <?php if ($item->type === "ABOUT" || $item->type === "CONTENT") : ?>
        <div class="container-fluid">
            <div class="row triggerFixed align-items-stretch align-self-stretch align-content-stretch">
                <div class="col-lg-12 image-column bg-white h-100">
                    <div class="title-box rounded p-1 p-sm-3">
                        <div class="sec-title mb-0">
                            <?php $pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1, "type" => $item->type]); ?>
                            <?php if (!empty($pages)) : ?>
                                <?php $l = 1 ?>
                                <ul class="nav pageNav justify-content-center" id="fixingBar">
                                    <?php foreach ($pages as $key => $value) : ?>
                                        <li class="nav-item <?= $l != count($pages) ? "border-end" : null ?>"><a class="nav-link p-1 p-lg-2 text-dark <?= $this->uri->segment(3) == $value->url ? "active" : null ?>" rel="dofollow" title="<?= $value->title ?>" style="font-weight: 600;font-size:13px" href="#<?= $value->url ?>"><?= $value->title ?></a></li>
                                        <?php $l++ ?>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php $pages = $this->general_model->get_all("pages", null, "rank ASC", ["isActive" => 1, "type" => $item->type]); ?>
    <?php if ($item->type === "ABOUT") : ?>

        <?php $i = 0 ?>
        <!-- BEGIN: About Section -->
        <?php foreach ($pages as $key => $value) : ?>
            <div class="container-fluid  <?= $i % 2 == 0 ? "py-4" : null ?>" id="<?= $value->url ?>" <?= $i % 2 == 0 ? "style='background-color:var(--mellis-black)'" : null ?>>
                <div class="container">
                    <div class="row align-items-center align-self-center align-content-center my-4">
                        <?php if (!empty($value->img_url)) : ?>
                            <div class="col-xl-6 order-0 order-lg-<?= $i % 2 == 0 ? "1" : "0" ?> h-100">
                                <div class="welcome-one__left">
                                    <div class="welcome-one__img-box wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
                                        <div class="welcome-one__img">
                                            <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>">
                                            <div class="welcome-one__shape-1 float-bob-y">
                                                <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/welcome-one-shape-1.webp") ?>" alt="<?= $value->title ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col-xl-6 order-lg-<?= $i % 2 == 0 ? "0" : "1" ?> h-100">
                            <div class="welcome-one__right">
                                <div class="section-title text-left">
                                    <span class="section-title__tagline"><?= $settings->company_name ?></span>
                                    <h2 class="section-title__title"><?= $value->title ?></h2>
                                </div>
                                <p class="welcome-one__text"><?= $value->content ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php if ($item->type === "CONTENT") : ?>
        <?php $i = 0 ?>
        <?php foreach ($pages as $key => $value) : ?>
            <div class="container-fluid" id="<?= $value->url ?>">
                <div class="container">
                    <div class="row align-items-center align-self-center align-content-center my-4">
                        <?php if (!empty($value->img_url)) : ?>
                            <div class="col-xl-6 order-0 order-lg-<?= $i % 2 == 0 ? "1" : "0" ?> h-100">
                                <div class="welcome-one__left">
                                    <div class="welcome-one__img-box wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
                                        <div class="welcome-one__img">
                                            <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $value->img_url) ?>" title="<?= $value->title ?>" alt="<?= $value->title ?>">
                                            <div class="welcome-one__shape-1 float-bob-y">
                                                <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/welcome-one-shape-1.webp") ?>" alt="<?= $value->title ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                        <div class="col-xl-6 order-lg-<?= $i % 2 == 0 ? "0" : "1" ?> h-100">
                            <div class="welcome-one__right">
                                <div class="section-title text-left">
                                    <span class="section-title__tagline"><?= $settings->company_name ?></span>
                                    <h2 class="section-title__title"><?= $value->title ?></h2>
                                </div>
                                <p class="welcome-one__text"><?= $value->content ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $i++ ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php if ($item->type === "KVKK") : ?>
        <section class="faq-page">
            <div class="container">
                <div class="accrodion-grp faq-one-accrodion" data-grp-name="faq-one-accrodion">
                    <?php $i = 0 ?>
                    <?php foreach ($pages as $key => $value) : ?>
                        <div class="accrodion <?= $i == 0 ? "active" : null ?>">
                            <div class="accrodion-title">
                                <h4><?= $value->title ?></h4>
                            </div>
                            <div class="accrodion-content">
                                <div class="inner">
                                    <p><?= $value->content ?></p>
                                </div><!-- /.inner -->
                            </div>
                        </div>
                        <?php $i++ ?>
                    <?php endforeach ?>
                </div>
            </div>
        </section>
    <?php endif ?>
    <?php if ($item->type === "SIMPLE") : ?>
        <div class="container">
            <div class="row align-items-center align-self-center align-content-center my-4">
                <?php if (!empty($item->img_url)) : ?>
                    <div class="col-xl-6 h-100">
                        <div class="welcome-one__left">
                            <div class="welcome-one__img-box wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
                                <div class="welcome-one__img">
                                    <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $item->img_url) ?>" title="<?= $item->title ?>" alt="<?= $item->title ?>">
                                    <div class="welcome-one__shape-1 float-bob-y">
                                        <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/welcome-one-shape-1.webp") ?>" alt="<?= $item->title ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-xl-6 h-100">
                    <div class="welcome-one__right">
                        <div class="section-title text-left">
                            <span class="section-title__tagline"><?= $settings->company_name ?></span>
                            <h2 class="section-title__title"><?= $item->title ?></h2>
                        </div>
                        <p class="welcome-one__text"><?= $item->content ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ($item->type === "CAREER") : ?>
        <div class="container">
            <div class="row align-items-center align-self-center align-content-center my-4">
                <?php if (!empty($item->img_url)) : ?>
                    <div class="col-xl-6 h-100">
                        <div class="welcome-one__left">
                            <div class="welcome-one__img-box wow slideInLeft animated" data-wow-delay="100ms" data-wow-duration="2500ms" style="visibility: visible; animation-duration: 2500ms; animation-delay: 100ms; animation-name: slideInLeft;">
                                <div class="welcome-one__img">
                                    <img width="1000" height="1000" loading="lazy" class="img-fluid lazyload" data-src="<?= get_picture("pages_v", $item->img_url) ?>" title="<?= $item->title ?>" alt="<?= $item->title ?>">
                                    <div class="welcome-one__shape-1 float-bob-y">
                                        <img loading="lazy" class="img-fluid lazyload" data-src="<?= asset_url("public/images/shapes/welcome-one-shape-1.webp") ?>" alt="<?= $item->title ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-xl-6 h-100">
                    <div class="welcome-one__right">
                        <div class="section-title text-left">
                            <span class="section-title__tagline"><?= $settings->company_name ?></span>
                            <h2 class="section-title__title"><?= $item->title ?></h2>
                        </div>
                        <p class="welcome-one__text"><?= $item->content ?></p>
                    </div>
                </div>
            </div>
        </div>
        <section class="contact-page">
            <div class="container">
                <div class="team-details__bottom contact-page__bottom">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="comment-form-2 mt-0">
                                <h3 class="comment-form-2__title"><?= lang("careerForm") ?></h3>
                                <form onsubmit="return false" enctype="multipart/form-data" method="POST" id="career-form" class="comment-form-2__form contact-form-validated">
                                    <div class="row">
                                        <div class="col-xl-4">
                                            <div class="comment-form-2__input-box">
                                                <input type="text" name="full_name" id="full_name" placeholder="<?= lang("namesurname") ?>" required minlength="2" maxlength="70">
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="comment-form-2__input-box">
                                                <input type="email" name="email" id="email" placeholder="<?= lang("emailaddress") ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="comment-form-2__input-box">
                                                <input type="text" name="phone" id="phone" placeholder="<?= lang("phonenumber") ?>" required minlength="11" maxlength="20">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="comment-form-2__input-box">
                                                <?php $departments = $this->general_model->get_all("departments", [], "rank ASC", ["isActive" => 1]); ?>
                                                <select name="department" id="department">
                                                    <option value=""><?= lang("selectDepartment") ?></option>
                                                    <?php foreach ($departments as $department) : ?>
                                                        <option value="<?= $department->title ?>"><?= $department->title ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="comment-form-2__input-box text-message-box">
                                                <textarea name="comment" id="comment" cols="30" rows="8" placeholder="<?= lang("message") ?>" required></textarea>
                                            </div>
                                            <div class="comment-form-2__input-box">
                                                <input type="file" name="cv" id="cv" placeholder="<?= lang("cv") ?>" required>
                                            </div>
                                            <div class="comment-form-2__btn-box">
                                                <button class="thm-btn comment-form-2__btn btnSubmitCareerForm" aria-label="<?= $settings->company_name ?>" type="button" data-url="<?= base_url(lang("routes_career-form")) ?>"><?= lang("submitCareer") ?></button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    <?php endif ?>
</section>
<!-- END: About Section -->