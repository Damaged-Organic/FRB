"use strict";

import $ from "jquery";
import validate from "jquery-validation";
import mask from "jquery-mask-plugin";
import tabs from "../plugins/tabs";
import Comment from "../components/comment";

$(function(){

	new Comment();
	$("form").validate();
	$(".tabs").tabs();
});
