"use strict";

export default class ScrollUp{
	constructor(){
		this.el = $("#to-up");

		this._UIevents();
	}
	_UIevents(){
		this.el.on("click", $.proxy(this._handleToUp, this));
	}
	_handleToUp(e){
		let body = $("html, body");
		body.stop().animate({ scrollTop:0 }, 500);
		
		return false;
	}
}