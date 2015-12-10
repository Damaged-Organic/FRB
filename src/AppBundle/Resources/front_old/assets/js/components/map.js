"use strict";

import gmapis from "google-maps-api";
const apiKey = "AIzaSyAAMgHdIpoW2059iMpwFk_GJ6lL2ZkMREg";
const google = {};

let gm = gmapis(apiKey);
let mapOptions = {
	zoom: 13,
	minZoom: 6,
	maxZoom: 18,
	mapTypeControl: false,
	streetViewControl: false
}

export default class Map{
	constructor(el, center){
		this.el = el || $("#map");
		this.center = center || {lat: 0, lng: 0};
		this.map = {};
		this.markers = [];

		gm().then((maps) => {
			google["maps"] = maps;
			this._createMap();
			this._setCenter(center);

			$(window).trigger("map_loaded");
		});
	}
	_createMap(){
		this.map = new google.maps.Map(this.el[0], mapOptions);
	}
	_setCenter(center){
		this.map.setCenter(center);
	}
	addMarker(options = {}){
		this.markers.push(new google.maps.Marker(options));
	}
	getSize(w = 32, h = 32){
		return new google.maps.Size(w, h);
	}
	getPoint(x = 0, y = 32){
		return new google.maps.Point(x, y);
	}
	getLatLng(lat = 0, lng = 0){
		return new google.maps.LatLng(lat, lng);
	}
	removeMarkers(){
		this.markers = [];
	}
}