function tempGetTweet( tweets ){
    if ( ! ( window.tweetsCount ) ){
        window.tweetsCount = 0;
    }
    window.tweetsCount++;
    window['twigetTweets-' + window.tweetsCount] = tweets;
}

function tempTwitter( target, options ) {
  
    var statusHTML = [];
    var twitters = window['twigetTweets-' + window.tweetsCount];
    
	tweetcount = twitters.length;
	if ( tweetcount > options.count ) tweetcount = options.count;
	
    for (var i = 0; i < tweetcount; i++){
        var username = twitters[i].user.screen_name;
        var status = twitters[i].text
        
        // Linkify links
        status = status.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
          return '<a href="'+url+'">'+url+'</a>';
        });
        
        // Linkify @
        status = status.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
          return  reply.charAt(0)+'<a href="http://twitter.com/#!/'+reply.substring(1)+'">'+reply.substring(1)+'</a>';
        });
        
        // Linkify hashtags
        status = status.replace(/(^|[^&\w'"]+)\#([a-zA-Z0-9_^"^<]+)/g, function(m, m1, m2) {
            return m.substr(-1) === '"' || m.substr(-1) == '<' ? m : m1 + '<strong>#<a href="http://twitter.com/#!/search/%23' + m2 + '">' + m2 + '</a></strong>';
        });
        
        status = ('<li><span>'+status+'</span> <div class="tweet-rel-time" >'+date_time(twitters[i].created_at)+'</div></li>');

        if ( options.newwindow )
            status = status.replace( /<a href=/gi, '<a target="_blank" href=' );
        
        statusHTML.push(status);
    }
    document.getElementById( target ).innerHTML = statusHTML.join('');
}

function date_time(time_value ){
	var months = new Array(12);
	months[0] = "January";
	months[1] = "February";
	months[2] = "March";
	months[3] = "April";
	months[4] = "May";
	months[5] = "June";
	months[6] = "July";
	months[7] = "August";
	months[8] = "September";
	months[9] = "October";
	months[10] = "November";
	months[11] = "December";

	var newtime_value = time_value.replace(/(\d{1,2}[:]\d{2}[:]\d{2}) (.*)/, '$2 $1');
	//moving the time code to the end
	newdate = newtime_value.replace(/(\+\S+) (.*)/, '$2 $1')
	var date = new Date(Date.parse(newdate)).toLocaleDateString();
	var time = new Date(Date.parse(newdate)).toLocaleTimeString();
	var d = new Date(date);
	return months[ d.getMonth()]  + ' ' + d.getDay() + ', ' + d.getFullYear();

// return the formatted string //
	//return date.substr(0, 11)+' • ' + hour + date.substr(13) + ampm;
}
function relative_time(time_value) {
    var values = time_value.split(" ");
    time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
    var parsed_date = Date.parse(time_value);
    var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
    var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
    delta = delta + (relative_to.getTimezoneOffset() * 60);
    if (delta < 60) {
    	return 'less than a minute ago';
    } else if(delta < 120) {
      	return 'about a minute ago';
    } else if(delta < (60*60)) {
      	return (parseInt(delta / 60)).toString() + ' minutes ago';
    } else if(delta < (120*60)) {
      	return 'about an hour ago';
    } else if(delta < (24*60*60)) {
      	return 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
    } else if(delta < (48*60*60)) {
      	return '1 day ago';
    } else {
      	return (parseInt(delta / 86400)).toString() + ' days ago';
    }
}

	jQuery(document).ready(function() {
			

			jQuery('.menu').mobileMenu({
                defaultText: 'Go To..',
                className: 'responsive-select',
				IDName: 'responsive-dropdown',
                containerID: 'responsive-menu',
				containerClass: 'rmenu',
                subMenuDash: '&ndash;'
            });
			
			jQuery('.banner_add_new').click( function() {
				var id = jQuery(this).attr('rel');
				var bannerid = 'Banner ' + ( parseInt(id) + 1 ) ; 
				jQuery(this).attr('rel',  parseInt(id) + 1 ) ;
				var banner = '<div style="padding-top:20px;" class="tpo_banner" ><p style="border-bottom: 1px solid #DFDFDF;"><strong>' + bannerid + '</strong></p><div><div style="margin-right:10px;" ><textarea class="banner_text" style="height: 150px;" id="" name=""></textarea></div></div></div>';
				jQuery('.tpo_banner_wrapper').append(banner);
			});



	});


