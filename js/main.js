// Header scroll
let nav = document.querySelector('.navbar');
window.onscroll = function(){
    if(document.documentElement.scrollTop > 20){
        nav.classList.add('header-scrolled');
    } else{
        nav.classList.remove('header-scrolled');
    }
}

// Nav hide
let navlink = document.querySelectorAll('.nav-link');
let navCollapse = document.querySelector('.navbar-collapse.collapse');
navlink.forEach(function(e){
    e.addEventListener("click", function(){
        navCollapse.classList.remove('show');
    });
});

// Swiper JS initialization
var swiper = new Swiper(".testimonial_swiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

// Scroll To Top
let scrollTopButton = document.querySelector('.scroll_to_top');
window.addEventListener('scroll', function(){
    scrollTopButton.classList.toggle('scrolling_active', window.scrollY > 500);
});

scrollTopButton.addEventListener('click', () => {
    // Smooth scroll to the top
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Website dark light theme
let themeButton = document.querySelector('.body_theme');
themeButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme');
    themeButton.classList.toggle('sun');

    localStorage.setItem('saved-theme', getCurrentTheme());
    localStorage.setItem('saved-icon', getCurrentIcon());
});

let getCurrentTheme = () => document.body.classList.contains('dark-theme') ? 'dark' : 'light';
let getCurrentIcon = () => document.body.classList.contains('sun') ? 'sun' : 'moon';

let savedTheme = localStorage.getItem('saved-theme');
let savedIcon  = localStorage.getItem('saved-icon');

if(savedTheme){
    document.body.classList[savedTheme === 'dark' ? 'add' : 'remove']('dark-theme');
    themeButton.classList[savedIcon === 'sun' ? 'add' : 'remove']('sun');
}