"use strict";

import $ from "jquery";
import mask from "jquery-mask-plugin";
import validate from "jquery-validation";
import ContactsMap from "../components/contactsMap";
import Feedback from "../components/feedback";
import ScrollUp from "../components/scrollUp";

$(function(){
	new Feedback();
	new ContactsMap();
	new ScrollUp();
	$("form").validate();
});
