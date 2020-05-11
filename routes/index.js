var express = require('express');
var router = express.Router();

/* GET home page. */
router.get('/', function(req, res, next) {
  res.render('index', { title: 'Palmo Home', sitelogo:'Palmo' });
});

/* GET home page. */
router.get('/index-1', function(req, res, next) {
  res.render('index-1', { title: 'Express index file - 1' });
});


module.exports = router;
