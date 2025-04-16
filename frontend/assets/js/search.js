document.querySelector('#searchInput').addEventListener('input', async (e) => {
  const keyword = e.target.value.toLowerCase();
  const res = await fetch('http://localhost:8000/api.php?route=offers');
  const offers = await res.json();
  const filtered = offers.filter(o => o.title.toLowerCase().includes(keyword));
  document.getElementById('searchResults').innerHTML = filtered.map(o => `<div><h4>${o.title}</h4><p>${o.description}</p></div>`).join('');
});