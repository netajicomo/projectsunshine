
CKEDITOR.plugins.add( 'tokens',
{   
   requires : ['richcombo'], //, 'styles' ],
   init : function( editor )
   {
      var config = editor.config,
       lang = editor.lang.format;

      // Gets the list of tags from the settings.
      var tags = []; //new Array();
      //this.add('value', 'drop_text', 'drop_label');
     
      tags[0]=["Blue", "Blue", "Blue"];
      tags[1]=["Hotel", "Hotel","Hotel"];
      tags[2]=["Driving", "Driving", "Driving"];
      tags[3]=["Flying", "Flying", "Flying"];
      tags[4]=["Visitors", "Visitors", "Visitors"];
      tags[5]=["Itinearies", "Itinearies", "Itinearies"];
      tags[6]=["Coaches", "Coaches", "Coaches"];
      tags[7]=["Buses", "Buses", "Buses"];
      tags[8]=["VehicleHire", "Vehicle Hire", "VehicleHire"];
      tags[9]=["WalksDrives", "Walks Drivers", "WalksDrives"];
      tags[10]=["Headsup", "Headsup", "Headsup"];
      tags[11]=["Home page button", "Home video button", "Home page button"];      
      
      // Create style objects for all defined styles.

      editor.ui.addRichCombo( 'Callout Boxes',
         {
            label : "Insert Callouts",
            title :"Insert Callouts",
            voiceLabel : "Insert Callouts",
            className : 'cke_format',
            multiSelect : false,
            //css: editor.skin.editor.css.concat(editor.config.contentsCss),
           

            panel :
            {
              
               css : [ config.contentsCss, CKEDITOR.getUrl( editor.skinPath + 'editor.css' ) ],
               voiceLabel : lang.panelVoiceLabel
            },

            init : function()
            {
              
               //this.add('value', 'drop_text', 'drop_label');
               for (var this_tag in tags){
                  this.add(tags[this_tag][0], tags[this_tag][1], tags[this_tag][2]);
               }
            },

            onClick : function( value )
            {  
               editor.focus();
               editor.fire( 'saveSnapshot' );
               
              
              switch (value)
                {
                case "Blue":
                   
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-blue"> <div class="callout-content">&nbsp;LOREM IPSUM &nbsp;DOLOR</div></div>');
                  break;
                case "Hotel":
                 editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-hotel"><div class="callout-content">&nbsp;LOREM IPSUM DOLOR</div></div>');
                 break;
                case "Driving":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-driving"><div class="callout-content">&nbsp;DRIVING</div></div>');
                  break;
                case "Flying":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-flying"><div class="callout-content">&nbsp;FLYING</div></div>');
                  break;
                case "Visitors":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-int-visitors"><div class="callout-content">&nbsp;INTERNATIONAL VISITORS</div></div>');
                  break;
                case "Itinearies":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-drive-itinearies"><div class="callout-content">&nbsp;DRIVE ITI NEARIES</div></div>');
                  break;
                case "Coaches":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-trains-coaches"><div class="callout-content">&nbsp;TRAINS AND COACHES</div></div>');
                  break;
                  
                case "Buses":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-buses"><div class="callout-content">&nbsp;BUSES</div></div>');
                  break;
                  
                case "VehicleHire":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-vehicle-hire"><div class="callout-content">&nbsp;VEHICLE HIRE</div></div>');
                  break;
                case "WalksDrives":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="callout-box-walks-drives"><div class="callout-content">&nbsp;SCENIC WALK AND DRIVES</div></div>');
                  break;
                case "Headsup":
                  editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)"><div class="headsup" style="margin-bottom:18px;">&nbsp;<strong>Heads up!</strong> This alert needs your attention, but its not super important.</div>');
                  break;
                case "Home page button":
                   editor.insertHtml('<div id="253" class="data-video" data-cke-pa-onmouseover="CKEditorHoverVideo("id", true)">&nbsp;<h2>Lorem ipsum dolor sit amet</h2><div class="home-video-content">'+
        '<p>Sed eros justo, eleifend sollicitudin ante a, laoreet'+
        'eleifend massa. Etiam id euismod sem. Aenean nec nulla gravida, lobortis dui nec, placerat ante.'+
        'Etiam ornare non ipsum in egestas.</p>');
                   break;
                
                }
              
            editor.fire( 'saveSnapshot' );
            }
         });
   }
});