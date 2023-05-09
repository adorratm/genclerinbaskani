<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="container-fluid" style="padding-top: 30px">
    <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-4 mb-xl-4">

        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-4 mb-xl-4">

        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-4 mb-xl-4">

        </div>
        <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-4 mb-sm-4 mb-md-4 mb-lg-4 mb-xl-4">
            <button class="syncInstagramPosts btn btn-outline-primary rounded-0 btn-sm w-100" data-url="<?= base_url("dashboard/syncInstagramPosts") ?>"><i class="fa fa-instagram"></i> Instagram Paylaşımlarını Senkronize Et <i class="fa fa-sync"></i></button>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        $(document).on("click", ".syncInstagramPosts", function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            let url = $(this).data("url");
            let formData = new FormData();
            let button = $(this);
            iziToast.info({
                title: 'Bilgi!',
                message: 'Eşitleme İşlemi Başlatıldı Lütfen Sayfayı Kapatmadan Bekleyiniz...',
                position: "topCenter",
                displayMode: 'once',
            });
            button.html("<i class='fa fa-instagram'></i> Eşitleme İşlemi Yapılıyor Lütfen Bekleyin... <i class='fa fa-sync fa-spin'></i>");
            button.prop("disabled", true);
            createAjax(url, formData, function() {
                button.html("<i class='fa fa-instagram'></i> Eşitleme İşlemi Tamamlandı <i class='fa fa-check'></i>");
                setTimeout(function() {
                    button.html("<i class='fa fa-instagram'></i> Instagram Paylaşımlarını Senkronize Et <i class='fa fa-sync'></i>");
                    button.prop("disabled", false);
                }, 1000);
            });
        });
    });
</script>