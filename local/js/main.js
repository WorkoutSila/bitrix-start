import {createApp} from 'vue'
import {parserData} from 'js/helpers/vue-import'
import 'element-plus/dist/locale/ru.min.mjs'
import 'element-plus/dist/index.css'


console.log('RUN');


let vueKey = 0

const mountedVue = async (vueFile) => {
    const importFile = await import(`./vue/${vueFile}.js`);
    const vueComponent = await importFile.default()
    let els = document.querySelectorAll(`[data-vue-file='${vueFile}']`)
    els.forEach(el => {
        el.classList.add('app')
        if(!el.dataset.vueKey){
            el.dataset.vueKey = vueKey
            const app = createApp(vueComponent.default, parserData(el.dataset))
            app.mount(`[data-vue-key="${vueKey}"]`)
            vueKey++
        }
    })

}

const mountedVueAll =  () => {
    let vueComponentsEls = document.querySelectorAll('[data-vue-file]');
    vueComponentsEls.forEach(el => mountedVue(el.dataset.vueFile))
}

mountedVueAll()

window.onload = () => {
    mountedVueAll()
}

const mountedJs = async (fileJs) => {
    const importFile = await import(`./vue/${fileJs}.js`);
    const component = await importFile.default()
    if(component.default){
        component.default()
    }

}

window.mountedJs = mountedJs
window.mountedVue = mountedVue
window.mountedVueAll = mountedVueAll