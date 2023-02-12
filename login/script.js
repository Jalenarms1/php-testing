const answerSubmitForm = document.getElementById("answerForm");
const hiddenAnswerQ1 = document.getElementById("answerOne");
const answerOneInput = document.getElementById("q1Answer");
const errText = document.getElementById("err-text");
const resetPassBtn = document.getElementById('reset-submit-btn');

const onSubmit = (e) => {
    e.preventDefault();
    if(hiddenAnswerQ1.value.toLowerCase() !== answerOneInput.value.toLowerCase()) {
        errText.classList.remove("hide")
    } else {
        answerSubmitForm.submit()
    }

}

if(answerSubmitForm) {
    answerSubmitForm.addEventListener("submit", onSubmit)

}

// const onSubmitNewPassword = (e) => {
//     e.preventDefault()
// }
// if(resetPassBtn) {
//     resetPassBtn.addEventListener('click', onSubmitNewPassword)
// }