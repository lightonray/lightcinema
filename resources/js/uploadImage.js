document.getElementById('image').addEventListener('change', function() {
    var fileInput = this;
    var fileNameContainer = document.querySelector('.file-name-container');
    var fileNameDisplay = document.querySelector('.file-name-display');
    
    var uploadedImage = document.querySelector('.uploaded-image');
    if (uploadedImage) {
        uploadedImage.remove();
    }

    if (fileInput.files.length > 0) {
        fileNameDisplay.textContent = fileInput.files[0].name;
        fileNameContainer.style.display = 'flex'; // Show the container

        // Create an <img> element for displaying the uploaded image
        var imgElement = document.createElement('img');
        imgElement.src = URL.createObjectURL(fileInput.files[0]);
        imgElement.classList.add('uploaded-image');

        // Append the <img> element to the file-name-container
        fileNameContainer.appendChild(imgElement);
    } else {
        fileNameDisplay.textContent = 'No file chosen';
        fileNameContainer.style.display = 'none'; // Hide the container

        // Remove the uploaded image if present
        var uploadedImage = document.querySelector('.uploaded-image');
        if (uploadedImage) {
            uploadedImage.remove();
        }
    }
});