const delay = require('webpack-api-mocker/utils/delay');
const noProxy = process.env.NO_PROXY === 'true';

const { login } = require('./user'); // Можна розбити запити на групи для зручності

const proxy = {
    'POST /api/user': {msg: "success", token: "asdfasdf"}, // Можна записати тут
    'POST /api/auth': login, // або вивести в окремий файл
    'GET /api/currentFolder': {
        id: null,
        parentId: null,
        name: ''
    },
    'GET /api/currentFolder/:id': function(req, res) {
        const { folderId } = req.params;
        return {
            id: folderId,
            parentId: null,
            name: 'aaa'
        };
    },
    'GET /api/folder': [
        {
            name: 'a',
            id: 1,
            parentId: null
        },
        {
            name: 'b',
            id: 2,
            parentId: null
        },
        {
            name: 'c',
            id: 3,
            parentId: null
        }
    ],
    'GET /api/folder/:id': function(req, res) {
        const { folderId } = req.params;
        return [
            {
                name: 'd',
                id: 4,
                parentId: folderId
            }
        ];
    },
    'DELETE /api/folder/:id': {},
    'PUT /api/folder/:id': {},
    'GET /api/card': [
        {
            id: 1,
            number: '1111111111111',
            cash: '121'
        },
        {
            id: 2,
            number: '22222222222222',
            cash: '121'
        },
        {
            id: 3,
            number: '33333333333333',
            cash: '121'
        },
        {
            id: 4,
            number: '444444444444444',
            cash: '121'
        }
    ]
}

module.exports = (noProxy ? {} : delay(proxy, 1000));
