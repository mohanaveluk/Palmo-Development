var express = require('express');
const contactController = require('../controller/contactController');
var router = express.Router();

/* GET users listing. */
router.post('/add', contactController.addContact);

module.exports = router;
