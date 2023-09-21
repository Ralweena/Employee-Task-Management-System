let toggle = document.querySelector('.toggle');
let navigation = document.querySelector('.navigation');
let main = document.querySelector('.main');

// Function to add 'active' class when clicked on toggle
toggle.addEventListener('click', function() {
    navigation.classList.toggle('active');
    main.classList.toggle('active');
});
