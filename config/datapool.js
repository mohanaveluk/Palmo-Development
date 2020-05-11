const mysql = require('mysql2');

const pool = mysql.createPool({
    host:"35.222.107.95",
    user:"root",
    password:"blueBonnet@1",
    database:"palmodata",
    connectionLimit : 10,
});

module.exports = pool.promise();