export const parserData = (dataset) => {
    const data = {};
    for (let name in dataset){
        if(name !== 'vueFile'){
            try {
                data[name] = JSON.parse(dataset[name])
            }catch (e) {
                data[name] = dataset[name]
            }
        }
    }
    return data
}