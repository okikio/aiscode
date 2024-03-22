
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});
$(document).ready(function(e){
    setTimeout(function () {
      $("#preloader").fadeOut("slow")
  },2000);

});

      // When your page loads
      $(function(){
        // When the toggle areas in your navbar are clicked, toggle them
        $("#search-button, #search-icon").click(function(e){
            e.preventDefault();
            $("#search-button, #search-form").toggle();
        });
     })
 


     
/*$(document).ready(function(){
    $(".owl-carousel").owlCarousel();
  });
    $('.').owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      dots:false,
      responsiveClass:true,
      responsive:{
          0:{
              items:2,
              nav:true,
              loop:false
          },
          600:{
              items:3,
              nav:true,
              loop:false
          },
          1000:{
              items:4,
              nav:true,
              loop:false
          },
          1400:{
              items:4,
              nav:true,
              loop:false
          },
          1500:{
              items:4,
              nav:true,
              loop:false
          }
      }
  })

  $('#footer-slider').owlCarousel({
    loop:true,
    margin:60,
    dots:false,
    nav:false,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive:{
        0:{
            items:1,
            nav:false,
            margin:10,
            loop:true,
        },
        600:{
            items:1,
            nav:false,
            margin:10,
        },
        1000:{
            items:2,
            nav:false,
            loop:false,
            margin:20,
        },
        1400:{
            items:2,
            nav:false,
            loop:false
        },
      
    }
})*/


$(document).ready(function() {
    $('#mute').click(function() {
      if ($("#idle_video").prop('muted')) {
        $("#idle_video").prop('muted', false);
        $(this).html('<i class="fas fa-volume-up"></i>');
      } else {
        $("#idle_video").prop('muted', true);
        $(this).html('<i class="fas fa-volume-mute"></i>');
      }
    });
  });

  var video = document.getElementById("idle_video");

  // Hide the controls
  video.controls = false;

  function playVideo() {
    var video = document.getElementById("idle_video");
    video.play();
}














