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
                url : '/sc-panel/pins',
                data: {pinSubmit: pinSubmit, pinShowcaseId: pinShowcaseId, pinTitle: pinTitle, pinBody: pinBody},

                success: function (data) {
                    var res = jQuery.parseJSON(data);

                    if(res.status === 'OK'){
                        $('#pin-notification').delay(6000).slideUp(400).html('<div class="callout success">' + res.message + '</div>');
                        $('.information_pins').append(res.pins);
    
                        $('#information_pin_title').val('');
                        $('#information_pin_body').val('');
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
                url : '/sc-panel/pins/delete',
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
                url : '/sc-panel/pins/edit',
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
    
                        $('#pinTitle-'+pinId).val('');
                        $('#pinBody-'+pinId).val('');
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
            var showcaseID  = 0;
            var userEmail   = $('#email').val();
            var userPhone   = $('#phone').val();
            var userMess    = $('#message').val();
            var userDate    = $('#date_est').val();
            


            $.ajax({
                type: 'post',
                url : '/contact',
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

                    if(res.status === 'OK'){
                        $('.cont-notification').show().addClass('success').delay(4000).slideUp(300).html(res.message);
    
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#message').val('');
                        $('#date_est').val('');
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
                        $('#commentAuthor').val('');
                        $('#commentEmail').val('');
                        $('#commentBody').val('');
                    }

                    if(res.status === 'FAILED'){
                        $('#comment-notification').delay(5000).slideUp(600).html('<div class="callout warning">'+ res.message + '</div>');
                    }
                }

            });


        })
        
    }

})();

// Insert New Showcase Contact
(function (){
    
    'use strict';
    
    SHOWCASE.front.submitshowcasecontact = function () {
        
        $('#submit').on('click', function (e) {
            
            e.preventDefault();
            
            var CSRFToken   = $('#CSRFToken').val();
            var submit      = $('#submit').val();
            var userName    = $('#name').val();
            var showcaseID  = $('#showcaseID').val();
            var userEmail   = $('#email').val();
            var userPhone   = $('#phone').val();
            var userMess    = $('#message').val();
            var userDate    = 0;
            
            $.ajax({
                type: 'post',
                url : '/showcase_contact',
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
                    
                    if(res.status === 'OK'){
                        $('.cont-notification').show().addClass('success').delay(4000).slideUp(300).html(res.message);
                        
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#message').val('');
                    }
                    if(res.status === 'FAILED'){
                        $('.cont-notification').show().addClass('danger').delay(4000).slideUp(300).html(res.message);
                    }
                }
            });
            
        });
        
    };
    
})();

// Avatar colour Initial
(function (){
    
    'use strict';
    
    SHOWCASE.admin.commentNameAvatar = function () {
        
        var needAvatar = document.querySelectorAll('.comment-media-object');
        
        var colours = [
            "#1abc9c", "#2ecc71", "#3498db", "#9b59b6", "#34495e", "#16a085", "#27ae60", "#2980b9", "#8e44ad", "#2c3e50",
            "#f1c40f", "#e67e22", "#e74c3c", "#ecf0f1", "#95a5a6", "#f39c12", "#d35400", "#c0392b", "#bdc3c7", "#7f8c8d"
        ];
        
        
        
        for (let x=0; x<needAvatar.length;x++){
            
            var firstChar = needAvatar[x].dataset.author.charAt(0).toUpperCase();
            var randomColor = colours[Math.floor(Math.random()*colours.length)];
            
            
            needAvatar[x].innerHTML = '<div id="avatarBox-"'+x+' style="background-color: '+randomColor+';width:50px;height: 50px;display:flex;justify-content: center;align-items: center;font-size:1.2em;color:#141414"><span>'+firstChar+'</span></div>';
            console.log(needAvatar[x])
        }
    }
    
})();


// WYSIWYG Editor Initializer
(function (){

    'use strict';
    
    SHOWCASE.admin.textareaEditor = function ()
    {
        return tinymce.init({
            selector:'textarea',
            plugins: "autoresize",
            autoresize_overflow_padding: 50
        });
    }

})();

(function (){

    'use strict';

    
    
    SHOWCASE.admin.vanillaColorPicker = function ($eleLocation)
    {
        var length = $eleLocation.length-10;
        var getIputName = $eleLocation.slice(0,length);
        var parentElement = document.getElementById($eleLocation);
        
        
        var picker = new Picker({
            parent: parentElement,
            color: parentElement.dataset.preselectedcolor,
            popup: 'right',
            alpha: true,
            editor: true,
            onChange: function(color) {
                parentElement.style.backgroundColor = color.rgbaString;
                document.getElementById(getIputName).value = color.rgbaString;
            },
        });
    }

})();


// Function Callout Container
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
                SHOWCASE.front.submitshowcasecontact();
                break;

            // Admin
            case 'dashboard':

                // Load avatars
                SHOWCASE.admin.commentNameAvatar();
                // Google 3D Chart Initializer
                google.charts.load("current", {packages:["corechart"]});
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

            case 'settings':
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



