<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Store extends My_Controller
{
	
	public function __construct()
	{
		parent::__construct ();
		$this->load->model ( 'store_model' );
		$this->load->model ( 'area_model' );
	}
	
	public function index($page = 1)
	{
		$this->template->display ( 'shop/store/list.html' );
	}
	
	public function getData($page = 1){
	
		$page < 1 && $page = 1;
		$page = pageSize * ($page - 1);
			
		$sql = "SELECT * FROM w_store ORDER BY store_id DESC LIMIT $page,".pageSize;
		$data['list'] = $this->store_model->get_all($sql);
		$this->template->display ( 'shop/store/data.html', $data );
	
	}
	
	public function detail($store_id = '')
	{
		$data = array ();
		
		if ($store_id)
		{
			if($this->_user['role_id'] != 1 && $store_id != $this->_user['store_id']){
				show_error('权限不足!');
			}
			$whereArr = array (
					'store_id' => $store_id 
			);
			$result = $this->store_model->one ( array (
					'where' => $whereArr 
			) );
			$data ['result'] = $result;
			//地区
			if( ! empty($result['city']) )
				$data['area'] = $this->area_model->one(array('where'=>array('pid'=>$result['city'])),1);
		}
		//一级城市
		$data['city'] = $this->area_model->one(array('where'=>array('pid'=>'0')),1);
		$data['headerCss'] = array('../assets/umeditor/themes/default/css/umeditor.css');
		$data['footerJs'] = array(
				'../assets/umeditor/umeditor.config.js',
				'../assets/umeditor/umeditor.min.js',
				'astore.js'
		);
		$this->template->display ( 'shop/store/detail.html', $data );
	}
	
	public function save($store_id = '')
	{
		if($this->_user['role_id'] != 1 && $store_id != $this->_user['store_id']){
			show_error('权限不足!');
		}
		$data = $this->input->post ();
		if($_FILES['img1']['error'] == 0){
			$filename = $_FILES ['img1'] ['name'];
			$MAXIMUM_FILESIZE = 0.5 * 1024 * 1024; // 头像限制200KB;
			
			if ($_FILES ['img1'] ['size'] > $MAXIMUM_FILESIZE) {
				show_error('头像图片过大，请处理后重新上传.');
			}
			if( ! in_array(exif_imagetype($_FILES['img1']['tmp_name']),array(IMAGETYPE_GIF,IMAGETYPE_JPEG,IMAGETYPE_PNG,IMAGETYPE_GIF))){
				show_error("图片文件格式错误");
			}
			$file_name = uniqid ().'.'.substr(strrchr($_FILES['img1']['name'], '.'), 1);
			$md_dir = './upload/store/'.$file_name;
			$isMoved = @move_uploaded_file ( $_FILES ['img1'] ['tmp_name'], $md_dir);
			$isMoved &&	$data['img1'] = base_url().'upload/store/'.$file_name;
		}
		$this->store_model->save ( $data, $store_id );
		$this->template->display('msg.html', array('status'=>'1','msg'=>'保存成功','url'=>base_url().'shop/store'));
	}
	
	public function status($id, $status)
	{
		if($id && isset($status))
		{
			$status = $status == '0' ? '1' : '0';
			$this->store_model->update(array('disabled'=>$status) ,array('store_id'=>(int)$id));
		}
	}	
	
	//不允许删除
	public function del($store_id)
	{
		exit();
		if($this->_user['role_id'] != 1){
			show_error('权限不足!');
		}
		$store_id = intval($store_id);
		$store_id && $this->store_model->del(array('store_id'=>$store_id));
		redirect ( base_url () . 'shop/store' );
	}

}