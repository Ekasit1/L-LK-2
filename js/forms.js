function blogpost(o) {
	var inputs = document.getElementsByClassName("modal-inputs");
	for (var index in inputs) {
		if (inputs[index].value == "") {
			event.preventDefault();
			return false;
		};
	};	
}

