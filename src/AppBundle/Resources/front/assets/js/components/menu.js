"use strict";

import $ from "jquery";

export default class Menu{
	constructor(){
		this.el = $("#menu-holder");
        this.page = $("#page");
		this.button = $("#toggle-menu");
		this.UIevents();
	}
	UIevents(){
		this.button.on("click", $.proxy(this.handleMenu, this));
        this.page.on("click", $.proxy(this.closeMenu, this));
	}
	handleMenu(e){
		this.el.toggleClass("active");
		this.button.toggleClass("active");

		return false;
	}
    closeMenu(e){
        if(this.el.hasClass("active") && $(e.target).closest("#menu-holder").length <= 0){
            this.el.removeClass("active");
            this.button.removeClass("active");
        }
    }
}
