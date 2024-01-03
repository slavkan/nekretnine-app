const zupanije = [
  {
    ime: "Odaberite županiju",
    gradovi: ["Odaberite grad"]
  },
  {
    ime: "Hercegovačko-neretvanska županija",
    gradovi: ["Odaberite grad", "Mostar", "Čapljina", "Neum"]
  },
  {
    ime: "Sarajevska županija",
    gradovi: ["Odaberite grad", "Sarajevo", "Ilidža", "Vogošća"]
  },
  {
    ime: "Zeničko-dobojska županija",
    gradovi: ["Odaberite grad", "Zenica", "Doboj", "Maglaj"]
  },
  {
    ime: "Tuzlanska županija",
    gradovi: ["Odaberite grad", "Tuzla", "Lukavac", "Gradačac"]
  },
  {
    ime: "Bosansko-podrinjska županija",
    gradovi: ["Odaberite grad", "Goražde", "Višegrad", "Foča"]
  },
  {
    ime: "Posavska županija",
    gradovi: ["Odaberite grad", "Brčko", "Orašje", "Domaljevac"]
  },
  {
    ime: "Unsko-sanska županija",
    gradovi: ["Odaberite grad", "Bihać", "Sanski Most", "Cazin"]
  },
  {
    ime: "Zapadnohercegovačka županija",
    gradovi: ["Odaberite grad", "Široki Brijeg", "Grude", "Ljubuški", "Posušje"]
  },
  {
    ime: "Hercegbosanska županija",
    gradovi: ["Odaberite grad", "Livno", "Tomislavgrad", "Kupres", "Drvar"]
  },
  {
    ime: "Županija Središnja Bosna",
    gradovi: ["Odaberite grad", "Travnik", "Novi Travnik", "Vitez"]
  }
];

const zupanijaSelect = document.getElementById('zupanija');
const gradSelect = document.getElementById('grad');

function popuniGradove() {
  const odabranaZupanija = zupanijaSelect.value;
  const zupanija = zupanije.find(z => z.ime === odabranaZupanija);

  // Očistite prethodne gradove
  gradSelect.innerHTML = '';

  // Dodajte opcije za gradove
  zupanija.gradovi.forEach(grad => {
    const option = document.createElement('option');
    option.value = grad;
    option.textContent = grad;
    gradSelect.appendChild(option);
  });
}

// Popuni opcije za županije prilikom učitavanja stranice
zupanije.forEach(zupanija => {
  const option = document.createElement('option');
  option.value = zupanija.ime;
  option.textContent = zupanija.ime;
  zupanijaSelect.appendChild(option);
});
