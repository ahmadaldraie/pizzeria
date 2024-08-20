"use strict";

const mandjeSection = document.getElementById('mandje');
const mandjeLijst = document.querySelector('.mandjeLijst');
const totaalSpan = document.getElementById('totaal');
const totaalTd = document.getElementById('totaalTd');
const tbody = document.querySelector('tbody');
const adresForm = document.querySelectorAll("input:not([type='submit'])");
const adresOpslaan = document.getElementById("adresOpslaan");
const opmerking = document.getElementById("opmerking");
const feedback = document.getElementById("feedback");
const error = document.getElementById("errorFeedback");
const kortingSpan = document.getElementById("korting");
let mandjeItems = [];
let totaal = 0;
if (sessionStorage.getItem('mandje') !== null) {
    mandjeItems = JSON.parse(sessionStorage.getItem('mandje'));
    toonBestellingTabel();
    for (const item of mandjeItems) {
        if (item !== null) {
            toevoegItemAanDeMandje(item);
            if(kortingSpan !== null) {
                item.promotiePrijs = item.prijs - ((Number(kortingSpan.innerText) / 100) * item.prijs);
                totaal += item.aantal * item.promotiePrijs;
            } else {
                totaal += item.aantal * item.prijs;
            }
        }
    }
}

if (mandjeLijst.children.length === 0) {
    window.location.href = 'index.php';
}
totaalSpan.innerHTML = `${totaal.toFixed(2)}&euro;`;
totaalTd.innerHTML = `${totaal.toFixed(2)}&euro;`;
const verhoogButtons = document.querySelectorAll('.verhogen');
const afneemButtons = document.querySelectorAll('.afnemen');
const verwijderButtons = document.querySelectorAll('.verwijderen');

verhoogButtons.forEach((knopje) => { knopje.onclick = function () {
    const itemId = Number(this.id);
    verhoogDeAantalItem(itemId);
} });

afneemButtons.forEach((knopje) => { knopje.onclick = function () {
    const itemId = Number(this.id);
    neemEenItemAf(itemId);
} });

verwijderButtons.forEach((knopje) => { knopje.onclick = function () {
    const itemId = Number(this.id);
    verwijderEenItem(itemId);
} });



function toevoegItemAanDeMandje(mandjeItem) {
    mandjeLijst.innerHTML +=
        `<dt>${mandjeItem.naam}</dt>
        <dd>
            <p>Aantal: <span class="aantal" id="aantal${mandjeItem.id}">${mandjeItem.aantal}</span></p>
            <p class="prijs">${mandjeItem.prijs}&euro;</p>
            <div class="knopjes">
                <button class="afnemen" id="${mandjeItem.id}">-</button>
                <a class="verwijderen" id="${mandjeItem.id}" href='#'><img id="bin" src="img/bin.png" alt="X"></a>
                <button class="verhogen" id="${mandjeItem.id}">+</button>
            </div>
        </dd>`;
}

function toonBestellingTabel() {
    tbody.innerHTML = '';
    for (const item of mandjeItems) {
        if (item !== null) {
            tbody.innerHTML += 
            `<tr>
                <td>${item.naam}</td>
                <td style="text-align: center;">${item.aantal}</td>
                <td></td>
                <td class="prijs">${item.prijs}&euro;</td>
            </tr>`;

        }
    }
    totaalTd.innerHTML = `${totaal.toFixed(2)}&euro;`;
}

function bestellingWijzigen() {
        mandjeSection.style.right = 0;
        mandjeSection.style.transition = "right 750ms";
}   


function mandjeOpslaan() {
    toonBestellingTabel();
    mandjeSection.style.right = "-26em";
    mandjeSection.style.transition = "right 750ms";
}

function adresWijzigen() {
    adresForm.forEach(element => {
            element.disabled = false;
    });
    adresOpslaan.hidden = false;
}           

function verhoogDeAantalItem(itemId) {
    mandjeItems[itemId].aantal++;
    const aantalSpan = document.getElementById(`aantal${itemId}`);
    aantalSpan.innerText = mandjeItems[itemId].aantal;
    sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
    if (kortingSpan !== null) {
        beijwerkTotaal(mandjeItems[itemId].promotiePrijs, 1);
    } else {
        beijwerkTotaal(mandjeItems[itemId].prijs, 1);
    }
    
}

function neemEenItemAf(itemId) {
    for (const item of mandjeItems) {
        console.log(item);
    }
    if (mandjeItems[itemId].aantal > 1) {
        mandjeItems[itemId].aantal--;
        const aantalSpan = document.getElementById(`aantal${itemId}`);
        aantalSpan.innerText = mandjeItems[itemId].aantal;
        sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
        if (kortingSpan !== null) {
            beijwerkTotaal(mandjeItems[itemId].promotiePrijs, -1);
        } else {
            beijwerkTotaal(mandjeItems[itemId].prijs, -1);
        }
    }
    else {
        verwijderEenItem(itemId);
    }
}

function verwijderEenItem(itemId) {
    mandjeItems[itemId] = null;
    sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
    window.location.href = 'afrekenen.php';
}

function beijwerkTotaal(prijs, x) {
    if (x === 1)
        totaal += prijs;
    else if (x === -1)
        totaal -= prijs;
    totaalSpan.innerHTML = `${totaal.toFixed(2)}&euro;`;
}

function bestellen() {
    $.ajax({
        url: 'bestellenHandler.php', 
        method: 'POST',
        data: { mandjeItems: mandjeItems, opmerking: opmerking.value}, 
        success: function(response) {
            if (response === 'besteld') {
                sessionStorage.removeItem('mandje');
                feedback.hidden = false;
                setTimeout(function() {
                    // Redirect to the main page
                    window.location.href = 'index.php';
                }, 5000);
            } else {
                error.innerHTML = response;
                error.hidden = false;
            }
        }
    });
}