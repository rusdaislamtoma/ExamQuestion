<?php
return [
    'master_template'=>'layouts.backend.master',
    'content_area'=>'content',
    'par_page'=>'5',
    // Redirect while not authenticate
    'redirect_url_while_not_auth'=>'/',
    'user_id'=>1,

    /**
     * use index while showing permission name
     * */
    'route_index'=>'as' // values = title or as or uri
];