<script type="text/javascript">
var SZVideoDialog = 
{
	local_ed : 'ed',

	init: function(ed) {
		SZVideoDialog.local_ed = ed;
		tinyMCEPopup.resizeToInnerSize();
	},

	insert: function insertButton(ed) {
		tinyMCEPopup.execCommand('mceRemoveNode',false,null);
 
		var url       = jQuery('#szvideo-dialog input#sz-video-url').val();
		var cover     = jQuery('#szvideo-dialog input#sz-video-cover').val();
		var caption   = jQuery('#szvideo-dialog input#sz-video-caption').val();
		var width     = jQuery('#szvideo-dialog input#sz-video-width').val();
		var height    = jQuery('#szvideo-dialog input#sz-video-height').val();
		var mtop      = jQuery('#szvideo-dialog input#sz-video-mt').val();
		var mright    = jQuery('#szvideo-dialog input#sz-video-mr').val();
		var mbottom   = jQuery('#szvideo-dialog input#sz-video-mb').val();
		var mleft     = jQuery('#szvideo-dialog input#sz-video-ml').val();
		var munits    = jQuery('#szvideo-dialog select#sz-video-um').val();
		var respons   = jQuery('#szvideo-dialog select#sz-video-rs').val();
		var autoplay  = jQuery('#szvideo-dialog select#sz-video-autoplay').val();
		var loop      = jQuery('#szvideo-dialog select#sz-video-loop').val();
		var float     = jQuery('#szvideo-dialog select#sz-video-float').val();
		var method    = jQuery('#szvideo-dialog select#sz-video-method').val();
		var onlyurl   = jQuery('#szvideo-dialog select#sz-video-onlyurl').val();
		var ratio     = jQuery('#szvideo-dialog input#sz-video-ratio').val();
		var userdata  = jQuery('#szvideo-dialog input#sz-video-userdata').val();
		var schemaorg = jQuery('#szvideo-dialog select#sz-video-schemaorg').val();
 
		var output = '';

		if (url !== '' ) {
			output = '[<?php echo SZVIDEO_SHORTCODE_NAMES ?> ';
			output += 'url="' + url + '" ';
			if (width     !== '' ) output += 'width="'        + width     + '" ';
			if (height    !== '' ) output += 'height="'       + height    + '" ';
			if (cover     !== '' ) output += 'cover="'        + cover     + '" ';
			if (caption   !== '' ) output += 'caption="'      + caption   + '" ';
			if (mtop      !== '' ) output += 'margintop="'    + mtop      + '" ';
			if (mright    !== '' ) output += 'marginright="'  + mright    + '" ';
			if (mbottom   !== '' ) output += 'marginbottom="' + mbottom   + '" ';
			if (mleft     !== '' ) output += 'marginleft="'   + mleft     + '" ';
			if (munits    !== '' ) output += 'units="'        + munits    + '" ';
			if (respons   !== '' ) output += 'responsive="'   + respons   + '" ';
			if (autoplay  !== '' ) output += 'autoplay="'     + autoplay  + '" ';
			if (loop      !== '' ) output += 'loop="'         + loop      + '" ';
			if (float     !== '' ) output += 'float="'        + float     + '" ';
			if (method    !== '' ) output += 'method="'       + method    + '" ';
			if (onlyurl   !== '' ) output += 'onlyurl="'      + onlyurl   + '" ';
			if (ratio     !== '' ) output += 'ratio="'        + ratio     + '" ';
			if (userdata  !== '' ) output += 'userdata="'     + userdata  + '" ';
			if (schemaorg !== '' ) output += 'schemaorg="'    + schemaorg + '" ';
			output += '/]';
		}
		
		tinyMCEPopup.execCommand('mceReplaceContent',false,output);
		tinyMCEPopup.close();
	}
};
tinyMCEPopup.onInit.add(SZVideoDialog.init, SZVideoDialog);
</script>
</head>
<body>
	<div id="szvideo-dialog">
		<form action="/" method="get" accept-charset="utf-8">
			<div><input type="text" name="sz-video-url" value="" id="sz-video-url" placeholder="<?php echo $parametri['address'] ?>"/></div>
			<div><input type="text" name="sz-video-cover" value="" id="sz-video-cover" placeholder="<?php echo $parametri['coverURL'] ?>"/></div>
			<div><input type="text" name="sz-video-caption" value="" id="sz-video-caption" placeholder="<?php echo $parametri['caption'] ?>"/></div>
			<table>
			<tr><td class="sz-cols">
				<div><p><?php echo $parametri['size'] ?></p></div>
				<div>
					<label for="sz-video-rs"><?php echo $parametri['respons'] ?></label>
					<select id="sz-video-rs" name="sz-video-rs">
						<option value=""><?php echo $parametri['default'] ?></option>
						<option value="Y"><?php echo $parametri['yes'] ?></option>
						<option value="N"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
				<div>
					<label for="sz-video-width"><?php echo $parametri['width'] ?></label>
					<input type="number" step="1" min="0" name="sz-video-width" value="" id="sz-video-width"/>
				</div>
				<div>
					<label for="sz-video-height"><?php echo $parametri['height'] ?></label>
					<input type="number" step="1" min="0" name="sz-video-height" value="" id="sz-video-height"/>
				</div>
				<div><p><?php echo $parametri['margins'] ?></p></div>
				<div>
					<label for="sz-video-mt"><?php echo $parametri['mtop'] ?></label>
					<input type="number" step="1" name="sz-video-mt" value="" id="sz-video-mt"/>
				</div>
				<div>
					<label for="sz-video-mr"><?php echo $parametri['mright'] ?></label>
					<input type="number" step="1" name="sz-video-mr" value="" id="sz-video-mr"/>
				</div>
				<div>
					<label for="sz-video-mb"><?php echo $parametri['mbottom'] ?></label>
					<input type="number" step="1" name="sz-video-mb" value="" id="sz-video-mb"/>
				</div>
				<div>
					<label for="sz-video-ml"><?php echo $parametri['mleft'] ?></label>
					<input type="number" step="1" name="sz-video-ml" value="" id="sz-video-ml"/>
				</div>
				<div>
					<label for="sz-video-um"><?php echo $parametri['munit'] ?></label>
					<select id="sz-video-um" name="sz-video-um">
						<option value=""><?php echo $parametri['default'] ?></option>
						<option value="em">em</option>
						<option value="px">px</option>
					</select>
				</div>
			</td><td class="sz-cols" style="padding-left:10px">
				<div><p><?php echo $parametri['attribute'] ?></p></div>
				<div>
					<label for="sz-video-autoplay"><?php echo $parametri['autoplay'] ?></label>
					<select id="sz-video-autoplay" name="sz-video-autoplay">
						<option value=""><?php echo $parametri['none'] ?></option>
						<option value="N"><?php echo $parametri['yes'] ?></option>
						<option value="Y"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
				<div>
					<label for="sz-video-loop"><?php echo $parametri['loop'] ?></label>
					<select id="sz-video-loop" name="sz-video-loop">
						<option value=""><?php echo $parametri['none'] ?></option>
						<option value="N"><?php echo $parametri['yes'] ?></option>
						<option value="Y"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
				<div>
					<label for="sz-video-float"><?php echo $parametri['float'] ?></label>
					<select id="sz-video-float" name="sz-video-float">
						<option value=""><?php echo $parametri['none'] ?></option>
						<option value="R"><?php echo $parametri['right'] ?></option>
						<option value="L"><?php echo $parametri['left'] ?></option>
					</select>
				</div>
				<div><p><?php echo $parametri['others'] ?></p></div>
				<div>
					<label for="sz-video-method"><?php echo $parametri['method'] ?></label>
					<select id="sz-video-method" name="sz-video-method">
						<option value=""><?php echo $parametri['default'] ?></option>
						<option value="N"><?php echo $parametri['yes'] ?></option>
						<option value="Y"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
				<div>
					<label for="sz-video-onlyurl"><?php echo $parametri['onlyurl'] ?></label>
					<select id="sz-video-onlyurl" name="sz-video-onlyurl">
						<option value=""><?php echo $parametri['none'] ?></option>
						<option value="N"><?php echo $parametri['yes'] ?></option>
						<option value="Y"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
				<div>
					<label for="sz-video-ratio"><?php echo $parametri['ratio'] ?></label>
					<input type="text" name="sz-video-ratio" value="" id="sz-video-ratio"/>
				</div>
				<div>
					<label for="sz-video-userdata"><?php echo $parametri['userdata'] ?></label>
					<input type="text" name="sz-video-userdata" value="" id="sz-video-userdata"/>
				</div>
				<div>
					<label for="sz-video-schemaorg"><?php echo $parametri['schemaorg'] ?></label>
					<select id="sz-video-schemaorg" name="sz-video-schemaorg">
						<option value=""><?php echo $parametri['none'] ?></option>
						<option value="N"><?php echo $parametri['yes'] ?></option>
						<option value="Y"><?php echo $parametri['no'] ?></option>
					</select>
				</div>
			</tr></table>
			<div class="szvideo-button" style="float:left">
				<a href="javascript:SZVideoDialog.insert(SZVideoDialog.local_ed)" id="cancel" style="display:block; line-height:24px;"><?php echo ucfirst($parametri['remove']) ?></a>
			</div>
			<div class="szvideo-button" style="float:right">
				<a href="javascript:SZVideoDialog.insert(SZVideoDialog.local_ed)" id="insert" style="display:block; line-height:24px;"><?php echo ucfirst($parametri['insert']) ?></a>
			</div>
		</form>
	</div>
</body>
</html>