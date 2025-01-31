<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die(); ?>

<section class="reviews__new-comment new-comment">
    <form class="new-comment__form form" data-vue="request" @submit.prevent="checkCaptcha"
          action="<?= SITE_TEMPLATE_PATH ?>/ajax/review.php?lang=<?= LANGUAGE_ID ?>">
        <template v-if="!submitted">
            <h2 class="form__title"><?= GetMessage("FORM_TITLE_REVIEW") ?></h2>

            <div class="form__name">
                <label class="form__label" for="form-name"><?= GetMessage("FORM_NAME") ?></label>

                <input class="form__input required" id="form-name" type="text" name="name" v-model="data.name"
                       placeholder="Angela Vladi" @input="invalid.name = false">

                <span v-if="invalid.name"
                      class="form__invalid-text"><?= GetMessage('FORM_NAME_INVALID_TEXT') ?></span>
            </div>

            <div class="form__email">
                <label class="form__label" for="form-email"><?= GetMessage("FORM_EMAIL") ?></label>

                <input class="form__input required" id="form-email" type="email" name="email" v-model="data.email"
                       placeholder="AngelaVladi@example.ru"
                       @input="invalid.email = false; invalid.emailIncorrect = false">


                <span v-if="invalid.email"
                      class="form__invalid-text"><?= GetMessage('FORM_EMAIL_INVALID_TEXT') ?></span>
                <span v-if="invalid.emailIncorrect"
                      class="form__invalid-text"><?= GetMessage('FORM_EMAIL_INCORRECT_INVALID_TEXT') ?></span>
            </div>

            <div class="form__phone">
                <label class="form__label" for="form-phone"><?= GetMessage("FORM_PHONE") ?></label>

                <input class="form__input required" id="form-phone" type="tel" name="phone" v-model="data.phone"
                       v-mask="'+7 (###)-###-##-##'" placeholder="+7 (___)-___-__-__"
                       @input="invalid.phone = false; invalid.phoneIncorrect = false">


                <span v-if="invalid.phone"
                      class="form__invalid-text"><?= GetMessage('FORM_PHONE_INVALID_TEXT') ?></span>
                <span v-if="invalid.phoneIncorrect"
                      class="form__invalid-text"><?= GetMessage('FORM_PHONE_INCORRECT_INVALID_TEXT') ?></span>
            </div>

            <div class="form__message form__message--review">
                <label class="form__label" for="form-message"><?= GetMessage("FORM_TEXT_REVIEW") ?></label>

                <textarea class="form__input" id="form-message" name="message" v-model="data.message"
                          @input="invalid.message = false"
                          placeholder="<?= GetMessage("FORM_PLACEHOLDER_REVIEW") ?>"
                          cols="30" rows="11" maxlength="400"></textarea>


                <span v-if="invalid.message"
                      class="form__invalid-text"><?= GetMessage('FORM_MESSAGE_INVALID_TEXT') ?></span>
            </div>

            <div class="form__agreement">
                <label class="form__label" for="form-agreement">
                    <?= GetMessage('FORM_AGREEMENT') ?>
                </label>
                <input class="visually-hidden"
                       id="form-agreement"
                       type="checkbox"
                       v-model="data.agreement"
                       required checked
                >
            </div>

            <button class="form__button button button--link" type="submit"><?= GetMessage("SEND") ?></button>
        </template>

        <template v-if="submitted || error">
            <div class="form__response">
                <div class="form__result" v-if="state == 'SUCCESS'">
                    <?= GetMessage('FORM_STATE_SUCCESS_REVIEW') ?>
                </div>
                <div class="form__result" v-if="state == 'NO_DATA'">
                    <?= GetMessage('FORM_STATE_NO_DATA') ?>
                </div>
                <div class="form__result" v-if="state == 'VALIDATION_ERROR'">
                    <?= GetMessage('FORM_STATE_VALIDATION_ERROR') ?>
                </div>
                <div class="form__result" v-if="state == 'SAVE_ERROR'">
                    <?= GetMessage('FORM_STATE_SAVE_ERROR') ?>
                </div>
                <div class="form__result" v-if="state == 'RECAPTCHA_ERROR'">
                    <?= GetMessage('FORM_STATE_RECAPTCHA_ERROR') ?>
                </div>
            </div>
        </template>
    </form>
</section>
