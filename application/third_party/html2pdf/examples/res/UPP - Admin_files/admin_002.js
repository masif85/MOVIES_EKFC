var Surveys = {
		lastAddedId: null,
		actionInProgress: false,
		overrideActionLock: false,
		expandClicked: false,
		
		init: function() {
			if (typeof inProgress != "undefined" && inProgress) {
				Surveys.refresh();
			}
			
			Surveys.bindEvents();
		},
		
		surveyContinue: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			$("#surveyAddForm span.form-error").remove();
			
			var data = {
				name: $("#name").val(),
				start: $("#start").val(),
				end: $("#end").val()
			};
			
			$.post(baseUrl + "admin/surveys/add", data, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					$("#panelSurveyStart").slideUp();
					$("#panelSurveyCreate").slideDown();
				}
				
				if (typeof response.error != "undefined" && response.error) {
					if (typeof response.fields != "undefined") {
						$.each(response.fields, function(field, message) {
							$("#" + field).after("<span class=\"help-block form-error\">" + message + "</span>");
						});
					}
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		refresh: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			$("#panelSurveyStart").slideUp();
			$("#panelSurveyCreate").slideDown();
			
			$.get(baseUrl + "admin/surveys/status", function(response) {
				$("#layout [data-id]").remove();
				
				if (typeof response.elements != "undefined" && response.elements.length > 0) {
					$("#layout p#noElements").hide();
					
					$.each(response.elements, function (k, v) {
						var element = $("p.elementClone").clone();
						
						element.removeClass("elementClone");
						element.attr("data-id", v.id);
						var name = v.type;
						
						if (v.question != null) {
							name += " (" + v.question + ")";
						}
						
						element.find("strong").text(name);
						$("#layout").append(element);
						element.show();
					});
					
					if (Surveys.lastAddedId != null) {
						$("p.element[data-id='" + Surveys.lastAddedId + "']").trigger("click");
						
						Surveys.lastAddedId = null;
					}
				} else {
					$("#layout p#noElements").show();
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		addSelectedElement: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var elementName = $("#elementType").val();
			
			if (elementName == "") {
				alert("Please select an element first!");
				
				return;
			}
			
			var data = {
				elementName: elementName	
			};
			
			$.post(baseUrl + "admin/surveys/element/add", data, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					Surveys.lastAddedId = response.id;
					Surveys.actionInProgress = false;
					
					Surveys.refresh();
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		removeSelectedElement: function(e) {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			var id = handle.closest("p").attr("data-id");
			
			$.get(baseUrl + "admin/surveys/element/remove/" + id, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					Surveys.actionInProgress = false;
					
					Surveys.refresh();
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		editElement: function(e) {
			if (Surveys.actionInProgress && !Surveys.overrideActionLock) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			
			if (!handle.is("p")) {
				handle = handle.closest("p");
			}
			
			if (handle.find("div.editArea").length > 0 && !Surveys.expandClicked) {
				Surveys.actionInProgress = false;
				Surveys.cancelEdit(e);
				
				return;
			}
			
			var id = handle.attr("data-id");
			
			$.get(baseUrl + "admin/surveys/element/edit/" + id, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					if (response.content.length > 0) {
						var clone = $("div.editAreaClone").clone();
						var hasStringList = false;
					
						$.each(response.content, function(k, v) {
							if (v.type == "STRING" || v.type == "LONGSTRING") {
								var formGroupClone = $("div.editAreaClone div.formGroupSingleClone").clone();
								formGroupClone.find("label").text(v.name);
								
								if (v.type == "STRING") {
									formGroupClone.find("input").attr("name", v.name);
									formGroupClone.find("input").val(v.value);
								} else {
									formGroupClone.find("input").after("<textarea class=\"form-control\"></textarea>");
									formGroupClone.find("input").remove();
									formGroupClone.find("textarea").attr("name", v.name);
									formGroupClone.find("textarea").val(v.value);
								}
								formGroupClone.removeClass("formGroupSingleClone");
								
								clone.find("div.elements").append(formGroupClone);
							}
							
							if (v.type == "STRINGLIST") {
								hasStringList = true;
								
								var values = v.value;

								if (values != null && values.length > 1) {
									var count = 0;
									var group = null;
									$.each(values, function(_k, _v) {
										
										if (count == 0) {
											var formGroupClone = $("div.editAreaClone div.formGroupMultipleClone").clone();
											
											formGroupClone.find("label").text(v.name);
											formGroupClone.find("input").attr("name", v.name);
											formGroupClone.find("input").val(_v);
											formGroupClone.removeClass("formGroupMultipleClone");
											clone.find("div.elements").append(formGroupClone);
											
											group = clone.find("div.elements div.form-group").last();
										} else {
											var inputGroupClone = $("div.editAreaClone div.formGroupMultipleClone div.input-group").clone();
											
											inputGroupClone.find("input").attr("name", v.name);
											inputGroupClone.find("input").val(_v);
											group.append(inputGroupClone);
										}
										
										count++;
									});
								} else {
									var formGroupClone = $("div.editAreaClone div.formGroupMultipleClone").clone();
									
									formGroupClone.find("label").text(v.name);
									formGroupClone.find("input").attr("name", v.name);
									formGroupClone.find("input").val(v.value);
									formGroupClone.removeClass("formGroupMultipleClone");
									
									clone.find("div.elements").append(formGroupClone);
								}
								
								// Enable choice sorting
								clone.find("div.elements div.form-group-multiple").sortable({
									items: "> div.input-group",
									handle: "span.move-handle"
								});
							}
						});
						
						clone.removeClass("editAreaClone");
						clone.find(".formGroupSingleClone").remove();
						clone.find(".formGroupMultipleClone").remove();
						
						if (!hasStringList) {
							clone.find(".btnAddChoice").remove();
						}
						
						handle.append(clone).slideDown();
						clone.slideDown();
					}
				}
				
				Surveys.expandClicked = false;
				Surveys.actionInProgress = false;
			});
		},
		
		addChoice: function(e) {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			var element = handle.closest("p.element");
			var group = handle.closest("div.form-group");
			var name = group.find("input").first().attr("name");
			var clone = $("#layout div.formGroupMultipleClone div.input-group").clone();
			clone.find("input").attr("name", name);
			
			group.append(clone);
			
			Surveys.actionInProgress = false;
		},
		
		removeChoice: function(e) {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			var element = handle.closest("p.element");
			var group = handle.closest("div.form-group");
			var inputGroup = handle.closest("div.input-group");
			
			if (group.find("div.input-group").length > 1) {
				inputGroup.remove();
			}
			
			Surveys.actionInProgress = false;
		},
		
		saveElement: function(e) {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			var form = handle.closest("form");
			var element = handle.closest("p.element");
			var id = element.attr("data-id");
			
			var data = form.serialize();
						
			$.post(baseUrl + "admin/surveys/element/save/" + id, data, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					Surveys.actionInProgress = false;
					
					Surveys.refresh();
				}
				
				if (typeof response.error != "undefined" && response.error) {	
					// Handle error
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		// Save survey
		saveSurvey: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			$.get(baseUrl + "admin/surveys/save", function(response) {
				if (typeof response.success != "undefined" && response.success) {
					window.location.href = baseUrl + "admin/surveys";
				}
				
				if (typeof response.error != "undefined" && response.error) {	
					// Handle error
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		// Clear survey and start over
		clearSurvey: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			$.get(baseUrl + "admin/surveys/clear", function(response) {
				if (typeof response.success != "undefined" && response.success) {
					window.location.reload(true);
				}
				
				if (typeof response.error != "undefined" && response.error) {	
					// Handle error
				}
				
				Surveys.actionInProgress = false;
			});
		},
		
		// Cancel element editing
		cancelEdit: function(e) {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			var handle = $(e.target);
			var element = handle.closest("p.element");
			var editArea = element.find("div.editArea");
			
			editArea.slideUp(function() {
				editArea.remove();
			});
			
			Surveys.actionInProgress = false;
		},
		
		// On sort send update to server
		sendSortUpdate: function() {
			var order = "";
			
			$("#layout p.element[data-id]").each(function() {
				order += $(this).attr("data-id") + ",";
			});
			
			order = order.substring(0, order.length - 1);
			
			var data = {
				order: order	
			};
			
			$.post(baseUrl + "admin/surveys/element/sort", data, function(response) {
				if (typeof response.success != "undefined" && response.success) {
					// Handle success
				}
				
				if (typeof response.error != "undefined" && response.error) {	
					// Handle error
				}
			});
		},
		
		expandAll: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			Surveys.expandClicked = true;
			Surveys.overrideActionLock = true;
			
			$("p.element[data-id]").trigger("click");
			
			Surveys.actionInProgress = false;
		},
		
		collapseAll: function() {
			if (Surveys.actionInProgress) {
				return;
			} else {
				Surveys.actionInProgress = true;
			}
			
			$("p.element[data-id] div.editArea").slideUp(function() {
				$(this).remove();
			});
			
			Surveys.actionInProgress = false;
		},
		
		// Bind events
		bindEvents: function() {
			// Continue to step 2
			$("body").on("click", "#btnSurveyContinue", function(e) {
				e.preventDefault();
				Surveys.surveyContinue();
			});
			
			// Add element to survey
			$("body").on("click", "#btnAddElement", function(e) {
				e.preventDefault();
				Surveys.addSelectedElement();
			});
			
			// Remove element from survey
			$("body").on("click", ".btnRemoveElement", function(e) {
				e.preventDefault();
				e.stopPropagation();
				Surveys.removeSelectedElement(e);
			});
			
			// Open edit element area
			$("body").on("click", "#layout p[data-id]", function(e) {
				e.preventDefault();
				Surveys.editElement(e);
			});
			
			// Add choice
			$("body").on("click", "#layout .btnAddChoice", function(e) {
				e.preventDefault();
				Surveys.addChoice(e);
			});
			
			// Remove choice
			$("body").on("click", "#layout .btnRemoveChoice", function(e) {
				e.preventDefault();
				Surveys.removeChoice(e);
			});
			
			// Save element
			$("body").on("click", "#layout .btnSaveElement", function(e) {
				e.preventDefault();
				Surveys.saveElement(e);
			});
			
			// Cancel edit
			$("body").on("click", "#layout .btnCancelSaveElement", function(e) {
				e.preventDefault();
				Surveys.cancelEdit(e);
			});
			
			// Save survey
			$("body").on("click", "#btnSaveSurvey", function(e) {
				e.preventDefault();
				Surveys.saveSurvey();
			});
			
			// Clear survey
			$("body").on("click", "#btnClearSurvey", function(e) {
				e.preventDefault();
				Surveys.clearSurvey();
			});
			
			// Expand all edit forms
			$("body").on("click", "#btnExpand", function(e) {
				e.preventDefault();
				Surveys.expandAll();
			});
			
			// Collapse all edit forms
			$("body").on("click", "#btnCollapse", function(e) {
				e.preventDefault();
				Surveys.collapseAll();
			});
			
			// Enable element sorting		
			$("#layout").sortable({
				items: "> p.element[data-id]",
				cancel: ".move-handle, input, button, textarea",
				update: function(event, ui) {
					Surveys.sendSortUpdate();
				}
			});
			
			$("body").on("click", "#layout form", function(e) {
				e.stopPropagation();
			});
		}
}

$(function() {
	// If we are on survey manager page do init
	if (typeof surveyManagerInit != "undefined" && surveyManagerInit) {
		Surveys.init();
	}
});