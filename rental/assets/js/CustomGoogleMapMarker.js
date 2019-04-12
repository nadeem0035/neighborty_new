function CustomMarker(latlng, map, args) {
	this.latlng = latlng;	
	this.args = args;	
	this.setMap(map);	
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function() {
	
	var self = this;
	
	var div = this.div;
	
	if (!div) {
	
		div = this.div = document.createElement('div');
		
		div.className = 'marker';
		
		div.style.position = 'absolute';
		div.style.cursor = 'pointer';
//		div.style.width = '150px';
//		div.style.height = '60px';
//		div.style.color = '#000';
//		div.style.background = 'white';
		//console.log(self.args);
		if (typeof(self.args.marker_id) !== 'undefined') {
			div.dataset.marker_id = self.args.marker_id;
 		}
		div.innerHTML  = 'Rs '+self.args.price;
		
 
		
		google.maps.event.addDomListener(div, "click", function(event) {			
			google.maps.event.trigger(self, "click");
			//div.style.display= 'none';
		});

		var panes = this.getPanes();
		panes.overlayImage.appendChild(div);
	}
	
	var point = this.getProjection().fromLatLngToDivPixel(this.latlng);
	
	if (point) {
		div.style.left = point.x + 'px';
		div.style.top = point.y + 'px';
	}
};

CustomMarker.prototype.remove = function() {
	if (this.div) {
		this.div.parentNode.removeChild(this.div);
		this.div = null;
	}	
};

CustomMarker.prototype.getPosition = function() {
	return this.latlng;	
};