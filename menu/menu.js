$(".menu-icon").click ((event) => {
    $(".navicon").toggleClass("closed").toggleClass('opened');
    $(".menu").toggleClass("visible").toggleClass('invisible');
});
