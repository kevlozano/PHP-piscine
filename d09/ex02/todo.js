var btnNew;
var todoToAdd;
var ftlist;
var i = 0;
var cookie = [];
window.onload = function () {
    btnNew = document.getElementById("addNew");
    btnNew.addEventListener("click", newTodo);
    ftlist = document.getElementById('ft_list');
    var tmp = document.cookie;
    
    if (tmp) {
        cookie = tmp.split(";");
        //alert(cookie);
        console.log(cookie);
        for (elem in cookie) {
            addPreviousTodos(cookie[elem]);
        }
    }
}
function deleteIt() {
    if (confirm("Are you sure?")) {
        this.parentElement.removeChild(this);
    }
}

function newTodo() {
   todoToAdd = prompt("Enter new to do");
   if (todoToAdd != "") {
        i++;
        var node = document.createElement("div");
        node.setAttribute("id", "todo" + i);
        node.innerHTML += todoToAdd;
        node.addEventListener("click", deleteIt);
        ftlist.insertBefore(node, ftlist.firstChild);
        document.cookie = i+'='+todoToAdd+'; expires=Thu, 2 May 2019 20:47:11 UTC; path=/';
   }
}



function addPreviousTodos(e) {
    i++;
    var a = e.split("=");
    var node = document.createElement("div");
    node.setAttribute("id", "todo" + i);
    node.setAttribute("onclick", "ftlist.removeChild(" + node.id + ")");
    node.innerHTML += a[1];
    ftlist.insertBefore(node, ftlist.firstChild);
}


