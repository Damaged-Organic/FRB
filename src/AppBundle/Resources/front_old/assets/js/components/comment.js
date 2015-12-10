"use strict";

export default class Comment{
	constructor(){
		this.el = $("#comment-form");
		this.button = $("#comment-button");
		this.popUp = $("#comment-pop-up");
		this.loader = $("#loader-holder");
		this.isLoading = false;
		this.UIevents();
	}
	UIevents(){
		this.button.on("click", $.proxy(this.openPopUp, this));
		this.popUp.on("click", ".close", $.proxy(this.closePopUp, this));
		this.el.on("submit", $.proxy(this.handleSubmit, this));
	}
	openPopUp(e){
		this.popUp.addClass("active");
		return false;
	}
	closePopUp(e){
		this.popUp.removeClass("active");
		this.clearResponse();
		return false;
	}
	handleSubmit(e){
		if(!this.el.valid() || this.isLoading) return;
		var formData = this.el.serializeArray(),
			url = this.el.attr("action");

		this.sendRequest(url, formData);
		return false;
	}
	sendRequest(url, data){
		var self = this;

		this.isLoading = true;
		this.loader.addClass("active");
		this.clearResponse();

		$.ajax({
			url: url,
			type: "POST",
			data: data
		})
		.done(function(response){
			response = JSON.parse(response);
			self.el
				.find(".response-holder")
				.html(`<p>${ response.message }</p>`)
				.addClass("success");

			self.el[0].reset();
		})
		.fail(function(error){
			self.el
				.find(".response-holder")
				.html(`<p>${ error.responseText }</p>`)
				.addClass("error");
		})
		.always(function(){
			self.isLoading = false;
			self.loader.removeClass("active");
			self.clearResponse(5000);
		});
	}
	clearResponse(time = 0){
		var self = this;

		window.setTimeout(function(){
			self.el.find(".response-holder").removeClass("success error").empty();
		}, time);
	}

}