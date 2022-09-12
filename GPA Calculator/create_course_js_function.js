function delete_from_table(tableId){
    var params = "deleteEntry=" + tableId;
    console.log(tableId);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'create_function.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhr.onload = function() {
            console.log(this.responseText);
        }

        xhr.send(params);
    }

function edit_entry(Id) {
    console.log(Id);
    var params = "editEntry=" + Id;
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'create_function.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xhr.onload = function() {
            console.log(this.responseText);
        }

        xhr.send(params);
}