;(function($, window) {

	// Private properties
	// var baseUrl          = null;
	var sessionId        = null;
	var pollTimeout      = null;
	var windowFocus      = true;
	var currentSound     = null;
	var cloned           = null;
	var lastRegisterTime = 0;
	var windowId         = null;
	// var infoInProgress   = false;
	var infoLoadInProgress = [];

	// Constructor
	function init() {
		setupConsole();

		console.log("MKChat (admin): initializing ...");

		// setBaseUrl();

		windowId = generateWindowId();

		checkSessionCookie();

		startChat();

		setupSound();

		setupEvents();

		console.log("MKChat (admin): initialization done.");
	}

	// Setup console for browsers that do not have one
	function setupConsole() {
		if (!window.console) {
			window.console = {
				log: function() {}
			};
		}
	}

	// Set baseUrl
	function setBaseUrl() {
		console.log("MKChat (admin): setting baseUrl ...");

		var pathArray = window.location.href.split("/");
		var protocol  = pathArray[0];
		var host      = pathArray[2];
		
		baseUrl = protocol + "//" + host + "/";

		console.log("MKChat (admin): setting baseUrl done: " + baseUrl);
	}

	// Check for session cookie
	function checkSessionCookie() {
		console.log("MKChat (admin): checking session cookie ...");

		var _sessionId = getCookie("MKChatSessionID");

		if (_sessionId != null) {
			sessionId = _sessionId;

			console.log("MKChat (admin): found session cookie: " + sessionId);

			// Check if session saved in cookie is valid
			var payload = {
				type: "VERIFYCLIENT",
				senderId: sessionId,
				data: {
					metainfo: {
						userAgent: navigator.userAgent,
						ip: myIP
					},
					page: document.URL,
					windowId: windowId
				}
			};

			var request = $.ajax({
				type: "POST",
				url: baseUrl + "chat/send",
				data: JSON.stringify(payload),
				dataType: "json",
				contentType: "application/json",
				cache: false
			});

			request.done(function(data) {
				if (data.status != 0) {
					if (data.status == 2) {
						deleteCookie("MKChatSessionID");

						sessionId = null;
					} else {
						console.log("MKChat (admin): verify session id failed, status: " + data.status);

						handleError(data.status);
					}
				}
			});

			request.fail(function(data, textStatus) {
				console.log("MKChat (admin): error while verifying sessionId: " + textStatus);

				handleError(-1);
			});
		} else {
			console.log("MKChat (admin): no session cookie present.");
		}
	}

	// Create cookie
	function setCookie(name, value, days) {
		var expires;

		if (days) {
			var date = new Date();

			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toGMTString();
		} else {
			expires = "";
		}

		document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
	};

	// Get cookie value
	function getCookie(name) {
		var nameEQ = escape(name) + "=";
		var ca = document.cookie.split(";");

		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];

			while (c.charAt(0) === " ") {
				c = c.substring(1, c.length);
			}

			if (c.indexOf(nameEQ) === 0) {
				return unescape(c.substring(nameEQ.length, c.length));
			}
		}

		return null;
	};

	// Delete cookie
	function deleteCookie(name) {
		setCookie(name, "", -1);
	};

	// Start chat
	function startChat() {
		if (sessionId == null) {
			var payload = {
				type: "REGISTER",
				data: {
					name: MKChatAdminName,
					metainfo: {
						email: MKChatAdminEmail,
						userAgent: navigator.userAgent,
						ip: myIP
					},
					page: document.URL,
					windowId: windowId
				}
			};

			var request = $.ajax({
				type: "POST",
				url: baseUrl + "chat/send",
				data: JSON.stringify(payload),
				dataType: "json",
				contentType: "application/json",
				cache: false
			});

			request.done(function(data) {
				if (data.status == 0) {
					console.log("MKChat (admin): register successfully.");

					sessionId = data.sessionId;

					setCookie("MKChatSessionID", data.sessionId, 1);
					
					poll();
				} else {
					console.log("MKChat (admin): registering failed, status: " + data.status);

					handleError(data.status);
				}
			});

			request.fail(function(data, textStatus) {
				console.log("MKChat (admin): error while registering: " + textStatus);

				handleError(-1);
			});
		} else {
			continueChat();
		}
	}

	// Continue chat
	function continueChat() {
		// Get channels
		var payload = {
			type: "GETCHANNELS",
			senderId: sessionId
		};

		var request = $.ajax({
			type: "POST",
			url: baseUrl + "chat/send",
			data: JSON.stringify(payload),
			dataType: "json",
			contentType: "application/json",
			cache: false
		});

		request.done(function(data) {
			if (data.status == 0) {
				if (data.data.length !== 0) {
					var channelCount = countProperties(data.data);
					var processedChannelsCount = 0;

					$.each(data.data, function(index, channel) {
						// Create channel tab
						
						if (channel.users.length == 0) {
							processedChannelsCount++;

							return true;
						}
						
						// Get info on user
						var name = channel.users[0].name;
						var email = channel.users[0].metaInfo.email;
						var clientSessionId = channel.users[0].sessionId;
						
						cloned = $(".tab-clone").clone();

						cloned.removeClass("tab-clone").show().css("display", "block").attr("data-session-id", clientSessionId).attr("data-channel-id", channel.channelId);
						cloned.find("a").html(name + "<button type=\"button\" class=\"close\" aria-hidden=\"true\">&times;</button>");

						$(".chat-tabs").append(cloned);

						// Show chat container for this chat
						cloned = $(".chat-clone").clone();

						cloned.removeClass("chat-clone").show().css("display", "block").attr("data-session-id", clientSessionId).attr("data-channel-id", channel.channelId);

						cloned.find("div.admin-chat-log-buttons").html(
							"<a class=\"btn btn-default\" target=\"_blank\" href=\"/admin/users?email=" + email + "\">Client info</a>"
						);

						$(".chat-container div.panel-body").append(cloned);

						$(".chat-tabs li[data-channel-id='" + channel.channelId + "'] a").trigger("click");

						var payload = {
							type: "GETSTATE",
							senderId: sessionId,
							msgTo: channel.channelId
						}

						var request = $.ajax({
							type: "POST",
							url: baseUrl + "chat/send",
							data: JSON.stringify(payload),
							dataType: "json",
							contentType: "application/json",
							cache: false
						});

						request.done(function(data) {
							if (data.status == 0) {
								if (data.data.length !== 0) {
									$.each(data.data, function(index, message) {
										if (message.senderId == sessionId) {
											$("form[data-channel-id='" + channel.channelId + "'] .admin-chat-log").append("<p class=\"admin-chat-log-admin\"><span class=\"ts\">" + convertTs(message.timeStamp) + "</span> <strong>" + message.displayName + "</strong>: " + message.data.content + "</p>");
										} else {
											$("form[data-channel-id='" + channel.channelId + "'] .admin-chat-log").append("<p class=\"admin-chat-log-customer\"><span class=\"ts\">" + convertTs(message.timeStamp) + "</span> <strong>" + message.displayName + "</strong>: " + message.data.content + "</p>");
										}
									});

									processedChannelsCount++;
								}
								 
								autoScroll();
							} else {
								console.log("MKChat (admin): getting channel state failed, status: " + data.status);

								handleError(data.status);
							}
						});

						request.fail(function(data, textStatus) {
							console.log("MKChat (admin): error while getting channels: " + textStatus);

							handleError(-1);
						});
					});

					// Check when to start polling again
					function testPoll() {
						if (channelCount == processedChannelsCount) {
							poll();
						} else {
							setTimeout(function() {
								testPoll();
							}, 1000);
						}
					}

					testPoll();
				} else {
					poll();
				}
			} else {
				console.log("MKChat (admin): getting channels failed, status: " + data.status);

				handleError(data.status);
			}
		});

		request.fail(function(data, textStatus) {
			console.log("MKChat (admin): error while getting channels: " + textStatus);

			handleError(-1);
		});
	}

	// Join chat
	function joinChat(clientSessionId, name, email) {
		// Check if this tab is not already open
		if ($(".chat-tabs li[data-session-id='" + clientSessionId + "']").length == 0) {
			var payload = {
				type: "JOIN",
				senderId: sessionId,
				msgTo: clientSessionId
			};

			var request = $.ajax({
				type: "POST",
				url: baseUrl + "chat/send",
				data: JSON.stringify(payload),
				dataType: "json",
				contentType: "application/json",
				cache: false
			});

			request.done(function(data) {
				if (data.status == 0) {
					console.log("MKChat (admin): joined chat successfully.");

					// Open new tab
					cloned = $(".tab-clone").clone();

					cloned.removeClass("tab-clone").show().css("display", "block").attr("data-session-id", clientSessionId).attr("data-channel-id", data.channelId);
					cloned.find("a").html(name + "<button type=\"button\" class=\"close\" aria-hidden=\"true\">&times;</button>");

					$(".chat-tabs").append(cloned);

					// Show chat container for this chat
					cloned = $(".chat-clone").clone();

					cloned.removeClass("chat-clone").show().css("display", "block").attr("data-session-id", clientSessionId).attr("data-channel-id", data.channelId);

					cloned.find("div.admin-chat-log-buttons").html(
						"<a class=\"btn btn-default\" target=\"_blank\" href=\"/admin/users?email=" + email + "\">Client info</a>"
					);

					$(".chat-container div.panel-body").append(cloned);
					
					// Focus new chat
					$(".chat-tabs li[data-channel-id='" + data.channelId + "'] a").trigger("click");
				} else {
					console.log("MKChat (admin): joining chat failed, status: " + data.status);

					handleError(data.status);
				}
			});

			request.fail(function(data, textStatus) {
				console.log("MKChat (admin): error while joining channel: " + textStatus);

				handleError(-1);
			});
		} else {
			$(".chat-tabs li[data-session-id='" + clientSessionId + "'] a").trigger("click");
		}
	}

	// Leave chat
	function leaveChat(channelId) {
		if (confirm("Are you sure you want to close this chat?") == true) {
			var payload = {
				type: "LEAVE",
				senderId: sessionId,
				msgTo: channelId
			};

			var request = $.ajax({
				type: "POST",
				url: baseUrl + "chat/send",
				data: JSON.stringify(payload),
				dataType: "json",
				contentType: "application/json",
				cache: false
			});

			request.done(function(data) {
				if (data.status == 0) {
					console.log("MKChat (admin): channel left successfully.");

					// Remove tab
					$("ul.chat-tabs li[data-channel-id='" + channelId + "']").remove();
					
					// Remove chat container
					$("form[data-channel-id='" + channelId +"']").remove();

					// Focus on something else
					if ($(".chat-tabs li").length - 1 > 0) {
						$(".chat-tabs li[data-channel-id]").first().find("a").trigger("click");
					}	
				} else {
					console.log("MKChat (admin): channel leave failed, status: " + data.status);

					handleError(data.status);
				}
			});

			request.fail(function(data, textStatus) {
				console.log("MKChat (admin): error while leaving channel: " + textStatus);

				handleError(-1);
			});
		}
	}

	// Poll chat data
	function poll() {
		if (sessionId != null) {
			var request = $.ajax({
				type: "GET",
				url: baseUrl + "chat/poll/" + sessionId + "/" + windowId,
				dataType: "json",
				cache: false
			});

			request.done(function(data) {
				processPoll(data);

				pollTimeout = setTimeout(function() {
					poll();
				}, 1000);
			});

			request.fail(function(data, textStatus) {
				alert("An error occurred, please refresh page and restart chat.");

				clearTimeout(pollTimeout);
				
				sessionId = null;
				pollTimeout = null;
			});
		}
	}

	// Process poll data
	function processPoll(data) {
		$.each(data, function(index, message) {
			switch (message.type) {
				case "LIST":
					$("a.list-group-item:not(.list-clone)").remove();

					if (message.data["clients-chatting"].length > 0) {
						var title = $("<a>").addClass("list-group-item").addClass("disabled");
						var text = $("<strong>").text("Chatting");
						title.append(text);

						$(".chat-list").append(title);

						$.each(message.data["clients-chatting"], function(index, client) {
							cloned = $(".list-clone").clone();

							cloned.removeClass("list-clone").show().css("display", "block").attr("data-session-id", client.sessionId).attr("data-user-ip", client.metaInfo.ip);

							cloned.find("h4").html(client.name);
							cloned.find("p").html("<span class=\"email\">" + client.metaInfo.email + "</span>" +
								"<br /><span class=\"lang\">" + client.metaInfo.language + "</span> " +
								"<span class=\"enq\">" + client.metaInfo.enquiry + "</span>");

							$(".chat-list").append(cloned);
						});
					}

					if (message.data["clients-waiting"].length > 0) {
						var title = $("<a>").addClass("list-group-item").addClass("disabled");
						var text = $("<strong>").text("Waiting");
						title.append(text);

						$(".chat-list").append(title);

						$.each(message.data["clients-waiting"], function(index, client) {
							cloned = $(".list-clone").clone();

							cloned.removeClass("list-clone").show().css("display", "block").attr("data-session-id", client.sessionId).attr("data-user-ip", client.metaInfo.ip);

							cloned.find("h4").html(client.name);
							cloned.find("p").html("<span class=\"email\">" + client.metaInfo.email + "</span>" +
								"<br /><span class=\"lang\">" + client.metaInfo.language + "</span> " +
								"<span class=\"enq\">" + client.metaInfo.enquiry + "</span>");

							$(".chat-list").append(cloned);

							// Is this a new client?
							if (lastRegisterTime < client.registered) {
								if (!windowFocus) {
									if (currentSound != null) {
										currentSound.stop();
									}

									currentSound = createjs.Sound.play("NewChatRequest", {
										loop: -1
									});
								}

								lastRegisterTime = client.registered;
							}
						});
					}
				break;

				case "MSG":
					if (message.senderId == sessionId) {
						$("form[data-channel-id='" + message.msgTo + "'] .admin-chat-log").append("<p class=\"admin-chat-log-admin\"><span class=\"ts\">" + convertTs(message.timeStamp) + "</span> <strong>" + message.displayName + "</strong>: " + message.data.content + "</p>");
					} else {
						$("form[data-channel-id='" + message.msgTo + "'] .admin-chat-log").append("<p class=\"admin-chat-log-customer\"><span class=\"ts\">" + convertTs(message.timeStamp) + "</span> <strong>" + message.displayName + "</strong>: " + message.data.content + "</p>");
					}

					autoScroll();

					if (!windowFocus) {
						if (currentSound != null) {
							currentSound.stop();
						}

						currentSound = createjs.Sound.play("NewMessage");
					}
				break;

				// In some other window we joined chat so we need to do the same here
				case "JOIN":
					// Check if we are on this channel in this window
					if ($("form[data-channel-id='" + message.data.channelId + "']").length == 0) {
						// Open new tab
						cloned = $(".tab-clone").clone();

						cloned.removeClass("tab-clone").show().css("display", "block").attr("data-session-id", message.msgTo).attr("data-channel-id", message.data.channelId);
						cloned.find("a").html(message.data.receiver + "<button type=\"button\" class=\"close\" aria-hidden=\"true\">&times;</button>");

						$(".chat-tabs").append(cloned);

						// Show chat container for this chat
						cloned = $(".chat-clone").clone();

						cloned.removeClass("chat-clone").show().css("display", "block").attr("data-session-id", message.msgTo).attr("data-channel-id", message.data.channelId);

						cloned.find("div.admin-chat-log-buttons").html(
							"<a class=\"btn btn-default\" target=\"_blank\" href=\"/admin/users?email=" + message.data["receiver-metainfo"].email + "\">Client info</a>"
						);

						$(".chat-container div.panel-body").append(cloned);
						
						// Focus new chat
						$(".chat-tabs li[data-channel-id='" + message.data.channelId + "'] a").trigger("click");
					}
				break;

				case "LEAVE":
				case "QUIT":
					$("form[data-channel-id='" + message.msgTo + "'] .admin-chat-log").append("<p class=\"admin-chat-log-system\">Client has closed the chat or timed out.</p>");

					// Remove tab
					$("a.list-group-item[data-session-id='" + message.senderId + "']").addClass("left-chat");

					setTimeout(function() {
						$("a.list-group-item[data-session-id='" + message.senderId + "']").remove();
					}, 10000);

					autoScroll();
				break;
			}
		});

		// Do some cleanup at the end
							
		// If we have requests show the div
		if ($(".chat-list a[data-session-id]").length > 0) {
			$(".list-ready").hide();
			$(".chat-list").show();
		} else {
			$(".list-ready").show();
			$(".chat-list").hide();
		}

		// If we have chats open show container
		if ($(".chat-tabs li").length - 1 > 0) {
			$(".chat-ready").hide();
			$(".chat-tabs").show();
			$(".chat-container").show();
		} else {
			$(".chat-ready").show();
			$(".chat-tabs").hide();
			$(".chat-container").hide();
		}
	}

	// Setup sound
	function setupSound() {
		if (createjs.Sound.initializeDefaultPlugins()) {
			var audioPath = baseURL + "assets/js/";
			var manifest = [
			    {
			    	id: "NewChatRequest",
			    	src: "sound.mp3"
			    },
			    {
			    	id: "NewMessage",
			    	src: "message.mp3"
			    }
			];

			createjs.Sound.registerManifest(manifest, audioPath);
		} else {
			alert("Sound system not available, please update your browser!");
		}
	}

	// Send message
	function sendMessage(channelId, message) {
		if (message != undefined && message != "") {
			var payload = {
				type: "MSG",
				senderId: sessionId,
				msgTo: channelId,
				data: {
					content: message,
					windowId: windowId
				}
			};

			var request = $.ajax({
				type: "POST",
				url: baseUrl + "chat/send",
				data: JSON.stringify(payload),
				dataType: "json",
				contentType: "application/json",
				cache: false
			});

			request.done(function(data) {
				if (data.status == 0) {
					console.log("MKChat (admin): message sent successfully.");

					$("form[data-channel-id='" + channelId + "'] .admin-chat-log").append("<p class=\"admin-chat-log-admin\"><span class=\"ts\">" + convertTs(data.data.timeStamp) + "</span> <strong>" + data.data.displayName + "</strong>: " + data.data.data.content + "</p>");
				} else {
					console.log("MKChat (admin): message sending failed, status: " + data.status);

					handleError(data.status);
				}
			});

			request.fail(function(data, textStatus) {
				console.log("MKChat (admin): error while sending message: " + textStatus);

				handleError(-1);
			});
		}

		autoScroll();
	}

	// Handle error codes
	function handleError(status) {
		switch (status) {
			case -1:
				alert("Internal error occured, please restart chat.");

				performCleanup();
			break;

			case 2:
				alert("Your session has expired, please relog.");

				performCleanup();
			break;

			case 3:
				alert("Receiver is not present.");
			break;

			case 5:
				alert("User is already in session with another agent.");
			break;
		}
	}

	// Perform cleanup
	function performCleanup() {
		sessionId = null;
		clearTimeout(pollTimeout);
		pollTimeout = null;
		lastRegisterTime = null;
	}

	// Scroll chat window to last message
	function autoScroll() {
		$("div.admin-chat-log").each(function() {
			var scrollHeight = $(this).prop("scrollHeight");

			$(this).stop().animate({
				scrollTop: scrollHeight
			}, 500, function() {
				// Done
			});
		});
	}

	// Convert Java timestamp
	function convertTs(ts) {
		var date = new Date(ts);

		return (date.getHours() < 10 ? "0" + date.getHours() : date.getHours()) + ":" + (date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes()) + ":" + (date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds());
	}

	// Encode HTML entities
	function htmlEntities(str) {
		return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
	}

	// Make unique window id
	function generateWindowId() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for(var i = 0; i < 5; i++) {
			text += possible.charAt(Math.floor(Math.random() * possible.length));
		}

		return text;
	}

	// Count number of properties in object
	function countProperties(obj) {
		var count = 0;

		for (var prop in obj) {
			if (obj.hasOwnProperty(prop)) {
				++count;
			}
		}

		return count;
	}

	// Show info popup
	function showInfo(clientSessionId) {
		if (_.indexOf(infoLoadInProgress, clientSessionId) != -1) {
			console.log("Client info already loading, skipping...");
			return;
		}

		infoLoadInProgress.push(clientSessionId);

		var elem = $("div.chat-list a[data-session-id='" + clientSessionId + "']");

		var payload = {
			type: "GETWINDOWINFO",
			senderId: sessionId,
			msgTo: clientSessionId
		};

		var request = $.ajax({
			type: "POST",
			url: baseUrl + "chat/send",
			data: JSON.stringify(payload),
			dataType: "json",
			contentType: "application/json",
			cache: false
		});

		request.done(function(data) {
			var ip = elem.attr("data-user-ip");
			var pages = data.pages;

			var request = $.ajax({
				type: "GET",
				url: baseUrl + "chat/info/" + ip,
				dataType: "json",
				cache: false
			});

			request.done(function(data) {
				infoLoadInProgress = _.without(infoLoadInProgress, clientSessionId);

				// Make sure mouse is still over element
				if ($("div.chat-list a[data-session-id='" + clientSessionId + "']:hover").length == 0) {
					console.log("Mouse not over, skipping...");
					return;
				}

				var title = "Info";
				var content = "<strong>Country:</strong> " + data.country_name;
				content += "<br /><strong>IP:</strong> " + ip;
				content += "<br /><strong>Pages:</strong> ";
				for (page in pages)
					content += "<br />" + pages[page];

				hideInfo();

				elem.stop().popover({
					content: content,
					placement: "right",
					trigger: "manual",
					title: title,
					html: true
				}).stop().popover("show");

				// jQuery(elem).mouseout(function() { jQuery('.popover').remove(); });
				// infoInProgress = false;
			});
		});
	}

	// Hide all info popups
	function hideInfo() {
		$("div.chat-list a:not(.disabled)").stop().popover("hide").stop().popover("destroy");
		$("div.popover").remove();
	}

	// Setup events
	function setupEvents() {
		// Track window focus
		$(window).focus(function() {
			windowFocus = true;

			if (currentSound != null) {
				currentSound.stop();
			}
		}).blur(function() {
			windowFocus = false;
		});

		// Join Chat
		$("body").on("click", "div.chat-list a:not(.disabled)", function(e) {
			e.preventDefault();

			if ($(this).hasClass("left-chat")) {
				alert("Client has left chat and is no longer online.");

				return;
			}

			var sessionId = $(this).attr("data-session-id");
			var name = $(this).find("h4").text();
			var email = $(this).find("p span.email").text();

			joinChat(sessionId, name, email);

			hideInfo();
		});

		// Tab switch between chats
		$("body").on("click", ".chat-tabs li a", function(e) {
			e.preventDefault();

			var channelId = $(this).closest("li").attr("data-channel-id");

			$("form[data-channel-id]").hide();
			$(".chat-tabs li").removeClass("active");
			$("form[data-channel-id='" + channelId + "']").show();
			$(this).closest("li").addClass("active");

			autoScroll();
		});

		// Send message on button click
		$("body").on("click", "button.btn-send", function(e) {
			e.preventDefault();

			var channelId = $(this).closest("form").attr("data-channel-id");
			var message = $(this).closest("form").find("input[type='text']").val();

			$(this).closest("form").find("input[type='text']").val("");

			sendMessage(channelId, message);
		});

		// Send message on enter press
		$("body").on("keypress", "input[type='text']", function(e) {
			if (e.keyCode == 13 && !e.shiftKey) {
				e.preventDefault();

				var channelId = $(this).closest("form").attr("data-channel-id");
				var message = $(this).closest("form").find("input[type='text']").val();

				$(this).closest("form").find("input[type='text']").val("");

				sendMessage(channelId, message);
			}
		});

		// Leave chat
		$("body").on("click", "ul.chat-tabs button", function(e) {
			e.preventDefault();
			e.stopPropagation();

			var channelId = $(this).closest("li").attr("data-channel-id");

			leaveChat(channelId);
		});

		// Prevent form submit
		$("body").on("submit", "form", function(e) {
			e.preventDefault();
		});

		// Mouse over popover
		$("body").on("mouseenter", "div.chat-list a:not(.disabled)", function(e) {
			var sessionId = $(this).attr("data-session-id");

			// infoInProgress = true;
			showInfo(sessionId);
		});

		$("body").on("mouseleave, mouseout", "div.chat-list a:not(.disabled)", function(e) {
			hideInfo();
		});

		setInterval(function() {
			if ($("div.chat-list a:not(.disabled):hover").length == 0) {
				console.log("Performing info popup cleanup...");
				hideInfo();
			}
		}, 5000);

		window.onbeforeunload = function(e) {
			performCleanup();
			deleteCookie("MKChatSessionID");
		};
	}

	// If we are on admin chat page initiate
	if (typeof MKChatAdminStartup != "undefined" && MKChatAdminStartup) {
		init();
	}

}(jQuery, window));
