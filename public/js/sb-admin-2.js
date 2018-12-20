$(function() {
    $('#side-menu').metisMenu();
    $('#sendMessageButton').on('click', function(e){
        e.preventDefault();
        $("#formCreateNovedad").trigger('submit');
        /*$.get("http://servicios.arrobamedellin.edu.co/webserviceapp/firebase/send_push.php").done(function(r){
            $("#formCreateNovedad").trigger('submit');
        });*/

        
    });
    $('.fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {

            var content = document.getElementById($(this).attr('data-type'));

            console.log(data.result)
            var img = document.createElement('img');
            img.setAttribute('src', 'http://200.13.254.146/webserviceapp/img_novedades/'+ data.result);
            img.setAttribute("width", "400");
            $("#"+ $(this).attr('data-input')).val(data.result);
            content.innerHTML = '';
            content.appendChild(img);
            content.classList.remove('none');
            content.classList.add('block');
        }
    });
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
  $('#bodyField').summernote();
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});
