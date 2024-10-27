
window.addEventListener('load', function() {
    const hero_image = document.getElementById("hero_img");
    let img_height = hero_image.height;

    // Check if the image height is correctly fetched
    let unit = img_height;
    console.log(unit);

    const masthead = document.getElementById("masthead");

    // Single scroll event listener to handle both cases
    window.addEventListener('scroll', function() {
        if (window.scrollY > unit) {
            masthead.classList.add("show");
        } else {
            masthead.classList.remove("show");
        }
        console.log(window.scrollY); // Optional: To track scroll position
    });
});
