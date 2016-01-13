$(document).ready(function() {
var $t_start = $('#transport_from_date'),
	$t_end = $('#transport_till_date');

	$t_start.datepicker({
		autoClose:true,
		position: "right top",
		dateFormat: 'dd-mm-yyyy',
		onSelect: function (fd, date) {
			$t_end.data('datepicker')
				.update('minDate', date)
		}
	})

	$t_end.datepicker({
		autoClose:true,
		position: "right top",
		dateFormat: 'dd-mm-yyyy',
		onSelect: function (fd, date) {
			$t_start.data('datepicker')
				.update('maxDate', date)
		}
		
	})
var $c_start = $('#ship_from_date'),
	$c_end = $('#ship_till_date');

	$c_start.datepicker({
		autoClose:true,
		position: "right top",
		dateFormat: 'dd-mm-yyyy',
		onSelect: function (fd, date) {
			$c_end.data('datepicker')
				.update('minDate', date)
		}
	})

	$c_end.datepicker({
		autoClose:true,
		position: "right top",
		dateFormat: 'dd-mm-yyyy',
		onSelect: function (fd, date) {
			$c_start.data('datepicker')
				.update('maxDate', date)
		}
		
	})

});