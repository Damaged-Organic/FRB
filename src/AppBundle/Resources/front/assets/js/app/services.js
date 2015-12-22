"use strict";

import $ from "jquery";
import validate from "jquery-validation";
import mask from "jquery-mask-plugin";
import tabs from "../plugins/tabs";
import Comment from "../components/comment";
import ScrollUp from "../components/scrollUp";

$(function(){
	new Comment();
	new ScrollUp();
	$("form").validate();
	$(".tabs").tabs();
});
