(function($, root){

	"use strict";

	var pluginName = "tabs",
		_defaults = {};

	function Plugin(el, options){
		this.el = $(el);
		this._options = $.extend({}, _defaults, options);

		this.initialize.apply(this, arguments);
	}
	Plugin.prototype = {
		current: 0,
		initialize: initialize,
		_events: _events,
		handleLabel: handleLabel,
		switchLabel: switchLabel,
		switchContent: switchContent
	}
	function initialize(){
		this._events();
	}
	function _events(){
		this.el.on("click", ".label", $.proxy(this.handleLabel, this));
	}
	function handleLabel(e){
		var target = $(e.target).closest(".label");

		this.current = target.index();
		this.switchLabel();
		this.switchContent();

		return false;
	}
	function switchLabel(){
		this.el.find(".label").removeClass("active").eq(this.current).addClass("active");
	}
	function switchContent(){
		this.el.find(".content").removeClass("active").eq(this.current).addClass("active");
	}

	$.fn[pluginName] = function(options){
		return this.each(function(){
			if(!$.data(this, "plugin_" + pluginName)){
				$.data(this, "plugin_" + pluginName, new Plugin(this, options));
			}
		});
	}

})($, window);