$(document).ready(function() {


     $('.edit').editable('/lesson/book', {
         indicator : 'Saving...',
         tooltip   : 'Click to edit...',
		 name		:	'title'
     });
	 
     $('.event-title2').editable('http://localhost/cal/save.php', {
		indicator	:	'Saving...',
		tooltip		: 	'Click to edit',
		submit		:	'OK',
		cancel		:	'Cancel',
		style		:	'position:absolute',
		width		:	'100',
		height		:	'20'
	 });
	 
	 
	$('#datepicker').datepicker({
		showWeek : true,
		firstDay : 1,
		showButtonPanel : true,
		dateFormat : 'yy-mm-dd'
	
	});
	$('#datepicker2').datepicker({
		showWeek : true,
		firstDay : 1,
		showButtonPanel : true,
		dateFormat : 'yy-mm-dd'
	
	});
	



	$(".add-new").colorbox({
		inline:true, 
		href:"#add-new"
	});
	
	$(".event-book").colorbox({
		inline:true, 
		href:"#edit-booking"
	});
	$(".event-unbook").colorbox({
		inline:true, 
		href:"#edit-unbooking"
	});
	$(".event_add_comment").colorbox({
		inline:true, 
		href:"#edit_add_comment"
	});
	$(".event_move").colorbox({
		inline:true, 
		href:"#edit_move"
	});
	

	
	
	
 });
 
