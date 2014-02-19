(function() {
	var htmlTitle = jQuery('#sz-video-hidden-daily-title').html();
	var htmlParms = jQuery('#sz-video-hidden-daily-parms').html();
	tinymce.create('tinymce.plugins.szvideodailyPlugin', {
		init: function(ed, url) {
			ed.addCommand('szmcedaily', function() {
				ed.windowManager.open({
					file   : sz_ajaxurl + '?action=sz_daily&object=' + encodeURIComponent(htmlParms),
					width  : 525 + parseInt(ed.getLang('szvideo.delta_width',  0)),
					height : 450 + parseInt(ed.getLang('szvideo.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('sz_video_daily', {
				title : htmlTitle, 
				cmd   : 'szmcedaily' 
			});
		},
		getInfo: function() {
			return {
				longname  : 'Video DailyMotion',
				author    : 'Start by Zero',
				authorurl : 'http://startbyzero.com/webmaster/',
				infourl   : 'http://startbyzero.com/webmaster/wordpress-plugin/sz-video/',
				version   : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('szvideodaily', tinymce.plugins.szvideodailyPlugin);
})();