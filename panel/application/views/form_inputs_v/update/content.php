<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="updateFormInput" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği Adı</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Form Seçeneği Adı" name="form_title" required value="<?= $item->form_title ?>">
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği (İngilizce Boşluk Yerine _ Kullanabilirsiniz.)</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Form Seçeneği (İngilizce Boşluksuz)" name="form_main_title" required value="<?= $item->form_main_title ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Form Seçeneği Türü</label>
                <select name="form_type" id="form_type" onchange="triggerOptions()" class="form-control form-control-sm rounded-0" required>
                    <option <?= $item->form_type == "text" ? "selected" : null ?> value="text">Kısa Metin</option>
                    <option <?= $item->form_type == "text_area" ? "selected" : null ?> value="text_area">Uzun Metin</option>
                    <option <?= $item->form_type == "tel" ? "selected" : null ?> value="tel">Telefon</option>
                    <option <?= $item->form_type == "email" ? "selected" : null ?> value="email">Telefon</option>
                    <option <?= $item->form_type == "number" ? "selected" : null ?> value="number">Sayı</option>
                    <option <?= $item->form_type == "checkbox" ? "selected" : null ?> value="checkbox">Seçenek Kutusu</option>
                    <option <?= $item->form_type == "multiple_checkbox" ? "selected" : null ?> value="multiple_checkbox">Çoklu Seçim Seçenek Kutusu</option>
                    <option <?= $item->form_type == "date" ? "selected" : null ?> value="date">Tarih</option>
                    <option <?= $item->form_type == "file" ? "selected" : null ?> value="file">Dosya</option>
                    <option <?= $item->form_type == "radio_btn" ? "selected" : null ?> value="radio_btn">Tekli Seçim</option>
                    <option <?= $item->form_type == "select_dropdown" ? "selected" : null ?> value="select_dropdown">Seçim Menüsü</option>
                    <option <?= $item->form_type == "select_multiple" ? "selected" : null ?> value="select_multiple">Çoklu Seçim Menüsü</option>
                    <option <?= $item->form_type == "time" ? "selected" : null ?> value="time">Saat</option>
                    <option <?= $item->form_type == "timestamp" ? "selected" : null ?> value="timestamp">Zaman</option>
                    <option <?= $item->form_type == "hidden" ? "selected" : null ?> value="hidden">Gizli Alan</option>
                    <option <?= $item->form_type == "district" ? "selected" : null ?> value="district">İlçe Seçeneği</option>
                    <option <?= $item->form_type == "quarter" ? "selected" : null ?> value="quarter">Mahalle Seçeneği</option>
                </select>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 showHideOptions">
            <div class="form-group">
                <label>Seçenekler</label>
                <select class="rounded-0 tagsInputAuto" multiple required name="form_options[]" id="form_options">
                    <?php if (!empty($item->form_options)) : ?>
                        <?php foreach (@explode(",", $item->form_options) as $option) : ?>
                            <option value="<?= $option ?>" selected><?= $option ?></option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Varsayılan Değer</label>
                <input class="form-control form-control-sm rounded-0" placeholder="Varsayılan Değer" name="form_default_value" value="<?= $item->form_default_value ?>">
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Diğer Değer</label>
                <select name="form_other_value" class="form-control form-control-sm rounded-0" id="form_other_value" required>
                    <option <?= $item->form_other_value == "open" ? "selected" : null ?> value="open">Açık</option>
                    <option <?= $item->form_other_value != "open" ? "selected" : null ?> value="">Kapalı</option>
                </select>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="form-group">
                <label>Doldurulması Zorunlu mu?</label>
                <select name="form_required" class="form-control form-control-sm rounded-0" id="form_required" required>
                    <option <?= $item->form_required == "required" ? "selected" : null ?> value="required">Zorunlu</option>
                    <option <?= $item->form_required != "required" ? "selected" : null ?> value="">Değil</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Seçenek Sütun Uzunluğu</label>
                <input name="column_length" type="number" min="1" max="12" value="<?= $item->column_length ?>" required class="form-control form-control-sm rounded-0" id="column_length">
            </div>
        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
                <label>Ana Form</label>
                <select class="rounded-0 tagsInput" name="form_id" required>
                    <?php foreach ($forms as $form) : ?>
                        <option <?= ($form->id == $item->form_id ? "selected" : null) ?> value="<?= $form->id; ?>">
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
                <input type="text" class="form-control form-control-sm rounded-0" name="lang" disabled value="<?= !empty($item->lang) ? $item->lang : "tr" ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <button role="button" data-url="<?= base_url("form_inputs/update/$item->id"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnUpdate">Güncelle</button>
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