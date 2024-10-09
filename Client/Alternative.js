var images = [
    { baseImage: "images/interior2.jpg", overlayImage: "images/CoverHd.png", overlayText: "<h1>Overlay Heading 1</h1>", baseOpacity: 0.8, textOpacity: 1 },
    { baseImage: "images/cover_image.png", overlayText: "<h2>Overlay Heading 2</h2>", baseOpacity: 0.7, textOpacity: 0.9 },
    { baseImage: "images/Interior.jfif", overlayText: "<p>Overlay text for image 3</p>", baseOpacity: 0.6, textOpacity: 0.8 },
    { baseImage: "images/interior2.jpg", overlayText: "<h3>Overlay Heading 3</h3>", baseOpacity: 0.5, textOpacity: 0.7 }
];

var currentIndex = 0;
var interval;
var clearTextTimeout;

function switchImage() {
    // Get all image items
    var imageItems = document.querySelectorAll('.image-item');

    // Remove 'active' class from all image items
    imageItems.forEach(function(item) {
        item.querySelector('.base-image').classList.remove('active');
        item.querySelector('.overlay').classList.remove('active');
    });

    // Increment index and loop back to start if necessary
    currentIndex = (currentIndex + 1) % images.length;

    // Add 'active' class to the selected image item
    var currentItem = imageItems[currentIndex];
    var baseImage = currentItem.querySelector('.base-image');
    var overlayText = currentItem.querySelector('.overlay');

    baseImage.classList.add('active');
    overlayText.classList.add('active');
    overlayText.querySelector('span').innerHTML = images[currentIndex].overlayText || '';

    // Set base image and overlay text opacity
    baseImage.style.opacity = images[currentIndex].baseOpacity;
    overlayText.style.opacity = images[currentIndex].textOpacity;

    // Clear previous timeout if it exists
    if (clearTextTimeout) {
        clearTimeout(clearTextTimeout);
    }

    // Set timeout to clear the text after 4 seconds (adjust as needed)
    clearTextTimeout = setTimeout(function() {
        overlayText.classList.remove('active');
    }, 4000); // Text display duration
}

// Initial call to switch image
switchImage();

// Set interval to switch images every 5 seconds
interval = setInterval(switchImage, 5000);
