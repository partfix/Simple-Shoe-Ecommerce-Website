// Wait for the page to fully load
document.addEventListener('DOMContentLoaded', function () {

  const deleteForms = document.querySelectorAll('.delete-form');


  deleteForms.forEach(function (form) {
    form.addEventListener('submit', function (event) {
      // Stop the form 
      event.preventDefault();

      // Create
      const formData = new FormData(this);


      const activityId = formData.get('activity_id');


      const userConfirmed = confirm('Are you sure you want to delete this activity?');


      if (userConfirmed) {
        fetch(window.location.href, {
          method: 'POST',
          body: formData
        })
          .then(function (response) {
            // Check if the request was successful
            if (!response.ok) {
              throw new Error('Something went wrong with the request');
            }
            return response.text();
          })
          .then(function () {
            const activityItem = document.getElementById('activity-' + activityId);

            //found the activity item
            if (activityItem) {
              // Make the item fade out
              activityItem.style.opacity = '0';
              activityItem.style.transition = 'opacity 0.3s ease';

              // After the fade completes
              setTimeout(function () {
                activityItem.remove();
              }, 300);
            }
            showMessage('Activity deleted successfully', 'success');
          })
          .catch(function (error) {
            console.error('Error:', error);
            showMessage('Error deleting activity: ' + error.message, 'error');
          });
      }
    });
  });

  // show messages 
  function showMessage(text, type) {
    const messageContainer = document.getElementById('message-container');
    const message = document.getElementById('message');
    message.innerHTML = text;

    //message style
    if (type === 'success') {
      message.className = 'p-2 rounded text-sm bg-green-100 text-green-700';
    } else {
      message.className = 'p-2 rounded text-sm bg-red-100 text-red-700';
    }
    messageContainer.style.display = 'block';

    //3 seconds
    setTimeout(function () {
      messageContainer.style.display = 'none';
    }, 3000);
  }
});