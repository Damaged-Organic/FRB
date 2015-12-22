"use strict";

import Preloader from "../components/preloader";

import $ from "jquery";
import Menu from "../components/menu";
import Prism from "../components/prism";
import ieChecker from "../lib/ieChecker";
import slider from "../plugins/slider";

var isIE = ieChecker();
new Preloader();

$(function(){

	new Menu();
	isIE ? $("#prism").slider() : new Prism();
});
