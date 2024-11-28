import { createI18n } from "vue-i18n";
import * as ja_JP from "./ja_JP";
import * as en_GB from "./en_GB";

const messages = {
    ja: {
        ...ja_JP,
    },
    en: {
        ...en_GB,
    },
};

export const vueI18n = createI18n({
    locale: 'en',
    fallbackLocale: 'ja',
    messages,
})