"use strict";

import $ from "jquery";
import vendorize from "./vendors";

let sideClassNames = [
	"commercial",
	"residential",
	"evaluation",
	"management"
];

export default class PrismBuilder{
	constructor(){
		this.el = $("#prism");
		this.sides = this.el.find(".prism-side");
		this.dimension = {};
		this.deep = {};

		this.UIevents();
		this.setSizes();
	}
	UIevents(){
		$(window).on("resize", $.proxy(this.setSizes, this));
	}
	setSizes(){
		this.dimension.width = window.innerWidth;
		this.dimension.height = window.innerHeight;
		this.deep.x = this.dimension.width / 2;
		this.deep.y = this.dimension.height / 2;

		this.setupSides();
	}
	setupSides(){
		var transform = vendorize("transform");
		this.el.css({transform: "rotateX(0deg) translateZ("+ this.deep.y * -1 +"px)"});

		this.sides.filter(".front").css({
			width: this.dimension.width + "px",
			height: this.dimension.height + "px",
			transform: "rotateX(0deg) translateZ("+ this.deep.y +"px)"
		});
		this.sides.filter(".top").css({
			width: this.dimension.width + "px",
			height: this.dimension.height + "px",
			transform: "rotateX(90deg) translateZ("+ this.deep.y +"px)"
		});
		this.sides.filter(".back").css({
			width: this.dimension.width + "px",
			height: this.dimension.height + "px",
			transform: "rotateX(-180deg) translateZ("+ this.deep.y +"px)"
		});
		this.sides.filter(".bottom").css({
			width: this.dimension.width + "px",
			height: this.dimension.height + "px",
			transform: "rotateX(-90deg) translateZ("+ this.deep.y +"px)"
		});
		this.sides.filter(".left").css({
			width: this.dimension.height + "px",
			height: this.dimension.height + "px",
			left: (this.dimension.width - this.dimension.height) / 2 + "px",
			transform: "rotateY(-90deg) translateZ("+ this.deep.x +"px)"
		});
		this.sides.filter(".right").css({
			width: this.dimension.height + "px",
			height: this.dimension.height + "px",
			left: (this.dimension.width - this.dimension.height) / 2 + "px",
			transform: "rotateY(90deg) translateZ("+ this.deep.x +"px)"
		});
	}
	getSideByIndex(index){
		return this.sides.filter("." + sideClassNames[Math.abs(index)]);
	}
}
