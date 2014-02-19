(function() {
	var htmlTitle = jQuery('#sz-video-hidden-generic-title').html();
	var htmlParms = jQuery('#sz-video-hidden-generic-parms').html();
	tinymce.create('tinymce.plugins.szvideogenericPlugin', {
		init: function(ed, url) {
			ed.addCommand('szmcegeneric', function() {
				ed.windowManager.open({
					file   : sz_ajaxurl + '?action=sz_generic&object=' + encodeURIComponent(htmlParms),
					width  : 525 + parseInt(ed.getLang('szvideo.delta_width',  0)),
					height : 450 + parseInt(ed.getLang('szvideo.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('sz_video_generic', {
				title : htmlTitle, 
				cmd   : 'szmcegeneric' 
			});
		},
		getInfo: function() {
			return {
				longname  : 'Video',
				author    : 'Start by Zero',
				authorurl : 'http://startbyzero.com/webmaster/',
				infourl   : 'http://startbyzero.com/webmaster/wordpress-plugin/sz-video/',
				version   : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('szvideogeneric', tinymce.plugins.szvideogenericPlugin);
})();