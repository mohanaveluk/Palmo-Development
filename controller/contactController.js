const contactModel = require('../models/contact');

exports.addContact = async (req, res, next) => {
    const name = req.body.userName;
    const email = req.body.userEmail;
    const mobile = req.body.userPhone;
    const comments = req.body.userMessage;

    try{
        var contactObject = new contactModel(name, email, mobile, comments); 
        var result = await contactObject.updateContact();
        if(result.length > 0 &&  result[0].affectedRows >= 1)
        {
            return res.status(200).json({status: 'true', message: 'Thank you for contacting us and will get back to you shortly'});
        }else{
            return res.status(200).json({status: 'true', message: 'Sorry! unable to update your contact details at this moment. Please call us for enquiry!'});
        }
    }
    catch(error){
        return res.status(422).json({status: 'true', message: error.message});
    }
};

exports.getContacts = async (req, res, next) => {
    return res.status(200).json({status: 'true', message: 'List out all the contact lists'});
}
