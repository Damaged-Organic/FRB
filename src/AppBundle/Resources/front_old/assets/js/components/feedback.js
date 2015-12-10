"use strict";

export default class Feedback{
	constructor(){
		this.el = $("#contact-form");
		this.loader = $("#loader-holder");

		this._UIevents();
	}
	_UIevents(){
		this.el.on("submit", $.proxy(this.handleSubmit, this));
	}
	handleSubmit(e){
		if(!this.el.valid()) return;
		
		let formData = this.el.serializeArray();
		let url = this.el.attr("action");

		this._send(formData, url);

		return false;
	}
	_send(data, url){
		this.loader.addClass("active");

		$.ajax({
			url: url,
			type: "POST",
			data: data
		})
		.done((response) => {
			response = JSON.parse(response);

			this._notify(response.message, "success");
			this.el[0].reset();
		})
		.fail((error) => {
			error = JSON.parse(error.responseText);
			this._notify(error.message, "error");
		})
		.always(() => {
			this.loader.removeClass("active");
		});
	}
	_notify(message, status){
		this.el
			.find(".response-holder")
			.html(`<p>${ message }</p>`)
			.addClass(status);

		window.setTimeout(() => {
			this._clearResponse();
		}, 4000);
	}
	_clearResponse(){
		this.el.find(".response-holder").removeClass("success error").empty();
	}
}