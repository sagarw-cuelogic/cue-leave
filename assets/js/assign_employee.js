$(document).ready(function(){
var user_id ='';
$('body').on('submit','#manager_form',function(e){
	e.preventDefault();
	var data=$("#manager_form").serialize();
		data+="&user_id="+$id;
	$.ajax({
		url : base_url + "admin/assign_to_manager/assign",
		type:'POST',
		data:data,
		success:function(e){
			location.reload();
		}
	})
});
$('body').on('click','.assign',function(){
	$id = $(this).data('emp-id');
	user_id = $id;
	var data = {'id':$id}
	$.ajax({
		url : base_url + "manager/getManagers",
		type:'POST',
		data:data,
		success:function(e){
			$('.manager_list').html(e);
		}
	})
});
$('body').on('click','.unassigned',function(){
	$id = $(this).data('emp-id');
	var $this = $(this);
	var data={'user_id':$id};
	$(this).removeClass('unassigned').addClass('assign');
	$.ajax({
		url : base_url + "admin/assign_to_manager/unassign",
		type:'POST',
		data:data,
		success:function(e){
			alert("Unassigned Successfully");
			location.reload();
		}
	})
});
});