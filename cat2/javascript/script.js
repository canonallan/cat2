window.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  const usernameInput = document.getElementById('username');
  const passwordInput = document.getElementById('password');
  const ageInput = document.getElementById('age');
  const selectInput = document.getElementById('select');

  form.addEventListener('submit', (e) => {
    // Reset errors
    const errors = document.querySelectorAll('p[id$="-error"]');
    errors.forEach((error) => (error.textContent = ''));

    // Get form values
    const username = usernameInput.value;
    const password = passwordInput.value;
    const yearOfBirth = ageInput.value;
    const selectedOption = selectInput.value;

    // Validate fields
    if (username === '' || password === '' || yearOfBirth === '' || selectedOption === 'choose') {
      alert('Please fill out all fields');
      e.preventDefault(); // Prevent form submission when there are errors
      return;
    }

    // Validate username
    if (!/^[A-Za-z]+$/.test(username)) {
      document.getElementById('username-error').textContent = 'Only alphabets allowed';
      e.preventDefault(); // Prevent form submission when there are errors
      return;
    }

    // Validate year of birth
    const currentYear = new Date().getFullYear();
    const age = currentYear - yearOfBirth;
    if (isNaN(yearOfBirth)) {
      document.getElementById('age-error').textContent = 'Only numerical digits allowed';
      e.preventDefault(); // Prevent form submission when there are errors
      return;
    } else if (age < 18) {
      document.getElementById('age-error').textContent = 'Must be above 18';
      e.preventDefault(); // Prevent form submission when there are errors
      return;
    }

    // Validate password
    if (!/^(?=.*\d)(?=.*[A-Z])[0-9A-Za-z]+$/.test(password)) {
      document.getElementById('password-error').textContent =
        'Only numbers and uppercase letters allowed';
      e.preventDefault(); // Prevent form submission when there are errors
      return;
    }

    // If there are no errors, allow form submission
    alert('Registration successful');

    // Uncomment the following line to allow form submission
    // e.preventDefault(); // Prevent form submission for now

    // Redirect to login.php after showing the alert
    window.location.href = 'login.php';
  });
});
