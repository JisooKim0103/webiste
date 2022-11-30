const navbar = document.querySelector('.navbar')
const hamburger = document.querySelector('.hamburger')
const navLinks = document.querySelector('.nav-links')


window.addEventListener('scroll', () => {
    if(this.scrollY>=100) {
        navbar.classList.add('scrolled')
        }else{
        navbar.classList.remove('scrolled')
        }
})

hamburger.addEventListener('click',() => {
    navLinks.classList.toggle('active')
    hamburger.classList.toggle('active')
})

// typed js

var options = {
    strings: [,'Welcome!','you can Search','tag',' and categorize'],
   typeSpeed: 90,
    loop:true,
    loopCount:Infinity,
    backDelay:700,

  };
  
  var typed = new Typed('#titles', options);