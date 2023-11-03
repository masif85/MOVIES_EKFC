$(function() {
	
	$("body").on("click", "a.btn-danger", function(e) {
		e.stopPropagation();
		e.preventDefault();

		if (confirm("Are you sure?")) {
			window.location.href = $(this).attr("href");
		}
	});
	
	$(".datetimepicker").datetimepicker({
        pickTime: false
	});
	
	$(".timepicker").datetimepicker({
        pickDate: false
	});
	
	// TinyMCE
	function strip_tags (str, allowed_tags)
	{
	    var key = "", allowed = false;
	    var matches = [];
	    var allowed_array = [];
	    var allowed_tag = "";
	    var i = 0;
	    var k = "";
	    var html = ""; 
	    var replacer = function (search, replace, str) {
	        return str.split(search).join(replace);
	    };
	    
	    // Build allows tags associative array
	    if (allowed_tags) {
	        allowed_array = allowed_tags.match(/([a-zA-Z0-9]+)/gi);
	    }
	    
	    str += "";

	    // Match tags
	    matches = str.match(/(<\/?[\S][^>]*>)/gi);
	    
	    // Go through all HTML tags
	    for (key in matches) {
	        if (isNaN(key)) {
	            // IE7 Hack
	            continue;
	        }

	        // Save HTML tag
	        html = matches[key].toString();
	        
	        // Is tag not in allowed list? Remove from str!
	        allowed = false;

	        // Go through all allowed tags
	        for (k in allowed_array) { // Init
	            allowed_tag = allowed_array[k];
	            i = -1;

	            if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+'>');}
	            if (i != 0) { i = html.toLowerCase().indexOf('<'+allowed_tag+' ');}
	            if (i != 0) { i = html.toLowerCase().indexOf('</'+allowed_tag)   ;}

	            // Determine
	            if (i == 0) {
	            	allowed = true;
	                break;
	            }
	        }
	        
	        if (!allowed) {
	            str = replacer(html, "", str);
	        }
	    }
	    return str;
	}
	
	tinymce.init({
		selector: "textarea.tinymce",
		menubar: false,
		plugins: "paste code image media textcolor link directionality",
		directionality: "ltr",
		toolbar: "undo redo | styleselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | link image media | bullist numlist outdent indent | code",
        style_formats: [{
    		title: "Headers",
    		items: [{
    			title: "h1",
    			block: "h1"
    		}, {
    			title: "h2",
    			block: "h2"
    		}, {
    			title: "h3",
    			block: "h3"
    		}, {
    			title: "h4",
    			block: "h4"
    		}, {
    			title: "h5",
    			block: "h5"
    		}, {
    			title: "h6",
    			block: "h6"
    		}]
    	}, {
    		title: "Inline",
    		items: [{
    			title: "Bold",
    			inline: "b",
    			icon: "bold"
    		}, {
    			title: "Italic",
    			inline: "i",
    			icon: "italic"
    		}, {
    			title: "Underline",
    			inline: "span",
    			styles: {
    				textDecoration: "underline"
    			},
    			icon: "underline"
    		}, {
    			title: "Strikethrough",
    			inline: "span",
    			styles: {
    				textDecoration: "line-through"
    			},
    			icon: "strikethrough"
    		}, {
    			title: "Superscript",
    			inline: "sup",
    			icon: "superscript"
    		}, {
    			title: "Subscript",
    			inline: "sub",
    			icon: "subscript"
    		}, {
    			title: "Code",
    			inline: "code",
    			icon: "code"
    		}]
    	}, {
    		title: "Blocks",
    		items: [{
    			title: "Paragraph",
    			block: "p"
    		}, {
    			title: "Blockquote",
    			block: "blockquote"
    		}, {
    			title: "Div",
    			block: "div"
    		}, {
    			title: "Pre",
    			block: "pre"
    		}]
    	}, {
    		title: "Images",
    		items: [{
    			title: "Full width",
    			selector: "img",
    			classes: "full"
    		}]
    	}, {
    		title: "Alignment",
    		items: [{
    			title: "Left",
    			block: "div",
    			styles: {
    				textAlign: "left"
    			},
    			icon: "alignleft"
    		}, {
    			title: "Center",
    			block: "div",
    			styles: {
    				textAlign: "center"
    			},
    			icon: "aligncenter"
    		}, {
    			title: "Right",
    			block: "div",
    			styles: {
    				textAlign: "right"
    			},
    			icon: "alignright"
    		}, {
    			title: "Justify",
    			block: "div",
    			styles: {
    				textAlign: "justify"
    			},
    			icon: "alignjustify"
    		}]
    	}, {
    		title: "Floats",
    		items: [{
    			title: "Image None",
    			selector: "img",
    			styles: {
    				"float": "inherit",
    				"margin": "inherit"
    			}
    		}, {
    			title: "Image Left",
    			selector: "img",
    			styles: {
    				"float": "left",
    				"margin": "0 10px 0 10px"
    			}
    		}, {
    			title: "Image Right",
    			selector: "img",
    			styles: {
    				"float": "right",
    				"margin": "0 0 10px 10px"
    			}
    		}]
    	}],
		paste_word_valid_elements: "b, strong, i, em, h1, h2, h3, h5, h5, h6, p",
		convert_urls: false,
		setup: function(editor) {
			editor.on("init", function(args) {
				editor = args.target;
				
				var direction = $('[name="' + editor.id + '"]').hasClass("rtlInput") ? "rtl" : "ltr";
	            editor.getBody().dir = direction;
				
				editor.on('NodeChange', function(e) {
					if (e && e.element.nodeName.toLowerCase() == "img") {
						tinyMCE.DOM.setAttribs(e.element, {
							"width": null, 
							"height": null
						});
					}
				});
				 
				if ($("input[name='isHtml']").length > 0) {
					var t = $("input[name='isHtml']").prop("checked");
					
					// Hide TinyMCE editor if it's plain text email
					if (!t) {
						var value = $("textarea[name='content']").val();

						tinyMCE.get("content").hide();

						$("textarea[name='content']").val(value);
					}
				}
			});
		}
	});
	
	/* Handy-Dandy TinyMCE Fix */
	if ($("input[name='isHtml']").length > 0) {
		$("textarea[name='content']").closest("form").bind("submit", function () {
			$("textarea[name='content']").each(function() {			
				var value = $(this).val();
	
				if (tinymce.get("content").isHidden())
				{
					tinymce.get("content").remove();
					$(this).val(value);
				} 
			});
		});
		
		$("body").on("click", "input[name='isHtml']", function(e) {
			if ($(this).prop("checked")) {
				tinyMCE.get("content").show();
			} else {
				tinyMCE.get("content").hide();
			}
		});
	}
	
	$("body").on("click", "tr.ticket-row[data-href]", function(e) {
		window.location = $(this).attr("data-href");
	});
	
	
	$("body").on("change", "select[name='locale']", function(e) {
		var handle = $(this);
		var locale = handle.val();
		var url = window.location.href;
		var pos = url.indexOf("?");
		
		if (pos != -1) {
			window.location.href = url.substr(0, pos) + "?lang=" + locale;
		} else {
			window.location.href = url + "?lang=" + locale;
		}
	});
	
	// View input for base element
	$("body").on("click", ".btnViewAllAnswers", function(e) {
		e.preventDefault();
		
		var baseElementId = $(this).closest(".panel").attr("data-baseElementId");
		
		$.get(baseUrl + "admin/surveys/report/ajax/answers/" + baseElementId, function(response) {
			$("#modal").empty().append(response);
			$("#modal").modal("show");
		});
	});
	
	// View input for base element + choice
	$("body").on("click", ".btnViewChoiceAnswers", function(e) {
		e.preventDefault();
		
		var baseElementId = $(this).closest(".panel").attr("data-baseElementId");
		var choice        = $(this).attr("data-choice");
		
		$.get(baseUrl + "admin/surveys/report/ajax/answers/" + baseElementId + "/" + choice, function(response) {
			$("#modal").empty().append(response);
			$("#modal").modal("show");
		});
	});
	
	// Load HR sections
	if ($(".loadSections").length > 0) {
		$("body").on("change", "select[name='department']", function (e) {
			var id = $(this).val();
			var defaultText = $("select[name='section'] option").first().text(); 
			
			$("select[name='section']").empty();
			$("select[name='section']").append("<option value=\"\">" + defaultText + "</option>")
			
			if (id != "") {
				$.get(baseUrl + "admin/careers/departments/sections/" + id + "/ajax", function (response) {
					$.each(response, function (k, v) {
						$("select[name='section']").append("<option value=\"" + v.id + "\">" + v.name + "</option>")
					});
				});
			}
		});
	}
	
});
