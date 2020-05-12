const mysql = require('mysql2');

const pool = mysql.createPool({
    host:"dentalmysql.cc6ydrz3sjwp.us-east-1.rds.amazonaws.com",
    user:"adminuser",
    password:"adminuser",
    database:"palmodata",
    connectionLimit : 10,
});

module.exports = pool.promise();