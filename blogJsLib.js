var validate = function() {
    var test = document.getElementById('sub');
    if (test.value.length < 5) {
        window.alert("Subject line really too short.");
        test.focus();
        return false;
    }
    
    test = document.getElementById('cont');
    if (test.value.length < 3) {
        window.alert("Post content seems to be too short.");
        test.focus();
        return false;
    }
}