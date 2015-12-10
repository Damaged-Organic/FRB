"use strict";

import PlacesMap from "../components/placesMap";
import getTemplate from "../lib/getTemplate";

let placeTpl = getTemplate("place-category");

export default class PlacePicker{
	constructor(){
		this.form = $("#location-form");
		this.mapButton = $("#map-button");
		this.expatsHolder = $("#expats-holder");
		this.mapHolder = $("#map-holder");
		this.loaderHolder = $("#loader-holder");
		this.placesMap = new PlacesMap();

		this._UIevents();
	}
	_UIevents(){
		this.form.on("change", "input[type=checkbox]", $.proxy(this.handleForm, this));
		this.mapButton.on("click", $.proxy(this.openMap, this));
		this.mapHolder.on("click", ".close", $.proxy(this.closeMap, this));
	}
	handleForm(e){
		let checkedCount = this.getCheckedCount();

		checkedCount > 0 ? this.activateInfoView() : this.disableInfoView();
		this.getPlaceData();

		return false;
	}
	openMap(e){
		this.mapHolder.addClass("active");
		return false;
	}
	closeMap(e){
		this.mapHolder.removeClass("active");
		return false;
	}
	getCheckedCount(){
		return this.form.find("input[type=checkbox]:checked").length;
	}
	activateInfoView(){
		this.mapButton.addClass("active");
		this.expatsHolder.addClass("active");
	}
	disableInfoView(){
		this.mapButton.removeClass("active");
		this.expatsHolder.removeClass("active");
	}
	getPlaceData(){
		let formData = this.form.serializeArray();
		let url = this.form.attr("action");

		this.loaderHolder.addClass("active");

		$.ajax({
			url: url,
			type: "POST",
			data: formData
		})
		.done((response) => {
			response = JSON.parse(response);
			let placesHtml = placeTpl({categories: response.categories});

			this.placesMap.setLocations(response.locations);
			this.expatsHolder.find(".expats-location-info").html(placesHtml);
		})
		.fail((error) => {
			error = JSON.parse(error.responseText);

			let placesHtml = placeTpl({error: error});
			this.expatsHolder.find(".expats-location-info").html(placesHtml);

			this.mapButton.removeClass('active');
		})
		.always(() => {
			this.loaderHolder.removeClass("active");
		});
	}
}
