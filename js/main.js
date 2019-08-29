var edit = document.getElementById('edit');

edit.onclick = function(){
// document.getElementById('edit')
document.getElementById("designation").setAttribute("contenteditable","true");
document.getElementById("designation").setAttribute("style","border:1px solid gray");
document.getElementById("edit").setAttribute("style","display:none");
}
