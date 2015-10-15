$(document).ready(function(){
	var leave_id ='',
		leave_status;

	$('body').on('change','.select-menu',function(){

		 leave_status = $(this).val();
		 leave_id     = $(this).data('leave-id');
		
		if(leave_status!=''){
			$("#leave_action_modal").modal({show:true});
		}
	});

	$('body').on('submit','.leave_action_form',function(e){

		e.preventDefault();

		if($("#leave_comments").val()==''){
		return false;
		} else {
			var data = $(this).serialize();
				
			data+="&leave_id="+leave_id+"&leave_status="+leave_status;

			$.ajax({
				url:base_url+'leave/ajaxLeaveAction',
				type:'POST',
				data:data,
				success:function(e){
					location.reload();
				}
			});
		}
	});
	$('body').on('click','.view_leave_calendar',function(e){

	leave_id     = $(this).data('leave-id');
	var user_id  = $(this).data('user-id');
	var data     = {'leave_id':leave_id,'user_id':user_id}
	$.ajax({
		url:base_url+'leave_calendar/generateLeaveCalender/',
		type:'POST',
		data:data,
		success:function(e){
			$('.calendar_content').html(e);
			$("#calendar").modal({show:true});
		}
	});

	});
});