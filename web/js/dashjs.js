$('#toggle-left-menu').click(function() {
    if ($('#left-menu').hasClass('small-left-menu')) {
        $('#left-menu').removeClass('small-left-menu');
    } else {
        $('#left-menu').addClass('small-left-menu');
    }
    $('#logo').toggleClass('small-left-menu');
    $('#page-container').toggleClass('small-left-menu');
    $('#header .header-left').toggleClass('small-left-menu');

    $('#logo .big-logo').toggle('300');
    $('#logo .small-logo').toggle('300');
    $('#logo').toggleClass('p-0 pl-1');
});

$(document).ready(function() {
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
    });
});
$(document).ready(function() {
    $('#datepickers').datepicker({
        dateFormat: 'yy-mm-dd',
    });
});

$(document).on('mouseover', '#left-menu.small-left-menu > ul > li', function() {
    if (!$(this).hasClass('has-sub')) {
        var label = $(this).find('span').text();
        var position = $(this).position();
        $('#show-lable').css({
            'top': position.top + 79,
            'left': position.left + 59,
            'opacity': 1,
            'visibility': 'visible'
        });

        $('#show-lable').text(label);
    } else {
        var position = $(this).position();
        $(this).find('ul').addClass('open');

        if ($(this).find('ul').hasClass('open')) {
            const height = 47;
            var count_submenu_li = $(this).find('ul > li').length;
            if (position.top >= 580) {
                var style = {
                    'top': (position.top + 100) - (height * count_submenu_li),
                    'height': height * count_submenu_li + 'px'
                }
                $(this).find('ul.open').css(style);
            } else {
                var style = {
                    'top': position.top + 79,
                    'height': height * count_submenu_li + 'px'
                }

                $(this).find('ul.open').css(style);
            }

        }
    }

});

$(document).on('mouseout', '#left-menu.small-left-menu li a', function(e) {
    $('#show-lable').css({
        'opacity': 0,
        'visibility': 'hidden'
    });
});

$(document).on('mouseout', '#left-menu.small-left-menu li.has-sub', function(e) {
    $(this).find('ul').css({
        'height': 0,
    });
});

$(window).resize(function() {
    windowResize();
});

$(window).on('load', function() {
    windowResize();
});

$('#left-menu li.has-sub > a').click(function() {
    var _this = $(this).parent();

    _this.find('ul').toggleClass('open');
    $(this).closest('li').toggleClass('rotate');

    _this.closest('#left-menu').find('.open').not(_this.find('ul')).removeClass('open');
    _this.closest('#left-menu').find('.rotate').not($(this).closest('li')).removeClass('rotate');
    _this.closest('#left-menu').find('ul').css('height', 0);

    if (_this.find('ul').hasClass('open')) {
        const height = 47;
        var count_submenu_li = _this.find('ul > li').length;
        _this.find('ul').css('height', height * count_submenu_li + 'px');
    }
});


function windowResize() {
    var width = $(window).width();
    if (width <= 992) {
        $('#left-menu').addClass('small-left-menu');
        $('#logo').addClass('small-left-menu p-0 pl-1');
    } else {
        $('#left-menu').removeClass('small-left-menu');
        $('#logo').removeClass('small-left-menu p-0 pl-1');
    }
}

// Listen for changes in the site_visit dropdown
$('#site-visit-dropdown').on('change', function() {
    var selectedValue = $(this).val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 1) {
        $('#additional-form').show();
    } else {
        $('#additional-form').hide();
    }
});

// Check the initial value of the site_visit dropdown on page load
$(document).ready(function() {
    var selectedValue = $('#site-visit-dropdown').val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 1) {
        $('#additional-form').show();
    } else {
        $('#additional-form').hide();
    }
});

$(document).ready(function() {
    $('#assigned-to-dropdown').select2({
        placeholder: 'Assigned to',
        allowClear: true,
        closeOnSelect: false,
        templateResult: formatUser,
        templateSelection: formatUser,
    });
    
    function formatUser(user) {
        if (!user.id) {
            return user.text;
        }
        
        var checkbox = '<input type="checkbox" class="select2-checkbox" id="select2-assigned-to-' + user.id + '">';
        var username = user.text;
        
        return checkbox + ' ' + username;
    }
});

$('#tender-security-dropdown').on('change', function() {
    var selectedValue = $(this).val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 2) {
        $('#add-form').show();
    } else {
        $('#add-form').hide();
    }
});

// Check the initial value of the site_visit dropdown on page load
$(document).ready(function() {
    var selectedValue = $('#tender-security-dropdown').val();
    
    // Show or hide the additional form based on the selected value
    if (selectedValue == 2) {
        $('#add-form').show();
    } else {
        $('#add-form').hide();
    }
});

$(document).ready(function() {
    // Add icons to drop-down options
    $('#site-visit-dropdown option[value="1"]').prepend('<span class="fa fa-check-circle" style="color: blue;"></span> ');
    $('#site-visit-dropdown option[value="2"]').prepend('<span class="fa fa-times-circle" style="color: red;"></span> ');
    $('#site-visit-dropdown option[value=""]').prepend('<span class="fa fa-question-circle" style="color: gray;"></span> ');

    // Refresh the drop-down to apply the changes
    $('#site-visit-dropdown').selectpicker('refresh');
});



function updateProgressBar(percentage) {
    var progressBar = document.querySelector('.progress-bar');
    progressBar.style.width = percentage + '%';
    progressBar.textContent = percentage + '%';
}

function updateProgressMessage(message) {
    var progressMessage = document.querySelector('.progress-message');
    progressMessage.textContent = message;
}

function handleProgressUpdate(response) {
    var responseData = JSON.parse(response);

    var uploadedCount = responseData.uploadedCount;
    var totalCount = responseData.totalCount;
    var progressPercentage = responseData.progressPercentage;

    updateProgressBar(progressPercentage);

    if (progressPercentage === 100) {
        updateProgressMessage('Import complete.');
    } else {
        var message = 'Processed ' + uploadedCount + ' out of ' + totalCount + ' files.';
        updateProgressMessage(message);
    }
}

document.getElementById('progress-container').style.display = 'block';

// Poll the progress endpoint every 1 second
var progressInterval = setInterval(function () {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/analysis/create', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onload = function () {
        if (xhr.status === 200) {
            handleProgressUpdate(xhr.responseText);
        } else {
            console.error('Error: ' + xhr.status);
        }
    };

    xhr.send();
}, 1000);




assignActivity.forEach(function (activity) {
    if (activity.assign === 1) {
        var label = document.getElementById('label-' + activity.user_id);
        if (label) {
            label.classList.add('assigned-label');
        }
    }
});