# 🎓 SkillSwap — Plateforme d'échange de compétences

Bienvenue sur **SkillSwap**, une plateforme web simple et rapide pour publier, rechercher et échanger des compétences entre utilisateurs. Créée dans le cadre d'un projet fil rouge, elle combine frontend stylisé, backend API en PHP, et base de données PostgreSQL.  

---

## 🚀 Fonctionnalités

- 🔐 Inscription et connexion utilisateur
- 📝 Création d’offres de compétences
- 📄 Affichage des offres sous forme de cartes
- 🔍 Recherche dynamique d'offres
- 💬 Messagerie entre utilisateurs
- ⭐ Notation des membres
- 🛠 Interface admin pour modérer les offres
- 📱 Interface 100% responsive avec Tailwind CSS
- 🔐 Session persistante via `localStorage`

---

## 🧰 Stack technique

| Côté client        | Côté serveur       | Base de données  |
|--------------------|--------------------|------------------|
| HTML + CSS + JS    | PHP 8.x (API REST) | PostgreSQL       |
| Tailwind CSS CDN   | Router personnalisé| PDO sécurisé     |
| Vanilla JS / Fetch |                   |                  |

---

## ⚙️ Installation locale

```bash
# 1. Clone le projet
git clone https://github.com/tonuser/skillswap.git
cd skillswap

# 2. Lance le script de démarrage
chmod +x launch.sh
./launch.sh
