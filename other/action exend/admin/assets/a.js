$('.hoversize').hover(function() {
    //alert('sadsad');
    // var name =  $(this).data('id');
    // $(this).tooltip({title:''+name,placement:'left'});
    var name = $(this).data('id');
    $(this).tooltip({ title: '' + name, placement: 'top' });
});

var tshirt_array = new Array();
var student_id_array = new Array();
var index_array = 0;
$('.size').on('change', function() {

    var tshirt_size = $(this).val();
    // alert("tshirt_size:"+tshirt_size);
    var student_id = $(this).data('id');
    //var ss = ""+student_id+"";
    //var student_id = (ss.trim());
    var values = '.tdsize' + student_id + '';
    //alert("tshirt_size:"+tshirt_size);
    // alert(" student_id:"+student_id+"<");
    // alert(" values:"+values+"<");
    $(values).text("" + tshirt_size);
    for (var i = 0; i < index_array + 1; i++) {
        if (student_id_array[i] == student_id) {
            tshirt_array[i] = null;
            student_id_array[i] = null;
        }
        tshirt_array[index_array] = tshirt_size;
        student_id_array[index_array] = student_id;
    }
    index_array++;

});