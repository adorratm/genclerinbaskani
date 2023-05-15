<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forms extends MY_Controller
{
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "forms_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! =========================== FORMS ============================ !!!:::...
     * ------------------------------------------------------------------------------------------------
     */

    public function index()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        /**
         * Order
         */
        $order = "f.id ASC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "f.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "f.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "f.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "f.title DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty(clean($search))) :
            $likes["f.title"] = clean($search);
            $likes["f.id"] = clean($search);
            $likes["f.createdAt"] = clean($search);
            $likes["f.updatedAt"] = clean($search);
        endif;
        $wheres = [];
        /**
         * Wheres
         */
        $wheres["f.isActive"] = 1;

        $wheres["f.lang"] = $this->viewData->lang;
        $joins = [];

        $select = "f.id,f.title,f.seo_url,f.img_url,f.isActive";
        $distinct = true;
        $groupBy = ["f.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = base_url(lang("routes_forms") . "/");
        $config['uri_segment'] = (is_numeric($this->uri->segment(3)) ? 3 : 2);
        $config['use_page_numbers'] = TRUE;
        $config["full_tag_open"] = "<ul class='pagination list-unstyled justify-content-center'>";
        $config["first_link"] = "<i class='fa fa-angles-left'></i>";
        $config["first_tag_open"] = "<li class='page-item'>";
        $config["first_tag_close"] = "</li>";
        $config["prev_link"] = "<i class='fa fa-angle-left'></i>";
        $config["prev_tag_open"] = "<li class='page-item'>";
        $config["prev_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link active' title='" . $this->viewData->settings->company_name . "' rel='dofollow' href='" . str_replace("tr/index.php/", "", current_url()) . "'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["next_link"] = "<i class='fa fa-angle-right'></i>";
        $config["next_tag_open"] = "<li class='page-item'>";
        $config["next_tag_close"] = "</li>";
        $config["last_link"] = "<i class='fa fa-angles-right'></i>";
        $config["last_tag_open"] = "<li class='page-item'>";
        $config["last_tag_close"] = "</li>";
        $config["full_tag_close"] = "</ul>";
        $config['attributes'] = array('class' => 'page-link');
        $config['total_rows'] = $this->general_model->rowCount("forms f", $wheres, $likes, $joins, [], $distinct, $groupBy, "f.id");
        $config['per_page'] = 12;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
            $uri_segment = $this->uri->segment(3);
        else :
            $uri_segment = $this->uri->segment(3);
        endif;
        if (empty($uri_segment)) :
            $uri_segment = 1;
        endif;
        $offset = (!empty($uri_segment) ? $uri_segment - 1 : 0) * $config['per_page'];
        $this->viewData->offset = $offset;
        $this->viewData->per_page = $config['per_page'];
        $this->viewData->total_rows = $config['total_rows'];
        /** 
         * Get Forms
         */
        $this->viewData->forms = $this->general_model->get_all("forms f", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? strto("lower|ucwords", $category->title) : strto("lower|ucwords", lang("forms")));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("forms"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_forms")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "article";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("forms"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "forms_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }
    /**
     * Form Detail
     */
    public function form_detail($seo_url)
    {
        $wheres["f.isActive"] = 1;
        $wheres["f.lang"] = $this->viewData->lang;
        $select = "f.id,f.title,f.seo_url,f.img_url,f.isActive";
        $distinct = true;
        $groupBy = ["f.id"];
        $wheres['f.seo_url'] =  $seo_url;
        /**
         * Get Form Detail
         */
        $this->viewData->form = $this->general_model->get("forms f", $select, $wheres, [], [], [], $distinct, $groupBy);

        if (!empty($this->viewData->form)) :
            /**
             * Meta
             */
            $this->viewData->page_title = strto("lower|ucwords", $this->viewData->form->title);
            $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->form->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->meta_desc  = !empty($this->viewData->form->description) ? str_replace("”", "\"", @stripslashes($this->viewData->form->description)) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewData->og_url                 = clean(base_url(lang("routes_forms") . "/" . lang("routes_form") . "/" . $seo_url));
            $this->viewData->og_image           = clean(get_picture("forms_v", $this->viewData->form->img_url));
            $this->viewData->og_type          = "article";
            $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->form->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->og_description           = !empty($this->viewData->form->description) ? clean(str_replace("”", "\"", @stripslashes($this->viewData->form->description))) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewFolder = "form_detail_v/index";
        else :
            $this->viewFolder = "404_v/index";
        endif;
        $this->render();
    }

    public function form_submit($form_id = null)
    {
        if (!empty($this->input->post()) && !empty($form_id)) :
            $form = $this->general_model->get("forms f", null, ["f.id" => $form_id]);
            if (!empty($form)) :
                $form_inputs = $this->general_model->get_all("form_inputs fi", null, null, ["fi.form_id" => $form_id, "fi.isActive" => 1]);
                if (!empty($form_inputs)) :
                    $postData = $this->input->post();
                    foreach ($form_inputs as $key => $value) :
                        if (empty($postData[$value->form_main_title]) && $value->form_required) :
                            echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => $value->form_title . " " . lang("emptyMessageText")]);
                            die();
                        endif;
                    endforeach;
                    unset($postData["mysubmit"]);
                    unset($postData[$this->security->get_csrf_token_name()]);
                    $saveData = [];
                    $saveData["form_id"] = $form_id;
                    $saveData["data"] = json_encode($postData, JSON_UNESCAPED_UNICODE);
                    $this->general_model->add("forms_submissions", $saveData);
                    echo json_encode(["success" => true, "title" => lang("successMessageTitleText"), "message" => lang("successMessageText")]);
                    die();
                endif;
            endif;
        endif;
        echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("errorMessageText")]);
        die();
    }

    /**
     * -------------------------------------------------------------------------------------------------
     * ...:::!!! ============================ FORMS ============================ !!!:::...
     * -------------------------------------------------------------------------------------------------
     */
}
