$(document).ready(function(){
    $("#new_transport").validate({
       rules:{ 
            transport_city:{
                required: true,
				rangelength: [4, 20]
            },
			phone:{
                required: true,
				digits: true,
				minlength: 5,
				maxlength: 20
            },
			company_name:{
                required: true
            }
       },
       messages:{
            transport_city:{
                required: "Укажите город отправления",
				rangelength: "Название города должно быть от {0} до {1} символов."
            },
			phone:{
                required: "Укажите Ваш контактный телефон",
				digits: "Используйте только цифры",
				minlength: "Слишком короткий номер",
				maxlength: "Слишком длинный номер"
				
            },
			company_name:{
                required: "Укажите Ваше имя"
            }
       } 
    });
});