<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<footer id="footer-pro">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="copyright-text-pro">© 2023 <a rel="dofollow" href="<?= base_url() ?>" title="<?= $settings->company_name ?>"><?= $settings->company_name ?></a> <?= lang("allRightsReserved") ?></div>
            </div><!-- close .col -->
            <div class="col-lg-3">
                <ul class="social-icons-pro">
                    <?php if (!empty($settings->facebook)) : ?>
                        <li>
                            <a class="facebook" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                                <span aria-hidden="true" class="fa fa-facebook color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->twitter)) : ?>
                        <li>
                            <a class="twitter" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                                <span aria-hidden="true" class="fa fa-twitter color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->instagram)) : ?>
                        <li>
                            <a class="instagram" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                                <span aria-hidden="true" class="fa fa-instagram color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->linkedin)) : ?>
                        <li>
                            <a class="linkedin" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                                <span aria-hidden="true" class="fa fa-linkedin color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->youtube)) : ?>
                        <li>
                            <a class="youtube" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                                <span aria-hidden="true" class="fa fa-youtube color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->medium)) : ?>
                        <li>
                            <a class="medium" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                                <span aria-hidden="true" class="fa fa-medium color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty($settings->pinterest)) : ?>
                        <li>
                            <a class="pinterest" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                                <span aria-hidden="true" class="fa fa-pinterest color"></span>
                            </a>
                        </li>
                    <?php endif ?>
                    <?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
                        <li>
                            <a rel="nofollow" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." title="Whatsapp" target="_blank">
                                <span class='fa fa-whatsapp text-success'></span>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div><!-- close .col -->
            <div class="col-lg-2 my-auto py-auto text-center">
                <a rel="dofollow" target="_blank" href="https://mutfakyapim.com" title="Mutfak Yapım Dijital Reklam Ajansı" class="my-auto">
                    <picture><img width="160" height="34" data-src="https://mutfakyapim.com/images/mutfak/logo.png" style="filter:drop-shadow(1px 1px 1px black);" class="img-responsive lazyload" alt="Mutfak Yapım Dijital Reklam Ajansı"></picture>
                </a>
            </div>
        </div><!-- close .row -->
    </div><!-- close .container -->
</footer>

<!-- BEGIN: Back To Top -->
<a href="<?= base_url() ?>" rel="dofollow" title="<?= $settings->company_name ?>" id="pro-scroll-top"><i class="fa-solid fa-angles-up"></i></a>
<!-- END: Back To Top -->

</main>
</div>

<!-- Jquery -->

<script src="<?= asset_url("public/js/jquery.min.js") ?>"></script>
<script>
    jQuery.event.special.touchstart = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchstart", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.touchmove = {
        setup: function(_, ns, handle) {
            this.addEventListener("touchmove", handle, {
                passive: !ns.includes("noPreventDefault")
            });
        }
    };
    jQuery.event.special.wheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("wheel", handle, {
                passive: true
            });
        }
    };
    jQuery.event.special.mousewheel = {
        setup: function(_, ns, handle) {
            this.addEventListener("mousewheel", handle, {
                passive: true
            });
        }
    };
</script>
<!-- #Jquery -->
<!--FOOTER END-->
<?php if (!empty($settings->facebook) || !empty($settings->twitter) || !empty($settings->instagram) || !empty($settings->youtube) || !empty($settings->linkedin) || !empty($settings->medium) || !empty($settings->pinterest)) : ?>
    <div class="btn-group dropstart fixed-linkedin bg-primary">
        <a class="dropdown-toggle" href="<?= base_url() ?>" data-bs-title="<?= lang("social") ?>" data-bs-toggle="dropdown" data-bs-placement="left" data-bs-title="<?= lang("social") ?>" aria-expanded="false">
            <i class="fa fa-comments text-white" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="<?= lang("social") ?>"></i>
        </a>
        <ul class="dropdown-menu">
            <?php if (!empty($settings->facebook)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->facebook ?>" title="Facebook" target="_blank">
                        <i class='fa fa-facebook color'></i> Facebook
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->twitter)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->twitter ?>" title="Twitter" target="_blank">
                        <i class='fa fa-twitter color'></i> Twitter
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->instagram)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->instagram ?>" title="Instagram" target="_blank">
                        <i class='fa fa-instagram color'></i> Instagram
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->linkedin)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->linkedin ?>" title="Linkedin" target="_blank">
                        <i class='fa fa-linkedin color'></i> Linkedin
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->youtube)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->youtube ?>" title="Youtube" target="_blank">
                        <i class='fa fa-youtube color'></i> Youtube
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->medium)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->medium ?>" title="Medium" target="_blank">
                        <i class='fa fa-medium color'></i> Medium
                    </a>
                </li>
            <?php endif ?>
            <?php if (!empty($settings->pinterest)) : ?>
                <li>
                    <a class="dropdown-item" rel="nofollow" href="<?= $settings->pinterest ?>" title="Pinterest" target="_blank">
                        <i class='fa fa-pinterest color'></i> Pinterest
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
<?php endif ?>
<?php if (!empty(@json_decode($settings->phone, TRUE)[0])) : ?>
    <a rel="dofollow" class="fixed-phone text-white bg-danger" href="tel:<?= @json_decode($settings->phone, TRUE)[0] ?>" data-bs-title="<?= lang("phone") ?>" data-bs-toggle="tooltip" data-bs-placement="left"><i class="fa fa-phone"></i></a>
<?php endif ?>
<?php if (!empty(@json_decode($settings->whatsapp, TRUE)[0])) : ?>
    <a rel="nofollow" target="_blank" class="fixed-whatsapp text-white bg-success" href="https://api.whatsapp.com/send?phone=<?= str_replace(" ", "", @json_decode($settings->whatsapp, TRUE)[0]) ?>&amp;text=<?= urlencode(lang("hello") . " " . $settings->company_name) ?>." data-bs-title="WhatsApp" data-bs-toggle="tooltip" data-bs-placement="left"><i class="fa fa-whatsapp"></i></a>
<?php endif ?>

<!--layout end-->
<!-- SCRIPTS -->
<!-- Lazysizes -->
<script async defer src="<?= asset_url("public/js/lazysizes.min.js") ?>"></script>
<!-- #Lazysizes -->

<!-- iziToast -->
<script defer src="<?= asset_url("public/js/iziToast.min.js") ?>"></script>
<!-- #iziToast -->

<script defer src="<?= asset_url("public/js/lightgallery-all.min.js") ?>"></script>

<!-- Site Scripts -->
<script defer src="<?= asset_url("public/js/jquery-migrate.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/bootstrap.bundle.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery.maskedinput.min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/navigation.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery.flexslider-min.js") ?>"></script>
<script defer src="<?= asset_url("public/vendors/jquery-asRange.min.js"); ?>"></script>
<script defer src="<?= asset_url("public/vendors/circle-progress.min.js"); ?>"></script>
<script defer src="<?= asset_url("public/vendors/afterglow.min.js"); ?>"></script>
<script defer src="<?= asset_url("public/vendors/script.js"); ?>"></script>
<script defer src="<?= asset_url("public/vendors/script-dashboard.js"); ?>"></script>

<script async defer src="<?= asset_url("public/js/iziModal.min.js") ?>"></script>
<script defer src="<?= asset_url("public/js/app.js") ?>"></script>
<!-- #Site Scripts -->

<!-- SCRIPTS -->
<script>
    window.addEventListener('DOMContentLoaded', () => {
        $(document).ready(function(data) {
            data.mask.definitions['~'] = '[+-]';
            $('input[type="tel"]').mask('0999 999 99 99');
        });
        $(document).on("click", ".map-address", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let dest = $(this).data("destination");
            if (navigator.geolocation) {
                if ((navigator.platform.indexOf("iPhone") != -1) ||
                    (navigator.platform.indexOf("iPad") != -1) ||
                    (navigator.platform.indexOf("iPod") != -1))
                    window.open("comgooglemapsurl://maps.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                else {
                    window.open("https://www.google.com/maps/dir/?api=1&destination=" + dest + "&travelmode=driving");
                }
            } else {
                iziToast.show({
                    type: "error",
                    title: "<?= lang("error") ?>",
                    message: "<?= lang("allowGeoLocation") ?>",
                    position: "topCenter"
                });
            }
        });
    });
</script>
<?php $this->load->view("includes/alert") ?>
</body>

</html>