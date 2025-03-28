
// function main(){
//
//
//     $("#save").on('click', function(e){
//         e.preventDefault();
//
//         let formData = $("#edit-profile-form").serializeArray();
//         let dataObject = {};
//
//         formData.forEach(function(item) {
//             dataObject[item.name] = item.value;
//         });
//
//         let jsonData = JSON.stringify(dataObject);
//
//         console.log(formData)
//
//
//     });
// }

BX.ready(function(){
    BX.bind(BX('save'), 'click', function(e){
        e.preventDefault();

        let formData = $("#edit-profile-form").serializeArray();

        BX.ajax.runComponentAction('futuromed:personal_data', 'editUserProfile', {
            mode: 'ajax',
            data: {
                actionType: "PROFILE_EDIT",
                'data': formData,
            },
        }).then(function (response) {

            alert('Данные успешно обновлены');

            console.log(response);
        }, function (response) {

            // Обработка ошибок, если запрос не выполнен
            let errorMessage = 'Ошибки при обработке: \n';
            response.errors.forEach(function(error) {
                errorMessage += error.message + '\n';
            });
            alert(errorMessage);
            console.log('Ошибка запроса:', response);

        });

    })
})