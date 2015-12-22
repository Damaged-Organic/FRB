"use strict";

import $ from "jquery";
import Handlebars from "handlebars";
import helpers from "../lib/helpers";
import PlacePicker from "../components/placePicker";
import ScrollUp from "../components/scrollUp";

$(function(){
	new PlacePicker();
	new ScrollUp();
});
