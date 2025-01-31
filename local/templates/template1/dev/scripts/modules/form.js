document.addEventListener('DOMContentLoaded', () => {
  const instance = document.querySelectorAll('[data-vue]');

  if (!instance) return;

  const initialize = () => {
    instance.forEach((elem) => {
      Vue.directive('mask', VueMask.VueMaskDirective);
      
      const form = new Vue({
        el: elem,
        data: {
          data: {},
          submitURL: '',
          submitted: false,
          state: '',
          invalid: {
            name: false,
            phone: false,
            phoneIncorrect: false,
            email: false,
            emailIncorrect: false,
          },
          error: false,
        },
        mounted: function () {
          this.submitURL = this.$el.action;
        },
        methods: {
          submit: function () {
            if (this.checkForm()) {
              const data = Object.assign({}, this.data);
              const formData = new FormData();

              Object.keys(data).forEach(key => {
                if (data[key] === true) {
                  data[key] = 'Да';
                }
                formData.append(key, data[key]);
              });

              this.submitted = true;
              this.error = false;

              fetch(this.submitURL, {
                method: 'POST',
                body: formData
              })
                .then((response) => {
                  this.state = (response.status === 200) ? 'SUCCESS' : '';

                  if (!response.ok) {
                    this.submitted = false;
                    this.error = true;
                  }
                }).catch((err) => {
                console.log(err);
              });
            }
          },
          checkForm: function () {
            let validation = true;

            this.invalid.name = false;
            this.invalid.phone = false;
            this.invalid.phoneIncorrect = false;
            this.invalid.email = false;
            this.invalid.emailIncorrect = false;
            this.invalid.message = false;

            if (!this.data.name) {
              this.invalid.name = true;
              validation = false;
            }

            if (!this.data.phone) {
              this.invalid.phone = true;
              validation = false;
            }

            if (this.data.phone && !this.validPhone(this.data.phone)) {
              this.invalid.phoneIncorrect = true;
              validation = false;
            }

            if (!this.data.email) {
              this.invalid.email = true;
              validation = false;
            }

            if (this.data.email && !this.validEmail(this.data.email)) {
              this.invalid.emailIncorrect = true;
              validation = false;
            }

            if (!this.data.message) {
              this.invalid.message = true;
              validation = false;
            }

            if (!validation) {
              form.$forceUpdate();
            }

            return validation;
          },
          validPhone: function (phone) {
            const regExp = new RegExp("^((\\d|\\+\\d)[\\- ]?)?(\\(?\\d{3}\\)?[\\- ]?)?[\\d\\- ]{7,10}$");
            return regExp.test(phone);
          },
          validEmail: function (email) {
            const regExp = new RegExp("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]+$");
            return regExp.test(email);
          },
          checkCaptcha: function () {
            const _this = this;
            if ('grecaptcha' in window) {
              grecaptcha.execute(window.captchaPublicKey, {action: 'submit'}).then(function (token) {
                _this.data.recaptchaResponse = (token) ? token : '';
                _this.submit();
              })
            }
          },
        },
      });
    })
  };

  initialize();
});
