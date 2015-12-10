"use strict";

import getTemplate from "../lib/getTemplate";

const [root, tpl] = [$(window), getTemplate("news-item")];
let [newsCount, offsetTop, offsetLast, isDown, isLast, isLoading] = [0, 0, 0, true, false, false];

export default class LiftNews{
	constructor(){
		this.el = $("#news-grid");
		this.loader = $("#loader-holder");
		this._UIevents();
	}
	_UIevents(){
		root.on("scroll", $.proxy(this._handleScroll, this));
	}
	_handleScroll(e){
		if(isLast || isLoading) return;

		this._setOffset();
		this._checkOffsets();
		if(this._isLowerThen() && isDown){
			this._updateNewsCount();
			this._getNews();
		}
		offsetLast = offsetTop;

		return false;
	}
	_setOffset(){
		offsetTop = ~~root.scrollTop() + ~~root.innerHeight();
	}
	_checkOffsets(){
		isDown = offsetTop > offsetLast ? true : false;
	}
	_isLowerThen(){
		return offsetTop >= ~~this.el.offset().top + ~~this.el.outerHeight(true) ? true : false;
	}
	_getNews(){
		this.loader.addClass("active");
		isLoading = true;

		$.ajax({
			url: this.el.data("url"),
			type: "POST",
			data: { count: newsCount }
		})
			.done((response) => {
				response = JSON.parse(response);

				isLast = response.isLast;
				delete response.isLast;

				let tplHtml = tpl({ news: response });

				this.el.append(tplHtml);
				this._updateNewsCount();

				this.loader.removeClass("active");
				isLoading = false;
			});
	}
	_updateNewsCount(){
		newsCount = this.el.find(".col").length;
	}
}
