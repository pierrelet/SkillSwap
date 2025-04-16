document.querySelector('#offerForm')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const res = await fetch('http://localhost:8000/api.php?route=offers', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      title: form.title.value,
      description: form.description.value,
      user_id: form.user_id.value
    })
  });
  const data = await res.json();
  alert(data.success ? 'Offre créée !' : 'Erreur');
});

async function loadOffers() {
  const res = await fetch('http://localhost:8000/api.php?route=offers');
  const offers = await res.json();
  const container = document.getElementById('offers');
  if (!container) return;
  container.innerHTML = offers.map(o => `<div><h3>${o.title}</h3><p>${o.description}</p><small>Par: ${o.email}</small></div>`).join('');
}
loadOffers();