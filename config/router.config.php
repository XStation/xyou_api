<?php

final class config_router
{
    public static $map = Array(

//--------------------- system -------------------------
        '/^svn\/up/i' => array(
                            'get' => array('svn', 'up'),
                            'post' => array('svn', 'up'),
                        ),
        '/\/$/i' => array(
                            'get' => array('index', 'index'),
                        ),
        '/^info$/i' => array(
                            'get' => array('svn', 'info'),
                        ),
        '/^god\/login$/i' => array(
                            'get' => array('god', 'login'),
                        ),

//========================================================


//-----------------------groups---------------------------
		//获取部门下
		'/^groups$/i' => array(
                            'get' => array('user', 'info'),
                        ),
		'/^groups\/(\d+)/i' => array(
                            'get' => array('user', 'info'),
                        ),
//=======================================================

//------------------------about user-----------------------

        '/^user\/login$/i' => array(
                            'post' => array('user', 'login'),
                        ),
		'/^user\/self$/i' => array(
                            'get' => array('user', 'self'),
                            'post' => array('user', 'self_modify'),
                        ),
        '/^users$/i' => array(
                            'get' => array('user', 'list'),
                        ),
        '/^user\/(\d+)/i' => array(
                            'get' => array('user', 'info'),
                        ),
        '/^user\/create$/i' => array(
                            'post' => array('user', 'create'),
                        ),
        '/^user\/delete\/(\d+)$/i' => array(
                            'get' => array('user', 'delete'),
                        ),

        '/^user\/modify$/i' => array(
                            'post' => array('user', 'modify'),
                        ),


        '/^user\/logout$/i' => array(
                            'get' => array('user', 'logout'),
                        ),
//=======================user end===========================

//-------------------about application---------------------
        '/^applications$/i' => array(
                            'get' => array('application', 'list'),
                        ),
        '/^application\/(\d+)$/i' => array(
                            'get' => array('application', 'info'),
                        ),
        '/^application\/create$/i' => array(
                            'post' => array('application', 'create'),
                        ),
//        '/^application\/delete\/(\d+)$/i' => array(
//                            'get' => array('application', 'delete'),
//                        ),

        '/^application\/modify$/i' => array(
                            'post' => array('application', 'modify'),
                        ),
        '/^application\/(\d+)\/downloadlua$/i' => array(
                            'get' => array('application', 'download_lua'),
                        ),
//------------------application end-------------------------

        '/^application\/(\d+)\/items$/i' => array(
                            'get' => array('item', 'list'),
                        ),
	
        //'/^v1\/user\/password\/verify/i' => array('user', 'verify_oldpassword'),
        //'/^v1\/user\/delete\/(\d*)/i' => array('user', 'delete'),
        //'/^v1\/service\/info\/(\w+)/i' => array('service', 'info'),
        //'/^v1\/service\/delete\/([,\w]+)/i' => array('service', 'delete'),

        //'/^v1\/ops\/category\/list/i' => array('category', 'list'),
        //'/^v1\/ops\/category\/add/i' => array('category', 'add'),
        //'/^v1\/ops\/category\/update/i' => array('category', 'update'),
        //'/^v1\/ops\/category\/info\/(\w+)/i' => array('category', 'info'),
        //'/^v1\/ops\/category\/delete\/([,\w]+)/i' => array('category', 'delete'),

        //'/^v1\/service\/card\/delete\/([,\w]+)/i' => array('card', 'delete'),
        //'/^v1\/service\/card\/info\/(\d+)/i' => array('card', 'info'),
        //'/^v1\/ops\/device\/out\/delete\/([,\w]+)/i' => array('device', 'out_delete'),  //删除出库记录
        //'/^v1\/ops\/device\/delete\/([,\w]+)/i' => array('device', 'delete'),
        //'/^v1\/ops\/device\/detail\/(\w+)/i' => array('device', 'detail'),
        //'/^v1\/ops\/camera\/info\/(\d+)/i' => array('camera', 'info'),

        //'/^v1\/test\/x\/(\w+)\/y\/(\w+)/i' => array('example', 'test'),
        //'/^v1\/test\/x\/y\/(\w+)/i' => array('example', 'test'),
        //'/^v1\/test\/x\/y/i' => array('example', 'test'),

    );
}


?>
