/*!
 * Start Bootstrap - Creative Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

(function($) {
    "use strict"; // Start of use strict

    // jQuery for page scrolling feature - requires jQuery Easing plugin
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    // Highlight the top nav as scrolling occurs
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 51
    })

    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Fit Text Plugin for Main Header
    $("h1").fitText(
        1.2, {
            minFontSize: '35px',
            maxFontSize: '65px'
        }
    );

    // Offset for Main Navigation
    $('#mainNav').affix({
        offset: {
            top: 100
        }
    })

    // Initialize WOW.js Scrolling Animations
    new WOW().init();

})(jQuery); // End of use strict

function loadGraphs() {

        $.ajax({
            url: "api/41e34ea6-f6f5-47a9-8e00-8300f3d959bb/getReportingData",
            type: 'GET',
            dataType: "json",
            success: function (data) {
                if(data != null && data != ""  && data.length > 0)
                {
                    $(".graphContainer #spinner").hide();

                    for (var i = 0; i < data.length; i++)
                    {
                        $(".graphContainer").append('<div class="col-lg-4 graphSubContainer" id="question_'+data[i].questionId+'"></div>');
                        // console.log(data[i].data);
                        plotGraph(data[i].questionText, data[i].categories,data[i].data,"question_"+data[i].questionId);
                    }
                    $(".graphSubContainer").css("margin-bottom","5px");
                }else
                {
                    sweetAlertInitialize();
                    swal({
                        type: "error",
                        title: "Sorry Couldn't Load the live Results....",
                        confirmButtonClass:"btn-raised btn-danger",
                        confirmButtonText:"OK"
                    })
                }
            }
        });
}

function plotGraph(graphHeading, graphCategories, seriesData, graphId) {
    var chart = Highcharts.chart(graphId, {

        title: {
            text: graphHeading
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: graphCategories
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: seriesData,
            showInLegend: false
        }]

    });


    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });

}