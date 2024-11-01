let all_tarot_campaigns = document.querySelectorAll('input[name="campaign-question"]');
if (all_tarot_campaigns !== null) {
	all_tarot_campaigns.forEach((element_tarot) => {
		element_tarot.addEventListener("keypress", function (e) {
			if (element_tarot.value.length < 10) {
				let keycode = e.code ? e.code : e.key;
				if (keycode.toLowerCase() == "enter") {
					e.preventDefault();
					return;
				}
			}
			if (element_tarot.value.length > 0) {
				let enteredValue = e.key;
				let enteredValueCode = e.code;
				let lastEnteredValue = element_tarot.value.slice(-1);
				let lastBeforeValue = element_tarot.value.slice(-2, -1);
				if (enteredValue == lastEnteredValue && enteredValue == lastBeforeValue && enteredValueCode.toLowerCase() == "space" && lastEnteredValue == " ") {
					e.preventDefault();
				}
			}
		});
		element_tarot.addEventListener("keyup", function (e) {
			if (element_tarot.value.length >= 10) {
				let submit_question_input = document.querySelectorAll('input[name="submit"]');
				if (submit_question_input !== null) {
					submit_question_input.forEach((element_submit) => {
						element_submit.removeAttribute("disabled");
					});
				}
			} else {
				let submit_question_input = document.querySelectorAll('input[name="submit"]');
				if (submit_question_input !== null) {
					submit_question_input.forEach((element_submit) => {
						element_submit.setAttribute("disabled", "");
					});
				}
			}
		});
	});
}

function setActive() {
  document.querySelectorAll('.tarot-online .logo .brand').forEach((result) => {
    result.classList.add('active');
  });
}

function unsetActive() {
  document.querySelectorAll('.tarot-online .logo .brand').forEach((result) => {
    result.classList.remove('active');
  });
}

function setQuestionActive() {
  document.querySelectorAll('.tarot-online .box').forEach((result) => {
    result.classList.add('active');
  });
}

function unsetQuestionActive() {
  document.querySelectorAll('.tarot-online .box').forEach((result) => {
    result.classList.remove('active');
  });
}

document.querySelectorAll('input[name="campaign-question"]').forEach((result) => {
  result.addEventListener("focusin", setActive);
  result.addEventListener("focusout", unsetActive);
	result.addEventListener("focusin", setQuestionActive);
  result.addEventListener("focusout", unsetQuestionActive);
});