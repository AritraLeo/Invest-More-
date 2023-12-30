const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar_menu');
const navLogo = document.querySelector('#navnar_logo');
const body = document.querySelector('body');



const mobileMenu = () => {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
    body.classList.toggle('active');
} 

menu.addEventListener('click', mobileMenu);


// Animations:

gsap.registerPlugin(ScrollTrigger)

// Hero Section 
gsap.from('.animate-hero', {
    duration: 0.8,
    opacity: 0,
    y: -150,
    stagger: 0.3

});

// Services Section

gsap.from('.animate-services', {
    scrollTrigger: '.animate-services',
    duration: 0.6,
    opacity: 1,
    x: -150,
    stagger: 0.12

});

gsap.from('.animate-img', {

    scrollTrigger: '.animate-services',
    duration: 1.2,
    opacity: 0,
    x: -200,
    stagger: 0.12


});

// Membership Section

gsap.from('.animate-membership', {
    scrollTrigger: '.animate-membership',
    duration: 1,
    opacity: 0,
    y: -150,
    stagger: 0.3,
    delay: 0.5
});


gsap.from('.animate-card', {
    scrollTrigger: '.animate-card',
    duration: 1,
    opacity: 0,
    y: -150,
    stagger: 0.1,
    delay: 0.2
});


// About Us Section

gsap.from('.animate-about_us', {
    scrollTrigger: '.animate-about_us',
    duration: 0.6,
    opacity: 1,
    x: -150,
    stagger: 0.1

});


gsap.from('.animate-img-about-us', {

    scrollTrigger: '.animate-about_us',
    duration: 1.2,
    opacity: 0,
    x: -200,
    stagger: 0.1


});



// Email Section

gsap.from('.animate-email', {
    scrollTrigger: '.animate-email',
    duration: 0.8,
    opacity: 0,
    y: -150,
    stagger: 0.25,
    delay: 0.4
});