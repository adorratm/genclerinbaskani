<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_submissions extends MY_Controller
{
    public $viewFolder = "";
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "form_submissions_v";
        $this->load->model("form_model");
        $this->load->model("form_image_model");
        $this->load->model("form_input_model");
        $this->load->model("form_submission_model");
        if (!get_active_user()) :
            redirect(base_url("login"));
        endif;
    }
    public function index($id = null)
    {
        $viewData = new stdClass();
        $item = $this->form_model->get(["id" => $id]);
        if (!empty($item)) :
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "list";
            $viewData->item = $item;
            $viewData->items = $this->form_submission_model->get_all(["form_id" => $id]);
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        else :
            redirect(base_url("forms"));
        endif;
    }
    public function datatable($id = null)
    {
        $items = $this->form_submission_model->getRows(["form_id" => $id], $_POST);
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
                    <a class="dropdown-item remove-btn" href="javascript:void(0)" data-table="formTable" data-url="' . base_url("form_submissions/delete/$item->id") . '"><i class="fa fa-trash mr-2"></i>Kaydı Sil</a>
                </div>
            </div>';
                $data[] = [$item->id, $item->data, $proccessing];
            endforeach;
        endif;
        $output = [
            "draw" => (!empty($_POST['draw']) ? $_POST['draw'] : 0),
            "recordsTotal" => $this->form_submission_model->rowCount(["form_id" => $id]),
            "recordsFiltered" => $this->form_submission_model->countFiltered(["form_id" => $id], (!empty($_POST) ? $_POST : [])),
            "data" => $data,
        ];
        // Output to JSON format
        echo json_encode($output);
    }
    public function delete($id)
    {
        $form = $this->form_submission_model->get(["id" => $id]);
        if (!empty($form)) :
            $delete = $this->form_submission_model->delete(["id"    => $id]);
            if ($delete) :

                echo json_encode(["success" => true, "title" => "Başarılı!", "message" => "Form Yanıtı Başarıyla Silindi."]);
            else :
                echo json_encode(["success" => false, "title" => "Başarısız!", "message" => "Form Yanıtı Silinirken Hata Oluştu, Lütfen Tekrar Deneyin."]);
            endif;
        endif;
    }

    public function export_to_excel($id = null)
    {
        $form = $this->general_model->get("forms", null, ["id" => $id, "isActive" => 1]);
        if (!empty($form)) :
            $form_inputs = $this->general_model->get_all("form_inputs", null, null, ["form_id" => $form->id, "isActive" => 1]);
            $form_submissions = $this->general_model->get_all("forms_submissions", null, null, ["form_id" => $form->id]);
            if (!empty($form_submissions) && !empty($form_inputs)) :
                $headers = ["SIRA"];
                foreach ($form_inputs as $fiKey => $fiValue) :
                    array_push($headers, $fiValue->form_title);
                endforeach;
                $data = [];
                $i = 1;
                foreach ($form_submissions as $key => $value) :
                    $columnValueArray = [$i];
                    $value->data = json_decode($value->data, TRUE);
                    if (!empty($value->data)) :
                        foreach ($value->data as $fsKey => $fsValue) :
                            array_push($columnValueArray, is_array($fsValue) ? rtrim(implode(",",$fsValue),",") : $fsValue);
                        endforeach;
                    endif;
                    array_push($data, $columnValueArray);
                    $i++;
                endforeach;
                exportToExcel($data, $headers, seo(json_decode($form->title)->tr . " KATILIMCI LİSTESİ") . ".xlsx");
            endif;
        endif;
    }
}
