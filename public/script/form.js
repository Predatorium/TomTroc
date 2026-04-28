const form = document.getElementById("sendForm")
const error = document.getElementById("errorMsg")
let tagEmail = document.getElementById("email")
let tagPassword = document.getElementById("password")
let tagPseudo = document.getElementById("pseudo")

if (form != null) {
    form.addEventListener("submit", (event) => {
        event.preventDefault();

        let emailValid = validEmail(tagEmail);
        errorClass(tagEmail, emailValid);

        let passwordValid = emptyTag(tagPassword);
        errorClass(tagPassword, passwordValid);

        let pseudoValid = true;
        if (tagPseudo != null) {
            pseudoValid = emptyTagOrTooMuchLenght(tagPseudo, 15);
            errorClass(tagPseudo, pseudoValid);
        }

        if (emailValid && passwordValid && pseudoValid) {
            if (error == null) {
                form.submit();
            }
            else {
                ValidConnect();
            }
        }
    })
}

function ValidConnect() {
    fetch(`index.php?action=getValidConnect&email=${tagEmail.value}&password=${tagPassword.value}`)
        .then(res => res.json())
        .then(data => {
            valid = data.error;
            console.log(valid);
            if (valid) {
                form.submit();
            } else {
                error.classList.add("visible");
            }
        });
}

if (tagEmail != null) {
    tagEmail.addEventListener("change", () => {
        errorClass(tagEmail, validEmail(tagEmail));
    })
}
if (tagPassword != null) {
    tagPassword.addEventListener("change", () => {
        errorClass(tagPassword, emptyTag(tagPassword));
    })
}
if (tagPseudo != null) {
    tagPseudo.addEventListener("change", () => {
        errorClass(tagPseudo, emptyTagOrTooMuchLenght(tagPseudo, 15));
    })
}

function validEmail(tag) {
    let emailRegExp = new RegExp("[a-zA-Z0-9._-]+@[a-z0-9._-]+\\.[a-z0-9._-]+");
    return emailRegExp.test(tag.value);
}

function emptyTag(tag) {
    return tag.value.trim() !== "";
}

function emptyTagOrTooMuchLenght(tag, length) {
    return tag.value.trim() !== "" && tag.value.length < length;
}

function errorClass(tag, isValid) {
    if (isValid) {
        tag.classList.remove("error");
    } else {
        tag.classList.add("error");
    }
}