"use strict";

import Map from "./map";

const kiev = {
	lat: 50.449897,
	lng: 30.523610
}

export default class PlacesMap extends Map{
	constructor(){
		super($("#map"), kiev);
		this.isLoaded = false;
		this.locations = [];

		this._events();
	}
	_events(){
		$(window).on("map_loaded", $.proxy(this.handleLoaded, this));
	}
	handleLoaded(e){
		this.isLoaded = true;
		return false;
	}
	setLocations(locations = {}){
		if(!this.isLoaded) return;

		this.locations = locations;
		this.setMarkers();
	}
	setMarkers(){
		super.removeMarkers();

		for(let key in this.locations){
			let location = this.locations[key];

			super.addMarker({
				position: super.getLatLng(location.lat, location.lng),
				map: this.map,
				title: location.title,
				icon: {
					url: "bundles/app/images/location-icons/location-"+ location.icon +".png",
					scaledSize: super.getSize(),
					anchor: super.getPoint()
				}
			});
		}
	}
}
