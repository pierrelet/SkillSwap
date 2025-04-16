// Enregistrement
document.querySelector('#registerForm')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const res = await fetch('http://localhost:8000/api.php?route=auth&action=register', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email: form.email.value, password: form.password.value })
  });
  const data = await res.json();
  alert(data.success ? 'Inscription réussie' : 'Erreur');
});

// Connexion
document.querySelector('#loginForm')?.addEventListener('submit', async (e) => {
  e.preventDefault();
  const form = e.target;
  const res = await fetch('http://localhost:8000/api.php?route=auth&action=login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email: form.email.value, password: form.password.value })
  });
  const data = await res.json();
  if (data.success) {
    localStorage.setItem('user', JSON.stringify(data.user)); // 🔐 on stocke l'utilisateur
    alert('Connecté !');
    window.location.href = 'index.html'; // Rediriger vers accueil ou dashboard
  } else {
    alert('Email ou mot de passe incorrect');
  }
});