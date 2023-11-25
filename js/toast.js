// Get a reference to the copy button and toast message
const copyBtn = document.getElementById('copyBtn');
const toast = document.getElementById('toast');

// Add an event listener to the copy button
copyBtn.addEventListener('click', () => {
  // Add the show class to the toast message
  toast.classList.add('show');
  // Hide the toast message after a certain time interval
  setTimeout(() => {
    // Remove the show class from the toast message
    toast.classList.remove('show');
  }, 3000);
});