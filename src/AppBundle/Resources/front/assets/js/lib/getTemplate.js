"use strict";

export default function getTemplate(name){

	if(Handlebars.templates === undefined || Handlebars.templates[name] === undefined){
		var path = "bundles/app/js/templates/" + name + ".hbs";

		$.ajax({
			url: path,
			type: "GET",
			async: false
		})
		.done(function(template){
			if(Handlebars.templates === undefined) Handlebars.templates = [];
			Handlebars.templates[name] = Handlebars.compile(template);
		});
	}
	return Handlebars.templates[name];
}