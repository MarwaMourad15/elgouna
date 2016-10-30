$(function()
    {
        //Trigger Active Class For Bottom Nav in all pages

                $('footer .overlay .info li a').click(function()
                    {
                        $(this).addClass('.active-bottom').siblings().removeClass('.active-bottom');
                    }
                );

        //Trigger Active Class For Bottom Nav in all pages


        //Trigger The NiceScroll for all pages
                $("html").niceScroll
                (
                    {
                        cursorcolor:"#ffc722",
                        cursorborder:'1px solid #ffc722',
                        cursorwidth:'7px',
                        cursorborderradius:0
                    }
                );


        //Trigger The NiceScroll for all pages


        //Trigger The Active Class For Navbar in All Pages
                $('.dropdown').click(function()
                    {
                        $(this).addClass('active').siblings().removeClass('active');
                    }
                );
        //Trigger The Active Class For Navbar in All Pages

        //Trigger Show Btolat Page Content

        $('.go input').click(function()
            {
                $('.inner-menu').slideDown(2500);
            }
        );
        //Trigger Show Btolat Page Content

        //Trigger Show mokarnat PAge Content

        $('.select input').click(function()
            {
                $('.info-visable').hide();
                $('.info-table').slideDown(1500);
            });
        $('.info-table i').click(function()
            {
                $('.info-table').hide();
                $('.info-visable').slideDown(1500);
            });
        //Trigger Show mokarnat PAge Content

        // Triger The Width Of Breadcrumb in many pages
                $('.sub-bread').width($('.bread').width() - $('.slashed').width());
                $(window).resize(function()
                    {
                        $('.sub-bread').width($('.bread').width() - $('.slashed').width());
                    }
                );
        // Triger The Width Of Breadcrumb in many pages

        //Trigger The Color For Active inner Menu and The menu Clickable in many pages
                $('.menu ul li').click(function()
                    {
                        $(this).addClass('color').siblings().removeClass('color');
                        $('.' + $(this).data('value')).slideToggle(1000).siblings('.content').hide();

                    }
                );
        //Trigger Show Playtable And E7sa2iat in Btolat Page
                $('.goto').click(function () {
                    $('.segl').hide();
                    $('.' + $(this).data('value')).slideDown(1000);
                });
                $('.haf-menu ul li').click(function()
                    {
                        $(this).toggleClass('color').siblings().removeClass('color');
                        $('.' + $(this).data('value')).slideToggle(1000).siblings('.menu-content').hide();
                    }
                );

        //Triger The Clickable of playtable

        $('.play-table .row').click(function()
                {
                    $('.' + $(this).data('value')).fadeToggle(1000).siblings('.details').hide();
                }
        );
        
        
    }
 );
