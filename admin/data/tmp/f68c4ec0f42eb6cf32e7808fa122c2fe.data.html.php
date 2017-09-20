	<?php if(!empty($this->_vars->list) ) {  ?>
    <?php foreach($this->_vars->list as $this->_vars->key => $this->_vars->value ) {  ?>
	<div class="weui-form-preview__bd" onClick="javascript:window.location.href='<?php echo base_url() ; ?>sys/menu/detail/<?php echo $this->_vars->value['menu_id'] ; ?>'">
		<div class="weui-form-preview__item">
			<label class="weui-form-preview__label">菜单名(parent_id)</label> 
			<span class="weui-form-preview__value">
				<?php if($this->_vars->value['disabled']=='true' ) {  ?>
					<s><?php echo $this->_vars->value['menu_name'] ; ?></s>
				<?php } else { ?>	
					<?php echo $this->_vars->value['menu_name'] ; ?>
				<?php } ?>
				(<?php echo $this->_vars->value['parent_id'] ; ?>)
			</span>
		</div>
		<div class="weui-form-preview__item">
			<label class="weui-form-preview__label">model|ctrl</label> <span
				class="weui-form-preview__value"><?php echo $this->_vars->value['model'] ; ?>|<?php echo $this->_vars->value['ctrl'] ; ?></span>
		</div>
	</div>
	<div class="weui-form-preview__ft">
	</div>
	<?php } ?>
    <?php } ?>