document.addEventListener( 'DOMContentLoaded', function () {
	const slides = document.querySelectorAll( '.property-slide' );
	let currentIndex = 0;

	let autoScrollInterval;

	// Initial Setup of Slides
	function setupSlides() {
		slides.forEach( function ( slide, index ) {
			slide.classList.remove( 'activeSlide', 'nextSlide', 'lastSlide' );
			if ( index === currentIndex ) {
				slide.classList.add( 'activeSlide' );
			} else if ( index === ( currentIndex + 1 ) % slides.length ) {
				slide.classList.add( 'nextSlide' );
			} else if ( index === ( currentIndex - 1 + slides.length ) % slides.length ) {
				slide.classList.add( 'lastSlide' );
			}
		});
	}

	// Function to handle moving to next slide
	function goToNextSlide() {
		currentIndex = ( currentIndex + 1 ) % slides.length;
		setupSlides();
	}

	// Function to handle moving to previous slide
	function goToPrevSlide() {
		currentIndex = ( currentIndex - 1 + slides.length ) % slides.length;
		setupSlides();
	}

	setupSlides(); // Initialize slides on load

	// Handle Next Button Click
	document.querySelector( '#next' )?.addEventListener( 'click', function () {
		stopAutoScroll();
		goToNextSlide();
		startAutoScroll();
	});

	// Handle Previous Button Click
	document.querySelector( '#prev' )?.addEventListener( 'click', function () {
		stopAutoScroll();
		goToPrevSlide();
		startAutoScroll();
	});

	// Swipe Detection for Mobile
	const slideContainer = document.querySelector( '.property-slider' );
	let startX = 0;
	let endX = 0;

	slideContainer?.addEventListener( 'touchstart', function ( event ) {
		startX = event.touches[0].clientX; // Get initial touch position (X-axis)
	});

	slideContainer?.addEventListener( 'touchmove', function ( event ) {
		endX = event.touches[0].clientX; // Get position as finger moves (X-axis)
	});

	slideContainer?.addEventListener( 'touchend', function () {
		const deltaX = endX - startX; // Calculate the swipe distance

		if ( Math.abs( deltaX ) > 50 ) {
			// Check if swipe distance is significant
			if ( deltaX < 0 ) {
				goToNextSlide(); // Swipe left (Next slide)
			} else {
				goToPrevSlide(); // Swipe right (Previous slide)
			}
		}
	});

	// Start Auto-scroll when condition is met
	function startAutoScroll() {
		autoScrollInterval = setInterval( goToNextSlide, 2000 ); // Change slide every 2 seconds
	}

	// Arrow Key Navigation
	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'ArrowRight' ) {
			goToNextSlide(); // Move to the next slide when the right arrow is pressed
		} else if ( event.key === 'ArrowLeft' ) {
			goToPrevSlide(); // Move to the previous slide when the left arrow is pressed
		}
	});

	// Stop Auto-scroll when needed
	function stopAutoScroll() {
		clearInterval( autoScrollInterval );
	}

	// start auto scroll
	startAutoScroll();
});

