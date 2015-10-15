$(document).ready(function(){
	
	$('body').on('click','.edit',function(e){
		$(this).text('Save');
		$(this).removeClass('btn-primary').removeClass('edit').addClass('save').addClass('btn-success');
	});
});