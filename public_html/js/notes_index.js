function create_notes_html(dict) {
	var note_html = "<div class='notes-indiv-container'>";
	note_html += "<a href='" + dict.URL + "'><h3 class='notes-title'>" + dict.Title + "</h3></a>\n";
	note_html += "<p class='notes-author'>" + dict.Author + "</p><p class='notes-time'>" + dict.Date + "</p>\n";
	note_html += "<p class='notes-desc'>" + dict.Content + "</p>\n";
	note_html += "<a class='read-article' href='" + dict.URL + "'>Read Notes</a>\n";
	note_html += "</div>";
	return note_html;
}

$(function(){
	var html_insert = '';
	for (const i in notes_list.slice(0, 5)) {
		html_insert += create_notes_html(notes_list[i]) + '\n';
	}
	$('#main-content h2').after(html_insert);
});