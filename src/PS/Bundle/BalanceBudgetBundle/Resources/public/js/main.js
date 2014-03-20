$(document).ready(function(){
	$( ".slider" ).slider({
		min: 0,
		max: 400000,
		range: "min",
		slide: function( event, ui ) {
			$('#value_1').val(ui.value);
      	}
	});

	

	$( "#totalSlider" ).slider({
		min: 0,
		max: 70,
		range: "min",
		slide: function( event, ui ) {
			$('#totalSlider .ui-slider-handle:after').text(ui.value);
      	}
	});				

	$(".switch").switchButton({
	  on_label: '$407M',
	  off_label: '$0',
	  width: 100,
	  height: 35,
	  button_width: 50,
	  toggleSwitch: function(){
	  	alert('ada');
	  }
	});

});
