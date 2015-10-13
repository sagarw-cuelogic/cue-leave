$(document).ready(function(){
	
	$('body').on('click','.edit',function(){
		$(this).text('Save');
		$(this).removeClass('btn-primary').removeClass('edit').addClass('save').addClass('btn-success');
		var data = $('.profile_form').serialize();
	});
	$('body').on('click','.save',function(){
		$(this).text('Edit');
		$(this).addClass('btn-primary').addClass('edit').removeClass('save').removeClass('btn-success');
		var data = $('.profile_form').serialize();
	})
});