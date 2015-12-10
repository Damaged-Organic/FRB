"use strict";

import $ from "jquery";

export default class Menu{
	constructor(){
		this.el = $("#menu-holder");
		this.button = $("#toggle-menu");
		this.UIevents();
	}
	UIevents(){
		this.button.on("click", $.proxy(this.handleMenu, this));
	}
	handleMenu(e){
		this.el.toggleClass("active");
		this.button.toggleClass("active");

		return false;
	}
}