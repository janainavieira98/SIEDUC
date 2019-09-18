var rules = [{
    "url": "http://localhost:8000/usuarios/criar",
    "name": "A rule for http://localhost:8000/usuarios/criar",
    "fields": [{
        "selector": "[name='name']",
        "value": () => Libs.chance.name()
    }, {
        "selector": "[name='address']",
        "value": () => Libs.chance.address()
    }, {
        "selector": "[name='city']",
        "value": () => Libs.chance.city()
    }, {
        "selector": "[name='neighborhood']",
        "value": () => Libs.chance.name()
    }, {
        "selector": "[name='cep']",
        "value": () => Libs.chance.zip({plusfour: true})
    }, {
        "selector": "[name='email']",
        "value": () => Libs.chance.email({domain: 'gmail.com'})
    }, {
        "selector": "[name='birthday']",
        "value": () => Libs.moment().format('yyyy-MM-dd')
    }]
}
];
