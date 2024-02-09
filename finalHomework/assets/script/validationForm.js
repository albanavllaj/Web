
document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('registrationForm');
    const resultMessageContainer = document.getElementById('resultMessage');

    form.addEventListener('submit', function(event){

        //Prevent the default form submission
        event.preventDefault();

        //Validate form fields
        const  isValid = validateForm();

        //If all fields are valid, submit the form
        if(isValid) {
            resultMessageContainer.innerHTML = 'Form submitted successfully!';

            // Extract form data
            const formData = new FormData(form);

            // Make an asynchronous request to the server (replace 'db_connection.php' with your actual server-side endpoint)
            fetch('db_connection.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Handle the response from the server
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    })
});


function validateForm() {
    const firstName = document.getElementById('firstname').value.trim();
    const lastName = document.getElementById('lastname').value.trim();
    const gender = document.querySelector('input[name="gender"]:checked');
    const birthdate = document.getElementById('birthdate').value;
    const email = document.getElementById('email').value.trim();
    const tel = document.getElementById('tel').value.trim();
    const password = document.getElementById('password').value.trim();
    const color = document.getElementById('color').value.trim();
    const year = document.getElementById('year').value;
    const carCheckboxes = document.querySelectorAll('input[name="car[]"]:checked');
    const comments = document.getElementById('comments').value.trim();

    // Reset error messages
    document.getElementById('firstnamespan').innerHTML = '';
    document.getElementById('lastnamespan').innerHTML = '';
    document.getElementById('genderspan').innerHTML = '';
    document.getElementById('birthdatespan').innerHTML = '';
    document.getElementById('emailspan').innerHTML = '';
    document.getElementById('telspan').innerHTML = '';
    document.getElementById('passspan').innerHTML = '';

    if (!firstName || firstName.length < 3) {
        // Validation for first name
        if (!firstName) {
            document.getElementById('firstnamespan').innerHTML = 'Please enter the name';
        }
        if (firstName.length < 3) {
            document.getElementById('firstnamespan').innerHTML = 'The name must have a minimum of 3 characters';
        }
        return false;
    }

    // Similar validations for other fields...

    // Validation for color
    if (!color) {
        document.getElementById('colorspan').innerHTML = 'Please select a color';
        return false;
    }

    // Validation for year
    if (!year) {
        document.getElementById('yearspan').innerHTML = 'Please select a year';
        return false;
    }

    // Validation for car preferences
    if (carCheckboxes.length === 0) {
        document.getElementById('carspan').innerHTML = 'Please select at least one car preference';
        return false;
    }

    if (!email.endsWith("@epoka.edu.al")) {
        document.getElementById('emailspan').innerHTML = 'This is not a valid Epoka email.';
        return false;
    }

    // Validation for comments
    if (comments.length > 200) {
        document.getElementById('commentsspan').innerHTML = 'Comments should not exceed 200 characters';
        return false;
    }

    return true;
}
