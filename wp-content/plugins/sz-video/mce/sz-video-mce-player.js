(function() {
	var htmlTitle = jQuery('#sz-video-hidden-player-title').html();
	var htmlParms = jQuery('#sz-video-hidden-player-parms').html();
	tinymce.create('tinymce.plugins.szvideoplayerPlugin', {
		init: function(ed, url) {
			ed.addCommand('szmceplayer', function() {
				ed.windowManager.open({
					file   : sz_ajaxurl + '?action=sz_player&object=' + encodeURIComponent(htmlParms),
					width  : 525 + parseInt(ed.getLang('szvideo.delta_width',  0)),
					height : 450 + parseInt(ed.getLang('szvideo.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('sz_video_player', {
				title : htmlTitle, 
				cmd   : 'szmceplayer' 
			});
		},
		getInfo: function() {
			return {
				longname  : 'Video Player',
				author    : 'Start by Zero',
				authorurl : 'http://startbyzero.com/webmaster/',
				infourl   : 'http://startbyzero.com/webmaster/wordpress-plugin/sz-video/',
				version   : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('szvideoplayer', tinymce.plugins.szvideoplayerPlugin);
})();