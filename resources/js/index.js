//This waits for the HTML document to load, without waiting for images and stylesheets
document.addEventListener('DOMContentLoaded', function () {
    console.log('Index JS loaded!');
    // Add your custom JavaScript code here
});


// Using window.onload
window.onload = function () {
    // This code runs after the entire page, including all resources, has finished loading
    console.log('Page fully loaded');
};