<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $forms = $this->general_model->get_all("forms", null, "rank ASC", ["isActive" => 1]); ?>
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
                                            <?= form_dropdown($value->form_main_title . ($value->form_type == "select_dropdown" ? "[]" : null), @explode(",", $value->form_options), @explode(",", $value->form_default_value), 'class="form-control"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "checkbox" || $value->form_type == "multiple_checkbox") : ?>
                                            <div class="d-flex flex-wrap align-items-center align-self-center align-content-center">
                                                <?php $arrOfItems = @explode(",", $value->form_options); ?>
                                                <?php foreach ($arrOfItems as $aKey => $aValue) : ?>
                                                    <div class="form-check me-1">
                                                        <?php $js = 'onclick="triggerOther(this)"' ?>
                                                        <?= form_checkbox($value->form_main_title . ($value->form_type == "multiple_checkbox" ? "[]" : null), $aValue, null, 'class="form-check-input" id="' . $value->form_main_title . $aKey . '"' . ($aValue == "Diğer" ? $js : null)) ?>
                                                        <label for="<?= $value->form_main_title . $key ?>" class="form-check-label my-auto"><?= $aValue ?></label>
                                                    </div>
                                                    <?php if ($aValue == "Diğer") : ?>
                                                        <?php if (!empty($value->form_other_value)) : ?>
                                                            <?= form_input($value->form_main_title, null, 'class="form-control w-auto" placeholder="' . $value->form_title . '" id="' . $value->form_main_title . $key . '"') ?>
                                                        <?php endif ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "text" || $value->form_type == "number" || $value->form_type == "email" || $value->form_type == "password" || $value->form_type == "date" || $value->form_type == "time" || $value->form_type == "datetime") : ?>
                                            <?= form_input($value->form_main_title, $value->form_default_value, 'class="form-control" id="' . $value->form_main_title . $key . '"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "textarea") : ?>
                                            <?= form_textarea($value->form_main_title, $value->form_default_value, 'class="form-control" id="' . $value->form_main_title . $key . '"') ?>
                                        <?php endif ?>
                                        <?php if ($value->form_type == "hidden") : ?>
                                            <?= form_hidden($value->form_main_title . "[]", $value->form_default_value) ?>
                                        <?php endif ?>
                                        <?= form_fieldset_close() ?>
                                    </div>
                                <?php endforeach ?>
                                <div class="last-form-group-continue">
                                    <a href="javascript:void(0)" class="btn btn-green-pro makeOffer" data-url="<?= base_url() ?>"><?= lang("submit") ?></a>
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
    window.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            function triggerOther(e) {
                if ($(e).is(":checked")) {
                    $(e).parent().parent().find("input[type='text']").css("display", "block");
                    $(e).parent().parent().find("input[type='text']").attr("required", true);
                } else {
                    $(e).parent().parent().find("input[type='text']").css("display", "none");
                    $(e).parent().parent().find("input[type='text']").attr("required", false);
                }
            }
        });
    });
</script>