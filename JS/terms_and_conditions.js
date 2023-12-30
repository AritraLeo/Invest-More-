function terms() {
    var valid = false;
    if (document.getElementById("MyCheckout").checked) {
        valid = true;

    }
    if (valid) {
        alert("payment on the way");

    } else {
        alert("please choose one");
        return false;
    }
}