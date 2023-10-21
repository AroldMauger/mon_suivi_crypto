
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
                cryptoPrice.textContent = crypto.current_price + ' €';
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
                })

                heartIconeFull.addEventListener("click", function(){
                    heartIconeFull.style.display = "none";
                    heartIconeRegul.style.display = "block";
                })

                cryptoDiv.appendChild(cryptoIcone);
                cryptoDiv.appendChild(cryptoDivnameAndSymbol);
                cryptoDiv.appendChild(cryptoDivValueAndPercent);
                cryptoDiv.appendChild(heartContainer);

                cryptoDivnameAndSymbol.appendChild(cryptoSymbol);
                cryptoDivnameAndSymbol.appendChild(cryptoName);

                cryptoDivValueAndPercent.appendChild(cryptoPrice);
                cryptoDivValueAndPercent.appendChild(cryptoPercent);

                heartContainer.appendChild(heartIconeRegul);
                heartContainer.appendChild(heartIconeFull);


                cryptoContainer.appendChild(cryptoDiv);

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

                    const cryptoValuesInModalContainer = document.createElement("div");
                    cryptoValuesInModalContainer.classList.add('crypto-values-in-modal-container');

                    const cryptoPriceInModal = document.createElement("span");
                    cryptoPriceInModal.textContent = "Valeur en euros : " + crypto.current_price + ' €';
                    cryptoPriceInModal.classList.add('crypto-price-in-modal');


                    const cryptoPercentInModal = document.createElement("span");
                    const cryptoPercentValueInModal = crypto.price_change_percentage_24h

                    if (cryptoPercentValueInModal > 0) {
                        const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                        cryptoPercentInModal.textContent = '+' + formattedPercentage + ' €';
                        cryptoPercentInModal.classList.add("green");
                    } else {
                        const formattedPercentage = parseFloat(crypto.price_change_percentage_24h).toFixed(2);
                        cryptoPercentInModal.textContent = formattedPercentage + ' €';
                        cryptoPercentInModal.classList.add("red");
                    }

                    body.appendChild(modalWrapper);
                    modalWrapper.appendChild(modalHeader);
                    modalHeader.appendChild(modalHeaderTitleContainer);
                    modalHeader.appendChild(closeButtonContainer);
                    modalWrapper.appendChild(cryptoValuesInModalContainer);
                    cryptoValuesInModalContainer.appendChild(cryptoPriceInModal);
                    cryptoValuesInModalContainer.appendChild(cryptoPercentInModal);


                    modalHeaderTitleContainer.appendChild(cryptoIconeModal)
                    modalHeaderTitleContainer.appendChild(cryptoNameModal)
                    closeButtonContainer.appendChild(closeModalButton)


                }
            });
        })
        .catch(function(error) {
            console.error('Erreur lors de la récupération des données :', error);
        });
});

