<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
    }

    public function index($page = 1)
    {
    	$data = array();
        $this->template->display('sys/menu/list.html', $data);
    }
    
	public function getData($page = 1){
		
		$page < 1 && $page = 1;
		$page = pageSize * ($page - 1);
			
		$search = $this->input->post('search');
		$where = "WHERE 1";
		$search && $where .= " AND menu_name LIKE '%{$search}%'";
		$sql = "SELECT * FROM w_menu $where ORDER BY menu_id DESC LIMIT $page,".pageSize;
		$data['list'] = $this->menu_model->get_all($sql);
		$this->template->display ( 'sys/menu/data.html', $data );
		
	}
    
    public function detail($id = '')
    {
    	$data = array();
    	$id && $data['result'] = $this->menu_model->one(array('where'=>array('menu_id'=>$id)));
    	$this->template->display('sys/menu/detail.html', $data);
    }
    
    public function save($id = '')
    {
    	$data = $this->input->post();
    	$res = 0;
    	if ($id) {
    			$res = $this->menu_model->update($data,array('menu_id' => $id));
    	}else{
    			$res = $this->menu_model->add($data);
    	}
    	//更新缓存
    	$menu = $this->menu_model->get_all_menu("disabled = 'false'");
    	$this->cache->file->save('menu', $menu, file_cache_time);
    	echo $res;
    }
    
    public function get_all_menu()
    {
    	//菜单 优先缓存
    	$menu = $this->cache->file->get('menu');
    	if( empty($menu) )
    	{
    		$menu = $this->menu_model->get_all_menu("disabled = 'false'");
    		$this->cache->file->save('menu', $menu, file_cache_time);
    	}
    	return $menu;
    }    
    
    public function status($id, $status)
    {
    	if($id && isset($status))
    	{
    		$status = $status == 'false' ? 'true' : 'false';
    		$this->menu_model->update(array('disabled'=>$status) ,array('menu_id'=>(int)$id));
    	}  	
    }

    public function del($id)
    {
    	$id = intval($id);
    	if($id)
    	{
	    	$this->menu_model->del(array('menu_id'=>$id));
	    	redirect(base_url().'sys/menu/index');
    	}
    	else
    	{
    		show_error('参数错误');  
    		die ();
    	}
    }

}