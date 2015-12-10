"use strict";

import $ from "jquery";
import Handlebars from "handlebars";
import LiftNews from "../components/liftNews";
import ScrollUp from "../components/scrollUp";


$(function(){
	new LiftNews();
	new ScrollUp();
});