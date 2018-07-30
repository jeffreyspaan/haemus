var valResponseFalse = $('#falsecheck');
var valResponseTrue = $('#truecheck');

$(document).ready(function(){
  valResponseFalse.hide();
  valResponseTrue.hide();
})

function resolutionVal() {
  var windowWidth = $(window).width();
  if ( windowWidth > 1450 ) {
    valResponseTrue.show();
    valResponseFalse.hide();
  } else {
    valResponseFalse.show();
    valResponseTrue.hide();
  }
}

$(document).ready(resolutionVal);

window.onresize = resolutionVal;
