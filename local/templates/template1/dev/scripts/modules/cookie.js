window.setCookie = (name, value, path = '/') => {
  let cookie_string = name + '=' + escape(value);

  const expires = new Date(Date.now() + 86400e3);
  cookie_string += '; expires=' + expires.toGMTString();
  cookie_string += '; path=' + escape(path);

  document.cookie = cookie_string;
};

window.getCookie = (cookie_name) => {
  const results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');

  if (results) {
    return (unescape(results[2]));
  } else {
    return null;
  }
};

document.addEventListener('DOMContentLoaded', () => {
  const cookieNotification = document.querySelector('.cookie-notification');

  if (!cookieNotification) return;

  const agreeButton = cookieNotification.querySelector('[data-agree]');

  if (!getCookie('_agreement-cookie')) {
    cookieNotification.classList.remove('cookie-notification--hide');
  }

  agreeButton.addEventListener('click', () => {
    setCookie('_agreement-cookie', 'y', '/');
    cookieNotification.classList.add('cookie-notification--hide');
  });
});
