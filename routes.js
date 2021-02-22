const axios = require('axios')
const fs = require("fs");
new Promise(async resolve => {
    await axios.get('https://lappinalle.ru/api/adminallproducts')
        .then(res => {
            let productList = [];

            for (let prd in res.data) {
                productList.push(res.data[prd])
            }

            resolve(productList)
        })
}).then( async (products) => {
    let routes = await products.map(pr => `/${pr.sex_alias}/item-${pr.product_id}`)
    fs.writeFile("routesJSON.json", JSON.stringify(routes), function (e) {
        if (e) console.log(e)
    })
});

