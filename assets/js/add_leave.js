$(document).ready(function(){
$('.datepicker').datetimepicker({
	minDate: new Date(),
	useCurrent:true,
	format:'MM/DD/YYYY',
	defaultDate:''
});

$('.date').val("");
$('.end_date').val("");
$('.start_date').val("");

$('body').on('click','.leaves',function(){
	
	var leave_plan = $(this).val();

	if(leave_plan == 'more_then_day'){
		$('.more_then_day_leave').show();
		$('.one_day_leave').hide();
	}else {
		
		$('.one_day_leave').show();
		$('.more_then_day_leave').hide();
	}
});
if ($("input[name='leave_plan']:checked").val()) {
	var leave_plan = $("input[name='leave_plan']:checked").val();
	
	if(leave_plan == 'more_then_day'){
		$('.more_then_day_leave').show();
		$('.one_day_leave').hide();
	}else {
		
		$('.one_day_leave').show();
		$('.more_then_day_leave').hide();
	}
}

$("#form_date").on("dp.change", function (e) {
	$('#end_date').data("DateTimePicker").minDate(e.date);
	$('.end_date').val("");
});

$("#end_date").on("dp.change", function (e) {
	$('#form_date').data("DateTimePicker").maxDate(e.date);
});

$('body').on('submit','.add_leave_form',function(e){


})
});