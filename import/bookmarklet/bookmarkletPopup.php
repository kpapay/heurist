<?php

/*<!--
 * filename, brief description, date of creation, by whom
 * @copyright (C) 2005-2010 University of Sydney Digital Innovation Unit.
 * @link: http://HeuristScholar.org
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package Heurist academic knowledge management system
 * @todo
 -->*/

	header('Content-type: text/javascript');
	require_once(dirname(__FILE__)."/../../common/config/initialise.php");
?>
var Heurist = {

w: 370,
h: 240,

uriBase: "<?= HEURIST_BASE_URL ?>",
uriHost: "http://<?= HEURIST_HOST_NAME ?>/",
database:"<?=HEURIST_DBNAME?>",
init: function () {
	// toggle display if our div is already present in the DOM
	var e = document.getElementById('__heurist_bookmarklet_div');
	if (e) {
		if (e.style.display == 'none') {
			e.style.display = 'block';
			e.style.left = '30px';
			e.style.top = '30px';
			if (document.all) {
				e.style.left = (document.body.scrollLeft + 30) + 'px';
				e.style.top = (document.body.scrollTop + 30) + 'px';
				if (document.body.scrollLeft == 0  &&  document.body.scrollTop == 0) window.scrollTo(0, 0);
			}
		}
		else
			Heurist.close();
		return;
	}

	// add our style sheet
	var link = document.createElement('link');
	link.rel = 'stylesheet';
	link.type = 'text/css';
	link.href = Heurist.uriBase +'common/css/bookmarklet-popup.css';
	document.getElementsByTagName('head')[0].appendChild(link);

	// get record types
	var scr = document.createElement('script');
	scr.type = 'text/javascript';
	scr.src = Heurist.uriBase +'import/bookmarklet/getRectypesAsJSON.php?db=' + Heurist.database;
	document.getElementsByTagName('head')[0].appendChild(scr);

	// get bkmk id if already bookmarked
	scr = document.createElement('script');
	scr.type = 'text/javascript';
	scr.src = Heurist.uriBase +'import/bookmarklet/getRecordIDFromURL.php?db='+Heurist.database+'&url=' + Heurist.urlcleaner(encodeURIComponent(location.href));
	document.getElementsByTagName('head')[0].appendChild(scr);
},

render: function() {
	// create the div
	var d = document.createElement('div');
	d.className = 'heurist';
	d.id = '__heurist_bookmarklet_div';
	d.style.left = '30px';
	d.style.top = '30px';
	if (document.all) {
		d.style.left = (document.body.scrollLeft + 30) + 'px';
		d.style.top = (document.body.scrollTop + 30) + 'px';
	}


	// create a header bar
	var hdr = document.createElement('div');
	hdr.className = 'bookmarklet_header';
	hdr.onmousedown = Heurist.dragStart;
	d.appendChild(hdr);

	// 'close' button
	var s = document.createElement('div');
	s.className = 'bookmarklet_close';
	s.onclick = Heurist.close;
	hdr.appendChild(s);

	// heurist home page link
	var a = document.createElement('a');
	a.href = Heurist.uriBase;
	if (document.all) {
		i = document.createElement('img');
		i.src = Heurist.uriBase +'common/images/H3-favicon.png';
		a.appendChild(i);
	}
	else
	a.innerHTML = '<img src="'+ Heurist.uriBase +'common/images/H3-favicon.png">';
	a.className='imglnk';
	hdr.appendChild(a);
	s = document.createTextNode('Heurist bookmarklet');
	hdr.appendChild(s);


	// heurist bookmarklet
	var dd = document.createElement("div");
	dd.id = "topline";
	dd.innerHTML = (! HEURIST_url_bib_id ? "Add this page as:" : "");
	d.appendChild(dd);

	var t = d.appendChild(document.createElement("table"));
	t.style.margin = "0";
	t.style.width = "100%";

	var tr = t.appendChild(document.createElement("tr"));
	var td = tr.appendChild(document.createElement("td"));

	if (HEURIST_url_bkmk_id) {
		var nobr = td.appendChild(document.createElement("nobr"));
		nobr.appendChild(document.createTextNode("Page already in Heurist"));
		nobr.style.color = "green";
		td = tr.appendChild(document.createElement("td"));

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		nobr = td.appendChild(document.createElement("nobr"));
		nobr.appendChild(document.createTextNode("Bookmarked by you"));
		nobr.style.color = "green";

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		td.colSpan = "2";
		td.style.textAlign = "right";

		a = td.appendChild(document.createElement("a"));
		a.target = "_blank";
		a.href= Heurist.uriBase +'records/edit/editRecord.html?db='+Heurist.database+'&bkmk_id=' + HEURIST_url_bkmk_id;
		a.onclick = function() { Heurist.close() };
		a.innerHTML = "edit record";

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		td.colSpan = "2";
		td.style.height = "10px";

	} else if (HEURIST_url_bib_id) {
		var nobr = td.appendChild(document.createElement("nobr"));
		nobr.appendChild(document.createTextNode("Page already in Heurist"));
		nobr.style.color = "green";
		td = tr.appendChild(document.createElement("td"));

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		nobr = td.appendChild(document.createElement("nobr"));
		nobr.appendChild(document.createTextNode("Not yet bookmarked by you"));
		nobr.style.color = "red";

		td = tr.appendChild(document.createElement("td"));
		var button = document.createElement("input");
			button.type = "button";
			button.value = "Bookmark Record";
			button.onclick = function() {
				Heurist.bookmark();
			};
		td.appendChild(button);

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		td.colSpan = "2";
		td.style.height = "30px";

	} else {
		// specify rectype
		td.appendChild(Heurist.renderrectypeSelect());

		td = tr.appendChild(document.createElement("td"));
		var button = document.createElement("input");
		button.id = "add-as-type-button";
		button.type = "button";
		button.value = "Add";
		button.disabled = true;
		button.onclick = function() {
			var r = document.getElementById("rectype-select").value;
			if (r) Heurist.bookmark(r);
		};
		td.appendChild(button);

		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		td.colSpan = "2";
		td.style.height = "20px";

		// add as internet bookmark
		tr = t.appendChild(document.createElement("tr"));
		td = tr.appendChild(document.createElement("td"));
		td.innerHTML = "Quick add (generic bookmark)";
		td = tr.appendChild(document.createElement("td"));
		button = document.createElement("input");
		button.type = "button";
		button.value = "Add";
		button.onclick = function() { Heurist.bookmark(); };
		td.appendChild(button);
	}

	// link importer
	var nobr = d.appendChild(document.createElement("div"));
	nobr.innerHTML = "Import links from this page";
	nobr.className = "bookmarklet_link_importer";
	var button = document.createElement("input");
	button.type = "button";
	button.value = "Get";
	button.style.marginLeft = "5px";
	button.onclick = function() {
		Heurist.close();
		var w = open(Heurist.uriBase +'import/hyperlinks/importHyperlinks.php?db='+Heurist.database+'&shortcut=' + encodeURIComponent(location.href));
		void(window.setTimeout("w.focus()",200));
		return false;
	}
	nobr.appendChild(button);

	// add our div to the document tree
	if (document.all)
		document.documentElement.childNodes[1].appendChild(d);
	else
		document.documentElement.appendChild(d);

	d.style.display = 'block';

	// IE doesn't understand position: fixed
	if (document.all) {
		d.style.position = 'absolute';
		// window.scrollTo(0,0);
		if (document.body.scrollLeft == 0  &&  document.body.scrollTop == 0) window.scrollTo(0, 0);
			// some sites have weird stuff going on that breaks scroll{Left,Top}
	}
	else {
		d.style.position = 'fixed';
	}
},

close: function () {
	Heurist.fade();
},

fade: function() {
	var e = document.getElementById('__heurist_bookmarklet_div');

	if (e.filters) {
		var o = parseInt(e.filters.alpha.opacity) - 10;
		e.filters.alpha.opacity = o;
	} else {
		var o = parseFloat(e.style.opacity) - 0.1;
		e.style.opacity = o;
	}
	if (o > 0)
		setTimeout(Heurist.fade,50);
	else {
		e.style.display = 'none';
		e.style.opacity = '1.0';
		if (e.filters) e.filters.alpha.opacity = 100;
	}
},

dragStart: function(e) {
	var d = document.getElementById('__heurist_bookmarklet_div');
	if (d.filters) d.filters.alpha.opacity = 75;
	else d.style.opacity = 0.75;
	window.startDragCoords = Heurist.getCoords(e);
	window.startDragPos = { left: parseInt(d.style.left), top: parseInt(d.style.top) };
	document.onmousemove = Heurist.dragMid;
	document.onmouseup = Heurist.dragEnd;
	document.onmousedown = null;
	return false;
},

dragMid: function(e) {
	var d = document.getElementById('__heurist_bookmarklet_div');
	var coords = Heurist.getCoords(e);
	d.style.left = (window.startDragPos.left + (coords.x - window.startDragCoords.x)) + 'px';
	d.style.top = (window.startDragPos.top + (coords.y - window.startDragCoords.y)) + 'px';
	return false;
},

dragEnd: function(e) {
	var d = document.getElementById('__heurist_bookmarklet_div');
	Heurist.dragMid(e);
	if (d.filters) d.filters.alpha.opacity = '100';
	else d.style.opacity = '1.0';
	document.onmouseup = null;
	document.onmousemove = null;
	return true;
},

getCoords: function(e) {
	if (! e) e = event;
	var pos = new Object();
	pos.x = 0;
	pos.y = 0;
	if (e.pageX  ||  e.pageY) {
		pos.x = e.pageX;
		pos.y = e.pageY;
	} else if (e.clientX  ||  e.clientY) {
		pos.x = e.clientX + document.body.scrollLeft;
		pos.y = e.clientY + document.body.scrollTop;
	}

	return pos;
},

urlcleaner: function(x) { return x.replace(/.C2.A0/gi,'\032'); },

findFavicon: function() {
	try {
		var links = document.getElementsByTagName("link");
		for (var i=0; i < links.length; ++i) {
			var rel = (links[i].rel + "").toLowerCase();
			if ((rel === "shortcut icon" || rel === "icon")  &&  links[i].href) {
				if (links[i].href.match(/^http:/)) {	// absolute href
					return links[i].href;
				}
				else if (links[i].href.match(/^\//)) {	// absolute path on server
					return document.location.href.replace(/(^.......[^\/]*\/?).*/, "$1" + links[i].href);
				}
				else {	// relative path ... ummm ... take a stab
					return document.location.href.replace(/[^\//]*$/, links[i].href);
				}
			}
		}
	} catch (e) { }
	return "";
},

bookmark: function(rectype) {
	Heurist.close();
	var version='20060713';
	var findSelection = function(w) {
		try {
			return w.document.selection ? w.document.selection.createRange().text : (w.getSelection()+'');
		} catch (e) {
			return '';
		}
	};
	var url = location.href;
	var titl = document.title;
	var sel = findSelection(window);
	if (! sel  &&  frames) {
		for (i=0; i < frames.length; ++i) {
			sel = findSelection(frames[i]);
			if (sel) break;
		}
	}
	var favicon = Heurist.findFavicon();

	var w = open(Heurist.uriBase +'records/add/addRecord.php?db='+Heurist.database+'&t=' + Heurist.urlcleaner(encodeURIComponent(titl)) +
				 '&u=' + Heurist.urlcleaner(encodeURIComponent(url)) +
				 (sel?('&d=' + Heurist.urlcleaner(encodeURIComponent(sel))) : '') +
				 (favicon? ('&f=' + encodeURIComponent(favicon)) : '') +
				 (rectype ? '&bib_rectype=' + rectype : '') +
				 '&version=' + version);
	void(window.setTimeout('w.focus()',200));
},


renderrectypeSelect: function(sel) {
	var sel = document.createElement('select');
	var i,grpID;
	sel.id = 'rectype-select';
	sel.onchange = function() {
		document.getElementById("add-as-type-button").disabled = ! this.value;
	};
	sel.options[0] = new Option('Select type...', '');
	sel.options[0].selected = true;
	sel.options[0].disabled = true;

	for (grpID in HEURIST_rectypes.groups){
	var grp = document.createElement("optgroup");
		grp.label = HEURIST_rectypes.groups[grpID].name;
	sel.appendChild(grp);
		for (i in HEURIST_rectypes.groups[grpID].types) {
			var name = HEURIST_rectypes.names[i];
			sel.appendChild( new Option(name, i));
	}
	}
	return sel;
}

};

var HEURIST_rectypesOnload = function() {
	Heurist.rectypesLoaded = true;
	if (Heurist.rectypesLoaded  &&  Heurist.urlBookmarkedLoaded)
		Heurist.render();
};

var HEURIST_urlBookmarkedOnload = function() {
	Heurist.urlBookmarkedLoaded = true;
	if (Heurist.rectypesLoaded  &&  Heurist.urlBookmarkedLoaded)
		Heurist.render();
};

Heurist.init();

