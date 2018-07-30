/***************************************************************************/
        /* onready  */
/***************************************************************************/

$(document).ready(function() {
    "use strict";

    /***************************************************************************/
            /* NAVIGATION  */
    /***************************************************************************/

      $('.button-collapse').sideNav();

    /**************************************************************************
                 SKILL BAR
    **************************************************************************/

    $(".determinate").each(function(){
      var width = $(this).text();
      $(this).css("width", width)
        .empty()
        .append('<i class="fa fa-circle"></i>');
    });


    /**************************************************************************
             BLOG POST
    **************************************************************************/

    jQuery(window).on('load', function(){ var $ = jQuery;
        $('.blog').masonry({
          itemSelector: '.blog-post',
          columnWidth: '.blog-post',
          percentPosition: true
        });
    });


    var height = $('.caption').height();
        if($(window).width()){
          $('#featured').css('height', height);
          $('#featured img').css('height', height);
        }


    /*************************************************************************
                TOOLTIP
    **************************************************************************/
    $('.tooltipped').tooltip({delay: 50});

    /**************************************************************************
        WOW INIT
    **************************************************************************/

    var wow = new WOW({ mobile: false });
    wow.init();

    /***************************************************************************
          CONTACT FORM
    ***************************************************************************/

    $("#contactForm").validator().on("submit", function (event) {
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            formError();
            submitMSG(false, "Niet alles is (correct) ingevuld");
        } else {
            // everything looks good!
            event.preventDefault();
            submitForm();
        }
    });
    function submitForm(){
    // Initiate Variables With Form Content
        var name = $("#name").val();
        var email = $("#email").val();
        var message = $("#message").val();

        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "name=" + name + "&email=" + email + "&message=" + message,
            success : function(text){
                if (text == "success"){
                    formSuccess();
                } else {
                    formError();
                    submitMSG(false,text);
                }
            }
        });
    }
    function formSuccess(){
        $("#contactForm")[0].reset();
        submitMSG(true, "Uw bericht is verzonden!")
    }
    function formError(){
        $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
        function(){
            $(this).removeClass();
        });
    }
    function submitMSG(valid, msg){
        if(valid){
            var msgClasses = "h3 text-center fadeInUp animated text-success";
        } else {
            var msgClasses = "h3 text-center text-danger";
        }
        $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
    }

    /**************************************************************************
       Portfolio Projects
    **************************************************************************/
    $('#portfolio-item').mixItUp();

    $('.sa-view-portfolio-detail').on('click', function(event) {
        event.preventDefault();
        var href          = $(this).attr('href') + ' ' + $(this).attr('data-action'),
            dataShow      = $('#portfolio-gallery-view'),
            dataShowMeta  = $('#porfolio-gallery-view meta'),
            dataHide      = $('#portfolio-item'),
            preLoader     = $('#loader'),
            backBtn       = $('#back-button'),
            nextBtn       = $('#next-button'),
            filterBtn     = $('#filter-button');

        console.log(href);

        var lastPart = href.split(" ").pop();
        console.log(lastPart);

        var numberPart = lastPart.split("-").pop();
        console.log(numberPart);

        var numbers = ['one', 'two', 'three','four', 'five', 'six','seven', 'eight', 'nine', 'ten'];

        var nextNumbersIndex = numbers.indexOf(numberPart) + 1;
        console.log(nextNumbersIndex);

        var nextBtnValue = "#portfolio-" + numbers[nextNumbersIndex];
        $(nextBtn).attr('data-action', nextBtnValue);

        dataHide.animate( { 'marginLeft':'-120%' }, { duration: 400, queue: false } );
        filterBtn.animate( { 'marginLeft':'-120%' }, { duration: 400, queue: false } );
        dataHide.fadeOut(400);
        filterBtn.fadeOut(400);
        setTimeout( function() { preLoader.show(); }, 400);

        setTimeout( function() {
              $(lastPart).show();
              preLoader.hide();
              dataShow.fadeIn(600);
              backBtn.fadeIn(600);
              nextBtn.fadeIn(600);
        },800);
    });

    $('#back-button').on('click', function(event) {
        event.preventDefault();
        var dataShow    = $('#portfolio-item'),
            dataHide    = $('#portfolio-gallery-view'),
            nextBtn     = $('#next-button'),
            filterBtn   = $('#filter-button'),
            currentProject = $('.single-portfolio');
            // currentProjectObject = $(currentProject);

        console.log(dataHide);
        console.log(currentProject);
        // console.log(currentProjectObject);

        $("[data-animate]").each( function() {
            $(this).addClass($(this).attr('data-animate'));
        });

        currentProject.fadeOut(400);
        dataHide.fadeOut(400);
        $(this).fadeOut(400);
        nextBtn.fadeOut(400);
        setTimeout(function(){
            dataShow.animate( { 'marginLeft': '0' }, { duration: 400, queue: false } );
            filterBtn.animate( { 'marginLeft': '0' }, { duration: 400, queue: false } );
            dataShow.fadeIn(400);
            filterBtn.fadeIn(400);
        },400);
        setTimeout(function(){
            dataShow.find('.fadeInRight, .fadeInLeft, .fadeInUp, .fadeInDown').removeClass('fadeInRight').removeClass('fadeInLeft').removeClass('fadeInUp').removeClass('fadeInDown');
        },1500);
    });

});

$('#next-button').on('click', function(event) {
    event.preventDefault();
    var href          = $(this).attr('href') + ' ' + $(this).attr('data-action'),
        dataShow      = $('#portfolio-gallery-view'),
        dataShowMeta  = $('#porfolio-gallery-view meta'),
        dataHide      = $('#portfolio-item'),
        preLoader     = $('#loader'),
        backBtn       = $('#back-button'),
        nextBtn       = $('#next-button'),
        filterBtn     = $('#filter-button');

    var lastPart = href.split(" ").pop();
    var numberPart = lastPart.split("-").pop();
    var numbers = ['one', 'two', 'three','four', 'five', 'six','seven', 'eight', 'nine', 'ten'];
    var lastNumbersIndex = numbers.indexOf(numberPart) - 1;
    var lastProject = "#portfolio-" + numbers[lastNumbersIndex];
    var currentNumbersIndex = numbers.indexOf(numberPart);
    var currentProject = "#portfolio-" + numbers[currentNumbersIndex];
    var nextNumbersIndex = numbers.indexOf(numberPart) + 1;
    var nextBtnValue = "#portfolio-" + numbers[nextNumbersIndex];
    $(lastPart).hide();
    $(nextBtn).attr('data-action', nextBtnValue);

    console.log(lastProject);
    console.log(currentProject);
    console.log(nextBtnValue);
    $(lastProject).fadeOut(200);
    dataHide.fadeOut(400);
    filterBtn.fadeOut(400);
    setTimeout( function() { preLoader.show(); }, 200);
    setTimeout( function() {
          $(currentProject).fadeIn(600);
          preLoader.hide();
          dataShow.fadeIn(600);
          backBtn.fadeIn(600);
          nextBtn.fadeIn(600);
    },200);

});

/***************************************************************************/
        /* end onready  */
/***************************************************************************/

    /***************************************************************************
                MAP
    ***************************************************************************/

    google.maps.event.addDomListener(window, 'load', init);
    function init() {
        var mapOptions = {
          zoom: 4,
          scrollwheel: false,
          navigationControl: false,
          center: new google.maps.LatLng(52.6326865,4.7431724),
          styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},
          {"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},
          {"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},
          {"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},
          {"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},
          {"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},
          {"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},
          {"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},
          {"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},
          {"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},
          {"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},
          {"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},
          {"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
      };
      var mapElement = document.getElementById('map');
      var map = new google.maps.Map(mapElement, mapOptions);
      var marker = new google.maps.Marker({
          position: new google.maps.LatLng(52.6326865,4.7431724),
          map: map,
          title: 'Regio Alkmaar'
      });
    }

// hackermode easterEgg

var hackermodeSwitch = $('.hackerswitch');
hackermodeSwitch.hide();

function easterEgg(){
  hackermodeSwitch.show();
}

// end
// hackermode switch

function hackerMode() {
    document.body.className = 'hackermode';
}

function normalMode(){
  var consoleSetup = document.getElementsByClassName('console');
  document.body.className = '';
  consoleSetup[0].setAttribute('id', '');

}

$('#hackermode-input').change(function(){
  var consoleSetup = document.getElementsByClassName('console');
  if ($(this).prop('checked') == true) {
    consoleSetup[0].setAttribute('id', 'console');
    hackerConsole();
    hackerMode();
    $('body').css('background-image', 'url("/assets/images/hackermode/hackerback.gif")');
    $('aside .feature-img a').append('<img src="/assets/images/hackermode/hackerman.gif" class="responsive-img hackermodeimg" style="display:none;">');
  }
  else if ($(this).prop('checked') == false) {
    normalMode();
    $('body').css('background-image', 'inherit');
    $('aside .feature-img a .hackermodeimg').remove();
  }
});

// end
// hackermode console


function hackerConsole() {
  var intervalID = window.setInterval(updateScreen, 200);

  var c = document.getElementById("console");

  var txt = [
    "FORCE: XX0022. ENCYPT://000.222.2345",
    "TRYPASS: ********* AUTH CODE: ALPHA GAMMA: 1___ PRIORITY 1",
    "RETRY: REINDEER FLOTILLA",
    "Z:> /FALKEN/GAMES/TICTACTOE/ EXECUTE -PLAYERS 0",
    "================================================",
    "Priority 1 // local / scanning...",
    "scanning ports...",
    "BACKDOOR FOUND (23.45.23.12.00000000)",
    "BACKDOOR FOUND (13.66.23.12.00110000)",
    "BACKDOOR FOUND (13.66.23.12.00110044)",
    "...",
    "...",
    "BRUTE.EXE -r -z",
    "...locating vulnerabilities...",
    "...vulnerabilities found...",
    "MCP/> DEPLOY CLU",
    "SCAN: __ 0100.0000.0554.0080",
    "SCAN: __ 0020.0000.0553.0080",
    "SCAN: __ 0001.0000.0554.0550",
    "SCAN: __ 0012.0000.0553.0030",
    "SCAN: __ 0100.0000.0554.0080",
    "SCAN: __ 0020.0000.0553.0080",
  ]

  var docfrag = document.createDocumentFragment();

  function updateScreen() {
    //Shuffle the "txt" array
    txt.push(txt.shift());
    //Rebuild document fragment
    txt.forEach(function(e) {
      if ($('#console').length == 0) {
        return;
      }
      else {
        var p = document.createElement("p");
        p.textContent = e;
        docfrag.appendChild(p);
      }

    });
    //Clear DOM body
    while (c.firstChild) {
      c.removeChild(c.firstChild);
    }
    c.appendChild(docfrag);
  }
}

// end
