$(function() {
    var availableTags = [
         "Hello"
		 // "Sweeney Todd: The Demon Barber of Fleet Street",
         // "El Secreto De Sus Ojos",
         // "Mother and Child",
         // "The Bucket List",
         // "P.S. I love you",
         // "Whatever Works",
         // "The Hangover",
         // "The Shawshank Redemption",
         // "Everybody’s Fine",
         // "Alice in Wonderland",
         // "Tim Burton",
         // "Johnny Depp",
         // "Lewis Carroll",
         // "Helena Bonham Carter",
         // "Robert De Niro",
         // "Kate Beckinsale",
         // "Sam Rockwell",
         // "Drew Barrymore",
         // "Stephen King",
         // "Tim Robbins",
         // "Morgan Freeman",
         // "Justin Bartha",
         // "Bradley Cooper",
         // "Ed Helms",
         // "Zach Galifianakis",
         // "Woody Allen",
         // "Larry David",
         // "Hilary Swank",
         // "Gerald Butler",
         // "Jack Nicholson",
         // "Annette Bening",
         // "Naomi Watts",
         // "Samuel L. Jackson",
         // "Kerry Washington",
         // "Ricardo Darin",
         // "Soledad Villamil"
     ];
     
      function split( val ) {
          return val.split( /,\s*/ );
      }
      function extractLast( term ) {
          return split( term ).pop();
      }

      $( "#searchformJQueryAccessibleAutocomplete" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB &&
                  $( this ).data( "autocomplete" ).menu.active ) {
              event.preventDefault();
          }
      })
      .autocomplete({
          minLength: 0,
          source: function( request, response ) {
              // delegate back to autocomplete, but extract the last term
              response( $.ui.autocomplete.filter(
                  availableTags, extractLast( request.term ) ) );
          },
          focus: function() {
              // prevent value inserted on focus
              return false;
          },
          select: function( event, ui ) {
              var terms = split( this.value );
              // remove the current input
              terms.pop();
              // add the selected item
              terms.push( ui.item.value );
              // add placeholder to get the comma-and-space at the end
              terms.push( "" );
              this.value = terms.join( ", " );
              return false;
          }
      });
});
