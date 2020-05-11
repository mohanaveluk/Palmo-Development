var express = require('express');
const contactController = require('../controller/contactController');
var router = express.Router();

/* GET users listing. */
router.post('/add', contactController.addContact);
router.get('/list', contactController.getContacts);
router.get('/list/:name', contactController.getContacts);

module.exports = router;
