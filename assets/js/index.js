(function() {
    const $ = jQuery.noConflict();
    const wrapper = $('.image-carousel');

    wrapper.slick({
        centerMode: true,
        infinite: false,
        centerPadding: '25%',
        responsive: [
            {
                breakpoint: 1500,
                settings: {
                    centerPadding: '17%',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    centerPadding: '0',
                }
            }
        ]
    });
})();