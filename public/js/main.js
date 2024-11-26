$(window).on('load',function(){
    $('.first-load').delay(500).fadeOut('500');
});


$(window).on('scroll', function(event) {    
    var scroll = $(window).scrollTop();
    if (scroll < 300) {
        $(".select-bar").removeClass("sticky");
    } else{
        $(".select-bar").addClass("sticky");
    }
});



$(function(){
    $('#signUp').on('click',function(){
        $('#modal-form').addClass('right-panel-active');
    });
    $('#signIn').on('click',function(){
        $('#modal-form').removeClass('right-panel-active');
    });
})



$('.drop-samsung').hover(function(){
    $('.samsung').toggleClass('brand-active');
});
$('.drop-lg').hover(function(){
    $('.lg').toggleClass('brand-active');
});
$('.drop-yasuda').hover(function(){
    $('.yasuda').toggleClass('brand-active');
});
$('.drop-cg').hover(function(){
    $('.cg').toggleClass('brand-active');
});
$('.drop-canon').hover(function(){
    $('.canon').toggleClass('brand-active');
});



$('.slider_inner').camera({
    loader: false,
    navigation: true,
    autoPlay:true,
    time: 4000,
    playPause: false,
    pagination: false,
    thumbnails: false,
    overlayer: true,
    opacityOnGrid: true, 
    hover: true,  
    // fx:'mosaic',
    
    // onLoaded:function() {
    //     new WOW().init();
        
    //   }, 
}); 


$('.flash-sale .owl-carousel').owlCarousel({
    loop:false,
    margin:20,
    nav:true,
    dots:false,
    autoplay: false,
    autoplaySpeed: 3000,
    autoplayHoverPause:true,
    mouseDrag:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
});



$(function(){
    // $('#return-to-top').hide();
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 300) {        // If page is scrolled more than 50px
            $('#return-to-top').addClass('top-arrow');    // Fade in the arrow
        } else {
            $('#return-to-top').removeClass('top-arrow');   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 1000);
    });
})

$(function(){
    // $("#more-less").hide();
    $(".catagory-content .view-cata").click(function() {
        var kkk = $(this).text();
        if (kkk == "View More" ) {
            $(".catagory-content .view-cata").text("View Less");
        }else {
            $(".catagory-content .view-cata").text("View More");
        }
        // $("#more-less").slideToggle(500);
    });

    $(".catagory-content .view-brand").click(function() {
        var kkk = $(this).text();
        if (kkk == "View More" ) {
            $(".catagory-content .view-brand").text("View Less");
        }else {
            $(".catagory-content .view-brand").text("View More");
        }

    });
});

$('.a-one .left-one').ripples({
    dropRadius: 30,
    perturbance:0.02,
});

$('.a-one .right-one').ripples({
    dropRadius: 30,
    perturbance:0.02,
});


$("#slider-range").slider({
  
    range:true,

    orientation:"horizontal",

    min: 0,

    max: 90000,

    values: [0, 90000],

    step: 100,

    

    slide:function (event, ui) {

    if (ui.values[0] == ui.values[1]) {

        return false;

    }

        

    $("#min_price").val(ui.values[0]);

    $("#max_price").val(ui.values[1]);

    }
    
});
    
$('#print').click(function(){
    window.print();
})

// $(function(){
//     $('.success.button').on('click', function(){
//         $('.confirmation-mail .success').slideDown();
//         $('.confirmation-mail .danger').hide();
//     });
//     $('.danger.button').on('click', function(){
//         $('.confirmation-mail .danger').slideDown();
//         $('.confirmation-mail .success').hide();        
//     })
// })