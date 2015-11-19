"use strict";

import Map from "./map";

const PLACES = window.places || {};

export default class CatalogMap extends Map{
	constructor(){
		super($("#map"), PLACES.center || {lat: 0, lng: 0});
		this._events();
	}
	_events(){
		$(window).on("map_loaded", $.proxy(this.handleLoaded, this));
	}
	handleLoaded(e){
		this.setMarkers();
		return false;
	}
	setMarkers(){
		super.removeMarkers();
		
		for(let key in PLACES.markers){
			let marker = PLACES.markers[key];

			super.addMarker({
				position: super.getLatLng(marker.lat, marker.lng),
				map: this.map,
				title: marker.title,
				icon: {
					url: "build/images/location-icons/"+ marker.icon +".png",
					scaledSize: super.getSize(),
					anchor: super.getPoint()
				}
			});
		}
	}
}