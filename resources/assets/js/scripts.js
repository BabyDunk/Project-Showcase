(function () {
	
	'use strict';
	
	window.SHOWCASE = {
		admin: {},
		front: {}
	};
	
})();


// Upload New Pin
(function () {
	
	'use strict';
	
	SHOWCASE.admin.uploadPins = function () {
		
		$('#information_pin_button').on('click', function (e) {
			
			e.preventDefault();
			
			tinyMCE.triggerSave();
			var pinSubmit = $('#information_pin_button').val();
			var pinTitle = $('#information_pin_title').val();
			var pinShowcaseId = $('#tempID').val();
			var pinBody = $('#information_pin_body').val();
			
			if (pinTitle === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a pin title!</div>');
			} else if (pinBody === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a pin body</div>');
			} else {
				
				$.ajax({
					type: 'post',
					url: '/sc-panel/pins',
					data: {
						pinSubmit: pinSubmit,
						pinShowcaseId: pinShowcaseId,
						pinTitle: pinTitle,
						pinBody: pinBody
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('#pin-notification').delay(6000).slideUp(400).html('<div class="callout success">' + res.message + '</div>');
							$('.information_pins').append(res.pins);
							
							$('#information_pin_title').val('');
							$('#information_pin_body').val('');
						}
						
						if (res.status === 'FAILED') {
							$('#pin-notification').delay(6000).slideUp(400).html('<div class="callout warning">' + res.message + '</div>');
						}
						
					}
				});
			}
		})
	};
	
})();

// Delete Pin
(function () {
	
	'use strict';
	
	SHOWCASE.admin.deletePin = function () {
		
		$('.deletePin').on('click', function (e) {
			
			e.preventDefault();
			
			var CSRFToken = $(this).data('csrftoken');
			var pinId = $(this).data('pinid');
			var showId = $(this).data('showid');
			
			
			$.ajax({
				type: 'post',
				url: '/sc-panel/pins/delete',
				data: {
					CSRFToken: CSRFToken,
					pinId: pinId,
					showId: showId
				},
				
				success: function (data) {
					var res = jQuery.parseJSON(data);
					
					if (res.status === 'OK') {
						$('.notification').delay(5000).slideUp(600).html('<div class="callout success">' + res.message + '</div>');
						$('#insertedPin-' + res.pin_id).html('');
					}
					
					if (res.status === 'FAILED') {
						$('.notification').delay(5000).slideUp(600).html('<div class="callout warning">' + res.message + '</div>');
					}
				}
			})
			
		})
	};
	
})();

// Edit Pin
(function () {
	
	'use strict';
	
	SHOWCASE.admin.updatePin = function () {
		
		$('.editPin').on('click', function (e) {
			
			e.preventDefault();
			
			tinyMCE.triggerSave();
			var CSRFToken = $(this).data('csrftoken');
			var pinId = $(this).data('pinid');
			var showId = $(this).data('showid');
			var pinTitle = $('#pinTitle-' + pinId).val();
			var pinBody = $('#pinBody-' + pinId).val();
			
			if (CSRFToken === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please refresh the page and try again</div>');
			} else if (pinId === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Can\'t identify the pin. Please try again</div>');
			} else if (showId === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Can\'t identify the listed item. Please try again</div>');
			} else if (pinTitle === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a pin title</div>');
			} else if (pinBody === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a pin body </div>');
			} else {
				
				$.ajax({
					type: 'post',
					url: '/sc-panel/pins/edit',
					data: {
						CSRFToken: CSRFToken,
						pinId: pinId,
						showId: showId,
						pinTitle: pinTitle,
						pinBody: pinBody
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout success">' + res.message + '</div>');
							$('#insertedPinTitle-' + res.pin_id).html(res.pinTitle);
							$('#insertedPinBody-' + res.pin_id).html(res.pinBody);
							
							$('#pinTitle-' + pinId).val('');
							$('#pinBody-' + pinId).val('');
						}
						
						if (res.status === 'FAILED') {
							$('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">' + res.message + '</div>');
						}
					}
				})
			}
		})
	};
	
})();

// Build for the card flipped template
(function () {
	
	'use strict';
	
	SHOWCASE.front.homepage = function () {
		
		
		const flippers = document.querySelectorAll('#cubeFlip .card');
		/*const respNav = document.querySelector('#nav-bar-navi span');
		 const respMenu = document.querySelector('#nav-small');*/
		const contNav = document.querySelectorAll('#conWindow .controlend a');
		const contPan = document.querySelectorAll('.businessend .conPanel');
		const headNav = document.querySelectorAll('a.nav-link');
		
		for (let x = 0; x < flippers.length; x++) {
			
			let card = flippers[x].classList;
			
			flippers[x].addEventListener('click', function () {
				setTimeout(function () {
					card.toggle('activeFlip')
				}, 200);
				setTimeout(clearFlip, 15000);
				
			});
			
		}
		
		function clearFlip() {
			for (let x = 0; x < flippers.length; x++) {
				let cCard = flippers[x].classList;
				if (cCard.contains('activeFlip')) {
					cCard.remove('activeFlip');
				}
			}
		}
		
		
		for (let x = 0; x < contNav.length; x++) {
			contNav[x].addEventListener('click', function (evt) {
				evt.preventDefault();
				blockReset();
				let e = evt.target;
				document.querySelector('.' + e.dataset.navid).style.transition = 'ease-in-out';
				document.querySelector('.' + e.dataset.navid).style.display = 'block';
				
				console.log(document.querySelector('#' + e.dataset.navid).style.display);
			});
		}
		
		function blockReset() {
			for (let x = 0; x < contPan.length; x++) {
				contPan[x].style.display = 'none';
			}
		}
		
		
		for (let x = 0; x < headNav.length; x++) {
			headNav[x].addEventListener('click', function (evt) {
				evt.preventDefault();
				scrollDown(evt.target);
			})
		}
		
		function scrollDown(el) {
			let speed = 10;
			let actionScroll = setInterval(moveScroll, 1);
			
			function moveScroll() {
				let to = document.scrollingElement;
				let stopper = document.querySelector(el.hash).offsetTop;
				stopper = Math.floor(stopper /= speed) * speed;
				
				let mover = to.scrollTop;
				mover = Math.floor(mover /= speed) * speed;
				
				let bottomStop = Math.floor((to.scrollHeight - to.clientHeight) / speed) * speed;
				
				if (mover === bottomStop) {
					document.scrollingElement.scrollTop -= speed;
					clearInterval(actionScroll);
				} else if (mover < stopper) {
					document.scrollingElement.scrollTop += speed;
				} else if (mover > stopper) {
					document.scrollingElement.scrollTop -= speed;
				} else if (mover === stopper) {
					clearInterval(actionScroll);
				}
			}
		}
		
		
	}
	
})();

// Insert New Contact
(function () {
	
	'use strict';
	
	SHOWCASE.front.submitcontact = function () {
		
		$('#submit').on('click', function (e) {
			
			e.preventDefault();
			
			var CSRFToken = $('#CSRFToken').val();
			var submit = $('#submit').val();
			var userName = $('#name').val();
			var showcaseID = 0;
			var userEmail = $('#email').val();
			var userPhone = $('#phone').val();
			var userMess = $('#message').val();
			var date_est = $('#date_est').val();
			
			
			if (CSRFToken === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please refresh the page and try again</div>');
			} else if (userName === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a name!</div>');
			} else if (userEmail === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide an email address!</div>');
			} else if (userPhone === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a phone number!</div>');
			} else if (userMess === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a message!</div>');
			} else if (date_est === '') {
				$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a date for query completion!</div>');
			} else {
				
				
				$.ajax({
					type: 'post',
					url: '/contact',
					data: {
						CSRFToken: CSRFToken,
						submit: submit,
						userName: userName,
						showcaseID: showcaseID,
						userEmail: userEmail,
						userPhone: userPhone,
						userMess: userMess,
						date_est: date_est
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout success">' + res.message + '</div>');
							
							$('#name').val('');
							$('#email').val('');
							$('#phone').val('');
							$('#message').val('');
							$('#date_est').val('');
						}
						if (res.status === 'FAILED') {
							$('.cont-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">' + res.message + '</div>');
						}
					}
				});
			}
		});
		
	};
	
})();

// Submit User Comment
(function () {
	
	'use strict';
	
	SHOWCASE.front.submitComment = function () {
		
		$('#commentSubmit').on('click', function (e) {
			
			e.preventDefault();
			
			var CSRFToken = $(this).data('csrftoken');
			var showcaseId = $(this).data('show_id');
			var commentSubmit = $('#commentSubmit').val();
			var commentAuthor = $('#commentAuthor').val();
			var commentEmail = $('#commentEmail').val();
			var commentBody = $('#commentBody').val();
			
			if (CSRFToken === '') {
				$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please refresh the page an try again</div>');
			} else if (showcaseId === '') {
				$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Sorry can\'t identify the item please refresh and try again</div>');
			} else if (commentAuthor === '') {
				$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide the authors name!</div>');
			} else if (commentEmail === '') {
				$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide the authors email address!</div>');
			} else if (commentBody === '') {
				$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">Please provide a message!</div>');
			} else {
				
				$.ajax({
					type: 'post',
					url: '/shop/showcase/comment',
					data: {
						CSRFToken: CSRFToken,
						showcaseId: showcaseId,
						commentSubmit: commentSubmit,
						commentAuthor: commentAuthor,
						commentEmail: commentEmail,
						commentBody: commentBody
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout success">' + res.message + '</div>');
							$('#commentAuthor').val('');
							$('#commentEmail').val('');
							$('#commentBody').val('');
						}
						
						if (res.status === 'FAILED') {
							$('#comment-notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">' + res.message + '</div>');
						}
					}
					
				});
			}
			
		})
		
	}
	
})();

// Request Information
(function () {
	
	'use strict';
	
	SHOWCASE.front.requestInfoEmail = function () {
		
		$('#submitInfoForm').on('click', function (e) {
			
			e.preventDefault();
			
			
			var CSRFToken = $('#CSRFToken').val();
			var submitInfoForm = $('#submitInfoForm').val();
			var emailInfoForm = $('#emailInfoForm').val();
			
			if (CSRFToken === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).show().html('<div class="callout warning">Please refresh the page and try again</div>');
			} else if (emailInfoForm === '') {
				$('.notification').html('').show().delay(5000).slideUp(600).show().html('<div class="callout warning">Please enter an Email address to receive additional info</div>');
			} else {
				
				$.ajax({
					type: 'post',
					url: '/getinfo',
					data: {
						CSRFToken: CSRFToken,
						submitInfoForm: submitInfoForm,
						emailInfoForm: emailInfoForm
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('.notification').html('').show().delay(5000).slideUp(600).show().html('<div class="callout success">' + res.message + '</div>');
							
							console.dir(res)
						}
						
						if (res.status === 'FAILED') {
							$('.notification').html('').show().delay(5000).slideUp(600).show().html('<div class="callout warning">' + res.message + '</div>');
							
							console.dir(res)
						}
					}
					
				});
			}
			
		})
		
	}
	
})();

// Insert New Showcase Contact
(function () {
	
	'use strict';
	
	SHOWCASE.front.submitshowcasecontact = function () {
		
		$('#submit').on('click', function (e) {
			
			e.preventDefault();
			
			var CSRFToken = $('#CSRFToken').val();
			var submit = $('#submit').val();
			var userName = $('#name').val();
			var showcaseID = $('#showcaseID').val();
			var userEmail = $('#email').val();
			var userPhone = $('#phone').val();
			var userMess = $('#message').val();
			var userDate = 0;
			
			
			if (CSRFToken === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Please refresh the page try again.');
			}
			if (userName === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Please enter a name!');
			} else if (showcaseID === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Item identification not present');
			} else if (userEmail === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Please enter a valid email address!');
			} else if (userPhone === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Please enter a valid phone number!');
			} else if (userMess === '') {
				$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html('Please enter a message!');
			} else {
				
				
				$.ajax({
					type: 'post',
					url: '/shop/showcase_contact',
					data: {
						CSRFToken: CSRFToken,
						submit: submit,
						userName: userName,
						showcaseID: showcaseID,
						userEmail: userEmail,
						userPhone: userPhone,
						userMess: userMess,
						userDate: userDate
					},
					
					success: function (data) {
						var res = jQuery.parseJSON(data);
						
						if (res.status === 'OK') {
							$('.cont-notification').show().addClass('success').delay(4000).slideUp(300).html(res.message);
							
							$('#name').val('');
							$('#email').val('');
							$('#phone').val('');
							$('#message').val('');
						}
						if (res.status === 'FAILED') {
							$('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html(res.message);
						}
					}
				});
			}
			
		});
		
	};
	
})();

// Avatar colour Initial
(function () {
	
	'use strict';
	
	SHOWCASE.admin.commentNameAvatar = function () {
		
		var needAvatar = document.querySelectorAll('.comment-media-object');
		
		var colours = [
			"#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
			"#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
		];
		
		
		for (let x = 0; x < needAvatar.length; x++) {
			
			var firstChar = needAvatar[x].dataset.author.charAt(0).toUpperCase();
			var randomColor = colours[Math.floor(Math.random() * colours.length)];
			
			needAvatar[x].innerHTML = '<div id="avatarBox-"' + x + ' style="background-color: ' + randomColor + ';width:50px;height: 50px;display:flex;justify-content: center;align-items: center;font-size:1.2em;color:#141414"><span>' + firstChar + '</span></div>';
		}
	}
	
})();

// WYSIWYG Editor Initializer
(function () {
	
	'use strict';
	
	SHOWCASE.admin.textareaEditor = function () {
		return tinymce.init({
			selector: 'textarea',
			plugins: "autoresize",
			autoresize_overflow_padding: 50
		});
	}
	
})();

// Vanilla Color Picker
(function () {
	
	'use strict';
	
	
	SHOWCASE.admin.vanillaColorPicker = function ($eleLocation) {
		var length = $eleLocation.length - 10;
		var getIputName = $eleLocation.slice(0, length);
		var parentElement = document.getElementById($eleLocation);
		
		
		var picker = new Picker({
			parent: parentElement,
			color: parentElement.dataset.preselectedcolor,
			popup: 'right',
			alpha: true,
			editor: true,
			onChange: function (color) {
				parentElement.style.backgroundColor = color.rgbaString;
				document.getElementById(getIputName).value = color.rgbaString;
			},
		});
	}
	
})();

// insert floating elements
(function () {
	
	'use strict';
	
	SHOWCASE.front.setFloatingIconDiv = function (id) {
		let html = '';
		for (let x = 1; x < 21; x++) {
			html += '<div class="welcome-floating-langs--' + x + '"><div class="random-floating-item"></div></div>'
		}
		document.getElementById(id).innerHTML += html;
	}
	
})();

/* Smooth Scroller */
(function () {
	
	'use strict';
	
	SHOWCASE.front.scrollDown = function (el) {
		let speed = 5;
		let actionScroll = setInterval(moveScroll, 1);
		SHOWCASE.fullyOpen = false;
		
		function moveScroll() {
			let to = document.scrollingElement;
			let stopper = document.querySelector(el).offsetTop;
			stopper = Math.floor(stopper /= speed) * speed;
			
			let mover = to.scrollTop;
			mover = Math.floor(mover /= speed) * speed;
			
			let bottomStop = Math.floor((to.scrollHeight - to.clientHeight) / speed) * speed;
			
			if (mover === bottomStop) {
				document.scrollingElement.scrollTop -= speed;
				clearInterval(actionScroll);
			} else if (mover < stopper) {
				document.scrollingElement.scrollTop += speed;
			} else if (mover > stopper) {
				document.scrollingElement.scrollTop -= speed;
			} else if (mover === stopper) {
				clearInterval(actionScroll);
			}
		}
	}
	
	
})();

/* Comment Fixed Position Form  */
(function () {
	
	'use strict';
	
	SHOWCASE.front.sticky = function () {
		
		var sticky = document.querySelector('.sticky');
		var stickTo = document.getElementById(sticky.dataset.anchored);
		var offSetTop = stickTo.offsetParent.offsetTop;
		var offSetStopper = ((stickTo.scrollHeight - sticky.scrollHeight) + offSetTop);
		var stickyWidth = sticky.scrollWidth;
		
		sticky.style.width = stickyWidth + 'px';
		document.addEventListener('scroll', function (evt) {
			
			if (sticky.scrollHeight > stickTo.scrollHeight) {
				sticky.style.position = 'relative';
				sticky.style.top = '0';
				sticky.style.bottom = null;
			} else if (evt.pageY >= offSetTop && evt.pageY <= offSetStopper) {
				sticky.style.top = '50px';
				sticky.style.position = 'fixed';
				
			} else {
				
				if (evt.pageY > offSetStopper) {
					sticky.style.position = 'absolute';
					sticky.style.bottom = '50px';
					sticky.style.top = null;
				} else {
					sticky.style.position = 'relative';
					sticky.style.top = '0';
					sticky.style.bottom = null;
				}
			}
			
		})
		
	}
	
})();


// Function Callout Container
(function () {
	
	'use strict';
	
	// Zurb Foundation initializer
	$(document).foundation();
	
	$(document).ready(function () {
		switch ($('body').data('page-id')) {
			// Front
			case 'home':
				// Insert floating elements
				SHOWCASE.front.setFloatingIconDiv('welcome-section');
				
				SHOWCASE.showNav = document.getElementById('showNavControl');
				SHOWCASE.showNavId = document.querySelectorAll('.showNavMenu ul li a');
				SHOWCASE.fullyOpen = false;
				SHOWCASE.showNav.addEventListener('click', function (evt) {
					let e = evt.target;
					
					if (e.id === 'showNavControl') {
						let eUl = document.querySelector('.showNavMenu ul');
						
						if (SHOWCASE.fullyOpen) {
							eUl.style.transform = 'scale(0,0)';
							e.parentElement.nextElementSibling.style.height = '0';
							e.parentElement.nextElementSibling.style.width = '0';
							e.parentElement.nextElementSibling.style.backgroundColor = '#555555';
							SHOWCASE.fullyOpen = false;
						} else {
							e.parentElement.nextElementSibling.style.height = '100vh';
							e.parentElement.nextElementSibling.style.width = '100vw';
							e.parentElement.nextElementSibling.style.backgroundColor = '#008de3';
							eUl.style.transform = 'scale(1,1)';
							SHOWCASE.fullyOpen = true;
						}
					}
					
				});
				
				for (let x = 0; x < SHOWCASE.showNavId.length; x++) {
					SHOWCASE.showNavId[x].addEventListener('click', function (evt) {
						evt.preventDefault();
						let e = evt.target;
						e.parentElement.parentElement.style.transform = 'scale(0,0)';
						e.parentElement.parentElement.parentElement.style.height = '0';
						e.parentElement.parentElement.parentElement.style.width = '0';
						e.parentElement.parentElement.parentElement.style.backgroundColor = '#555555';
						SHOWCASE.front.scrollDown(e.hash);
					});
				}
				
				
				SHOWCASE.front.requestInfoEmail();
				SHOWCASE.front.submitcontact();
				flatpickr("#date_est");
				
				
				break;
			
			case 'shop':
				SHOWCASE.front.submitcontact();
				flatpickr("#date_est");
				if($('#featured-carousel') !== undefined) {
					var carousel = new Carousel({
						elem: 'featured-carousel',    // id of the carousel container
						autoplay: true,     // starts the rotation automatically
						infinite: true,      // enables the infinite mode
						interval: 7000,      // interval between slide changes
						initial: 0,          // slide to start with
						dots: false,          // show navigation dots
						arrows: false,        // show navigation arrows
						buttons: false,      // hide play/stop buttons,
						btnStopText: 'Pause' // STOP button text
					});
				}
				if($('#shoptext-carousel') !== undefined) {
					var carouselText = new Carousel({
						elem: 'shoptext-carousel',    // id of the carousel container
						autoplay: true,     // starts the rotation automatically
						infinite: true,      // enables the infinite mode
						interval: 7000,      // interval between slide changes
						initial: 0,          // slide to start with
						dots: false,          // show navigation dots
						arrows: false,        // show navigation arrows
						buttons: false,      // hide play/stop buttons,
						btnStopText: 'Pause' // STOP button text
					});
				}
				break;
			
			case 'showcased':
				
				SHOWCASE.front.submitComment();
				SHOWCASE.front.submitshowcasecontact();
				SHOWCASE.admin.commentNameAvatar();
				flatpickr("#date_est");
				SHOWCASE.front.sticky();
				
				break;
			
			// Admin
			case 'dashboard':
				
				// Load avatars
				SHOWCASE.admin.commentNameAvatar();
				// Google 3D Chart Initializer
				google.charts.load("current", {packages: ["corechart"]});
				google.charts.setOnLoadCallback(drawChart);
				break;
			
			case 'users':
				
				break;
			
			case 'uploads':
				
				// WYSIWYG Editor
				SHOWCASE.admin.textareaEditor();
				/* tinymce.init({
				 selector:'textarea',
				 plugins: "autoresize",
				 autoresize_overflow_padding: 50
				 });*/
				// ColorPicker
				SHOWCASE.admin.vanillaColorPicker('blocknotice_colorselector1-placement');
				SHOWCASE.admin.vanillaColorPicker('blocknotice_colorselector2-placement');
				SHOWCASE.admin.vanillaColorPicker('blocknotice_colorselector3-placement');
				SHOWCASE.admin.vanillaColorPicker('bg_colorselector-placement');
				SHOWCASE.admin.vanillaColorPicker('fg_colorselector-placement');
				
				// Upload Pins
				SHOWCASE.admin.uploadPins();
				
				// Delete Pin
				SHOWCASE.admin.deletePin();
				
				// Edit Pin
				SHOWCASE.admin.updatePin();
				
				break;
			
			case 'showcase':
				
				break;
			
			case 'general-settings':
				// WYSIWYG Editor Initializer
				SHOWCASE.admin.textareaEditor();
				
				
				break;
			
			case 'email-settings':
				// WYSIWYG Editor Initializer
				SHOWCASE.admin.textareaEditor();
				
				
				break;
			
			case 'email-temp-settings':
				
				
				break;
			
			case 'social-settings':
				// WYSIWYG Editor Initializer
				SHOWCASE.admin.textareaEditor();
				
				
				break;
			
			case 'logging-settings':
				// WYSIWYG Editor Initializer
				SHOWCASE.admin.textareaEditor();
				
				
				break;
			
			case 'comments':
				
				break;
			case 'update-user':
				
				break;
			
			case 'add-user':
				
				break;
			
			case 'login':
				
				break;
			
			default:
				break;
			
		}
	});
	
})();