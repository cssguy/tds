$(document).ready(function(){
    $("#new_cargo").validate({
       rules:{ 
			phone:{
                required: true,
				digits: true,
				minlength: 5,
				maxlength: 20
            },
			ship_city:{
				required: true,
				rangelength: [4, 20]
			},
			company_name:{
				required: true
			}
       },
       messages:{
			phone:{
                required: "Укажите Ваш контактный телефон",
				digits: "Используйте только цифры",
				minlength: "Слишком короткий номер",
				maxlength: "Слишком длинный номер"
				
            },
			ship_city:{
				required: "Укажите город отправления",
				rangelength: "Название города должно быть от {0} до {1} символов."
			},
			company_name:{
				required: "Укажите Ваше имя"
			}
       } 
    });
});