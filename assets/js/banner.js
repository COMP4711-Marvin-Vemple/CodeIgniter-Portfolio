$( document ).ready(function() {
  var developerModifierElement = $('#welcome-flair #lhs');
  var words = ["Software", "Web", "Mobile"];
  var currentWord = 0;
  
  function updateDeveloperDisplay() {
    developerModifierElement.fadeOut('slow', changeWord);
  }
  
  function changeWord() {
    currentWord += 1;

    if ( currentWord >= words.length ) {
        currentWord = 0;
    }
    
    developerModifierElement.html(words[currentWord]);
    developerModifierElement.fadeIn('slow');
  }
  
  setInterval(updateDeveloperDisplay, 3000);
});