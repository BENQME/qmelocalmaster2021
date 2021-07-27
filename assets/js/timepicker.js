// tempusdominus-bootstrap-4
$(function() {
  'use strict';

  $('.form_datetime').datetimepicker({
	  sideBySide:true
  });
  $('.form_date').datetimepicker({
	   format: 'DD-MM-YYYY',
  });
  $('.form_time').datetimepicker({
	   format: 'LT',
  });
});