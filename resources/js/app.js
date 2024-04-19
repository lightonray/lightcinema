import './bootstrap';
import './script';
import './comments';
import './actors';

if(document.querySelector(".form-container") != undefined){
    import ('./uploadImage');
}

$(document).ready(function() {
    $('.select2').select2();
});