
document.addEventListener('DOMContentLoaded', function() {
    var cryptoContainer = document.getElementById('crypto-container');
    var apiUrl = 'api.php'; 

    fetch(apiUrl)
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données');
            }
            return response.json();
        })
        .then(function(data) {
            data.forEach(function(crypto) {
                const cryptoDiv = document.createElement('div');
                cryptoDiv.classList.add('crypto-container');

                const cryptoIconeNameAndSymbolContainer = document.createElement('div');
                cryptoIconeNameAndSymbolContainer.classList.add('crypto-icone-name-and-symbol-container');

                const cryptoIcone= document.createElement('img');
                cryptoIcone.setAttribute("src", crypto.image );
                cryptoIcone.classList.add("crypto-icone");

                const cryptoDivnameAndSymbol = document.createElement('div');
                cryptoDivnameAndSymbol.classList.add('crypto-container-name-and-symbol');
                cryptoDivnameAndSymbol.addEventListener("click", displayModal)

                const cryptoSymbol = document.createElement('span');
                cryptoSymbol.textContent = crypto.symbol.toUpperCase();
                cryptoSymbol.classList.add('crypto-symbol');

                const cryptoName = document.createElement('span');
                cryptoName.textContent = crypto.name;
                cryptoName.classList.add('crypto-name');

                const cryptoDivValueAndPercent = document.createElement('div');
                cryptoDivValueAndPercent.classList.add('crypto-container-value-and-percent');

                const cryptoPrice = document.createElement('span');
                cryptoPrice.textContent = crypto.current_price.toFixed(2) + ' €';
                cryptoPrice.classList.add('crypto-price');

                const cryptoPercent = document.createElement('span');
                const cryptoPercentValue = crypto.price_change_percentage_24h

                if (cryptoPercentValue > 0) {
                    const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                    cryptoPercent.textContent = '+' + formattedPercentage + ' €';
                    cryptoPercent.classList.add("green");
                } else {
                    const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                    cryptoPercent.textContent = formattedPercentage + ' €';
                    cryptoPercent.classList.add("red");
                }
                
                const heartContainer = document.createElement('div');
                heartContainer.classList.add('heart-container');

                const heartIconeRegul = document.createElement('span');
                heartIconeRegul.classList.add('fa-heart');
                heartIconeRegul.classList.add('fa-regular');

              
                const heartIconeFull = document.createElement('span');
                heartIconeFull.classList.add('fa-solid');
                heartIconeFull.classList.add('fa-heart');
                heartIconeFull.style.display = "none";

                heartIconeRegul.addEventListener("click", function(){
                    heartIconeRegul.style.display = "none";
                    heartIconeFull.style.display = "block";
                    addToFavorites(crypto.name, crypto.current_price.toFixed(2) + ' €', cryptoPercent.textContent);
                });
                function addToFavorites(cryptoName, cryptoPrice, cryptoPercent) {
                    fetch('add_to_favorites.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            cryptoName: cryptoName,
                            cryptoPrice: cryptoPrice,
                            cryptoPercent: cryptoPercent
                        })        
                    })
                    .then(() => {
                        location.reload();
                    })
                    .catch(error => {
                        console.error('Erreur lors de la requête fetch:', error);
                    });
                }
                
              

                heartIconeFull.addEventListener("click", function(){
                    heartIconeFull.style.display = "none";
                    heartIconeRegul.style.display = "block";
                })
                cryptoContainer.appendChild(cryptoDiv);
                cryptoDiv.appendChild(cryptoIconeNameAndSymbolContainer);
                cryptoDiv.appendChild(cryptoDivValueAndPercent);
                cryptoDiv.appendChild(heartContainer);

                cryptoIconeNameAndSymbolContainer.appendChild(cryptoIcone)
                cryptoIconeNameAndSymbolContainer.appendChild(cryptoDivnameAndSymbol);
                cryptoDivnameAndSymbol.appendChild(cryptoSymbol);
                cryptoDivnameAndSymbol.appendChild(cryptoName);

                cryptoDivValueAndPercent.appendChild(cryptoPrice);
                cryptoDivValueAndPercent.appendChild(cryptoPercent);

                heartContainer.appendChild(heartIconeRegul);
                heartContainer.appendChild(heartIconeFull);



                function displayModal () {
                    const body = document.querySelector("body");

                    const modalWrapper = document.createElement("div");
                    modalWrapper.classList.add('modal-container');

                    const modalHeader = document.createElement("div");
                    modalHeader.classList.add('modal-header');

                    const modalHeaderTitleContainer = document.createElement("div");
                    modalHeaderTitleContainer.classList.add('modal-title-container');

                    const cryptoIconeModal = document.createElement("img");
                    cryptoIconeModal.setAttribute("src", crypto.image)
                    cryptoIconeModal.classList.add('icone-crypto-in-modal');

                    const cryptoNameModal = document.createElement("span");
                    cryptoNameModal.textContent = crypto.name;
                    cryptoNameModal.classList.add('crypto-name-in-modal');

                    const closeButtonContainer = document.createElement("div");
                    closeButtonContainer.classList.add('close-button-container');

                    const closeModalButton = document.createElement("span");
                    closeModalButton.classList.add('fa-solid');
                    closeModalButton.classList.add('fa-xmark');

                    closeModalButton.addEventListener("click", function(){
                        modalWrapper.remove();
                    })

                    const chartIcone = document.createElement("span");
                    chartIcone.classList.add('fa-chart-line');
                    chartIcone.classList.add('fa-solid');

                    const hideIcone = document.createElement("span");
                    hideIcone.classList.add('fa-eye-slash');
                    hideIcone.classList.add('fa-solid');
                    
                    const chartContainer = document.createElement("div");
                    chartContainer.classList.add('chart-container');

                    
                    body.appendChild(modalWrapper);
                    modalWrapper.appendChild(modalHeader);
                    modalHeader.appendChild(modalHeaderTitleContainer);
                    modalHeader.appendChild(closeButtonContainer);
                    modalWrapper.appendChild(chartIcone)
                    modalWrapper.appendChild(hideIcone)
                    modalWrapper.appendChild(chartContainer)


                    modalHeaderTitleContainer.appendChild(cryptoIconeModal)
                    modalHeaderTitleContainer.appendChild(cryptoNameModal)
                    closeButtonContainer.appendChild(closeModalButton)
                    displayChart(crypto.id, chartContainer);

                    const cryptoOtherInfoContainer = document.createElement("div");
                    cryptoOtherInfoContainer.classList.add("other-info-container");

                    const otherInfoTitle = document.createElement("h3");
                    otherInfoTitle.textContent = "Autres informations"

                    const cryptoInfosContainer = document.createElement("div");
                    cryptoInfosContainer.classList.add("infos-container");

                    const cryptoPriceInModal = document.createElement("span");
                    cryptoPriceInModal.textContent = "Valeur en euros : ";
                    const cryptoPrice = document.createElement("span");
                    cryptoPrice.textContent = crypto.current_price + ' €'
                    cryptoPrice.style.fontWeight = 800;
                    cryptoPriceInModal.appendChild(cryptoPrice);

                    const cryptoPercentInModal = document.createElement("span");
                    const cryptoPercentValueInModal = crypto.price_change_percentage_24h;
                    
                    if (cryptoPercentValueInModal > 0) {
                        const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                    
                        const percentageSpan = document.createElement("span");
                        percentageSpan.classList.add("green");
                        percentageSpan.textContent = '+' + formattedPercentage + ' €';
                        percentageSpan.style.fontWeight = 800;

                        cryptoPercentInModal.textContent = 'Variation du prix en % depuis 24H : ';
                        cryptoPercentInModal.appendChild(percentageSpan);
                    } else {
                        const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                    
                        const percentageSpan = document.createElement("span");
                        percentageSpan.classList.add("red");
                        percentageSpan.textContent = formattedPercentage + ' €';
                        percentageSpan.style.fontWeight = 800;
                    
                        cryptoPercentInModal.textContent = 'Variation du prix en % depuis 24H : ';
                        cryptoPercentInModal.appendChild(percentageSpan);
                    }

                    const cryptoMarketRank = document.createElement("span");
                    cryptoMarketRank.textContent = "Classement par capitalisation boursière : "
                    const marketRank = document.createElement("span");
                    marketRank.textContent =  "N°" + crypto.market_cap_rank;
                    marketRank.style.fontWeight = 800;
                    cryptoMarketRank.appendChild(marketRank)


                    const cryptoMarketCap = document.createElement("span");
                    cryptoMarketCap.textContent = "Capitalisation boursière : ";
                    const marketCap = document.createElement("span");
                    marketCap.textContent =  crypto.market_cap + " €";
                    marketCap.style.fontWeight = 800;
                    cryptoMarketCap.appendChild(marketCap)

                    const cryptoQuantity = document.createElement("span");
                    cryptoQuantity.textContent = "Quantité en circulation : ";
                    const quantity = document.createElement("span");
                    quantity.textContent =  crypto.circulating_supply;
                    quantity.style.fontWeight = 800;
                    cryptoQuantity.appendChild(quantity)

                    const dateFromAPI = crypto.last_updated;
                    const date = new Date(dateFromAPI);
                    const year = date.getFullYear();
                    const month = (date.getMonth() + 1).toString().padStart(2, '0'); 
                    const day = date.getDate().toString().padStart(2, '0');
                    const hours = date.getHours().toString().padStart(2, '0');
                    const minutes = date.getMinutes().toString().padStart(2, '0');
                    const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}`;

                    const cryptoTime= document.createElement("span");
                    cryptoTime.textContent = "Dernière actualisation : ";
                    const time = document.createElement("span");
                    time.textContent =  formattedDate;
                    time.style.fontWeight = 800;
                    cryptoTime.appendChild(time)

                   
                    modalWrapper.appendChild(cryptoOtherInfoContainer)
                    cryptoOtherInfoContainer.appendChild(otherInfoTitle)
                    cryptoOtherInfoContainer.appendChild(cryptoInfosContainer)
                    cryptoInfosContainer.appendChild(cryptoPriceInModal);
                    cryptoInfosContainer.appendChild(cryptoPercentInModal);
                    cryptoInfosContainer.appendChild(cryptoMarketRank)
                    cryptoInfosContainer.appendChild(cryptoMarketCap)
                    cryptoInfosContainer.appendChild(cryptoQuantity)
                    cryptoInfosContainer.appendChild(cryptoTime)

                }
               
            });
        })
        .catch(function(error) {
            console.error('Erreur lors de la récupération des données :', error);
        });
});


function displayChart(cryptoId, container) {
    const canvas = document.createElement("canvas");
    canvas.classList.add("chart")
    canvas.width = 20;
    canvas.height = 10;
    container.appendChild(canvas);

    const xhr = new XMLHttpRequest();
    xhr.open("GET", `https://api.coingecko.com/api/v3/coins/${cryptoId}/market_chart?vs_currency=eur&days=14`);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);

        const timestamps = data.prices.map(entry => {
            const date = new Date(entry[0]);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0'); 
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        });
            const prices = data.prices.map(entry => entry[1]);

            const canvas = container.querySelector("canvas");
            const ctx = canvas.getContext("2d");

            const chartConfig = {
                type: "line",
                data: {
                    labels: timestamps,
                    datasets: [
                        {
                            label: "Prix en EUR sur 7 jours",
                            data: prices,
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                            backgroundColor: "rgba(255, 0, 0, 0.2)",
                            fill: true
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            type: "category", 
                            labels: timestamps, 
                        },
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            };
            
            new Chart(ctx, chartConfig);
        } else if (xhr.status !== 200) {
            console.error("Erreur lors de la requête AJAX : " + xhr.status);
        }
    };
    xhr.send();

const chartIcone = document.querySelector(".fa-chart-line");
const graphic = document.querySelector(".chart");
const hideIcone = document.querySelector(".fa-eye-slash");

function masquerCanvas() {
    graphic.style.display = "none";
    chartIcone.style.display = "block";
    hideIcone.style.display = "none";
  }
  
  // Fonction pour afficher le canvas
  function afficherCanvas() {
    graphic.style.display = "block";
    chartIcone.style.display = "none";
    hideIcone.style.display = "block";
  }

  chartIcone.addEventListener("click", afficherCanvas)
  hideIcone.addEventListener("click", masquerCanvas)


  // Vérification initiale de la largeur de l'écran
  if (window.matchMedia("(min-width: 768px)").matches) {
    masquerCanvas();
  } else {
    afficherCanvas();
  }
  
  // Ajouter un écouteur de média query pour détecter les changements
  const mediaQuery = window.matchMedia("(min-width: 768px)");

  function handleMediaChange(e) {
    if (e.matches) {
      masquerCanvas();
    } else {
      afficherCanvas();
      hideIcone.style.display = "none";

    }
  }
  
  mediaQuery.addEventListener("change", handleMediaChange);
  
  // Vérification initiale de la largeur de l'écran
  handleMediaChange(mediaQuery);
  
  
}


document.addEventListener('DOMContentLoaded', function() {
    const deleteIcons = document.querySelectorAll('.delete-fav');

    deleteIcons.forEach((icon) => {
        icon.addEventListener('click', function() {
            const favNumber = this.getAttribute('data-favnum');
            deleteFavorite(favNumber);
        });
    });
});



function deleteFavorite(favNumber) {
    fetch('delete_favorite.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            fav: `fav${favNumber}`
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            console.error("Erreur lors de la suppression du favori");
        }
    })
}
    
