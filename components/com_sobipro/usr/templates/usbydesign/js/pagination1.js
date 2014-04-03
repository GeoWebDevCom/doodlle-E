//Created by Otto-Ville Lamminpää
// http://hervanta.eu/cv.php
window.addEvent( "domready" , function(){
	var cache = {};
	window.onpopstate = function(event) {  
		if(event.state) {
		  cache = event.state; 
		   }
	}; 
	loadpage = function (url) {
		if ( url in cache) {
			$('ja-content').set('html', cache[url]);
			history.pushState(cache, "", url);
			showDescrip();
			window.addEvent( "domready" , addajax()); 
			return;
		 }
		new Request.HTML({
		 url: url+"&format=raw",
		 method: 'get',
		 onRequest: function(aa, aaa) {
			$('ja-content').fade('out');
		  },
		 onProgress: function(aa, aaa) {
			$('ja-content').set('html', 'Loading');
		  },
		 onSuccess: function(restree,reselem, reshtml){
			cache[url]=reshtml;
			$('ja-content').fade('in');
			history.pushState(cache, "", url);
			showDescrip();
			window.addEvent( "domready" , addajax()); 
		 },
		 update: $('ja-content')
		}).send();
	 }
	addajax = function( ){
		   $$('.pagination a').addEvent('click', function(e) {
			e.stop();
			var url = this.getProperty('href');
			loadpage(url);
		});
		}
	addajax();
});
