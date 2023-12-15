/*
- Se está trabajando en el autoompletado, la idea para esto es usar el método fetch, para así tener acceso a un archivo de formato json, 
el cual contendrá los datos de los trabajadores y otros posibles datos que también podrán ser usados 
con el objetivo de posiblemente completar otros campos del formulario

- Se trabaja de igual manera en un botón para eliminar un campo de personal, ya que el código está diseñado para validar
que no existan campos vacíos; por lo tanto, si un personal por error, hace clic en el botón 'añadir' y crea
nuevos campos para añadir más usuarios cuando ya no necesita hacerlo entonces cuando genere el documento este tendrá un error
que no podrá corregir a no ser que actualice completamente la página y pierda los datos que ha llenado anteriormente;
por esa razón se implementa un botoón para remover personal, de esa manera se pueden eliminar casillas de personal añadidas por error.

- Luego de eso se pueden subir las firmas como imágenes en formato png para que puedan ser guardadas en un servidor, de esa manera
se puede guardar el link de las imágenes en el archivo json, y luego con javascript, un vez se haya obtenido estas imágenes se podrán
utilizar para colocarlas dentro del documento a generar con el doc.image

- El formato 'analisis_trabajo_seguro' es el que se encuentra más desarrollado hasta el mommento, solo faltaría agregarle al json
los datos corretos, esperar revisiones y recibir alcances sobre los campos
*/