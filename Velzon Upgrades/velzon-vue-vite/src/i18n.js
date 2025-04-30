import { createI18n } from 'vue-i18n'

function loadLocaleMessages() {
  const messages = {}

  const locales = import.meta.glob('./lang/*.json', { eager: true })

  for (const path in locales) {
    const matched = path.match(/\/([\w-]+)\.json$/)
    if (matched && matched[1]) {
      const locale = matched[1]
      messages[locale] = locales[path]
    }
  }

  return messages
}

const setDateTimeFormats = {
  short: {
    year: 'numeric',
    month: 'short',
    day: 'numeric',
  },
  long: {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    weekday: 'long',
    hour: 'numeric',
    minute: 'numeric',
  },
}

const dateTimeFormats = {
  en: setDateTimeFormats,
  es: setDateTimeFormats,
  de: setDateTimeFormats,
  'en-GB': setDateTimeFormats,
}

export default createI18n({
  legacy: false,
  locale: import.meta.env.VITE_I18N_LOCALE || 'en',
  fallbackLocale: import.meta.env.VITE_I18N_FALLBACK_LOCALE || 'en',
  messages: loadLocaleMessages(),
  dateTimeFormats,
})
