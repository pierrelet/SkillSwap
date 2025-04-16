(async () => {
  const res = await fetch('http://localhost:8000/api.php?route=auth&action=me&user_id=1');
  const data = await res.json();
  document.getElementById('profile').innerHTML = `<p>Email: ${data.email}</p><p>ID: ${data.id}</p>`;
})();