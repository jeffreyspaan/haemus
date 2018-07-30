$(document).ready(function() {

	$('#imgMap').click(function(e) {
	    var offset = $(this).offset();
			var answer = document.getElementById('answer');
			if ( answer.style.display == 'none' ) {
				answer.style.display = 'block';
				this.style.filter = 'blur(2px)';
		    $("#answer").offset({left:e.pageX - 105,top:e.pageY - 83.8});
		    imgX = (e.pageX - offset.left);
		    imgY = (e.pageY - offset.top);
		    console.log(imgX+" "+imgY);
			} else {
				answer.style.display = 'none';
				this.style.filter = 'none';
			}
    });

  $('button').click(function(){
        whoGotClicked(this.id);
    })
});

function currentPageId(){
	var imagemap = document.getElementsByClassName('waar-is-jeffrey');
	var imagemapid = $(imagemap)[1].id;
	return imagemapid;
}

function goToNextQuestion(){
	var defaultWindowLocation = '/waar-is-jeffrey/';
	var currentPage = currentPageId();
	var nextPage = parseInt(currentPage) + 1;
	if (parseInt(currentPage) < 4	) {
		window.location.href = defaultWindowLocation + 'q' + nextPage;
	}
	else {
		alert('Het einde van het spel is bereikt.' + '\n' + '\n' + "Om afscheid te nemen is hier een couplet uit 'Afscheid nemen bestaat niet' " +'van Marco Borsato.' + '\n' + '\n' + "Ik ga wel weg maar verlaat je niet\n Lief, je moet me geloven\nAl doet het pijn...\n\nIk wil dat je me los laat\nEn dat je morgen weer verder gaat\nMaar als je eenzaam of bang bent\nZal ik er zijn..\n\nKom als de wind die je voelt en de regen\nVolg wat je doet als het licht van de maan\nZoek me in alles dan kom je me tegen\nFluister mijn naam,\nen ik kom eraan\n\nZie, wat onzichtbaar is\nWat je gelooft is waar\nOpen je ogen maar\nEn, dan zal ik bij je zijn\nAlles wat jij moet doen\nIs mij op m'n woord geloven\n\nAfscheid nemen bestaat niet");
		window.location = 'http://www.hanskazan.nl/';
	}
}

function goToPreviousQuestion(){
	var defaultWindowLocation = '/waar-is-jeffrey/';
	var currentPage = currentPageId();
	var previousPage = parseInt(currentPage) - 1;
	if (parseInt(currentPage) != 1) {
		window.location.href = defaultWindowLocation + 'q' + previousPage;
	}
	else {
		Materialize.toast('Dit is de eerste vraag van het spel.' + '\n' + 'Je kan niet verder terug.' , 6000);
	}
}

var hintDivJeffrey = $('#hintdivjeffrey');
var hintDivHans = $('#hintdivhans');

var answersJeffrey = $('#btnJeffrey');
var answersHans = $('#btnHanskazan');

hintDivJeffrey.hide();
hintDivHans.hide();

function showHint() {
	if ( answersJeffrey.css('display') === 'inline-block' ) {
		$('#hintdivjeffrey').fadeIn(400);
	}
	if ( answersHans.css('display') === 'inline-block' ) {
		$('#hintdivhans').fadeIn(400);
	}
}

var answers = [];

function whoGotClicked(who){
	var selected = {};
	who ===  'btnJeffrey' ? selected = jeffrey :
	who === 'btnHanskazan' ? selected = hanskazan :
	selected = cancel;
    //console.log("who got clicked?  " + selected.name);
	if (selected.name ===  'Cancel') {
		$('#answer').hide();
		document.getElementById('imgMap').style.filter = 'none';
	}
	else {
		if (imgX >= selected.x1 & imgX <= selected.x2 & imgY >= selected.y1 & imgY <= selected.y2){
			Materialize.toast('Gefeliciteerd je hebt ' + selected.name + ' gevonden!' , 6000);
			answers.push(selected.name);
			$('#hintdiv' + selected.name).hide();
		  $('#' + who).hide();
			$('#answer').hide();
			document.getElementById('imgMap').style.filter = 'none';
			if (answers.length == 2 ) {
				goToNextQuestion();
			}
		}
		else {
			Materialize.toast('Helaas dit is niet ' + selected.name , 6000);
			$('#answer').hide();
			document.getElementById('imgMap').style.filter = 'none';
		}
	}
}
