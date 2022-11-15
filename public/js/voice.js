let speech = new SpeechSynthesisUtterance();
speech.lang = " vi-VN";
let voices = [];
window.speechSynthesis.onvoiceschanged = () => {
  voices = window.speechSynthesis.getVoices();
  speech.voice = voices[0];
  let voiceSelect = document.querySelector("#voices");
  voices.forEach(
    (voice, i) => (voiceSelect.options[i] = new Option(voice.name, i))
  );
};
document.querySelector("#rate").addEventListener("input", () => {
  const rate = document.querySelector("#rate").value;
  speech.rate = rate;
  document.querySelector("#rate-label").innerHTML = rate;
});
document.querySelector("#volume").addEventListener("input", () => {
  const volume = document.querySelector("#volume").value;
  speech.volume = volume;
  document.querySelector("#volume-label").innerHTML = volume;
});
document.querySelector("#pitch").addEventListener("input", () => {
  const pitch = document.querySelector("#pitch").value;
  speech.pitch = pitch;
  document.querySelector("#pitch-label").innerHTML = pitch;
});
document.querySelector("#voices").addEventListener("change", () => {
  speech.voice = voices[document.querySelector("#voices").value];
});
document.querySelector("#start").addEventListener("click", () => {
  speech.text = document.querySelector("textarea").value;
  if (!document.querySelector(".btn.active")) {
    document.querySelector("#start").classList.add("active");
  } else {
    document.querySelector(".btn.active").classList.remove("active");
    document.querySelector("#start").classList.add("active");
  }
  window.speechSynthesis.speak(speech);
});

document.querySelector("#pause").addEventListener("click", () => {
  document.querySelector(".btn.active").classList.remove("active");
  document.querySelector("#pause").classList.add("active");
  window.speechSynthesis.pause();
});

document.querySelector("#resume").addEventListener("click", () => {
  document.querySelector(".btn.active").classList.remove("active");
  document.querySelector("#resume").classList.add("active");
  window.speechSynthesis.resume();
});
document.querySelector("#cancel").addEventListener("click", () => {
  document.querySelector(".btn.active").classList.remove("active");
  document.querySelector("#cancel").classList.add("active");
  window.speechSynthesis.cancel();
});
