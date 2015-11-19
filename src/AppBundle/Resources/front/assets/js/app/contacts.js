"use strict";

import $ from "jquery";
import mask from "jquery-mask-plugin";
import validate from "jquery-validation";
import ContactsMap from "../components/contactsMap";
import Feedback from "../components/feedback";

$(function(){
	new Feedback();
	new ContactsMap();
	$("form").validate();
});
