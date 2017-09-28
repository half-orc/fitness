//var ue = UE.getEditor('container',{imagePath:'/upload/ueditor',initialFrameWidth : 800,initialFrameHeight: 200});
var um = UM.getEditor('container',{
    	/* 传入配置参数,可配参数列表看umeditor.config.js */
        toolbar: ['undo redo | bold italic underline | image'],
        initialFrameHeight: 200
    });
//更改城市
$('#city').change(function(){
	var city_id = $('#city').val();
	var url = $('#host').val()+'sys/area/get_area_by_city/'+city_id;
	
	if(city_id){
		$.getJSON(url,function(data){
			var html = '<option></option>';
			if($.isEmptyObject(data)){
				$.alert("该城市未设置区");
			}else{
				$.each(data,function(index,value){
					html = html + "<option value='"+value.id+"'>"+value.name+"</option>";
				});
			}
			$('#area').html(html);
		});
	}
});