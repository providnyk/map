<?php

define('STR_REQ_191', 'required | max 191 chars');
define('STR_OPT_191', 'max 191 chars');
define('STR_OPT_25K', 'max 25.000 chars');
define('STR_REQ_ONE_LIST', 'required | one from list');
define('STR_OPT_ONE_LIST', 'one from list');
define('STR_OPT_FEW_LIST', 'few from list');
define('BOOL_YES_NO', 'yes or no');

return [
    'submit' => 'Submit',
    'preview' => 'Preview',
    'tabs' => [
        'main' => 'Main',
        'seo' => 'Seo'
    ],
    'breadcrumbs' => [
        'home' => 'Home',
        'list' => 'list',
    ],
    'actions' => [
        'create'    	=> 'Create',
        'create_more'  	=> 'Create More',
        'edit'      	=> 'Edit',
        'view'      	=> 'View',
        'continue'  	=> 'Continue',
    ],
    'fields' => [
        'rules' => [
            'str_req_191' => STR_OPT_191,
        ],
        //Translateable
        'active' => [
            'label' => 'Enabled',
            'rules' => BOOL_YES_NO,
        ],
        'country_id' => [
            'label' => 'Country',
            'rules' => STR_OPT_ONE_LIST,
        ],
        'name' => [
            'label' => 'Enter name',
            'rules' => STR_REQ_191,
        ],
        'title' => [
            'label' => 'Type the title',
            'rules' => STR_OPT_191,
        ],
        'description' => [
            'label' => 'Enter description',
            'rules' => STR_OPT_25K,
        ],
        'slug' => [
            'label' => 'Enter slug',
            'rules' => STR_OPT_191,
        ],
        'url' => [
            'label' => 'Enter link',
            'rules' => STR_OPT_191,
        ],
        'api_code' => [
            'label' => 'Enter api code',
            'rules' => STR_OPT_191,
        ],
        'festival_id' => [
            'label' => 'Select festival',
            'rules' => STR_OPT_ONE_LIST,
        ],
        'author_ids' => [
            'label' => 'Select authors',
            'rules' => STR_OPT_FEW_LIST,
        ],
        'image_id' => [
            'label' => 'Select image',
            'rules' => 'max 10 mb'
        ],
        'file_id' => [
            'label' => 'Select file',
            'rules' => 'max 50 mb'
        ],
        'preview_copyright' => [
            'label' => 'Copyright info for Preview',
            'rules' => STR_REQ_191,
        ],
        'image_copyright' => [
            'label' => 'Copyright info',
            'rules' => STR_REQ_191,
        ],
        'meta_title' => [
            'label' => 'Enter meta title',
            'rules' => STR_OPT_191,
        ],
        'meta_keywords' => [
            'label' => 'Enter meta keywords',
            'rules' => STR_OPT_191,
        ],
        'meta_description' => [
            'label' => 'Enter meta description',
            'rules' => STR_OPT_25K,
        ],
        'category' => [
            'label' => 'Select category',
            'rules' => STR_REQ_ONE_LIST,
        ],
        'festival' => [
            'label' => 'Select festival',
            'rules' => STR_REQ_ONE_LIST,
        ],
        'gallery' => [
            'label' => 'Select gallery',
            'rules' => STR_OPT_ONE_LIST,
        ],
        'published_at' => [
            'label' => 'Publish date',
            'rules' => 'date'
        ],
    ],
    'legends' => [
        'main' => 'Main info',
        'seo' => 'SEO data'
    ]
];