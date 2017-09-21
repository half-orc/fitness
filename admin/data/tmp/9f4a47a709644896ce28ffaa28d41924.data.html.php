	<?php if(!empty($this->_vars->list) ) {  ?>
    <?php foreach($this->_vars->list as $this->_vars->key => $this->_vars->value ) {  ?>
	<div class="weui-form-preview__bd" onClick="javascript:window.location.href='<?php echo base_url() ; ?>sys/admin_role/detail/<?php echo $this->_vars->value['role_id'] ; ?>'">
		<div class="weui-form-preview__item">
			<label class="weui-form-preview__label">角色名称</label> 
			<span class="weui-form-preview__value">
				<?php if($this->_vars->value['disabled']=='1' ) {  ?>
					<s><?php echo $this->_vars->value['role_name'] ; ?></s>
				<?php } else { ?>	
					<?php echo $this->_vars->value['role_name'] ; ?>
				<?php } ?>
			</span>
		</div>
		<div class="weui-form-preview__item">
			<label class="weui-form-preview__label">描述</label> <span
				class="weui-form-preview__value"><?php echo $this->_vars->value['description'] ; ?></span>
		</div>
		<a href="<?php echo base_url() ; ?>sys/admin_role/priv/<?php echo $this->_vars->value['role_id'] ; ?>" class="weui-btn weui-btn_mini weui-btn_primary">查看权限</a>
	</div>
	<div class="weui-form-preview__ft">
	</div>
	<?php } ?>
    <?php } ?>