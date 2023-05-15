<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "forms_v";
        $this->load->model("form_model");
        $this->load->model("form_image_model");
        $this->load->model("form_input_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index()
    {
        $viewData = new stdClass();
        $items = $this->form_model->get_all();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
    public function datatable()
    {
        $items = $this->form_model->getRows([], $_POST);
        $data = [];
        $i = (!empty($_POST['start']) ? $_POST['start'] : 0);
        if (!empty($items)) :
            foreach ($items as $item) :
                $i++;
                $proccessing = '
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    İşlemler
                </button>
                <div class="dropdown-menu rounded-0 dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item updateFormBtn" href="javascript:void(0)" data-url="' . base_url("forms/update_form/$item->id") . '"><i class="fa fa-pen mr-2"></i>Kaydı Düzenle</a>
                    <a class="dropdown-item" href="' . base_url("form_submissions/index/$item->id") . '"><i class="fa fa-comments mr-2"></i>Form Yanıtları</a>
                    <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="formTable" data-url="' . base_url("forms/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                </div>
            </div>';
                $checkbox = '<div class="custom-control custom-switch"><input data-id="' . $item->id . '" data-url="' . base_url("forms/isActiveSetter/{$item->id}") . '" data-status="' . ($item->isActive == 1 ? "checked" : null) . '" id="customSwitch' . $i . '" type="checkbox" ' . ($item->isActive == 1 ? "checked" : null) . ' class="my-check custom-control-input" >  <label class="custom-control-label" for="customSwitch' . $i . '"></label></div>';
                $data[] = [$item->rank, '<i class="fa fa-arrows" data-id="' . $item->id . '"></i>', $item->id, $item->title, $item->lang, $checkbox, turkishDate("d F Y, l H:i:s", $item->createdAt), turkishDate("d F Y, l H:i:s", $item->updatedAt), $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->form_model->rowCount(),
            "recordsFiltered" => $this->form_model->countFiltered([], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->categories = $this->form_model->get_all(["lang" => $this->session->userdata('activeLang')]);
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function save()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Kaydı Yapılırken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $getRank = $this->form_model->rowCount(["lang" => $this->session->userdata('activeLang')]);
            if (!empty($_FILES)) :
                if (!empty($_FILES["img_url"]["name"])) :
                    $image = upload_picture("img_url", "uploads/$this->viewFolder", ["width" => 1000, "height" => 1000], "*");
                    if ($image["success"]) :
                        $data["img_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Kaydı Yapılırken Hata Oluştu. Form Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
                if (!empty($_FILES["home_url"]["name"])) :
                    $image = upload_picture("home_url", "uploads/$this->viewFolder", ["width" => 1000, "height" => 1000], "*");
                    if ($image["success"]) :
                        $data["home_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Kaydı Yapılırken Hata Oluştu. Form Anasayfa Yatay Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
                if (!empty($_FILES["banner_url"]["name"])) :
                    $image = upload_picture("banner_url", "uploads/$this->viewFolder", ["width" => 1920, "height" => 400], "*");
                    if ($image["success"]) :
                        $data["banner_url"] = $image["file_name"];
                    else :
                        echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Kaydı Yapılırken Hata Oluştu. Form Banner Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                        die();
                    endif;
                endif;
            endif;
            $data["seo_url"] = seo($data["title"]);
            $data["isActive"] = 1;
            $data["rank"] = $getRank + 1;
            $insert = $this->form_model->add($data);
            if ($insert) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Form Başarıyla Eklendi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Eklenirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function update_form($id)
    {
        $viewData = new stdClass();
        $viewData->item = $this->form_model->get(["id" => $id]);
        $category = $this->form_model->get_all(["id!=" => $viewData->item->id]);
        $viewData->categories = $category;
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->settings = $this->general_model->get_all("settings", null, null, ["isActive" => 1]);
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/content", $viewData);
    }
    public function update($id)
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"] && checkEmpty($data)["key"] != "img_url" && checkEmpty($data)["key"] != "home_url" && checkEmpty($data)["key"] != "banner_url") :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Güncelleştirilirken Hata Oluştu. \"{$key}\" Bilgisini Doldurduğunuzdan Emin Olup Tekrar Deneyin."]);
        else :
            $form = $this->form_model->get(["id" => $id]);
            if (!empty($form->img_url)) :
                $data["img_url"] = $form->img_url;
            endif;
            if (!empty($_FILES["img_url"]["name"])) :
                $image = upload_picture("img_url", "uploads/$this->viewFolder", ["width" => 1000, "height" => 1000], "*");
                if ($image["success"]) :
                    $data["img_url"] = $image["file_name"];
                    if (!empty($form->img_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$form->img_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$form->img_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$form->img_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Güncelleştirilirken Hata Oluştu. Form Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($form->home_url)) :
                $data["home_url"] = $form->home_url;
            endif;
            if (!empty($_FILES["home_url"]["name"])) :
                $image = upload_picture("home_url", "uploads/$this->viewFolder", ["width" => 1000, "height" => 1000], "*");
                if ($image["success"]) :
                    $data["home_url"] = $image["file_name"];
                    if (!empty($form->home_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$form->home_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$form->home_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$form->home_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Güncelleştirilirken Hata Oluştu. Form Anasayfa Yatay Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            if (!empty($form->banner_url)) :
                $data["banner_url"] = $form->banner_url;
            endif;
            if (!empty($_FILES["banner_url"]["name"])) :
                $image = upload_picture("banner_url", "uploads/$this->viewFolder", ["width" => 1920, "height" => 400], "*");
                if ($image["success"]) :
                    $data["banner_url"] = $image["file_name"];
                    if (!empty($form->banner_url)) :
                        if (!is_dir(FCPATH . "uploads/{$this->viewFolder}/{$form->banner_url}") && file_exists(FCPATH . "uploads/{$this->viewFolder}/{$form->banner_url}")) :
                            unlink(FCPATH . "uploads/{$this->viewFolder}/{$form->banner_url}");
                        endif;
                    endif;
                else :
                    echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Güncelleştirilirken Hata Oluştu. Form Banner Görseli Seçtiğinizden Emin Olup Tekrar Deneyin."]);
                    die();
                endif;
            endif;
            $data["seo_url"] = seo($data["title"]);
            $update = $this->form_model->update(["id" => $id], $data);
            if ($update) :
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Form Başarıyla Güncelleştirildi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Güncelleştirilirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function delete($id)
    {
        $form = $this->form_model->get(["id" => $id]);
        if (!empty($form)) :
            $delete = $this->form_model->delete(["id"    => $id]);
            if ($delete) :
                /**
                 * Remove Category Image
                 */
                $url = FCPATH . "uploads/{$this->viewFolder}/{$form->img_url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
                $url = FCPATH . "uploads/{$this->viewFolder}/{$form->home_url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
                $url = FCPATH . "uploads/{$this->viewFolder}/{$form->banner_url}";
                if (!is_dir($url) && file_exists($url)) :
                    unlink($url);
                endif;
                /**
                 * Remove Category Inputs
                 */
                $form_inputs = $this->form_input_model->get_all(["form_id" => $id]);
                if (!empty($form_inputs)) :
                    $this->form_input_model->delete(["form_id" => $id]);
                    foreach ($form_inputs as $sKey => $sValue) :
                        $form_input_images = $this->form_image_model->get_all(["form_id" => $sValue->id]);
                        if (!empty($form_input_images)) :
                            $this->form_image_model->delete(["form_id" => $sValue->id]);
                            foreach ($form_input_images as $key => $value) :
                                $url = FCPATH . "uploads/{$this->viewFolder}/{$value->url}";
                                if (!is_dir($url) && file_exists($url)) :
                                    unlink($url);
                                endif;
                            endforeach;
                        endif;
                    endforeach;
                endif;
                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Form Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }
    public function rankSetter()
    {
        $rows = $this->input->post("rows");
        if (!empty($rows)) :
            foreach ($rows as $row) :
                $this->form_model->update(
                    [
                        "id" => $row["id"]
                    ],
                    ["rank" => $row["position"]]
                );
            endforeach;
        endif;
    }
    public function isActiveSetter($id)
    {
        if (!empty($id)) :
            $isActive = (intval($this->input->post("data")) === 1) ? 1 : 0;
            if ($this->form_model->update(["id" => $id], ["isActive" => $isActive])) :
                echo json_encode(["success" => True, "title" => "İşlem Başarıyla Gerçekleşti", "message" => "Güncelleme İşlemi Yapıldı"]);
            else :
                echo json_encode(["success" => False, "title" => "İşlem Başarısız Oldu", "message" => "Güncelleme İşlemi Yapılamadı"]);
            endif;
        endif;
    }
}
