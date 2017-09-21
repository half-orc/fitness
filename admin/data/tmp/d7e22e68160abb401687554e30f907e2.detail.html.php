<?php $this->display('inc/header.html', array (
)); ?>
<header class="demos-header">
	<h1 class="demos-title">
		<a href="<?php echo base_url() ; ?>sys/admin_role"> 
			<img src="<?php echo base_url() ; ?>static/images/back.png"> <span>返回</span>
		</a> 
		<img id="masterMenu" src="<?php echo base_url() ; ?>static/images/menu.png">
		<p>角色详情</p>
	</h1>
</header>
<?php $this->display('inc/menu.html', array (
)); ?>
<form id="dform">
<div class="weui-cells weui-cells_form">
	<div class="weui-cell">
		<div class="weui-cell__hd">
			<label class="weui-label">角色名称</label>
		</div>
		<div class="weui-cell__bd">
			<input class="weui-input" name="role_name" type="text" required
				value="<?php echo isset($this->_vars->result) ? $this->_vars->result['role_name'] : '' ; ?>"
				placeholder="参数名">
		</div>
	</div>

	<div class="weui-cells__title">描述</div>
	<div class="weui-cells weui-cells_form">
		<div class="weui-cell">
			<div class="weui-cell__bd">
				<textarea class="weui-textarea" name="description" placeholder="角色描述"
					rows="3">
					<?php echo isset($this->_vars->result) ? $this->_vars->result['description'] : '' ; ?>
				</textarea>
			</div>
		</div>
	</div>
	
	<div class="button_sp_area">
		<a href="javascript:;" class="weui-btn weui-btn_primary">保存</a>
        <?php if(isset($this->_vars->result) ) {  ?> 
        <a href="javascript:;" class="weui-btn weui-btn_default"
        url="<?php echo base_url() ; ?>sys/admin_role/status/<?php echo $this->_vars->result['role_id'] ; ?>/<?php echo $this->_vars->result['disabled'] ; ?>">
        	<?php if($this->_vars->result['disabled']=='0' ) {  ?>禁用<?php } else { ?>启用<?php } ?>
        </a>
        <?php } ?>
    </div>
</div>
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