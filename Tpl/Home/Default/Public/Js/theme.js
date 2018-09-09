define(['bootstrap'], function (){

return {
    init: function (){
        var nav = $('.theme-nav')
        nav.affix({
            offset: {
                top: nav.offset().top,
                bottom: 0
            }
        })

        jsui.bd.scrollspy({ 
            target: '.theme-nav',
            offset: nav.height()+20
        })
    }
}

})
