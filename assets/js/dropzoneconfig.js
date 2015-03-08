Dropzone.options.psdropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  success: function(file, name) {
    $('#edit').append('<input hidden value="' + name + '" name=image[]>')
  }
  
  

};

