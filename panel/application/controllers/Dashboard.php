<?php

use Egulias\EmailValidator\Result\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public $viewData = null;
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        $this->load->model("general_model");
        $this->viewData = new stdClass();
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
        $this->viewData->settings = get_settings();
    }
    public function index()
    {
        //$whereOrder["status"] = 'Tamamlandı.';
        //$items = $this->general_model->get_all("orders", [], [], []) ?? [];
        $this->viewData->viewFolder = $this->viewFolder;
        $this->viewData->subViewFolder = "list";
        $this->load->view("{$this->viewData->viewFolder}/{$this->viewData->subViewFolder}/index", $this->viewData);
    }

    public function syncInstagramPosts()
    {
        $userName = str_replace("/", "", (str_replace("https://www.instagram.com/", "", str_replace("https://instagram.com/", "", $this->viewData->settings->instagram))));
        if (!empty($userName)) {
            $files = glob(__DIR__ . '/../../../panel/uploads/instastory/*'); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file)) {
                    unlink($file); // delete file
                }
            }
            $this->instastory->login($this->viewData->settings->crawler_email, $this->viewData->settings->crawler_password);
            $this->instastory->getProfile($userName);
            $medias = $this->instastory->getMedias();
            $i = 1;
            foreach ($medias as $mediaKey => $mediaValue) :
                $url = substr(str_replace('/', '-', parse_url($mediaValue->getDisplaySrc(), PHP_URL_PATH)), 1);
                $this->general_model->replace("instagram_posts", ["id" => $i, "img_url" => $url, "link" => $mediaValue->getLink()]);
                $i++;
            endforeach;
            $this->instastory->downloadMedias();
        }
        echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Instagram Paylaşımları Senkronize Edildi"]);
    }

    public function makeWebp()
    {
        rWebp2(str_replace("panel\\", "", FCPATH) . "public/images");
    }
    public function phpinfo()
    {
        phpinfo();
    }

    public function language($language = '', $file = '', $action = '')
    {
        //Load library
        $this->load->library('linguo');
        $this->linguo->render($language, $file, $action);
        return;
    }
}
