import { createI18n } from 'vue-i18n'

import messages from "@intlify/unplugin-vue-i18n/messages";
const lang = document.documentElement.lang;

function loadLocaleMessages() {
    const locales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
    const messages = {}
    locales.keys().forEach(key => {
      const matched = key.match(/([A-Za-z0-9-_]+)\./i)
      if (matched && matched.length > 1) {
        const locale = matched[1]
        messages[locale] = locales(key).default
      }
    })
    return messages
  }

const i18n = createI18n({
    fullInstall: true,
    legacy: false,
    locale: lang,
    fallbackLocale: 'en',
    globalInjection: true,
    messages: messages,
  })

  if (import.meta.hot) {
    import.meta.hot.on("locales-update", (data) => {
      Object.keys(data).forEach((lang) => {
        i18n.global.setLocaleMessage(lang, data[lang]);
      });
    });
  }
export default i18n;