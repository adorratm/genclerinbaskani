<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid mt-xl-50 mt-lg-30 mt-15 bg-white p-3">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h4 class="mb-3">
               "<?=$item->title?>" Formu Yanıtları
                <a href="<?= base_url("form_submissions/export_to_excel/" . $item->id); ?>" class="btn btn-sm btn-outline-primary rounded-0 btn-sm float-right"> <i class="fa fa-excel"></i> Excel Dosyasına Aktar</a>
            </h4>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id="filter_form" onsubmit="return false">
                <div class="d-flex flex-wrap">
                    <label for="search" class="flex-fill mx-1">
                        <input class="form-control form-control-sm rounded-0" placeholder="Arama Yapmak İçin Metin Girin." type="text" onkeypress="return runScript(event,'formTable')" name="search">
                    </label>
                    <label for="clear_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-danger rounded-0 " onclick="clearFilter('filter_form','formTable')" id="clear_button" data-toggle="tooltip" data-placement="top" data-title="Filtreyi Temizle" data-original-title="" title=""><i class="fa fa-eraser"></i></button>
                    </label>
                    <label for="search_button" class="mx-1">
                        <button class="btn btn-sm btn-outline-success rounded-0 " onclick="reloadTable('formTable')" id="search_button" data-toggle="tooltip" data-placement="top" data-title="Form Ara"><i class="fa fa-search"></i></button>
                </div>
            </form>
            <table class="table table-hover table-striped table-bordered content-container formTable">
                <thead>
                    <th class="w50 nosort">#id</th>
                    <th>Yanıt İçeriği</th>
                    <th class="nosort">İşlem</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            <script>
                function obj(d) {
                    let appendeddata = {};
                    $.each($("#filter_form").serializeArray(), function() {
                        d[this.name] = this.value;
                    });
                    return d;
                }
                $(document).ready(function() {
                    TableInitializerV2("formTable", obj, {}, "<?= base_url("form_submissions/datatable/" . $item->id) ?>", "<?= base_url("form_submissions/rankSetter/" . $item->id) ?>", true);

                });
            </script>
        </div>
    </div>
</div>
</div>

<div id="formModal"></div>

<script>
    $(document).ready(function() {
        $(document).on("click", ".exportToExcel", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            createAjax(url, formData, function() {
                closeModal("#formModal");
                $("#formModal").iziModal("setFullscreen", false);
                reloadTable("formTable");
            });
        });
    });
</script>