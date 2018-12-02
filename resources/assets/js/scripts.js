
(function (){

    'use strict';

    window.SHOWCASE = {
        admin: {},
        front: {}
    };

})();


// Upload New Pin
(function (){

    'use strict';

    SHOWCASE.admin.uploadPins = function() {

        $('#information_pin_button').on('click', function (e) {

            e.preventDefault();

            tinyMCE.triggerSave();
            var pinSubmit       = $('#information_pin_button').val();
            var pinTitle        = $('#information_pin_title').val();
            var pinShowcaseId   = $('#tempID').val();
            var pinBody         = $('#information_pin_body').val();

            console.log(pinSubmit + ' did the button return true ||This is title: '+pinTitle+' This is pin Body: ' + pinBody)

            $.ajax({
                type: 'post',
                url : '/admin/pins',
                data: {pinSubmit: pinSubmit, pinShowcaseId: pinShowcaseId, pinTitle: pinTitle, pinBody: pinBody},

                success: function (data) {
                    var res = jQuery.parseJSON(data);

                    if(res.status === 'OK'){
                        $('#pin-notification').delay(6000).slideUp(400).html('<div class="callout success">' + res.message + '</div>');
                        $('.information_pins').append(res.pins);
                    }

                    if(res.status === 'FAILED'){
                        $('#pin-notification').delay(6000).slideUp(400).html('<div class="callout warning">' + res.message + '</div>');
                    }

                }
            });

        })
    };

})();

// Delete Pin
(function (){

    'use strict';

    SHOWCASE.admin.deletePin = function () {

        $('.deletePin').on('click', function (e) {

            e.preventDefault();

            var CSRFToken   = $(this).data('csrftoken');
            var pinId       = $(this).data('pinid');
            var showId      = $(this).data('showid');

            console.log('CSRFToken: ' + CSRFToken +' pin Id: ' + pinId + ' show id: ' + showId);

            $.ajax({
                type: 'post',
                url : '/admin/pins/delete',
                data: {
                    CSRFToken: CSRFToken,
                    pinId: pinId,
                    showId: showId
                },

                success: function (data) {
                    var res = jQuery.parseJSON(data);

                    if(res.status === 'OK'){
                        $('.notification').delay(5000).slideUp(600).html('<div class="callout success">'+ res.message + '</div>');
                        $('#insertedPin-'+res.pin_id).html('');
                    }

                    if(res.status === 'FAILED'){
                        $('.notification').delay(5000).slideUp(600).html('<div class="callout warning">'+ res.message + '</div>');
                    }
                }
            })

        })
    };

})();

// Edit Pin
(function (){

    'use strict';

    SHOWCASE.admin.updatePin = function () {

        $('.editPin').on('click', function (e) {

            e.preventDefault();

            tinyMCE.triggerSave();
            var CSRFToken   = $(this).data('csrftoken');
            var pinId       = $(this).data('pinid');
            var showId      = $(this).data('showid');
            var pinTitle    = $('#pinTitle-'+pinId).val();
            var pinBody     = $('#pinBody-'+pinId).val();

            console.log('CSRFToken: ' + CSRFToken +' pin Id: ' + pinId + ' show id: ' + showId + ' pin Title: ' + pinTitle + ' pin Body: ' + pinBody);

            $.ajax({
                type: 'post',
                url : '/admin/pins/edit',
                data: {
                    CSRFToken: CSRFToken,
                    pinId: pinId,
                    showId: showId,
                    pinTitle: pinTitle,
                    pinBody: pinBody
                },

                success: function (data) {
                    var res = jQuery.parseJSON(data);

                    if(res.status === 'OK'){
                        $('.notification').delay(5000).slideUp(600).html('<div class="callout success">'+ res.message + '</div>');
                        $('#insertedPinTitle-'+res.pin_id).html(res.pinTitle);
                        $('#insertedPinBody-'+res.pin_id).html(res.pinBody);
                    }

                    if(res.status === 'FAILED'){
                        $('.notification').delay(5000).slideUp(600).html('<div class="callout warning">'+ res.message + '</div>');
                    }
                }
            })

        })
    };

})();




// Insert New Contact
(function (){

    'use strict';

    SHOWCASE.front.submitcontact = function () {

        $('#submit').on('click', function (e) {

            e.preventDefault();

            var CSRFToken   = $('#CSRFToken').val();
            var submit      = $('#submit').val();
            var userName    = $('#name').val();
            var userEmail   = $('#email').val();
            var userPhone   = $('#phone').val();
            var userMess    = $('#message').val();
            var userDate    = $('#date_est').val();

            console.log(userName + ' ' + userEmail + ' ' +  userPhone);

            $.ajax({
                type: 'post',
                url : '/contact',
                data: {CSRFToken: CSRFToken, submit: submit, userName: userName, userEmail: userEmail, userPhone: userPhone, userMess: userMess, userDate: userDate},

                success: function (data) {
                    var res = jQuery.parseJSON(data);

                    if(res.status === 'OK'){
                        $('.cont-notification').show().addClass('success').delay(4000).slideUp(300).html(res.message);
                    }
                    if(res.status === 'FAILED'){
                        $('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html(res.message);
                    }
                }
            });

        });

    };

})();

// Submit User Comment
(function (){

    'use strict';

    SHOWCASE.front.submitComment = function () {
        
        $('#commentSubmit').on('click', function (e) {

            e.preventDefault();

            var CSRFToken       =   $(this).data('csrftoken');
            var showcaseId      =   $(this).data('show_id');
            var commentSubmit   =   $('#commentSubmit').val();
            var commentAuthor   =   $('#commentAuthor').val();
            var commentEmail    =   $('#commentEmail').val();
            var commentBody     =   $('#commentBody').val();

            $.ajax({
                type: 'post',
                url : '/showcase/comment',
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

                    if(res.status === 'OK'){
                        $('#comment-notification').delay(5000).slideUp(600).html('<div class="callout success">'+ res.message + '</div>');
                    }

                    if(res.status === 'FAILED'){
                        $('#comment-notification').delay(5000).slideUp(600).html('<div class="callout warning">'+ res.message + '</div>');
                    }
                }

            });


        })
        
    }

})();

(function (){

    'use strict';

    // Zurb Foundation initializer
    $(document).foundation();

    $(document).ready(function () {
        switch($('body').data('page-id')){
            // Front
            case 'home':

                SHOWCASE.front.submitcontact();
                break;
            case 'showcased':

                SHOWCASE.front.submitComment();
                break;

            // Admin
            case 'dashboard':

                // Google 3D Chart Initializer
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);

                break;
            case 'users':

                break;
            case 'uploads':

                // WYSIWYG Editor Initializer
                tinymce.init({
                    selector:'textarea',
                    plugins: "autoresize",
                    autoresize_overflow_padding: 50
                });
                // ColorPicker
                $('#bg_colorselector').iris({
                    hide: false,
                    palettes: true,
                    target: '#bg_colorselectorplacement',

                    change: function(event, ui) {
                        // event = standard jQuery event, produced by whichever control was changed.
                        // ui = standard jQuery UI object, with a color member containing a Color.js object

                        // change the headline color
                        $("#bg_colorselector").css( 'background-color', ui.color.toString());
                    }
                });

                $('#fg_colorselector').iris({
                    hide: false,
                    palettes: true,
                    target: '#fg_colorselectorplacement',

                    change: function(event, ui) {
                        // event = standard jQuery event, produced by whichever control was changed.
                        // ui = standard jQuery UI object, with a color member containing a Color.js object

                        // change the headline color
                        $("#fg_colorselector").css( 'background-color', ui.color.toString());
                    }
                });

                $('#blocknotice_colorselector1').iris({
                    hide: false,
                    palettes: true,

                    change: function(event, ui) {
                        // event = standard jQuery event, produced by whichever control was changed.
                        // ui = standard jQuery UI object, with a color member containing a Color.js object

                        // change the headline color
                        $("#blocknotice_colorselector1").css( 'background-color', ui.color.toString());
                    }
                });

                $('#blocknotice_colorselector2').iris({
                    hide: false,
                    palettes: true,

                    change: function(event, ui) {
                        // event = standard jQuery event, produced by whichever control was changed.
                        // ui = standard jQuery UI object, with a color member containing a Color.js object

                        // change the headline color
                        $("#blocknotice_colorselector2").css( 'background-color', ui.color.toString());
                    }
                });

                $('#blocknotice_colorselector3').iris({
                    hide: false,
                    palettes: true,

                    change: function(event, ui) {
                        // event = standard jQuery event, produced by whichever control was changed.
                        // ui = standard jQuery UI object, with a color member containing a Color.js object

                        // change the headline color
                        $("#blocknotice_colorselector3").css( 'background-color', ui.color.toString());
                    }
                });

                // Upload Pins
                SHOWCASE.admin.uploadPins();

                // Delete Pin
                SHOWCASE.admin.deletePin();

                // Edit Pin
                SHOWCASE.admin.updatePin();

                break;
            case 'showcase':

                break;

            case 'settings':
                // WYSIWYG Editor Initializer
                tinymce.init({
                    selector: "textarea",  // change this value according to your HTML
                    plugins: "autoresize",
                    autoresize_overflow_padding: 50
                });
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
