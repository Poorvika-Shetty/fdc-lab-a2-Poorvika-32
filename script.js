function validateForm() {

    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value;
    var mobile = document.getElementById("mobile").value.trim();

    if (name === "") {
        alert("Name must not be empty");
        return false;
    }

    if (email === "") {
        alert("Email must not be empty");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long");
        return false;
    }

    if (isNaN(mobile) || mobile.length !== 10) {
        alert("Please enter a valid 10-digit mobile number");
        return false;
    }

    alert("Form submitted successfully!");
    return true;
}
