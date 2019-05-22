(function () {
	
	'use strict';
	
	window.SHOWCASE = {
		admin: {},
		front: {},
		utility: {}
	};
	
})();

/* UTILITY FUNCTION */


// Check if is a valid email
(function (){
	
	'use strict';
	
	SHOWCASE.utility.isEmail = function(email){
		var newRegEx = new RegExp(/^[a-zA-Z0-9!#$%&'*+\-\/=?^_`{|]{1,64}@[a-zA-Z0-9-]{1,253}\.(?:[a-zA-Z]{2,9}\.[a-zA-Z]{2,20}|[a-zA-Z]{2,20})$/m);
		
		return newRegEx.test(email);
	}
	
})();



/* UTILITY FUNCTION */


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


// Initialize Cart
(function () {
	
	'use strict';
	
	SHOWCASE.front.cart = {}
	
})();

// Showcase shopping Storage
(function () {
	
	'use strict';
	// Gets stored cart or builds cart foundation
	SHOWCASE.front.cart.getStoredData = function () {
		var shopCart = localStorage.getItem('sca_MyShoppingCart');
		var shopList = {};
		if (shopCart === null || shopCart === '' || shopCart === undefined) {
			var date = new Date();
			var nowDate = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDay() + ':';
			var time = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
			
			shopList = {
				"sca_shopping_cart": {
					"listStarted": nowDate + time,
					"cart": []
					
				}
			};
			
		} else {
			
			try {
				shopList = JSON.parse(shopCart);
			}
			catch (err) {
				console.log(err.name);
			}
			
		}
		
		return shopList;
	}
	
})();

// Check for duplicate item in cart
(function (){
	
	'use strict';
	
	// Check for duplicate item in cart. returns index position if true else return false
	SHOWCASE.front.cart.duplicateItem = function(checkArr, againstId) {
		for (var x = 0; x < checkArr.length; x++) {
			if (checkArr[x].id === againstId) {
				return (x + 1);
			}
		}
		return false;
	}
	
})();

// Update cart to storage
(function (){
	
	'use strict';
	
	// Add to or update currently stored items
	SHOWCASE.front.cart.updateCartItem = function(addToCart) {
		var shopCart = SHOWCASE.front.cart.getStoredData();
		var cartAmount = shopCart.sca_shopping_cart.cart.length;
		
		if (cartAmount > 0) {
			
			var hasDup = SHOWCASE.front.cart.duplicateItem(shopCart.sca_shopping_cart.cart, addToCart.id);
			
			if (hasDup) {
				shopCart.sca_shopping_cart.cart[(hasDup - 1)].quantity = addToCart.quantity;
				shopCart.sca_shopping_cart.cart[(hasDup - 1)].total = addToCart.price * addToCart.quantity
			} else {
				shopCart.sca_shopping_cart.cart.push(addToCart);
			}
			
		} else {
			shopCart.sca_shopping_cart.cart.push(addToCart)
		}
		
		// Set shopping cart back to storage
		localStorage.setItem('sca_MyShoppingCart', JSON.stringify(shopCart));
		
		return shopCart;
	}
	
})();

// Build cart item
(function (){
	
	'use strict';
	// Builds each item for cart and calculations total
	SHOWCASE.front.cart.buildCartItem = function(shopObj) {
		var eData = shopObj.dataset;
		var quantity = document.getElementById('addLicence-id-' + eData.shopitemid).value;
		var total = eData.shopitemprice * quantity;
		return {
			"title": eData.shopitemtitle,
			"image": eData.shopitemimage,
			"id": Number(eData.shopitemid),
			"quantity": Number(quantity),
			"price": eData.shopitemprice,
			"total": total
		};
	}
	
})();

// Showcase Shop Cart
(function () {
	
	'use strict';
	
	SHOWCASE.front.cart.buildShoppingList = function () {
		// Listens for add to cart clicks and executes functions
		$('#addToCart').on('click', function (evt) {
			SHOWCASE.front.cart.updateCartItem(SHOWCASE.front.cart.buildCartItem( evt.target))
		});
		
	}
	
})();

// Build shop item list
(function (){
	
	'use strict';
	// Build a list of cart item in localstorage
	SHOWCASE.front.cart.buildCartList = function() {
		var cartList = SHOWCASE.front.cart.getStoredData();
		var totalPrice = 0;
		var totalTaxes = 0;
		
		if(cartList.sca_shopping_cart.cart.length > 0) {
			var html = '';
			for (var x = 0; x < cartList.sca_shopping_cart.cart.length; x++) {
				var listData = cartList.sca_shopping_cart.cart[x];
				var mTitle = listData.title.split(' ').join('_');
				totalPrice += (listData.price*listData.quantity);
				
				html += '<li>';
				html += '<figure class="cart-item" data-itemid="' + listData.id + '">';
				html += '<div class="img-box">';
				html += '<a href="/shop/showcase/'+listData.id+'/'+mTitle+'" ><img src="' + listData.image + '" alt="' + listData.title + '"></a>';
				html += '</div>';
				html += '<div class="info-box">';
				html += '<div class="info-inner">';
				html += '<h3>' + listData.title + '</h3>';
				html += '<label for="itemCounter-id-' + listData.id + '">Change licence amount  </label>';
				html += '<select id="itemCounter-id-' + listData.id + '">';
				for (var i = 1; i <= 20; i++) {
					
					if(i === parseInt(listData.quantity)){
						html += '<option value="' + i + '" selected>' + i + '</option>';
					}else{
						html += '<option value="' + i + '">' + i + '</option>';
					}
					
				}
				html += '</select>';
				html += '</div>';
				html += '<div class="item-remover">';
				html += '<a href="#" class="itemRemove" data-itemremove="' + listData.id + '">Remove This Item</a>';
				html += '</div>';
				html += '</div>';
				html += '<div class="price-box">';
				html += '<ul>';
				html += '<li class="pricePerItem"><span>Price per item: </span><span>£' + listData.price + '</span></li>';
				html += '<li class="quantityPerItem"><span>Quantity: </span><span>' + listData.quantity + '</span></li>';
				html += '<li class="priceTotal"><span>Subtotal: </span><span>£' + parseFloat(listData.total).toFixed(2) + '</span></li>';
				html += '</ul>';
				html += '</div>';
				html += '</figure>';
				html += '</li>';
				
			}
			
			// TODO: Consider taxes
			totalTaxes += ((totalPrice/100)*20);
			$('#cartListedItem').html(html);
			$('#taxValue').html('£'+parseFloat(totalTaxes).toFixed(2));
			$('#totalValue').html('£'+parseFloat(totalPrice).toFixed(2));
			
		}else{
			window.location.replace('/shop')
		}
	}
	
})();

// Build Shopping Cart Page
(function () {
	
	'use strict';
	
	SHOWCASE.front.cart.buildShoppingCartPage = function () {
		
		
		// Initialize Cart list building
		SHOWCASE.front.cart.buildCartList();
		
		// Initialize item remove button
		SHOWCASE.front.cart.removeItemFromCartButton();
		
		// Initialize Update All Items In Cart
		SHOWCASE.front.cart.updateItemsQuantities();
		
		// Initialize Cancel All Items
		SHOWCASE.front.cart.cancelAllItemsInCart();
		
		//  Initialize Promotion Code
		SHOWCASE.front.cart.promotionChecker();
		
		// Initialize Gather Personal Info
		SHOWCASE.front.cart.moveToGatherFinInfo();
		
		// Initialize Return to cart view
		SHOWCASE.front.cart.backToCartView();
		
		// Initialize Gather Financial Info
		SHOWCASE.front.cart.moveToFinancialView();
		
	}
	
})();

// Remove item from cart
(function (){
	
	'use strict';
	
	SHOWCASE.front.cart.removeItemFromCartButton = function () {
		$('.itemRemove').on('click', function (evt) {
			if (confirm('Are you sure you want to remove this item from cart?')) {
				removeItemFromCart(evt.target.dataset.itemremove);
			}
		});
		
		
		// Removes item from cart and removes cart altogether if empty
		function removeItemFromCart(id) {
			var cartList = SHOWCASE.front.cart.getStoredData();
			
			var removeThisItem = -1;
			for (var x = 0; x < cartList.sca_shopping_cart.cart.length; x++) {
				if (cartList.sca_shopping_cart.cart[x].id === Number(id)) {
					removeThisItem = x;
				}
			}

			if(removeThisItem>=0){
				cartList.sca_shopping_cart.cart.splice(removeThisItem, 1);
			}
			
			if(cartList.sca_shopping_cart.cart.length <= 0){
				localStorage.removeItem('sca_MyShoppingCart')
			}else{
				localStorage.setItem('sca_MyShoppingCart', JSON.stringify(cartList));
			}
			
			// Rebuild cart
			SHOWCASE.front.cart.buildCartList();
		}
		
	}
	
	
	
	
})();

// Update Every Item In Cart
(function (){
	
	'use strict';
	
	SHOWCASE.front.cart.updateItemsQuantities = function(){
		
		$('#updateCart').on('click', function(){
			var itemsInList = $('.cart-item');
			
			for(var x=0;x<itemsInList.length; x++){
				var itemId = itemsInList[x].dataset.itemid;
				var newQuantity = $('#itemCounter-id-'+itemId).val();
				
				loopAndUpdate(itemId, newQuantity);
			}
			
			
			SHOWCASE.front.cart.buildCartList();
			
			$.ajax({
				type: 'post',
				url: '/sc-panel/promo/ajax',
				data: {promo_code: $('#discountedCode').val(), promo_cal: true, promo_email_link: $('#discountedLinked').val(), cart_items: localStorage.getItem('sca_MyShoppingCart')},
				
				success: function(data){
					var resp = JSON.parse(data);
					
					if(resp.response === 'YES'){
						// TODO: Consider taxes

						var totalTaxes = ((resp.promo_price/100)*20);
						$('#taxValue').html('£'+parseFloat(totalTaxes).toFixed(2));
						$('#totalValue').html('£'+parseFloat(resp.promo_price).toFixed(2));
					}
				}
			});
		})
		
		
	};
	
	
	
	function loopAndUpdate(id, quantity) {
		var  cartList = SHOWCASE.front.cart.getStoredData();
		
		for (var x = 0; x < cartList.sca_shopping_cart.cart.length; x++) {
			var item = cartList.sca_shopping_cart.cart[x];
			
			if (parseInt(item.id) === parseInt(id)) {
				
				if (quantity > 0) {
					cartList.sca_shopping_cart.cart[x].quantity = quantity;
					cartList.sca_shopping_cart.cart[x].total = item.price * quantity;
				} else {
					cartList.sca_shopping_cart.cart.splice(x, 1);
					
					if (cartList.sca_shopping_cart.cart.length <= 0) {
						localStorage.removeItem('sca_MyShoppingCart');
						return
					}
				}
				
				localStorage.setItem('sca_MyShoppingCart', JSON.stringify(cartList));
			}
		}
	}
	
})();

// Cancel All Items In Shopping Cart
(function (){

    'use strict';

    SHOWCASE.front.cart.cancelAllItemsInCart = function(){
    	$('#cancelCart').on('click', function(){
    		if(confirm('Are you sure your want to canel all items in this cart?')){
    			if(localStorage.removeItem('sca_MyShoppingCart') === undefined){
    				window.location.replace('/shop')
			    }
			    
		    }
	    })
    }

})();

// Move to gather personal info
(function (){

    'use strict';

    SHOWCASE.front.cart.moveToGatherFinInfo = function () {
	   
    	$('#moveToGatherFin').on('click', function(){
		    $('.modal').addClass('show');
	    })
    	
    
    }

})();

// Move to financial info
(function (){

    'use strict';

    SHOWCASE.front.cart.moveToFinancialView = function () {
	   
    	$('#moveToFinancialView').on('click', function(){
    		
    		var warningMessage = [];
    		if($('#cartName').val() === ''){
    		    warningMessage.push('Full Name');
		    }
    		
    		if($('#cartAddress').val() === ''){
    			
			    warningMessage.push('Address');
		    }
    		
    		
    		if($('#cartEmail').val() === '') {
			
			    warningMessage.push('Email');
			
		    }else{
				
				    if(!SHOWCASE.utility.isEmail($('#cartEmail').val())){
					    warningMessage.push('Invalid Email Address');
				    }
			    
		    }
		    
		    if(warningMessage.length > 0) {
			 
		    	warningMessage = 'Please supply your ' + warningMessage.join(', ');
			    $('.notification').html(warningMessage);
			    
		    }else{
    		
			   	
			   /* var html = '<figure id="personal-finance">\n' +
			    '<div id="card-surround">\n' +
			    '  <form action="/shop/stripe_payment" method="post" id="payment-form">\n' +
			    '    <div class="form-content">\n' +
			    '      <label for="card-element">\n' +
			    '        Credit or debit card\n' +
			    '      </label>\n' +
			    '      <div id="card-element">\n' +
			    '        <!-- a Stripe Element will be inserted here. -->\n' +
			    '      </div>\n' +
			    '    </div>\n' +
			    '    <!-- Used to display form errors -->\n' +
			    '    <div id="card-errors" role="alert"></div>\n' +
			    '    <div class="form-content">\n' +
			    '        <button class="button success">Submit Payment</button>\n' +
			    '    </div>\n' +
			    '  </form>\n' +
			    '</div>\n' +
			    '</figure>';*/
			
			    $('#personal-info').hide();
			    $('#personal-finance').show();
			
			    SHOWCASE.front.cart.buildStripeCard();
			    
		    }
	    });
    	
    
    }

})();

// Submit data to server
(function (){

    'use strict';

    SHOWCASE.front.cart.submitTransactionToServer = function(){
    	$('#submitStripeToServer').on('click', function(evt){
    		evt.preventDefault();
    		
    		var CSRFToken = $('#CSRFToken').val();
    		var cartObject = localStorage.getItem('sca_MyShoppingCart');
    		var cartName = $('#cartName').val();
    		var cartAddress = $('#cartAddress').val();
    		var cartEmail = $('#cartEmail').val();
    		var stripeToken = $('#stripeToken').val();
    		
    		
    		console.log('CSRFToken: '+CSRFToken + ', cartName:'+ cartName + ', cartAddress:'+cartAddress);
    		console.log('cartObject: '+cartObject );
    		console.log('cartEmail:'+ cartEmail + ', stripeToken:'+stripeToken)
    		
	    })
    }

})();

// Build Stripe Card
(function (){

    'use strict';

    SHOWCASE.front.cart.buildStripeCard = function(){
	
	
	    var stripe = Stripe(stripePubKey);
	
	    var elements = stripe.elements();
	
	    // Custom styling can be passed to options when creating an Element.
	    // (Note that this demo uses a wider set of styles than the guide below.)
	    var style = {
		    base: {
			    color: '#32325d',
			    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
			    fontSmoothing: 'antialiased',
			    fontSize: '16px',
			    '::placeholder': {
				    color: '#aab7c4'
			    }
		    },
		    invalid: {
			    color: '#fa755a',
			    iconColor: '#fa755a'
		    }
	    };
	
	    // Create an instance of the card Element.
	    var card = elements.create('card', {style: style});
	
	    // Add an instance of the card Element into the `card-element` <div>.
	    card.mount('#card-element');
	
	    // Handle real-time validation errors from the card Element.
	    card.addEventListener('change', function(event) {
		    var displayError = document.getElementById('card-errors');
		    if (event.error) {
			    displayError.textContent = event.error.message;
		    } else {
			    displayError.textContent = '';
		    }
	    });
	
	    // Handle form submission.
	    var submitButton = document.getElementById('submitStripeToServer');
	    submitButton.addEventListener('click', function(event) {
		    event.preventDefault();
		
		    stripe.createToken(card).then(function(result) {
			    if (result.error) {
				    // Inform the user if there was an error.
				    var errorElement = document.getElementById('card-errors');
				    errorElement.textContent = result.error.message;
			    } else {
				    // Send the token to your server.
				    stripeTokenHandler(result.token);
			    }
		    });
	    });
	
	    // Submit the form with the token ID.
	    function stripeTokenHandler(token) {
		    // Insert the token ID into the form so it gets submitted to the server
		    var form = document.getElementById('payment-form');
		    var hiddenInput = document.createElement('input');
		    hiddenInput.setAttribute('type', 'hidden');
		    hiddenInput.setAttribute('name', 'stripeToken');
		    hiddenInput.setAttribute('id', 'stripeToken');
		    hiddenInput.setAttribute('value', token.id);
		    form.appendChild(hiddenInput);
		
		
		    var CSRFToken = $('#CSRFToken').val();
		    var cartObject = localStorage.getItem('sca_MyShoppingCart');
		    var cartName = $('#cartName').val();
		    var cartAddress = $('#cartAddress').val();
		    var cartDiscoiunted = $('#discountedCode').val();
		    var cartDiscountLink= $('#discountedLinked').val();
		    var cartPostcode = token.card.address_zip;
		    var cartEmail = $('#cartEmail').val();
		    var stripeToken = $('#stripeToken').val();
		
		
		    $.ajax({
			    type: 'post',
			    url: '/shop/stripe_payment',
			    data: {
			    	CSRFToken: CSRFToken,
				    cartObject: cartObject,
				    cartName: cartName,
				    cartAddress: cartAddress,
				    cartPostcode: cartPostcode,
				    cartEmail: cartEmail,
				    cartDiscounted: cartDiscoiunted,
				    cartDiscountLink: cartDiscountLink,
				    stripeToken: stripeToken
			    },
			    
			    success : function(data){
			    	var resp = JSON.parse(data);
			    	
			    	
			    	if(resp.status === 'FAILED'){
					   $('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout warning">'+resp.message+'</div>');
				    } else if( resp.status === 'SUCCESS'){
					    $('.notification').html('').show().delay(5000).slideUp(600).html('<div class="callout success">'+resp.message+'</div>');
					    
					    localStorage.removeItem('sca_MyShoppingCart');
			    	    window.location.replace('/shop/payment_notice/'+resp.succid+'/'+resp.CSRFToken)
				    }
			    }
		    })
		  
	    }
    }

})();

// Move back to cart view
(function (){

    'use strict';

    SHOWCASE.front.cart.backToCartView = function () {
	   
    	$('#backToCartView').on('click', function(){
		    $('.modal').removeClass('show');
	    })
    	
    
    }

})();


// Promo Checker
(function () {
	
	'use strict';
	
	SHOWCASE.front.cart.promotionChecker = function () {
		
		// Check inputted code with DB
		$('#discountedCode').on('keyup', function (evt) {
			promoAjax(evt, true)
		});
		
		
		// If required check inputted email with DB
		$('#discountedLinked').on('keyup', function (evt) {
			promoAjax(evt, false)
		});
		
		function promoAjax(evt, isCode){
			var promo_code;
			var promo_email;
			if(isCode){
				promo_code = evt.target.value;
				promo_email =  $('#discountedLinked').val()
			}else{
				promo_code = $('#discountedCode').val();
				promo_email = evt.target.value;
			}
			
			if(evt.target.value === ''){
				$('.notification').html('')
			}else {
				$.ajax(
					{
						type: 'POST',
						url: '/sc-panel/promo/ajax',
						data: {promo_code:promo_code, promo_cal: false, promo_email_link: promo_email, cart_items: localStorage.getItem('sca_MyShoppingCart')},
						
						success: function (data) {
							var resp = JSON.parse(data);
							if (resp.response === 'YES') {
								$('.notification').html('').show().html('<div class="callout success">This Promotion is valid</div>');
							} else if (resp.response === 'NO') {
								$('.notification').html('').show().html('<div class="callout warning">This Promotion Code is invalid</div>');
							}else if (resp.response === 'DATELESSER') {
								$('.notification').html('').show().html('<div class="callout success">This Promotion hasn\'t started yet!</div>');
							}else if (resp.response === 'DATEGREATER') {
								$('.notification').html('').show().html('<div class="callout warning">This Promotion has finished!</div>');
							} else if (resp.response === 'EMAIL') {
								$('.notification').html('').show().html('<div class="callout warning">Please enter the email address linked to this promo code</div>');
							}
						}
					}
				)
				
			}
		}
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
				/*SHOWCASE.front.setFloatingIconDiv('welcome-section');
				
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
				 }*/
				
				SHOWCASE.front.homepage();
				SHOWCASE.front.requestInfoEmail();
				SHOWCASE.front.submitcontact();
				flatpickr("#date_est");
				
				
				break;
			
			case 'shop':
				SHOWCASE.front.submitcontact();
				flatpickr("#date_est");
				if ($('#featured-carousel').length) {
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
				if ($('#shoptext-carousel').length) {
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
				SHOWCASE.front.cart.buildShoppingList();
				flatpickr("#date_est");
				SHOWCASE.front.sticky();
				
				break;
			
			case 'cart':
				SHOWCASE.front.cart.buildShoppingCartPage();
				SHOWCASE.front.cart.updateItemsQuantities();
				
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