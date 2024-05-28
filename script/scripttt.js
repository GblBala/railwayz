// Charger les données à partir du fichier CSV
fetch('stations.csv')
  .then(response => response.text())
  .then(data => {
    // Parser les données CSV
    const gares = data.split('\n');
    
    // Sélectionner tous les inputs avec la classe 'gare-input'
    const inputsGare = document.querySelectorAll('.gare-input');
    
    // Sélectionner tous les datalists avec la classe 'gare-datalist'
    const datalistsGares = document.querySelectorAll('.gare-datalist');

    // Ajouter un écouteur d'événements à chaque input
    inputsGare.forEach(function(inputGare, index) {
      inputGare.addEventListener('input', function() {
        const valeurInput = this.value.toLowerCase();
        const filteredGares = gares.filter(gare => gare.toLowerCase().startsWith(valeurInput));

        // Utiliser le datalist correspondant à l'index actuel
        const datalistGares = datalistsGares[index];
        
        // Réinitialiser le contenu du datalist
        datalistGares.innerHTML = '';

        // Ajouter les options filtrées au datalist
        filteredGares.forEach(function(gare) {
          const option = document.createElement('option');
          option.value = gare;
          datalistGares.appendChild(option);
        });
      });
    });
  });

