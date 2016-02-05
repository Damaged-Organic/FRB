"use strict";

import vendorize from "../lib/vendors";

const transform = vendorize("transform");

let gallery = $("#gallery-holder");
let photoView = gallery.find("#photo-view-holder");
let navHolder = gallery.find("#navigation-holder");
let photoHolder = gallery.find("ul");
let photos = gallery.find("li");

let _width = 0;
let _itemWidth = 0;

let _photosCount = 0;
let _visiblePhotos = 4;

let _current = 0;

export default class Gallery{
	constructor(){
		_photosCount = photos.length;

		this._setWidth();
		this._events();
	}
	_events(){
		gallery
			.on("click", ".arrow", (e) => { this.handleArrow(e) })
			.on("click", "li", (e) => { this.handlePhoto(e) });

		$(window)
			.on("resize", (e) => { this.handleResize(e) });
	}
	_setWidth(){
		_width = navHolder.find(".navigation").outerWidth();
		_itemWidth = _width / _visiblePhotos;

		this.setCSS();
	}
	setCSS(){
		gallery.find("li").css({ width: _itemWidth });
		photoHolder.css({ width: _itemWidth * _photosCount + 2 });
	}
	handleArrow(e){
		let target = $(e.target);

		this._recognizeCurrent(target);
		this._checkRange();
		this._loadImage();

		if(this._isSlideTime()) this.slideNav();
		this.switchActive();

		return false;
	}
	handlePhoto(e){
		let target = $(e.target).closest("li");

		_current = target.index();

		this._loadImage();
		if(this._isSlideTime()) this.slideNav();
		this.switchActive();

		return false;
	}
	_recognizeCurrent(arrow){
		arrow.hasClass("arrow-left") ? _current-- : _current++;
	}
	_checkRange(){
		if(_current < 0){
			_current = 0;
		} else if(_current >= _photosCount - 1){
			_current = _photosCount - 1;
		}
	}
	_isSlideTime(){
		return _current <= _photosCount - _visiblePhotos;
	}
	_loadImage(){
		let photo = photos.eq(_current);
		let src = photo.data("img");
		let img = new Image();

        photoView.addClass("loading");

		img.onload = ((image) => {

			photoView.find("figure").html(image);
            
            window.setTimeout(() => {
                photoView.removeClass("loading");
            }, 250);

		})(img);

		img.src = src;
	}
	switchActive(){
		photos.removeClass("active").eq(_current).addClass("active");
	}
	slideNav(){
		let position = _itemWidth * _current * -1;
		photoHolder.css({transform: "translateX("+ position +"px)"});
	}
	handleResize(e){
		this.setWidth();
	}
}
