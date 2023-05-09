<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $addressTitles = @json_decode($settings->address_title, TRUE); ?>
<?php $phones = @json_decode($settings->phone, TRUE); ?>
<?php $faxes = @json_decode($settings->fax, TRUE); ?>
<?php $addresses = @json_decode($settings->address, TRUE); ?>
<?php $whatsapps = @json_decode($settings->whatsapp, TRUE); ?>
<?php $maps = @json_decode($settings->map, TRUE); ?>

<div id="page-title-pro">
    <div class="container">
        <div class="row">
            <h1><?= $page_title ?></h1>
        </div><!-- close .row -->
    </div><!-- close .container -->
</div>



<!--Spa Center Three Start-->
<section class="spa-center-three">
    <div class="container">
        <div class="section-title text-center">
            <span class="section-title__tagline"><?= lang("contactUs") ?></span>
            <h2 class="section-title__title"><?= lang("contact") ?></h2>
        </div>
        <?php foreach ($addresses as $key => $value) : ?>
            <div class="row mb-4 contact-page__points-list list-unstyled justify-content-center text-center">
                <?php if (!empty($value)) : ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4 d-flex text-center justify-content-center">
                        <div class="spa-center-three__single">
                            <span class="fa fa-map-marker-alt"></span>
                            <h3 class="spa-center-three__title"><?= lang("address") ?></h3>
                            <p class="spa-center-three__text"><?= @$value ?></p>
                            <div class="spa-center-three__contact">
                                <a rel="dofollow" href="<?= base_url() ?>" title="<?= lang("viewOnMap") ?>" onclick="event.preventDefault();event.stopImmediatePropagation();$('.contact-map').html('<?= $maps[$key] ?>');$('html, body').animate({scrollTop: ($('.contact-map').offset().top - $('.stricky-header').height())}, 'slow');"><?= lang("viewOnMap") ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($phones[$key])) : ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4 d-flex text-center justify-content-center">
                        <div class="spa-center-three__single">
                            <span class="fa fa-phone-volume"></span>
                            <h3 class="spa-center-three__title"><?= lang("phone") ?></h3>
                            <div class="spa-center-three__contact">
                                <a href="tel:<?= @str_replace(" ", "", @$phones[$key]) ?>" rel="dofollow" title="<?= lang("phone") ?>"><?= @$phones[$key] ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($faxes[$key])) : ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4 d-flex text-center justify-content-center">
                        <div class="spa-center-three__single">
                            <span class="fa fa-fax"></span>
                            <h3 class="spa-center-three__title"><?= lang("fax") ?></h3>
                            <div class="spa-center-three__contact">
                                <a href="tel:<?= @str_replace(" ", "", @$faxes[$key]) ?>" rel="dofollow" title="<?= lang("fax") ?>"><?= @$faxes[$key] ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <?php if (!empty($whatsapps[$key])) : ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 mb-4 d-flex text-center justify-content-center">
                        <div class="spa-center-three__single">
                            <span class="fa fa-whatsapp"></span>
                            <h3 class="spa-center-three__title"><?= lang("whatsapp") ?></h3>
                            <div class="spa-center-three__contact">
                                <a href="https://api.whatsapp.com/send?phone=<?= @str_replace(" ", "", @$whatsapps[$key]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." rel="dofollow" title="<?= lang("whatsapp") ?>"><?= @$whatsapps[$key] ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4 d-flex text-center justify-content-center">
                    <div class="spa-center-three__single">
                        <span class="fa fa-envelope-open"></span>
                        <h3 class="spa-center-three__title"><?= lang("mail") ?></h3>
                        <div class="spa-center-three__contact">
                            <a href="mailto:<?= $settings->email ?>" rel="dofollow" title="<?= lang("mail") ?>"><?= $settings->email ?></a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach ?>
    </div>
</section>
<!--Spa Center Three End-->

<!--Contact Page Start-->
<section class="contact-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="contact-page__left">
                    <div class="section-title text-left">
                        <span class="section-title__tagline"><?= $settings->company_name ?></span>
                        <h2 class="section-title__title"><?= lang("contactForm") ?></h2>
                    </div>
                    <p class="contact-page__text"><?= lang("contactFormDesc") ?></p>
                    <div class="contact-page__social">
                        <?php if (!empty($settings->facebook)) : ?>
                            <a rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                <i class='fa fa-facebook'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->twitter)) : ?>
                            <a rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                <i class='fa fa-twitter'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->instagram)) : ?>
                            <a rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                <i class='fa fa-instagram'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->linkedin)) : ?>
                            <a rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                <i class='fa fa-linkedin'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->youtube)) : ?>
                            <a rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                <i class='fa fa-youtube'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->medium)) : ?>
                            <a rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                <i class='fa fa-medium'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty($settings->pinterest)) : ?>
                            <a rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                <i class='fa fa-pinterest'></i>
                            </a>
                        <?php endif ?>
                        <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                            <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                                <i class='fa fa-whatsapp'></i>
                            </a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="contact-page__right">
                    <div class="contact-page__content">
                        <form onsubmit="return false" enctype="multipart/form-data" method="POST" id="contact-form" class="contact-page__form contact-form-validated">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="contact-page__form-input-box">
                                        <input type="text" name="full_name" id="full_name" placeholder="<?= lang("namesurname") ?>" required minlength="2" maxlength="70">
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="contact-page__form-input-box">
                                        <input type="email" name="email" id="email" placeholder="<?= lang("emailaddress") ?>" required>
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="contact-page__form-input-box">
                                        <input type="text" name="phone" id="phone" placeholder="<?= lang("phonenumber") ?>" required minlength="11" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="contact-page__form-input-box">
                                        <input type="text" name="subject" id="subject" placeholder="<?= lang("subject") ?>" required>
                                    </div>
                                    <div class="contact-page__form-input-box text-message-box">
                                        <textarea name="comment" id="comment" cols="30" rows="8" placeholder="<?= lang("message") ?>" required></textarea>
                                    </div>
                                    <div class="contact-page__btn-box">
                                        <button type="submit" class=" thm-btn contact-page__btn btnSubmitForm" aria-label="<?= $settings->company_name ?>" type="submit" data-url="<?= base_url(lang("routes_contact-form")) ?>"><?= lang("submit") ?></button>
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
<!--Contact Page End-->

<!--Google Map Start-->
<section class="contact-page__google-map contact-map">
    <?= @htmlspecialchars_decode(@$maps[0]) ?>
</section>
<!--Google Map End-->