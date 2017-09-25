$(function () {
	$(".weui-flex:not('.weui-cells_checkbox')").on('click',function(){
		if($(this).find('input').is(':checked')){
			$(this).find('input').prop("checked", false);
			$(this).next('.child-priv').find('input').prop("checked", false);
		}else{
			$(this).find('input').prop("checked", true);
			$(this).next('.child-priv').find('input').prop("checked", true);
		}
		return false;
	});
	
	$('.child-priv').on('click','input',function(){
		if($(this).is(':checked')) {
			$(this).parents('.child-priv').prev(".weui-flex:not('.weui-cells_checkbox')").find('input').prop("checked", true);
		}
	});
})