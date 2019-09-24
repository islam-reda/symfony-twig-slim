/*global $, jQuery, alert, document, window, setTimeout*/
/*jslint plusplus: true */

$(document).ready(function () {
    'use strict';

    // Search input
    $("#search").on('click', function (e) {
        e.stopPropagation();
        $(".header .text-field label").css("display", "none");
    });
    $("#sfriends").on('click', function (e) {
        e.stopPropagation();
        $(".dashboard .sidebar label").css("display", "none");
    });
    
    // State - Massege
    $(".header .state").on('click', function () {
        var icon = $(".state svg");
        if (!($(this).hasClass("clicked"))) {
            $(this).addClass("clicked");
            $(".header .user-img").append("<span class='state-msg'></span>");
        }
        $(this).toggleClass("offline");
        if (!(icon.hasClass("fa-user-times"))) {
            icon.removeClass("fa-user").addClass("fa-user-times");
            var message = $(".state-msg");
            message.text("I am Coming Soon!");
            message.removeClass("online");
            message.removeClass("online-arrow");
            message.css({"display" : "block", "top" : "40px", "opacity" : "0"});
            msgAnimation(message, 1, "63px", 1800);
        } else {
            icon.removeClass("fa-user-times").addClass("fa-user");
            var message = $(".state-msg");
            message.addClass("online");
            message.addClass("online-arrow");
            message.text("I am Back!");
            message.css({"display" : "block", "top" : "40px", "opacity" : "0"});
            msgAnimation(message, 1, "63px", 2000); 
        }
    });
    
    // Nottification Number
    notiNum(3, "header", "notification-container", "header", "notification", "noti-num");
    // Notification
    $(".header .notification-container .icon, .header .noti-num").on('click', function (e) {
        e.stopPropagation();
        var notiNumContainer = $(".header .noti-num"),
            notification = $(".header .notification"),
            bell = $(".header .notification-container .icon"),
            dropDown = $(".header .notification-dropdown"),
            msgIcon = $(".header .msg-container .icon"),
            msgDropDown = $(".header .msg-dropdown"),
            userName = $(".header .user-name"),
            userDropdown = $(".header .user-dropdown");
        if (msgIcon.hasClass("clicked")) {
            msgIcon.removeClass("clicked");
            dropDownAnimation(msgDropDown, 0, "45px", "none");
        } else if (userName.hasClass("clicked")) {
            userName.removeClass("clicked");
            dropDownAnimation(userDropdown, 0, "58px", "none");
        }
        notiNumContainer.remove();
        if (notification.hasClass("new")) {
            $(".header .body .new").addClass("new-effect");
            notification.removeClass("new");
        } else {
            notification.removeClass("new-effect");
        }
        if (!(bell.hasClass("clicked"))) {
            bell.addClass("clicked");
            dropDown.css("display", "block");
            dropDownAnimation(dropDown, 1, "-5px", "block");
        } else {
            bell.removeClass("clicked");
            dropDownAnimation(dropDown, 0, "5px", "none");
        }
        dropDown.on('click', function (e) {
            e.stopPropagation();
        });
    });
    
    // Messages Number
    notiNum(2, "header", "msg-container", "header", "message", "msg-num");
    // Messages
    $(".header .msg-container .icon, .header .msg-num").on('click', function (e) {
        e.stopPropagation();
        var msgNumContainer = $(".header .msg-num"),
            message = $(".header .message"),
            msgIcon = $(".header .msg-container .icon"),
            dropDown = $(".header .msg-dropdown"),
            bell = $(".header .notification-container .icon"),
            notiDropDown = $(".header .notification-dropdown"),
            userName = $(".header .user-name"),
            userDropdown = $(".header .user-dropdown");
        if (bell.hasClass("clicked")) {
            bell.removeClass("clicked");
            dropDownAnimation(notiDropDown, 0, "5px", "none");
        } else if (userName.hasClass("clicked")) {
            userName.removeClass("clicked");
            dropDownAnimation(userDropdown, 0, "58px", "none");
        }
        msgNumContainer.remove();
        if (message.hasClass("new")) {
            $(".header .msg-body .new").addClass("new-effect");
            message.removeClass("new");
        } else {
            message.removeClass("new-effect");
        }
        if (!(msgIcon.hasClass("clicked"))) {
            msgIcon.addClass("clicked");
            dropDown.css("display", "flex");
            dropDownAnimation(dropDown, 1, "35px", "flex");
        } else {
            msgIcon.removeClass("clicked");
            
            dropDownAnimation(dropDown, 0, "45px", "none");
        }
        dropDown.on('click', function (e) {
            e.stopPropagation();
        });
    });
    
    // User Dropdown
    $(".header .user-name").on('click', function(e) {
        e.stopPropagation();
        var userName = $(".header .user-name"),
            userDropdown = $(".header .user-dropdown"),
            bell = $(".header .notification-container .icon"),
            notiDropDown = $(".header .notification-dropdown"),
            msgIcon = $(".header .msg-container .icon"),
            msgDropDown = $(".header .msg-dropdown");
        if (msgIcon.hasClass("clicked")) {
            msgIcon.removeClass("clicked");
            dropDownAnimation(msgDropDown, 0, "45px", "none");
        } else if (bell.hasClass("clicked")) {
            bell.removeClass("clicked");
            dropDownAnimation(notiDropDown, 0, "5px", "none");
        }
        if (!(userName.hasClass("clicked"))) {
            $(this).addClass("clicked");
            userDropdown.css("display", "block");
            dropDownAnimation(userDropdown, 1, "48px", "block");
        } else {
            $(this).removeClass("clicked");
            dropDownAnimation(userDropdown, 0, "58px", "none");
        }
        userDropdown.on('click', function(e) {
            e.stopPropagation();
        });
    });
    
    // Report type
    $(".report-type .report:first p").addClass("clicked").prev(".icon").css("color", "#4bc5c3");
    $(".chart-content .report1").addClass("show");
        report1Chart();
    $(".report-type p").on('click', function() {
        $(".report-type p").removeClass("clicked").prev(".icon").css("color", "#f8f3f0");
        $(this).addClass("clicked").prev(".icon").css("color", "#4bc5c3");
        
        // Switch report
        if ($(".report-type .report:nth-child(1) p").hasClass("clicked")) {
            $(".chart-content .report1").addClass("show");
            $(".chart-content .report1").css({"display" : "block", "left" : "-575px", "opacity" : "0"});
            $(".chart-content .report1").animate({
                left: "0px",
                opacity: 1
            }, 450, function() {
                report1Chart();
            });
            
            if ($(".chart-content .report2, .chart-content .report3").hasClass("show")) {
                $(".chart-content .report2, .chart-content .report3").removeClass("show");
                $(".chart-content .report2, .chart-content .report3").animate({
                    left: "575px",
                    opacity: 0
                }, 450, function() {
                    $(".chart-content .report2, .chart-content .report3").css("display", "none")
                });
            }
            
        } else if ($(".report-type .report:nth-child(2) p").hasClass("clicked")) {
            $(".chart-content .report2").addClass("show");
            if ($(".chart-content .report1").hasClass("show")) {
                $(".chart-content .report1").removeClass("show")
                $(".chart-content .report2").css({"display" : "block", "left" : "575px", "opacity" : "0"});
                $(".chart-content .report2").animate({
                    left: 0,
                    opacity: 1
                }, 450, function() {
                    report2Stats();
                });
                
                $(".chart-content .report1").animate({
                    left: "-575px",
                    opacity: 0
                }, 450, function() {
                    $(".chart-content .report1").css("display", "none")
                });
                
            } else if ($(".chart-content .report3").hasClass("show")) {
                $(".chart-content .report3").removeClass("show");
                $(".chart-content .report2").css({"display" : "block", "left" : "-575px", "opacity" : "0"});
                $(".chart-content .report2").animate({
                    left: 0,
                    opacity: 1
                }, 450, function() {
                    report2Stats();
                });
                
                $(".chart-content .report3").animate({
                    left: "575px",
                    opacity: 0
                }, 450, function() {
                    $(".chart-content .report3").css("display", "none")
                });
                
            }
        } else if($(".report-type .report:nth-child(3) p").hasClass("clicked")) {
            console.log("yes");
            $(".chart-content .report3").addClass("show");
            if ($(".chart-content .report1, .chart-content .report2").hasClass("show")) {
                $(".chart-content .report3").css({"display" : "block", "left" : "575px", "opacity" : "0"});
                $(".chart-content .report3").animate({
                    left: 0,
                    opacity: 1
                }, 450);
                
                if ($(".chart-content .report1, .chart-content .report2").hasClass("show")) {
                    $(".chart-content .report1, .chart-content .report2").removeClass("show");
                    $(".chart-content .report1, .chart-content .report2").animate({
                        left: "-575px",
                        opacity: 0
                    }, 450, function() {
                        $(".chart-content .report1, .chart-content .report2").css("display", "none")
                    });
                }
            }
        }
    });
    

    
    
    
    $("body").on('click', function () {
        var bell = $(".header .notification-container .icon"),
            notiDropDown = $(".header .notification-dropdown"),
            msgIcon = $(".header .msg-container .icon"),
            msgDropDown = $(".header .msg-dropdown"),
            userName = $(".header .user-name"),
            userDropdown = $(".header .user-dropdown");
        // Search
        if ($("#search").val() === "") {
            $(".header .text-field label").css("display", "block");
        }
        if ($("#sfriends").val() === "") {
            $(".dashboard .sidebar label").css("display", "block");
        }
        // Notification
        if (bell.hasClass("clicked")) {
            bell.removeClass("clicked");
            dropDownAnimation(notiDropDown, 0, "5px", "none");
        }
        // Messages
        if (msgIcon.hasClass("clicked")) {
            msgIcon.removeClass("clicked");
            dropDownAnimation(msgDropDown, 0, "45px", "none"); 
        }
        // User Dropdown
        if (userName.hasClass("clicked")) {
            userName.removeClass("clicked")
            dropDownAnimation(userDropdown, 0, "58px", "none");
        }
    });
    
});

// Notification Number
function notiNum (num, first, second, first2, second2, notiName) {
    'use strict';
    $("." + first + " ." + second).append("<span class='" + notiName + "'>" + num + "</span>");
    for (var i = 1; i <= num; i++) {
        $("." + first2 + " ." + second2 + ":nth-child(" + i + ")").addClass("new");
    }
}

// dropDown animation function
function dropDownAnimation (menu, opacityNum, topNum, state) {
    menu.animate({
        opacity: ("" + opacityNum),
        top: ("" + topNum)
    }, 300, function () {
        menu.css("display", ("" + state));
    });
}

// quick fade message animation function
function msgAnimation (msg, opacityNum, topNum, fadeNum) {
    msg.animate({
        opacity: ("" + opacityNum),
        top: ("" + topNum)
    }, 450, function() {
        $(this).fadeOut(fadeNum);
    });
}

// Chart report1
function report1Chart() {
    "use strict";
    var ctx = document.getElementById("report1-canvas");
    ctx.width = ctx.clientWidth;
    ctx.height = ctx.clientHeight;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels : ["SUN","MON","TUE","WED","THU","FRI","SAT"],
            datasets: [{
                data : [2,4.5,6,10.95,7.5,5,7],
                backgroundColor: ['rgba(255, 178, 48, 0.2)'],
                borderColor: ['rgba(255,178,48,1)'],
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255,178,48,1)',
                pointBorderColor: 'rgba(255,178,48,1)',
                pointHoverRadius: 5
            }],
        },
        options: {
            responsive: true,
            radius: 3,

            scales: {
                xAxes: [{
                    display: true
                }],
                yAxes: [{
                    display: false,
                     ticks: {
                        max: 12
                    }
                }],
                ticks: [{
                    fontcolor: 'f0ff00'
                }],
                
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: 'rgba(138, 147, 165, 0.8)',
                callbacks: {
                    labelColor: function(tooltipItem, chart) {
                    return {
                        borderColor: 'rgba(138, 147, 165, 0.8)',
                        backgroundColor: 'rgba(255, 178, 48, 0.2)'
                    }
                },
                    labelTextColor:function(tooltipItem, chart){
                        return '#fff';
                    },
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += Math.round(tooltipItem.yLabel * 100) / 100;
                        return label + " %";
                    }
                }
            }
        }
    });
}

// Stats report2
function report2Stats() {
    "use strict";
    var ctx = document.getElementById("report2-canvas");
    ctx.width = ctx.clientWidth;
    ctx.height = ctx.clientHeight;
    
    new Chart(ctx, {
        type: "pie",
        data: {
            labels: ["Uncompleted courses", "Failed courses", "Attend courses", "Successful courses"],
            datasets: [{
                data: [10,15,45,30],
                backgroundColor:  [
                    "#4c4743",
                    "#c3a279",
                    "#ffb230",
                    "#ed6c44"
                ]
            }],
        },
        options: {
            legend: {
                display: true,
                position: "left",
                labels: {
                    boxWidth: 10,
                    padding: 10
                }
            }
        }
    });
}


$("body").niceScroll({
    cursorcolor: "rgb(237, 108, 68)",
    cursorborder: "none",
    cursoropacitymin: "1",
    cursorborderradius: "0",
    background: "#4c4743",
    zindex: "99999"
});

$(".dashboard .people-container").niceScroll({
    cursorcolor: "#dddddd",
    cursorborder: "none",
    zindex: "99999"
});