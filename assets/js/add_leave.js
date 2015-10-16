$(document).ready(function(){
	var s_date ='';
// $('.datepicker').datetimepicker({
// 	format: 'd-m-Y',
//     formatDate: 'm.d.Y',
//     timepicker: false,
//     minDate:'-1970/01/02'

// });
// $('.calendar_icon').click(function(){
// 	$(this).parent().find('.datepicker').datetimepicker('show');
// });
 $('#start_date').datetimepicker({
  format: 'd-m-Y',

  minDate:'-1970/01/02',
  onShow:function( ct ){
   this.setOptions({
    maxDate:$('#end_date').val()?$('#end_date').val():false
   })
  },
  onSelectDate:function( ct,$i ){
    s_date = ct.dateFormat('Y/m/d');
 }
});
 $('#end_date').datetimepicker({
  format: 'd-m-Y',
  onShow:function( ct ){
   this.setOptions({
    minDate:s_date
   })
  }
 });
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