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
		change: function( event, ui ) {
                    var id = $(this).attr('id').replace('slider_','');
			var value = $('#value_'+id).val();
                       
                            var debtValue = value - ui.value
                          $('#debt_value_'+id).val(-debtValue);
                         
                          
                         $('#value_'+id).val(ui.value); 
                    saveIssue(id, ui.value);    
      	}
	});
   }) 

	$(".switch").each(function(){
           var id = $(this).attr('id').replace('switch_', '');
           var dataMax = $('#options_'+id).attr('data-max');
           var dataMin = $('#options_'+id).attr('data-min');
            var max = parseInt(dataMax,10);
            var min = parseInt(dataMin,10);
            
            $(this).switchButton({
	  on_label: '$'+max+'M',
	  off_label: '$'+min+'M',
	  width: 100,
	  height: 35,
	  button_width: 50,
          on_callback: function(){  $('#value_'+id).val(dataMax);   saveIssue(id, dataMax);  $('#debt_value_'+id).val(dataMax);      },
          off_callback: function(){ 
              if( $('#value_'+id).hasClass('loaded'))
              {
                  saveIssue(id, dataMin);
                   $('#debt_value_'+id).val(-dataMax);  
                   $('#value_'+id).removeClass('loaded');
              }
              $('#value_'+id).addClass('loaded');
              
              $('#value_'+id).val(dataMin);  
             
                                        
          }
	  
	});
        
        
        })
        
        var debt = $( "#totalSlider" ).attr('data-total');
  //      var debtString = '$ '+parseInt(debt,10)/100000000+' B';
//$('#totalSlider .primeSlider').append('<style>.ui-slider-handle:before{content:"'+ debtString +'" !important;}</style>')
	var totalSlider = $( "#totalSlider" ).slider({
                value:debt,
		min: 0,
		max: debt,
		range: "min",
		slide: function( event, ui ) {
                  //  var value = '$ '+Math.floor(parseInt(ui.value,10)/100000000)+' B'
		//	$('#totalSlider .primeSlider').append('<style>.ui-slider-handle:before{content:"'+ value +'" !important;}</style>')
                    
                }
	});
        
        totalSlider.find( ".ui-slider-handle" ).append( "<span class='sliderValue'>$<em>"+(debt/1000).toFixed(2)+"</em> B </span>" );

	/** Planner page add comment toggle **/        
        $( ".add-comment" ).click(function(e) {
            e.preventDefault();
            $(this).toggleClass( "add-comment-open" );
            $(this).parents('.subSection').find(".comment-wrapper" ).slideToggle( "slow" );
        });

});

$(function() {
    var fixadent = $("#fixedheader"), pos = fixadent.offset();
    $(window).scroll(function() {
        if($(this).scrollTop() > (pos.top) && fixadent.css('position') == 'static') { fixadent.addClass('fixed-header'); }
        else if($(this).scrollTop() <= pos.top && fixadent.hasClass('fixed-header')){ fixadent.removeClass('fixed-header'); }
    });
});
