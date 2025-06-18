import moment from "moment";

export const isValidDate = (date) => {
    const m = moment(date, 'DD.MM.YYYY')
    return date === m.format('DD.MM.YYYY')
}

export const getCurrentDate = (date = new Date, format = '') => {
    return moment(date, format).format('DD.MM.YYYY');
}

export const startOfMonth = (date = '', format = '') => {
    if (date && format) {
        return moment(date, format).startOf('month').format('DD.MM.YYYY');
    } else {
        return moment().startOf('month').format('DD.MM.YYYY');
    }
}

export const endOfMonth = (date = '', format = '') => {
    if (date && format) {
        return moment(date, format).endOf('month').format('DD.MM.YYYY');
    } else {
        return moment().endOf('month').format('DD.MM.YYYY');
    }
}

export const getCurrentMonthYear = (date = null) => {
    if (date) {
        return moment(date, 'DD.MM.YYYY').format('MM.YYYY');
    } else {
        return moment().format('MM.YYYY');
    }
}

export const getMonthStartEnd = (date) => {
    let startOfMonth, endOfMonth;

    if (date) {
        startOfMonth = moment(date, 'MM.YYYY').startOf('month').format('DD.MM.YYYY');
        endOfMonth   = moment(date, 'MM.YYYY').endOf('month').format('DD.MM.YYYY');
    } else {
        startOfMonth = moment().startOf('month').format('DD.MM.YYYY');
        endOfMonth   = moment().endOf('month').format('DD.MM.YYYY');
    }

    return [startOfMonth, endOfMonth];
}

export const prevMonth = () => {
    return moment().startOf('month').subtract(1, 'month').format('DD.MM.YYYY')
}