function formatTime() {
    now = new Date();
    hour = now.getHours();
    min = now.getMinutes();
    sec = now.getSeconds();

 if (document.clock.sivamtime[0].checked) {
   if (min <= 9) {
        min = "0" + min; }
   if (sec <= 9) {
        sec = "0" + sec; }
   if (hour > 12) {
	hour = hour - 12;
	add = " p.m."; }
   else {
	hour = hour;
	add = " a.m."; }
   if (hour == 12) {
	add = " p.m."; }
   if (hour == 00) {
	hour = "12"; }

  document.clock.sivam.value = ((hour<=9) ? "0" + hour : hour) + ":" + min + ":" + sec + add;
 }

  if (document.clock.sivamtime[1].checked) {
   if (min <= 9) {
	min = "0" + min; }
   if (sec <= 9) {
	sec = "0" + sec; }
   if (hour < 10) {
	hour = "0" + hour; }
  document.clock.sivam.value = hour + ':' + min + ':' + sec;
 }
setTimeout("formatTime()", 1000);
}