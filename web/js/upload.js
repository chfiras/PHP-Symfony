function readURL(input) {

    //if (k=="#") {$(document.getElementById("Blah")).hide()}

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


console.log($('#blah').attr('src'));
if ($('#blah').attr('src') == "#") {
    $('#blah').hide();
}

$("#advert_image_file").change(function(){
    readURL(this);
    $('#blah').show();
    $('#blah').css("display","block");
});

