/* 	
	main.js : Placement des évènement sur le calendrier, gestion du rafraichissement de la zoneMessage
	
	Version : 1.0
	Date dernière modification : 18/01/2018

*/

$(function()
{

	this.timelineItems = $('.timeline li');
	this.timelineStart = getScheduleTimestamp(this.timelineItems.eq(0).text());
	this.timelineUnitDuration = getScheduleTimestamp(this.timelineItems.eq(1).text()) - this.timelineStart;
	// Récupération de la hauteur de la premiere ligne
	this.eventSlotHeight = this.timelineItems.eq(0).outerHeight();

	var self = this;

	// Pour chaque single-event, on calcul et on lui affecte sa position verticale et sa hauteur
	$('.events-group').each(function()
	{
		$(this).find(".single-event").each(function()
		{
				var start = getScheduleTimestamp($(this).attr('data-start'));
				var duration = getScheduleTimestamp($(this).attr('data-end')) - start;
				var eventTop = self.eventSlotHeight*(start - self.timelineStart)/self.timelineUnitDuration;
				var eventHeight = self.eventSlotHeight*duration/self.timelineUnitDuration;

				$(this).css({top: (eventTop) + 'px', height: (eventHeight + 1) - 4 + 'px'});
		});
	});

	// Paramétrage de la couleur des boutons
	/*
	var url = window.location.search.split('&');
	var annee = url[1].split('=')[1];
	var groupe = url[2].split('=')[1];
	var semaine = url[3].split('=')[1];
	if (annee == '1A') $(".boutonAnnee[annee='1A']").attr('status', 'actif');
	if (annee == '2A') $(".boutonAnnee[annee='2A']").attr('status', 'actif');
	if (annee == '3A') $(".boutonAnnee[annee='3A']").attr('status', 'actif');
	if (groupe == 'EII') $(".boutonGroupe[groupe='EII']").attr('status', 'actif');
	if (groupe == 'TIS') $(".boutonGroupe[groupe='TIS']").attr('status', 'actif');
	if (groupe == 'EII+TIS') {$(".boutonGroupe[groupe='TIS']").attr('status', 'actif'); $(".boutonGroupe[groupe='EII']").attr('status', 'actif'); }
*/
	function getScheduleTimestamp(time)
	{
		var timeArray = time.split(':');
		var timeStamp = parseInt(timeArray[0])*60 + parseInt(timeArray[1]);
		return timeStamp;
	}

});

// Auto refresh de la zoneMessage toute les 900 000 ms (15min)
var auto_refresh = setInterval(
	function ()
	{
		$('.zoneMessages').load('footer/footerMessages.php');
	}, 900000);


// Gestion des boutons
document.addEventListener('keydown', function(event)
{

	if(event.keyCode == 97) //1
	{
    window.location.replace(creationUrl('1A', ''));
	}

	if(event.keyCode == 98) //2
	{
		window.location.replace(creationUrl('2A', ''));
	}

	if(event.keyCode == 99) //3
	{
		window.location.replace(creationUrl('3A', ''));
	}

	if(event.keyCode == 100) //4
	{
		window.location.replace(creationUrl('', '+'));
	}

});

function creationUrl(param_annee, param_groupe)
{
	var url = window.location.search.split('&');
	var formation = url[0].split('=')[1];
	var annee = url[1].split('=')[1];
	var groupe = url[2].split('=')[1];
	var semaine = url[3].split('=')[1];

	if (param_annee == '')
		param_annee = annee;
	else
	{
		if (annee==param_annee)
		{
			if (semaine == '0') semaine = '1';
			else semaine = '0';
		}
		else semaine = 0;

	}

	if (param_groupe == '')
		param_groupe = groupe;
	else
	{
		if (groupe == 'EII')
			param_groupe = 'TIS';
		else if (groupe == 'TIS')
			param_groupe = 'EII+TIS';
		else if (groupe == 'EII+TIS')
			param_groupe = 'EII';
		else
			param_groupe = 'EII+TIS';
	}

	return 'main.php?formation=FIP&annee='+param_annee+'&groupe='+param_groupe+'&semaine='+semaine;
}
