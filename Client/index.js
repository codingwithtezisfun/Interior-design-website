document.getElementById('theme-toggle').addEventListener('click', function() {
    var body = document.body;
    var navbar = document.querySelector('.navbar');

    if (body.classList.contains('light-mode')) {
      body.classList.remove('light-mode');
      body.classList.add('dark-mode');
      navbar.classList.remove('navbar-light-mode');
      navbar.classList.add('navbar-dark-mode');
      this.textContent = 'Light Mode';
    } else {
      body.classList.remove('dark-mode');
      body.classList.add('light-mode');
      navbar.classList.remove('navbar-dark-mode');
      navbar.classList.add('navbar-light-mode');
      this.textContent = 'Dark Mode';
    }
  });
