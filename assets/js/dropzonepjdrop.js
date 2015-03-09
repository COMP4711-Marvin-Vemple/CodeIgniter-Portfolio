Dropzone.options.psdropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  success: function(file, name) {
    /*$('#imageview').append(
     '<div class="col-sm-6 col-md-4"'
      + '<div class="thumbnail">'
      + '<img src="/uploads/' + name + '" alt="..." style="max-width: 100%; height: 10em;">'
      + '<div class="caption">'
      + '<h3>Options</h3>'
      +  '<p><a href="#" class="btn btn-primary" value="' + name + '" role="button">Make Primary</a> <a href="#" value="" class="btn btn-default" role="button">Delete</a></p>'
      + '</div>'
    + '</div>'
    + '</div>'
   );*/
    $('#edit').append('<input hidden value="' + name + '" name=image[]>');
  }
  
  

};

$()
