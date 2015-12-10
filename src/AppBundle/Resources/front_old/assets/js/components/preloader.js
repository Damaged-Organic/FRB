"use strict";

export default class Preloader{

	constructor(){
		this.el = document.getElementById("preloader-holder");
		this.frbCube = document.getElementById("frb-cube-holder");
		this.loadTime = 3750;
		this.UIevents();

	}
	UIevents(){
		window.addEventListener("load", this.handleLoad(), false);
	}
	handleLoad(){
		window.setTimeout(() => {
			this.el.className = "loaded";
			this.frbCube.className = "loaded";
		}, this.loadTime);
	}
}