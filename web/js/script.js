function pars()
{
    var table= document.getElementById("testTable");
    var html = table.outerHTML;
    var newWin = window.open('data:application/vnd.ms-excel,' + '\uFEFF' + encodeURIComponent(html)
    );
}
var arr = ['CompanyName','Address','Tel','Fax','Mobile','HomepageAddress','E-mail','OtherHomepageAddress'];
var def_count = arr.length;

//alert($.fn.jquery);
$(document).ready(function(){
    //var arr = ['Запись 1','Запись 2','Запись 3','Запись 4'];
    $('.js_in_php').click(function(){
        alert("asd");
        
            alert("asd");
            var data = {arr:arr,curent_ind:i};
            $('.ab').load('http://parser.com/web/index.php?r=site%2Fabout',data);
        
    });
    $('.addCol').click(function(){
        add = true;
        for (i = 0 ; i < arr.length; i++)
        {
            if ($('.btn_val').val() == arr[i])add = false;
        }
        if (add) arr.push($('.btn_val').val());
        else 
        {
            alert('Такая колонка уже существует');
            return;
        }
        
        $('.my_btn').append('<button class="btn_col btn-primary btn-lg" value="'+arr[arr.length-1]+'">'+arr[arr.length-1]+'</button>');
        $('.btn_col').click(function(){
            if ((arr.indexOf($(this).val())) < def_count)
            {
                alert("Эту колонку нельзя удалить");
                return;
            }
            arr.splice((arr.indexOf($(this).val())),1);
            this.remove();
        });
    });
    $(function view_mass()
    {
        //alert($.fn.jquery);
        for (i=0;i<arr.length;i++)
        {
            $('.my_btn').append('<button class="btn_col btn-primary btn-lg" value="'+arr[i]+'">'+arr[i]+'</button>');
            console.log('<button>'+arr[i]+'</button>');
        }
        $('.btn_col').click(function(){
            if ((arr.indexOf($(this).val())) < def_count)
            {
                alert("Эту колонку нельзя удалить");
                return;
            }
            arr.splice((arr.indexOf($(this).val())),1);
            this.remove();
        });
    });
    
//    $('.addParse').click(function(){
//        for (i = 0;i<100;i+=20)
//        {
//            alert(i);
//            var data = {arr:arr,curent_ind:i};
//            $('.my_table').load('./index.php?r=site%2Fcontact',data);
//        }   
//        //$('.my_table').load('asdasdsa',data);
//    });
    $('.addParse').click(function(){
        isFirst = true;
        for (i = 0;i<40;i+=20)
        {
            var data = {arr:arr,curent_ind:i,isFirst: isFirst};
            $.ajax({
               url: "./blabla.php",
               type: "POST",
               async: false,
               data: data,
               success: function(res){
                   alert(res);
                   var d = JSON.parse(res);
                   if (isFirst)
                   {
                       //создать таблицу
                       $('.my_table').html('<table id="testTable" style="border-color: black;" border="1"></table');
                       $('#testTable').append('<tr>');
                       for (n=0;n<d.mass[0].length;n++)
                       {
                           $('#testTable').append('<th>'+d.mass[0][n]+'</th>');
                       }
                       $('#testTable').append('</tr>');
                   }
                   for (m=1;m<d.mass.length;m++)
                   {
                       // новая строка
                       $('#testTable').append('<tr>');
                       for (n=0;n<d.mass[0].length;n++)
                       {
                           //новый столбец
                           $('#testTable').append('<td>'+d.mass[m][n]+'</td>');
                       }
                       $('#testTable').append('</tr>');
                   }
                   isFirst = false;
               },
               error: function(){
                   alert('Ошибка');
               }
            });
        }
        });
});
   







