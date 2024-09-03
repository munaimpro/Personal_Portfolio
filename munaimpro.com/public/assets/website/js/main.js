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
const themeButton = document.querySelector('.body_theme');

// Function to toggle theme
const toggleTheme = () => {
    document.body.classList.toggle('dark-theme');
    themeButton.classList.toggle('sun');

    localStorage.setItem('saved-theme', getCurrentTheme());
    localStorage.setItem('saved-icon', getCurrentIcon());
};

// Function to get current theme
const getCurrentTheme = () => document.body.classList.contains('dark-theme') ? 'dark' : 'light';

// Function to get current icon
const getCurrentIcon = () => themeButton.classList.contains('sun') ? 'sun' : 'moon';

// Event listener for theme button click
themeButton.addEventListener('click', () => {
    toggleTheme();
});

// Check saved theme and icon from local storage
let savedTheme = localStorage.getItem('saved-theme');
let savedIcon = localStorage.getItem('saved-icon');

// Apply saved theme and icon
if (savedTheme) {
    document.body.classList[savedTheme === 'dark' ? 'add' : 'remove']('dark-theme');
    themeButton.classList[savedIcon === 'sun' ? 'add' : 'remove']('sun');
}

// Function to automatically toggle theme every 24 hours
const autoToggleTheme = () => {
    toggleTheme();
};

// Set interval to run autoToggleTheme every 24 hours (24 * 60 * 60 * 1000 milliseconds)
setInterval(autoToggleTheme, 24 * 60 * 60 * 1000);


// Highlight JS initialization
hljs.highlightAll();


// Owl Carousal configuration
$('.owl-carousel').owlCarousel({
    loop:true,
    smartSpeed:1200,
    autoplay:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


// Pre Loader functionality
// function hideLoader(){
//     $('.loader_bg').addClass('d-none');
// }

// function showLoader(){
//     $('.loader_bg').removeClass('d-none');
// }

// setTimeout(function(){
//     $('.loader_bg').fadeToggle();
//   }, 2000);