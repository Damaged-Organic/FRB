"use strict";

import $ from "jquery";
import mask from "jquery-mask-plugin";
import validate from "jquery-validation";
import ScrollUp from "../components/scrollUp";

$(() => {
    new ScrollUp();
    $("form").validate();
});
