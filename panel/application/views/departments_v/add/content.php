<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<form id="createDepartment" onsubmit="return false" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Başlık</label>
        <input class="form-control form-control-sm rounded-0" placeholder="Başlık" name="title">
    </div>

    <button role="button" data-url="<?= base_url("departments/save"); ?>" class="btn btn-sm btn-outline-primary rounded-0 btnSave">Kaydet</button>
    <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger rounded-0n">İptal</a>
</form>