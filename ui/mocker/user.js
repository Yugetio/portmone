exports.login = function (req, res) { // Кожен запит це функція з аргументами request, response
    const { password, email } = req.body;

    if (password === '888888' && email === 'admin') {
        return res.json(200, { token: "sdfsdfsdfdsf" });
    }

    return res.json(401, {});
};