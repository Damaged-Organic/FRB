"use strict";

import $ from "jquery";
import PrismBuilder from "../lib/prismBuilder";

export default class Prism{
	constructor(){
		this.el = $("#prism");
		this.stateHolder = $("#prism-state-holder");
		this.current = 0;
		this.state = 0;
		this.isRotating = false;
		this.prismBuilder = new PrismBuilder();
		
		this.prismBuilder.getSideByIndex(0).addClass("active");
		this.UIevents();
	}
	UIevents(){
		this.stateHolder.on("click", ".arrow", $.proxy(this.handleState, this));
		this.el.on("webkitTransitionEnd transitionend msTransitionEnd oTransitionEnd", $.proxy(this.stateChanged, this));
	}
	handleState(e){
		if(this.isRotating) return;
		var target = $(e.target).closest(".arrow");
		
		this.updateCurrent(target);
		this.updateState(target);

		this.rotatePrism();
		this.changeState()

		return false;
	}
	updateCurrent(target){
		target.hasClass("up") ? this.current++ : this.current--;
	}
	updateState(target){
		target.hasClass("up") ? this.state-- : this.state++;

		if(this.state < 0){
			this.state = 3;
		} else if(this.state > 3){
			this.state = 0;
		}
	}
	rotatePrism(){		
		this.isRotating = true;
		this.el.css({transform: "translateZ("+ this.prismBuilder.deep.y * -1 +"px) rotateX("+ this.current * 90 +"deg)"});		
		this.prismBuilder.getSideByIndex(this.state).addClass("active").siblings().removeClass("active");
	}
	changeState(){
		this.stateHolder.removeClass().addClass("state-" + Math.abs(this.state));
	}
	stateChanged(){
		this.isRotating = false;
	}
}