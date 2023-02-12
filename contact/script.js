const submitBtn = document.getElementById("submit-btn");
const resetBtn = document.getElementById("reset-form")
let salutation = document.getElementById("salutation");
let firstName = document.getElementById("first-name");
let lastName = document.getElementById("last-name");
let email = document.getElementById("email");
let phone = document.getElementById("phone");
let subject = document.getElementById("subject");
let comments = document.getElementById("comments");
let consent = document.getElementById("consent");

if(submitBtn) {

    submitBtn.addEventListener("submit", function(event) {
        // event.preventDefault();
       
    });
}

if(resetBtn) {
    document.getElementById("reset-form").addEventListener("click", function(event) {
        event.preventDefault();
        salutation.value = "";
        firstName.value = "";
        lastName.value = "";
        email.value = "";
        phone.value = "";
        subject.value = "";
        comments.value = "";
        consent.checked = false;
        
        
    });

}