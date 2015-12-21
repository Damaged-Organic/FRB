"use strict";

export default (() => {

	Handlebars.registerHelper("clearPhone", function(phone){
		return phone[0].replace(/\D/gi, "");
	});

})();
