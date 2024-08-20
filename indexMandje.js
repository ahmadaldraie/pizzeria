"use strict";

const mandjeSection = document.getElementById('mandje');
const mandjeLijst = document.querySelector('.mandjeLijst');
const toevoegButtons = document.querySelectorAll('.toevoegen');
const afrekenenKnop = document.getElementById('afrekenenKnop');
const totaalSpan = document.getElementById('totaal');
const mandjeLeeg = document.getElementById('mandjeLeeg');
//sessionStorage.removeItem('mandje');
//console.log(sessionStorage.getItem('mandje'));
let mandjeItems = [];
let totaal = 0;
if (sessionStorage.getItem('mandje') !== null) {
    mandjeItems = JSON.parse(sessionStorage.getItem('mandje'));
    for (const item of mandjeItems) {
        if (item !== null) {
        toevoegItemAanDeMandje(item);
        totaal += item.aantal * item.prijs;
    }
    }
}
totaalSpan.innerHTML = `${totaal}&euro;`;
mandjeLeeg.hidden = true;
const verhoogButtons = document.querySelectorAll('.verhogen');
const afneemButtons = document.querySelectorAll('.afnemen');
const verwijderButtons = document.querySelectorAll('.verwijderen');

toevoegButtons.forEach((knop) => { knop.onclick = function () {
    const itemId = Number(this.id);
    let itemNaam = "";
    let itemPrijs = 0.0;
    let aantal = 1;
    for (const sibling of this.parentNode.children) {
        switch (sibling.className) {
            case 'naam': itemNaam = sibling.innerText; break;
            case 'prijs': itemPrijs = Number(sibling.children[0].innerText); break;
        }
    }

    if (mandjeItems[itemId] !== null && mandjeItems[itemId] !== undefined) {
        console.log(mandjeItems[itemId]);
        verhoogDeAantalItem(itemId);
    } else {
        mandjeItems[itemId] = ({id: itemId, naam: itemNaam, aantal: aantal, prijs: itemPrijs});
        sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
        window.location.href = 'index.php';
    }
} });

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

afrekenenKnop.onclick = function () {
    if (mandjeLijst.children.length === 1) {
        mandjeLeeg.hidden = false;
    }
    else {
        window.location.href = 'afrekenen.php';
    }
}


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

function verhoogDeAantalItem(itemId) {
    mandjeItems[itemId].aantal++;
    const aantalSpan = document.getElementById(`aantal${itemId}`);
    aantalSpan.innerText = mandjeItems[itemId].aantal;
    sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
    beijwerkTotaal(mandjeItems[itemId].prijs, 1);
}

function neemEenItemAf(itemId) {
    if (mandjeItems[itemId].aantal > 1) {
        mandjeItems[itemId].aantal--;
        const aantalSpan = document.getElementById(`aantal${itemId}`);
        aantalSpan.innerText = mandjeItems[itemId].aantal;
        sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
        beijwerkTotaal(mandjeItems[itemId].prijs, -1);
    }
    else {
        verwijderEenItem(itemId);
    }
}

function verwijderEenItem(itemId) {
    mandjeItems[itemId] = null;
    sessionStorage.setItem('mandje', JSON.stringify(mandjeItems));
    window.location.href = 'index.php';
}

function beijwerkTotaal(prijs, x) {
    if (x === 1)
        totaal += prijs;
    else if (x === -1)
        totaal -= prijs;
    totaalSpan.innerHTML = `${totaal.toFixed(2)}&euro;`;;
}