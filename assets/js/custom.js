/* START: Validatation for #offer_review */
document.getElementById("js_offer_review").onsubmit = function (e) {
    var offer_price = document.getElementById("offer_price").value.trim();
    var offer_loc = document.getElementById("offer_loc").value.trim();
    var offer_remarks = document.getElementById("offer_remarks").value.trim();

    price_res = input_price_validate(offer_price);
    loc_res = input_loc_validate(offer_loc);
    remarks_res = input_remarks_validate(offer_remarks);
    
    if (price_res === 1 || loc_res === 1 || remarks_res === 1) {
        e.preventDefault();
    } else {
        e.preventDefault();
        $("#offerModal").modal("hide");
        $("#confirmModal").modal("show");
        
        offer_price = offer_price.replace(/0*[^\d\.]*/i, "");
        document.getElementById("submit_price").textContent = offer_price;
        document.getElementById("hidden_submit_price").setAttribute("value", offer_price);
        
        document.getElementById("submit_loc").textContent = offer_loc;
        document.getElementById("hidden_submit_loc").setAttribute("value", offer_loc);
        
        if (offer_remarks === "" || offer_remarks === null || offer_remarks === "NIL" || offer_remarks === "nil" || offer_remarks === "NA" || offer_remarks === "N.A." || offer_remarks === "na" || offer_remarks === "n.a.") {
            document.getElementById("submit_remarks").textContent = "NIL";
            document.getElementById("hidden_submit_remarks").setAttribute("value", "NIL");
        } else {
            document.getElementById("submit_remarks").textContent = offer_remarks;
            document.getElementById("hidden_submit_remarks").setAttribute("value", offer_remarks);
        }
    }
};

// Validate: Offer Price
function input_price_validate(input) {
    var price_regex = /^((SGD *)|(\$))*[0-9]+(?:\.[0-9]{2})?$/i;
    if (input.match(price_regex)) {
        remove_error_span_tag("div_offer_price");
        return 0;
    } else {
        add_error_span_tag("div_offer_price", "Please enter a valid price");
        return 1;
    }
}

// Validate: Meetup Location
function input_loc_validate(input) {
    var loc_regex = /^[a-zA-Z0-9 ]*$/;
    if (input === null || input === "") {
        add_error_span_tag("div_offer_loc", "Please enter a suitable location");
        return 1;
    } else if (input.match(loc_regex)) {
        remove_error_span_tag("div_offer_loc");
        return 0;
    } else {
        add_error_span_tag("div_offer_loc", "Please enter a suitable location");
        return 1;
    }
}

// Validate: Offer Remarks
function input_remarks_validate(input) {
    var remarks_regex = /^[a-zA-Z0-9!.,&+()':?/ ]*$/;
    if (input.match(remarks_regex)) {
        remove_error_span_tag("div_offer_remarks");
        return 0;
    } else {
        add_error_span_tag("div_offer_remarks", "Please refrain from using special characters");
        return 1;
    }
}

// Function to display error msg
function add_error_span_tag(div_offer, error_msg) {
    var parent_div = remove_error_span_tag(div_offer);

    var new_span_tag = document.createElement("span");
    new_span_tag.setAttribute("class", "input_error");

    var span_text = document.createTextNode(error_msg);
    new_span_tag.appendChild(span_text);

    parent_div.appendChild(new_span_tag);
}

// Function to remove error msg
function remove_error_span_tag(div_offer) {
    var parent_div = document.getElementById(div_offer);
    var span_tag = parent_div.lastElementChild.getAttribute("class");
    
    if (span_tag === "input_error") {
        parent_div.removeChild(parent_div.lastElementChild);
    }
    return parent_div;
}
/* END: Validatation for #offer_review */


/* START: Countdown Timer for product item */
// Set due date to count down to
var countDownDate = new Date(document.getElementById("countdown_timer").value).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("countdown_p").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("countdown_p").innerHTML = "EXPIRED";
  }
}, 1000);
/* END: Countdown Timer for product item */


/* START: Display Chat Box */
var chat_click_count = 0;
document.getElementById("chat_btn").addEventListener("click", check_click_count);

function check_click_count() {
    chat_click_count++;
    if (chat_click_count % 2 == 1) {
        unhide_chat();
    } else {
        hide_chat();
    }
}

function unhide_chat() {
    var hidden_chat = document.getElementsByClassName("hide-chat");
    for (var i=0; i<hidden_chat.length; i++) {
        var class_attrib = hidden_chat[i].getAttribute("style");
        if (class_attrib != null) {
            class_attrib = class_attrib.slice(0, -17);
            var new_attrib = class_attrib + " display: block;";
        } else {
            var new_attrib = "display: block;";
        }
        hidden_chat[i].setAttribute("style", new_attrib);
    }
}

function hide_chat() {
    var hidden_chat = document.getElementsByClassName("hide-chat");
    for (var i=0; i<hidden_chat.length; i++) {
        var class_attrib = hidden_chat[i].getAttribute("style");
        class_attrib = class_attrib.slice(0, -16);
        if (class_attrib != null) {
            var new_attrib = class_attrib + " display: hidden;";
        } else {
            var new_attrib = "display: hidden;";
        }
        hidden_chat[i].setAttribute("style", new_attrib);
    }
}
/* END: Display Chat Box */


/* START: Chat Pop-up */
function PopupCenter(url, title, w, h) {
// Fixes dual-screen position                         Most browsers      Firefox
var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

var systemZoom = width / window.screen.availWidth;
var left = (width - w) / 2 / systemZoom + dualScreenLeft
var top = (height - h) / 2 / systemZoom + dualScreenTop
var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w / systemZoom + ', height=' + h / systemZoom + ', top=' + top + ', left=' + left);

// Puts focus on the newWindow
if (window.focus) newWindow.focus();
}
/* END: Chat Pop-up */