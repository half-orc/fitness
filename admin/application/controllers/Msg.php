<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg extends My_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index($array)
    {
        $this->template->display('msg.html', $array);
    }

}