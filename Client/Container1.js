var images = [
    { baseImage: "images/interior2.jpg", overlayImage: "images/CoverHd.png" },
    { baseImage: "images/livingroom.jpg", overlayText: "Vintex interior solutions", buttonText: "Register Now" },
    { baseImage: "images/cover_image.png", overlayText: "Providing modern solutions for modern lifestyle", buttonText: "Our Services" },
  ];

  var currentIndex = 0;

  function switchImage() {
    var imageItems = document.querySelectorAll('.image-item');
    
    // Remove active class from all items
    imageItems.forEach(function(item) {
      item.querySelector('.overlay').classList.remove('active');
      item.classList.remove('active');
    });

    currentIndex = (currentIndex + 1) % images.length;

    var currentItem = imageItems[currentIndex];
    var overlay = currentItem.querySelector('.overlay');
    var baseImage = currentItem.querySelector('img');

    if (images[currentIndex].overlayImage) {
      overlay.innerHTML = '<img src="' + images[currentIndex].overlayImage + '" alt="Overlay Image">';
    } else {
      overlay.innerHTML = '<div class="overlay-text">' + images[currentIndex].overlayText + '</div>' +
                          '<a href="#" class="overlay-button">' + images[currentIndex].buttonText + '</a>';
      animateTyping(overlay.querySelector('.overlay-text'));
    }

    overlay.classList.add('active');
    currentItem.classList.add('active');

    setTimeout(switchImage, 5000);
  }

  function animateTyping(element) {
    element.style.animation = 'scale-in 2s steps(20, end)';
  }

  switchImage();