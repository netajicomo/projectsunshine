$(document).ready(function(){
  // for the sliders
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
   // for the select boxes
   $('.selectType').each(function(){
      var id = $(this).attr('id').replace('select_','');
      $(this).on('change', function() {
    $('#value_'+id).val( this.value ); 
     saveIssue(id, this.value);    
    });
       
   });
   
   // for the radio buttons in the issue group
   $('.issuegroupradio').click(function(){
        var name = $(this).attr('name');
        var theId = $(this).attr('id').replace('radio_','');
        $('#value_'+theId).val( this.value ); 
         saveIssue(theId, this.value);    
       $('input:radio[name="'+name+'"]').each(function(){
              var id = $(this).attr('id').replace('radio_','');
              
          if(id != theId)    
          {
               saveIssue(id, '0');    
               $('#value_'+id).val('0'); 
          }
       })
      
   })
    var sliderIds = {}; 
   $('.issuegroupslider').each(function(){
         var max = parseInt($(this).attr('data-max'), 10);
        var min = parseInt($(this).attr('data-min'), 10);
        var step = parseInt($(this).attr('data-step'), 10);
        var value = parseInt($(this).attr('data-start'), 10);
      
       var $id = $(this).attr('id').replace('issuegroupslider_','');
        sliderIds[$id] = min;
         $(this).slider({
                value: value,
                step: step,
		min: min,
		max: max,
		range: "min",
		change: function( event, ui ) {
                              
                        var theId = $(this).attr('id').replace('issuegroupslider_',''); 
                         $('#value_'+theId).val(ui.value); 
                    saveIssue(theId, ui.value);  
                   for(var key in sliderIds)
                    {
                        if(theId != key)
                           {
                            console.log(key);
                            console.log(sliderIds[key]);
                              $('#value_'+key).val(sliderIds[key]); 
                             if(ui.value != 0) 
                             $('#issuegroupslider_'+key).slider({ disabled: true }); 
                             else
                             $('#issuegroupslider_'+key).slider({ disabled: false });     
                                saveIssue(key, sliderIds[key]);  
                           } 
                    }

      	}
	});
       
   })
   
// for the switches
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
