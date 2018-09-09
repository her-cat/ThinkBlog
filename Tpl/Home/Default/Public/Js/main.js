if( !window.console ){

    window.console = {

        log: function(){}

    }

}





/* 

 * jsui

 * ====================================================

*/

jsui.bd = $('body');

jsui.is_signin = jsui.bd.hasClass('logged-in') ? true : false;

jsui.roll = [3, 4, 5]





/* 

 * lazyload

 * ====================================================

*/

if ($('.avatar:eq(2)').data('src') || $('.thumb:first').data('src') || $('.widget_ui_posts .thumb:first').data('src') || $('.wp-smiley:first').data('src')) {

    require(['lazyload'], function() {

        $('.avatar').lazyload({

            data_attribute: 'src',

            placeholder: jsui.uri + 'img/avatar-default.png',

            threshold: 400

        })



        $('.thumb').lazyload({

            data_attribute: 'src',

            placeholder: jsui.uri + 'img/thumbnail.png',

            threshold: 400

        })



        $('.widget_ui_posts .thumb').lazyload({

            data_attribute: 'src',

            placeholder: jsui.uri + 'img/thumbnail.png',

            threshold: 400

        })



        $('.wp-smiley').lazyload({

            data_attribute: 'src',

            // placeholder: jsui.uri + 'img/thumbnail.png',

            threshold: 400

        })

    })

}







/* 

 * prettyprint

 * ====================================================

*/

$('pre').each(function(){

    if( !$(this).attr('style') ) $(this).addClass('prettyprint')

})



if( $('.prettyprint').length ){

    require(['prettyprint'], function(prettyprint) {

        prettyPrint()

    })

}







/* 

 * rollbar

 * ====================================================

*/

jsui.rb_comment = ''

if (jsui.bd.hasClass('comment-open')) {

    jsui.rb_comment = "<li><a href=\"javascript:(scrollTo('#comment-post',-80));\"><i class=\"fa icon-large icon-comments\"></i></a><h6>去评论<i></i></h6></li>"

}



jsui.bd.append('<div class="m-mask"></div><div class="rollbar"><ul>'+jsui.rb_comment+'<li><a href="javascript:(scrollTo());"><i class="fa icon-large icon-angle-up"></i></a><h6>去顶部<i></i></h6></li></ul></div>')



var scroller = $('.rollbar')

$(window).scroll(function() {

    document.documentElement.scrollTop + document.body.scrollTop > 200 ? scroller.fadeIn() : scroller.fadeOut();

})





/* 

 * bootstrap

 * ====================================================

*/

require(['bootstrap'], function(bootstrap) {

    $('.user-welcome').tooltip({

        container: 'body',

        placement: 'bottom'

    })

})





/* 

 * sign

 * ====================================================

*/

if (!jsui.bd.hasClass('logged-in')) {

    require(['signpop'], function(signpop) {

    })

}





/* 

 * single

 * ====================================================

*/

if (jsui.bd.hasClass('single')) {

    require(['bootstrap'], function(bootstrap) {

        var _sidebar = $('.sidebar')

        if (_sidebar) {

            var h1 = 80,

                h2 = 95

            var rollFirst = _sidebar.find('.widget:eq(' + (jsui.roll[0] - 1) + ')')

            var sheight = rollFirst.height()



            rollFirst.on('affix-top.bs.affix', function() {

                rollFirst.css({

                    top: 0

                })

                sheight = rollFirst.height()



                for (var i = 1; i < jsui.roll.length; i++) {

                    var item = jsui.roll[i] - 1

                    var current = _sidebar.find('.widget:eq(' + item + ')')

                    current.removeClass('affix').css({

                        top: 0

                    })

                };

            })



            rollFirst.on('affix.bs.affix', function() {

                rollFirst.css({

                    top: h1

                })



                for (var i = 1; i < jsui.roll.length; i++) {

                    var item = jsui.roll[i] - 1

                    var current = _sidebar.find('.widget:eq(' + item + ')')

                    current.addClass('affix').css({

                        top: sheight + h2

                    })

                    sheight += current.height() + 20

                };

            })



            rollFirst.affix({

                offset: {

                    top: _sidebar.height(),

                    bottom: $('.footer').outerHeight()

                }

            })





        }

    })

}





/* 

 * comment

 * ====================================================

*/

if (jsui.bd.hasClass('comment-open')) {

    require(['comment'], function(comment) {

        comment.init()

    })

}





/* 

 * page u

 * ====================================================

*/

if (jsui.bd.hasClass('page-template-pagesuser-php')) {

    require(['user'], function(user) {

        user.init()

    })

}





/* 

 * page theme

 * ====================================================

*/

if (jsui.bd.hasClass('page-template-pagestheme-php')) {

    require(['theme'], function(theme) {

        theme.init()

    })

}





/* 

 * page nav

 * ====================================================

*/

if( jsui.bd.hasClass('page-template-pagesnav-php') ){



    $('#navs .items a').attr('target', '_blank')



    require(['bootstrap'], function(bootstrap) {

        $('#navs nav ul').affix({

            offset: {

                top: $('#navs nav ul').offset().top,

                bottom: $('.footer').height() + $('.footer').css('padding-top').split('px')[0]*2

            }

        })

    })



    if( location.hash ){

        var index = location.hash.split('#')[1]

        $('#navs nav .item-'+index).addClass('active')

        scrollTo( '#navs .items .item-'+index )

    }

    $('#navs nav a').each(function(e){

        $(this).click(function(){

            scrollTo( '#navs .items .item-'+$(this).parent().index() )

            $(this).parent().addClass('active').siblings().removeClass('active')

        })

    })

}





/* 

 * page search

 * ====================================================

*/

if( jsui.bd.hasClass('search-results') ){

    var val = $('.searchform .search-input').val()

    var reg = eval('/'+val+'/i')

    $('.excerpt h2 a, .excerpt .note').each(function(){

        $(this).html( $(this).text().replace(reg, function(w){ return '<b>'+w+'</b>' }) )

    })

}





/* 

 * phone

 * ====================================================

*/

$('.m-icon-nav').on('click', function(){

    jsui.bd.addClass('nav-slide-show');

    $('.m-mask').show();

})



$('.m-mask').on('click', function(){

    jsui.bd.removeClass('nav-slide-show');

    $(this).hide();

})





/*var _side = $('.sidebar')

if (_side.length) {

    require(['bootstrap'], function() {

        var _widget = _side.find('.widget:eq(2)')

        _widget.affix({

            offset: {

                top: _side.offset().top + _side.height(),

                bottom: $('.footer').height() + 50

            }

        })



        _widget.on('affix-top.bs.affix', function() {

            _widget.css({

                top: 0

            })

        })



        _widget.on('affix.bs.affix', function() {

            _widget.css({

                top: $('.header').height() + 15

            })

        })



    })

}*/









/* 

 * loading

 * ====================================================

*/



jQuery("#loading div").animate({width:"100%"},800,function(){

setTimeout(function(){jQuery("#loading div").fadeOut(500);

});

});

jQuery("#loading div").animate({width:"33%"});





/* click event

 * ====================================================

*/

/*$(document).on('click', function(e){

    e = e || window.event;

    var target = e.target || e.srcElement

    var etag = $(target)



    if( etag.parent().attr('evt') ){

        etag = $(etag.parent()[0])

    }else if( etag.parent().parent().attr('evt') ){

        etag = $(etag.parent().parent()[0])

    }



    var type = etag.attr('evt')



    if( !type || etag.hasClass('disabled') ) return 



    switch( type ){

        case 'nav.slide.hide':

            jsui.bd.removeClass('nav-slide-show').removeAttr('evt')

        break;

    }

})*/





/* functions

 * ====================================================

 */

function scrollTo(name, add, speed) {

    if (!speed) speed = 300

    if (!name) {

        $('html,body').animate({

            scrollTop: 0

        }, speed)

    } else {

        if ($(name).length > 0) {

            $('html,body').animate({

                scrollTop: $(name).offset().top + (add || 0)

            }, speed)

        }

    }

}





function is_name(str) {

    return /.{3,20}$/.test(str)

}

function is_url(str) {

    return /^((http|https)\:\/\/)([a-z0-9-]{1,}.)?[a-z0-9-]{2,}.([a-z0-9-]{1,}.)?[a-z0-9]{2,}$/.test(str)

}

function is_qq(str) {

    return /^[1-9]\d{4,13}$/.test(str)

}

function is_mail(str) {

    return /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/.test(str)

}





$.fn.serializeObject = function(){

    var o = {};

    var a = this.serializeArray();

    $.each(a, function() {

        if (o[this.name] !== undefined) {

            if (!o[this.name].push) {

                o[this.name] = [o[this.name]];

            }

            o[this.name].push(this.value || '');

        } else {

            o[this.name] = this.value || '';

        }

    });

    return o;

};





function strToDate(str, fmt) { //author: meizz   

    if( !fmt ) fmt = 'yyyy-MM-dd hh:mm:ss'

    str = new Date(str*1000)

    var o = {

        "M+": str.getMonth() + 1, //月份   

        "d+": str.getDate(), //日   

        "h+": str.getHours(), //小时   

        "m+": str.getMinutes(), //分   

        "s+": str.getSeconds(), //秒   

        "q+": Math.floor((str.getMonth() + 3) / 3), //季度   

        "S": str.getMilliseconds() //毫秒   

    };

    if (/(y+)/.test(fmt))

        fmt = fmt.replace(RegExp.$1, (str.getFullYear() + "").substr(4 - RegExp.$1.length));

    for (var k in o)

        if (new RegExp("(" + k + ")").test(fmt))

            fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));

    return fmt;

}



