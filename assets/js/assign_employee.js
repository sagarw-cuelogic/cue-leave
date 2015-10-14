$(document).ready(function(){

$('body').on('click','.assign',function(){
	$id = $(this).data('emp-id');
	var $this = $(this);
	var data={'user_id':$id};
	$(this).removeClass('assign').addClass('unassigned');
	$.ajax({
		url : base_url + "admin/assign_to_manager/assign",
		type:'POST',
		data:data,
		success:function(e){
			$this.text('De-assign');
			$this.parent().siblings('.status').text('Assigned');
			alert("Added Successfully");
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
			$this.text('Assign');
			$this.parent().siblings('.status').text('Pending');
			alert("Unassigned Successfully");
		}
	})
});
});