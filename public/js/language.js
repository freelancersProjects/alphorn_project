function getDefaultLanguage() {
    const browserLang = navigator.language || navigator.userLanguage;
    const lang = browserLang.split('-')[0];
    if (lang === 'fr') {
        return 'fr';
    } else if (lang === 'it') {
        return 'it';
    } else if (lang === 'de') {
        return 'de';
    } else {
        return 'fr';
    }
}

window.setLanguage = function (lang) {
    localStorage.setItem('locale', lang);
    document.cookie = `user_locale=${lang}; path=/`;
    location.reload();
}

function initializeLanguage() {
    let selectedLang = localStorage.getItem('locale');
    if (!selectedLang) {
        selectedLang = getDefaultLanguage();
        localStorage.setItem('locale', selectedLang);
        document.cookie = `user_locale=${selectedLang}; path=/`;
    }
}

initializeLanguage();

window.addEventListener('storage', (event) => {
    if (event.key === 'locale') {
        document.cookie = `user_locale=${event.newValue}; path=/`;
        location.reload();
    }
});
