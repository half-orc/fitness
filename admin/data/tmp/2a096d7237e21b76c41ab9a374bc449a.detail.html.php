<?php $this->display('inc/header.html', array (
)); ?>
<header class="demos-header">
	<h1 class="demos-title">
		<a href="<?php echo base_url() ; ?>sys/menu"> 
			<img src="<?php echo base_url() ; ?>static/images/back.png"> <span>返回</span>
		</a> 
		<img id="masterMenu" src="<?php echo base_url() ; ?>static/images/menu.png">
		<p>菜单详情</p>
	</h1>
</header>
<?php $this->display('inc/menu.html', array (
)); ?>
<form id="dform">
<div class="weui-cells weui-cells_form">
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<label class="weui-label">菜单名称</label>
		</div>
		<div class="weui-cell__bd">
			<input class="weui-input" name="menu_name" type="text" required
				value="<?php echo isset($this->_vars->result) ? $this->_vars->result['menu_name'] : '' ; ?>">
		</div>
	</div>
	
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<label class="weui-label">上级ID</label>
		</div>
		<div class="weui-cell__bd">
			<input class="weui-input" name="parent_id" type="text" value="<?php echo isset($this->_vars->result) ? $this->_vars->result['parent_id'] : '' ; ?>" >	
		</div>
	</div>
	
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<label class="weui-label">model</label>
		</div>
		<div class="weui-cell__bd">
			<input class="weui-input" name="model" type="text" value="<?php echo isset($this->_vars->result) ? $this->_vars->result['model'] : '' ; ?>" >	
		</div>
	</div>
	
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<label class="weui-label">ctrl</label>
		</div>
		<div class="weui-cell__bd">
			<input class="weui-input" name="ctrl" type="text" value="<?php echo isset($this->_vars->result) ? $this->_vars->result['ctrl'] : '' ; ?>" >
		</div>
	</div>
	
	<div class="button_sp_area">
		<a href="javascript:;" class="weui-btn weui-btn_primary">保存</a>
        <?php if(isset($this->_vars->result) ) {  ?> 
        <a href="javascript:;" class="weui-btn weui-btn_default"
        url="<?php echo base_url() ; ?>sys/menu/status/<?php echo $this->_vars->result['menu_id'] ; ?>/<?php echo $this->_vars->result['disabled'] ; ?>">
        	<?php if($this->_vars->result['disabled']=='false' ) {  ?>禁用<?php } else { ?>启用<?php } ?>
        </a>
        <a href="javascript:;" url="<?php echo base_url() ; ?>sys/menu/del/<?php echo $this->_vars->result['menu_id'] ; ?>"  onclick="return confirm('确认删除？');"
        class="weui-btn weui-btn_warn">删除</a>
        <?php } ?>
    </div>
</div>
</form>
<?php $this->display('inc/footer.html', array (
)); ?>
<script>

$('.weui-btn_primary').click(function(){
	var url = "<?php echo base_url() ; ?>sys/menu/save/<?php echo isset($this->_vars->result) ? $this->_vars->result['menu_id'] : '' ; ?>";
	$.ajax({
		type:"POST",
		data:$('#dform').serialize(),
		url:url,
		success:function(res){
			if(res > 0){
				$.toast("保存成功", function() {
					window.location.reload();
				});
			}else{
				$.toptip('保存失败', 'error');
			}
			
		}
	});
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

$('.weui-btn_warn').click(function(){
	var url = $(this).attr('url');
	$.confirm("确定删除该记录吗？", function() {
	  $.get(url,function(){
		  $.toast("删除成功", function() {
			  window.location.href="<?php echo base_url() ; ?>sys/menu";
		  });
	  });
  	}, function() {
  
  	});
	return false;
});
</script>