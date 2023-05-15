<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $forms = $this->general_model->get_all("forms", null, "rank ASC", ["isActive" => 1]); ?>
<?php $cities = [] ?>
<?php $allCities = $this->general_model->get_all("cities", "city_id,city", null, ["city_id" => 41]) ?>
<?php $citiesId = [] ?>
<?php if (!empty($allCities)) : ?>
    <?php foreach ($allCities as $aCKey => $aCValue) : ?>
        <?php if (!in_array($aCValue->city, $cities)) : ?>
            <?php $citiesId[] = $aCValue->city_id ?>
            <?php $cities[$aCValue->city] = $aCValue->city ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>
<?php $districtsWquarters = [] ?>
<?php $districts = []; ?>
<?php $allDistricts = $this->general_model->get_all("districts", "district_id,district", null, [], [], [], [], ["cities_id" => $citiesId]) ?>
<?php if (!empty($allDistricts)) : ?>
    <?php foreach ($allDistricts as $aDKey => $aDValue) : ?>
        <?php if (!in_array($aDValue->district, $districts)) : ?>
            <?php $districts[$aDValue->district] = $aDValue->district ?>
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>
<?php $allQuarters = $this->general_model->get_all("quarters", "districts.district,quarters.quarter_id,quarters.quarter,quarters.neighborhoods_id", null, ["cities.city_id" => 41], [], ["neighborhoods" => ["neighborhoods.neighborhood_id = neighborhoods_id", "LEFT"], "districts" => ["districts.district_id = neighborhoods.districts_id", "LEFT"], "cities" => ["cities.city_id = districts.cities_id", "LEFT"]], [], [], true) ?>
<?php if (!empty($allQuarters)) : ?>
    <?php foreach ($allQuarters as $aQKey => $aQValue) : ?>
        <?php $districtsWquarters[$aQValue->district][$aQValue->quarter] = $aQValue->quarter ?>
    <?php endforeach ?>
<?php endif ?>


<?php if (!empty($forms)) : ?>
    <?php foreach ($forms as $k => $v) : ?>
        <?php $form_inputs = $this->general_model->get_all("form_inputs", null, "rank ASC", ["isActive" => 1, "form_id" => $v->id]) ?>
        <?php if (!empty($form_inputs)) : ?>
            <div id="content-pro">
                <div class="container">
                    <div class="centered-headings-pro pricing-plans-headings">
                        <h6><?= $settings->company_name ?></h6>
                        <h1><?= $v->title ?></h1>
                    </div>
                </div><!-- close .container -->
                <div id="pricing-plans-background-image" style="background-image:unset">
                    <div class="container">
                        <div class="registration-steps-page-container">
                            <?= form_open_multipart('', [
                                'id' => 'offerform' . $k,
                                'class' => 'registration-steps-form',
                                'method' => 'POST',
                                'onsubmit' => 'return false'
                            ]) ?>
                            <div class="registration-social-login-container p-2 row align-items-center align-self-center align-content-center">
                                <?php foreach ($form_inputs as $key => $value) : ?>
                                    <div class="col-12 col-sm-<?= $value->form_type == "multiple_checkbox" ? "12" : ($value->column_length ?? 6)  ?>">
                                        <?= form_fieldset($value->form_title) ?>
                                        <?php if ($value->form_type == "select" || $value->form_type == "select_dropdown") : ?>
                                            <?php $arrOfItems = [] ?>
                                            <?php if (!empty(@explode(",", $value->form_options))) : ?>
                                                <?php foreach (@explode(",", $value->form_options) as $foKey => $foValue) : ?>
                                                    <?php $arrOfItems[$foValue] = $foValue ?>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                            <?= form_dropdown($value->form_main_title . ($value->form_type == "select_dropdown" ? "[]" : null), $arrOfItems, @explode(",", $value->form_default_value), 'class="form-control"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "checkbox" || $value->form_type == "multiple_checkbox") : ?>
                                            <div class="d-flex flex-wrap align-items-center align-self-center align-content-center">
                                                <?php $arrOfItems = @explode(",", $value->form_options); ?>
                                                <?php foreach ($arrOfItems as $aKey => $aValue) : ?>
                                                    <div class="form-check me-2">
                                                        <?php $js = 'onclick="triggerOther(this)"' ?>
                                                        <?= form_checkbox($value->form_main_title . ($value->form_type == "multiple_checkbox" ? "[]" : null), $aValue, null, 'class="form-check-input" id="' . $value->form_main_title . $aKey . '"' . ($aValue == "Diğer" ? $js : null)) ?>
                                                        <?= form_label($aValue, $value->form_main_title . $aKey, 'class="form-check-label my-auto"') ?>
                                                    </div>
                                                    <?php if ($aValue == "Diğer") : ?>
                                                        <?php if (!empty($value->form_other_value)) : ?>
                                                            <?= form_input($value->form_main_title . ($value->form_type == "multiple_checkbox" ? "[]" : null), null, 'class="form-control w-auto d-none" placeholder="' . $value->form_title . '" id="' . $value->form_main_title . $key . '"') ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "radio_btn") : ?>
                                            <div class="d-flex flex-wrap align-items-center align-self-center align-content-center">
                                                <?php $arrOfItems = @explode(",", $value->form_options); ?>
                                                <?php foreach ($arrOfItems as $aKey => $aValue) : ?>
                                                    <div class="form-check me-2">
                                                        <?php $js = 'onclick="triggerOther(this)"' ?>
                                                        <?= form_radio($value->form_main_title, $aValue, null, 'class="form-check-input" id="' . $value->form_main_title . $aKey . '"' . ($aValue == "Diğer" ? $js : null)) ?>
                                                        <?= form_label($aValue, $value->form_main_title . $aKey, 'class="form-check-label my-auto"') ?>
                                                    </div>
                                                    <?php if ($aValue == "Diğer") : ?>
                                                        <?php if (!empty($value->form_other_value)) : ?>
                                                            <?= form_input($value->form_main_title, null, 'class="form-control w-auto d-none" placeholder="' . $value->form_title . '" id="' . $value->form_main_title . $key . '"') ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "text") : ?>
                                            <?= form_input($value->form_main_title, $value->form_default_value, ' placeholder="' . $value->form_title . '" type=' . $value->form_type . ' class="form-control" id="' . $value->form_main_title . $key . '"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "tel"  || $value->form_type == "email" || $value->form_type == "number" || $value->form_type == "date" || $value->form_type == "time" || $value->form_type == "datetime-local") : ?>
                                            <input type="<?= $value->form_type ?>" name="<?= $value->form_main_title ?>" placeholder="<?= $value->form_title ?>" class="form-control" id="<?= $value->form_main_title . $key ?>">
                                        <?php endif ?>
                                        <?php if ($value->form_type == "text_area") : ?>
                                            <?= form_textarea($value->form_main_title, $value->form_default_value, 'class="form-control" id="' . $value->form_main_title . $key . '"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "file") : ?>
                                            <div class="input-group">
                                                <?= form_upload($value->form_main_title, $value->form_default_value, '') ?>
                                                <?= form_label($value->form_title, $value->form_main_title, 'class="form-control"') ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "district") : ?>
                                            <?php $js = 'onchange="changeDistrict(this)"' ?>
                                            <?= form_dropdown($value->form_main_title, $districts, $value->form_default_value, 'class="form-control districtInput" ' . $js) ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "quarter") : ?>
                                            <?= form_dropdown($value->form_main_title, $districtsWquarters, $value->form_default_value, 'class="form-control quarterInput"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "hidden") : ?>
                                            <?= form_hidden($value->form_main_title . "[]", $value->form_default_value) ?>
                                        <?php endif ?>
                                        <?= form_fieldset_close() ?>
                                    </div>
                                <?php endforeach ?>
                                <div class="last-form-group-continue">
                                    <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()) ?>
                                    <?= form_button('mysubmit', lang("submitForm"), 'class="btn btn-green-pro makeOffer" data-url="' . base_url(lang("routes_form") . "/" . $v->id) . '"'); ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <?= form_close(); ?>
                        </div><!-- close .registration-steps-page-container -->

                    </div><!-- close .container -->
                </div><!-- close #pricing-plans-background-image -->
            </div><!-- close #content-pro -->
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>


<script>
    window.addEventListener('DOMContentLoaded', () => {
        $(".districtInput").trigger("change");
        $(document).on("click", ".makeOffer", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            e.stopPropagation();
            let form = $(this).closest("form");
            let url = $(this).data("url");
            let data = new FormData(form[0]);
            let $this = $(this);
            $this.prop("disabled", true);
            createAjax($this.data("url"), data, function() {
                form[0].reset();
                $this.prop("disabled", false);
            }, function() {
                $this.prop("disabled", false);
            });
        });
    });

    function triggerOther(e) {
        if ($(e).is(":checked")) {
            $(e).parent().parent().find("input[type='text']").removeClass("d-none");
            $(e).parent().parent().find("input[type='text']").prop("required", true);
        } else {
            $(e).parent().parent().find("input[type='text']").addClass("d-none");
            $(e).parent().parent().find("input[type='text']").prop("required", false);
        }
    }

    function changeDistrict(e) {
        let district = $(e).val();
        let quarters = <?= json_encode($districtsWquarters) ?>;
        let html = "";
        html += "<optgroup label='" + district + "'>";
        for (let i = 0; i < Object.entries(quarters[district]).length; i++) {
            html += '<option value="' + Object.entries(quarters[district])[i][1] + '">' + Object.entries(quarters[district])[i][1] + '</option>';
        }
        html += "</optgroup>";
        $(".quarterInput").html(html);
    }
</script>