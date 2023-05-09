<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
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
        $this->viewFolder = "home_v";
    }
    /**
     * ---------------------------------------------------------------------------------------------
     * ...:::!!! ============================== CONSTRUCTOR ============================== !!!:::...
     * ---------------------------------------------------------------------------------------------
     */

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Index
     */
    public function index()
    {

        /**
         * Slides
         */
        $this->viewData->slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        /**
         * Galleries
         */
        $this->viewData->gallery = $this->general_model->get("galleries", null, ["isActive" => 1, "lang" => $this->viewData->lang, "id" => 2]);
        if (!empty($this->viewData->gallery)) :
            $this->viewData->gallery_items = $this->general_model->get_all("video_urls", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang, "gallery_id" => $this->viewData->gallery->id]);
        endif;
        /**
         * Home Items
         */
        $this->viewData->homeitemsFooter = $this->general_model->get_all("home_items", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [4, 4]);
        /**
         * Instagram Posts
         */
        $this->viewData->instagramPosts = $this->general_model->get_all("instagram_posts", null, "id ASC");
        /**
         * Service Categories
         */
        $wheres["s.isActive"] = 1;
        $wheres["si.isCover"] = 1;
        $wheres["s.lang"] = $this->viewData->lang;
        $joins = ["service_categories sc" => ["s.category_id = sc.id", "left"], "service_images si" => ["si.service_id = s.id", "left"]];
        $select = "s.id,s.title,s.seo_url,si.url img_url,s.description";
        $distinct = true;
        $groupBy = ["s.id"];
        $this->viewData->services = $this->general_model->get_all("services s", $select, "s.id DESC", $wheres, [], $joins, [12], [], $distinct, $groupBy);
        /**
         * Our Works
         */
        $this->viewData->our_works = $this->general_model->get_all("our_works", null, "rand()", ["isActive" => 1, "lang" => $this->viewData->lang], [], [], [20]);

        $this->viewData->meta_title = clean(strto("lower|ucwords", lang("home"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->meta_desc  = str_replace("”", "\"", @stripslashes($this->viewData->settings->meta_description));

        $this->viewData->og_url                 = clean(base_url());
        $this->viewData->og_image           = clean(get_picture("settings_v", $this->viewData->settings->logo));
        $this->viewData->og_type          = "website";
        $this->viewData->og_title           = clean(strto("lower|ucwords", lang("home"))) . " - " . $this->viewData->settings->company_name;
        $this->viewData->og_description           = clean($this->viewData->settings->meta_description);
        $this->viewFolder = "home_v/index";
        $this->render();
        //$this->output->enable_profiler(TRUE);
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================== INDEX ================================== !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * Career Form
     */
    public function career_form()
    {
        $data = rClean($this->input->post());
        if (checkEmpty($data)["error"]) :
            $key = checkEmpty($data)["key"];
            echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("careerErrorMessageText") . " \"{$key}\" " . lang("emptyMessageText")]);
            die();
        else :
            $filename = $_FILES['cv']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ($ext == 'pdf' || $ext == 'docx') :
                $attachments = [$_FILES["cv"]];
                $message = "\"" . $data['full_name'] . "\" İsimli ziyaretçi iş başvurusunda bulundu. \n\n <b>Ad Soyad : </b> " . $data["full_name"] . "\n\n <b>Telefon : </b> " . $data["phone"] . "\n\n <b>E-mail : </b> " . $data["email"] . "\n\n <b>Çalışmak İstediği Departman : </b>" . $data["department"] . "\n\n <b>Mesaj : </b>" . $data["comment"];
                $message = $this->load->view("includes/simple_mail_template", ["settings" => get_settings(), "subject" => "Yeni Bir İş Başvurusu Var! | " . $this->viewData->settings->company_name, "message" => $message, "lang" => $this->viewData->lang], true);
                if (send_emailv2("", "Yeni Bir İş Başvurusu Var! | " . $this->viewData->settings->company_name, $message, $attachments, $this->viewData->lang,2)) :
                    echo json_encode(["success" => true, "title" => lang("successMessageTitleText"), "message" => lang("careerSuccessMessageText")]);
                    die();
                else :
                    echo json_encode(["success" => false, "title" => lang("errorMessageTitleText"), "message" => lang("careerErrorEmailMessageText")]);
                    die();
                endif;
            endif;
        endif;
    }

    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ LANGUAGE ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */
    /**
     * Change Language
     */
    public function switchLanguage()
    {
        if (!empty($this->input->post("lang"))) :
            $lang = $this->input->post("lang");
        else :
            $lang = "tr";
        endif;
        if (!empty(get_active_user())) :
            $this->general_model->update("users", ["id" => get_active_user()->id], ["lang" => $lang]);
        endif;
        set_cookie("lang", $lang, strtotime("+1 year"));
        redirect(base_url());
    }
    /**
     * -----------------------------------------------------------------------------------------------
     * ...:::!!! ================================ LANGUAGE ================================= !!!:::...
     * -----------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ============================== SITEMAP MODULE ============================== !!!:::...
     * ------------------------------------------------------------------------------------------------
     */
    /**
     * Generate a sitemap index file
     * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
     */
    public function sitemapindex()
    {
        $this->load->model("sitemapmodel");
        /**
         * Page URLs
         */
        if (!empty($this->viewData->page_urls)) :
            foreach (array_unique($this->viewData->page_urls) as $key => $value) :
                $this->sitemapmodel->add($value, NULL, 'always', 1);
            endforeach;
        endif;
        /**
         * Blog Categories
         */
        $blog_categories = $this->general_model->get_all("blog_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($blog_categories)) :
            foreach ($blog_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Blogs
         */
        $blogs = $this->general_model->get_all("blogs", null, "id DESC", ['isActive' => 1, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($blogs)) :
            foreach ($blogs as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Service Categories
         */
        $service_categories = $this->general_model->get_all("service_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($service_categories)) :
            foreach ($service_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_services") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Services
         */
        $wheres["s.isActive"] = 1;
        $wheres["si.isCover"] = 1;
        $wheres["s.lang"] = $this->viewData->lang;
        $joins = ["service_categories sc" => ["s.category_id = sc.id", "left"], "service_images si" => ["si.service_id = s.id", "left"]];
        $select = "s.id,s.title,s.seo_url,si.url img_url";
        $distinct = true;
        $groupBy = ["s.id"];
        $services = $this->general_model->get_all("services s", $select, "s.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($services)) :
            foreach ($services as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_services") . "/" . lang("routes_service") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Slides
         */
        $slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($slides)) :
            foreach ($slides as $k => $v) :
                if (!empty($v->button_url)) :
                    $this->sitemapmodel->add($v->button_url, NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Galleries
         */
        $galleries = $this->general_model->get_all("galleries", null, "rank ASC", ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($galleries)) :
            foreach ($galleries as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        $this->sitemapmodel->output('sitemapindex');
    }
    /**
     * Generate a sitemap url file
     * More information about sitemap example xml: https://www.sitemaps.org/protocol.html#sitemapXmlExample
     */
    public function sitemap()
    {
        $this->load->model("sitemapmodel");
        /**
         * Page URLs
         */
        if (!empty($this->viewData->page_urls)) :
            foreach (array_unique($this->viewData->page_urls) as $key => $value) :
                $this->sitemapmodel->add($value, NULL, 'always', 1);
            endforeach;
        endif;
        /**
         * Blog Categories
         */
        $blog_categories = $this->general_model->get_all("blog_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($blog_categories)) :
            foreach ($blog_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Blogs
         */
        $blogs = $this->general_model->get_all("blogs", null, "id DESC", ['isActive' => 1, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($blogs)) :
            foreach ($blogs as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_blog") . "/" . lang("routes_blog_detail") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Service Categories
         */
        $service_categories = $this->general_model->get_all("service_categories", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($service_categories)) :
            foreach ($service_categories as $k => $v) :
                if (!empty($v->seo_url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_services") . "/{$v->seo_url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Services
         */
        $wheres["s.isActive"] = 1;
        $wheres["si.isCover"] = 1;
        $wheres["s.lang"] = $this->viewData->lang;
        $joins = ["service_categories sc" => ["s.category_id = sc.id", "left"], "service_images si" => ["si.service_id = s.id", "left"]];
        $select = "s.id,s.title,s.seo_url,si.url img_url";
        $distinct = true;
        $groupBy = ["s.id"];
        $services = $this->general_model->get_all("services s", $select, "s.id DESC", $wheres, [], $joins, [], [], $distinct, $groupBy);
        if (!empty($services)) :
            foreach ($services as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_services") . "/" . lang("routes_service") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Slides
         */
        $slides = $this->general_model->get_all("slides", null, "rank ASC", ["isActive" => 1, "lang" => $this->viewData->lang]);
        if (!empty($slides)) :
            foreach ($slides as $k => $v) :
                if (!empty($v->button_url)) :
                    $this->sitemapmodel->add($v->button_url, NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        /**
         * Galleries
         */
        $galleries = $this->general_model->get_all("galleries", null, "rank ASC", ["isActive" => 1, "isCover" => 0, "lang" => $this->viewData->lang], [], [], []);
        if (!empty($galleries)) :
            foreach ($galleries as $k => $v) :
                if (!empty($v->url)) :
                    $this->sitemapmodel->add(base_url(lang("routes_galleries") . "/" . lang("routes_gallery") . "/{$v->url}"), NULL, 'always', 1);
                endif;
            endforeach;
        endif;
        $this->sitemapmodel->output();
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ============================== SITEMAP MODULE ============================== !!!:::...
     * ------------------------------------------------------------------------------------------------
     */

    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== CATALOG ========================= !!!:::...
     */
    function catalog()
    {

        $this->ci_minifier->set_domparser(0);
        $this->ci_minifier->init(1);
        $filepath = get_picture("settings_v", $this->viewData->settings->catalog);

        $this->output
            ->set_header("Content-Disposition: inline; filename={$this->viewData->settings->company_name}.pdf")
            ->set_content_type('application/pdf')
            ->set_output(file_get_contents($filepath));
    }
    /**
     * ------------------------------------------------------------------------------------------------
     * ...:::!!! ========================== CATALOG ========================= !!!:::...
     */
}
