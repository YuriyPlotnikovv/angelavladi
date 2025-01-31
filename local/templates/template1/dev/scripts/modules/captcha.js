const getScript = url => new Promise((resolve, reject) => {
  const script = document.createElement('script')
  script.src = url
  script.async = true

  script.onerror = reject

  script.onload = script.onreadystatechange = function () {
    const loadState = this.readyState

    if (loadState && loadState !== 'loaded' && loadState !== 'complete') return

    script.onload = script.onreadystatechange = null

    resolve()
  }

  document.head.appendChild(script)
});

document.addEventListener('DOMContentLoaded', () => {
  let publicKey = '';
  fetch('/local/templates/template1/ajax/recaptcha.php')
    .then(response => response.json())
    .then(json => {
      publicKey = json.publicKey;
      window.captchaPublicKey = publicKey;
      getScript('https://www.google.com/recaptcha/api.js?render=' + publicKey)
        .catch(() => {
          console.error('Could not load script')
        })
    })

});
