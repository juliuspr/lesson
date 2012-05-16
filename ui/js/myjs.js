$(document).ready(function() {


     $('.edit').editable('/lesson/book', {
         indicator : 'Saving...',
         tooltip   : 'Click to enter your name...',
		 name		:	'title'
     });

	 
     $('.event-title2').editable('http://localhost/cal/save.php', {
		indicator	:	'Saving...',
		tooltip		: 	'Click to enter your name',
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
	
	
	
 });
 