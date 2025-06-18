/*global BX*/
import axios from "axios"
import qs from "qs"
import { isEmpty } from 'lodash'
import { readonly, ref } from 'vue';
import { ElMessage } from 'element-plus'

const HTTP = axios.create({
    baseURL: '/',
    headers: {
        'Content-type': 'application/json',
    }
})

HTTP.interceptors.response.use(
    response => {
        if (response.data?.data?.errorMessage ){
            return Promise.reject(response.data.data.errorMessage)
        }

        if (!isEmpty(response.data.errors)){

            let responseCode = response.data?.errors[1].code
            let responseMessage = response.data.errors[1].message
            if(response.data?.errors[1].code === 0){
               responseCode = response.data?.errors[0].code
               responseMessage = response.data.errors[0].message
            }

            // console.log(responseCode);
            if(responseCode !== 422){

                if(responseCode === 400){
                    //ElMessage.error(responseMessage)
                    console.error('МОДАЛКА', responseMessage)
                    ElMessage({
                        showClose: true,
                        dangerouslyUseHTMLString: true,
                        message: responseMessage,
                        type: 'error',
                        duration: 5000
                    });
                    return Promise.reject(responseMessage)
                }else {
                    ElMessage({
                        showClose: true,
                        dangerouslyUseHTMLString: true,
                        message: '<pre>'+JSON.stringify(response.data.errors,null,'  ')
                            .replaceAll('\\n','<br>')
                            .replaceAll('\\t','')+'</pre>',
                        type: 'warning',
                        duration: 10000
                    });
                }

            }
            // Для форм
            if(responseCode === 422){
                try {
                    return Promise.reject(JSON.parse(responseMessage))
                }
                catch (e) {
                    return Promise.reject(responseMessage)
                }
            }

            return Promise.reject(response.data.errors)
        }
        return response.data?.data
    },
    error => Promise.reject(error.response)
);

export const REFRESH_TABLE = (gridId) => {
    return BX.Main.gridManager.reload(gridId);
}

export const BX_POST = (component, action, data, onUploadProgress) => {

    const formData = new FormData()
    let  headers = {'Content-Type': 'multipart/form-data'}

    for (let attribute in data){
        if(['string','number'].includes(typeof data[attribute])) {
            formData.append(attribute, data[attribute])
        }else if (data[attribute] instanceof File){
            formData.append(attribute, data[attribute])
        }else {
            formData.append(attribute, JSON.stringify(data[attribute]))
        }
    }

    let getQuery = {
        c: component,
        action: action,
        mode: 'class',
        sessid:  BX.bitrix_sessid(),
    }

    return HTTP.post(
        `/bitrix/services/main/ajax.php?`+qs.stringify(getQuery),
        formData,
        {
            headers,
            onUploadProgress
        }
    )
}



export const GET = (method,data) => HTTP.get(method, {
    params: data
})

// export const POST = (method,data) => HTTP.post(method, data)
export const POST = (method,data = {}) => {
    return new Promise((resolve, reject) => {
        axios.post(method,data,{
            headers: {
                'Content-type': 'application/json',
                'X-Bitrix-Csrf-Token' : BX.bitrix_sessid()
            }
        })
        .then(r => {
            if(r.data.status === 'success'){
                resolve(r.data.data)
            }else {
                reject(r.data)
            }
        })
        .catch(r => reject(r))
    })


}

export const BX_REST = (method, data) => {

    return BX.rest.callMethod(method, data)
        .then(r => {
            return  r.answer.result
        }).catch((er) => {
            return Promise.reject(er.name)
        })
}

export function usePost(component, action) {

    const state = ref();
    const isLoading = ref(false);
    const error = ref(false);

    const load = (data = {}) => {
        return new Promise((resolve, reject) => {

            isLoading.value = true
            error.value = false
            BX_POST(component, action, data)
                .then(r => {
                    resolve(r)
                    state.value = r
                })
                .catch(er => {
                    reject(er);
                    error.value = er
                })
                .finally(() => {
                    isLoading.value = false
                })
        });
    };
    return [readonly(state), load, readonly(isLoading), readonly(error)];
}

export function usePostGroup(component, group, actionGroup, isRunLoad = false) {

    const state = ref();
    const isLoading = ref(false);
    const error = ref(false);

    const load = (data = {}) => {
        return new Promise((resolve, reject) => {
            let action = 'main'

            const dataSend = {
                class: group,
                action: actionGroup,
                data
            }

            isLoading.value = true
            error.value = false
            BX_POST(component, action, dataSend)
                .then(r => {
                    resolve(r)
                    state.value = r
                })
                .catch(er => {
                    reject(er);
                    error.value = er
                })
                .finally(() => {
                    isLoading.value = false
                })
        });
    };

    if(isRunLoad){
        load()
    }

    return [readonly(state), load, readonly(isLoading), readonly(error)];
}

