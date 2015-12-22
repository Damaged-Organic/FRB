"use strict";

import $ from "jquery";
import tabs from "../plugins/tabs";
import ScrollUp from "../components/scrollUp";

$(function(){
	new ScrollUp();
	$(".tabs").tabs();
});
