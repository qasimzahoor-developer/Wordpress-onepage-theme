//Section Scroll
function scrollToForm(id) {
    setTimeout(function() {
        document.getElementById(id).scrollIntoView({behavior: 'smooth'});
    }, 350);
}



//Play Hero Video
document.getElementById('PlayHeroVideo').onclick = function () {
    document.getElementById('HeroVideo').play();
    document.getElementById('PlayHeroVideo').style.display = "none";
    document.getElementById('PauseHeroVideo').classList.add("pause-video")
};
//Pause Hero Video
document.getElementById('PauseHeroVideo').onclick = function () {
    document.getElementById('HeroVideo').pause();
    document.getElementById('PlayHeroVideo').style.display = "block";
    document.getElementById('PauseHeroVideo').classList.remove("pause-video");
};

//Scroll to top
const btnScrollToTop = document.querySelector(".btnScrollToTop");
btnScrollToTop.addEventListener("click", e => {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: "smooth"
  });
});
window.addEventListener('scroll', e => {
  btnScrollToTop.style.display = window.scrollY > 20 ? 'block' : 'none';
});

//On Scroll Animation
window.addEventListener("scroll", function () {
    var BounceAnimates = document.querySelectorAll(".bounce-animate");
    BounceAnimates.forEach(function(BounceAnimate){
        var position = BounceAnimate.getBoundingClientRect();
        if (position.top < window.innerHeight && 
        position.bottom >= 0) {
            BounceAnimate.classList.add("bounce");
        } else {
            BounceAnimate.classList.remove("bounce");
        }
    });
    
});


