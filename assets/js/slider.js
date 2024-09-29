jQuery(document).ready(function ($) {
  var totalSlides = $(".property-slide").length;
  var currentIndex = 0;

  function goToSlide(index) {
    // Ensure the index is within bounds
    if (index >= totalSlides) {
      index = 0; // Loop back to the first slide
    } else if (index < 0) {
      index = totalSlides - 1; // Loop to the last slide
    }
    // Move the slider
    $(".property-slide").css("transform", "translateX(" + -index * 100 + "%)");
    currentIndex = index;
  }

  $("#next").on("click", function () {
    goToSlide(currentIndex + 1);
  });

  $("#prev").on("click", function () {
    goToSlide(currentIndex - 1);
  });

  // Optional: Auto-slide
  setInterval(function () {
    goToSlide(currentIndex + 1);
  }, 1000); // Adjust the time for auto-sliding
});
