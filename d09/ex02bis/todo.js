var btnNew;
var todoToAdd;
var ftlist;
var i = 0;
var cookie = [];
$(document).ready (function () {
    btnNew = $("#addNew");
    btnNew.click(newTodo);
    ftlist = $('#ft_list');
    var tmp = document.cookie;
    if (tmp) {
        cookie = tmp.split(";");
        //alert(cookie);
        console.log(cookie);
        for (elem in cookie) {
            addPreviousTodos(cookie[elem]);
        }
    }
});
function deleteIt() {
    if (confirm("Are you sure?")) {
        this.parentElement.removeChild(this);
    }
}

function newTodo() {
   todoToAdd = prompt("Enter new to do");
   if (todoToAdd != "") {
        i++;
        ftlist.prepend($('<div id='+i+'>' + todoToAdd + '</div>').click(deleteIt));
        document.cookie = i+'='+todoToAdd+'; expires=Thu, 2 May 2019 20:47:11 UTC; path=/';
   }
}

function addPreviousTodos(e) {
    i++;
    var a = e.split("=");
    ftlist.prepend($('<div id='+i+'>' + a[1] + '</div>').click(deleteIt));
}


