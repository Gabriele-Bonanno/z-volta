// Mostra il popup di login e genera il CAPTCHA
document.getElementById("open-login").addEventListener("click", function() {
    document.getElementById("login-popup").classList.add("active");
    document.getElementById("overlay").classList.add("active");
    generateCaptcha();
});

// Nasconde il popup di login cliccando sull'overlay
document.getElementById("overlay").addEventListener("click", function() {
    document.getElementById("login-popup").classList.remove("active");
    document.getElementById("overlay").classList.remove("active");
});

// Funzione per generare il CAPTCHA
function generateCaptcha() {
    const canvas = document.getElementById("captcha");
    const ctx = canvas.getContext("2d");
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    let captchaText = "";

    // Genera il testo del CAPTCHA
    for (let i = 0; i < 6; i++) {
        captchaText += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    // Pulisce il canvas e imposta il colore di sfondo
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = "#f0f0f0";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Disegna il testo del CAPTCHA
    ctx.font = "30px Arial";
    ctx.fillStyle = "#000";
    ctx.textBaseline = "middle";
    ctx.textAlign = "center";
    ctx.fillText(captchaText, canvas.width / 2, canvas.height / 2);

    // Disegna righe casuali sopra il testo
    for (let i = 0; i < 5; i++) {
        ctx.strokeStyle = `rgba(${Math.floor(Math.random()*256)}, ${Math.floor(Math.random()*256)}, ${Math.floor(Math.random()*256)}, 0.8)`;
        ctx.lineWidth = Math.random() * 2 + 1;
        ctx.beginPath();
        ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.stroke();
    }

    // Salva il testo generato nel dataset del canvas
    canvas.dataset.captcha = captchaText;
}

// Verifica il CAPTCHA prima di inviare il form
document.querySelector("form").addEventListener("submit", function(e) {
    const userCaptcha = document.getElementById("captcha-input").value;
    const realCaptcha = document.getElementById("captcha").dataset.captcha;
    if (userCaptcha !== realCaptcha) {
        e.preventDefault();
        alert("CAPTCHA incorretto. Riprova.");
        generateCaptcha();
        document.getElementById("captcha-input").value = "";
    }
});
