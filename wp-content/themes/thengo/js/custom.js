
	
	
function onBefore() { 
			 jQuery(".sliderheading").animate({	bottom :  "-640px" } );
			 jQuery(".slidercontent").animate({bottom :  "-640px" } );
			 jQuery(".sliderheading").animate({	bottom :  "0px" }, 2000 );
			 jQuery(".slidercontent").animate({bottom:  "0px" }, 2000 );
			 

			}
			function onAfter(curr, next, opts){
			// Animate After
			}
