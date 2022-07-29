require('./foundation');

gsap.registerPlugin(ScrollTrigger);

gsap.to(".hero", {
	scrollTrigger: {
		start: "center bottom",
		end: "center top"
	}
});

gsap.to(".hero-text", {
	x: 50,
	duration: 2,
	scrollTrigger: ".hero"
});

gsap.to(".nav", {
	duration: 1,
	backgroundColor: "rgba(35,35,35)",
	scrollTrigger: {
		toggleActions: "restart"
	}
});

gsap.to(".dropdown .menu", {
	duration: 1,
	backgroundColor: "rgba(35,35,35)",
	scrollTrigger: {
		trigger: ".hero",
		start: "bottom center",
		toggleActions: "restart"
	}
});

gsap.to(".lake-info .photo-outline img", {
	opacity: 1,
	duration: 4,
	scrollTrigger: {
		trigger: ".lake-info",
	}
});

gsap.to(".fish-info .photo-outline img", {
	opacity: 1,
	duration: 4,
	scrollTrigger: {
		trigger: ".fish-info",
	}
});

gsap.to(".facility .photo-outline img", {
	opacity: 1,
	duration: 4,
	scrollTrigger: {
		trigger: ".facilities",
		start: "top center",
		toggleActions: "restart"
	}
});

gsap.to(".pricing-block", {
	opacity:1,
	duration: 3,
	scrollTrigger: {
		trigger: ".pricing",
		start: "top center",
		toggleActions: "restart"
	}

});

gsap.to(".date-container", {
	y: 16,
	duration: 0.75,
	scrollTrigger: {
		trigger: ".availabillity",
		start: "top center",
		toggleActions: "restart"
	} 
});

gsap.to(".date-container .button", {
	opacity: 1,
	duration: 2,
	delay: 1,
	scrollTrigger: {
		trigger: ".date-container",
		toggleActions: "restart"
	}
});

gsap.to("#lake-desc", {
	x: 15,
	duration: 1,
	scrollTrigger: {
		trigger: ".lake-info",
		start: "top center"
	}
});

gsap.to("#lake-image", {
	x: -15,
	duration: 1,
	scrollTrigger: {
		trigger: ".lake-info",
		start: "top center"
	}
});

gsap.to("#fish-desc", {
	x: -15,
	duration: 1,
	scrollTrigger: {
		trigger: ".fish-info",
		start: "top center"
	}
});

gsap.to("#fish-image", {
	x: 15,
	duration: 1,
	scrollTrigger: {
		trigger: ".fish-info",
		start: "top center"
	}
});

gsap.to(".content h1", {
	y: 20,
	duration: 2
});

gsap.utils.toArray(".slideText").forEach(text => {
  gsap.timeline({
    defaults: {ease: "none"},
    scrollTrigger: {
      scroller: text.closest(".horizSlider"),
      horizontal: true,
      trigger: text.closest(".slide"),
      start: "left right",
      end: "left left",
      scrub: true
    }
  })
  .fromTo(text, {x: 250}, {x: -250}, 0)
  .from(text.nextElementSibling, {scale: 0.8}, 0)
});

gsap.to(".contact-info", {
	x: -20,
	duration: 2,
	scrollTrigger: {
		trigger: ".contact",
		start: "top center"
	}
});

gsap.to(".photo-border-block", {
	y: 16,
	opacity: 1,
	duration: 0.75,
	scrollTrigger: {
		trigger: ".fish-gallery",
		start: "top center"
	} 
});

gsap.to(".intro", {
	scrollTrigger: {
		trigger: ".intro",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 6
});

gsap.to(".lake-info", {
	scrollTrigger: {
		trigger: ".lake-info",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 3
});

gsap.to(".fish-info", {
	scrollTrigger: {
		trigger: ".fish-info",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 3
});

gsap.to(".facilities", {
	scrollTrigger: {
		trigger: ".facilities",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 3
});

gsap.to(".pricing", {
	scrollTrigger: {
		trigger: ".pricing",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 3
});

gsap.to(".lake-info-container", {
	scrollTrigger: {
		trigger: ".lake-info-container",
		start: "top center",
		end: "bottom center",
		scrub: true,
		toggleActions: "restart pause reverse pause"
	},
	y: 100,
	duration: 3
});

