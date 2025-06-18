import qs from 'query-string';

export const setUrl = (params) => {
    let url = qs.stringifyUrl({url: window.location.href, query: params},{arrayFormat: 'comma'} );
    history.pushState({}, null, url);
}

export const getUrl = (getParam = false, isArray = false) => {
    const urlParams = qs.parse(window.location.search, {arrayFormat: 'comma'});
    if(getParam){
        let value = urlParams[getParam]
        if(isArray && !Array.isArray(value)){

            return value ? [value] : []
        }
        return value
    }
    return urlParams
}

