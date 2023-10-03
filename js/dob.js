// Function to update the hidden input field with the combined DOB value
function updateDOB(event) {
  event.preventDefault(); // Prevent the default form submission behavior
  
  const day = document.querySelector('select[name="day"]').value;
  const month = document.querySelector('select[name="month"]').value;
  const year = document.querySelector('select[name="year"]').value;
  const dob = year + '-' + month + '-' + day;
  
  const dobInput = document.getElementById('dobInput');
  dobInput.value = dob;

  // Now you can submit the form programmatically
  event.target.submit();
}

// Add an event listener to the form submit event
const form = document.querySelector('form');
form.addEventListener('submit', updateDOB);
