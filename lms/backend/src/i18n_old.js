import { createI18n } from 'vue-i18n'
import path from "path";

const lang = document.documentElement.lang;

function loadLocaleTranslations() {
  //path.resolve(__dirname, './path/to/src/locales/**')
  const locales = path.context('./', true, /[A-Za-z0-9-_,\s]+\.json$/i);
  const messages = {};
  locales.keys().forEach(key => {
    const matched = key.match(/([A-Za-z0-9-_]+)\./i);
    if (matched && matched.length > 1) {
      const locale = matched[1];
      if (messages[locale]) {
          messages[locale] = {...messages[locale], ...locales(key)};
          return;
      }
      messages[locale] = locales(key);
    }
  })

  return messages;
}

const i18n = createI18n({
    locale: lang,
    fallbackLocale: 'en',
    messages: loadLocaleTranslations()
})

export default i18n;