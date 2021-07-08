$(document).ready(function() {
    $('.bold').hover(function() {
        var name = $(this).data('id');
        $(this).tooltip({ title: '' + name, placement: 'left' });
    });
    $('#print_option_model').on('hidden.bs.modal', function(e) {
        activeprint();
    });

    $('#print-btn').click(function(event) {
        $('#xpbtntype').html('<i class="fa fa-print"></i> Print');
        $('#pxtype').val('print');
        $('#print_option_model').modal('show');
        //window.open('printmasterlist.php?prnt=82cc75faaf7cda1','name','width=600,height=400,toolbar=0');
    });
    // $(function () {
    // table.ajax.reload();
    // }); 
    //load_students_table();
    activeprint();









    function activeprint() {
        $("#chkall_course").prop("checked", true);
        $("#rcourse").prop("checked", true);

        $(':checkbox').each(function() {
            this.checked = true;
        });
        $("#chkall_year").prop("checked", true);
        $("#ryear").prop("checked", true);

        $(':checkbox').each(function() {
            this.checked = true;
        });
        document.getElementById("panel_course").style.display = "none";
        document.getElementById("panel_year").style.display = "block";
        // document.getElementById("panel_body").style.display = "none";

    }



    $('#rcourse').click(function() {
        document.getElementById("panel_year").style.display = "none";
        document.getElementById("panel_course").style.display = "block";
    });
    $('#ryear').click(function() {
        document.getElementById("panel_course").style.display = "none";
        document.getElementById("panel_year").style.display = "block";
    });
    $(document).on('click', '.cprint102', function(e) {
        e.preventDefault();
        document.getElementById("panel_body").style.display = "block";
    });


    $(document).on('click', '.cprint101', function(e) {
        e.preventDefault();

        $('#print_option_model').modal('hide');
        var type = $('#pxtype').val();
        var year = '';
        var course = '';
        if (document.getElementById('chkall_course').checked) {
            course = 'all';
        } else {
            $("input:checkbox[name=chkcourse]:checked").each(function() {
                course += "'" + $(this).val() + "',";
                // check = true;
            });
        }
        if (document.getElementById('chkall_year').checked) {
            year = 'all';
        } else {
            $("input:checkbox[name=chkyear]:checked").each(function() {
                year += $(this).val() + ",";
            });
        }



        if (year == '') {
            alert('please choose');
        } else if (course == '') {
            alert('please choose');

        } else {

            type = 'print';
            //    alert('year:'+year);
            //  alert('course:'+course); 
            //  alert('type:'+type); 


            $.ajax({
                url: "action/masterlist.php",
                //url:"printmasterlist.php",  
                method: "POST",
                // dataType: 'json',
                //data: {},
                data: { year: year, course: course, type: type },
                // beforeSend:function(){  
                // $(".btnsave13").html('<i style="color: white;" class="fa fa-spinner fa-spin"></i> Updating...'); 

                //  },  
                success: function(data) {
                    // alert(data);
                    if (data == 2) {
                        window.open('printmasterlist.php', 'name', 'width=600,height=400,toolbar=0');
                    }
                    //alert('success')
                    //  printJS({printable: data,
                    // type: 'html'});
                    // if(data == 2){
                    // //  alert('excel')
                    // $('#print_option_model').modal('hide');
                    // activeprint();
                    // window.location.href = "action/student_export_excel.php";
                    // }
                    // else{
                    //   $('#print_option_model').modal('hide');
                    // activeprint();
                    //   printJS({printable: data,
                    //  properties: ['id_number', 'firstname', 'middlename','lastname',
                    //   'year', 'section', 'course', 'major'], type: 'json'});
                    // }
                }

            });
        }

    });

    $('#chkall_course').on('click', function() {
        if (this.checked) {
            $('.chkcourse').each(function() {
                this.checked = true;
            });
        } else {
            $('.chkcourse').each(function() {
                this.checked = false;
            });
        }
    });

    $('.chkcourse').on('click', function() {
        if ($('.chkcourse:checked').length == $('.chkcourse').length) {
            $('#chkall_course').prop('checked', true);
        } else {
            $('#chkall_course').prop('checked', false);
        }
    });

    $('#chkall_year').on('click', function() {
        if (this.checked) {
            $('.chkyear').each(function() {
                this.checked = true;
            });
        } else {
            $('.chkyear').each(function() {
                this.checked = false;
            });
        }
    });

    $('.chkyear').on('click', function() {
        if ($('.chkyear:checked').length == $('.chkyear').length) {
            $('#chkall_year').prop('checked', true);
        } else {
            $('#chkall_year').prop('checked', false);
        }
    });










});