$(function ()
    {
        //Trigger Active Class For Navbar
        $('.nav li').click(function ()
            {
                $(this).addClass('active').siblings().removeClass('active');
            }
        );
        //Trigger Active Class For Btm-Menu
        $('.contacts li').click(function ()
            {
                $(this).addClass('active-btm').siblings().removeClass('active-btm');
            }
        );
        //Show Forms
        $('.sign button.btn-danger').click(function ()
            {
                $('.forms').slideDown();
            }
        );
        //hidden forms
        $('.exit').click(function ()
            {
                $('.forms').slideUp();
            }
        );

        //Trigger show buton in news page
        $('.load button').click(
            function ()
            {
                $('.to-show').show();
                $(this).hide();
            }
        );

        $(document).on('click', '.survey a', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            window.open(url, '','width=1000');
        });

        //Partner Slider
        $('.part-slider').slick(
            {
                slidesToShow: 5,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows:false,
                responsive: [
                    {
                        breakpoint: 1000,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 650,
                        settings: {
                            slidesToShow: 3
                        }
                    }

                ]
            }
        );

    }
);
function count_val(bot)
{
    var amount = $('#amount').val();
    if(amount=='')
    {
        amount=0;
    }
    if(bot==1)
    {
        amount++;
    }
    if(bot==-1)
    {
        amount--;
    }

    if(amount<=0)
    {
        amount=1;
    }
    $('#amount').val(amount);
    return;
}
function count_val2(bot)
{
    var amount2 = $('#amount2').val();
    if(amount2=='')
    {
        amount2=0;
    }
    if(bot==1)
    {
        amount2++;
    }
    if(bot==-1)
    {
        amount2--;
    }

    if(amount2<=0)
    {
        amount2=1;
    }
    $('#amount2').val(amount2);
    return;
}