"use strict";

const ENTER_KEY = 13;

export default class Filter{
	constructor(){
		this.el = $("#filter-form");
		this.sliders = this.el.find(".range-holder");

		this._activateSliders();
		this._UIevents();
	}
	_UIevents(){
		this.el
			.on("change", "input[type=checkbox], input[type=radio]", $.proxy(this.handleForm, this))
			.on("keyup", "input[type=text]", $.proxy(this.handleInput, this));

		this.sliders
			.bind("slide", $.proxy(this.handleSlide, this))
			.bind("slidechange", $.proxy(this.handleForm, this));
	}
	_activateSliders(){
		$.each(this.sliders, (index) => {

			let slider = this.sliders.eq(index);
			let [rangeMin, rangeMax, min, max] = [
				parseInt(slider.data("range-min")),
				parseInt(slider.data("range-max")),
				parseInt(slider.data("min")),
				parseInt(slider.data("max"))
			];
			slider.slider({
				range: true,
				step: 1,
				min: rangeMin,
				max: rangeMax,
				values: [min, max]
			});

		});
	}
	handleForm(e){
		this.el.submit();
		return false;
	}
	handleSlide(e, ui){
		let parent = $(e.target).closest(".item");
		let values = ui.values

		this._updateInputs(parent, values);
	}
	handleInput(e){
		if(e.originalEvent.which !== ENTER_KEY) return;
		let parent = $(e.target).closest(".item");
		let inputs = parent.find(".counter");

		let values = [
			parseInt(inputs.eq(0).val()),
			parseInt(inputs.eq(1).val())
		];

		this._updateSlider(parent, values);

		return false;
	}
	_updateInputs(parent, values){
		let inputs = parent.find(".counter");
		let slider = parent.find(".range-holder");

		inputs.eq(0).val(values[0]);
		inputs.eq(1).val(values[1]);
		
		slider.attr("data-min", values[0]);
		slider.attr("data-max", values[1]);
	}
	_updateSlider(parent, values){
		let slider = parent.find(".range-holder");
		slider.slider("option", "values", values);
	}
}