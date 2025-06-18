import moment from 'moment'
export const urlDeal = (id) => {
    if(id){
        return `<a 
                class="underline text-blue-700"
                href="/crm/deal/details/${id}/" 
                target="_blank"
                >${id}</a>`
    }
    return '<span class="text-xs text-slate-300">(пусто)</span>'
}

export const num = (num) => {
    let numFormat = parseFloat(num)
    if(!isNaN(numFormat)){
        numFormat = Math.round(numFormat * 100) / 100;
        return '<span class="text-right">'+numFormat.toLocaleString('ru-RU')+'</span>'
    }

    return num
}
export const num0 = (num) => {
    let numFormat = parseFloat(num)
    if(!isNaN(numFormat)){
        numFormat = Math.round(numFormat * 100) / 100;
        return numFormat.toLocaleString('ru-RU')
    }

    return num
}

export const bytes = (bytes, decimals = 2) => {
    if (!+bytes) return '0 Bytes'

    const k = 1024
    const dm = decimals < 0 ? 0 : decimals
    const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB']

    const i = Math.floor(Math.log(bytes) / Math.log(k))

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
}

export const dateUnix = (time) => {
    return moment.unix(time).format("DD.MM.YYYY HH:mm.ss");
}
export const boolean = (value) => {
    return parseInt(value) ? 'Да' : 'Нет'
}