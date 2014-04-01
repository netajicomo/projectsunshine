/*
 * @file HTML Buttons plugin for CKEditor
 * Copyright (C) 2012 Alfonso Mart�nez de Lizarrondo
 * A simple plugin to help create custom buttons to insert HTML blocks
 */


CKEDITOR.plugins.add( 'htmlbuttons',
{
	init : function( editor )
	{
		var buttonsConfig = editor.config.htmlbuttons;
		if (!buttonsConfig)
			return;

		function createCommand( definition )
		{
			return {
				exec: function( editor ) {
					editor.insertHtml( definition.html );
				}
			};
		}

		// Create the command for each button
		for(var i=0; i<buttonsConfig.length; i++)
		{
			var button = buttonsConfig[ i ];
			var commandName = button.name;
			editor.addCommand( commandName, createCommand(button, editor) );

			editor.ui.addButton( commandName,
			{
				label : button.title,
				command : commandName,
				icon : this.path + button.icon
			});
		}
	} //Init

} );

/**
 * An array of buttons to add to the toolbar.
 * Each button is an object with these properties:
 *	name: The name of the command and the button (the one to use in the toolbar configuration)
 *	icon: The icon to use. Place them in the plugin folder
 *	html: The HTML to insert when the user clicks the button
 *	title: Title that appears while hovering the button
 *
 * Default configuration with some sample buttons:
 */
CKEDITOR.config.htmlbuttons =  [
        {
		name:'button0',
		icon:'icon1.png',
		html:'<div class="headsup" style="margin-bottom:18px;"><strong>Heads up!</strong> This alert needs your attention, but its not super important.</div>',
		title:'Handsupcontent'
	},
	{
		name:'button1',
		icon:'icon1.png',
		html:'<div class="callout-box-blue"> <div class="callout-content">LOREM IPSUM DOLOR</div></div>',
		title:'Blue'
	},

	{
		name:'button2',
		icon:'icon2.png',
		html:'<div class="callout-box-hotel"><div class="callout-content">LOREM IPSUM DOLOR</div></div>',
		title:'Hotel'
	},
	{
		name:'button3',
		icon:'icon3.png',
		html:'  <div class="callout-box-driving"><div class="callout-content">DRIVING</div></div>',
		title:'Driving'
	},
        {
		name:'button4',
		icon:'icon1.png',
		html:' <div class="callout-box-flying"><div class="callout-content">FLYING</div></div>',
		title:'Flying'
	},
	{
		name:'button5',
		icon:'icon2.png',
		html:'<div class="callout-box-int-visitors"><div class="callout-content">INTERNATIONAL VISITORS</div></div>',
		title:'Visitors'
	},
	{
		name:'button6',
		icon:'icon3.png',
		html:'  <div class="callout-box-drive-itinearies"><div class="callout-content">DRIVE ITI NEARIES</div></div>',
		title:'Itinearies'
	},
        {
		name:'button7',
		icon:'icon1.png',
		html:'<div class="callout-box-trains-coaches"><div class="callout-content">TRAINS AND COACHES</div></div>',
		title:'Trains-coaches'
	},
	{
		name:'button8',
		icon:'icon2.png',
		html:' <div class="callout-box-buses"><div class="callout-content">BUSES</div></div>',
		title:'Buses'
	},
	{
		name:'button9',
		icon:'icon3.png',
		html:' <div class="callout-box-vehicle-hire"><div class="callout-content">VEHICLE HIRE</div></div>',
		title:'Vehicle-hire'
	},
        {
		name:'button10',
		icon:'icon3.png',
		html:'  <div class="callout-box-walks-drives"><div class="callout-content">SCENIC WALK AND DRIVES</div></div>',
		title:'Walks-drives'
	},
    {
        name: 'button11',
        icon: 'icon3.png',
        html: '<h2>Lorem ipsum dolor sit amet</h2><div class="home-video-content">'+
        '<p>Sed eros justo, eleifend sollicitudin ante a, laoreet'+
        'eleifend massa. Etiam id euismod sem. Aenean nec nulla gravida, lobortis dui nec, placerat ante.'+
        'Etiam ornare non ipsum in egestas.</p>'+
        '<div class="row-fluid">'+
            '<div class="span4">'+
                '<a class="btn btn-inverse" href="#"> Call to Action</a>'+
            '</div>'+
            '</div>',
        title:'home-generic-content'
    }
];