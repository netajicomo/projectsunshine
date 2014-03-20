$(document).ready(function(){
  
   $('.slider').each(function(){
        var max = parseInt($(this).attr('data-max'), 10);
        var min = parseInt($(this).attr('data-min'), 10);
        var step = parseInt($(this).attr('data-step'), 10);
        var value = parseInt($(this).attr('data-start'), 10);
       
       $(this).slider({
                value: value,
                step: step,
		min: min,
		max: max,
		range: "min",
		slide: function( event, ui ) {
                    var id = $(this).attr('id').replace('slider_','');
			$('#value_'+id).val(ui.value);
      	}
	});
   }) 

	$(".switch").each(function(){
           var id = $(this).attr('id').replace('switch_', '');
            var max = parseInt($('#options_'+id).attr('data-max'),10)/1000000;
        var min = $('#options_'+id).attr('data-min')/1000000;
            
            $(this).switchButton({
	  on_label: '$'+max+'M',
	  off_label: '$'+min+'M',
	  width: 100,
	  height: 35,
	  button_width: 50,
	  
	});
        
        
        })
        
        var debt = $( "#totalSlider" ).attr('data-total');
        var debtString = '$ '+parseInt(debt,10)/100000000+' B';
$('#totalSlider .primeSlider').append('<style>.ui-slider-handle:before{content:"'+ debtString +'" !important;}</style>')
	$( "#totalSlider" ).slider({
                value:debt,
		min: 0,
		max: debt,
		range: "min",
		slide: function( event, ui ) {
                    var value = '$ '+Math.floor(parseInt(ui.value,10)/100000000)+' B'
			$('.primeSlider').append('<style>.ui-slider-handle:before{content:"'+ value +'" !important;}</style>')
      	}
	});				

	

});
