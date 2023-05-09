<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service_categories extends MY_Controller
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
        $this->viewFolder = "service_categories_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! =========================== SERVICE CATEGORIES ============================ !!!:::...
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
        $order = "sc.id ASC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "sc.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "sc.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "sc.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "sc.title DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty(clean($search))) :
            $likes["sc.title"] = clean($search);
            $likes["sc.id"] = clean($search);
            $likes["sc.createdAt"] = clean($search);
            $likes["sc.updatedAt"] = clean($search);
        endif;
        $wheres = [];
        /**
         * Wheres
         */
        $wheres["sc.isActive"] = 1;

        $wheres["sc.lang"] = $this->viewData->lang;
        $joins = [];

        $select = "sc.id,sc.title,sc.seo_url,sc.img_url,sc.isActive";
        $distinct = true;
        $groupBy = ["sc.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = base_url(lang("routes_services") . "/");
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
        $config['total_rows'] = $this->general_model->rowCount("service_categories sc", $wheres, $likes, $joins, [], $distinct, $groupBy, "sc.id");
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
         * Get Services
         */
        $this->viewData->service_categories = $this->general_model->get_all("service_categories sc", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? strto("lower|ucwords", $category->title) : strto("lower|ucwords", lang("service_categories")));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("service_categories"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_services")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "service.group";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("service_categories"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "service_categories_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }

    /**
     * -------------------------------------------------------------------------------------------------
     * ...:::!!! ============================ SERVICE CATEGORIES ============================ !!!:::...
     * -------------------------------------------------------------------------------------------------
     */
}
