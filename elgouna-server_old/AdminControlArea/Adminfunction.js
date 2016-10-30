function checkLogin() {

    $("#error_msg").slideUp();
    $("#loadButton").show();
    $("#loginButton").hide();
    var i = 0;
    if (document.getElementById('username').value == '' && $.trim(document.getElementById('username').value) == '') {
        i++;
    }

    if (document.getElementById('password').value == '' && $.trim(document.getElementById('password').value) == '') {
        i++;
    }
    if (i == 0) {
        if (window.XMLHttpRequest)
        {

            // code for I E7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {

                if (xmlhttp.responseText == 'ok') {
                    document.location.href = 'users.php';
                } else {
                    $("#error_msg").slideDown(500);
                    $("#loadButton").hide();
                    $("#loginButton").show();
                }
            } else {

            }
        }


        xmlhttp.open("POST", "check_admin_exist.php", true); // may retuen cache result
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var x = document.getElementById("username").value;
        var y = document.getElementById("password").value;
        var params = "username=" + x + "&pass=" + y;
        xmlhttp.send(params);
    }

}
function removeServicIntro(pg, x) {
    //alert(x);
    $("#serviceImg").hide();
    $.ajax({
        type: "POST",
        url: pg,
        data: {'id': x},
        success: function (data) {}
    });
}

function removeImages(pg, x) {
    //alert(x);
    if (confirm('Are you sure you want to Delete this image')) {
        $("#serviceImg" + x).hide();
        $.ajax({
            type: "POST",
            url: pg,
            data: {'id': x},
            success: function (data) {}
        });

    }

}

function getDist() {
    $("#distTd").html('<img src="loading.gif">');
    $.ajax({
        type: "POST",
        url: 'getDistrict.php',
        data: {'city_id': $("#city").val()},
        success: function (data) {
            $("#distTd").html(data);
        }
    });


}

function setDist() {
    $("#dist_id").val($("#dist").val());
}


function saveBooking() {
    $("#fault-msg").slideUp(500);
    $("#success-msg").slideUp(500);
    var i = 0;
    $("#buttonDiv").hide();
    $("#loadiDiv").show();
    $("#error-div").slideUp(500);



    if ($.trim($("#bookingURL").val()) == '') {
        i++;
        document.getElementById("bookingURL").focus();
        $("#bookingURL").css("background-color", "#FFAEAE");

    }


    if (i == 0) {
        document.forms['coolform'].submit();

    } else {
        $("#buttonDiv").show();
        $("#loadiDiv").hide();
        $("#error-div").slideDown(500);

    }
}


function saveEGX(id_received){
    console.log(id_received);
    console.log($.trim($("#type").val()));
    $(document).ready(function() {
        $("#fault-msg").slideUp(500);
	$("#success-msg").slideUp(500);
	var i=0;
	$("#buttonDiv").hide();
	$("#loadiDiv").show();
	$("#error-div").slideUp(500);
	$("#missing-main-img").slideUp(500);
	if($.trim($("#descrip").val())==''){
		i++;
		document.getElementById("descrip").focus();
		$("#descrip").css("background-color","#FFAEAE");
                $("#missing-main-img").hide();
                $("#error-div").slideDown(500);
		}
	if($.trim($("#location").val())==''){
		i++;
		document.getElementById("location").focus();
		$("#location").css("background-color","#FFAEAE");
                $("#missing-main-img").hide();
                $("#error-div").slideDown(500);
		}
	if($.trim($("#name").val())==''){
		i++;
		document.getElementById("name").focus();
		$("#name").css("background-color","#FFAEAE");
                $("#missing-main-img").hide();
                $("#error-div").slideDown(500);
		}
        if($.trim($("#type").val())=='default'){
            i++;
            document.getElementById("type").focus();
            $("#type").css("background-color","#FFAEAE");
            $("#missing-main-img").hide();
            $("#error-div").slideDown(500);
        }
        if(id_received == 0) {
            if($.trim($("#simg1").val())=='' && i == 0){
                i++;    
                $("#error-div").hide();
                $("#missing-main-img").slideDown(200);
            }
        }
        if(i==0){
            console.log('it\'s submitting');    
            document.forms['coolform'].submit();
	}else{
	$("#buttonDiv").show();
	$("#loadiDiv").hide();
        }
    })
}

//appenza
//----------------------------------------------------------------------------------------
$(document).ready(function() {
    if($("#offer").is(":checked")) {
        $("#offer-title-row").show();
        $("#offer-desc-row").show();
    }
    $("#offer").change(function() {
        $("#offer-title-row").toggle();
        $("#offer-desc-row").toggle();
    })
    $(".close").click(function() {
        $("#success-msg").slideUp(200);
        $("#fault-msg").slideUp(200);
    })
    $('#delete').click(function() {
        var v_id = $(this).data("value");
        console.log('it equals ' + v_id);
        $.ajax({
            type: "POST",
            url: "venues.php",
            data: {
                vid: v_id
            },
            success: function(data) {
                console.log('done');
            },
            error: function(data) {
                console.log('mesh done');
            }
        });
    });
});
$("#alter-main-img").click(function() {
    $("#main-img").trigger('click');
});
$("#alter-logo").click(function() {
    $("#venue-logo").trigger('click');
});
$("#alter-img").click(function() {
    $("#trans-img").trigger('click');
});
$('img[src$="d.png"]').on('mouseover', function() {
    $(this).attr('src', 'dw.png');
}).on('mouseout', function() {
    $(this).attr('src', 'd.png');
})
$('img[src$="e.png"]').on('mouseover', function() {
    $(this).attr('src', 'eh.png');
}).on('mouseout', function() {
    $(this).attr('src', 'e.png');
})
$("#venue-logo").on("change", function() {
    var append = '';
    var logo_value = this.value.split(/[\/\\]/).pop();
    var logo_ext = logo_value.split(".")[1];
    if(logo_value.length > 30) {
        logo_value = logo_value.slice(0, 30);
        append = logo_value + '...' + logo_ext;
    }
    else {
        append = logo_value;
    }
    $("#file-text-logo").fadeIn(50, function() {
        $(this).typed({
            strings: ['../images/venues/'
                + append + ' (<a href"javascript:;" id="cancel-logo" ' 
                + 'style="cursor:pointer">cancel</a>)'],
            typeSpeed: -50,
            callback: function() {
                $('.typed-cursor').fadeOut(600);
                $("#cancel-logo").click(function() {
                    $("#file-text-logo").fadeOut(function() {
                        $(this).html('');
                    });
                })
            }
        });
    })
});
$("#main-img").on("change", function() {
    var append = '';
    var main_img_value = this.value.split(/[\/\\]/).pop();
    var main_img_ext = main_img_value.split(".")[1];
    if(main_img_value.length > 30) {
        main_img_value = main_img_value.slice(0, 30);
        append = main_img_value + '...' + main_img_ext;
    }
    else {
        append = main_img_value;
    }
    $("#file-text-main-img").fadeIn(50, function() {
        $(this).typed({
            strings: ['../images/venues/'
                + append + ' (<a href"javascript:;" id="cancel-main-img" ' 
                + 'style="cursor:pointer">cancel</a>)'],
            typeSpeed: -50,
            callback: function() {
                $('.typed-cursor').fadeOut(600);
                $("#cancel-main-img").click(function() {
                    $("#file-text-main-img").fadeOut(function() {
                        $(this).html('');
                    });
                })
            }
        });
    })
});
$("#trans-img").on("change", function() {
    var append = '';
    var img_value = this.value.split(/[\/\\]/).pop();
    var img_ext = img_value.split(".")[1];
    if(img_value.length > 30) {
        img_value = img_value.slice(0, 30);
        append = img_value + '...' + img_ext;
    }
    else {
        append = img_value;
    }
    $("#file-text-img").fadeIn(50, function() {
        $(this).typed({
            strings: ['../images/transportation/'
                + append + ' (<a href"javascript:;" id="cancel-img" ' 
                + 'style="cursor:pointer">cancel</a>)'],
            typeSpeed: -50,
            callback: function() {
                $('.typed-cursor').fadeOut(600);
                $("#cancel-img").click(function() {
                    $("#file-text-img").fadeOut(function() {
                        $(this).html('');
                    });
                })
            }
        });
    })
});
function hide_irrelevant_top() {
    var error_msgs = [
        '#error-div',
        '#mismatch-div',
        '#inv-score-div',
        '#inv-desc-div',
        '#inv-offer-title',
        '#inv-offer-desc',
        '#short-desc-div',
        '#missing-main-img',
        '#missing-logo',
        '#loadiDiv'
    ];
    for(var i = 0; i < error_msgs.length; i++) {
        $(error_msgs[i]).hide();
    }
}
function hide_irrelevant_mid() {
    var error_msgs = [
        '#missing-offerTitle',
        '#missing-offerDesc',
        '#inv-offer-title',
        '#inv-offer-desc',
        '#short-offer-desc',
        '#loadiDiv'
    ];
    for(var i = 0; i < error_msgs.length; i++) {
        $(error_msgs[i]).hide();
    }
}
function hide_irrelevant_bot() {
    var error_msgs = [
        '#missing-main-img',
        '#missing-logo',
        '#loadiDiv'
    ];
    for(var i = 0; i < error_msgs.length; i++) {
        $(error_msgs[i]).hide();
    }
}
function highlight(field) {
    $(field).css("background-color", "#FFAEAE");
}
//----------------------------------------------------------------------------------------
//                                    My BIG functions
//----------------------------------------------------------------------------------------
function saveEGXO(id_received) {
    $("#fault-msg").slideUp(500);
    
    $("#success-msg").slideUp(500);
    var i = 0;
    var err_fields = [];
    var errors = "<span>Please correct the following:</span>";
    if ($.trim($("#username").val()) == '') {
        i++;
        err_fields.push("username");
        errors += "<br>Username is missing.";
    }
    if ($.trim($("#username").val()) < 4) {
        i++;
        err_fields.push("username");
        errors += "<br>Username is too short.";
    }
    if (/\d/.test($.trim($("#username").val())) 
            && !(/\D/.test($.trim($("#username").val())))) {
        i++;
        err_fields.push("username");
        errors += "<br>Usernmae is invalid.";
    }
    if ($.trim($("#password").val()) == '') {
        i++;
        err_fields.push("password");
        errors += "<br>Password is missing.";
    }
    if ($.trim($("#password").val()).length < 6) {
        i++;
        err_fields.push("password");
        errors += "<br>Password is too short.";
    }
    if ($.trim($("#confirm").val()) != $.trim($("#password").val())) {
        i++;
        err_fields.push("confirm");
        errors += "<br>Passwords do not match.";
    }
    if ($.trim($("#name").val()) == '') {
        i++;
        err_fields.push("name");
        errors += "<br>Name is missing.";
    }
    if ($.trim($("#location").val()) == '') {
        i++;
        err_fields.push("location");
        errors += "<br>Location is missing.";
    }
    if ($.trim($("#type").val()) == 'default') {
        i++;
        err_fields.push("type");
        errors += "<br>Type is not selected.";
    }
    if ($.trim($("#latitude").val()) < -90 || $.trim($("#latitude").val()) > 90) {
        i++;
        err_fields.push("latitude");
        errors += "<br>Latitude must be between -90 and 90 inclusive.";
    }
    if ($.trim($("#longitude").val()) < -180 || $.trim($("#longitude").val()) > 180) {
        i++;
        err_fields.push("longitude");
        errors += "<br>Longitude must be between -180 and 180 inclusive.";
    }
    if ($.trim($("#rev-score").val()) > 5 || $.trim($("#rev-score").val()) < 0) {
        i++;
        err_fields.push("rev-score");
        errors += "<br>Review score must be between 0 and 5 inclusive.";
    }
    if (/{e}/.test($.trim($("#rev-socre").val()))) {
        i++;
        err_fields.push("rev-score");
        errors += "<br>Review score is invalid.";
    }
    if ($.trim($("#description").val()) == '') {
        i++;
        err_fields.push("description");
        errors += "<br>Description is missing.";
    }
    else if (/\d/.test($.trim($("#description").val())) 
            && !(/\D/.test($.trim($("#description").val())))) {
        i++;
        err_fields.push("description");
        errors += "<br>Description is invalid.";
    }
//    else if (($.trim($("#description").val())).length < 15) {
//        i++;
//        err_fields.push("description");
//        errors += "<br>Description is too short.";
//    }
    if ($("#offer").is(":checked")) {
        if($.trim($("#offer-title").val()) == '' 
                && $.trim($("#offer-description").val()) == '') {
            i++;
//            err_fields.push("offer-title");
            errors += "<br>Offer title is missing.";
        }
        if(/\d/.test($.trim($("#offer-title").val())) 
            && !(/\D/.test($.trim($("#offer-title").val())))) {
            i++;
//            err_fields.push("offer-title");
            errors += "<br>Offer title is invalid.";
        }
        if($.trim($("#offer-description").val()) == '') {
            i++;
//            err_fields.push("offer-description");
            errors += "<br>Offer description is missing.";
        }
        else if(/\d/.test($.trim($("#offer-description").val())) 
            && !(/\D/.test($.trim($("#offer-description").val())))) {
            i++;
//            err_fields.push("offer-description");
            errors += "<br>Offer description is invalid.";
        }
//        else if(($.trim($("#offer-description").val())).length < 15) {
//            i++;
////            err_fields.push("offer-description");
//            errors += "<br>Offer description is too short.";
//        }
    }
    if ($.trim($("#phone-number").val()).length > 16) {
        console.log($.trim($("#phone-number").val()));
        i++;
        errors += "<br>Phone number is too long.";
    }
    if(id_received !== 1) {
        if($("#venue-logo").val() === '') {
            i++;
            errors += '<br>Venue logo is missing.';
        }
        if($("#venue-main-img").val() === '') {
            i++;
            errors += '<br>Venue main image is missing.';
        }
    }
    $("#error-div").fadeOut(function() {
        $("#error-div").html(errors);
    });
    if (i === 0) {
        $("#buttonDiv img").show();
        document.forms['coolform'].submit();
    } 
    else {
//        for(var i = 0; i < err_fields.length; i++) {
//            var its_color = $('#' + err_fields[i]).css('backgroundColor');
//            console.log(its_color);
//            $('#' + err_fields[i]).css("background-color", "#FFAEAE");
//            console.log(its_color);
//        }
//        console.log(prev_err_fields);
//        console.log(err_fields);
//        for(var i = 0; i < err_fields.length; i++) {
//            $('input').each(function() {
//                console.log($(this).attr('id') + ' ' + err_fields[i]);
//                if($(this).attr('id') === err_fields[i]) {
//                    $(this).css("background-color", "#FFAEAE");
//                }
//                else {
//                    $(this).css("background-color", "white");
//                }
//            })
//            $('select').each(function() {
//                console.log($(this).attr('id') + ' ' + err_fields[i]);
//                if($(this).attr('id') === err_fields[i]) {
//                    $(this).css("background-color", "#FFAEAE");
//                }
//                else {
//                    $(this).css("background-color", "white");
//                }
//            })
//        }
        document.getElementById("head").scrollIntoView();
        $("#" + err_fields[0]).focus();
        $("#buttonDiv").show();
        $("#error-div").slideDown(150);
        
//        if(password_mismatch) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_top();
//            $("#mismatch-div").slideDown(150);
//        }
//        else if(invalid_score) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_top();
//            $("#inv-score-div").slideDown(150);
//        }
//        else if(invalid_desc) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_top();
//            $("#inv-desc-div").slideDown(150);
//        }
//        else if(short_desc) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_top();
//            $("#short-desc-div").slideDown(150);
//        }
//        else if(missing_offer) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#missing-offer").slideDown(150);
//        }
//        else if(missing_offer_title) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#missing-offerTitle").slideDown(150);
//        }
//        else if(invalid_offer_title) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#inv-offer-title").slideDown(150);
//        }
//        else if(missing_offer_desc) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#missing-offerDesc").slideDown(150);
//        }
//        else if(invalid_offer_desc) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#inv-offer-desc").slideDown(150);
//        }
//        else if(short_offer_desc) {
//            if(first_err_field !== null) first_err_field.focus();
//            $("#buttonDiv").show();
//            hide_irrelevant_mid();
//            $("#short-offer-desc").slideDown(150);
//        }
//        else {
//        }
    }
}
function saveEGXT(id_received) {
    $("#fault-msg").slideUp(500);
    $("#success-msg").slideUp(500);
    var i = 0;
    var err_fields = [];
    var errors = "<span>Please correct the following:</span>";
    if ($.trim($("#type").val()) == '') {
        i++;
        err_fields.push("type");
        errors += "<br>Transportation type is missing.";
    }
    else if ($.trim($("#type").val()) < 2) {
        i++;
        err_fields.push("type");
        errors += "<br>Transportation type is too short.";
    }
    else if (/\d/.test($.trim($("#type").val())) 
            && !(/\D/.test($.trim($("#username").val())))) {
        i++;
        err_fields.push("type");
        errors += "<br>Transportation type is invalid.";
    }
    if ($.trim($("#description").val()) == '') {
        i++;
        err_fields.push("description");
        errors += "<br>Description is missing.";
    }
    else if (/\d/.test($.trim($("#description").val())) 
            && !(/\D/.test($.trim($("#description").val())))) {
        i++;
        err_fields.push("description");
        errors += "<br>Description is invalid.";
    }
    else if (($.trim($("#description").val())).length < 15) {
        i++;
        err_fields.push("description");
        errors += "<br>Description is too short.";
    }
    if(id_received !== 1) {
        if($("#trans-img").val() === '') {
            i++;
            errors += '<br>Transportation image is missing.';
        }
    }
    $("#error-div").fadeOut(function() {
        $("#error-div").html(errors);
    });
    if (i === 0) {
        $("#buttonDiv img").show();
        document.forms['coolform'].submit();
    } 
    else {
        document.getElementById("head").scrollIntoView();
        $("#" + err_fields[0]).focus();
        $("#buttonDiv").show();
        $("#error-div").slideDown(150);
    }
    
}
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
function remove_venue_image(remove_image_page, image_id, image_file) {
    $.ajax({
        type: "POST",
        url: remove_image_page,
        data: {
            image_id: image_id,
            image_file: image_file,
        },
        success: function(data) {
            $("#" + image_id)
                    .slideUp(200)
                    .html('<input type="file" name="venue-imgs[]" id=i value="venue-img-" + i class="input-xlarge" />')
                    .slideDown(100);
        }
    });
}
function send_venue_id(id) {
    window.location.href = "http://localhost/elgouna/AdminControlArea/venues.php?vid=" 
            + id + "#myModal";
}
function d_venue(id) {
    if(id === "") {
        alert("Venue has no id.");
        return;
    }
    else {
        alert(id);
        $.ajax({
            type: "POST",
            url: "dVenue.php",
            data: {
                venue_id: id
            },
            success: function(data) {
                window.location.href = 
                        "http://localhost/elgouna/AdminControlArea/venues.php";
            }
        });
    }
}
//----------------------------------------------------------------------------------------

function saveResearchCov() {
    $("#fault-msg").slideUp(500);
    $("#success-msg").slideUp(500);
    var i = 0;
    $("#buttonDiv").hide();
    $("#loadiDiv").show();
    $("#error-div").slideUp(500);

    if ($.trim($("#name").val()) == '') {
        i++;
        document.getElementById("name").focus();
        $("#name").css("background-color", "#FFAEAE");

    }

    if (i == 0) {
        document.forms['coolform'].submit();

    } else {
        $("#buttonDiv").show();
        $("#loadiDiv").hide();
        $("#error-div").slideDown(500);

    }
}








function numbersonly(h, decimal) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    } else if (h) {
        key = h.which;
    } else {
        return true;
    }
    keychar = String.fromCharCode(key);

    if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
        return true;
    } else if ((("0123456789+., ").indexOf(keychar) > -1)) {
        return true;
    } else if (decimal && (keychar == ".")) {
        return true;
    } else
        return false;
}





function saveAccount() {
    $("#fault-msg").slideUp(500);
    $("#success-msg").slideUp(500);
    var i = 0;
    $("#buttonDiv").hide();
    $("#loadiDiv").show();
    $("#error-div").slideUp(500);





    if ($.trim(document.getElementById("aname").value) == '') {
        i++;
        document.getElementById("aname").focus();
    }

    if ($.trim(document.getElementById("ename").value) == '') {
        i++;
        document.getElementById("ename").focus();
    }
    if (i == 0) {
        document.forms['coolform'].submit();

    } else {
        $("#buttonDiv").show();
        $("#loadiDiv").hide();
        $("#error-div").slideDown(500);

    }
}


function ListFn(pgid, pg) {
    
    $("#dataList").html('<div id="logdingImg" style="text-align:center;"><img src="loading_circle.gif"></div>');
    $("#addingDiv").slideDown(200);
    if (window.XMLHttpRequest) {

        // code for I E7+, Firefox, Chrome, Opera, Safari
        xmlhttpTrack = new XMLHttpRequest();
    } 
    else {
        
        // code for IE6, IE5
        xmlhttpTrack = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpTrack.open("POST", pg, true); // may retuen cache result
    xmlhttpTrack.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "pgid=" + pgid;
    xmlhttpTrack.send(params);
    xmlhttpTrack.onreadystatechange = function () {
        
        if (xmlhttpTrack.readyState == 4 && xmlhttpTrack.status == 200) {

            $("#dataList").html(xmlhttpTrack.responseText);
        }
    }
}


function addNewItem(pg, pgid) {
//	alert(pgid);
    $("#dataList").html('<div id="logdingImg" style="text-align:center; "><img src="loading_circle.gif"></div>');
    $("#addingDiv").slideUp(200);
    $("#fault-msg").slideUp(200);
    $("#success-msg").slideUp(200);
    if (window.XMLHttpRequest) {

        // code for I E7+, Firefox, Chrome, Opera, Safari
        xmlhttpNewItem = new XMLHttpRequest();
    } 
    else {
        
        // code for IE6, IE5
        xmlhttpNewItem = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpNewItem.onreadystatechange = function () {
        
        if (xmlhttpNewItem.readyState == 4 && xmlhttpNewItem.status == 200) {

            $("#dataList").html(xmlhttpNewItem.responseText);
        }
    }
    xmlhttpNewItem.open("POST", pg, true); // may retuen cache result
    xmlhttpNewItem.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "pgid=" + pgid;
    xmlhttpNewItem.send(params);
}




function checkUsername(id) {
    document.getElementById("checkingUsrename").value = 0;
    $("#usernameValid").html('<img src="pleasewait.gif">');
    if (window.XMLHttpRequest)
    {

        // code for I E7+, Firefox, Chrome, Opera, Safari
        xmlhttpTrackcheck = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttpTrackcheck = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpTrackcheck.onreadystatechange = function ()
    {
        if (xmlhttpTrackcheck.readyState == 4 && xmlhttpTrackcheck.status == 200)
        {
            if (xmlhttpTrackcheck.responseText == 'ok') {
                $("#usernameValid").html('<span style="font-size:12px; color:#00791F;">Available</span>');
                document.getElementById("checkingUsrename").value = "1";
            } else {
                $("#usernameValid").html('<span style="font-size:12px; color:#FF4242">Not available</span>');
                document.getElementById("checkingUsrename").value = "2";
            }




        }
    }


    xmlhttpTrackcheck.open("POST", "checkUsername.php", true); // may retuen cache result
    xmlhttpTrackcheck.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var username = document.getElementById("username").value;
    var params = "id=" + id + "&username=" + username;
    xmlhttpTrackcheck.send(params);
}


function deleteItem(pg, id, pgid, funcId) {
    document.getElementById("pagename").value = pg;
    document.getElementById("rowId").value = id;
    document.getElementById("pgidNo").value = pgid;
    document.getElementById("funcId").value = funcId;
}

function deleteItem2(pg, id, pgid, funcId) {
    document.getElementById("pagename2").value = pg;
    document.getElementById("rowId2").value = id;
    document.getElementById("pgidNo2").value = pgid;
    document.getElementById("funcId2").value = funcId;
}


function confirmDelete(x) {
    $("#dataList").html('<div id="logdingImg" style="text-align:center;"><img src="loading_circle.gif"></div>');
    var pg = document.getElementById("pagename").value;
    var id = document.getElementById("rowId").value;
    var pgid = document.getElementById("pgidNo").value;
    var funcId = document.getElementById("funcId").value;
    if (window.XMLHttpRequest)
    {

        // code for I E7+, Firefox, Chrome, Opera, Safari
        xmlhttpdele = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttpdele = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpdele.onreadystatechange = function ()
    {
        if (xmlhttpdele.readyState == 4 && xmlhttpdele.status == 200)
        {


            if (funcId == 1) {
                ListFn(pgid, 'hotelsList.php');
            } else if (funcId == 2) {
                ListFn(pgid, 'hotelReviewsList.php?id=' + $("#clientsType").val());
            } else if (funcId == 3) {
                ListFn(pgid, 'beachesList.php');
            } else if (funcId == 4) {
                ListFn(pgid, 'beachReviewsList.php?id=' + $("#clientsType").val());
            } else if (funcId == 5) {
                ListFn(pgid, 'servicesList.php');
            }
        }
    }


    xmlhttpdele.open("POST", pg, true); // may retuen cache result
    xmlhttpdele.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "id=" + id;
    xmlhttpdele.send(params);
}



function confirmDelete2(x) {
    $("#dataList").html('<div id="logdingImg" style="text-align:center;"><img src="loading_circle.gif"></div>');
    var pg = document.getElementById("pagename2").value;
    var id = document.getElementById("rowId2").value;
    var pgid = document.getElementById("pgidNo2").value;
    var funcId = document.getElementById("funcId2").value;
    if (window.XMLHttpRequest)
    {

        // code for I E7+, Firefox, Chrome, Opera, Safari
        xmlhttpdele = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttpdele = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttpdele.onreadystatechange = function ()
    {
        if (xmlhttpdele.readyState == 4 && xmlhttpdele.status == 200)
        {


            if (funcId == 1) {
                ListFn(pgid, 'usedCarsNewList.php');
            }

        }
    }


    xmlhttpdele.open("POST", pg, true); // may retuen cache result
    xmlhttpdele.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var params = "id=" + id;
    xmlhttpdele.send(params);
}


function ChangeSetting() {

    $("#error_msg").slideUp();
    $("#loginButton").html('<img src="loading.gif">');
    var i = 0;
    if (document.getElementById('username').value == '' && $.trim(document.getElementById('username').value) == '') {
        i++;
    }

    if (document.getElementById('password').value == '' && $.trim(document.getElementById('password').value) == '') {
        i++;
    }
    if (i == 0) {
        if (window.XMLHttpRequest)
        {

            // code for I E7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {

                if (xmlhttp.responseText == 'ok') {
                    document.location.href = 'logout.php';
                } else {
                    $("#error_msg").slideDown(500);
                    $("#loginButton").html('<input value="Save" type="submit" onClick="ChangeSetting();" class="btn btn-primary pull-right">');
                }
            } else {

            }
        }


        xmlhttp.open("POST", "changeSetting.php", true); // may retuen cache result
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var x = document.getElementById("username").value;
        var y = document.getElementById("password").value;
        var params = "username=" + x + "&pass=" + y;
        xmlhttp.send(params);
    } else {
        $("#error_msg").slideDown(500);
        $("#loginButton").html('<input value="Save" type="submit" onClick="ChangeSetting();" class="btn btn-primary pull-right">');

    }

}