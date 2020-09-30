var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: '100+ plano milling job work in Ambattur Industrial Estate, machiniing & Slotting process', sitelogo:'Palmo' });
});

/* GET home page. */
router.get('/about', function(req, res, next) {
  res.render('about', { title: '100+ plano milling job work in Ambattur Industrial Estate, machiniing & Slotting process', sitelogo:'Palmo' });
});

/* GET home page. */
router.get('/index-1', function(req, res, next) {
  res.render('index-1', { title: 'Express index file - 1' });
});


module.exports = router;
