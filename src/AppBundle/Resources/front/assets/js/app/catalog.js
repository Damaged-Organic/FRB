"use strict";

import $ from "jquery";
import jqueryUI from "jquery-ui";
import Filter from "../components/filter";
import Gallery from "../components/gallery";
import CatalogMap from "../components/catalogMap";

$(function(){

	new Filter();
	new Gallery();
	new CatalogMap();
});