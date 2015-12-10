"use strict";

export default (() => {

	Handlebars.registerHelper("clearPhone", function(phone){
		return `+${ phone.replace(/\D/gi, "") }`;
	});

})();