window.addEventListener("load", function () {
    var is_interested_images = document.getElementsByClassName("is_interested-image");
    Array.from(is_interested_images).forEach(element => {
        element.addEventListener("click", function (event) {
            var XHR = new XMLHttpRequest();
            var property_id = event.target.getAttribute("property_id");

            // On success
            XHR.addEventListener("load", toggle_interested_success);

            // On error
            XHR.addEventListener("error", on_error);

            // Set up request
            XHR.open("GET", "api/intrested.php?property_id=" + property_id);

            // Initiate the request
            XHR.send();

            document.getElementById("loading").style.display = 'block';
            event.preventDefault();
        });
    });
});

var toggle_interested_success = function (event) {
    document.getElementById("loading").style.display = 'none';

    var response = JSON.parse(event.target.responseText);
    if (response.success) {
        var property_id = response.property_id;

        // var is_interested_image = document.querySelectorAll(".property-id-" + property_id + " .is-interested-image")[0];
        // var interested_user_count = document.querySelectorAll(".property-id-" + property_id + " .interested-user-count")[0];

        if (response.is_interested) {
            document.getElementById("meee").classList.add("fas");
            document.getElementById("meee").classList.remove("far");
            var interested_user_count= document.getElementById("number");
            interested_user_count.innerHTML=parseInt(interested_user_count.innerHTML)+1 +" interested";
            location.reload();
        } else {
            document.getElementById("meee").classList.add("far");
            document.getElementById("meee").classList.remove("fas");
            var interested_user_count= document.getElementById("number");
            interested_user_count.innerHTML=parseInt(interested_user_count.innerHTML)-1+ " interested";
            location.reload();

        }
    } else if (!response.success && !response.is_logged_in) {
        window.$('#exampleModal').modal("show");
    }
};