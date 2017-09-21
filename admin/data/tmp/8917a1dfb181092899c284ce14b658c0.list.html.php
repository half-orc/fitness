<?php $this->display('inc/header.html', array (
)); ?>
<header class="demos-header">
	<h1 class="demos-title">
		<a href="<?php echo base_url() ; ?>welcome"> 
			<img src="<?php echo base_url() ; ?>static/images/back.png"> <span>首页</span>
		</a> 
		<img id="masterMenu" src="<?php echo base_url() ; ?>static/images/menu.png">
		<p>系统参数列表&nbsp;<img src="<?php echo base_url() ; ?>static/images/add.png" onclick="window.location.href='<?php echo base_url() ; ?>sys/param/detail/'"></p>
	</h1>
</header>
<?php $this->display('inc/menu.html', array (
)); ?>
<div class="weui-form-preview"></div>
<div class="weui-loadmore">
  <i class="weui-loading"></i>
  <span class="weui-loadmore__tips">正在加载</span>
</div>
<?php $this->display('inc/footer.html', array (
)); ?>
<script>
var page = 1;
var loading = false;  //状态标记
getData(page);
function getData(pages){
	$.ajax({
		type:"POST",
		data:{search:$('#searchInput').val()},
		url:$('#host').val()+'sys/param/getData/'+pages,
		success:function(res){
			if(res.length > 10){
				$('.weui-form-preview').append(res);
				if(res.match(/weui-form-preview__bd/g).length < <?php echo $this->_vars->pageSize ; ?>){
					$('.weui-loadmore').html('没有更多了');
				}else{
					loading = false;
				}
			}else{
				$('.weui-loadmore').html('没有更多了');
			}
		}
	});
}
function search(){
	$('.weui-form-preview').html('');
	getData(page);
}
$(document.body).infinite().on("infinite", function() {
  if(loading) return;
  loading = true;
  page = page + 1;
  getData(page);
});
</script>
