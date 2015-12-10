(function($, root){

	"use strict";

	var pluginName = "slider",
		_default = {},

		slideNames = [
			"commercial",
			"private",
			"evaluation",
			"management"
		];

	function Plugin(el, options){
		this.el = $(el);
		this.options = $.extend({}, _default, options);
		
		this.initialize.apply(this, arguments);
	}
	Plugin.prototype = {
		slides: [],
		slideCount: 0,
		stateHolder: [],
		dimension: {},
		current: 0,
		initialize: initialize,
		_events: _events,
		setDimension: setDimension,
		setCSS: setCSS,
		handleArrow: handleArrow,
		nextSlide: nextSlide
	}
	function initialize(){
		this.slides = this.el.find(".prism-side");
		this.slideCount = this.slides.length - 2;
		this.stateHolder = $("#prism-state-holder");

		this.slides.filter(".front").addClass("active");

		this.setDimension();
		this._events();
	}
	function _events(){
		this.stateHolder.on("click", ".arrow", $.proxy(this.handleArrow, this));
		$(root).on("resize", $.proxy(this.setDimension, this));
	}
	function setDimension(){
		this.dimension.w = root.innerWidth;
		this.dimension.h = root.innerHeight;

		this.setCSS();
	}
	function setCSS(){
		this.el.css({"height": this.dimension.h * this.slideCount});
		this.slides.css({"height": this.dimension.h});
	}
	function handleArrow(e){
		var target = $(e.target).closest(".arrow");

		target.hasClass("up") ? this.current-- : this.current++;

		if(this.current >= this.slideCount - 1) this.current = this.slideCount - 1;
		if(this.current <= 0) this.current = 0;

		this.nextSlide();

		return false;
	}
	function nextSlide(){
		this.el.css({"transform": "translateY("+ (this.dimension.h * this.current) * -1 +"px)"});
		this.stateHolder.removeClass().addClass("state-" + this.current);
		this.slides.removeClass("active").filter("." + slideNames[this.current]).addClass("active");
	}


	$.fn[pluginName] = function(options){
		return this.each(function(){
			if(!$.data(this, "plugin_" + pluginName)){
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	}

})($, window);