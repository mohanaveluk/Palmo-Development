const mysql = require('mysql2');
const pool = require('../config/datapool');

var contactUsModel = class ContactUs{
    constructor(
        name,
        email,
        mobile,
        comments
        ){
            this.Name = name;
            this.Email = email;
            this.Comments = comments;
            this.MobileNumber = mobile;
        }

    async updateContact(){
        try{
            var query = mysql.format(insertSql, [this.Name, this.Email, this.MobileNumber, this.Comments]);
            var queryResult = pool.query(query);
            return await queryResult;
        }
        catch (error){
            throw error;
        }
    };

}
var insertSql = `insert into CONTACTUS (
    ContactName
    ,ContactEmail
    ,ContactMobile
    ,ContactMessage) 
    values(	?, ?, ?, ?)`;

module.exports = contactUsModel;