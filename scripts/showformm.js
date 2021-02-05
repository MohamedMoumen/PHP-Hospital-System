let find = document.getElementById('find');
let add = document.getElementById('add');
let del = document.getElementById('dell');

find.onclick = function() {
    let x = document.getElementById('finddiv');
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
};

add.onclick = function() {
    console.log('from add');
    let x = document.getElementById('adddiv');
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    } 
}

del.onclick = function() {
    console.log('from del')
    let x = document.getElementById('deldiv');
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
};