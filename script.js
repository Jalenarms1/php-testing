const timeSlot = document.getElementById("time-slot");

const today = new Date();
const options = { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' };
const dateString = today.toLocaleDateString('en-US', options);
timeSlot.innerText = dateString;
const images = ['/dailygrind/images/Breads.jpg', '/dailygrind/images/coffee2.jpg'];
let index = 0;
const image = document.getElementById('home-img');

if(image) {
    function changeImage() {
        index = (index + 1) % images.length;
        const nextImage = new Image();
        nextImage.src = images[index];
        nextImage.addEventListener('load', function() {
            image.style.opacity = 0;
            setTimeout(function() {
            image.src = nextImage.src;
            image.style.opacity = 1;
            setTimeout(changeImage, 2000);
            }, 1000);
        });
    }
    
    setTimeout(changeImage, 2000);

}