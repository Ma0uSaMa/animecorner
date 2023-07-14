<script>
  // Function to update the hidden input field with the combined DOB value
  function updateDOB() {
    const day = document.querySelector('select[name="day"]').value;
    const month = document.querySelector('select[name="month"]').value;
    const year = document.querySelector('select[name="year"]').value;
    const dob = year + '-' + month + '-' + day;
    document.getElementById('dobInput').value = dob;
  }

  // Add an event listener to the form submit event
  const form = document.querySelector('form');
  form.addEventListener('submit', updateDOB);
</script>
