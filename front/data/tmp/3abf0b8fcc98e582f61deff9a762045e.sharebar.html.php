<div class="page-bd-15">
	<div class="weui-share" onclick="$(this).fadeOut();$(this).removeClass('fadeOut')">
		<div class="weui-share-box">
		点击右上角发送给指定朋友或分享到朋友圈 <i></i>
		</div>
	</div> 
</div>
<div class="weui-tabbar">
	<a href="<?php echo base_url() ; ?>order/date/<?php echo $this->_vars->course_id ; ?>/<?php echo $this->_vars->coach_id ; ?>" class="weui-tabbar__item" 
		style="webkit-flex:7;flex:7;background-color:#da3720;padding-top:0;height:12vw;line-height:12vw;">
		<span class="weui-tabbar__label" style="color: #fff;">立即约课</span>
	</a>
<!-- 	<a onclick="$('.weui-share').show().addClass('fadeIn');"  href="javascript:void(0)" class="weui-tabbar__item" 
		style="webkit-flex:3;flex:3;background-color:#333;height:12vw;line-height:12vw;padding-top:0;">
		<span class="weui-tabbar__label" style="color:#fff;">分享</span>
	</a> -->
</div>