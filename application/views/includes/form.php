<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div id="content-pro">
    <div class="container">
        <div class="centered-headings-pro pricing-plans-headings">
            <h6><?= $settings->company_name ?></h6>
            <h1><?= $languageJSON["offer"]["offer"]["value"] ?></h1>
        </div>
    </div><!-- close .container -->
    <div id="pricing-plans-background-image" style="background-image:unset">
        <div class="container">
            <div class="registration-steps-page-container">
                <form onsubmit="return false" class="registration-steps-form" id="offerform" enctype="multipart/form-data" method="POST">
                    <div class="registration-social-login-container p-2">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["name"]["value"] ?></label>
                                <input type="text" class="form-control" placeholder="<?= $languageJSON["offerForm"]["name"]["value"] ?>" name="name" minlength="2" maxlength="70" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["surname"]["value"] ?></label>
                                <input type="text" class="form-control" placeholder="<?= $languageJSON["offerForm"]["surname"]["value"] ?>" name="surname" minlength="2" maxlength="70" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["birthDay"]["value"] ?></label>
                                <input name="birthday" type="number" min="1" max="31" class="form-control" placeholder="<?= $languageJSON["offerForm"]["birthDay"]["value"] ?>">
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["birthMonth"]["value"] ?></label>
                                <select name="birthMonth" id="birthMonth" class="form-control">
                                    <option value=""><?= $languageJSON["offerForm"]["birthMonth"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth1"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth1"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth2"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth2"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth3"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth2"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth4"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth4"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth5"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth5"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth6"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth6"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth7"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth7"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth8"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth8"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth9"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth9"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth10"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth10"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth11"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth11"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["birthMonth12"]["value"] ?>"><?= $languageJSON["offerForm"]["birthMonth12"]["value"] ?></option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["birthYear"]["value"] ?></label>
                                <select name="birthYear" id="birthYear" class="form-control">
                                    <option value=""><?= $languageJSON["offerForm"]["birthYear"]["value"] ?></option>
                                    <?php for ($i = date("Y") - 120; $i <= date("Y"); $i++) : ?>
                                        <option value="<?= $i ?>" <?= date("Y") - 18 == $i ? "selected" : null ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["phonenumber"]["value"] ?></label>
                                <input type="tel" class="form-control" placeholder="<?= $languageJSON["offerForm"]["phonenumber"]["value"] ?>" name="phone" minlength="11" maxlength="19" required>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["gender"]["value"] ?></label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value=""><?= $languageJSON["offerForm"]["gender"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["genderMale"]["value"] ?>"><?= $languageJSON["offerForm"]["genderMale"]["value"] ?></option>
                                    <option value="<?= $languageJSON["offerForm"]["genderFemale"]["value"] ?>"><?= $languageJSON["offerForm"]["genderFemale"]["value"] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["schoolStatus"]["value"] ?></label>
                                <select class="form-control" name="schoolStatus" id="schoolStatus" onchange="$(this).val() === '1' ? $('.schooler').removeClass('d-none') : $('.schooler').addClass('d-none')">
                                    <option value="0"><?= $languageJSON["offerForm"]["schoolStatus0"]["value"] ?></option>
                                    <option value="1" selected><?= $languageJSON["offerForm"]["schoolStatus1"]["value"] ?></option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3 schooler">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["school"]["value"] ?></label>
                                <input type="text" class="form-control" placeholder="<?= $languageJSON["offerForm"]["school"]["value"] ?>" name="school" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["workStatus"]["value"] ?></label>
                                <select class="form-control" name="workStatus" id="workStatus" onchange="$(this).val() === '1' ? $('.worker').removeClass('d-none') : $('.worker').addClass('d-none')">
                                    <option value="0"><?= $languageJSON["offerForm"]["workStatus0"]["value"] ?></option>
                                    <option value="1" selected><?= $languageJSON["offerForm"]["workStatus1"]["value"] ?></option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3 worker">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["work"]["value"] ?></label>
                                <input type="text" class="form-control" placeholder="<?= $languageJSON["offerForm"]["work"]["value"] ?>" name="work" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["district"]["value"] ?></label>
                                <select name="district" id="district" class="form-control" onchange="triggerNeighborhood(this)">
                                    <option value=""><?= $languageJSON["offerForm"]["district"]["value"] ?></option>
                                    <?php foreach ($districts as $district) : ?>
                                        <option value="<?= $district->district_id ?>"><?= $district->district ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["neighborhood"]["value"] ?></label>
                                <select name="neighborhood" id="neighborhood" class="form-control" onchange="triggerQuarter(this)">
                                    <option value=""><?= $languageJSON["offerForm"]["neighborhood"]["value"] ?></option>
                                </select>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="col-form-label"><?= $languageJSON["offerForm"]["quarter"]["value"] ?></label>
                                <select name="quarter" id="quarter" class="form-control">
                                    <option value=""><?= $languageJSON["offerForm"]["quarter"]["value"] ?></option>
                                </select>
                            </div>
                        </div>


                        <div class="last-form-group-continue">
                            <a href="javascript:void(0)" class="btn btn-green-pro makeOffer" data-url="<?= base_url($languageJSON["routes"]["basvuru-yap"]) ?>"><?= $languageJSON["offerForm"]["makeoffer"]["value"] ?></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </form>

            </div><!-- close .registration-steps-page-container -->

        </div><!-- close .container -->
    </div><!-- close #pricing-plans-background-image -->
    <div class="container">
        <?php $i = 0 ?>
        <?php foreach ($homeBanners as $key => $value) : ?>
            <?php if (strtotime($value->sharedAt->$lang) <= strtotime("now")) : ?>
                <div class="row mb-4">
                    <?php if ($i % 2 == 0) : ?>
                        <div class="col-md my-auto">
                            <!-- .my-auto vertically centers contents -->
                            <h2 class="short-border-bottom"><?= $value->title->$lang ?></h2>
                            <?= $value->content->$lang ?>
                        </div>
                        <div class="col-md my-auto">
                            <!-- .my-auto vertically centers contents -->
                            <img data-src="<?= get_picture("home_banner_v", $value->img_url->$lang) ?>" class="img-fluid lazyload" alt="<?= $value->title->$lang ?>">
                        </div>
                    <?php else : ?>
                        <div class="col-md my-auto">
                            <!-- .my-auto vertically centers contents -->
                            <img data-src="<?= get_picture("home_banner_v", $value->img_url->$lang) ?>" class="img-fluid lazyload" alt="<?= $value->title->$lang ?>">
                        </div>
                        <div class="col-md my-auto">
                            <!-- .my-auto vertically centers contents -->
                            <h2 class="short-border-bottom"><?= $value->title->$lang ?></h2>
                            <?= $value->content->$lang ?>
                        </div>
                    <?php endif ?>
                </div><!-- close .row -->
                <?php $i++ ?>
            <?php endif ?>
        <?php endforeach ?>
        <div class="clearfix"></div>
    </div><!-- close .container -->
</div><!-- close #content-pro -->

<script>
    function triggerNeighborhood(e) {
        $("select[name='neighborhood']").html('');
        $("select[name='neighborhood']").append('<option value=""><?= $languageJSON["offerForm"]["neighborhood"]["value"] ?></option>');
        let districtID = $(e).val();
        $.ajax({
            url: "<?= base_url("home/get_neighborhood") ?>/" + districtID,
            type: "GET",
            dataType: "json",
            success: function(response) {
                response.data.forEach(function(elem, i) {
                    $("select[name='neighborhood']").append('<option value="' + elem.neighborhood_id + '">' + elem.neighborhood + '</option>');
                });
                triggerQuarter($("select[name='neighborhood']"));
            }
        });
    }

    function triggerQuarter(e) {
        $("select[name='quarter']").html('');
        $("select[name='quarter']").append('<option value=""><?= $languageJSON["offerForm"]["quarter"]["value"] ?></option>');
        let neighborhoodID = $(e).val();
        $.ajax({
            url: "<?= base_url("home/get_quarter") ?>/" + +neighborhoodID,
            type: "GET",
            dataType: "json",
            success: function(response) {

                response.data.forEach(function(elem, i) {
                    $("select[name='quarter']").append('<option value="' + elem.quarter_id + '">' + elem.quarter + '</option>');
                });
            }
        });
    }
</script>