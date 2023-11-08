
//Creamos dos objetos para mapear los campos de los formularios
const fieldErrorMessagesCategorias = {
  nombre_categoria: 'Nombre de Categoría',
};

const fieldErrorMessagesProductos = {
  nombre_producto: 'Nombre',
  descripcion_producto: 'Descripción',
  precio_producto: 'Precio',
  categoria_producto: 'Categoria',
};

// Función para manejar la validación de un formulario
function handleFormValidation(formSelector, fieldErrorMessages) {
  const form = $(formSelector);

  form.submit(function (event) {
    const errors = [];

    // Iteramos a través de los campos del formulario y verificamos si están vacíos
    // si están vacios se agregan al array de errores
    for (let error in fieldErrorMessages) {
      const valor = $.trim(form.find('#' + error).val());
      if (valor === '') {
        errors.push(fieldErrorMessages[error]);
      }
    }

    // Verificamos si hay errores y mostramos la alerta correspondiente
    // si hay mostramos la alerta
    if (errors.length > 0) {
      //evitamos que el formulario se envié inmediatamente
      event.preventDefault();
      Swal.fire({
        icon: 'error',
        title: 'Error',
        html: `Los siguientes campos no pueden estar vacíos: <b>${errors.join(', ')}</b>`,
        footer: 'Alexis Jardin',
      });
      //caso contrario enviamos los datos al backend para que sean procesados
    } else {
      form.submit();
    }
  });
}

//Esperamos que cargue todo el HTML y llamamos a la función para manejar la validación de los formularios
//pasando los parámetros necesarios
$(document).ready(function () {
  handleFormValidation(
    '#formulario_categorias',

    fieldErrorMessagesCategorias
  );
  handleFormValidation('#formulario_productos', fieldErrorMessagesProductos);
});



