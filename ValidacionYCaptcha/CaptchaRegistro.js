grecaptcha.ready(function() {
    grecaptcha.execute('6LdfMfEcAAAAAO5Q2ukW9JjGwfcFrsAr26it8u58', { action: 'registro' })
        .then(function(token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
});