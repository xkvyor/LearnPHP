document.addEventListener("DOMContentLoaded", function(event) {
	// to load highlightjs
	hljs.tabReplace = ' ';
	hljs.initHighlightingOnLoad();
	update();
});

var update = function(){ 
	var pageParams = {
			"content": "[P<>]",
			"options": {
				"color": "brown"
			}
		},
		boldsParams = {
			"content": "\<strong\><>\<\/strong\>",
			"options": {
				"color": "green"
			}
		};
	replaceAll("page", formFontNode, pageParams);
	replaceAll("bold", formFontNode, boldsParams);
	replaceAll("c", function(params) {
		var codeNode = document.createElement('code');
		codeNode.innerHTML = params["nodeToReplace"].innerHTML;
		return codeNode;
	}, {});
};

var formFontNode = function(params) {
	if (typeof params == 'undefined' ||
		!params.hasOwnProperty("nodeToReplace") ||
		!params.hasOwnProperty("content")) {
		return 0;
	}
	var nodeToReplace = params["nodeToReplace"],
		content = params["content"],
		options = params.hasOwnProperty("options") ? params["options"] : {},
		fontNode = document.createElement('font');
	for (var property in options) {
		if (options.hasOwnProperty(property)) {
			fontNode.setAttribute(property, options[property]);
		}
	}
	console.log(nodeToReplace);
	fontNode.innerHTML = content.replace("<>", nodeToReplace.innerHTML);
	return fontNode;
};

var replaceNode = function(nodeToReplace, newNode) {
	nodeToReplace.parentNode.insertBefore(newNode, nodeToReplace);
	nodeToReplace.parentNode.removeChild(nodeToReplace);
};

var replaceAll = function(selector, callback, params) {
	Array.prototype.forEach.call(document.querySelectorAll(selector),
		function(nodeToReplace) {
			params['nodeToReplace'] = nodeToReplace;
			var newNode = callback(params);
			replaceNode(nodeToReplace, newNode);
		});
}