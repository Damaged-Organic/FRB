"use strict";

import Map from "./map";

const frb = {
	lat: 50.426078,
	lng: 30.536912
}

export default class ContactsMap extends Map{
	constructor(){
		super($("#map"), frb);
		this._events();
	}
	_events(){
		$(window).on("map_loaded", $.proxy(this.handleLoaded, this));
	}
	handleLoaded(e){
		super.addMarker({
			position: frb,
			map: this.map,
			title: "First Realty Brokerage",
			icon: {
				url: "bundles/app/images/location-icons/location.png",
				scaledSize: super.getSize(),
				anchor: super.getPoint()
			}
		});

		return false;
	}
}
