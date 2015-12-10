"use strict";

export default function vendorize(property){
	var style = document.createElement("div").style,
		vendors = ["ms", "O", "Moz", "Webkit"],
		key;

	if(style[property] == "") return property;

	property = property.charAt(0).toUpperCase() + property.slice(1);
	for(key = 0; key < vendors.length; key++){
		if(style[vendors[key] + property] == ""){
			return vendors[key] + property;
		}
	}
}