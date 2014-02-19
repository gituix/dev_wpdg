(function() {
	var htmlTitle = jQuery('#sz-video-hidden-vimeo-title').html();
	var htmlParms = jQuery('#sz-video-hidden-vimeo-parms').html();
	tinymce.create('tinymce.plugins.szvideovimeoPlugin', {
		init: function(ed, url) {
			ed.addCommand('szmcevimeo', function() {
				ed.windowManager.open({
					file   : sz_ajaxurl + '?action=sz_vimeo&object=' + encodeURIComponent(htmlParms),
					width  : 525 + parseInt(ed.getLang('szvideo.delta_width',  0)),
					height : 450 + parseInt(ed.getLang('szvideo.delta_height', 0)),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('sz_video_vimeo', {
				title : htmlTitle, 
				cmd   : 'szmcevimeo' 
			});
		},
		getInfo: function() {
			return {
				longname  : 'Video Vimeo',
				author    : 'Start by Zero',
				authorurl : 'http://startbyzero.com/webmaster/',
				infourl   : 'http://startbyzero.com/webmaster/wordpress-plugin/sz-video/',
				version   : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('szvideovimeo', tinymce.plugins.szvideovimeoPlugin);
})();