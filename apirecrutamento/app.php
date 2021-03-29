<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script>
var url = '/listar';
function vagas()
{
    $.get(url, function( data ) {
        $.each(data, function(i, item) {
            $('#contentVaga').append('<li><a href="#"><h3>Title:<span> '+data[i].title+'</span></h3>' + 
            '<p>Descrição: ' + data[i].description + '</p>'+
            '<p>Status: ' + data[i].status + '</p>'+
            '<p>Local: ' + data[i].address + '</p>'+
            '<p>Salário: ' + data[i].salary + '</p>'+
            '<p>Empresa: ' + data[i].company + '</p>'+
            '</a></li>');
        });
    });
}
vagas();
</script>
</head>
<body>

<body>
    <div data-role="page" id="vagas">
        <div data-role="header">
            <h1>Vagas</h1>
        </div>
 
        <div data-role="content">
            <form>
                <input id="filter-for-listview" data-type="search" placeholder="Busca de vagas...">
            </form>
            <ul data-role="listview" data-inset="true" data-filter="true" data-input="#filter-for-listview" id="contentVaga">
            </ul>
        </div>
 
        <div data-role="footer">
            <h1>App Vagas</h1>
        </div>
    </div>
</body>
</html>