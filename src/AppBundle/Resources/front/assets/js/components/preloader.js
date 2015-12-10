"use strict";

const loadTime = 2500;

export default class Preloader{
	constructor(){
		this.el = document.getElementById("preloader-holder");
		this.frbCube = document.getElementById("frb-cube-holder");
		this.percentsHolder = document.getElementById("percents");
		this.UIevents();
		this.calcPercents();
	}
	UIevents(){
		window.addEventListener("load", this.handleLoad(), false);
	}
	calcPercents(){
		let self = this;
		let percent = 0;

		(function loop(){
			if(percent >= 100) return;
			
			percent++;
			self.updatePercents(percent);
			
			window.setTimeout(loop, loadTime / 100);
		})();
	}
	updatePercents(percent){
		this.percentsHolder.innerHTML = `${percent}%`;
	}
	handleLoad(){
		window.setTimeout(() => {	
			this.el.className = "loaded";
			this.frbCube.className = "loaded";
		}, loadTime);
	}
}