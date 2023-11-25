function onClickGenerateQrCode() {
    var shortenedLink = "https://" + document.getElementById('urlCode').value;
    var qrSize = 200;
    var qr = new QRCode(document.getElementsByClassName('qr-code')[0], {
        text: shortenedLink,
        width: qrSize,
        height: qrSize,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
}
