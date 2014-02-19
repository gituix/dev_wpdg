(function() {
	var htmlTitle = jQuery('#sz-video-hidden-youtube-title').html();
	var htmlParms = jQuery('#sz-video-hidden-youtube-parms').html();
	tinymce.create('tinymce.plugins.szvideoyoutubePlugin', {
		init: function(ed, url) {
			ed.addCommand('szmceyoutube', function() {
				ed.windowManager.open({
					file   : sz_ajaxurl + '?action=sz_youtube&object=' + encodeURIComponent(htmlParms),
					width  : 525 + parseInt(ed.getLang('szvideo.delta_width',  0)),
					height : 450 + parseInt(ed.getLang('szvideo.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('sz_video_youtube', {
				title : htmlTitle, 
				cmd   : 'szmceyoutube' 
			});
		},
		getInfo: function() {
			return {
				longname  : 'Video Youtube',
				author    : 'Start by Zero',
				authorurl : 'http://startbyzero.com/webmaster/',
				infourl   : 'http://startbyzero.com/webmaster/wordpress-plugin/sz-video/',
				version   : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('szvideoyoutube', tinymce.plugins.szvideoyoutubePlugin);
})();