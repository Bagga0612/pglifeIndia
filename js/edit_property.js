window.addEventListener("load", function () {
    var edit_property_form = document.getElementById("edit-property-form");
    edit_property_form.addEventListener("submit", function (event) {
        var XHR = new XMLHttpRequest();
        var property_id=event.target.getAttribute("property_id");
        var form_data = new FormData(edit_property_form);

        // On success
        XHR.addEventListener("load", edit_property_success);

        // On error
        XHR.addEventListener("error", on_error);

        // Set up request
        XHR.open("GET", "api/edit_property_submit.php?property_id"+ property_id, true);

        // Form data is sent with request
        XHR.send(form_data);

        document.getElementById("loading").style.display = 'block';
        event.preventDefault();
    });
});

var edit_property_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    console.log(response);
    if (response.success) {
        alert(response.message);
        location.reload();
    } else {
        alert(response.message);
    }
};

var on_error = function (event) {
    document.getElementById("loading").style.display = 'none';

    alert('Oops! Something went wrong.');
};