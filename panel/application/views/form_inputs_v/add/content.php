<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="saveFormInput" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği Adı</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Form Seçeneği Adı" name="form_title" required>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği (İngilizce Boşluk Yerine _ Kullanabilirsiniz.)</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Form Seçeneği (İngilizce Boşluksuz)" name="form_main_title" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği Türü</label>
                <select name="form_type" id="form_type" onchange="triggerOptions()" class="form-control form-control-sm rounded-0" required>
                    <option value="text">Kısa Metin</option>
                    <option value="text_area">Uzun Metin</option>
                    <option value="tel">Telefon</option>
                    <option value="email">Email</option>
                    <option value="number">Sayı</option>
                    <option value="checkbox">Seçenek Kutusu</option>
                    <option value="multiple_checkbox">Çoklu Seçim Seçenek Kutusu</option>
                    <option value="date">Tarih</option>
                    <option value="file">Dosya</option>
                    <option value="radio_btn">Tekli Seçim</option>
                    <option value="select_dropdown">Seçim Menüsü</option>
                    <option value="select_multiple">Çoklu Seçim Menüsü</option>
                    <option value="time">Saat</option>
                    <option value="timestamp">Zaman</option>
                    <option value="hidden">Gizli Alan</option>
                    <option value="district">İlçe Seçeneği</option>
                    <option value="quarter">Mahalle Seçeneği</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 showHideOptions">
            <div class="form-group">
                <label>Seçenekler</label>
                <select class="rounded-0 tagsInputAuto" multiple required name="form_options[]" id="form_options"></select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Varsayılan Değer</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Varsayılan Değer" name="form_default_value">
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Diğer Değer</label>
                <select name="form_other_value" class="form-control form-control-sm rounded-0" id="form_other_value" required>
                    <option value="open">Açık</option>
                    <option value="">Kapalı</option>
                </select>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Doldurulması Zorunlu mu?</label>
                <select name="form_required" class="form-control form-control-sm rounded-0" id="form_required" required>
                    <option value="required">Zorunlu</option>
                    <option value="">Değil</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Seçenek Sütun Uzunluğu</label>
                <input name="column_length" type="number" min="1" max="12" value="6" required class="form-control form-control-sm rounded-0" id="column_length">
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Ana Form</label>
                <select class="rounded-0 tagsInput" name="form_id" required>
                    <?php foreach ($forms as $form) : ?>
                        <option value="<?= $form->id; ?>">
                            <?= $form->id ?> - <?= $form->title; ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
                <label>Dil</label>
                <select name="lang" class="form-control form-control-sm rounded-0" required>
                    <?php if (!empty($settings)) : ?>
                        <?php foreach ($settings as $key => $value) : ?>
                            <option value="<?= $value->lang ?>"><?= $value->lang ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("form_inputs/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
            <a href="javascript:void(0)" onclick="closeModal('#formInputModal')" class="btn btn-sm btn-outline-danger rounded-0">İptal</a>
        </div>
    </div>
</form>

<script>
    function triggerOptions() {
        let form_type = $("#form_type").val();
        if (form_type == "checkbox" || form_type == "multiple_checkbox" || form_type == "radio_btn" || form_type == "select_dropdown" || form_type == "select_multiple") {
            $(".showHideOptions").removeClass("d-none");
        } else {
            $(".showHideOptions").addClass("d-none");
        }
    }
    $(document).ready(function() {
        triggerOptions();
    });
</script>