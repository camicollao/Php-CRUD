$(function(){

    let edit = false;

    fetchRecords()

    $("#record-form").submit(e => {
        e.preventDefault();
        const postRecord = {
            rut: $("#rut").val(),
            name: $("#name").val(),
            first_surname: $("#first_surname").val(),
            second_surname: $("#second_surname").val(),
            email: $("#email").val(),
            job: $("#job").val(),
            address: $("#address").val(),
            region: $("#region").val(),
            id: $("#recordId").val(),

        };
        const url = edit === false ? "./php/add-record.php" : "./php/update-record.php";
        $.ajax({
            url: url,
            method: "POST",
            data: postRecord,
            success: function(response) {
                if(!response.error) {
                    fetchRecords();
                    alert("Registro agregado correctamente");
                    $("#record-form")[0].reset();
                }else{
                    alert("Error al agregar registro");
                }
            }
        });

    });

    function fetchRecords() {
        $.ajax({
            url: "./php/fetch-records.php",
            method: "GET",
            success: function(response) {
                const records = JSON.parse(response);
                let template = ``;
                records.forEach(record => {
                    template += 
                    `<tr recordId="${record.id}">
                        <td>${record.id}</td>
                        <td>${record.rut}</td>
                        <td>${record.name}</td>
                        <td>${record.first_surname}</td>
                        <td>${record.second_surname}</td>
                        <td>${record.email}</td>
                        <td>${record.job}</td>
                        <td>${record.address}</td>
                        <td>${record.region}</td>
                        <td>
                            <button class="record-edit btn btn-success">Editar</button>
                        </td>
                        <td>
                        <button class="record-delete btn btn-danger">Eliminar</button>
                        </td>
                    </tr>`;
                });
                $("#records").html(template);
            }
        });
    }
    $(document).on("click", ".record-delete", () => {
        if(confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr("recordId");
            $.post("./php/delete-record.php", {id}, function(response) {
                fetchRecords();
            });
        }
    })

    $(document).on("click", ".record-edit", () => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr("recordId");
        let url = "./php/get-record.php";
        $.ajax({
            url,
            data: {id},
            method: "POST",
            success: function(response) {
                if(!response.error){
                const record = JSON.parse(response);
                $("#rut").val(record.rut);
                $("#name").val(record.name);
                $("#first_surname").val(record.first_surname);
                $("#second_surname").val(record.second_surname);
                $("#email").val(record.email);
                $("#job").val(record.job);
                $("#address").val(record.address);
                $("#region").val(record.region);
                $("#recordId").val(record.id);
                edit = true;
                }
            }
        })

    });

})