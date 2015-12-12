"use strict";

import vendorize from "../lib/vendors";

const transform = vendorize("transform");

export default class Gallery{
	constructor(){
		this.el = $("#gallery-holder");
		this.init();
	}
	init(){
		this.photoView = this.el.find(".photo-view");
		this.nav = this.el.find(".navigation");
		this.holder = this.el.find("ul");
		this.items = this.holder.find("li");

		this._current = 0;
		this._width = 0;
		this._itemWidth = 0;
		this._height = 0;
		this._count = this.items.length;
		this._visibleItems = 4;

		if(this._count <= this._visibleItems) this.el.addClass('no-nav');

		this._UIevents();
		this.setWidth();
	}
	_UIevents(){
		this.el
			.on("click", ".arrow", $.proxy(this.handleArrow, this))
			.on("click", "li", $.proxy(this.handleImage, this));

		$(window).on("resize", $.proxy(this.handleResize, this));
	}
	setWidth(){
		this._width = this.nav.outerWidth(true);
		this._itemWidth = this._width / this._visibleItems;

		this.setCSS();
	}
	setCSS(){
		this.items.css({ width: this._itemWidth });
		this.holder.css({ width: this._itemWidth * this._count + 2 });
	}
	handleArrow(e){
		let target = $(e.target);
		target.hasClass("arrow-left") ? this._current-- : this._current++;

		if(this._current < 0) this._current = 0;
		if(this._current >= this._count - this._visibleItems) this._current = this._count - this._visibleItems;

		this.slide();
		return false;
	}
	handleImage(e){
		let target = $(e.target).closest("li");
		let src = target.data("img");
		let img = new Image();

		img.onload = ((image) => {
			this.photoView.find("figure").html(image);
		})(img);
		img.src = src;

		this._current = target.index();
		this.items.removeClass("active").eq(this._current).addClass("active");

		return false;
	}
	handleResize(e){
		this.setWidth();
	}
	slide(){
		let position = this._itemWidth * this._current * -1;
		this.holder.css({transform: "translateX("+ position +"px)"});
	}
}
