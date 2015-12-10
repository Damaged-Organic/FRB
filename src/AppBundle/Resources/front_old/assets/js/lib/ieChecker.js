"use strict";

import $ from "jquery";

export default function ieChecker(){
	var userAgent = window.navigator.userAgent;

	if(userAgent.indexOf("MSIE ") > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)){
		$("html").addClass("ie");
		return true;
	} else{
		return false;
	}
}