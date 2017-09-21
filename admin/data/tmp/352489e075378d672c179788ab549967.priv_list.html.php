<?php $this->display('inc/header.html', array (
)); ?>
<header class="demos-header">
	<h1 class="demos-title">
		<a href="<?php echo base_url() ; ?>sys/admin_role"> 
			<img src="<?php echo base_url() ; ?>static/images/back.png"> <span>返回</span>
		</a> 
		<img id="masterMenu" src="<?php echo base_url() ; ?>static/images/menu.png">
		<p>角色权限列表</p>
	</h1>
</header>
<?php $this->display('inc/menu.html', array (
)); ?>
<form id="dform">
	<?php if(!empty($this->_vars->tree) ) {  ?>
    <?php foreach($this->_vars->tree as $this->_vars->v ) {  ?>
	<div class="weui-flex">
      <div class="weui-flex__item">
      	<div class="placeholder weui-cells weui-cells_checkbox">
      		<label class="weui-cell weui-check__label">
      		<div class="weui-cell__hd">
	          <input class="weui-check" type="checkbox" name="data[<?php echo $this->_vars->v['menu_id'] ; ?>][menu_id]" value="<?php echo $this->_vars->v['menu_id'] ; ?>" <?php if(isset($this->_vars->ctrl[$this->_vars->v['ctrl']]) ) {  ?>checked="checked"<?php } ?> />
	          <i class="weui-icon-checked"></i>
	        </div>
      		<div class="weui-cell__bd">
	          <p><?php echo $this->_vars->v['menu_name'] ; ?></p>
	        </div>
	        </label>
      	</div>
      </div>
    </div>
    <?php if(!empty($this->_vars->v['child']) ) {  ?>
	<div class="weui-flex weui-cells_checkbox">
		<?php $this->_vars->i = 0 ; ?>
		<?php foreach($this->_vars->v['child'] as $this->_vars->val ) {  ?>
	      <div class="weui-flex__item">
	      	<div class="placeholder small-font  weui-cells_checkbox">
	      		<label class="weui-cell weui-check__label">
	      		<div class="weui-cell__hd">
	      		  <input class="weui-check" type="checkbox" name="data[<?php echo $this->_vars->val['menu_id'] ; ?>][menu_id]" value="<?php echo $this->_vars->val['menu_id'] ; ?>" <?php if(isset($this->_vars->ctrl[$this->_vars->val['ctrl']]) ) {  ?>checked="checked"<?php } ?> />
		          <i class="weui-icon-checked"></i>
		        </div>
	      		<div class="weui-cell__bd">
		          <p><?php echo $this->_vars->val['menu_name'] ; ?></p>
		        </div>
		        </label>
	      	</div>
	      </div>
	      <?php $this->_vars->i++ ; ?>
	      <?php if($this->_vars->i%3==0 ) {  ?>
	      </div>
	      <div class="weui-flex weui-cells_checkbox">
	      <?php } ?>
	    <?php } ?>  
	    <?php if($this->_vars->i%3==2 ) {  ?>
	      <div class="weui-flex__item"></div>
	    <?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
	<?php } ?>
</form>
<?php $this->display('inc/footer.html', array (
)); ?>
<script>
$('.weui-btn_primary').click(function(){
	var url = "<?php echo base_url() ; ?>sys/admin_role/save/<?php echo isset($this->_vars->result) ? $this->_vars->result['role_id'] : '' ; ?>";
	$.ajax({
		type:"POST",
		data:$('#dform').serialize(),
		url:url,
		success:function(res){
			if(res > 0){
				$.toast("保存成功", function() {
					window.location.href="<?php echo base_url() ; ?>sys/admin_role";
				});
			}else{
				$.toptip('保存失败', 'error');
			}
		}
	});
	return false;
});

$('.weui-btn_default').click(function(){
	var url = $(this).attr('url');
	$.get(url,function(){
	 	$.toast("保存成功", function() {
	  		window.location.reload();
	 	});
	});
	return false;
});
</script>



<?php $this->display('inc/header.html', array (
)); ?>

<!-- BEGIN Content -->
<div id="main-content">
    <!-- BEGIN Main Content -->
    <div class="row-fluid">
        <div class="span12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="icon-table"></i> 角色权限列表</h3>

                    <div class="box-tool">
                        <a href="<?php echo base_url() ; ?>sys/admin_role" class="btn btn-info">返回上一级</a>
                    </div>
                </div>
                <div class="box-content">
                	<form name="addForm" id="addForm" method="post" action="<?php echo base_url() ; ?>sys/admin_role/save_priv/<?php echo isset($this->_vars->role_id) ? $this->_vars->role_id : '' ; ?>">
                    <div class="clearfix"></div>
                    <?php if(!empty($this->_vars->tree) ) {  ?>
                    <?php foreach($this->_vars->tree as $this->_vars->v ) {  ?>
                    <div>
	                   	<input type="checkbox" name="data[<?php echo $this->_vars->v['menu_id'] ; ?>][menu_id]" value="<?php echo $this->_vars->v['menu_id'] ; ?>" <?php if(isset($this->_vars->ctrl[$this->_vars->v['ctrl']]) ) {  ?>checked="checked"<?php } ?> /><?php echo $this->_vars->v['menu_name'] ; ?>
	                   	<table class="table">
	                        <?php if(!empty($this->_vars->v['child']) ) {  ?>
	                        <tr>
	                        <?php foreach($this->_vars->v['child'] as $this->_vars->val ) {  ?>
	                           <td>
	                           		<input type="checkbox" name="data[<?php echo $this->_vars->val['menu_id'] ; ?>][menu_id]" value="<?php echo $this->_vars->val['menu_id'] ; ?>" <?php if(isset($this->_vars->ctrl[$this->_vars->val['ctrl']]) ) {  ?>checked="checked"<?php } ?> /><?php echo $this->_vars->val['menu_name'] ; ?>
	                           </td>
	                        <?php } ?>
	                        </tr>
	                        <?php } ?>	                        
	                    </table>
                    </div>
                   	<?php } ?>
                   	<div>
						<input type="submit" class="btn btn-primary" id="button" value="保存"> 
                   	</div>
                    <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Main Content -->

    <?php $this->display('inc/copyright.html', array (
)); ?>

    <a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
</div>
<!-- END Content -->
<?php $this->display('inc/footer.html', array (
)); ?>