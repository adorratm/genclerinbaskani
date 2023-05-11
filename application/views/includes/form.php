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
                            <form onsubmit="return false" class="registration-steps-form" id="offerform" enctype="multipart/form-data" method="POST">
                                <div class="registration-social-login-container p-2">
                                    <?php foreach ($form_inputs as $key => $value) : ?>
                                        <?php print_r("<pre>")?>
                                        <?php print_r($value)?>
                                        <?php print_r("</pre>")?>
                                    <?php endforeach ?>
                                    <div class="last-form-group-continue">
                                        <a href="javascript:void(0)" class="btn btn-green-pro makeOffer" data-url="<?= base_url() ?>"><?= lang("submit") ?></a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </form>

                        </div><!-- close .registration-steps-page-container -->

                    </div><!-- close .container -->
                </div><!-- close #pricing-plans-background-image -->
            </div><!-- close #content-pro -->
        <?php endif ?>
    <?php endforeach ?>
<?php endif ?>


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