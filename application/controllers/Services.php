<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services extends MY_Controller
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
        $this->viewFolder = "services_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ SERVICES ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Services
     */
    public function index()
    {
        $search = null;
        if (!empty(clean($this->input->get("search")))) :
            $search = clean($this->input->get("search"));
        endif;
        $seo_url = $this->uri->segment(3);
        $category_id = null;
        $category = null;
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $category = $this->general_model->get("service_categories", null, ["isActive" => 1, "lang" => $this->viewData->lang, "seo_url" => $seo_url]);
            if (!empty($category)) :
                $category_id = $category->id;
                $category->seo_url = (!empty($category->seo_url) ? $category->seo_url : null);
                $category->title = (!empty($category->title) ? $category->title : null);
            endif;
        endif;
        /**
         * Order
         */
        $order = "s.id ASC";
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 1) :
            $order = "s.id DESC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 2) :
            $order = "s.id ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 3) :
            $order = "s.title ASC";
        endif;
        if (!empty($_GET["orderBy"]) && clean($_GET["orderBy"]) == 4) :
            $order = "s.title DESC";
        endif;
        /**
         * Likes
         */
        $likes = [];
        if (!empty($search)) :
            $likes["s.title"] = $search;
            $likes["s.createdAt"] = $search;
            $likes["s.updatedAt"] = $search;
            $likes["s.description"] = $search;
        endif;

        $wheres = [];
        if (!empty($category_id)) :
            $wheres["s.category_id"] = $category_id;
        endif;
        /**
         * Wheres
         */
        $wheres["s.isActive"] = 1;
        $wheres["si.isCover"] = 1;
        $wheres["s.lang"] = $this->viewData->lang;
        $joins = ["service_categories sc" => ["s.category_id = sc.id", "left"], "service_images si" => ["si.service_id = s.id", "left"]];

        $select = "s.id,s.title,s.description,s.seo_url,si.url img_url,s.isActive";
        $distinct = true;
        $groupBy = ["s.id"];
        /**
         * Pagination
         */
        $config = [];
        $config['base_url'] = (!empty($seo_url) && !is_numeric($seo_url) ? base_url(lang("routes_services") . "/" . "/{$seo_url}/") : base_url(lang("routes_services") . "/" . $this->uri->segment(3) . "/"));
        $config['uri_segment'] = (!empty($seo_url) && !is_numeric($seo_url) && !empty($this->uri->segment(5)) ? 5 : (is_numeric($this->uri->segment(4)) ? 4 : 2));
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
        $config['total_rows'] = $this->general_model->rowCount("services s", $wheres, $likes, $joins, [], $distinct, $groupBy, "s.id");
        $config['per_page'] = 12;
        $config["num_links"] = 5;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        if (!empty($seo_url) && !is_numeric($seo_url)) :
            $uri_segment = $this->uri->segment(4);
        elseif (!empty($this->uri->segment(3)) && is_numeric($this->uri->segment(3))) :
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
        $this->viewData->services_category = $category;
        /**
         * Get All Categories
         */
        $this->viewData->categories = $this->general_model->get_all("service_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /** 
         * Get Services
         */
        $this->viewData->services = $this->general_model->get_all("services s", $select, $order, $wheres, $likes, $joins, [$config["per_page"], $offset], [], $distinct, $groupBy);
        /**
         * Meta
         */
        $this->viewData->page_title = (!empty($category) ? strto("lower|ucwords", $category->title) : strto("lower|ucwords", lang("services")));
        $this->viewData->meta_title = strto("lower|ucwords", (!empty($category) ? $category->title : lang("services"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
        $this->viewData->og_url                 = clean(base_url(lang("routes_services")));
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "service";
        $this->viewData->og_title           = strto("lower|ucwords", (!empty($category) ? $category->title : lang("services"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewData->links = $this->pagination->create_links();
        $this->viewFolder = "services_v/index";
        $this->render();
        //$this->output->enable_profiler(true); // OPEN FOR PERFORMANCE
        //$this->benchmark->mark('code_end');
        //echo $this->benchmark->elapsed_time('code_start','code_end');
    }
    /**
     * Service Detail
     */
    public function service_detail($seo_url)
    {
        $wheres["s.isActive"] = 1;
        $wheres["si.isCover"] = 1;
        $wheres["s.lang"] = $this->viewData->lang;
        $joins = ["service_categories sc" => ["s.category_id = sc.id", "left"], "service_images si" => ["si.service_id = s.id", "left"]];
        $select = "sc.id category_id,sc.title category_title,sc.seo_url category_seo_url,s.id,s.title,s.seo_url,si.url img_url,s.description,s.isActive";
        $distinct = true;
        $groupBy = ["s.id"];
        $wheres['s.seo_url'] =  $seo_url;
        /**
         * Get Service Detail
         */
        $this->viewData->service = $this->general_model->get("services s", $select, $wheres, $joins, [], [], $distinct, $groupBy);

        if (!empty($this->viewData->service)) :
            /**
             * Get All Categories
             */
            $this->viewData->categories = $this->general_model->get_all("service_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
            /**
             * Get Service Images
             */
            $this->viewData->service_own_images = $this->general_model->get_all("service_images", null, "isCover DESC,rank ASC", ["isActive" => 1, "service_id" => $this->viewData->service->id, "lang" => $this->viewData->lang]);
            $imgURL = null;
            if (!empty($this->viewData->service_own_images)) :
                foreach ($this->viewData->service_own_images as $key => $value) :
                    if ($value->isCover) :
                        $imgURL = $value->url;
                    endif;
                endforeach;
            endif;
            /**
             * Get All Cover Service Images
             */
            $this->viewData->service_images = $this->general_model->get_all("service_images", null, "rank ASC", ["isActive" => 1, "isCover" => 1, "lang" => $this->viewData->lang]);
            /** 
             * Get Same Services
             */
            if (!empty($this->viewData->service)) :
                unset($wheres['s.seo_url']);
                $wheres["s.category_id"] = $this->viewData->service->category_id;
                $wheres["s.id !="] = $this->viewData->service->id;
                $this->viewData->same_services = $this->general_model->get_all("services s", $select, "rand()", $wheres, [], $joins, [12], [], $distinct, $groupBy);
            endif;
            /**
             * Meta
             */
            $this->viewData->page_title = strto("lower|ucwords", $this->viewData->service->title);
            $this->viewData->meta_title = strto("lower|ucwords", $this->viewData->service->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->meta_desc  = !empty($this->viewData->service->description) ? str_replace("”", "\"", @stripslashes($this->viewData->service->description)) : str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));
            $this->viewData->og_url                 = clean(base_url(lang("routes_services") . "/" . lang("routes_service") . "/" . $seo_url));
            $this->viewData->og_image           = clean(get_picture("services_v", $imgURL));
            $this->viewData->og_type          = "service.item";
            $this->viewData->og_title           = strto("lower|ucwords", $this->viewData->service->title) . " - " . $this->viewData->settings->company_name;
            $this->viewData->og_description           = clean(str_replace("”", "\"", @stripslashes($this->viewData->service->description)));
            $this->viewFolder = "service_detail_v/index";
        else :
            $this->viewFolder = "404_v/index";
        endif;
        $this->render();
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ SERVICES ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
}
